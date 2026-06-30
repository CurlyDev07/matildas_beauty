<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\InventoryCategory;
use App\InventoryItem;
use App\InventoryMovement;
use App\InventoryMovementAudit;
use App\InventoryMovementType;
use App\InventorySetting;
use App\InventoryStatus;
use App\InventoryTag;
use App\InventoryUnit;
use App\Services\InventoryMovementService;
use App\WarehouseInventory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;
use Carbon\Carbon;
use InvalidArgumentException;

class WarehouseInventoryCon extends Controller
{
    protected $movementService;

    public function __construct(InventoryMovementService $movementService)
    {
        $this->movementService = $movementService;
    }

    public function dashboard()
    {
        $stockRows = WarehouseInventory::with(['item.category', 'item.unit', 'status'])->get();
        $totalCost = $stockRows->sum(function ($row) {
            return (float) $row->quantity * (float) optional($row->item)->cost;
        });
        $totalSelling = $stockRows->sum(function ($row) {
            return (float) $row->quantity * (float) optional($row->item)->selling_price;
        });
        $categoryValues = $stockRows->groupBy(function ($row) {
            return optional(optional($row->item)->category)->name ?: 'Uncategorized';
        })->map(function ($rows, $category) {
            return [
                'category' => $category,
                'total_cost_value' => $rows->sum(function ($row) {
                    return (float) $row->quantity * (float) optional($row->item)->cost;
                }),
            ];
        })->sortByDesc('total_cost_value')->take(6)->values();

        $lowStocks = WarehouseInventory::with(['item.unit', 'status'])
            ->whereColumn('quantity', '<=', 'reorder_level')
            ->orderBy('quantity')
            ->limit(10)
            ->get();

        return view('admin.warehouse_inventory.dashboard', [
            'totalCost' => $totalCost,
            'totalSelling' => $totalSelling,
            'potentialProfit' => $totalSelling - $totalCost,
            'lowStocks' => $lowStocks,
            'categoryValues' => $categoryValues,
            'itemCount' => InventoryItem::count(),
            'stockRowCount' => WarehouseInventory::count(),
            'movementCount' => InventoryMovement::count(),
            'lowStockCount' => WarehouseInventory::whereColumn('quantity', '<=', 'reorder_level')->count(),
            'recentMovements' => InventoryMovement::with(['item', 'movementType'])->latest()->limit(12)->get(),
        ]);
    }

    public function lookups($type)
    {
        if ($type === 'defaults') {
            $title = 'Inventory Defaults';
            $rows = collect();
            $categoryOptions = InventoryCategory::with('parent.parent')->orderBy('name')->get();
            $defaultCategoryId = $this->inventorySetting('default_category_id');
            $defaultUnitId = $this->inventorySetting('default_unit_id');

            return view('admin.warehouse_inventory.lookups.index', $this->itemViewData() + compact('rows', 'type', 'title', 'categoryOptions', 'defaultCategoryId', 'defaultUnitId'));
        }

        list($model, $title) = $this->lookupMeta($type);
        $rows = $model::orderBy('name')->paginate(30);
        $categoryOptions = $type === 'categories'
            ? InventoryCategory::with('parent.parent')->orderBy('name')->get()
            : collect();
        return view('admin.warehouse_inventory.lookups.index', compact('rows', 'type', 'title', 'categoryOptions'));
    }

    public function lookupStore(Request $request, $type)
    {
        if ($type === 'defaults') {
            if (!Schema::hasTable('inventory_settings')) {
                return back()->with('error', 'Inventory settings table is not migrated yet.');
            }

            $request->validate([
                'default_category_id' => 'nullable|exists:inventory_categories,id',
                'default_unit_id' => 'nullable|exists:inventory_units,id',
            ]);

            $this->setInventorySetting('default_category_id', $request->default_category_id);
            $this->setInventorySetting('default_unit_id', $request->default_unit_id);

            return back()->with('success', 'Create item defaults updated.');
        }

        list($model) = $this->lookupMeta($type);
        $request->validate([
            'name' => 'required|string|max:150',
            'short_name' => 'nullable|string|max:20',
            'parent_id' => 'nullable|exists:inventory_categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $data = ['name' => $request->name, 'is_active' => $request->has('is_active') ? 1 : 0];
        if (in_array($type, ['units'], true)) {
            $data['short_name'] = $request->short_name ?: Str::slug($request->name, '');
        } else {
            $data['slug'] = Str::slug($request->name);
        }
        if ($type === 'movement-types') {
            $request->validate(['stock_effect' => 'required|in:add,subtract,transfer,none']);
            $data['stock_effect'] = $request->stock_effect;
        }
        if ($type === 'categories') {
            if ($request->parent_id && $this->categoryDepth(InventoryCategory::find($request->parent_id)) >= 3) {
                return back()->with('error', 'Categories only support up to 3 levels.');
            }
            $data['parent_id'] = $request->parent_id;
            $data['description'] = $request->description;
        }

        $model::create($data);
        return back()->with('success', 'Created successfully.');
    }

    public function lookupUpdate(Request $request, $type, $id)
    {
        list($model) = $this->lookupMeta($type);
        $row = $model::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:150',
            'short_name' => 'nullable|string|max:20',
            'parent_id' => 'nullable|exists:inventory_categories,id',
            'description' => 'nullable|string',
            'is_active' => 'nullable|boolean',
        ]);

        $row->name = $request->name;
        $row->is_active = $request->has('is_active') ? 1 : 0;
        if (in_array($type, ['categories', 'tags', 'statuses', 'movement-types'], true)) {
            $row->slug = Str::slug($request->name);
        }
        if ($type === 'movement-types') {
            $request->validate(['stock_effect' => 'required|in:add,subtract,transfer,none']);
            $row->stock_effect = $request->stock_effect;
        }
        if ($type === 'units') {
            $row->short_name = $request->short_name ?: $row->short_name;
        }
        if ($type === 'categories') {
            if ($request->parent_id && $this->categoryDepth(InventoryCategory::find($request->parent_id)) >= 3) {
                return back()->with('error', 'Categories only support up to 3 levels.');
            }
            $row->parent_id = $request->parent_id !== (string) $row->id ? $request->parent_id : null;
            $row->description = $request->description;
        }
        $row->save();

        return back()->with('success', 'Updated successfully.');
    }

