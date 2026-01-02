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
use GuzzleHttp\Client;
use App\Services\FacebookCapiTallow;
use Illuminate\Support\Str;


class TallowCapiCon extends Controller
{

    public function index(){
        $session_id = uuid();
        $website = 'BeefTallow';

        $provinces = [];

        $seo = [
            'title' => "Premium Beef Tallow",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "Premium Beef Tallow",
            'robots' => 'none',
        ];

        return view('pages.other_page.beef_tallow', ['seo' => $seo, 'provinces' => $provinces, 'session_id' => $session_id, 'website' => $website]);
    }

    public function storeTallow(Request $request, FacebookCapiTallow $facebookCapiTallow){
        $form_request = $request->all();
        $ordered_products = $form_request['products'];
        $promo = '';
        $total = 0;

        foreach ($ordered_products as $product) {
            if ($promo !== '') {
                $promo .= ' + ';
            } 
            $promo .= $product['qty'] .' - '.$product['name'];
            $total += $product['subtotal'];
        }

        $order = FbAds::create([
            "full_name" => $form_request['customer']['full_name'],
            "phone_number" => $form_request['customer']['phone_number'],
            "address" => $form_request['customer']['address'],
            "province" => 'n/a',
            "city" => 'n/a',
            "barangay" => 'n/a',
            "promo" => $promo,
            "total" => $total,
            "product" => 'BeefTallow',
        ]);

        $data = [
            "purchase" => 1,
            "promo" => request()->promo,
            "amount" => $total,
            "full_name" => $request->full_name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "order_number" => 'MB'.date("mdy").'O'.$order->id,
        ]; /// NOT USED


        // ========================= FOR CAPI  =========================
        // FIRE SERVER-SIDE PURCHASE
        $purchaseEventId = 'p_' . Str::uuid()->toString();

        $log = [
            'pixel' => config('services.facebook_capi_tallow.pixel_id_tallow'),
            'total' => $total,
            'event_id' => $purchaseEventId,
            'pixel_id' => $facebookCapiTallow->getPixelId(),
            'getAccessToken' => $facebookCapiTallow->getAccessToken(),
            'getCurrency' => $facebookCapiTallow->getCurrency(),

        ];

        if ($total < 3000) {
             $facebookCapiTallow->sendEvent('Purchase', $purchaseEventId, $request, [
                'phone'       => $request->phone_number,
                'value'       => $total,
                'external_id' => 'MB'.date("mdy").'O'.$order->id, // your External ID
            ]);
        }
        // ========================= FOR CAPI  =========================

        
        // Return success response
        return response()->json([
            'success' => true,
            'message' => 'Order submitted successfully!',
            'customer' => $form_request['customer']['full_name'],
            'promo' => $promo,
            'total' => $total,
            'contact_number' => $form_request['customer']['phone_number'],
            'purchase_event_id' => $purchaseEventId,
            'log' => $log
        ]);
    }

}
