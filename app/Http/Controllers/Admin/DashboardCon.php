<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class DashboardCon extends Controller
{
    public function index(){

        $products = Product::all('price', 'qty');
        $commodity_cost = 0;
        $active_products = $products->count();

        foreach ($products as $key => $value) {
            $commodity_cost += $value->price * $value->qty;
        }
        
        return view('admin.dashboard', ['commodity_cost' => $commodity_cost, 'active_products' => $active_products]);
    }
}
