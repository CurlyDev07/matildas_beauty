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
use Illuminate\Support\Facades\Mail;
use App\Mail\Transactions\FbAdsOrderSuccess;

class FbAdsCon extends Controller
{
    public function smart_home_ph(){
        return view('pages.fbads.category.home_improvements.bulb.index');
    }
    
    public function ginger_oil(){
        return view('pages.fbads.category.home_improvements.ginger_oil.index');
    }
   
    public function misstisa_melasma(){
        $title = 'MissTisa #1 Melasma Remover in the Philippines';
        $product_name = 'MissTisa Melasma';
        $notif_message = 'This is from MissTisa Melasma';
        $promos = [
            'promo1' => [
                'promo' => 'MissTisaMelasma_1_Set|499|1pc',
                'promo_text' => '1 Set MissTisa',
                'price' => 499,
                'each_price' => '499/each'
            ], 
            'promo2' => [
                'promo' => 'MissTisaMelasma_2_Set|849|2pcs',
                'promo_text' => '2 Set MissTisa',
                'price' => 849,
                'each_price' => '424/each'
            ], 
        ];


        return view('pages.fbads.category.home_improvements.misstisa_melasma.index', [
            'title' => $title, 
            'product_name' => $product_name, 
            'notif_message' => $notif_message, 
            'promos' => $promos, 
        ]);
    }

    public function store(StoreFbAdsRequest $request){

        $promo = explode ("|", $request->promo); 

        $order = FbAds::create([
            "full_name" => $request->full_name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "province" => 'n/a',
            "city" => 'n/a',
            "barangay" => 'n/a',
            "promo" => $promo[0],
            "total" => $promo[1],
            "product" => $request->product_name,
        ]);

        $data = [
            "purchase" => 1,
            "promo" => $promo[2],
            "amount" => $promo[1],
            "full_name" => $request->full_name,
            "phone_number" => $request->phone_number,
            "address" => $request->address,
            "order_number" => 'MB'.date("mdy").'O'.$order->id,
            "date" => date("F j g:i a"),
            "product" => $request->product_name,
            "notif_message" => $request->notif_message,
        ];

        return response()->json($data);
    }

    public function success(){
        $data = request()->all();

        return view('pages.fbads.category.home_improvements.bulb.order_success', ['data' => $data]);
    }

    public function madella_order_success_email(){

        // Mail::to(['reggie.frias1105@gmail.com', 'shopickers007@gmail.com'])->send(new FbAdsOrderSuccess(request()->data));
        $order_promo = request()->data['promo'];

$sms = "
Hi ". request()->data['full_name'].",
". request()->data['notif_message']."
We've recieved your order. Thank you!

Order Details: ".$order_promo." ".request()->data['product']."
Total: ₱" .request()->data['amount']."

=== Strictly no cancellation ===

-> Delivery: 
        Luzon: 3days
        Visayas: 5days
        Mindanao: 5-7days 

-> Always turn on your Mobile phone since dito po tatawag/text si J&T

For any questions, Message us her";

        infoTextSend(request()->data['phone_number'], $sms);
        infoTextSend('09550090156', 'New Order '. request()->data['amount']);
    
        return redirect()->back()->with('success');
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



