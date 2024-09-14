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
            return $q->whereBetween('created_at', [now()->subDays(6), now()]);
        })// Show DEFAULT DATA For the Past 7 Days
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
        FbAds::find(request()->id)->update(['status' => 'SHIPPED']);
        return response(['success' => 'Success!']);
    }
}

// conversions/visitors * 100