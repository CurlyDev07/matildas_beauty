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
                    @foreach(['2_weeks' => '2 Weeks', '1_month' => '1 Month', '2_months' => '2 Months', '3_months' => '3 Months', '6_months' => '6 Months', '1_year' => '1 Year', 'custom' => 'Custom Date Range'] as $value => $label)
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
                            <td>
                                <div class="tflex titems-center" style="gap:10px;">
                                    @if($row->image_path)
                                        <button type="button" data-analysis-image="{{ asset($row->image_path) }}" aria-label="Preview {{ $row->name }}" style="padding:0;border:0;background:transparent;cursor:zoom-in;flex-shrink:0;">
                                            <img src="{{ asset($row->image_path) }}" alt="{{ $row->name }}" loading="lazy" style="width:40px;height:40px;object-fit:contain;border:1px solid #e5e7eb;border-radius:6px;background:#fff;">
                                        </button>
                                    @else
                                        <span class="wi-item-photo-placeholder" style="width:40px;height:40px;flex-shrink:0;"><i class="fas fa-image"></i></span>
                                    @endif
                                    <div><div class="tfont-bold">{{ $row->name }}</div><div class="ttext-xs wi-muted">{{ $row->sku ?: '—' }}</div></div>
                                </div>
                            </td>
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
<div id="analysisImagePreview" hidden style="position:fixed;z-index:10000;pointer-events:none;padding:8px;border:1px solid #e5e7eb;border-radius:8px;background:#fff;box-shadow:0 12px 32px rgba(0,0,0,.16);">
    <img alt="" style="display:block;width:220px;height:220px;object-fit:contain;">
</div>
<script>
document.getElementById('analysisPeriod').addEventListener('change', function () {
    var custom = this.value === 'custom';
    document.querySelectorAll('[data-custom-date]').forEach(function (field) {
        field.style.display = custom ? '' : 'none';
    });
});
var imagePreview = document.getElementById('analysisImagePreview');
document.querySelectorAll('[data-analysis-image]').forEach(function (button) {
    function showPreview() {
        var rect = button.getBoundingClientRect();
        var size = Math.min(238, window.innerWidth - 16, window.innerHeight - 16);
        var image = imagePreview.querySelector('img');
        image.src = button.getAttribute('data-analysis-image');
        image.alt = button.querySelector('img').alt;
        image.style.width = image.style.height = (size - 18) + 'px';
        imagePreview.style.left = Math.max(8, Math.min(rect.right + 12, window.innerWidth - size - 8)) + 'px';
        imagePreview.style.top = Math.max(8, Math.min(rect.top, window.innerHeight - size - 8)) + 'px';
        imagePreview.hidden = false;
    }
    button.addEventListener('mouseenter', showPreview);
    button.addEventListener('focus', showPreview);
    button.addEventListener('mouseleave', function () { imagePreview.hidden = true; });
    button.addEventListener('blur', function () { imagePreview.hidden = true; });
});
window.addEventListener('scroll', function () { imagePreview.hidden = true; }, true);
window.addEventListener('resize', function () { imagePreview.hidden = true; });
</script>
@endsection
