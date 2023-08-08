<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Suppliers;
use App\StockInOut;
use App\StockInOutProducts;

class InventoryCon extends Controller
{

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request){
        $products = Product::with(array('images' => function($query){
                $query->where(['primary' => 1, 'size' => 'small']);
            })
        )
        ->when($request->sort, function($query){
            return $query->orderBy('id', request()->sort);
        })// sort
        ->when($request->search, function($query){
            return $query->where('sku', 'like', '%'.request()->search.'%')
            ->orWhere('title', 'like', '%'.request()->search.'%');
        })// search
        ->oldest('qty')->paginate(20);
            
        return view('admin.inventory.index', compact('products'));
    }

    public function stock_in(){
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');

        return view('admin.inventory.create', compact('products'));
    }
   
    public function in_out_list(){
        $in_out = StockInOut::all();

        return view('admin.inventory.stock_in_out_list', compact('in_out'));
    }
    
    public function stock_in_store(Request $request){
        $stock_in_out = StockInOut::create([
            'user_id' => auth()->id(),
            'total_qty' => (int)str_replace(',', '', $request->total_qty),
            'note' => $request->note,
        ]);

        foreach ($request->products as $product) {
            $stock_in_out->stock_in_out_product()->create($product);

            $find_product = Product::find($product['product_id']);
            $update = $find_product->update(['qty' => ($find_product->qty + $product['qty'])]);
        }

        return response()->json(['code' => 200]);
    }

    public function stock_in_update($id){
        $products = $this->products->active()->get(['id', 'title', 'sku', 'selling_price', 'price'])->sortBy('title');
        $stock_in_out = StockInOut::find($id);
        $in_out_products = $stock_in_out->stock_in_out_product;
        // dd($in_out_products->toArray());
        return view('admin.inventory.update', compact('products', 'stock_in_out', 'in_out_products'));
    }

    public function stock_in_patch(Request $request){
        $stock_in_out = StockInOut::find($request->id);

        $stock_in_out->update([
            "total_qty" => (int)str_replace(',', '', $request->total_qty),
            "note" => $request->note,
        ]);

        $old_stock_in_out_products = StockInOutProducts::where('stock_in_out_id', $request->id);
        // dd($old_stock_in_out_products->get());

        foreach ($old_stock_in_out_products->get() as $old_product) {
            // ACTUAL PRODUCT
            $minus_product = Product::find($old_product->product_id);
            $minus_product_update = $minus_product->update(['qty' => ($minus_product->qty - $old_product->qty)]);
        } //update minus all added products to stocks

        $old_stock_in_out_products->delete();

        // add all new products to stocks
        foreach ($request->products as $product) {

            $add_product = Product::find($product['product_id']);
            $update_stocks = $add_product->update(['qty' => ($add_product->qty + $product['qty'])]);

            StockInOutProducts::create([
                'stock_in_out_id' => $request->id,
                'product_id' => $product['product_id'],
                'qty' => $product['qty'],
            ]);
        }

        return response()->json(['code' => 200]);
    }



    // I USE THIS TO REFLECT THE MANUAL STOCK IN TO THE PRODUCT STOCKS
    // public function reflect(){ 
    //     $stocks = StockInOutProducts::select('id', 'product_id', 'qty')->get();

    //     foreach ($stocks as $stock) {
    //         $add_product = Product::find($stock->product_id);
    //         $update_stocks = $add_product->update(['qty' => ($add_product->qty + $stock->qty)]);
    //     }
    // }
}
