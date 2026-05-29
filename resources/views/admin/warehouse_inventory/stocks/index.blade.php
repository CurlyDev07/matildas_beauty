@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')
    @php
        $stockColumns = [
            'image' => 'Image',
            'item' => 'Item Name',
            'sku' => 'SKU',
            'category' => 'Category',
            'unit' => 'Unit',
            'status' => 'Status',
            'qty' => 'Qty',
            'reorder' => 'Reorder',
            'cost' => 'Cost',
            'total_cost' => 'Total Cost',
            'selling' => 'Selling',
            'total_selling' => 'Total Selling',
            'profit' => 'Potential GP',
        ];
    @endphp

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Warehouse Balance</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Current Stock</h4>
                <div class="ttext-sm wi-muted">Quantity, value, reorder level, and potential profit by item and status.</div>
            </div>
            <a href="{{ route('warehouse_inventory.movements') }}" class="wi-btn-primary waves-effect">
                <i class="fas fa-plus tmr-2"></i> Add Movement
            </a>
        </div>
    </div>

    <div class="wi-panel">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                <div>
                    <div class="tfont-bold wi-section-title">Stock Balances</div>
                    <div class="ttext-xs wi-muted">Calculated values are not stored in the database.</div>
                </div>
                <div class="tflex titems-end tflex-wrap" style="gap:8px;">
                    <form method="GET" action="{{ route('warehouse_inventory.stocks') }}" class="tflex titems-end tflex-wrap" style="gap:8px;">
                        <div>
                            <label class="wi-form-label">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="browser-default wi-input" placeholder="Name, SKU, barcode" style="width:210px;height:41px !important;">
                        </div>
                        <div>
                            <label class="wi-form-label">Category</label>
                            <select name="category_id" class="browser-default wi-select" style="width:190px;height:41px !important;">
                                <option value="">All categories</option>
                                @foreach($categories as $category)
                                    @php
                                        $parts = collect([$category->parent ? optional($category->parent)->parent : null, $category->parent, $category])->filter();
                                    @endphp
                                    <option value="{{ $category->id }}" {{ (string) request('category_id') === (string) $category->id ? 'selected' : '' }}>
                                        {{ $parts->pluck('name')->implode(' / ') }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="wi-form-label">Tag</label>
                            <select name="tag_id" class="browser-default wi-select" style="width:150px;height:41px !important;">
                                <option value="">All tags</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->id }}" {{ (string) request('tag_id') === (string) $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="wi-form-label">Per Page</label>
                            <select name="per_page" class="browser-default wi-select" style="width:100px;height:41px !important;">
                                @foreach([25, 50, 100, 200] as $option)
                                    <option value="{{ $option }}" {{ (int) $perPage === $option ? 'selected' : '' }}>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="wi-btn-primary waves-effect" style="height:41px;padding:0 12px;">
                            <i class="fas fa-search tmr-2"></i> Filter
                        </button>
                        @if(request()->hasAny(['search', 'category_id', 'tag_id']))
                            <a href="{{ route('warehouse_inventory.stocks', ['per_page' => $perPage]) }}" class="wi-btn-light waves-effect" style="height:41px;padding:0 12px;">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    <div class="wi-column-settings">
                        <button type="button" id="stockColumnSettingsBtn" class="wi-btn-light waves-effect">
                            <i class="fas fa-columns tmr-2"></i> Columns
                        </button>
                        <div id="stockColumnSettingsPanel" class="wi-column-settings-panel">
                            <div class="tfont-bold wi-section-title tmb-2">Show Columns</div>
                            @foreach($stockColumns as $columnKey => $columnLabel)
                                <label class="wi-column-option">
                                    <input type="checkbox" class="browser-default stock-column-toggle" value="{{ $columnKey }}" checked>
                                    <span>{{ $columnLabel }}</span>
                                </label>
                            @endforeach
                            <div class="tflex titems-center tjustify-between tmt-3" style="gap:8px;">
                                <button type="button" id="stockColumnResetBtn" class="wi-btn-light waves-effect" style="padding:8px 10px;">Reset</button>
                                <button type="button" id="stockColumnCloseBtn" class="wi-btn-primary waves-effect" style="padding:8px 10px;">Done</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="wi-overflow">
            <table class="wi-table tw-full ttext-sm">
                <thead>
                    <tr class="ttext-xs tuppercase">
                        <th class="ttext-left tpx-4 tpy-3" data-stock-col="image">Image</th>
                        <th class="ttext-left tpx-4 tpy-3" data-stock-col="item">Item Name</th>
                        <th class="ttext-left tpx-4 tpy-3" data-stock-col="sku">SKU</th>
                        <th class="ttext-left tpx-4 tpy-3" data-stock-col="category">Category</th>
                        <th class="ttext-left tpx-4 tpy-3" data-stock-col="unit">Unit</th>
                        <th class="ttext-left tpx-4 tpy-3" data-stock-col="status">Status</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="qty">Qty</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="reorder">Reorder</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="cost">Cost</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="total_cost">Total Cost</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="selling">Selling</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="total_selling">Total Selling</th>
                        <th class="ttext-right tpx-4 tpy-3" data-stock-col="profit">Potential GP</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($stocks as $row)
                        @php
                            $item = $row->item;
                            $cost = (float) optional($item)->cost;
                            $sell = (float) optional($item)->selling_price;
                            $qty = (float) $row->quantity;
                            $costVal = $qty * $cost;
                            $sellVal = $qty * $sell;
                            $profit = $sellVal - $costVal;
                            $cat = optional($item)->category;
                            $categoryParts = collect([$cat ? optional(optional($cat)->parent)->parent : null, $cat ? $cat->parent : null, $cat])->filter();
                        @endphp
                        <tr class="tborder-t tborder-gray-200">
                            <td class="tpx-4 tpy-3" data-stock-col="image">
                                @if(optional($item)->image_path)
                                    <img src="{{ asset($item->image_path) }}" alt="{{ optional($item)->name }}" class="wi-item-photo">
                                @else
                                    <span class="wi-item-photo-placeholder"><i class="fas fa-image"></i></span>
                                @endif
                            </td>
                            <td class="tpx-4 tpy-3 tfont-bold wi-section-title" data-stock-col="item">{{ optional($item)->name ?: '-' }}</td>
                            <td class="tpx-4 tpy-3 tfont-bold" data-stock-col="sku">{{ optional($item)->sku ?: '-' }}</td>
                            <td class="tpx-4 tpy-3" data-stock-col="category">{{ $categoryParts->pluck('name')->implode(' / ') ?: '-' }}</td>
                            <td class="tpx-4 tpy-3" data-stock-col="unit"><span class="wi-pill">{{ optional(optional($item)->unit)->short_name ?: '-' }}</span></td>
                            <td class="tpx-4 tpy-3" data-stock-col="status"><span class="wi-pill">{{ optional($row->status)->name ?: '-' }}</span></td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold {{ $qty <= (float) $row->reorder_level ? 'ttext-red-600' : 'wi-section-title' }}" data-stock-col="qty">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $qty, 'unit' => optional(optional($item)->unit)->short_name])</td>
                            <td class="tpx-4 tpy-3 ttext-right wi-muted" data-stock-col="reorder">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $row->reorder_level, 'unit' => optional(optional($item)->unit)->short_name])</td>
                            <td class="tpx-4 tpy-3 ttext-right" data-stock-col="cost">₱{{ number_format($cost,2) }}</td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold" data-stock-col="total_cost">₱{{ number_format($costVal,2) }}</td>
                            <td class="tpx-4 tpy-3 ttext-right" data-stock-col="selling">₱{{ number_format($sell,2) }}</td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold" data-stock-col="total_selling" style="color:#059669;">₱{{ number_format($sellVal,2) }}</td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold" data-stock-col="profit" style="color:{{ $profit >= 0 ? '#f40167' : '#ef4444' }};">₱{{ number_format($profit,2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tp-4">{{ $stocks->appends(request()->only(['search', 'category_id', 'tag_id', 'per_page']))->links() }}</div>
    </div>
