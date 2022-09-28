<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\WishList;
use Illuminate\Support\Facades\DB;

class WishListCon extends Controller
{
    public function create($product_id){
        $check = WishList::where([
            'product_id' => $product_id,
            'user_id' => auth()->user()->id,
        ]);

        if ($check->exists()) {
            $check->delete();
            return 1;
        }// delete

        WishList::create([
            'product_id' => $product_id,
            'user_id' => auth()->user()->id,
        ]);// create
    }
}
