<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\FormulationIngredients;
use App\LabPurchaseIngredient;
use App\IngredientStock;
use App\Ingredients;
use App\Formulation;
use App\LabPurchase;
use App\Suppliers;
use Carbon\Carbon;

class LabCon extends Controller
{
    public function index(){
        $ingredients  = Ingredients::all();

        return view('admin.lab.index', compact('ingredients'));
    }

    public function inventory(){
        $ingredients = Ingredients::with('stock')->get();

        $totalStockValue = 0;

        $inventory = $ingredients->map(function ($ingredient) use (&$totalStockValue) {
            $weight = $ingredient->stock->total_weight ?? 0;
            $pricePerGram = $ingredient->price_per_grams ?? 0;
            $totalValue = $weight * $pricePerGram;

            $totalStockValue += $totalValue;

            return [
                'name'             => $ingredient->name,
                'price'            => $ingredient->price,
                'weight'           => $weight,
                'price_per_grams'  => $pricePerGram,
                'total_value'      => round($totalValue, 2),
            ];
        });

        // Optional: round the grand total
        $totalStockValue = round($totalStockValue, 2);

        return view('admin.lab.inventory', compact('inventory', 'totalStockValue'));
    }

    public function chemicals(){
        $ingredients  = Ingredients::all();

        return view('admin.lab.chemicals', compact('ingredients'));
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
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();
        $purchases = LabPurchase::with(['supplierInfo', 'ingredients.ingredient'])->get();

        return view('admin.lab.purchase.index', compact('purchases', 'suppliers'));
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
            $weight = cleanFloatNumber($item['weight']);
            $qty = (int) $item['qty'];

            LabPurchaseIngredient::create([
                'lab_purchase_id' => $labPurchase->id,
                'ingredient_id'   => $item['ingredient_id'],
                'price'           => cleanFloatNumber($item['price']),
                'weight'          => $weight,
                'qty'             => $qty,
                'sub_total'       => cleanFloatNumber($item['sub_total']),
            ]);

            // Update inventory stock by adding the weight
            $stock = IngredientStock::where('ingredient_id', $item['ingredient_id'])->first();

            if ($stock) {
                // Add to existing stock
                $stock->increment('total_weight', ($weight * $qty));
            } else {
                // Create new stock record
                IngredientStock::create([
                    'ingredient_id' => $item['ingredient_id'],
                    'total_weight' => ($weight * $qty)
                ]);
            }
        }

        return response()->json([
            'message' => 'Lab Purchase and Ingredients saved successfully!',
            'purchase_id' => $labPurchase->id
        ], 200);
    }

    public function purchase_update($id){
        $purchase = LabPurchase::where('id', $id)->with('ingredients.ingredient')->first();
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.lab.purchase.update', compact("suppliers", "ingredients", "purchase"));
    }

    public function purchase_patch(Request $request){
        DB::beginTransaction();

        try {
            $labPurchase = LabPurchase::findOrFail($request->id);

            // 1. Revert OLD weights from inventory
            $oldItems = LabPurchaseIngredient::where('lab_purchase_id', $labPurchase->id)->get();
            foreach ($oldItems as $oldItem) {
                $oldTotalWeight = $oldItem->weight * $oldItem->qty;
                $stock = IngredientStock::where('ingredient_id', $oldItem->ingredient_id)->first();
                if ($stock) {
                    $stock->decrement('total_weight', $oldTotalWeight);
                }
            }

            // 2. Update LabPurchase
            $labPurchase->update([
                'supplier'        => $request->supplier,
                'shipping_fee'    => cleanFloatNumber($request->shipping_fee),
                'tax'             => cleanFloatNumber($request->tax),
                'total_price'     => cleanFloatNumber($request->total_price),
                'total_qty'       => cleanFloatNumber($request->total_qty),
                'transaction_fee' => cleanFloatNumber($request->transaction_fee),
                'date'            => Carbon::parse($request->date)->format('Y-m-d'),
            ]);

            // 3. Delete all old ingredients (reset)
            LabPurchaseIngredient::where('lab_purchase_id', $labPurchase->id)->delete();

            // 4. Re-insert ingredients and update inventory stock
            foreach ($request->ingredients as $item) {
                $weight = cleanFloatNumber($item['weight']);
                $qty = (int) $item['qty'];
                $totalWeight = $weight * $qty;

                // Save new ingredient row
                LabPurchaseIngredient::create([
                    'lab_purchase_id' => $labPurchase->id,
                    'ingredient_id'   => $item['ingredient_id'],
                    'price'           => cleanFloatNumber($item['price']),
                    'weight'          => $weight,
                    'qty'             => $qty,
                    'sub_total'       => cleanFloatNumber($item['sub_total']),
                ]);

                // Update or create stock
                $stock = IngredientStock::where('ingredient_id', $item['ingredient_id'])->first();
                if ($stock) {
                    $stock->increment('total_weight', $totalWeight);
                } else {
                    IngredientStock::create([
                        'ingredient_id' => $item['ingredient_id'],
                        'total_weight'  => $totalWeight,
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'message' => 'Lab purchase and ingredients updated successfully.'
            ], 200);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Update failed: ' . $e->getMessage()
            ], 500);
        }
    }

    public function formulations(){
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();
        $purchases = LabPurchase::with(['supplierInfo', 'ingredients.ingredient'])->get();

        return view('admin.lab.formulations.index', compact('purchases', 'suppliers'));
    }

    public function formulation_create(){
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.lab.formulations.create', compact('ingredients', 'suppliers'));
    }
    
    public function formulation_store(Request $request){
        $formulation = Formulation::create([
            'product_name' => $request->product_name ?? 'Untitled Formula'
        ]);

        // 2. Save ingredients with given percentages
        foreach ($request->ingredients as $item) {
            FormulationIngredients::create([
                'formulation_id' => $formulation->id,
                'ingredient_id' => $item['ingredient_id'],
                'percentage' => round((float) $item['percentage'], 2)
            ]);
        }

        return response()->json([
            'message' => 'Formulation saved successfully.',
            'formulation_id' => $formulation->id
        ], 201);

    }


}

