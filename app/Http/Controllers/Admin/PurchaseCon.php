<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Product;
use App\Suppliers;
use App\Purchase;
use App\PurchaseProduct;
use App\PaymentMethod;
use App\SoldFrom;
use App\Store;
use Carbon\Carbon;

use App\Http\Requests\Purchase\CreatePurchaseRequest;

class PurchaseCon extends Controller
{

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request){
        $suppliers = Suppliers::all(['id', 'name']);
        $purchases = Purchase::with(['suppliers'])->orderBy('date', 'desc')
        ->when($request->supplier, function($q){
            return $q->where('supplier', request()->supplier);
        })// Filter by stores
        ->get();
        return view('admin.purchase.index', ['purchases' => $purchases, 'suppliers' => $suppliers]);
    }

    public function supplier(){
        return view('admin.purchase.supplier');
    }

    public function create(){
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.purchase.create', [
            'products' => $products,
            'suppliers' => $suppliers,
        ]);
    }

    public function store(CreatePurchaseRequest $request){
        
        $purchase = Purchase::create([
            "supplier" => $request->supplier, 
            "total_price" => (int)str_replace(',', '', $request->total_price),
            "total_qty" => (int)str_replace(',', '', $request->total_qty),
            "shipping_fee" => $request->shipping_fee,
            "transaction_fee" => $request->transaction_fee,
            "tax" => $request->tax,
            "date" => $request->date ? date_f($request->date, 'Y-m-d H:i:s') : now()
        ]);

        foreach ($request->products as $product) {
            $purchase->purchase_product()->create($product);
        }

        return response()->json(['code' => 200]);
    }

    public function update($purchase_id){
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();
        $purchase = Purchase::find($purchase_id);
        $receive_status = ['no','yes','incomplete'];

        return view('admin.purchase.update', [
            'products' => $products,
            'suppliers' => $suppliers,
            'purchase' => $purchase,
            'receive_status' => $receive_status
        ]);
    }

    public function patch(Request $request){

        Purchase::find($request->purchase_id)->delete();
        PurchaseProduct::where('purchase_id', $request->purchase_id)->delete();

        $purchase = Purchase::create([
            "supplier" => $request->supplier, 
            "total_price" => (int)str_replace(',', '', $request->total_price),
            "total_qty" => (int)str_replace(',', '', $request->total_qty),
            "shipping_fee" => $request->shipping_fee,
            "transaction_fee" => $request->transaction_fee,
            "tax" => $request->tax,
            "date" => $request->date ? date_f($request->date, 'Y-m-d H:i:s') : now()
        ]);

        // These Variables are used to get the Purchase Status
        $status = 'OTW';
        $product_count = count($request->products);
        $OTW = 0;
        $COMPLETED = 0;
        $INCOMPLETE = 0;
        // -------------------------------------------------

        foreach ($request->products as $product) {
            // purchase_product
            $purchase->purchase_product()->create($product);

            // These IF/ELSE are used to get the Purchase Status


            if (array_key_exists('received', $product)) {
                if ($product['received'] == 'no') {
                    $OTW++;
                }
                if ($product['received'] == 'yes') {
                    $COMPLETED++;
                }
                if ($product['received'] == 'incomplete') {
                    $INCOMPLETE++;
                }
            }else{
                $OTW++;
            }

            // -------------------------------------------------


            // ======================================================
            // Stocks are not yet updated after editing the purchase
            // ======================================================

            // // Add stocks/Update Inventory
            // $get_product = Product::select('id', 'sku', 'qty')->find($product['product_id']);

            // $new_stock = ($get_product['qty'] + $product['qty']);// Calculate new sock
            // $get_product->update(['qty' => $new_stock]);

        }

        if ($product_count == $OTW) {
            $status = 'OTW';
        }elseif ($product_count == $COMPLETED) {
            $status = 'COMPLETED';
        }elseif ($INCOMPLETE > 0) {
            $status = 'INCOMPLETE';
        }elseif ($COMPLETED > 0 && $OTW > 0 ) {
            $status = 'INCOMPLETE';
        }

        $purchase->update(['status' => $status]);// Update status

        return response()->json(['code' => 200]);

    }

    public function view($id){
        $purchase = Purchase::where('id', $id)->with(['purchase_product', 'purchase_product.product:id,title'])->first()->toArray();
        return view('admin.purchase.view', ['purchase' => $purchase]);
    }
    
    public function report(){
        // $month = DB::table('purchases')
        // ->select(DB::raw('sum(total_price) as total'), DB::raw('DATE_FORMAT(created_at, "%d-%M") as day'))
        // ->whereMonth('created_at', Carbon::now()->month)
        // ->groupBy('day')
        // ->get();

        // dd($month);

        return view('admin.purchase.report');
    }

    public function report_data(Request $request){

        if ($request->filter == 'day') {
            // $day = Purchase::select('total_price', 'created_at')->whereMonth('created_at', Carbon::now()->month)->get();

            $day = DB::table('purchases')
            ->select(DB::raw('sum(total_price) as total'), DB::raw('DATE_FORMAT(created_at, "%d-%M") as day'))
            ->whereMonth('created_at', Carbon::now()->month)
            ->groupBy('day')
            ->get();



            return $day;
        }


        $month = DB::table('purchases')
            ->select(DB::raw('sum(total_price) as total'), DB::raw('DATE_FORMAT(created_at, "%M-%Y") as month'))
            ->groupBy('month')
            ->get();

        return $month;
    }

    public function reflect_stocks(Request $request){
        $product = Product::find($request->product_id);
        $product_purchase = PurchaseProduct::find($request->purchase_product_id);
        $prevRQTY = $product_purchase->received_qty;
        $receivedStatus = $request->received;
        $stock_in = 'no';

        if ($request->received_qty >= $product_purchase->qty) {
            $receivedStatus = 'yes';
            $stock_in = 'yes';
        }else{
            $receivedStatus = 'incomplete';
            $stock_in = 'partial';
        }

        $product_purchase->update([
            'received' => $receivedStatus,
            'received_qty' => $request->received_qty,
            'stock_in' => $stock_in,
        ]);

        if ($prevRQTY == NULL) {
            $product->update(['qty' => ($product->qty + $request->received_qty)]);
        }else{
            $product->update(['qty' => (($product->qty - $prevRQTY) + $request->received_qty) ]);
        }

        
        return response()->json(['code' => 200]);
    }

}
