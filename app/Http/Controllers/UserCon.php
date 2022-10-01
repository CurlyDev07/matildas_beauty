<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\User;
use App\WishList;
use App\Transaction;
use App\TransactionPayment;
use Illuminate\Support\Facades\DB;

class UserCon extends Controller
{
    public function dashboard(){
        $orders = auth()->user()->orders()->with([
            'payments',
            'products',
            'products.product:id,title',
            'products.product.images' => function($q){
                $q->select('product_id', 'img')->where('primary', 1);
            }
        ])->get()->toArray();

        $wishlists = WishList::where('user_id', auth()->user()->id)
        ->with([
            'products',
            'products.images' => function($query){
                $query->where('primary', 1);
            }
        ])->get()->toArray();

        $seo = [
            'title' => "",
            'image' => "",
            'description' => "",
            'robots' => 'none',
        ];

        return view('pages.user.dashboard', compact('orders', 'wishlists', 'seo'));
    }

    public function profile_update(Request $request){
        auth()->user()->update($request->all());
        return redirect()->back();
    }

    public function order_view($transaction_id){
        $orders = Transaction::where('id', $transaction_id)->with([
            'payments',
            'products',
            'products.product:id,title',
            'products.product.images' => function($q){
                $q->select('product_id', 'img')->where('primary', 1);
            }
        ])
        ->get()->toArray()[0];

        $seo = [
            'title' => "",
            'image' => "",
            'description' => "",
            'robots' => 'none',
        ];

        return view('pages.user.order_view', compact('orders', 'seo'));
    }
}
