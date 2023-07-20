<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\PowerUp;
use App\Http\Requests\PowerUp\PowerUpCreateRequest;
use Carbon\Carbon;

class PowerUpCon extends Controller
{
    public function index(Request $request){
        $stores = Store::all();

        $power_up = PowerUp::orderBy('created_at', 'desc')
        ->when(!$request->purchase_date && !$request->review_date, function($q){
            // dd('asdsad');
            return $q->whereBetween('created_at', [now()->subDays(6), now()]);
        })// Show DEFAULT DATA For the Past 7 Days

        ->when($request->purchase_date, function($q){
            $date = explode(" - ",request()->purchase_date);
            $from = date_format(date_create($date[0]), "Y-m-d");
            $to = date_format(date_create($date[1]),"Y-m-d");

            if ($from == $to) {
                return $q->whereDate('purchase_date', $from);
            }
            return $q->whereBetween('purchase_date', [$from, $to]);
        })// FILTER PURCHASE DATE

        ->when($request->review_date, function($q){
            $date = explode(" - ",request()->review_date);
            $from = date_format(date_create($date[0]), "Y-m-d");
            $to = date_format(date_create($date[1]),"Y-m-d");

            if ($from == $to) {
                return $q->whereDate('review_date', $from);
            }

            return $q->whereBetween('review_date', [$from, $to]);
        })// FILTER REVIEW DATE

        ->when($request->stores, function($q){
            return $q->where('store_id', request()->stores);
        })// Filter by stores
        ->paginate(100);

        return view('admin.power_up.index', ['power_up' => $power_up, 'stores' => $stores]);
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
            'status'=> 'Shipping',
            'notes'=> 'N/A'
        ]);

        return redirect()->back()->with('success', 'Success');
    }

    public function update(Request $request){
        $stores = Store::all();
        $powerup = PowerUp::find($request->id);
        return view('admin.power_up.update', ['stores' => $stores, 'powerup' => $powerup]);
    }

    public function patch(Request $request){
        $update = PowerUp::find($request->id);
        $update->update([
            'user_id' => auth()->id(),
            'store_id'=> $request->store_id,
            'phone'=> $request->phone,
            'email'=> $request->email,
            'password'=> $request->password,
            'sf'=> $request->sf,
            'total'=> $request->total,
            'purchase_date'=> date_f($request->purchase_date, 'Y-m-d H:i:s'),
            'review_date'=> date_f($request->review_date, 'Y-m-d H:i:s'),
            'status'=> 'Shipping',
            'notes'=> 'N/A'
        ]);

        return redirect()->back()->with('success', 'Success');
    }

    public function mark_as_reviewed(Request $request){
        $update = PowerUp::find($request->id)->update([
            'review_date' => date('Y-m-d'),
            'status' => 'Done',
        ]);
        return response(['success' => 'Success!']);
    }   

    public function duplicate(Request $request){
        $powerup = PowerUp::find($request->id);
        $duplicate = $powerup->replicate();
        $duplicate->created_at = Carbon::now();
        $duplicate->save();
        
        return redirect()->back()->with('duplicate', 'Success')->with('id', $duplicate->id);
    }   
}

