<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\Withdrawal;
use App\Http\Requests\Withdrawal\WithdrawalCreateRequest;

class WithdrawalCon extends Controller
{
    
    public function index(){
        $withdrawal = Withdrawal::all();
        $stores = Store::all();

        return view('admin.withdrawal.index', ['stores' => $stores, 'withdrawal' => $withdrawal]);
    }

    public function create(){
        $stores = Store::all();

        return view('admin.withdrawal.create', ['stores' => $stores]);
    }
    
    public function store(WithdrawalCreateRequest $request){
        Withdrawal::create([
            'store_id' => $request->store_id,
            'date' => date_f($request->date, 'Y-m-d H:i:s'),
            'amount' => $request->amount,
            'status' => 'to_validate'
        ]);

        return redirect()->back()->with('success', 'Success');
    }

    public function status(Request $request){
        Withdrawal::find($request->id)->update(['status' => 'validated']);

        return response()->json(['success' => 'Success']);
    }
}
