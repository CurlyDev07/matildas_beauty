@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<style>
    .po-draft-grid {
        display: grid;
        grid-template-columns: minmax(340px, 38%) minmax(0, 1fr);
        gap: 16px;
    }

    .po-product-list {
        max-height: calc(100vh - 285px);
        overflow-y: auto;
    }

    .po-product-row {
        width: 100%;
        border: 0;
        border-bottom: 1px solid #edf1f7;
        background: #fff;
        padding: 12px 14px;
        cursor: pointer;
        text-align: left;
        transition: background .16s ease, transform .16s ease;
    }

    .po-product-row:hover {
        background: #fff7fb;
        transform: translateX(2px);
    }

    .po-product-row.is-selected {
        background: #fff0f7;
        border-left: 4px solid #f40167;
    }

    .po-draft-empty {
        min-height: 330px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: #667085;
    }

    .po-qty-input {
        width: 110px;
        height: 38px !important;
        text-align: right;
    }

    .po-summary-card {
        border: 1px solid #ffd6e8;
        background: linear-gradient(135deg, #fff7fb 0%, #ffffff 100%);
        border-radius: 12px;
        padding: 14px;
    }

    .po-range-pill {
        height: 36px;
        min-width: 54px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #e4e9f2;
        border-radius: 999px;
        padding: 0 14px;
        background: #fff;
        color: #667085;
        font-size: 12px;
        font-weight: 900;
        transition: background .16s ease, color .16s ease, border-color .16s ease, transform .16s ease;
    }

    .po-range-pill:hover {
        background: #fff7fb;
        color: #f40167;
        border-color: #ffd6e8;
        transform: translateY(-1px);
        text-decoration: none;
    }

    .po-range-pill.is-active {
        background: linear-gradient(135deg, #f40167, #f4ad2b);
        color: #fff;
        border-color: transparent;
        box-shadow: 0 10px 24px rgba(244, 1, 103, .18);
    }

    .po-coverage-control {
        min-height: 46px;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        border: 1px solid #ffd6e8;
        border-radius: 999px;
        background: linear-gradient(135deg, #ffffff 0%, #fff7fb 100%);
        padding: 5px 8px 5px 14px;
        box-shadow: 0 10px 24px rgba(244, 1, 103, .10);
    }

    .po-coverage-label {
        color: #f40167;
        font-size: 11px;
        font-weight: 900;
        text-transform: uppercase;
        white-space: nowrap;
    }

    .po-coverage-input {
        width: 74px;
        height: 34px !important;
        border-radius: 999px !important;
        text-align: center;
        font-weight: 900;
    }

    .po-print-title {
        display: none;
    }

    @media (max-width: 992px) {
        .po-draft-grid {
            grid-template-columns: 1fr;
        }

        .po-product-list {
            max-height: 420px;
        }
    }

    @media print {
        body * {
            visibility: hidden !important;
        }

        .po-print-area,
        .po-print-area * {
            visibility: visible !important;
        }

        .po-print-area {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            border: 0 !important;
            box-shadow: none !important;
            border-radius: 0 !important;
        }

        .po-print-hidden {
            display: none !important;
        }

        .po-print-title {
            display: block;
            padding: 0 0 14px;
            margin-bottom: 14px;
            border-bottom: 1px solid #e4e9f2;
        }

        .po-summary-card {
            box-shadow: none !important;
            -webkit-print-color-adjust: exact;
            print-color-adjust: exact;
        }

        .wi-table {
            width: 100% !important;
        }

        @page {
            margin: 16mm;
        }
    }
</style>

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Purchase Planning</div>
                <h4 class="tm-0 tfont-bold wi-section-title">P.O Draft</h4>
                <div class="ttext-sm wi-muted">
                    Draft purchase qtys from inventory cost and avg daily orders from {{ $startDate->format('M d') }} to {{ $endDate->format('M d, Y') }}.
                </div>
            </div>
            <div class="tflex titems-center tflex-wrap" style="gap:10px;">
                <div class="po-coverage-control">
                    <label for="poCoverageDays" class="po-coverage-label">Stock Coverage Days</label>
                    <input type="number" min="1" step="1" value="5" id="poCoverageDays" class="browser-default wi-input po-coverage-input">
                </div>
                <div class="tflex titems-center tflex-wrap tbg-white tborder tborder-gray-200 trounded-full tpx-2 tpy-1" style="gap:6px;">
                    <span class="ttext-xs tfont-bold tuppercase tpx-2" style="color:#f40167;">AVG Filter</span>
                    @foreach([7, 14, 30] as $days)
                        <a href="{{ route('warehouse_inventory.po_draft', ['avg_range' => $days]) }}" class="po-range-pill {{ $avgRangeDays === $days ? 'is-active' : '' }}">
                            {{ $days }}d
                        </a>
                    @endforeach
                </div>
                <a href="{{ route('warehouse_inventory.items') }}" class="wi-btn-dark waves-effect">
                    <i class="fas fa-box-open tmr-2"></i> Inventory Items
                </a>
            </div>
        </div>
    </div>

    <div class="po-draft-grid">
        <div class="wi-panel">
            <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
                <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:10px;">
                    <div>
                        <div class="tfont-bold wi-section-title">Product List</div>
                        <div class="ttext-xs wi-muted">Click a product to add it to the draft.</div>
                    </div>
                    <span class="wi-pill">{{ number_format($items->count()) }} items</span>
                </div>
                <div class="tmt-3">
                    <input type="text" id="poProductSearch" class="browser-default wi-input tw-full" placeholder="Search product or SKU" style="height:41px !important;">
                </div>
            </div>

            <div class="po-product-list" id="poProductList">
                @forelse($items as $item)
                    <button type="button"
                        class="po-product-row"
                        data-po-product-id="{{ $item->id }}"
                        data-search="{{ strtolower($item->name . ' ' . $item->sku) }}">
                        <div class="tflex titems-start tjustify-between" style="gap:12px;">
                            <div class="tmin-w-0">
                                <div class="tfont-bold wi-section-title wi-truncate" title="{{ $item->name }}">{{ $item->name }}</div>
                                <div class="ttext-xs wi-muted tmt-1">SKU: {{ $item->sku ?: 'No SKU' }}</div>
                                <div class="ttext-xs tfont-bold tmt-2" style="color:#f40167;">
	                                    Avg Daily Order ({{ $avgRangeDays }}d): {{ number_format($item->po_avg_daily_orders, 2) }}
                                </div>
                            </div>
                            <div class="ttext-right">
                                <div class="ttext-xs wi-muted">Cost</div>
                                <div class="tfont-bold wi-section-title">&#8369;{{ number_format((float) $item->cost, 2) }}</div>
                                <div class="ttext-xs wi-muted tmt-2">{{ number_format($item->po_order_count_range) }} orders</div>
                            </div>
                        </div>
                    </button>
                @empty
                    <div class="tpx-4 tpy-8 ttext-center wi-muted">No inventory products yet.</div>
                @endforelse
            </div>
        </div>

        <div class="wi-panel po-print-area" id="poPrintablePanel">
            <div class="po-print-title">
                <div style="font-size:11px;font-weight:800;text-transform:uppercase;color:#f40167;">Purchase Planning</div>
                <div style="font-size:24px;font-weight:800;color:#23324d;line-height:1.2;">P.O Draft</div>
                <div style="font-size:12px;color:#667085;">Generated {{ now()->format('M d, Y h:i A') }} · Avg daily orders ({{ $avgRangeDays }}d) from {{ $startDate->format('M d') }} to {{ $endDate->format('M d, Y') }} · Stock coverage: <span class="po-print-coverage-days">5</span> days</div>
            </div>
            <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
                <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                    <div>
                        <div class="tfont-bold wi-section-title">Purchase Order Draft</div>
	                        <div class="ttext-xs wi-muted">Suggested P.O Qty uses Avg Daily Order × <span class="po-print-coverage-days">5</span> stock coverage days.</div>
                    </div>
                    <div class="tflex titems-center tflex-wrap" style="gap:10px;">
                        <button type="button" id="poPrintButton" class="wi-btn-primary waves-effect po-print-hidden">
                            <i class="fas fa-print tmr-2"></i> Export PDF
                        </button>
                        <div class="po-summary-card">
                            <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Draft Total</div>
                            <div class="ttext-2xl tfont-bold wi-section-title">&#8369;<span id="poGrandTotal">0.00</span></div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="poDraftEmpty" class="po-draft-empty">
                <div>
                    <div class="ttext-3xl tmb-2" style="color:#f40167;"><i class="fas fa-file-invoice-dollar"></i></div>
                    <div class="tfont-bold wi-section-title">No products selected</div>
                    <div class="ttext-sm wi-muted">Choose products from the left list to start drafting.</div>
                </div>
            </div>

            <div id="poDraftTableWrap" class="toverflow-x-auto" style="display:none;">
                <table class="wi-table tw-full ttext-sm">
                    <thead>
                        <tr class="ttext-xs tuppercase">
                            <th class="ttext-left tpx-4 tpy-3">Product</th>
                            <th class="ttext-right tpx-4 tpy-3">Avg Daily ({{ $avgRangeDays }}d)</th>
                            <th class="ttext-right tpx-4 tpy-3">Cost</th>
                            <th class="ttext-right tpx-4 tpy-3">P.O Qty</th>
                            <th class="ttext-right tpx-4 tpy-3">Total</th>
                            <th class="ttext-center tpx-4 tpy-3 po-print-hidden">Action</th>
                        </tr>
                    </thead>
                    <tbody id="poDraftRows"></tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var products = @json($poItems);
    var productsById = {};
    var selected = {};
    var productRows = document.querySelectorAll('.po-product-row');
    var draftRows = document.getElementById('poDraftRows');
    var emptyState = document.getElementById('poDraftEmpty');
    var tableWrap = document.getElementById('poDraftTableWrap');
    var grandTotal = document.getElementById('poGrandTotal');
    var searchInput = document.getElementById('poProductSearch');
    var printButton = document.getElementById('poPrintButton');
    var coverageInput = document.getElementById('poCoverageDays');
    var coverageLabels = document.querySelectorAll('.po-print-coverage-days');

    products.forEach(function (product) {
        productsById[product.id] = product;
    });

    function money(value) {
        return Number(value || 0).toLocaleString('en-US', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
    }

    function coverageDays() {
        return Math.max(Number(coverageInput && coverageInput.value ? coverageInput.value : 1), 1);
    }

    function suggestedPoQty(product) {
        return cleanQty(Number(product.avg_daily_orders || 0) * coverageDays());
    }

    function cleanQty(value) {
        var rounded = Math.round(Number(value || 0) * 100) / 100;

        if (Number.isInteger(rounded)) {
            return String(rounded);
        }

        return String(rounded).replace(/0+$/, '').replace(/\.$/, '');
    }

    function syncCoverageLabels() {
        coverageLabels.forEach(function (label) {
            label.textContent = coverageDays();
        });
    }

    function showPoToast(message) {
        var wrap = document.querySelector('.wi-toast-wrap');

        if (!wrap) {
            wrap = document.createElement('div');
            wrap.className = 'wi-toast-wrap';
            document.body.appendChild(wrap);
        }

        var existingToast = document.getElementById('poCoverageToast');
        if (existingToast && existingToast.parentNode) {
            existingToast.parentNode.removeChild(existingToast);
        }

        var toast = document.createElement('div');
        toast.id = 'poCoverageToast';
        toast.className = 'wi-toast wi-toast-success';
        toast.innerHTML =
            '<i class="fas fa-check-circle"></i>' +
            '<div>' +
                '<div class="tfont-bold">P.O Draft Updated</div>' +
                '<div class="ttext-sm">' + escapeHtml(message) + '</div>' +
            '</div>' +
            '<button type="button" class="wi-toast-close" aria-label="Close notification"><i class="fas fa-times"></i></button>';

        wrap.appendChild(toast);

        toast.querySelector('.wi-toast-close').addEventListener('click', function () {
            dismissPoToast(toast);
        });

        setTimeout(function () {
            dismissPoToast(toast);
        }, 4200);
    }

    function dismissPoToast(toast) {
        if (!toast || !toast.parentNode) {
            return;
        }

        toast.classList.add('is-hiding');
        setTimeout(function () {
            if (toast.parentNode) {
                toast.parentNode.removeChild(toast);
            }
        }, 300);
    }

    function resetDraftQuantitiesFromCoverage() {
        Object.keys(selected).forEach(function (id) {
            selected[id].po_qty = suggestedPoQty(selected[id]);
            selected[id].is_manual_qty = false;
        });
    }

    function renderDraft() {
        var ids = Object.keys(selected);
        var total = 0;

        emptyState.style.display = ids.length ? 'none' : 'flex';
        tableWrap.style.display = ids.length ? 'block' : 'none';
        draftRows.innerHTML = '';

        ids.forEach(function (id) {
            var product = selected[id];
            var qty = Number(product.po_qty || 0);
            var rowTotal = qty * Number(product.cost || 0);
            total += rowTotal;

            var tr = document.createElement('tr');
            tr.className = 'tborder-t tborder-gray-200';
            tr.innerHTML =
                '<td class="tpx-4 tpy-3">' +
                    '<div class="tfont-bold wi-section-title">' + escapeHtml(product.name) + '</div>' +
                    '<div class="ttext-xs wi-muted">SKU: ' + escapeHtml(product.sku || 'No SKU') + '</div>' +
                '</td>' +
                '<td class="tpx-4 tpy-3 ttext-right tfont-bold" style="color:#f40167;">' + money(product.avg_daily_orders) + '</td>' +
                '<td class="tpx-4 tpy-3 ttext-right wi-section-title tfont-bold">&#8369;' + money(product.cost) + '</td>' +
                '<td class="tpx-4 tpy-3 ttext-right">' +
                    '<input type="number" min="0" step="0.01" value="' + (product.po_qty || '') + '" class="browser-default wi-input po-qty-input" data-po-qty-id="' + product.id + '" placeholder="0">' +
                '</td>' +
                '<td class="tpx-4 tpy-3 ttext-right tfont-bold wi-section-title">&#8369;<span data-po-row-total-id="' + product.id + '">' + money(rowTotal) + '</span></td>' +
                '<td class="tpx-4 tpy-3 ttext-center po-print-hidden">' +
                    '<button type="button" class="wi-row-action-btn wi-row-action-delete" data-po-remove-id="' + product.id + '" title="Remove"><i class="fas fa-times"></i></button>' +
                '</td>';

            draftRows.appendChild(tr);
        });

        grandTotal.textContent = money(total);
        bindDraftControls();
    }

    function updateDraftTotals() {
        var total = 0;

        Object.keys(selected).forEach(function (id) {
            var product = selected[id];
            var rowTotal = Number(product.po_qty || 0) * Number(product.cost || 0);
            var rowTotalEl = document.querySelector('[data-po-row-total-id="' + id + '"]');

            total += rowTotal;

            if (rowTotalEl) {
                rowTotalEl.textContent = money(rowTotal);
            }
        });

        grandTotal.textContent = money(total);
    }

    function bindDraftControls() {
        document.querySelectorAll('[data-po-qty-id]').forEach(function (input) {
            input.addEventListener('input', function () {
                var id = this.getAttribute('data-po-qty-id');
                selected[id].po_qty = this.value;
                selected[id].is_manual_qty = true;
                updateDraftTotals();
            });
        });

        document.querySelectorAll('[data-po-remove-id]').forEach(function (button) {
            button.addEventListener('click', function () {
                var id = this.getAttribute('data-po-remove-id');
                delete selected[id];
                markProductRows();
                renderDraft();
            });
        });
    }

    function markProductRows() {
        productRows.forEach(function (row) {
            row.classList.toggle('is-selected', !!selected[row.getAttribute('data-po-product-id')]);
        });
    }

    function escapeHtml(value) {
        return String(value || '').replace(/[&<>"']/g, function (char) {
            return {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            }[char];
        });
    }

    productRows.forEach(function (row) {
        row.addEventListener('click', function () {
            var id = this.getAttribute('data-po-product-id');
            if (!selected[id] && productsById[id]) {
                selected[id] = Object.assign({}, productsById[id], {
                    po_qty: suggestedPoQty(productsById[id]),
                    is_manual_qty: false
                });
            }
            markProductRows();
            renderDraft();
        });
    });

    var coverageToastTimer = null;

    function handleCoverageChange() {
        syncCoverageLabels();
        resetDraftQuantitiesFromCoverage();
        renderDraft();
        updateDraftTotals();

        if (coverageToastTimer) {
            clearTimeout(coverageToastTimer);
        }

        coverageToastTimer = setTimeout(function () {
            showPoToast('Selected product quantities were reset using ' + coverageDays() + ' stock coverage days.');
        }, 350);
    }

    if (searchInput) {
        searchInput.addEventListener('input', function () {
            var value = this.value.trim().toLowerCase();
            productRows.forEach(function (row) {
                row.style.display = row.getAttribute('data-search').indexOf(value) !== -1 ? 'block' : 'none';
            });
        });
    }

    if (printButton) {
        printButton.addEventListener('click', function () {
            window.print();
        });
    }

    if (coverageInput) {
        coverageInput.addEventListener('input', handleCoverageChange);
        coverageInput.addEventListener('change', handleCoverageChange);
        syncCoverageLabels();
    }
});
</script>
@endsection
