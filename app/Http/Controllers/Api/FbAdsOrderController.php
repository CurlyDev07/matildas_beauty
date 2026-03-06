<?php

namespace App\Http\Controllers\Api;

use App\FbAds;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FbAdsOrderController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'    => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'address'      => 'required|string',
            'product'      => 'required|string|max:255',
            'promo'        => 'required|string|max:255',
            'total'        => 'required|numeric|min:0',
            'source_id'    => 'nullable|integer',
        ]);

        $order = FbAds::create($data + [
            'province' => '',
            'city'     => '',
            'barangay' => '',
        ]);

        return response()->json([
            'message'  => 'Order created',
            'order_id' => $order->id,
        ], 201);
    }
}
