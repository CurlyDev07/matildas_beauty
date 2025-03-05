<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;
use Carbon\Carbon;


class SmsCon extends Controller
{
    public function index(){
        $all = FbAds::distinct()->count('phone_number');

        $seven_days = FbAds::whereBetween('created_at', [Carbon::now()->subDays(7), Carbon::now()])
        ->count('phone_number');

        $fifteen_days = FbAds::whereBetween('created_at', [Carbon::now()->subDays(15), Carbon::now()])
        ->count('phone_number');

        $thirty_days = FbAds::whereBetween('created_at', [Carbon::now()->subDays(30), Carbon::now()])
        ->count('phone_number');
        

        return view('admin.sms.index', [
            'all' => $all,
            'seven_days' => $seven_days,
            'fifteen_days' => $fifteen_days,
            'thirty_days' => $thirty_days
        ]);
    }
}
