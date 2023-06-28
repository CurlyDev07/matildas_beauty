<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\Barangay;
use App\FbAds;
use App\Http\Requests\FbAds\StoreFbAdsRequest;

class FbAdsCon extends Controller
{

    public function index(){
        $provinces = Province::orderBy('province', 'asc')->pluck('province');
        $seo = [
            'title' => "Kasoy Oil Warts Remover",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "Kasoy Oil Warts Remover",
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
            "province" => $request->province,
            "city" => $request->city,
            "barangay" => $request->barangay,
            "promo" => $promo[0],
            "total" => $promo[1],
            "product" => 'Kasoy Oil',
        ]);
        
        // return redirect()->back(['a'=>'s'])->with('success', 'Success');
        return redirect()->route('kasoy_oil', ['purchase' => 1])->with('success', 'Success');

    }

    public function cities(Request $request){
        return json_encode(City::select('city')->orderBy('city', 'asc')->where('province', $request->province)->get());
    }
   
    public function barangay(Request $request){
        return json_encode(Barangay::select('barangay')->orderBy('barangay', 'asc')->where('city', $request->city)->get());
    }

}



