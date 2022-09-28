<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class CartCon extends Controller
{
    public function index(Request $request){
        $product_ids = json_decode($request->cookie('product_ids')); // get all product ids from cart

        $products = [];
        if ($product_ids) {
            $reverse_ids = array_reverse($product_ids, true);
            
            foreach ($reverse_ids as $index => $id) {
                $product = Product::where('id', $id)
                ->where('status', 'active')
                ->with(['images' => function($query){
                        $query->where('primary', 1);
                    }]
                );

                if (!$product->exists()) {
                    unset($product_ids[1]);// remove item in cart if items is not exists anymore
                    cookie()->forever('product_ids', json_encode(array_unique($product_ids)));// resave cart cookie
                    continue;// skip loop if items does not exists
                }

                $products[] = $product->first()->toArray();
            }
        }

        $seo = [
            'title' => "Cart",
            'image' => "",
            'description' => "",
            'robots' => 'none',
        ];

        return view('pages.front.cart', compact('products', 'seo'));
    }

    public function add($id, Request $request){
         // get all product ids in cookie serialize and remove duplicates
        $cart_product_ids = json_decode($request->cookie('product_ids'));

        if (!$cart_product_ids) { 
            $cart_product_ids = [$id];// if cart is empty
        }else{
            $cart_product_ids[] = $id;// if cart contains an item push new item
        }
        
        // save product id to cookie
        return response('The item added to cart')->withCookie(cookie()->forever('product_ids', json_encode(array_unique($cart_product_ids))));
    }

    public function clear_all(){
        return response('cookie clear')->withCookie(cookie()->forget('product_ids'));
    }

    public function count(Request $request){
        $product_ids = json_decode($request->cookie('product_ids')); // get all product ids from cart
        $products = [];
        if ($product_ids) {
            $products = Product::whereIn('id', $product_ids)
            ->get('id');
        }
        return(count($products));
    }

    public function compute_selected_cart_items(Request $request){
        foreach (json_decode($request->item) as $item) {
            return DB::table('products')->where('id', $item->id)
            ->select('id', DB::raw("price * {$item->qty}"))->get();
        }


    }
}
