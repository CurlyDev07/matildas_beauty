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
use Carbon\Carbon;

use App\Http\Requests\Purchase\CreatePurchaseRequest;

class PurchaseCon extends Controller
{

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(){

        $purchases = Purchase::with(['suppliers'])->orderBy('date', 'desc')->get();

        return view('admin.purchase.index', ['purchases' => $purchases]);
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
            // purchase_product
            $purchase->purchase_product()->create($product);

            // Add stocks/Update Inventory
            $get_product = Product::select('id', 'sku', 'qty')->find($product['product_id']);

            $new_stock = ($get_product['qty'] + $product['qty']);// Calculate new sock
            $get_product->update(['qty' => $new_stock]);

        }

        return response()->json(['code' => 200]);

    }

    public function update($purchase_id){
        // dd($purchase_id);
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
            "status" => $request->tax,
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

            if ($product['received'] == 'no') {
                $OTW++;
            }
            if ($product['received'] == 'yes') {
                $COMPLETED++;
            }
            if ($product['received'] == 'incomplete') {
                $INCOMPLETE++;
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

}
