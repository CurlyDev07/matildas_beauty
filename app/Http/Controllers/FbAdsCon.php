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
            "product" => 'Bulb Holder',
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
        ];

        return response()->json($data);
        // return redirect()->route('madella_success', $data);
    }

    public function success(){
        $data = request()->all();

        return view('pages.fbads.category.home_improvements.bulb.order_success', ['data' => $data]);
    }

    public function madella_order_success_email(){

        Mail::to(['reggie.frias1105@gmail.com', 'shopickers007@gmail.com'])->send(new FbAdsOrderSuccess(request()->data));
        $order_promo = request()->data['promo'];

$sms = "
Hi ". request()->data['full_name'].",
This is from Smart Light PH

Ung Automaic On/OFF na Light Bulb Holder po.

We've recieved your order. Thank you!

Order Details: ".$order_promo."
Total: ₱" .request()->data['amount']."

Reminder:
-> Strictly no cancellation
-> Warranty: 6 Months
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



