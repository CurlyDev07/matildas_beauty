<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\DB;

class CheckoutCon extends Controller
{
    public function index($base64_item_details){
        $items_decode = json_decode(base64_decode($base64_item_details));
        $items = [];
        $shipping = 0;
        $subtotal = 0;
        $total = 0;

        foreach ($items_decode as $item) {
            $products = Product::where('id', $item->id)
            ->with(['images' => function($query){
                    $query->where('primary', 1);
                }]
            )->get()->toArray();

            $items[] = [
                'id' => $products[0]['id'],
                'title' => $products[0]['title'],
                'price' => $products[0]['price'],
                'qty' => $item->qty,
                'subtotal' => ($products[0]['price'] * $item->qty),
                'image' => $products[0]['images'][0]['img'],
            ];// add item

            $subtotal += ($products[0]['price'] * $item->qty);// add subtotal
        }

        $seo = [
            'title' => "Checkout",
            'image' => "",
            'description' => "",
            'robots' => 'none',
        ];

        $data = [
            "items" => $items,
            "shipping" => $shipping,
            "subtotal" => $subtotal,
            "total" => ($shipping + $subtotal),
            "seo" => $seo
        ];

        return view('pages.front.checkout', $data);
    }
}
