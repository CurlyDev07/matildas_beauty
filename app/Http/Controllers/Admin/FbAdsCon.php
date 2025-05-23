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

        $statusCounts = FbAds::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status'); // returns associative array: [status => total]
        
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
            'statusCounts' => $statusCounts
        ]);
    }

    public function create(){
        return view('admin.fbads.create');
    }

    public function store(){
        $order = FbAds::create(request()->all() + ['province' => '', 'city' => '', 'barangay' => '']);

       return redirect()->route('fbads.index');
    }

    public function order($id){
        $order = FbAds::find($id);
        return view('admin.fbads.order', ['order' => $order]);
    }

    public function patch(){
        
        FbAds::find(request()->id)->update(request()->all());
        
        return redirect()->back()->with('success', 'update successful');
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


        return view('admin.fbads.event_listener', ['events' => $events]);
    }
   
    public function events(Request $request){

        $contact_number = FbAds::select('phone_number')
        ->when(!$request->date, function($q){
            return $q->whereDate('created_at', now());
        })->when($request->date, function($q){
            $date = explode(" - ",request()->date);
            $from = carbon($date[0]);
            $to = carbon($date[1]);

            if ($from == $to) {
                return $q->whereDate('created_at', $from);
            }

            return $q->whereBetween('created_at', [$from, $to]);
        })->pluck('phone_number')->toArray();

        $events = FbEventListener::select('data', 'value', 'session_id', 'website')
        ->where('data', 'phone_number')
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
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.fbads.events', ['events' => $events, 'contact_number' => $contact_number]);
    }

    public function change_status(){
        // return request()->all();

        if (request()->status == "DELETE") {
            FbAds::find(request()->id)->delete();
        }else{
            FbAds::find(request()->id)->update(['status' => request()->status]);
        }

        return response(['success' => 'Success!']);
    }
}

// conversions/visitors * 100