    public function lookupDestroy($type, $id)
    {
        list($model) = $this->lookupMeta($type);
        try {
            $model::where('id', $id)->delete();
        } catch (QueryException $e) {
            return back()->with('error', 'Cannot delete this setup record because it is already used by inventory data. To delete it properly, first move or update the linked inventory items/stock records to another value, then try deleting again.');
        }

        return back()->with('success', 'Deleted successfully.');
    }

    public function items(Request $request)
    {
        $perPage = $this->inventoryPerPage($request);
        $itemsQuery = InventoryItem::with(['unit', 'category.parent.parent', 'tags'])->latest();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $itemsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhere('barcode', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $itemsQuery->where('category_id', $request->category_id);
        }

        if ($request->filled('tag_id')) {
            $itemsQuery->whereHas('tags', function ($query) use ($request) {
                $query->where('inventory_tags.id', $request->tag_id);
            });
        }

        $items = $itemsQuery->paginate($perPage)->appends($request->only(['search', 'category_id', 'tag_id', 'per_page']));
        return view('admin.warehouse_inventory.items.index', $this->itemViewData() + compact('items', 'perPage'));
    }

    public function itemStore(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|unique:inventory_items,sku',
            'barcode' => 'nullable|unique:inventory_items,barcode',
            'category_level_1_id' => 'nullable|exists:inventory_categories,id',
            'category_level_2_id' => 'nullable|exists:inventory_categories,id',
            'category_id' => 'nullable|exists:inventory_categories,id',
            'unit_id' => 'required|exists:inventory_units,id',
            'cost' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:inventory_tags,id',
            'new_tags' => 'nullable|string',
        ]);

        $item = InventoryItem::create([
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'name' => $request->name,
            'category_id' => $this->resolveCategoryId($request),
            'unit_id' => $request->unit_id,
            'cost' => $request->cost ?: 0,
            'selling_price' => $request->selling_price ?: 0,
            'description' => $request->description,
            'image_path' => $this->storeCompressedInventoryImage($request),
            'is_active' => $request->has('is_active') ? 1 : 0,
        ]);
        $item->tags()->sync($this->resolveTagIds($request));
        return back()->with('success', 'Item created.');
    }

    public function itemUpdate(Request $request, $id)
    {
        $item = InventoryItem::findOrFail($id);
        $request->validate([
            'name' => 'required|string|max:255',
            'sku' => 'nullable|unique:inventory_items,sku,' . $item->id,
            'barcode' => 'nullable|unique:inventory_items,barcode,' . $item->id,
            'category_level_1_id' => 'nullable|exists:inventory_categories,id',
            'category_level_2_id' => 'nullable|exists:inventory_categories,id',
            'category_id' => 'nullable|exists:inventory_categories,id',
            'unit_id' => 'required|exists:inventory_units,id',
            'cost' => 'nullable|numeric|min:0',
            'selling_price' => 'nullable|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,gif,webp|max:5120',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'exists:inventory_tags,id',
            'new_tags' => 'nullable|string',
        ]);

        $data = [
            'sku' => $request->sku,
            'barcode' => $request->barcode,
            'name' => $request->name,
            'category_id' => $this->resolveCategoryId($request),
            'unit_id' => $request->unit_id,
            'cost' => $request->cost ?: 0,
            'selling_price' => $request->selling_price ?: 0,
            'description' => $request->description,
            'is_active' => $request->has('is_active') ? 1 : 0,
        ];

        if ($request->hasFile('image')) {
            $data['image_path'] = $this->storeCompressedInventoryImage($request, $item->image_path);
        }

        $item->update($data);
        $item->tags()->sync($this->resolveTagIds($request));
        return back()->with('success', 'Item updated.');
    }

    public function itemDestroy($id)
    {
        $item = InventoryItem::findOrFail($id);
        $this->deleteInventoryImage($item->image_path);
        $item->delete();
        return back()->with('success', 'Item deleted.');
    }

    public function stocks(Request $request)
    {
        $perPage = $this->inventoryPerPage($request);
        $stocksQuery = WarehouseInventory::with(['item.category.parent.parent', 'item.unit', 'item.tags', 'status']);

        if ($request->filled('search')) {
            $search = trim($request->search);
            $stocksQuery->whereHas('item', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhere('barcode', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $stocksQuery->whereHas('item', function ($query) use ($request) {
                $query->where('category_id', $request->category_id);
            });
        }

        if ($request->filled('tag_id')) {
            $stocksQuery->whereHas('item.tags', function ($query) use ($request) {
                $query->where('inventory_tags.id', $request->tag_id);
            });
        }

        $stocks = $stocksQuery
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage)
            ->appends($request->only(['search', 'category_id', 'tag_id', 'per_page']));
        return view('admin.warehouse_inventory.stocks.index', $this->itemViewData() + compact('stocks', 'perPage'));
    }

    public function reports(Request $request)
    {
        $perPage = $this->inventoryPerPage($request);
        $startDate = $request->filled('start_date')
            ? Carbon::parse($request->start_date)->startOfDay()
            : now()->startOfMonth()->startOfDay();
        $endDate = $request->filled('end_date')
            ? Carbon::parse($request->end_date)->endOfDay()
            : now()->endOfDay();

        if ($endDate->lt($startDate)) {
            $endDate = $startDate->copy()->endOfDay();
        }

        if ($startDate->diffInDays($endDate) > 62) {
            $endDate = $startDate->copy()->addDays(62)->endOfDay();
        }

        $movementEffect = in_array($request->get('movement_effect'), ['add', 'subtract', 'all'], true)
            ? $request->get('movement_effect')
            : 'subtract';
        $sortBy = in_array($request->get('sort_by'), ['avg_sales_desc', 'avg_sales_asc', 'name'], true)
            ? $request->get('sort_by')
            : 'name';
        $dayCount = max($startDate->diffInDays($endDate) + 1, 1);

        $itemsQuery = InventoryItem::with(['unit', 'category.parent.parent', 'tags'])->select('inventory_items.*');

        if (in_array($sortBy, ['avg_sales_desc', 'avg_sales_asc'], true)) {
            $outboundTotalsSub = InventoryMovement::query()
                ->leftJoin('inventory_movement_types', 'inventory_movement_types.id', '=', 'inventory_movements.movement_type_id')
                ->select('inventory_movements.inventory_item_id')
                ->selectRaw('SUM(inventory_movements.quantity) as total_out')
                ->where('inventory_movement_types.stock_effect', 'subtract')
                ->whereBetween('inventory_movements.created_at', [$startDate, $endDate])
                ->groupBy('inventory_movements.inventory_item_id');

            $itemsQuery->leftJoinSub($outboundTotalsSub, 'outbound_totals', function ($join) {
                $join->on('outbound_totals.inventory_item_id', '=', 'inventory_items.id');
            });

            $itemsQuery->orderByRaw('COALESCE(outbound_totals.total_out, 0) ' . ($sortBy === 'avg_sales_desc' ? 'DESC' : 'ASC'))
                ->orderBy('inventory_items.name');
        } else {
            $itemsQuery->orderBy('inventory_items.name');
        }

        if ($request->filled('search')) {
            $search = trim($request->search);
            $itemsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhere('barcode', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $itemsQuery->where('category_id', $request->category_id);
        }

        if ($request->filled('tag_id')) {
            $itemsQuery->whereHas('tags', function ($query) use ($request) {
                $query->where('inventory_tags.id', $request->tag_id);
            });
        }

        $items = $itemsQuery
            ->paginate($perPage)
            ->appends($request->only(['search', 'category_id', 'tag_id', 'movement_effect', 'sort_by', 'start_date', 'end_date', 'per_page']));
        $itemIds = $items->pluck('id');

        $currentStocks = WarehouseInventory::select('inventory_item_id', DB::raw('SUM(quantity) as current_stock'))
            ->whereIn('inventory_item_id', $itemIds)
            ->groupBy('inventory_item_id')
            ->pluck('current_stock', 'inventory_item_id');

        $movementTotals = InventoryMovement::query()
            ->leftJoin('inventory_movement_types', 'inventory_movement_types.id', '=', 'inventory_movements.movement_type_id')
            ->select('inventory_movements.inventory_item_id', 'inventory_movement_types.stock_effect')
            ->selectRaw('SUM(inventory_movements.quantity) as total_quantity')
            ->whereIn('inventory_movements.inventory_item_id', $itemIds)
            ->whereIn('inventory_movement_types.stock_effect', ['add', 'subtract'])
            ->whereBetween('inventory_movements.created_at', [$startDate, $endDate])
            ->groupBy('inventory_movements.inventory_item_id', 'inventory_movement_types.stock_effect')
            ->get()
            ->groupBy('inventory_item_id')
            ->map(function ($rows) {
                return $rows->pluck('total_quantity', 'stock_effect');
            });

        $dailyMovementQuery = InventoryMovement::query()
            ->leftJoin('inventory_movement_types', 'inventory_movement_types.id', '=', 'inventory_movements.movement_type_id')
            ->select('inventory_movements.inventory_item_id')
            ->selectRaw('DATE(inventory_movements.created_at) as movement_date')
            ->selectRaw('SUM(inventory_movements.quantity) as total_quantity')
            ->whereIn('inventory_movements.inventory_item_id', $itemIds)
            ->whereBetween('inventory_movements.created_at', [$startDate, $endDate]);

        if ($movementEffect !== 'all') {
            $dailyMovementQuery->where('inventory_movement_types.stock_effect', $movementEffect);
        }

        $dailyMovements = $dailyMovementQuery
            ->groupBy('inventory_movements.inventory_item_id', DB::raw('DATE(inventory_movements.created_at)'))
            ->get()
            ->groupBy('inventory_item_id')
            ->map(function ($rows) {
                return $rows->pluck('total_quantity', 'movement_date');
            });

        $dateColumns = collect();
        $cursor = $startDate->copy();
        while ($cursor->lte($endDate)) {
            $dateColumns->push([
                'key' => $cursor->format('Y-m-d'),
                'label' => $cursor->format('M j'),
                'short_label' => $cursor->format('j'),
            ]);
            $cursor->addDay();
        }

        return view('admin.warehouse_inventory.reports.index', $this->itemViewData() + compact(
            'items',
            'perPage',
            'startDate',
            'endDate',
            'movementEffect',
            'sortBy',
            'currentStocks',
            'movementTotals',
            'dailyMovements',
            'dateColumns',
            'dayCount'
        ));
    }

    public function barcodes(Request $request)
    {
        $perPage = $this->inventoryPerPage($request);
        $itemsQuery = InventoryItem::with(['category.parent.parent', 'tags'])->latest();

        if ($request->filled('search')) {
            $search = trim($request->search);
            $itemsQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%')
                    ->orWhere('sku', 'like', '%' . $search . '%')
                    ->orWhere('barcode', 'like', '%' . $search . '%');
            });
        }

        if ($request->filled('category_id')) {
            $itemsQuery->where('category_id', $request->category_id);
        }

        if ($request->filled('tag_id')) {
            $itemsQuery->whereHas('tags', function ($query) use ($request) {
                $query->where('inventory_tags.id', $request->tag_id);
            });
        }

        if ($request->get('barcode_status') === 'missing') {
            $itemsQuery->where(function ($query) {
                $query->whereNull('barcode')->orWhere('barcode', '');
            });
        } elseif ($request->get('barcode_status') === 'with') {
            $itemsQuery->whereNotNull('barcode')->where('barcode', '!=', '');
        }

        $items = $itemsQuery
            ->paginate($perPage)
            ->appends($request->only(['search', 'category_id', 'tag_id', 'barcode_status', 'per_page']));

        $barcodeCount = InventoryItem::whereNotNull('barcode')->where('barcode', '!=', '')->count();
        $missingBarcodeCount = InventoryItem::whereNull('barcode')->orWhere('barcode', '')->count();

        return view('admin.warehouse_inventory.barcodes.index', $this->itemViewData() + compact('items', 'perPage', 'barcodeCount', 'missingBarcodeCount'));
    }

    public function barcodeGenerate(Request $request)
    {
        $request->validate([
            'item_ids' => 'required|array|min:1',
            'item_ids.*' => 'exists:inventory_items,id',
        ]);

        $generated = 0;
        $skipped = 0;

        $items = InventoryItem::whereIn('id', $request->item_ids)->get();
        foreach ($items as $item) {
            if (trim((string) $item->barcode) !== '') {
                $skipped++;
                continue;
            }

            $item->barcode = $this->generateUniqueInventoryBarcode();
            $item->save();
            $generated++;
        }

        return back()->with('success', $generated . ' barcode(s) generated, ' . $skipped . ' skipped.');
    }

    public function barcodeImage($id)
    {
        $item = InventoryItem::findOrFail($id);
        $barcode = trim((string) $item->barcode);

        if ($barcode === '') {
            abort(404);
        }

        return response($this->generateCode128Svg($barcode, $item->name), 200)
            ->header('Content-Type', 'image/svg+xml')
            ->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
    }

    public function movements(Request $request)
    {
        $displayMode = $request->get('display') === 'summary' ? 'summary' : 'details';
        $perPage = $this->inventoryPerPage($request);

        if ($displayMode === 'summary') {
            $batchExpression = "CASE WHEN inventory_movements.batch_code IS NULL OR inventory_movements.batch_code = '' THEN CONCAT('MOVEMENT-', inventory_movements.id) ELSE inventory_movements.batch_code END";
            $movementsQuery = InventoryMovement::query()
                ->leftJoin('inventory_movement_types as movement_types', 'movement_types.id', '=', 'inventory_movements.movement_type_id')
                ->leftJoin('users as creators', 'creators.id', '=', 'inventory_movements.created_by')
                ->leftJoin('inventory_items as movement_items', 'movement_items.id', '=', 'inventory_movements.inventory_item_id')
                ->selectRaw($batchExpression . ' as batch_code')
                ->selectRaw("MIN(CASE WHEN inventory_movements.batch_code IS NULL OR inventory_movements.batch_code = '' THEN CAST(inventory_movements.id AS CHAR) ELSE inventory_movements.batch_code END) as edit_key")
                ->selectRaw('MAX(inventory_movements.created_at) as latest_created_at')
                ->selectRaw('COALESCE(MAX(movement_types.name), MAX(inventory_movements.movement_type)) as type_name')
                ->selectRaw("COALESCE(MAX(movement_types.stock_effect), 'none') as stock_effect")
                ->selectRaw("COALESCE(MAX(creators.first_name), 'Unknown') as creator_first_name")
                ->selectRaw('SUM(inventory_movements.quantity) as total_quantity');

            $this->applyMovementFilters($movementsQuery, $request, $batchExpression, true);

            $movements = $movementsQuery->groupBy(DB::raw($batchExpression))
                ->orderByDesc('latest_created_at')
                ->paginate($perPage)
                ->appends($request->only(['display', 'search', 'category_id', 'tag_id', 'per_page']));
        } else {
            $movementsQuery = InventoryMovement::with(['item', 'movementType', 'creator']);
            $this->applyMovementFilters($movementsQuery, $request, null, false);
            $movements = $movementsQuery->latest()
                ->paginate($perPage)
                ->appends($request->only(['display', 'search', 'category_id', 'tag_id', 'per_page']));
        }

        return view('admin.warehouse_inventory.movements.index', $this->itemViewData() + [
            'movements' => $movements,
            'displayMode' => $displayMode,
            'perPage' => $perPage,
        ]);
    }

    public function movementCreate()
    {
        return view('admin.warehouse_inventory.movements.create', [
            'items' => InventoryItem::orderBy('name')->get(),
            'movementTypes' => InventoryMovementType::where('is_active', 1)
                ->whereIn('stock_effect', ['add', 'subtract', 'none'])
                ->orderBy('name')
                ->get(),
            'isEdit' => false,
            'batchCode' => null,
            'selectedMovementTypeId' => null,
            'selectedNotes' => null,
            'selectedItems' => [],
        ]);
    }

    public function movementStore(Request $request)
    {
        $request->validate([
            'movement_type_id' => 'required|exists:inventory_movement_types,id',
            'items' => 'required|array|min:1',
            'items.*.inventory_item_id' => 'required|exists:inventory_items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
            'items.*.unit_cost' => 'nullable|numeric|min:0',
            'reference_type' => 'nullable|string|max:100',
            'reference_id' => 'nullable|numeric',
            'notes' => 'nullable|string',
        ]);

        $movementType = InventoryMovementType::findOrFail($request->movement_type_id);
        $movementTypeCode = $movementType->slug;

        try {
            DB::transaction(function () use ($request, $movementType, $movementTypeCode) {
                $batchCode = $this->generateMovementBatchCode($movementTypeCode);
                $createdMovements = collect();
                foreach ($request->items as $itemRow) {
                    $createdMovements->push($this->movementService->recordMovement([
                        'batch_code' => $batchCode,
                        'inventory_item_id' => $itemRow['inventory_item_id'],
                        'movement_type_id' => $movementType->id,
                        'movement_type' => $movementTypeCode,
                        'quantity' => $itemRow['quantity'],
                        'unit_cost' => isset($itemRow['unit_cost']) ? $itemRow['unit_cost'] : null,
                        'reference_type' => $request->reference_type,
                        'reference_id' => $request->reference_id,
                        'notes' => $request->notes,
                        'created_by' => auth()->id(),
                    ]));
                }

                $createdMovements = InventoryMovement::with(['item', 'movementType'])
                    ->whereIn('id', $createdMovements->pluck('id'))
                    ->orderBy('id')
                    ->get();
                $snapshot = $this->movementSnapshot($createdMovements);
                $this->recordMovementAudit(
                    $batchCode,
                    'created',
                    'Created movement batch ' . $batchCode . ' with ' . $createdMovements->count() . ' item(s).',
                    null,
                    $snapshot
                );
            });
        } catch (InvalidArgumentException $e) {
            return back()->with('error', $e->getMessage());
        }

        return back()->with('success', count($request->items) . ' movement records created and stock updated.');
    }

    public function movementEdit($batchCode)
    {
        $movements = $this->movementBatchRows($batchCode);
        $firstMovement = $movements->first();

        return view('admin.warehouse_inventory.movements.create', [
            'items' => InventoryItem::orderBy('name')->get(),
            'movementTypes' => InventoryMovementType::where('is_active', 1)
                ->whereIn('stock_effect', ['add', 'subtract', 'none'])
                ->orderBy('name')
                ->get(),
            'isEdit' => true,
            'batchCode' => $firstMovement->batch_code ?: $firstMovement->id,
            'selectedMovementTypeId' => $firstMovement->movement_type_id,
            'selectedNotes' => $firstMovement->notes,
            'selectedItems' => $movements->map(function ($movement) {
                return [
                    'id' => $movement->inventory_item_id,
                    'name' => optional($movement->item)->name ?: '',
                    'sku' => optional($movement->item)->sku ?: '-',
                    'barcode' => optional($movement->item)->barcode ?: '-',
                    'quantity' => $movement->quantity,
                    'cost' => $movement->unit_cost !== null ? $movement->unit_cost : optional($movement->item)->cost,
                    'image' => optional($movement->item)->image_path ? asset($movement->item->image_path) : '',
                ];
            })->values(),
        ]);
    }

    public function movementUpdate(Request $request, $batchCode)
    {
        $request->validate([
            'movement_type_id' => 'required|exists:inventory_movement_types,id',
            'items' => 'required|array|min:1',
            'items.*.inventory_item_id' => 'required|exists:inventory_items,id',
            'items.*.quantity' => 'required|numeric|min:0.001',
            'items.*.unit_cost' => 'nullable|numeric|min:0',
            'notes' => 'nullable|string',
        ]);

        $oldMovements = $this->movementBatchRows($batchCode);
        $oldBatchCode = $oldMovements->first()->batch_code;
        $oldMovementTypeId = $oldMovements->first()->movement_type_id;
        $movementType = InventoryMovementType::findOrFail($request->movement_type_id);
        $movementTypeCode = $movementType->slug;
        $currentBatchCode = ((string) $oldMovementTypeId === (string) $movementType->id && $oldBatchCode)
            ? $oldBatchCode
            : $this->generateMovementBatchCode($movementTypeCode);
        $beforeSnapshot = $this->movementSnapshot($oldMovements);

        try {
            DB::transaction(function () use ($request, $oldMovements, $currentBatchCode, $movementType, $movementTypeCode, $beforeSnapshot, $oldBatchCode) {
                foreach ($oldMovements as $oldMovement) {
                    $this->movementService->reverseMovement($oldMovement);
                    $oldMovement->delete();
                }

                $updatedMovements = collect();
                foreach ($request->items as $itemRow) {
                    $updatedMovements->push($this->movementService->recordMovement([
                        'batch_code' => $currentBatchCode,
                        'inventory_item_id' => $itemRow['inventory_item_id'],
                        'movement_type_id' => $movementType->id,
                        'movement_type' => $movementTypeCode,
                        'quantity' => $itemRow['quantity'],
                        'unit_cost' => isset($itemRow['unit_cost']) ? $itemRow['unit_cost'] : null,
                        'notes' => $request->notes,
                        'created_by' => auth()->id(),
                    ]));
                }

                if ($oldBatchCode && $oldBatchCode !== $currentBatchCode) {
                    InventoryMovementAudit::where('batch_code', $oldBatchCode)
                        ->update(['batch_code' => $currentBatchCode]);
                }

                $updatedMovements = InventoryMovement::with(['item', 'movementType'])
                    ->whereIn('id', $updatedMovements->pluck('id'))
                    ->orderBy('id')
                    ->get();
                $afterSnapshot = $this->movementSnapshot($updatedMovements);
                $summary = 'Updated movement batch ' . ($oldBatchCode ?: $currentBatchCode) . '.';
                if ($oldBatchCode && $oldBatchCode !== $currentBatchCode) {
                    $summary .= ' New movement ID: ' . $currentBatchCode . '.';
                }

                $this->recordMovementAudit(
                    $currentBatchCode,
                    'updated',
                    $summary,
                    $beforeSnapshot,
                    $afterSnapshot
                );
            });
        } catch (InvalidArgumentException $e) {
            $this->recordMovementAudit(
                $oldBatchCode ?: $batchCode,
                'update_failed',
                'Failed to update movement batch ' . ($oldBatchCode ?: $batchCode) . '.',
                $beforeSnapshot,
                $this->attemptedMovementSnapshot($request, $movementType, $currentBatchCode),
                $e->getMessage()
            );
            return back()->with('error', $e->getMessage());
        }

        return redirect()
            ->route('warehouse_inventory.movements', ['display' => 'summary'])
            ->with('success', 'Movement batch updated and stock recalculated.');
    }

    public function movementAudits($batchCode)
    {
        $batchRows = $this->movementBatchRows($batchCode);
        $resolvedBatchCode = $batchRows->first()->batch_code ?: $batchRows->first()->id;
        $auditCodes = $batchRows->pluck('batch_code')->filter()->push($resolvedBatchCode)->unique()->values();

        $audits = InventoryMovementAudit::with('user')
            ->whereIn('batch_code', $auditCodes)
            ->latest()
            ->paginate(20);

        return view('admin.warehouse_inventory.movements.audits', [
            'audits' => $audits,
            'batchCode' => $resolvedBatchCode,
        ]);
    }

    protected function movementBatchRows($batchCode)
    {
        $decodedBatchCode = urldecode($batchCode);
        $query = InventoryMovement::with(['item', 'movementType']);

        if (is_numeric($decodedBatchCode)) {
            $query->where('id', $decodedBatchCode);
        } else {
            $query->where('batch_code', $decodedBatchCode);
        }

        $movements = $query->orderBy('id')->get();
        if ($movements->isEmpty()) {
            abort(404);
        }

        return $movements;
    }

    protected function recordMovementAudit($batchCode, $action, $summary, $beforeSnapshot = null, $afterSnapshot = null, $errorMessage = null)
    {
        InventoryMovementAudit::create([
            'batch_code' => $batchCode,
            'action' => $action,
            'summary' => $summary,
            'before_snapshot' => $beforeSnapshot,
            'after_snapshot' => $afterSnapshot,
            'error_message' => $errorMessage,
            'performed_by' => auth()->id(),
        ]);
    }

    protected function movementSnapshot($movements)
    {
        $movements = collect($movements)->values();
        $firstMovement = $movements->first();

        if (!$firstMovement) {
            return null;
        }

        return [
            'batch_code' => $firstMovement->batch_code ?: $firstMovement->id,
            'movement_type' => optional($firstMovement->movementType)->name ?: $firstMovement->movement_type,
            'movement_type_id' => $firstMovement->movement_type_id,
            'movement_type_slug' => $firstMovement->movement_type,
            'notes' => $firstMovement->notes,
            'created_by' => $firstMovement->created_by,
            'items' => $movements->map(function ($movement) {
                return [
                    'inventory_item_id' => $movement->inventory_item_id,
                    'name' => optional($movement->item)->name,
                    'sku' => optional($movement->item)->sku,
                    'barcode' => optional($movement->item)->barcode,
                    'quantity' => (float) $movement->quantity,
                    'unit_cost' => $movement->unit_cost !== null ? (float) $movement->unit_cost : null,
                ];
            })->values()->all(),
        ];
    }

    protected function attemptedMovementSnapshot(Request $request, InventoryMovementType $movementType, $batchCode)
    {
        $itemIds = collect((array) $request->items)->pluck('inventory_item_id')->filter()->values();
        $items = InventoryItem::whereIn('id', $itemIds)->get()->keyBy('id');

        return [
            'batch_code' => $batchCode,
            'movement_type' => $movementType->name,
            'movement_type_id' => $movementType->id,
            'movement_type_slug' => $movementType->slug,
            'notes' => $request->notes,
            'created_by' => auth()->id(),
            'items' => collect((array) $request->items)->map(function ($itemRow) use ($items) {
                $item = $items->get(isset($itemRow['inventory_item_id']) ? $itemRow['inventory_item_id'] : null);
                return [
                    'inventory_item_id' => isset($itemRow['inventory_item_id']) ? $itemRow['inventory_item_id'] : null,
                    'name' => optional($item)->name,
                    'sku' => optional($item)->sku,
                    'barcode' => optional($item)->barcode,
                    'quantity' => isset($itemRow['quantity']) ? (float) $itemRow['quantity'] : null,
                    'unit_cost' => isset($itemRow['unit_cost']) ? (float) $itemRow['unit_cost'] : null,
                ];
            })->values()->all(),
        ];
    }

    protected function generateMovementBatchCode($movementTypeCode)
    {
        $prefix = strtoupper(preg_replace('/[^A-Za-z0-9]/', '', $movementTypeCode));
        if ($prefix === '') {
            $prefix = 'MOVEMENT';
        }

        $latestCode = InventoryMovement::where('batch_code', 'like', $prefix . '-%')
            ->orderBy('batch_code', 'desc')
            ->value('batch_code');

        $nextNumber = 1;
        if ($latestCode && preg_match('/-(\d+)$/', $latestCode, $matches)) {
            $nextNumber = ((int) $matches[1]) + 1;
        }

        return $prefix . '-' . str_pad($nextNumber, 5, '0', STR_PAD_LEFT);
    }

    protected function generateUniqueInventoryBarcode()
    {
        do {
            $barcode = 'MEI' . now()->format('ymdHis') . str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        } while (InventoryItem::where('barcode', $barcode)->exists());

        return $barcode;
    }

    protected function generateCode128Svg($barcode, $productName = null)
    {
        $patterns = [
            '212222', '222122', '222221', '121223', '121322', '131222', '122213', '122312', '132212', '221213',
            '221312', '231212', '112232', '122132', '122231', '113222', '123122', '123221', '223211', '221132',
            '221231', '213212', '223112', '312131', '311222', '321122', '321221', '312212', '322112', '322211',
            '212123', '212321', '232121', '111323', '131123', '131321', '112313', '132113', '132311', '211313',
            '231113', '231311', '112133', '112331', '132131', '113123', '113321', '133121', '313121', '211331',
            '231131', '213113', '213311', '213131', '311123', '311321', '331121', '312113', '312311', '332111',
            '314111', '221411', '431111', '111224', '111422', '121124', '121421', '141122', '141221', '112214',
            '112412', '122114', '122411', '142112', '142211', '241211', '221114', '413111', '241112', '134111',
            '111242', '121142', '121241', '114212', '124112', '124211', '411212', '421112', '421211', '212141',
            '214121', '412121', '111143', '111341', '131141', '114113', '114311', '411113', '411311', '113141',
            '114131', '311141', '411131', '211412', '211214', '211232', '2331112',
        ];

        $codes = [104];
        $checksum = 104;
        $length = strlen($barcode);

        for ($i = 0; $i < $length; $i++) {
            $ascii = ord($barcode[$i]);
            if ($ascii < 32 || $ascii > 126) {
                abort(422, 'Barcode contains unsupported characters.');
            }

            $value = $ascii - 32;
            $codes[] = $value;
            $checksum += $value * ($i + 1);
        }

        $codes[] = $checksum % 103;
        $codes[] = 106;

        $svgWidth = 239;
        $svgHeight = 87.99;
        $quietZone = 10;
        $barHeight = 45;
        $barTop = 20;
        $nameTop = 12;
        $textTop = 80;
        $totalBarcodeModules = 0;

        foreach ($codes as $code) {
            foreach (str_split($patterns[$code]) as $width) {
                $totalBarcodeModules += (int) $width;
            }
        }

        $moduleWidth = ($svgWidth - ($quietZone * 2)) / max($totalBarcodeModules, 1);
        $x = $quietZone;
        $rects = '';

        foreach ($codes as $code) {
            $pattern = $patterns[$code];
            for ($i = 0; $i < strlen($pattern); $i++) {
                $width = (int) $pattern[$i] * $moduleWidth;
                if ($i % 2 === 0) {
                    $rects .= '<rect x="' . round($x, 3) . '" y="' . $barTop . '" width="' . round($width, 3) . '" height="' . $barHeight . '" fill="#111827"/>';
                }
                $x += $width;
            }
        }

        $safeBarcode = htmlspecialchars($barcode, ENT_QUOTES, 'UTF-8');
        $safeProductName = htmlspecialchars(Str::limit((string) $productName, 34), ENT_QUOTES, 'UTF-8');

        return '<svg xmlns="http://www.w3.org/2000/svg" width="' . $svgWidth . 'px" height="' . $svgHeight . 'px" viewBox="0 0 ' . $svgWidth . ' ' . $svgHeight . '" preserveAspectRatio="xMidYMid meet" role="img" aria-label="' . $safeBarcode . '">' .
            '<rect width="100%" height="100%" fill="#ffffff"/>' .
            '<text x="50%" y="' . $nameTop . '" text-anchor="middle" font-family="Arial, sans-serif" font-size="9" font-weight="800" fill="#23324d">' . $safeProductName . '</text>' .
            $rects .
            '<text x="50%" y="' . $textTop . '" text-anchor="middle" font-family="Arial, sans-serif" font-size="10" font-weight="700" fill="#23324d">' . $safeBarcode . '</text>' .
            '</svg>';
    }

    protected function itemViewData()
    {
        $defaultCategoryId = $this->inventorySetting('default_category_id');
        $defaultUnitId = $this->inventorySetting('default_unit_id');
        $defaultCategoryLevels = $this->categoryLevelSelection($defaultCategoryId);

        return [
            'categories' => InventoryCategory::where('is_active', 1)->orderBy('name')->get(),
            'units' => InventoryUnit::where('is_active', 1)->orderBy('name')->get(),
            'tags' => InventoryTag::where('is_active', 1)->orderBy('name')->get(),
            'defaultCategoryId' => $defaultCategoryId,
            'defaultUnitId' => $defaultUnitId,
            'defaultCategoryLevel1Id' => $defaultCategoryLevels['level1'],
            'defaultCategoryLevel2Id' => $defaultCategoryLevels['level2'],
            'defaultCategoryLevel3Id' => $defaultCategoryLevels['level3'],
        ];
    }

    protected function inventorySetting($key)
    {
        if (!Schema::hasTable('inventory_settings')) {
            return null;
        }

        return InventorySetting::where('key', $key)->value('value');
    }

    protected function setInventorySetting($key, $value)
    {
        InventorySetting::updateOrCreate(
            ['key' => $key],
            ['value' => $value ?: null]
        );
    }

    protected function categoryLevelSelection($categoryId)
    {
        $levels = ['level1' => null, 'level2' => null, 'level3' => null];
        if (!$categoryId) {
            return $levels;
        }

        $category = InventoryCategory::with('parent.parent')->find($categoryId);
        if (!$category) {
            return $levels;
        }

        if ($category->parent && $category->parent->parent) {
            $levels['level1'] = $category->parent->parent->id;
            $levels['level2'] = $category->parent->id;
            $levels['level3'] = $category->id;
            return $levels;
        }

        if ($category->parent) {
            $levels['level1'] = $category->parent->id;
            $levels['level2'] = $category->id;
            return $levels;
        }

        $levels['level1'] = $category->id;
        return $levels;
    }

    protected function resolveCategoryId(Request $request)
    {
        return $request->category_id ?: ($request->category_level_2_id ?: $request->category_level_1_id);
    }

    protected function resolveTagIds(Request $request)
    {
        $tagIds = collect((array) $request->tag_ids)->filter()->values();
        $newTags = collect(explode(',', (string) $request->new_tags))
            ->map(function ($tag) {
                return trim($tag);
            })
            ->filter()
            ->unique();

        foreach ($newTags as $tagName) {
            $tag = InventoryTag::firstOrCreate(
                ['slug' => Str::slug($tagName)],
                ['name' => $tagName, 'is_active' => 1]
            );
            $tagIds->push($tag->id);
        }

        return $tagIds->unique()->values()->all();
    }

    protected function storeCompressedInventoryImage(Request $request, $oldPath = null)
    {
        if (!$request->hasFile('image')) {
            return $oldPath;
        }

        $file = $request->file('image');
        $sourcePath = $file->getRealPath();
        $imageInfo = getimagesize($sourcePath);

        if (!$imageInfo) {
            return $oldPath;
        }

        $source = $this->createImageResource($sourcePath, $imageInfo[2]);
        if (!$source) {
            return $oldPath;
        }

        $width = imagesx($source);
        $height = imagesy($source);
        $maxWidth = 640;
        $maxHeight = 640;
        $ratio = min($maxWidth / $width, $maxHeight / $height, 1);
        $newWidth = (int) floor($width * $ratio);
        $newHeight = (int) floor($height * $ratio);

        $canvas = imagecreatetruecolor($newWidth, $newHeight);
        $white = imagecolorallocate($canvas, 255, 255, 255);
        imagefill($canvas, 0, 0, $white);
        imagecopyresampled($canvas, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        $directory = public_path('images/inventory_items');
        if (!is_dir($directory)) {
            mkdir($directory, 0755, true);
        }

        $filename = 'inventory_item_' . uniqid('', true) . '.jpg';
        $relativePath = 'images/inventory_items/' . $filename;
        imagejpeg($canvas, public_path($relativePath), 72);

        imagedestroy($source);
        imagedestroy($canvas);

        $this->deleteInventoryImage($oldPath);

        return $relativePath;
    }

    protected function createImageResource($path, $imageType)
    {
        if ($imageType === IMAGETYPE_JPEG) {
            return imagecreatefromjpeg($path);
        }
        if ($imageType === IMAGETYPE_PNG) {
            return imagecreatefrompng($path);
        }
        if ($imageType === IMAGETYPE_GIF) {
            return imagecreatefromgif($path);
        }
        if (defined('IMAGETYPE_WEBP') && $imageType === IMAGETYPE_WEBP && function_exists('imagecreatefromwebp')) {
            return imagecreatefromwebp($path);
        }

        return null;
    }

    protected function deleteInventoryImage($path)
    {
        if (!$path) {
            return;
        }

        $fullPath = public_path($path);
        if (is_file($fullPath)) {
            unlink($fullPath);
        }
    }

    protected function defaultInventoryStatusId()
    {
        $status = InventoryStatus::where('slug', 'available')->orWhere('name', 'Available')->first();

        if (!$status) {
            $status = InventoryStatus::orderBy('id')->first();
        }

        if (!$status) {
            throw new InvalidArgumentException('No inventory status is available.');
        }

        return $status->id;
    }

    protected function inventoryPerPage(Request $request)
    {
        $allowed = [25, 50, 100, 200];
        $perPage = (int) $request->get('per_page', 50);
        return in_array($perPage, $allowed, true) ? $perPage : 50;
    }

    protected function applyMovementFilters($query, Request $request, $batchExpression = null, $isSummary = false)
    {
        if ($request->filled('search')) {
            $search = trim($request->search);
            if ($isSummary) {
                $query->where(function ($q) use ($search, $batchExpression) {
                    $q->whereRaw($batchExpression . ' like ?', ['%' . $search . '%'])
                        ->orWhere('movement_items.name', 'like', '%' . $search . '%')
                        ->orWhere('movement_items.sku', 'like', '%' . $search . '%')
                        ->orWhere('movement_items.barcode', 'like', '%' . $search . '%');
                });
            } else {
                $query->where(function ($q) use ($search) {
                    $q->where('batch_code', 'like', '%' . $search . '%')
                        ->orWhereRaw("CONCAT('MOVEMENT-', inventory_movements.id) like ?", ['%' . $search . '%'])
                        ->orWhereHas('item', function ($itemQuery) use ($search) {
                            $itemQuery->where('name', 'like', '%' . $search . '%')
                                ->orWhere('sku', 'like', '%' . $search . '%')
                                ->orWhere('barcode', 'like', '%' . $search . '%');
                        });
                });
            }
        }

        if ($request->filled('category_id')) {
            if ($isSummary) {
                $query->where('movement_items.category_id', $request->category_id);
            } else {
                $query->whereHas('item', function ($itemQuery) use ($request) {
                    $itemQuery->where('category_id', $request->category_id);
                });
            }
        }

        if ($request->filled('tag_id')) {
            if ($isSummary) {
                $query->whereExists(function ($exists) use ($request) {
                    $exists->select(DB::raw(1))
                        ->from('inventory_item_tags')
                        ->whereRaw('inventory_item_tags.inventory_item_id = inventory_movements.inventory_item_id')
                        ->where('inventory_item_tags.inventory_tag_id', $request->tag_id);
                });
            } else {
                $query->whereHas('item.tags', function ($tagQuery) use ($request) {
                    $tagQuery->where('inventory_tags.id', $request->tag_id);
                });
            }
        }
    }

    protected function categoryDepth($category)
    {
        $depth = 0;
        while ($category) {
            $depth++;
            $category = $category->parent;
        }

        return $depth;
    }

    protected function lookupMeta($type)
    {
        $map = [
            'units' => [InventoryUnit::class, 'Inventory Units'],
            'categories' => [InventoryCategory::class, 'Inventory Categories'],
            'tags' => [InventoryTag::class, 'Inventory Tags'],
            'statuses' => [InventoryStatus::class, 'Inventory Statuses'],
            'movement-types' => [InventoryMovementType::class, 'Inventory Movement Types'],
        ];
        if (!isset($map[$type])) {
            abort(404);
        }
        return $map[$type];
    }
}
