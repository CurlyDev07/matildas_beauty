<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;

class FbAdsCon extends Controller
{
    public function index(){
        $orders = FbAds::orderBy('created_at', 'desc')->get();
        return view('admin.fbads.index', ['orders' => $orders]);
    }
}
