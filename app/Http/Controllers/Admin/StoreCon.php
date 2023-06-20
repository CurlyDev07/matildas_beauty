<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Store;
use App\Http\Requests\Stores\StoreStoreRequest;

class StoreCon extends Controller
{
    public function index(){
        $stores = Store::all();

        return view('admin.stores.index', ['stores' => $stores]);
    }

    public function create(){
        return view('admin.stores.create');
    }

    public function store(StoreStoreRequest $request){
        Store::create($request->all());
        return request()->all();
    }

    public function update($id){
        $platforms = ['shopee', 'lazada', 'tiktok', 'fb'];
        $store = Store::find($id);

        return view('admin.stores.update', ['store' => $store, 'platforms' => $platforms]);
    }

    public function patch(StoreStoreRequest $request){
        $store = Store::find($request->id);
        $store->update([
            'platform' => $request->platform,
            'store_name' => $request->store_name,
            'username' => $request->username,
        ]);

        return redirect()->route('store.index');
    }

}
