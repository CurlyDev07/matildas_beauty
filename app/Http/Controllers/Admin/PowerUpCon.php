<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\PowerUp;
use App\Http\Requests\PowerUp\PowerUpCreateRequest;

class PowerUpCon extends Controller
{
    public function index(){
        $power_up = PowerUp::all();

        return view('admin.power_up.index', ['power_up' => $power_up]);
    }
   
    public function create(){
        $stores = Store::all();

        return view('admin.power_up.create', ['stores' => $stores,]);
    }

    public function store(PowerUpCreateRequest $request){
        PowerUp::create([
            'user_id' => auth()->id(),
            'store_id'=> $request->store_id,
            'phone'=> $request->phone,
            'email'=> $request->email,
            'password'=> $request->password,
            'sf'=> $request->sf,
            'total'=> $request->total,
            'purchase_date'=> date_f($request->purchase_date, 'Y-m-d H:i:s'),
            'review_date'=> date_f($request->review_date, 'Y-m-d H:i:s'),
            'status'=> 'PENDING',
            'notes'=> 'N/A'
        ]);

        return redirect()->back()->with('success', 'Success');
    }
}

