<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductsCon extends Controller
{

    public $products;

    function __construct(Product $products) {
        $this->products = $products;
    }


    public function show($slug, $item_id){
        $product = Product::with(['images'])
        ->findOrFail($item_id)->toArray();

        $seo = [
            'title' => $product['title'],
            'image' => url($product['primary_image']),
            'description' => $product['short_description'],
            'robots' => 'none',
        ];

        return view('pages.products.show', compact('product', 'seo'));
    }

    public function all(Request $request){
        $products = Product::with(array('images' => function($query){
                $query->where('primary', 1);
            })
        )
        ->where('status', '!=','inactive')
        ->select('id', 'title', 'price', 'compare_price')
        ->when($request->min, function ($query, $min) {
            return $query->where('price', '>', $min);
        })
        ->when($request->max, function ($query, $max) {
            return $query->where('price', '<', $max);
        })
        ->when($request->price, function ($query, $price) {
            return $query->orderBy('price', $price);
        })
        ->paginate(24);
        
        $seo = [
            'title' => "Products",
            'image' => "",
            'description' => "",
            'robots' => 'index, follow',
        ];

        return view('pages.products.all', compact('products', 'seo'));
    }

    public function auto_complete(){
        $products = json_encode($this->products->active()->pluck('id', 'title'));
        return response()->json($products);
    }
}
