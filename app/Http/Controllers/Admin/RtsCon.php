<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\SoldFrom;
use App\PaymentMethod;
use App\Rts;
use App\RtsProducts;
use App\Http\Requests\RTS\StoreReturnRequest;
use Illuminate\Support\Str;

class RtsCon extends Controller
{

    public function __construct(Product $products) {
        $this->products = $products;
    }

    public function index(Request $request){
        $rts = Rts::when($request->search, function($q){
            return $q->where('transaction_id', 'like', '%'.request()->search.'%');
        })->when($request->sort, function($q){
            return $q->orderBy('created_at', request()->sort);
        })->get();

        $rts_count = Rts::count();
        $potential_profit = RtsProducts::sum('potential_profit');
        $total_good_items = RtsProducts::where('condition', 'good')->count('potential_profit');
        $total_damaged_items = RtsProducts::where('condition', 'damaged')->count('potential_profit');

        

        return view('admin.return.index', [
            'return' => $rts,
            'rts_count' => $rts_count,
            'potential_profit' => $potential_profit,
            'total_good_items' => $total_good_items,
            'total_damaged_items' => $total_damaged_items,
        ]);
    }

    public function create(){
        $products = $this->products->active()->with(array('images' => function($query){
                $query->where('primary', 1);
            })
        )->latest()->get();

        $payment_method = PaymentMethod::all();
        $sold_from = SoldFrom::all();

        return view('admin.return.create', [
            'products' => $products,
            'sold_from' => $sold_from,
            'payment_method' => $payment_method
        ]);
    }

    public function store(StoreReturnRequest $request){

        $rts = Rts::create([
            'transaction_id' => $request->transaction_id,
            'status' => $request->status,
            'platform' => $request->platform,
            'store' => $request->store,
            'courier' => $request->courier,
            'pouch_size' => $request->pouch_size,
            'comment' => $request->comment,
        ]);

        foreach ($request->products as $product) {
            $get_product = Product::find($product['product_id']);

            $rts->products()->create([
                'product_id' => $product['product_id'],
                'capital' => $get_product->price,
                'selling_price' => $get_product->selling_price,
                'potential_profit' => ($get_product->selling_price - $get_product->price),
                'condition' => $product['condition'],
            ]);

            if ($product['condition'] == 'good') {
                $get_product->update(['qty' => ($get_product->qty + 1)]);
            } // if product is in good condition add to stocks
        }

        return response()->json(['status' => true]);
    }
}
