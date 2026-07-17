@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="tflex titems-center tjustify-between tflex-wrap">
            <div class="tmb-3">
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Management</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Warehouse Inventory</h4>
                <!-- <div class="ttext-sm ttext-gray-700">Independent stock control for products, materials, supplies, bundles, freebies, returns, and damaged inventory.</div> -->
            </div>
            <div class="tflex titems-center tflex-wrap">
                <form method="GET" action="{{ route('warehouse_inventory.dashboard') }}" id="dashboardMonthFilter" class="tflex titems-center tmr-2" style="gap:8px;">
                    <label class="wi-month-filter" id="dashboardMonthPickerTrigger">
                        <span class="wi-month-icon"><i class="fas fa-calendar-alt"></i></span>
                        <span class="wi-month-text">
                            <span class="wi-month-label">Month</span>
                            <input type="month" name="month" value="{{ $selectedMonth }}" id="dashboardMonthPicker" class="browser-default wi-month-input" onchange="this.form.submit();">
                        </span>
                    </label>
                    @if($selectedMonth)
                        <a href="{{ route('warehouse_inventory.dashboard') }}" class="wi-month-clear waves-effect" title="Clear month filter">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
                <a href="{{ route('warehouse_inventory.items') }}" class="tbg-white tborder tborder-gray-300 ttext-title tfont-bold tpx-4 tpy-2 trounded tmr-2 waves-effect">
                    <i class="fas fa-box-open tmr-1"></i> Items
                </a>
                <a href="{{ route('warehouse_inventory.movements') }}" class="ttext-white tfont-bold tpx-4 tpy-2 trounded waves-effect" style="background:#f40167;">
                    <i class="fas fa-exchange-alt tmr-1"></i> New Movement
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 m6 l3">
            <div class="wi-card wi-card-pink tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg tp-4 tmb-4">
                <div class="tflex titems-start tjustify-between">
                    <div>
                        <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Total Cost Value</div>
                        <div class="tmt-2 ttext-2xl tfont-bold wi-section-title">₱{{ number_format($totalCost, 2) }}</div>
                        <div class="tmt-1 ttext-xs tfont-medium ttext-gray-700">{{ number_format($stockRowCount) }} stock balance rows</div>
                    </div>
                    <div class="wi-icon ttext-white" style="background:#f40167;">
                        <i class="fas fa-coins"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="wi-card wi-card-green tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg tp-4 tmb-4">
                <div class="tflex titems-start tjustify-between">
                    <div>
                        <div class="ttext-xs tfont-bold tuppercase" style="color:#059669;">Selling Value</div>
                        <div class="tmt-2 ttext-2xl tfont-bold wi-section-title">₱{{ number_format($totalSelling, 2) }}</div>
                        <div class="tmt-1 ttext-xs tfont-medium ttext-gray-700">{{ number_format($itemCount) }} inventory items</div>
                    </div>
                    <div class="wi-icon ttext-white" style="background:#10b981;">
                        <i class="fas fa-tags"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="wi-card wi-card-orange tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg tp-4 tmb-4">
                <div class="tflex titems-start tjustify-between">
                    <div>
                        <div class="ttext-xs tfont-bold tuppercase" style="color:#d97706;">Potential Gross Profit</div>
                        <div class="tmt-2 ttext-2xl tfont-bold wi-section-title">₱{{ number_format($potentialProfit, 2) }}</div>
                        <div class="tmt-1 ttext-xs tfont-medium ttext-gray-700">Selling minus cost value</div>
                    </div>
                    <div class="wi-icon ttext-white" style="background:#f59e0b;">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col s12 m6 l3">
            <div class="wi-card wi-card-red tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg tp-4 tmb-4">
                <div class="tflex titems-start tjustify-between">
                    <div>
                        <div class="ttext-xs tfont-bold tuppercase" style="color:#dc2626;">Low Stock</div>
                        <div class="tmt-2 ttext-2xl tfont-bold {{ $lowStockCount > 0 ? 'ttext-red-600' : 'ttext-title' }}">{{ number_format($lowStockCount) }}</div>
                        <div class="tmt-1 ttext-xs tfont-medium ttext-gray-700">{{ number_format($movementCount) }} movement records</div>
                        <div class="tmt-1 ttext-xs tfont-bold" style="color:#f40167;">{{ $movementPeriodLabel }}</div>
                    </div>
                    <div class="wi-icon ttext-white" style="background:{{ $lowStockCount > 0 ? '#ef4444' : '#94a3b8' }};">
                        <i class="fas fa-exclamation-triangle"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col s12 l8">
            <div class="tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg tmb-5">
                <div class="tflex titems-center tjustify-between tpx-4 tpy-3 tborder-b tborder-gray-200">
                    <div>
                        <div class="tfont-bold wi-section-title">Low Stock Monitor</div>
                        <div class="ttext-xs tfont-medium ttext-gray-700">Items at or below reorder level</div>
                    </div>
                    <a href="{{ route('warehouse_inventory.stocks') }}" class="ttext-xs tfont-bold tpx-3 tpy-2 trounded ttext-white" style="background:#23324d;">View Stock</a>
                </div>
                <div class="toverflow-x-auto">
                    <table class="wi-table tw-full ttext-sm">
                        <thead>
                            <tr class="ttext-xs tuppercase">
                                <th class="ttext-left tpx-4 tpy-3">Item</th>
                                <th class="ttext-left tpx-4 tpy-3">Status</th>
                                <th class="ttext-right tpx-4 tpy-3">Qty</th>
                                <th class="ttext-right tpx-4 tpy-3">Reorder</th>
                                <th class="ttext-right tpx-4 tpy-3">Unit</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowStocks as $stock)
                                <tr class="tborder-t tborder-gray-200">
                                    <td class="tpx-4 tpy-3">
                                        <div class="tfont-bold wi-section-title">{{ optional($stock->item)->name ?: 'Unknown item' }}</div>
                                        <div class="ttext-xs tfont-medium ttext-gray-700">{{ optional($stock->item)->sku ?: 'No SKU' }}</div>
                                    </td>
                                    <td class="tpx-4 tpy-3">
                                        <span class="wi-pill ttext-gray-800 ttext-xs tfont-bold tpx-2 tpy-1 trounded-full">{{ optional($stock->status)->name ?: 'No status' }}</span>
                                    </td>
                                    <td class="tpx-4 tpy-3 ttext-right tfont-bold ttext-red-600">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $stock->quantity, 'unit' => optional(optional($stock->item)->unit)->short_name])</td>
                                    <td class="tpx-4 tpy-3 ttext-right ttext-gray-700">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $stock->reorder_level, 'unit' => optional(optional($stock->item)->unit)->short_name])</td>
                                    <td class="tpx-4 tpy-3 ttext-right ttext-gray-600">{{ optional(optional($stock->item)->unit)->short_name }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="tpx-4 tpy-8 ttext-center ttext-gray-600">No low stock items.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col s12 l4">
            <div class="tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg tmb-5">
                <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
                    <div class="tfont-bold wi-section-title">Value by Category</div>
                    <div class="ttext-xs tfont-medium ttext-gray-700">Top cost value contributors</div>
                </div>
                <div class="tp-4">
                    @forelse($categoryValues as $row)
                        @php
                            $percent = $totalCost > 0 ? min(100, round(((float) $row['total_cost_value'] / (float) $totalCost) * 100, 1)) : 0;
                        @endphp
                        <div class="tmb-4">
                            <div class="tflex titems-center tjustify-between tmb-1">
                                <div class="ttext-sm tfont-bold wi-section-title">{{ $row['category'] }}</div>
                                <div class="ttext-xs tfont-bold" style="color:#f40167;">₱{{ number_format($row['total_cost_value'], 2) }}</div>
                            </div>
                            <div class="wi-progress">
                                <div class="wi-progress-bar" style="width:{{ $percent }}%;"></div>
                            </div>
                        </div>
                    @empty
                        <div class="tpy-8 ttext-center ttext-sm ttext-gray-600">No category value yet.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    <div class="tbg-white tborder tborder-gray-200 trounded-lg tshadow-lg">
        <div class="tflex titems-center tjustify-between tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div>
                <div class="tfont-bold wi-section-title">Recent Stock Movements</div>
                <div class="ttext-xs tfont-medium ttext-gray-700">Latest audit trail entries · {{ $movementPeriodLabel }}</div>
            </div>
            <a href="{{ route('warehouse_inventory.movements') }}" class="ttext-xs tfont-bold tpx-3 tpy-2 trounded ttext-white" style="background:#f40167;">Open Movements</a>
        </div>
        <div class="toverflow-x-auto">
            <table class="wi-table tw-full ttext-sm">
                <thead>
                    <tr class="ttext-xs tuppercase">
                        <th class="ttext-left tpx-4 tpy-3">Date</th>
                        <th class="ttext-left tpx-4 tpy-3">Item</th>
                        <th class="ttext-left tpx-4 tpy-3">Movement</th>
                        <th class="ttext-right tpx-4 tpy-3">Qty</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMovements as $movement)
                        <tr class="tborder-t tborder-gray-200">
                            <td class="tpx-4 tpy-3 tfont-medium ttext-gray-700">{{ optional($movement->created_at)->format('M d, Y H:i') }}</td>
                            <td class="tpx-4 tpy-3 tfont-bold wi-section-title">{{ optional($movement->item)->name ?: 'Unknown item' }}</td>
                            <td class="tpx-4 tpy-3">
                                @include('admin.warehouse_inventory.partials.movement_type_badge', ['label' => optional($movement->movementType)->name ?: $movement->movement_type, 'effect' => optional($movement->movementType)->stock_effect ?: 'none', 'key' => $movement->movement_type])
                            </td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold ttext-title">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $movement->quantity, 'unit' => optional(optional($movement->item)->unit)->short_name])</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="tpx-4 tpy-8 ttext-center ttext-gray-600">No movements yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var monthTrigger = document.getElementById('dashboardMonthPickerTrigger');
    var monthInput = document.getElementById('dashboardMonthPicker');

    if (!monthTrigger || !monthInput) {
        return;
    }

    monthTrigger.addEventListener('click', function (event) {
        if (event.target === monthInput) {
            return;
        }

        event.preventDefault();
        monthInput.focus();

        if (typeof monthInput.showPicker === 'function') {
            monthInput.showPicker();
            return;
        }

        monthInput.click();
    });
});
</script>
@endsection
