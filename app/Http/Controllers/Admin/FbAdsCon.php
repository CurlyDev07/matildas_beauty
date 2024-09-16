<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;
use App\FbEventListener;
use Illuminate\Support\Facades\DB;
use App\Store;

class FbAdsCon extends Controller
{
    public function index(Request $request){
        $stores = Store::all();

        $orders = FbAds::orderBy('created_at', 'desc')
        ->when(!$request->date, function($q){
            return $q->whereDate('created_at', now());
        })// Show DEFAULT DATA For TODAY
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })// FILTER DATE
        ->when($request->status, function($q){
            return $q->where('status', request()->status);
        })// Filter by STATUS
        ->get();

        return view('admin.fbads.index', [
            'orders' => $orders,
            'stores' => $stores,
        ]);
    }

    public function event_listener(Request $request){
        $events = FbEventListener::groupBy('data')->select('data', DB::raw('count(*) as total'))
        ->when(!$request->date, function($q){
            return $q->whereDate('created_at', now());
        })// Show DEFAULT DATA For Today
        ->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })// FILTER DATE
        ->orderBy('data', 'desc')
        ->get();

        // dd($events);

        return view('admin.fbads.event_listener', ['events' => $events]);
    }
   
    public function change_status(){
        // return request()->all();
        FbAds::find(request()->id)->update(['status' => request()->status]);
        return response(['success' => 'Success!']);
    }
}

// conversions/visitors * 100