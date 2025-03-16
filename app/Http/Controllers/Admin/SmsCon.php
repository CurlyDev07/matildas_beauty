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

    public function phone_numbers(Request $request){
        $phoneNumbers = FbAds::when(!$request->date, function ($q) {
            return $q->whereDate('created_at', Carbon::yesterday()); // Default to yesterday
        })
        ->when($request->date, function ($q) {
            $date = explode(" - ", request()->date);
            $from = Carbon::parse($date[0]);
            $to = Carbon::parse($date[1]);
    
            if ($from->equalTo($to)) {
                return $q->whereDate('created_at', $from);
            }
    
            return $q->whereBetween('created_at', [$from, $to]);
        })
        ->distinct()
        ->pluck('phone_number');


        // $phoneNumbers = FbAds::whereDate('created_at', request()->date ? Carbon::parse(request()->date) : Carbon::yesterday())
        // ->pluck('phone_number');

        // dd($orders);

        return view('admin.sms.phone_numbers', ['phoneNumbers' => $phoneNumbers]);
    }
}
