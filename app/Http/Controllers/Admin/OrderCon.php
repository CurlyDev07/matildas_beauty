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
use App\Http\Requests\Orders\CreateOrderRequest;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class OrderCon extends Controller
{
    protected $products;

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request){
        $orders = Transaction::with('payments:id,transaction_id,total,payment_status')
        ->when($request->sort, function($q){
            return $q->orderBy('id', request()->sort);
        })// sort
        ->when($request->search, function($q){
            return $q->where('order_number', 'like', request()->search.'%');
        })// search
        ->select('id', 'order_number', 'package_qty', 'first_name', 'last_name', 'created_at')
        ->OrderBy('id', 'desc')
        ->paginate(100);
        return view('admin.orders.index', compact('orders'));
    }

    public function show($transaction_id){
        $orders = Transaction::where('id', $transaction_id)->with([
            'payments',
            'products',
            'products.product:id,title',
            'products.product.images' => function($q){
                $q->select('product_id', 'img')->where('primary', 1);
            }
        ])
        ->get()->toArray()[0];

        return view('admin.orders.view', compact('orders'));
    }

    public function create(){
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');
        $payment_method = PaymentMethod::all();
        $sold_from = SoldFrom::all();

        return view('admin.orders.create', compact('products', 'payment_method', 'sold_from'));
    }

    public function store(CreateOrderRequest $request){
        
        if ($request->products[0]['product_id'] == null) {

            $errormsg = [
                "message" => "The given data was invalid.",
                "errors" => [
                    "Product" => ["Please choose a <b>Product</b>"],
                ]
            ];

            return response()->json($errormsg, 422);
        }// Check if first Product is existing

        // ==========================================

        // CREATE TRANSACTION 
        $transaction = Transaction::create([
            'sold_from_id' => $request->sold_from,
            'payment_method_id' => $request->payment_method,
            'user_id' => 0,
            'package_qty' => $request->package_qty,
            'total_items' => $request->total_items,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name, 
            "phone_number" => $request->phone_number,  
            "email" => '', 
            'fb_link' => $request->fb_link,
            "address" => $request->address,   
            "barangay" => '', 
            "city" =>'', 
            "province" => '',
            "zip_code" => '',
            'status' => 'completed',
            'created_at' => $request->date ? date_f($request->date, 'Y-m-d H:i:s') : now(),
        ]);

        $transaction->update([
            'order_number' => generateOrderNumber($transaction['id'])
        ]);// Add transaction id

        
        $total = 0;

        // CREATE TRANSACTION PRODUCTS
        foreach ($request->products as $product) {

            // check if user all selected products has Product ID
            // if ID is present Create a record of product : dont create

            if ($product['product_id']) {
                $transaction->products()->create([
                    'product_id' => $product['product_id'],
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'subtotal' => $product['subtotal'],
                ]); // save product
                
                $total += $product['subtotal'];// add subtotal
    
                // UPDATE PRODUCT STOCKS
                $this->products->updateStocks($product['product_id'], $product['qty']);
            }
        }

        // CREATE TRANSACTION PAYMENT
        TransactionPayment::create([
            'transaction_id' => $transaction['id'],
            'payment_id' => "LX-".strtoupper(Str::random(20)),
            'payer_id' => 'N/A',
            'payer_email' => 'N/A',
            'shipping_fee' => 0,
            'subtotal' => $total,
            'total' => $total,
            'currency' => 'PHP',
            'payment_status' => 'completed',
        ]);

        return response()->json(['status' => true]);
    }

    public function update($order_id){
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');
        $orders = Transaction::find($order_id);
        $payment_method = PaymentMethod::all();
        $sold_from = SoldFrom::all();

        return view('admin.orders.update', compact('products', 'payment_method', 'sold_from', 'orders'));
    }

    public function patch(CreateOrderRequest $request){

        // Delete Previous Record
        TransactionProducts::where('transaction_id', $request->transaction_id)->delete();
        TransactionPayment::where('transaction_id', $request->transaction_id)->delete();
        Transaction::find($request->transaction_id)->delete();
        
        // this code is just a copy paste of store method

        if ($request->products[0]['product_id'] == null) {

            $errormsg = [
                "message" => "The given data was invalid.",
                "errors" => [
                    "Product" => ["Please choose a <b>Product</b>"],
                ]
            ];

            return response()->json($errormsg, 422);
        }// Check if first Product is existing

        // ==========================================

        // CREATE TRANSACTION 
        $transaction = Transaction::create([
            'sold_from_id' => $request->sold_from,
            'payment_method_id' => $request->payment_method,
            'user_id' => 0,
            'package_qty' => $request->package_qty,
            'total_items' => $request->total_items,
            "first_name" => $request->first_name,
            "last_name" => $request->last_name, 
            "phone_number" => $request->phone_number,  
            "email" => '', 
            'fb_link' => $request->fb_link,
            "address" => $request->address,   
            "barangay" => '', 
            "city" =>'', 
            "province" => '',
            "zip_code" => '',
            'status' => 'completed',
            'created_at' => $request->date ? date_f($request->date, 'Y-m-d H:i:s') : now(),
        ]);

        $transaction->update([
            'order_number' => generateOrderNumber($transaction['id'])
        ]);// Add transaction id

        
        $total = 0;

        // CREATE TRANSACTION PRODUCTS
        foreach ($request->products as $product) {

            // check if user all selected products has Product ID
            // if ID is present Create a record of product : dont create

            if ($product['product_id']) {
                $transaction->products()->create([
                    'product_id' => $product['product_id'],
                    'price' => $product['price'],
                    'qty' => $product['qty'],
                    'subtotal' => $product['subtotal'],
                ]); // save product
                
                $total += $product['subtotal'];// add subtotal
    
                // UPDATE PRODUCT STOCKS
                $this->products->updateStocks($product['product_id'], $product['qty']);
            }
        }

        // CREATE TRANSACTION PAYMENT
        TransactionPayment::create([
            'transaction_id' => $transaction['id'],
            'payment_id' => "LX-".strtoupper(Str::random(20)),
            'payer_id' => 'N/A',
            'payer_email' => 'N/A',
            'shipping_fee' => 0,
            'subtotal' => $total,
            'total' => $total,
            'currency' => 'PHP',
            'payment_status' => 'completed',
        ]);

        return response()->json(['status' => true]);

    }


    public function change_status(Request $request){
        $transaction = Transaction::find($request->id);
        $transaction->update(['status' => $request->status]);// change trans status
        $transaction->payments()->update(['payment_status' => $request->status]);// change payment status
        return response()->json(['status' => true]);
    }

    public function history(Request $request){
        // DD(date('Y'));

        $dates = TransactionProducts::select(
                DB::raw("(DATE_FORMAT(created_at, '%Y')) as year"),
                DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
                DB::raw("(DATE_FORMAT(created_at, '%d')) as day")
            )
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%d')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d')"))
            ->where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"), date('Y')) // get data of the current year
            ->where(DB::raw("(DATE_FORMAT(created_at, '%M'))"), date('M')) // get data of the current month
            ->get();
        
        $orders = TransactionProducts::select(
            "product_id" ,
                DB::raw("(sum(qty)) as total_qty"),
                DB::raw("(DATE_FORMAT(created_at, '%Y')) as year"),
                DB::raw("(DATE_FORMAT(created_at, '%M')) as month"),
                DB::raw("(DATE_FORMAT(created_at, '%d')) as day")
            )
            ->orderBy(DB::raw("DATE_FORMAT(created_at, '%d')"))

            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%M')"))
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%d')"))
            ->groupBy('product_id')
            ->with('product:id,title,sku')
            ->where(DB::raw("(DATE_FORMAT(created_at, '%Y'))"), date('Y')) // get data of the current year
            ->where(DB::raw("(DATE_FORMAT(created_at, '%M'))"), date('M')) // get data of the current month
            ->get();


            foreach ($orders as $order) {
                echo('Product ID: '. $order->product_id);
                echo('<br/>');
                echo('total_qty: '. $order->total_qty);
                echo('<br/>');

                echo($order->day.'/');
                echo($order->month.'/');
                echo($order->year.'/');
                echo('<br/>');
                echo('<br/>..........................................................<br/>');

            }
        // dd($orders);

        return view('admin.orders.history', ['orders' => $orders, 'dates' => $dates]);
    }

}