</div>
<style>
    .wi-column-settings {
        position: relative;
    }

    .wi-column-settings-panel {
        position: absolute;
        right: 0;
        top: calc(100% + 8px);
        width: 260px;
        max-height: 70vh;
        overflow-y: auto;
        background: #fff;
        border: 1px solid #d7deea;
        border-radius: 12px;
        box-shadow: 0 22px 55px rgba(61, 81, 112, .18);
        padding: 14px;
        z-index: 30;
        display: none;
    }

    .wi-column-settings-panel.is-open {
        display: block;
    }

    .wi-column-option {
        display: flex;
        align-items: center;
        gap: 9px;
        min-height: 34px;
        margin: 0;
        padding: 6px 8px;
        border-radius: 8px;
        color: #23324d;
        font-size: 12px;
        font-weight: 700;
        cursor: pointer;
    }

    .wi-column-option:hover {
        background: #fff7fb;
    }
</style>
<script>
    (function () {
        var storageKey = 'warehouse_inventory_stock_columns';
        var defaults = {!! json_encode(array_keys($stockColumns)) !!};
        var button = document.getElementById('stockColumnSettingsBtn');
        var panel = document.getElementById('stockColumnSettingsPanel');
        var closeButton = document.getElementById('stockColumnCloseBtn');
        var resetButton = document.getElementById('stockColumnResetBtn');
        var toggles = Array.prototype.slice.call(document.querySelectorAll('.stock-column-toggle'));

        function loadVisibleColumns() {
            try {
                var stored = JSON.parse(localStorage.getItem(storageKey));
                return Array.isArray(stored) && stored.length ? stored : defaults.slice();
            } catch (e) {
                return defaults.slice();
            }
        }

        function saveVisibleColumns(columns) {
            localStorage.setItem(storageKey, JSON.stringify(columns));
        }

        function applyColumns(columns) {
            var visible = {};
            columns.forEach(function (column) {
                visible[column] = true;
            });

            toggles.forEach(function (toggle) {
                toggle.checked = !!visible[toggle.value];
            });

            Array.prototype.forEach.call(document.querySelectorAll('[data-stock-col]'), function (cell) {
                cell.style.display = visible[cell.getAttribute('data-stock-col')] ? '' : 'none';
            });
        }

        function currentColumns() {
            return toggles.filter(function (toggle) {
                return toggle.checked;
            }).map(function (toggle) {
                return toggle.value;
            });
        }

        button.addEventListener('click', function (event) {
            event.stopPropagation();
            panel.classList.toggle('is-open');
        });

        closeButton.addEventListener('click', function () {
            panel.classList.remove('is-open');
        });

        resetButton.addEventListener('click', function () {
            saveVisibleColumns(defaults);
            applyColumns(defaults);
        });

        toggles.forEach(function (toggle) {
            toggle.addEventListener('change', function () {
                var selected = currentColumns();
                if (!selected.length) {
                    toggle.checked = true;
                    selected = currentColumns();
                }
                saveVisibleColumns(selected);
                applyColumns(selected);
            });
        });

        document.addEventListener('click', function (event) {
            if (!panel.contains(event.target) && event.target !== button) {
                panel.classList.remove('is-open');
            }
        });

        applyColumns(loadVisibleColumns());
    })();
</script>
@endsection
