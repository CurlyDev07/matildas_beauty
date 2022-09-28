<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;

class InventoryCon extends Controller
{
    public function index(Request $request){
        $products = Product::with(array('images' => function($query){
                $query->where(['primary' => 1, 'size' => 'small']);
            })
        )
        ->when($request->sort, function($query){
            return $query->orderBy('id', request()->sort);
        })// sort
        ->when($request->search, function($query){
            return $query->where('sku', 'like', '%'.request()->search.'%')
            ->orWhere('title', 'like', '%'.request()->search.'%');
        })// search
        ->oldest('qty')->paginate(20);
            
        return view('admin.inventory.index', compact('products'));
    }
}
