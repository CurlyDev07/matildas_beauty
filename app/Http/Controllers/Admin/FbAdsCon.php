<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;
use App\FbEventListener;
use Illuminate\Support\Facades\DB;

class FbAdsCon extends Controller
{
    public function index(){

        $orders = FbAds::orderBy('created_at', 'desc')->get();
        return view('admin.fbads.index', ['orders' => $orders]);
    }

    public function event_listener(){
        $events = FbEventListener::groupBy('data')->select('data', DB::raw('count(*) as total'))->orderBy('data', 'desc')->get();
        return view('admin.fbads.event_listener', ['events' => $events]);
    }
}
