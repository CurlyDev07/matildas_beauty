<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\FbAds;
use Carbon\Carbon;
use GuzzleHttp\Client;



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

        return view('admin.sms.phone_numbers', ['phoneNumbers' => $phoneNumbers]);
    }

    public function messages(){

        $client = new Client();
        $response = $client->request('GET', 'https://misstisa.com/api/get-sms-message');
        $messages = json_decode($response->getBody(), true);

        return view('admin.sms.messages', ['messages' => $messages['data']]);
    }

    public function message_edit($id){
        $client = new Client();
        $response = $client->request('GET', 'https://misstisa.com/api/get-single-sms-message/'.$id);
        $messages = json_decode($response->getBody(), true);

        return view('admin.sms.edit', ['message' => $messages['data']]);
    }


    public function follow_ups(){
        $client = new Client();
        $response = $client->request('GET', 'https://misstisa.com/api/get-customer-follow-up');
        $follow_ups = json_decode($response->getBody(), true);
        
        return view('admin.sms.follow_ups', ['follow_ups' => $follow_ups['data']]);
    }

    public function charts(Request $request){
      
            return view('admin.sms.charts');
    }
}
