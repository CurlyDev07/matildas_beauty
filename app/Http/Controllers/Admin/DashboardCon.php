<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Expenses;
use App\Purchase;
use App\PowerUp;
use Illuminate\Support\Collection;
use App\TransactionPorductSummary;
use Carbon\Carbon;

class DashboardCon extends Controller
{
    public function index(Request $request){
        // ****************** TOP Products **********************
        $top_20_products = TransactionPorductSummary::selectRaw('sum(qty) as quantity, product_id')
        ->with(['products', 'products:id,sku,selling_price,price'])
        ->orderBy('quantity', 'desc')
        ->groupBy('product_id')->limit(20)->get()->toArray();


        // ****************** EXPENSES **********************
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

        // ****************** PURCHASE **********************
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

        // ****************** POWER UP **********************
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
            'expense' => $expense->sum('total'),
            'purchase' => ($purchase + $tax),
            'power_up_sf' => $power_up_sf,
            'power_up_total' => $power_up_total,
            'chart_data' => $chart_data,
            'top_20_products' => $top_20_products
        ]);
    }
}
