<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Suppliers;
use App\Purchase;
use App\PurchaseProduct;
use App\PaymentMethod;
use App\SoldFrom;


use App\Http\Requests\Purchase\CreatePurchaseRequest;

class PurchaseCon extends Controller
{

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(){

        $purchases = Purchase::with(['suppliers'])->orderBy('created_at', 'desc')->get();
        // dd($purchases);
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
            "total_qty" => $request->total_qty,
            "shipping_fee" => $request->shipping_fee,
            "transaction_fee" => $request->transaction_fee,
            "tax" => $request->tax
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
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();
        $purchase = Purchase::find($purchase_id);
        // dd($purchase);

        return view('admin.purchase.update', [
            'products' => $products,
            'suppliers' => $suppliers,
            'purchase' => $purchase
        ]);
    }

    public function view($id){
        $purchase = Purchase::where('id', $id)->with(['purchase_product', 'purchase_product.product:id,title'])->first()->toArray();
        return view('admin.purchase.view', ['purchase' => $purchase]);
    }

}
