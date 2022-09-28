<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class HomeController extends Controller
{
    public function index(Request $request){
        $products = Product::with(array('images' => function($query){
            $query->where('primary', 1);
            })
        )
        ->where('status', 'active')
        ->select('id', 'title', 'price', 'compare_price')
        ->when($request->price, function ($query, $price) {
            return $query->orderBy('price', $price);
        })->inRandomOrder()->limit(10)->get()->toArray();

        $seo = [
            'title' => "Shop & Pick Our Featured and Best Selling Products in Shopickers",
            'image' => "",
            'description' => "",
            'robots' => 'index, follow',
        ];

        return view('pages.front.index', compact("products", "seo"));
    }

    public function contactus(){
        $seo = [
            'title' => "Contact Us - We are very happy to help you",
            'image' => "",
            'description' => "If you have any questions and concerns please contact us at helpdesk@becase.ph. We are very happy to help you.",
            'robots' => 'index, follow',
        ];
        return view('pages.front.contactus', compact('seo'));
    }

    public function aboutus(){
        $seo = [
            'title' => "About Us | Your Trusted Online Shopping Philippines | About Shopickers PH",
            'image' => "",
            'description' => "Your Trusted Online Shopping Philippines | About Shopickers PH",
            'robots' => 'index, follow',
        ];
        return view('pages.front.aboutus', compact('seo'));
    }

    public function policy(){
        $seo = [
            'title' => "Contact Us - We are very happy to help you",
            'image' => "",
            'description' => "If you have any questions and concerns please contact us at helpdesk@becase.ph. We are very happy to help you.",
            'robots' => 'index, follow',
        ];
        return view('pages.front.contactus', compact('seo'));
    }

    public function terms(){
        $seo = [
            'title' => "Contact Us - We are very happy to help you",
            'image' => "",
            'description' => "If you have any questions and concerns please contact us at helpdesk@becase.ph. We are very happy to help you.",
            'robots' => 'index, follow',
        ];
        return view('pages.front.contactus', compact('seo'));
    }



}
