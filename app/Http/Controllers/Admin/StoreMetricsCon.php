<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\StoreMetrics;
use App\Http\Requests\StoresMetrics\StoresMetricsCreateRequest;

class StoreMetricsCon extends Controller
{
    public function index(){
        $metrics = StoreMetrics::with(['store'])->get();

        return view('admin.stores_metrics.index', ['metrics' => $metrics]);
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

}
