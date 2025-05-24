<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\LabPurchaseIngredient;
use App\Ingredients;
use App\Suppliers;
use App\LabPurchase;
use Carbon\Carbon;

class LabCon extends Controller
{
    public function index(){
        $ingredients  = Ingredients::all();

        return view('admin.lab.index', compact('ingredients'));
    }
   
    public function create(Request $request){
       $validated = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'nullable|numeric',
            'weight' => 'nullable|numeric',
            'price_per_grams' => 'nullable|numeric',
            'note' => 'nullable|string',
        ]);

        // Save to database
        $insert = Ingredients::create($validated);

        // Redirect or return response
        return redirect()->route('lab.index');
    }

    public function update($id){
        $ingredient  = Ingredients::find($id);

        return view('admin.lab.update', compact('ingredient'));
    }

    public function patch(Request $request, $id){
            // Validate request
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'nullable|numeric',
                'weight' => 'nullable|numeric',
                'price_per_grams' => 'nullable|numeric',
                'note' => 'nullable|string',
            ]);

            // Find the ingredient by ID
            $ingredient = Ingredients::findOrFail($id);

            // Update the record
            $ingredient->update($validated);

            // Optional: redirect or return response
            return redirect()->route('lab.index');
    }

    public function purchase(){
        $purchases = LabPurchase::with(['ingredients.ingredient'])->get();

        return view('admin.lab.purchase.index', compact('purchases'));
    }

     public function purchase_create(){
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();
        return view('admin.lab.purchase.create', compact("ingredients", "suppliers"));
    }

    public function purchase_store(Request $request){

        // Clean and parse values
        $totalPrice = cleanFloatNumber($request->total_price);
        $totalQty = cleanFloatNumber($request->total_qty);
        $shippingFee = cleanFloatNumber($request->shipping_fee);
        $transactionFee = cleanFloatNumber($request->transaction_fee);
        $tax = cleanFloatNumber($request->tax);
        $date = Carbon::parse($request->date)->format('Y-m-d');

        // Insert into lab_purchases table
        $labPurchase = LabPurchase::create([
            'supplier'        => $request->supplier,
            'shipping_fee'    => $shippingFee,
            'tax'             => $tax,
            'total_price'     => $totalPrice,
            'total_qty'       => $totalQty,
            'transaction_fee' => $transactionFee,
            'date'            => $date,
        ]);

        // INSERT INGREDIENTS
        
        foreach ($request->ingredients as $item) {
            LabPurchaseIngredient::create([
                'lab_purchase_id' => $labPurchase->id,
                'ingredient_id'   => $item['ingredient_id'],
                'price'           => cleanFloatNumber($item['price']),
                'weight'          => cleanFloatNumber($item['weight']),
                'qty'             => (int) $item['qty'],
                'sub_total'       => cleanFloatNumber($item['sub_total']),
            ]);
        }

        return response()->json([
            'message' => 'Lab Purchase and Ingredients saved successfully!',
            'purchase_id' => $labPurchase->id
        ], 200);
    }
}

