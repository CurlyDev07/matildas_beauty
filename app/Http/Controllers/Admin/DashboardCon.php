<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Expenses;
use App\Purchase;
use App\PowerUp;

class DashboardCon extends Controller
{
    public function index(){

        $products = Product::all('price', 'qty');
        $commodity_cost = 0;
        $active_products = $products->count();

        foreach ($products as $key => $value) {
            $commodity_cost += $value->price * $value->qty;
        }

        $expense = Expenses::sum('cost');
        $purchase = Purchase::sum('total_price') + Purchase::sum('tax');
        $power_up_sf = PowerUp::sum('sf');
        $power_up_total = PowerUp::sum('total');

        return view('admin.dashboard', [
            'commodity_cost' => $commodity_cost,
            'active_products' => $active_products,
            'expense' => $expense,
            'purchase' => $purchase,
            'power_up_sf' => $power_up_sf,
            'power_up_total' => $power_up_total,
        ]);
    }
}
