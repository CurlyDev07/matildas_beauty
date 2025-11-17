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
use App\Services\FacebookCapi;
use Illuminate\Support\Str;
class MissTisaCon extends Controller
{

    public function index(){
        $session_id = uuid();
        $website = 'MissTisa';

        $provinces = Province::orderBy('province', 'asc')->pluck('province');
        $seo = [
            'title' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'robots' => 'none',
        ];

        return view('pages.misstisa.index', ['seo' => $seo, 'provinces' => $provinces, 'session_id' => $session_id, 'website' => $website]);
    }

    public function b1t1(){
        $session_id = uuid();
        $website = 'MissTisa';

        $provinces = Province::orderBy('province', 'asc')->pluck('province');
        $seo = [
            'title' => "MissTisa Melasma Remover Skincare Set",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'robots' => 'none',
        ];

        return view('pages.misstisa.buy1_take1', ['seo' => $seo, 'provinces' => $provinces, 'session_id' => $session_id, 'website' => $website]);
    }

    public function misstisa_promo(){
        $session_id = uuid();
        $website = 'MissTisa';

        $provinces = Province::orderBy('province', 'asc')->pluck('province');
        $seo = [
            'title' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'robots' => 'none',
        ];

        return view('pages.misstisa.promo', ['seo' => $seo, 'provinces' => $provinces, 'session_id' => $session_id, 'website' => $website]);
    }

    public function store(Request $request, FacebookCapi $facebookCapi){
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
            "product" => 'MissTisa',
        ]);

        $data = [
            "purchase" => 1,
            "promo" => request()->promo,
            "amount" => $total,
            "full_name" => $request->full_name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "order_number" => 'MB'.date("mdy").'O'.$order->id,
        ];


        // ========================= FOR CAPI  =========================
        // FIRE SERVER-SIDE PURCHASE
        $purchaseEventId = 'p_' . Str::uuid()->toString();
        
        if ($total < 3000) {
             $facebookCapi->sendEvent('Purchase', $purchaseEventId, $request, [
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
            'purchase_event_id' => $purchaseEventId
        ]);
    }

    public function success(){
        $session_id = uuid();
        $website = 'MissTisa';

        $data = request()->all();
        return view('pages.misstisa.order_success', ['data' => $data, 'session_id' => $session_id, 'website' => $website]);
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
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }
        if ($request->order_form) {
            FbEventListener::create([
                'data' => 'order_form',
                'value' => 1,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }
        if ($request->submit_order) {
            FbEventListener::create([
                'data' => 'submit_order',
                'value' => 1,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }

        if ($request->order_success) {
            FbEventListener::create([
                'data' => 'order_success',
                'value' => 1,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }
        
        if ($request->form_validation_error) {
            FbEventListener::create([
                'data' => 'form_validation_error',
                'value' => $request->form_validation_error,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }
        
        if ($request->full_name) {
            FbEventListener::create([
                'data' => 'full_name',
                'value' => $request->full_name,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }

        if ($request->phone_number) {
            FbEventListener::create([
                'data' => 'phone_number',
                'value' => $request->phone_number,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }

        if ($request->address) {
            FbEventListener::create([
                'data' => 'address',
                'value' => $request->address,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }
       
        if ($request->promo) {
            FbEventListener::create([
                'data' => 'promo',
                'value' => $request->promo,
                'website' => $request->website,
                'session_id' => $request->session_id,
            ]);
        }

        // FbEventListener::create([$data]);
        return $request->all();
    }

}



