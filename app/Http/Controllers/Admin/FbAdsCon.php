<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;

class FbAdsCon extends Controller
{
    public function index(){
        $orders = FbAds::all();
        return view('admin.fbads.index', ['orders' => $orders]);
    }
}
