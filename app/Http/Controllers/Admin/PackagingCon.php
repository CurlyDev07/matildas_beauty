<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\PackagingMaterial;
use App\PackagingInventory;
use App\PackagingPurchase;
use App\PackagingPurchaseItem;
use App\PackagingStockOut;
use App\PackagingStockOutItem;
use App\Suppliers;
use Carbon\Carbon;

class PackagingCon extends Controller
{
    // ---------------------------------------------------------------
    // MATERIALS
    // ---------------------------------------------------------------

    public function materials()
    {
        $materials = PackagingMaterial::with('inventory')->get();

        return view('admin.packaging.materials.index', compact('materials'));
    }

    public function materials_create()
    {
        return view('admin.packaging.materials.create');
    }

    public function materials_store(Request $request)
    {
        $request->validate([
            'name'          => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'unit'          => 'nullable|string|max:100',
            'cost_per_unit' => 'nullable|numeric',
            'image'         => 'nullable|image|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $file     = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/packaging'), $filename);
            $imagePath = 'images/packaging/' . $filename;
        }

        PackagingMaterial::create([
            'name'          => $request->name,
            'category'      => $request->category,
            'unit'          => $request->unit,
            'cost_per_unit' => $request->cost_per_unit,
            'image'         => $imagePath,
        ]);

