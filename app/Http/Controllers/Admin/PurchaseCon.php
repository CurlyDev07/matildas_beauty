<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Suppliers;
use App\Purchase;
use App\PurchaseProduct;

class PurchaseCon extends Controller
{
    public function index(){

        $purchases = Purchase::all();

        return view('admin.purchase.index', ['purchases' => $purchases]);
    }

    public function supplier(){
        return view('admin.purchase.supplier');
    }

    public function create(){
        
        $products = Product::select('id', 'title', 'price')->get('primary_image')->toArray();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.purchase.create', ['products' => $products, 'suppliers' => $suppliers]);
    }

    public function store(Request $request){
        $purchase = Purchase::create([
            "supplier" => $request->supplier, 
            "total_price" => $request->total_price,
            "total_qty" => $request->total_qty,
            "shipping_fee" => $request->shipping_fee,
            "transaction_fee" => $request->transaction_fee,
            "tax" => $request->tax
        ]);
        // dd($request->products);

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

    public function view($id){
        $purchase = Purchase::where('id', $id)->with(['purchase_product', 'purchase_product.product:id,title'])->first()->toArray();
        return view('admin.purchase.view', ['purchase' => $purchase]);
    }

}
