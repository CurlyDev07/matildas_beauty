<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\SoldFrom;
use App\PaymentMethod;

class ReturnRefundCon extends Controller
{
    public function index(){

        return view('admin.return_refund.index');
    }

    public function create(){
        $products = Product::with(array('images' => function($query){
            $query->where('primary', 1);
        })
    )->latest()->get();

    $payment_method = PaymentMethod::all();
    $sold_from = SoldFrom::all();

        return view('admin.return_refund.create', [
            'products' => $products,
            'sold_from' => $sold_from,
            'payment_method' => $payment_method
        ]);
    }
}