        return redirect()->route('packaging.materials')->with('success', 'Material added.');
    }

    public function materials_edit($id)
    {
        $material = PackagingMaterial::findOrFail($id);

        return view('admin.packaging.materials.edit', compact('material'));
    }

    public function materials_patch(Request $request)
    {
        $request->validate([
            'id'            => 'required|integer',
            'name'          => 'required|string|max:255',
            'category'      => 'nullable|string|max:255',
            'unit'          => 'nullable|string|max:100',
            'cost_per_unit' => 'nullable|numeric',
            'image'         => 'nullable|image|max:2048',
        ]);

        $material = PackagingMaterial::findOrFail($request->id);

        $imagePath = $material->image;

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($material->image && file_exists(public_path($material->image))) {
                unlink(public_path($material->image));
            }
            $file      = $request->file('image');
            $filename  = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/packaging'), $filename);
            $imagePath = 'images/packaging/' . $filename;
        }

        $material->update([
            'name'          => $request->name,
            'category'      => $request->category,
            'unit'          => $request->unit,
            'cost_per_unit' => $request->cost_per_unit,
            'image'         => $imagePath,
        ]);

        return redirect()->route('packaging.materials')->with('success', 'Material updated.');
    }

    public function materials_delete(Request $request)
    {
        $material = PackagingMaterial::findOrFail($request->id);

        if ($material->image && file_exists(public_path($material->image))) {
            unlink(public_path($material->image));
        }

        $material->delete();

        return redirect()->route('packaging.materials')->with('success', 'Material deleted.');
    }

    // ---------------------------------------------------------------
    // INVENTORY
    // ---------------------------------------------------------------

    public function inventory()
    {
        $materials = PackagingMaterial::with('inventory')->get();

        $totalValue = $materials->sum(function ($m) {
            $qty  = $m->inventory->quantity ?? 0;
            $cost = $m->cost_per_unit ?? 0;
            return $qty * $cost;
        });

        return view('admin.packaging.inventory', compact('materials', 'totalValue'));
    }

    public function inventory_manual_change(Request $request)
    {
        $request->validate([
            'material_id' => 'required|integer',
            'quantity'    => 'required|numeric|min:0',
        ]);

        $inv = PackagingInventory::where('packaging_material_id', $request->material_id)->first();

        if ($inv) {
            $inv->quantity = $request->quantity;
            $inv->save();
        } else {
            PackagingInventory::create([
                'packaging_material_id' => $request->material_id,
                'quantity'              => $request->quantity,
            ]);
            $inv = PackagingInventory::where('packaging_material_id', $request->material_id)->first();
        }

        return response()->json([
            'success'      => true,
            'new_quantity' => $inv->quantity,
        ]);
    }

    // ---------------------------------------------------------------
    // PURCHASES
    // ---------------------------------------------------------------

    public function purchases()
    {
        $purchases = PackagingPurchase::with(['supplier', 'items'])->orderBy('purchase_date', 'desc')->get();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.packaging.purchases.index', compact('purchases', 'suppliers'));
    }

    public function purchases_create()
    {
        $materials = PackagingMaterial::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        return view('admin.packaging.purchases.create', compact('materials', 'suppliers'));
    }

    public function purchases_store(Request $request)
    {
        DB::beginTransaction();

        try {
            $purchase = PackagingPurchase::create([
                'supplier_id'   => $request->supplier_id ?: null,
                'purchase_date' => Carbon::parse($request->purchase_date)->format('Y-m-d'),
                'tax'           => $request->tax ?? 0,
                'shipping_fee'  => $request->shipping_fee ?? 0,
                'total_cost'    => $request->total_cost ?? 0,
            ]);

            foreach ($request->items as $item) {
                $qty      = (float) $item['quantity'];
                $unitCost = (float) $item['unit_cost'];
                $total    = round($qty * $unitCost, 2);

                PackagingPurchaseItem::create([
                    'purchase_id'           => $purchase->id,
                    'packaging_material_id' => $item['material_id'],
                    'quantity'              => $qty,
                    'unit_cost'             => $unitCost,
                    'total_cost'            => $total,
                ]);

                // Update inventory stock
                $inv = PackagingInventory::where('packaging_material_id', $item['material_id'])->first();

                if ($inv) {
                    $inv->increment('quantity', $qty);
                } else {
                    PackagingInventory::create([
                        'packaging_material_id' => $item['material_id'],
                        'quantity'              => $qty,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'purchase_id' => $purchase->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function purchases_view($id)
    {
        $purchase = PackagingPurchase::with(['supplier', 'items.material'])->findOrFail($id);

        return view('admin.packaging.purchases.view', compact('purchase'));
    }

    public function purchases_edit($id)
    {
        $purchase  = PackagingPurchase::with(['supplier', 'items.material'])->findOrFail($id);
        $materials = PackagingMaterial::all();
        $suppliers = Suppliers::select('id', 'name', 'surname')->get();

        $existingItems = $purchase->items->map(function ($item) {
            return [
                'material_id' => $item->packaging_material_id,
                'name'        => $item->material ? $item->material->name : 'Unknown',
                'unit'        => $item->material ? $item->material->unit : '',
                'image'       => $item->material && $item->material->image ? asset($item->material->image) : '',
                'quantity'    => (float) $item->quantity,
                'unit_cost'   => (float) $item->unit_cost,
                'total_cost'  => (float) $item->total_cost,
            ];
        })->values();

        return view('admin.packaging.purchases.edit', compact('purchase', 'materials', 'suppliers', 'existingItems'));
    }

    public function purchases_patch(Request $request)
    {
        DB::beginTransaction();

        try {
            $purchase = PackagingPurchase::findOrFail($request->id);

            // 1. Revert old item quantities from inventory
            $oldItems = PackagingPurchaseItem::where('purchase_id', $purchase->id)->get();
            foreach ($oldItems as $oldItem) {
                $inv = PackagingInventory::where('packaging_material_id', $oldItem->packaging_material_id)->first();
                if ($inv) {
                    $inv->decrement('quantity', $oldItem->quantity);
                }
            }

            // 2. Update purchase header
            $purchase->update([
                'supplier_id'   => $request->supplier_id ?: null,
                'purchase_date' => Carbon::parse($request->purchase_date)->format('Y-m-d'),
                'tax'           => $request->tax ?? 0,
                'shipping_fee'  => $request->shipping_fee ?? 0,
                'total_cost'    => $request->total_cost ?? 0,
            ]);

            // 3. Delete old items
            PackagingPurchaseItem::where('purchase_id', $purchase->id)->delete();

            // 4. Insert new items and update inventory
            foreach ($request->items as $item) {
                $qty      = (float) $item['quantity'];
                $unitCost = (float) $item['unit_cost'];
                $total    = round($qty * $unitCost, 2);

                PackagingPurchaseItem::create([
                    'purchase_id'           => $purchase->id,
                    'packaging_material_id' => $item['material_id'],
                    'quantity'              => $qty,
                    'unit_cost'             => $unitCost,
                    'total_cost'            => $total,
                ]);

                $inv = PackagingInventory::where('packaging_material_id', $item['material_id'])->first();
                if ($inv) {
                    $inv->increment('quantity', $qty);
                } else {
                    PackagingInventory::create([
                        'packaging_material_id' => $item['material_id'],
                        'quantity'              => $qty,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    // ---------------------------------------------------------------
    // STOCK OUT
    // ---------------------------------------------------------------

    public function stock_out_index()
    {
        $stockOuts = PackagingStockOut::with('items')->orderBy('date', 'desc')->get();

        return view('admin.packaging.stock_out.index', compact('stockOuts'));
    }

    public function stock_out_create()
    {
        $materials = PackagingMaterial::with('inventory')->get();

        return view('admin.packaging.stock_out.create', compact('materials'));
    }

    public function stock_out_store(Request $request)
    {
        DB::beginTransaction();

        try {
            $stockOut = PackagingStockOut::create([
                'reference' => $request->reference ?: null,
                'notes'     => $request->notes ?: null,
                'date'      => Carbon::parse($request->date)->format('Y-m-d'),
            ]);

            foreach ($request->items as $item) {
                $qty = (float) $item['quantity'];

                PackagingStockOutItem::create([
                    'stock_out_id'          => $stockOut->id,
                    'packaging_material_id' => $item['material_id'],
                    'quantity'              => $qty,
                ]);

                // Deduct from inventory
                $inv = PackagingInventory::where('packaging_material_id', $item['material_id'])->first();
                if ($inv) {
                    $inv->quantity = $inv->quantity - $qty; // allow negative (same as lab pattern)
                    $inv->save();
                } else {
                    PackagingInventory::create([
                        'packaging_material_id' => $item['material_id'],
                        'quantity'              => -$qty,
                    ]);
                }
            }

            DB::commit();

            return response()->json(['success' => true, 'stock_out_id' => $stockOut->id]);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['success' => false, 'error' => $e->getMessage()], 500);
        }
    }

    public function stock_out_view($id)
    {
        $stockOut = PackagingStockOut::with('items.material')->findOrFail($id);

        return view('admin.packaging.stock_out.view', compact('stockOut'));
    }
    // ---------------------------------------------------------------
    // MOVEMENTS
    // ---------------------------------------------------------------

    public function movements()
    {
        $purchases = PackagingPurchase::with(['items.material', 'supplier'])
            ->orderBy('purchase_date', 'desc')
            ->get()
            ->map(function ($p) {
                return [
                    'type'  => 'stock_in',
                    'date'  => $p->purchase_date,
                    'ref'   => 'Purchase #' . $p->id,
                    'notes' => $p->supplier ? $p->supplier->name . ' ' . $p->supplier->surname : null,
                    'items' => $p->items->map(function ($i) {
                        return [
                            'name' => $i->material ? $i->material->name : 'Unknown',
                            'unit' => $i->material ? $i->material->unit : '',
                            'qty'  => $i->quantity,
                        ];
                    })->toArray(),
                ];
            });

        $stockOuts = PackagingStockOut::with('items.material')
            ->orderBy('date', 'desc')
            ->get()
            ->map(function ($s) {
                return [
                    'type'  => 'stock_out',
                    'date'  => $s->date,
                    'ref'   => $s->reference ?: null,
                    'notes' => $s->notes,
                    'items' => $s->items->map(function ($i) {
                        return [
                            'name' => $i->material ? $i->material->name : 'Unknown',
                            'unit' => $i->material ? $i->material->unit : '',
                            'qty'  => $i->quantity,
                        ];
                    })->toArray(),
                ];
            });

        $movements = $purchases->concat($stockOuts)
            ->sortByDesc('date')
            ->values();

        return view('admin.packaging.movements', compact('movements'));
    }
}