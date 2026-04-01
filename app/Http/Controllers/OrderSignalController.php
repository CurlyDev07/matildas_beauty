<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\OrderSignal;

class OrderSignalController extends Controller
{
    public function store(Request $request)
    {
        $ip = $request->header('CF-Connecting-IP') ?? $request->ip();

        try {

            $signal = OrderSignal::create([
                'fb_ads_id' => $request->input('fb_ads_id'),
                'website' => $request->input('website'),
                'session_id' => $request->input('session_id'),
                'local_session_id' => $request->input('local_session_id'),
                'fingerprint' => $request->input('fingerprint'),
                'fingerprintjs_visitor_id' => $request->input('fingerprintjs_visitor_id'),

                'full_name' => $request->input('full_name'),
                'phone_number' => $request->input('phone_number'),

                'promo' => $request->input('promo'),

                'fbclid' => $request->input('fbclid'),
                'utm_campaign' => $request->input('utm_campaign'),
                'utm_content' => $request->input('utm_content'),
                'utm_medium' => $request->input('utm_medium'),

                'device_type' => $request->input('device_type'),
                'user_agent' => $request->input('user_agent'),

                'timestamp' => $request->input('timestamp'),
                'ip_address' => $ip   
            ]);

            return response()->json([
                'status' => true,
                'id' => $signal->id
            ]);

        } catch (\Exception $e) {

            return response()->json([
                'status' => false,
                'error' => $e->getMessage()
            ]);
        }
    }
}
