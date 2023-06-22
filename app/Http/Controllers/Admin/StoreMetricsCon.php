<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\StoreMetrics;
use Illuminate\Support\Collection;
use App\Http\Requests\StoresMetrics\StoresMetricsCreateRequest;

class StoreMetricsCon extends Controller
{
    public function index(Request $request){
      
        $stores = Store::all();

        $metrics = StoreMetrics::with(['store'])
        ->when(!$request->dates, function($q){
            $yesterday = date('Y-m-d',strtotime("-1 days"));
            return $q->where('date', $yesterday);
        })// Show Yesterday's Datas
        ->when($request->dates, function ($q) {
            $date = explode(" - ",request()->dates);
            $from = date_format(date_create($date[0]), "Y-m-d") .' 00:00:00';
            $to = date_format(date_create($date[1]),"Y-m-d") .' 23:59:59';
            return $q->whereBetween('date', [$from, $to]);
        })// filter by date
        ->when($request->stores, function($q){
            return $q->where('store_id', request()->stores);
        })// Filter by stores
        ->when($request->orders, function($q){
            return $q->orderBy('orders', request()->orders);
        })// sort orders
        ->when($request->sales, function($q){
            return $q->orderBy('sales', request()->sales);
        })// sort sales
        ->when($request->conversion_rate, function($q){
            return $q->orderBy('conversion_rate', request()->conversion_rate);
        })// sort conversion_rate
        ->when($request->visitors, function($q){
            return $q->orderBy('visitors', request()->visitors);
        })// sort visitors
        ->when($request->platform, function($q){
            $platform_ids = Store::where('platform', request()->platform)->pluck('id')->toArray();
            return $q->whereIn('id', $platform_ids);
        })// sort visitors
        ->get();

        $collection = new Collection($metrics->toArray());
        $data = [
            'orders' => number_format($collection->sum('orders')),
            'sales' => number_format($collection->sum('sales')),
            'conversion_rate' => number_format($collection->avg('conversion_rate')),
            'visitors' => number_format($collection->sum('visitors')),
            'results' => $collection->count(),
        ];

        // dd($data);
        // dd($collection);


        return view('admin.stores_metrics.index', ['metrics' => $metrics, 'stores' => $stores, 'data' => $data]);
    }

    public function create(){

        $stores = Store::all();

        return view('admin.stores_metrics.create', ['stores' => $stores]);
    }

    public function store(StoresMetricsCreateRequest $request){
        $create = StoreMetrics::create([
            "store_id" => $request->store_id,
            "date" => date_f($request->date, 'Y-m-d H:i:s'),
            "sales" => $request->sales,
            "orders" => $request->orders,
            "visitors" => $request->visitors,
            "conversion_rate" => $request->conversion_rate,
        ]);


        return redirect()->back()->with('success', 'Success');
    }

    public function update($id){
        $stores = Store::all();

        $metrics = StoreMetrics::find($id);

        return view('admin.stores_metrics.update', ['metrics' => $metrics, 'stores' => $stores]);
    }
    
    public function patch(StoresMetricsCreateRequest $request){

        $patch = StoreMetrics::find($request->id);
        $patch->update([
            "store_id" => $request->store_id,
            "date" => date_f($request->date, 'Y-m-d H:i:s'),
            "sales" => $request->sales,
            "orders" => $request->orders,
            "visitors" => $request->visitors,
            "conversion_rate" => $request->conversion_rate,
        ]);

        return redirect()->back()->with('success', 'Success');
    }


}
