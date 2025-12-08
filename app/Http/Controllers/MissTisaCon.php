<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Province;
use App\City;
use App\Barangay;
use App\FbAds;
use App\FbAdsProduct;
use App\FbEventListener;
use App\FbAdsUpsell;
use App\Http\Requests\FbAds\StoreFbAdsRequest;
use GuzzleHttp\Client;
use App\Services\FacebookCapi;
use Illuminate\Support\Str;
class MissTisaCon extends Controller
{

    public function index(){
        $session_id = uuid();
        $website = 'MissTisa';

        $provinces = [];
        $fbads_products = FbAdsProduct::select('id', 'sku', 'product_name', 'price', 'slashed_price', 'image1', 'discount_tag', 'promo_line1')->get();

        $seo = [
            'title' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'robots' => 'none',
        ];

        return view('pages.misstisa.index', ['fbads_products' => $fbads_products, 'seo' => $seo, 'provinces' => $provinces, 'session_id' => $session_id, 'website' => $website]);
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

    public function lotion(){
        $session_id = uuid();
        $website = 'MissTisa';

        $seo = [
            'title' => "MissTisa Lotion 100g SPF PA++++",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'robots' => 'none',
        ];

        return view('pages.misstisa.lotion', ['seo' => $seo, 'session_id' => $session_id, 'website' => $website]);
    }

    public function melasma(){
        $session_id = uuid();
        $website = 'MissTisa';

        $provinces = [];
        $fbads_products = FbAdsProduct::select('id', 'sku', 'product_name', 'price', 'slashed_price', 'image1', 'discount_tag', 'promo_line1')->get();

        $seo = [
            'title' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'image' => 'https://cdn.pancake.vn/1/s1500x950/fwebp/a1/f1/28/bf/c2c8c32fdae997c5e50d5a204c5d8a48e55551144b88e41087e698c0.png',
            'description' => "MissTisa Melasma Remover Rejuvenating Skincare Set",
            'robots' => 'none',
        ];

        return view('pages.misstisa.melasma', ['fbads_products' => $fbads_products, 'seo' => $seo, 'provinces' => $provinces, 'session_id' => $session_id, 'website' => $website]);
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
            'purchase_event_id' => $purchaseEventId,
            'order_id' => $order->id
        ]);
    }

    public function success(){
        $session_id = uuid();
        $website = 'MissTisa';

        $data = request()->all();
        return view('pages.misstisa.order_success', ['data' => $data, 'session_id' => $session_id, 'website' => $website]);
    }

    public function upsellPurchase(Request $request, FacebookCapi $facebookCapi)
    {

        // 1) Basic validation
        $request->validate([
            'phone_number' => 'required|string',
            'upsell_total' => 'required|numeric',
        ]);

        // 2) Parse amount
        $upsellTotal = (float) $request->input('upsell_total');

        // Simple safety check: dapat positive lang
        if ($upsellTotal <= 0) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid upsell amount',
            ], 400);
        }

        // 3) Generate NEW event ID for this upsell only
        $upsellEventId = 'p_upsell_' . Str::uuid()->toString();

        // 4) Send CAPI Purchase for UPSell ONLY
        $facebookCapi->sendEvent('Purchase', $upsellEventId, $request, [
            'phone' => $request->input('phone_number'),
            'value' => $upsellTotal,
            // optional: external_id kung gusto mong i-link sa main order
            // 'external_id' => 'UPS-' . now()->format('YmdHis'),
        ]);

        // 2. Create the Upsell Record
        $upsell = FbAdsUpsell::create([
            'fb_ads_id'         => $request->order_id,
            'fb_ads_product_id' => $request->product_id,
            'product_name'      => $request->product_name, // Saving the name from the DB
            'amount'            => $request->upsell_total,
        ]);

        // 5) Return JSON so JS can fire Pixel with same eventID
        return response()->json([
            'success'                  => true,
            'upsell_total'             => $upsellTotal,
            'upsell_purchase_event_id' => $upsellEventId,
        ]);
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



