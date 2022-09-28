<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Transaction;
use App\TransactionPayment;
use App\TransactionProducts;
use App\Product;
use App\PaymentMethod;
use App\SoldFrom;
use App\Shopee;
use App\Store;
use Illuminate\Support\Str;
use Storage;
use File;
use Exporter;
use Importer;
use App\Http\Requests\Shopee\CreateOrderRequest;
use Illuminate\Support\Facades\DB;

class ShopeeCon extends Controller
{
    protected $products;

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request){

        $stores = Store::all();

        $q = Shopee::select('order_status',
            DB::raw('Count(*) as total_orders'),
            DB::raw('SUM(quantity) as total_item_quantity'),
            DB::raw('SUM(profit) as total_profit'),
            DB::raw('SUM(service_fee) as total_service_fee'),
            DB::raw('SUM(seller_voucher) as total_seller_voucher'),
            DB::raw('SUM(seller_bundle_discount) as total_seller_bundle_discount'))
            ->groupBy('order_status');
        
        $q->when($request->store, function ($q) {
            return $q->where('store', request('store'));
        });// store filter

        $q->when($request->dates, function ($q) {
            $date = explode(" - ",request()->dates);
            $from = date_format(date_create($date[0]), "Y-m-d") .' 00:00:00';
            $to = date_format(date_create($date[1]),"Y-m-d") .' 23:59:59';
            // dd([$from, $to]);
            return $q->whereBetween('order_creation_date', [$from, $to]);
        });// date filter
    
        // dd($q->toSql());
        $status = $q->get()->toArray();

        $order = ['Unpaid', 'To ship', 'Shipping', 'Completed', 'Cancelled'];

        usort($status, function ($a, $b) use ($order) {
            $pos_a = array_search($a['order_status'], $order);
            $pos_b = array_search($b['order_status'], $order);
            return $pos_a - $pos_b;
        });
        
        return view('admin.shopee.index', ['stores' => $stores, 'status' => $status]);
    }
    
    public function orders(Request $request){

        $uploaded = Shopee::select(['store', 'original_file_name', DB::raw('count(*) as total')])
        ->groupBy('store')
        ->groupBy('original_file_name')
        ->groupBy(DB::raw('CAST(created_at AS DATE)'))
        ->get();
        
        return view('admin.shopee.orders', ['uploaded' => $uploaded]);
    }

    public function create(){
       
        return view('admin.shopee.create');
    }
   
    public function store(CreateOrderRequest $request){

        $file = $request->file('file');
        $file_orig_name = $file->getClientOriginalName();
        $file_path = public_path('files');
        $file_name = uuid().'.'. $file_orig_name;
        $file->move($file_path, $file_name);

        $excel = Importer::make('Excel');
        $excel->load('files/'.$file_name);
        $collection = $excel->getCollection();
        $excel_column_count = sizeof($collection[0]);

        if ($excel_column_count != 53) { // 52 is the count of exported excel comlumn
            return redirect()->back()->with('failed', '');
           
        }

        // Check if filename, store & order id already exist.
        // if exists | update else insert data
        $is_exists = Shopee::where('original_file_name', $file_orig_name)
        ->where('store', $request->store)
        ->exists();

        if (!$is_exists) {
            foreach ($collection as $key => $value) {
                if ($key != 0) {
                    $power_up = false;

                    $order_id = $value[0];
                    $sku_reference_no = $value[13];
                    $product_subtotal = $value[18];
                    $service_fee = $value[37];
                    $seller_bundle_discount = $value[30];
                    $quantity = $value[17];
                    $tracking_number = $value[4];
                    $ship_time = $value[8];
                    $number_of_items_in_order = $value[23];

                    $transaction_fee = 2.24;
                    $comission_fee = 2;

                    $product = Product::select('id', 'price', 'qty')->where('sku', $sku_reference_no)->first();
                    $product_capital = ((int)$product['price']) * $quantity;

                    // CALCULATE PROFIT | AVG SF is missing
                    $deductions = ($product_subtotal * (($transaction_fee + $comission_fee)/100)) + $service_fee + $seller_bundle_discount;
                    $profit = 0; // if product sku is not present/wrong dont add the profit

                    if ($product_capital) {
                        $profit = $product_subtotal - ($product_capital + $deductions);
                    }

                    // CHECK IF ORDER IS A POWER UP OR NOT
                    // IF POWER UP MAKE THE PROFIT = 0
                    // CHANGE POWER UP COLUMN TO (TRUE)
                    // this will be the indicator for [power up] expenses calculation

                    if ($number_of_items_in_order > 85) {
                        $profit = 0;
                        $power_up = true;
                    }

                    Shopee::create([
                        "order_id" => $order_id,
                        "store" => $request->store,
                        "order_status" => $value[1], 
                        "cancel_reason" => $value[2], 
                        "return_refund_status" => $value[3], 
                        "tracking_number" => $tracking_number, 
                        "shipping_option" => $value[5], 
                        "shipment_method" => $value[6], 
                        "estimated_ship_out_date" => date('Y-m-d H:i:s',strtotime($value[7])),
                        "ship_time" => date('Y-m-d H:i:s',strtotime($ship_time)),
                        "order_creation_date" => date('Y-m-d H:i:s',strtotime($value[9])),
                        "order_paid_time" => date('Y-m-d H:i:s',strtotime($value[10])),
                        "parent_sku_reference_no" => $value[11], 
                        "product_name" => $value[12], 
                        "sku_reference_no" => $sku_reference_no, 
                        "variation_name" => $value[14], 
                        "original_price" => $value[15], 
                        "deal_price" => $value[16], 
                        "quantity" => $quantity, 
                        "product_subtotal" => $product_subtotal, 
                        "total_discount" => $value[19], 
                        "price_discount_from_seller" => $value[20], 
                        "shopee_rebate" => $value[21], 
                        "sku_total_weight" => $value[22], 
                        "number_of_items_in_order" => $value[23], 
                        "order_total_weight" => $value[24], 
                        "seller_voucher" => $value[25], 
                        "seller_absorbed_coin_cashback" => $value[26], 
                        "shopee_voucher" => $value[27], 
                        "bundle_deals_indicator" => $value[28], 
                        "shopee_bundle_discount" => $value[29], 
                        "seller_bundle_discount" => $seller_bundle_discount, 
                        "shopee_coins_offset" => $value[31], 
                        "credit_card_discount_total" => $value[32], 
                        "products_price_paid_by_buyer" => $value[33], 
                        "buyer_paid_shipping_fee" => $value[34], 
                        "shipping_rebate_estimate" => $value[35], 
                        "reverse_shipping_fee" => $value[36], 
                        "service_fee" => $service_fee, 
                        "grand_total" => $value[38], 
                        "estimated_shipping_fee" => $value[39], 
                        "username_buyer" => $value[40], 
                        "receiver_name" => $value[41], 
                        "phone_number" => $value[42], 
                        "delivery_address" => $value[43], 
                        "town" => $value[44], 
                        "district" => $value[45], 
                        "province" => $value[46], 
                        "region" => $value[47], 
                        "country" => $value[48], 
                        "zip_code" => $value[49], 
                        "remark_from_buyer" => $value[50], 
                        "order_complete_time" => date('Y-m-d H:i:s',strtotime($value[51])),
                        "note" => $value[52],
                        "original_file_name" => $file_orig_name,
                        "profit" => $profit,
                        "transaction_fee" => $product_subtotal * (($transaction_fee)/100),
                        "comission_fee" => $product_subtotal * (($comission_fee)/100),
                        "power_up" => $power_up
                    ]);


                    // *************************************************************
                    // IF PRODUCT = NULL : Meaning SKU is not found 
                    // Maybe shopee sku is not following the standard skun template
                    // *************************************************************

                    if ($product != null) {
                        // ************************************
                        // DEDUCT STOCKS if order have a ship_time.
                        // ship_time = Shipout
                        // ************************************
                        if ($ship_time != "1970-01-01 00:00:00") {
                            // IF NOT POWER UP DEDUCT STOCKS
                            if ($power_up == false) {
                                $new_stock_qty = ($product['qty'] - $quantity);
                                $get_product = Product::find($product['id'])->update(['qty' => $new_stock_qty]);
                            }
                        }
                    }
                }
            }
        }else{
            foreach ($collection as $key => $value) {
                if ($key != 0) {

                    $order_id = $value[0];
                    $shopee_oder = Shopee::where("order_id", $order_id)
                        ->where('original_file_name', $file_orig_name)
                        ->where('order_id', $order_id)
                        ->where('store', $request->store)
                        ->update([
                            "order_status" => $value[1], 
                            "cancel_reason" => $value[2], 
                            "return_refund_status" => $value[3], 
                            "tracking_number" => $value[4], 
                            "shipping_option" => $value[5], 
                            "shipment_method" => $value[6], 
                            "estimated_ship_out_date" => date('Y-m-d H:i:s',strtotime($value[7])),
                            "ship_time" => date('Y-m-d H:i:s',strtotime($value[8])),
                            "order_creation_date" => date('Y-m-d H:i:s',strtotime($value[9])),
                            "order_paid_time" => date('Y-m-d H:i:s',strtotime($value[10])),
                            "original_price" => $value[15], 
                            "deal_price" => $value[16], 
                            "quantity" => $value[17], 
                            "product_subtotal" => $value[18], 
                            "total_discount" => $value[19], 
                            "price_discount_from_seller" => $value[20], 
                            "shopee_rebate" => $value[21], 
                            "sku_total_weight" => $value[22], 
                            "number_of_items_in_order" => $value[23], 
                            "order_total_weight" => $value[24], 
                            "seller_voucher" => $value[25], 
                            "seller_absorbed_coin_cashback" => $value[26], 
                            "shopee_voucher" => $value[27], 
                            "bundle_deals_indicator" => $value[28], 
                            "shopee_bundle_discount" => $value[29], 
                            "seller_bundle_discount" => $value[30], 
                            "shopee_coins_offset" => $value[31], 
                            "credit_card_discount_total" => $value[32], 
                            "products_price_paid_by_buyer" => $value[33], 
                            "buyer_paid_shipping_fee" => $value[34], 
                            "shipping_rebate_estimate" => $value[35], 
                            "reverse_shipping_fee" => $value[36], 
                            "service_fee" => $value[37], 
                            "grand_total" => $value[38], 
                            "estimated_shipping_fee" => $value[39], 
                            "order_complete_time" => date('Y-m-d H:i:s',strtotime($value[51])),
                    ]);
                }
            }
        }

        return redirect()->back()->with('success', $file_orig_name);
    }

    public function view($filename, $store){

        $orders = Shopee::select('id', 'order_id', 'order_status', 'sku_reference_no as sku', 'quantity', 'product_subtotal', 'transaction_fee', 'comission_fee', 'profit', 'power_up')
        ->where('original_file_name', $filename)
        ->where('store', $store);
        
        $orders->when(request('search'), function ($q) {
            return $q->where('order_id', 'like', "%".request('search')."%")
                    ->orWhere('sku_reference_no', 'like', "%".request('search')."%");
        });

        $orders->when(request('sort'), function ($q) {
            $q->orderBy('created_at', request('sort'));
        });
        
        return view('admin.shopee.view', ['orders' => $orders->get(), 'filename' => $filename, 'store' => $store]);
    }

    public function picklist($filename, $store){
        $picklist = Shopee::select('sku_reference_no', DB::raw('SUM(quantity) as quantity'))
        ->where('original_file_name', $filename)
        ->where('store', $store)
        ->groupBy('sku_reference_no')
        ->orderBy('quantity', "DESC")
        ->get();

        // dd($picklist);
        return view('admin.shopee.picklist', ['picklist' => $picklist]);
    }

    public function view_update(Request $request){
        $order = Shopee::find($request->id);
        
        $find_sku = Product::select('id', 'sku', 'price', 'qty')->where('sku', $request->sku)->first();

        if (!$find_sku) {
           return ['error' =>'Sku not found!'];
        }

        $transaction_fee = 2.24;
        $comission_fee = 2;
        $product_capital = (int)$find_sku['price'] * $order->quantity;

        // CALCULATE PROFIT | AVG SF is missing
        $deductions = ($order->product_subtotal * (($transaction_fee + $comission_fee)/100)) + $order->service_fee + $order->seller_bundle_discount;

        $profit = $order->product_subtotal - ($product_capital + $deductions);
        $order->update([
            'sku_reference_no' => $request->sku,
            'profit' => $profit,
        ]);

        // ************************************
        // DEDUCT STOCKS if order have a ship_time.
        // ship_time = Shipout
        // ************************************
        if ($order->ship_time != "1970-01-01 00:00:00") {
            $new_stock_qty = ($find_sku['qty'] - $order->quantity);
            $get_product = Product::find($find_sku['id'])->update(['qty' => $new_stock_qty]);
        }

        return ['success' =>'Success'];
    }

    public function fix_seller_voucher(Request $request){

        $items = Shopee::select('id', 'seller_voucher', 'order_id', 'is_seller_voucher_fix')
        ->where('store', $request->store)
        ->where('original_file_name', $request->original_file_name)
        ->where('seller_voucher', '>', 0)
        ->where('is_seller_voucher_fix', false)
        ->get();

        foreach ($items as $item) {
            if (!$item->is_seller_voucher_fix) {
                $count = Shopee::select('id')->where('order_id', $item->order_id)->count();

                $row = Shopee::select('id', 'seller_voucher', 'order_id', 'is_seller_voucher_fix', 'profit')->where('id', $item->id);
                $selected_data = $row->first();
                $seller_voucher = (int)$selected_data['seller_voucher'] / $count;

                $row->update([
                    'is_seller_voucher_fix' => true,
                    'seller_voucher' => $seller_voucher,
                    'profit' => (int)$selected_data['profit'] - $seller_voucher
                ]);
            }
    
        }
        return $request->original_file_name;
    }
}

