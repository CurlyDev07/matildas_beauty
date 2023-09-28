<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\Barangay;
use App\FbAds;
use App\FbEventListener;
use App\Http\Requests\FbAds\StoreFbAdsRequest;

class FbAdsCon extends Controller
{

    public function index(){
        $provinces = Province::orderBy('province', 'asc')->pluck('province');
        $seo = [
            'title' => "Ling Zhi Capsule #1 Pampataba",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "Ling Zhi Capsule #1 Pampataba",
            'robots' => 'none',
        ];

        return view('pages.fbads.index', ['seo' => $seo, 'provinces' => $provinces]);
    }

    public function store(StoreFbAdsRequest $request){
        $promo = explode ("|", $request->promo); 

        FbAds::create([
            "full_name" => $request->full_name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "province" => 'n/a',
            "city" => 'n/a',
            "barangay" => 'n/a',
            "promo" => $promo[0],
            "total" => $promo[1],
            "product" => 'Kasoy Oil',
        ]);
        
        // return redirect()->back(['a'=>'s'])->with('success', 'Success');
        return redirect()->route('kasoy_oil', ['purchase' => 1, 'amount' => $promo[1]])->with('success', 'Success');

    }

    public function cities(Request $request){
        return json_encode(City::select('city')->orderBy('city', 'asc')->where('province', $request->province)->get());
    }
   
    public function barangay(Request $request){
        return json_encode(Barangay::select('barangay')->orderBy('barangay', 'asc')->where('city', $request->city)->get());
    }

    public function event_listener(Request $request){
        if ($request->visitors) {
            FbEventListener::create([
                'data' => 'visitors',
                'value' => 1,
            ]);
        }
        if ($request->order_form) {
            FbEventListener::create([
                'data' => 'order_form',
                'value' => 1,
            ]);
        }
        if ($request->submit_order) {
            FbEventListener::create([
                'data' => 'submit_order',
                'value' => 1,
            ]);
        }

        if ($request->order_success) {
            FbEventListener::create([
                'data' => 'order_success',
                'value' => 1,
            ]);
        }
        
        if ($request->form_validation_error) {
            FbEventListener::create([
                'data' => 'form_validation_error',
                'value' => $request->form_validation_error,
            ]);
        }
        
        if ($request->full_name) {
            FbEventListener::create([
                'data' => 'full_name',
                'value' => $request->full_name,
            ]);
        }

        if ($request->phone_number) {
            FbEventListener::create([
                'data' => 'phone_number',
                'value' => $request->phone_number,
            ]);
        }

        if ($request->address) {
            FbEventListener::create([
                'data' => 'address',
                'value' => $request->address,
            ]);
        }
       
        if ($request->promo) {
            FbEventListener::create([
                'data' => 'promo',
                'value' => $request->promo,
            ]);
        }

        // FbEventListener::create([$data]);
        return $request->all();
    }

}



