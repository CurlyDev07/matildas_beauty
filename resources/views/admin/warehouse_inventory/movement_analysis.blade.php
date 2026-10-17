@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')
<div class="wi-page">
    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Analytics</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Movement Analysis</h4>
                <div class="ttext-sm wi-muted">{{ $startDate->format('M d, Y') }} to {{ $endDate->format('M d, Y') }}</div>
            </div>
            <div class="ttext-right">
                <div class="ttext-xs wi-muted">Total Matching Stock Value</div>
                <div class="ttext-2xl tfont-bold" style="color:#15803d;">₱{{ number_format($totalInventoryValue, 2) }}</div>
                <div class="ttext-xs wi-muted">{{ number_format($rows->total()) }} products · Current stock × cost</div>
            </div>
        </div>
    </div>

    <div class="wi-panel tmb-5 tp-4">
        @if($errors->any())
            <div class="tmb-3 ttext-sm" style="color:#dc2626;">{{ $errors->first() }}</div>
        @endif
        <form method="GET" action="{{ route('warehouse_inventory.movement_analysis') }}" class="tflex tflex-wrap titems-end" style="gap:10px;">
            <div>
                <label for="analysisPeriod" class="wi-form-label">Period</label>
                <select id="analysisPeriod" name="period" class="browser-default wi-select" style="height:41px;width:175px;">
                    @foreach(['2_weeks' => '2 Weeks', '1_month' => '1 Month', '2_months' => '2 Months', '3_months' => '3 Months', 'custom' => 'Custom Date Range'] as $value => $label)
                        <option value="{{ $value }}" {{ $period === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div data-custom-date style="{{ $period !== 'custom' ? 'display:none;' : '' }}">
                <label for="analysisStart" class="wi-form-label">From</label>
                <input id="analysisStart" type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="browser-default wi-input" style="height:41px;width:155px;">
            </div>
            <div data-custom-date style="{{ $period !== 'custom' ? 'display:none;' : '' }}">
                <label for="analysisEnd" class="wi-form-label">To</label>
                <input id="analysisEnd" type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="browser-default wi-input" style="height:41px;width:155px;">
            </div>
            <div>
                <label for="analysisThreshold" class="wi-form-label">Stock-Out Qty ≤</label>
                <input id="analysisThreshold" type="number" name="threshold" min="0" step="0.001" value="{{ $threshold }}" class="browser-default wi-input" style="height:41px;width:125px;">
            </div>
            <div>
                <label for="analysisMovement" class="wi-form-label">Movement</label>
                <select id="analysisMovement" name="movement" class="browser-default wi-select" style="height:41px;width:175px;">
                    @foreach(['all' => 'All', 'non_moving' => 'Non-Moving (0)', 'slow_moving' => 'Slow-Moving (> 0)'] as $value => $label)
                        <option value="{{ $value }}" {{ $movement === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="analysisSort" class="wi-form-label">Sort By</label>
                <select id="analysisSort" name="sort" class="browser-default wi-select" style="height:41px;width:220px;">
                    @foreach(['stock_desc' => 'Current Stock: Highest', 'stock_asc' => 'Current Stock: Lowest', 'out_desc' => 'Stock-Out Qty: Highest', 'out_asc' => 'Stock-Out Qty: Lowest', 'value_desc' => 'Inventory Value: Highest'] as $value => $label)
                        <option value="{{ $value }}" {{ $sort === $value ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="analysisPerPage" class="wi-form-label">Per Page</label>
                <select id="analysisPerPage" name="per_page" class="browser-default wi-select" style="height:41px;width:85px;">
                    @foreach([25, 50, 100, 200] as $value)
                        <option value="{{ $value }}" {{ $perPage == $value ? 'selected' : '' }}>{{ $value }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="wi-btn-primary" style="height:41px;"><i class="fas fa-filter tmr-2"></i> Filter</button>
            <a href="{{ route('warehouse_inventory.movement_analysis') }}" class="wi-btn-light" title="Reset filters" style="height:41px;"><i class="fas fa-times"></i></a>
        </form>
    </div>

    <div class="wi-panel">
        <div class="wi-overflow tpx-5">
            <table class="wi-table tw-full ttext-sm">
                <thead>
                    <tr>
                        <th >Product Name</th><th class="ttext-right">Stock-Out Qty</th>
                        <th  class="ttext-right">Current Stock</th><th>Last Stock-Out Date</th>
                        <th class="ttext-right">Inventory Value</th><th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rows as $row)
                        <tr>
                            <td><div class="tfont-bold">{{ $row->name }}</div><div class="ttext-xs wi-muted">{{ $row->sku ?: '—' }}</div></td>
                            <td class="ttext-right">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $row->stock_out_qty, 'unit' => $row->short_name])</td>
                            <td class="ttext-right tfont-bold">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $row->current_stock, 'unit' => $row->short_name]) <span class="ttext-xs wi-muted">{{ $row->short_name }}</span></td>
                            <td>{{ $row->last_stock_out_date ? \Carbon\Carbon::parse($row->last_stock_out_date)->format('M d, Y') : 'Never' }}</td>
                            <td class="ttext-right tfont-bold">₱{{ number_format($row->inventory_value, 2) }}</td>
                            <td><span class="ttext-xs tfont-bold tpx-2 tpy-1 trounded" style="{{ $row->stock_out_qty == 0 ? 'background:#fef2f2;color:#b91c1c;' : 'background:#fffbeb;color:#92400e;' }}">{{ $row->stock_out_qty == 0 ? 'Non-Moving' : 'Slow-Moving' }}</span></td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="ttext-center tpy-5 wi-muted">No products match these filters.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tp-4">{{ $rows->links() }}</div>
    </div>
</div>
<script>
document.getElementById('analysisPeriod').addEventListener('change', function () {
    var custom = this.value === 'custom';
    document.querySelectorAll('[data-custom-date]').forEach(function (field) {
        field.style.display = custom ? '' : 'none';
    });
});
</script>
@endsection
