<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\FormulationIngredients;
use App\LabPurchaseIngredient;
use App\ProductionIngredient;
use App\IngredientStock;
use App\Ingredients;
use App\Formulation;
use App\LabPurchase;
use App\Suppliers;
use App\Production;
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

        // Insert ingredients
        foreach ($request->ingredients as $item) {
            $weight = cleanFloatNumber($item['weight']);
            $price = cleanFloatNumber($item['price']);
            $subTotal = round($price * $weight, 2); // 💡 Compute sub_total

            LabPurchaseIngredient::create([
                'lab_purchase_id' => $labPurchase->id,
                'ingredient_id'   => $item['ingredient_id'],
                'price'           => $price,
                'weight'          => $weight,
                'qty'             => null, // still optional
                'sub_total'       => $subTotal,
            ]);

            // Update inventory stock
            $stock = IngredientStock::where('ingredient_id', $item['ingredient_id'])->first();

            if ($stock) {
                $stock->increment('total_weight', $weight);
            } else {
                IngredientStock::create([
                    'ingredient_id' => $item['ingredient_id'],
                    'total_weight'  => $weight
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
                $stock = IngredientStock::where('ingredient_id', $oldItem->ingredient_id)->first();
                if ($stock) {
                    $stock->decrement('total_weight', $oldItem->weight);
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

            // 3. Delete old ingredient rows
            LabPurchaseIngredient::where('lab_purchase_id', $labPurchase->id)->delete();

            // 4. Insert new ingredients
            foreach ($request->ingredients as $item) {
                $weight = cleanFloatNumber($item['weight']);
                $price = cleanFloatNumber($item['price']);
                $subTotal = round($price * $weight, 2); // ✅ recompute

                LabPurchaseIngredient::create([
                    'lab_purchase_id' => $labPurchase->id,
                    'ingredient_id'   => $item['ingredient_id'],
                    'price'           => $price,
                    'weight'          => $weight,
                    'qty'             => null, // optional or remove from DB if unused
                    'sub_total'       => $subTotal,
                ]);

                // 5. Update inventory stock
                $stock = IngredientStock::where('ingredient_id', $item['ingredient_id'])->first();
                if ($stock) {
                    $stock->increment('total_weight', $weight);
                } else {
                    IngredientStock::create([
                        'ingredient_id' => $item['ingredient_id'],
                        'total_weight'  => $weight,
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
        $formulations = Formulation::with(['formulationIngredients.ingredient'])->get();

        return view('admin.lab.formulations.index', compact('formulations'));
    }

    public function formulation_create(){
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.lab.formulations.create', compact('ingredients', 'suppliers'));
    }

    public function formulation_update($id){
        $formulations = Formulation::where('id', $id)->with('formulationIngredients', 'formulationIngredients.ingredient')->first();
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.lab.formulations.update', compact('ingredients', 'suppliers', 'formulations'));
    }
    
    public function formulation_store(Request $request){
        $formulation = Formulation::create([
            'product_name' => $request->product_name ?? 'Untitled Formula',
            'net_content' => $request->net_content ?? 30
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

    public function formulation_patch(Request $request){
        $formulation = Formulation::where('id', request()->formulation_id)->update([
            'product_name' => $request->product_name ?? 'Untitled Formula',
            'net_content' => $request->net_content ?? 30
        ]);

        FormulationIngredients::where('formulation_id', request()->formulation_id)->delete();


        // 2. Save ingredients with given percentages
        foreach ($request->ingredients as $item) {
            FormulationIngredients::create([
                'formulation_id' => request()->formulation_id,
                'ingredient_id' => $item['ingredient_id'],      
                'percentage' => round((float) $item['percentage'], 2)
            ]);
        }

        return response()->json([
            'message' => 'Formulation saved successfully.',
            'formulation_id' => request()->formulation_id
        ], 201);

    }

    public function production_create(Request $request, $id){
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        $formulation = Formulation::with(['ingredients'])->findOrFail($id);


        return view('admin.lab.production.create', compact('ingredients', 'suppliers', 'formulation'));
    }

    public function production_update(Request $request, $id){
        $ingredients  = Ingredients::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        $production = Production::with(['ingredients', 'ingredients.ingredient'])->find($id);


        // dd($production);
        return view('admin.lab.production.update', compact('ingredients', 'suppliers', 'production'));
    }

    public function production_index(){
        $productions = Production::get();
        return view('admin.lab.production.index', compact('productions'));
    }

    public function production_show($id){
        $production = Production::with(['ingredients'])->find($id);

        return view('admin.lab.production.show', compact('production'));
    }

    public function production_store(Request $request){
        $data = $request->all();


        DB::beginTransaction();

        try {
            // Generate batch number (e.g., M3A9B2)
            $lastBatch = Production::orderBy('id', 'desc')->first();
            if ($lastBatch && preg_match('/^M(\d{4})$/', $lastBatch->batch_number, $matches)) {
                $nextNumber = (int) $matches[1] + 1;
            } else {
                $nextNumber = 1;
            }
            $batchNumber = 'M' . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);


            // Save production record
            $production = Production::create([
                'product_name'    => $data['product_name'],
                'total_weight'    => $data['total_weight'],
                'total_quantity'  => $data['total_quantity'],
                'total'           => $data['total'],
                'date'            => Carbon::parse($data['date']),
                'comment'         => $data['comment'] ?? null,
                'batch_number'    => $batchNumber,
            ]);

            foreach ($data['products'] as $product) {
                // Save production ingredient
                ProductionIngredient::create([
                    'production_id'            => $production->id,
                    'ingredient_id'             => $product['ingredient_id'],
                    'product_name'             => $product['product_name'],
                    'product_price_per_grams'  => $product['product_price_per_grams'],
                    'product_percentage'       => $product['product_percentage'],
                    'grams'                    => $product['grams'],
                    'price'                    => $product['price'],
                ]);

                // Deduct stock from ingredient_stocks
            $ingredient = Ingredients::where('name', $product['product_name'])->first();

                if ($ingredient) {
                    $stock = IngredientStock::firstOrNew(['ingredient_id' => $ingredient->id]);
                    $stock->total_weight = $stock->total_weight - $product['grams']; // Allow negative value
                    $stock->save();
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'batch_number' => $batchNumber]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }
}

