<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Expenses;
use App\Purchase;
use App\PowerUp;
use Illuminate\Support\Collection;

class DashboardCon extends Controller
{
    public function index(Request $request){

            // dd(request()->date);

        $products = Product::all('price', 'qty');
        $commodity_cost = 0;
        $active_products = $products->count();

        foreach ($products as $key => $value) {
            $commodity_cost += $value->price * $value->qty;
        }

        $expense = Expenses::when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('date', $from);
            }
            return $q->whereBetween('date', [$from, $to]);
        }); // FILTER DATE

        $chart_data = [['Task', 'Hours per Day']];
        $chart = $expense->selectRaw('sum(total) as grand_total, category_id')->with('category')->groupBy('category_id')
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('date', $from);
            }
            return $q->whereBetween('date', [$from, $to]);
        }) // FILTER DATE
        ->get()->toArray();

        foreach ($chart as $data) {
            $chart_data[] = [$data['category']['category'], (int)$data['grand_total']];
        }
        // dd($chart_data);


        $purchase = Purchase::when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('date', $from);
            }
            return $q->whereBetween('date', [$from, $to]);
        })->sum('total_price'); // FILTER DATE

        $tax = Purchase::when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('date', $from);
            }
            return $q->whereBetween('date', [$from, $to]);
        })->sum('tax'); // FILTER DATE

        $power_up_sf = PowerUp::when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('purchase_date', $from);
            }
            return $q->whereBetween('purchase_date', [$from, $to]);
        })->sum('sf'); // FILTER DATE;
        $power_up_total = PowerUp::when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);
            if ($from == $to) {
                return $q->whereDate('purchase_date', $from);
            }
            return $q->whereBetween('purchase_date', [$from, $to]);
        })->sum('total'); // FILTER DATE;

        return view('admin.dashboard', [
            'commodity_cost' => $commodity_cost,
            'active_products' => $active_products,
            'expense' => $expense->sum('total'),
            'purchase' => ($purchase + $tax),
            'power_up_sf' => $power_up_sf,
            'power_up_total' => $power_up_total,
            'chart_data' => $chart_data
        ]);
    }
}
