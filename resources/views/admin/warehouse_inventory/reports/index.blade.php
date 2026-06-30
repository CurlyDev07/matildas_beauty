@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Analytics</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Reports</h4>
                <div class="ttext-sm wi-muted">Product stock movement by day from {{ $startDate->format('M d, Y') }} to {{ $endDate->format('M d, Y') }}.</div>
            </div>
            <a href="{{ route('warehouse_inventory.movements.create') }}" class="wi-btn-primary waves-effect">
                <i class="fas fa-plus tmr-2"></i> New Movement
            </a>
        </div>
    </div>

    <div class="wi-panel tmb-5">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <form method="GET" action="{{ route('warehouse_inventory.reports') }}" class="tflex titems-end tflex-wrap" style="gap:8px;">
                <div>
                    <label class="wi-form-label">Search</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="browser-default wi-input" placeholder="Product, SKU, barcode" style="width:210px;height:41px !important;">
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
                    <select name="tag_id" class="browser-default wi-select" style="width:140px;height:41px !important;">
                        <option value="">All tags</option>
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ (string) request('tag_id') === (string) $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="wi-form-label">Movement</label>
                    <select name="movement_effect" class="browser-default wi-select" style="width:145px;height:41px !important;">
                        <option value="subtract" {{ $movementEffect === 'subtract' ? 'selected' : '' }}>Outbound</option>
                        <option value="add" {{ $movementEffect === 'add' ? 'selected' : '' }}>Inbound</option>
                        <option value="all" {{ $movementEffect === 'all' ? 'selected' : '' }}>All movement</option>
                    </select>
                </div>
                <div>
                    <label class="wi-form-label">Sort</label>
                    <select name="sort_by" class="browser-default wi-select" style="width:160px;height:41px !important;">
                        <option value="name" {{ $sortBy === 'name' ? 'selected' : '' }}>Product A-Z</option>
                        <option value="avg_sales_desc" {{ $sortBy === 'avg_sales_desc' ? 'selected' : '' }}>AVG sales high</option>
                        <option value="avg_sales_asc" {{ $sortBy === 'avg_sales_asc' ? 'selected' : '' }}>AVG sales low</option>
                    </select>
                </div>
                <div>
                    <label class="wi-form-label">Start</label>
                    <input type="date" name="start_date" value="{{ $startDate->format('Y-m-d') }}" class="browser-default wi-input" style="width:145px;height:41px !important;">
                </div>
                <div>
                    <label class="wi-form-label">End</label>
                    <input type="date" name="end_date" value="{{ $endDate->format('Y-m-d') }}" class="browser-default wi-input" style="width:145px;height:41px !important;">
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
                @if(request()->hasAny(['search', 'category_id', 'tag_id', 'movement_effect', 'sort_by', 'start_date', 'end_date']))
                    <a href="{{ route('warehouse_inventory.reports', ['per_page' => $perPage]) }}" class="wi-btn-light waves-effect" style="height:41px;padding:0 12px;">
                        <i class="fas fa-times"></i>
                    </a>
                @endif
            </form>
        </div>
    </div>

    <div class="wi-panel">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                <div>
                    <div class="tfont-bold wi-section-title">Daily Product Movement</div>
                    <div class="ttext-xs wi-muted">AVG Sales is Total Out divided by {{ $dayCount }} day(s), including zero days.</div>
                </div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">
                    {{ $movementEffect === 'subtract' ? 'Outbound' : ($movementEffect === 'add' ? 'Inbound' : 'All') }}
                </div>
            </div>
        </div>
        <div class="wi-overflow">
            <table class="wi-table wi-report-table tw-full ttext-sm">
                <thead>
                    <tr class="ttext-xs tuppercase">
                        <th class="ttext-left tpx-4 tpy-3 wi-sticky-col wi-product-col">Product</th>
                        <th class="ttext-right tpx-4 tpy-3">Current Stock</th>
                        <th class="ttext-right tpx-4 tpy-3">Total Out</th>
                        <th class="ttext-right tpx-4 tpy-3">Total In</th>
                        <th class="ttext-right tpx-4 tpy-3">AVG Sales</th>
                        @foreach($dateColumns as $dateColumn)
                            <th class="ttext-right tpx-3 tpy-3" title="{{ $dateColumn['label'] }}">{{ $dateColumn['short_label'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @forelse($items as $item)
                        @php
                            $daily = $dailyMovements->get($item->id, collect());
                            $totals = $movementTotals->get($item->id, collect());
                            $totalOut = (float) $totals->get('subtract', 0);
                            $totalIn = (float) $totals->get('add', 0);
                            $avgSales = $totalOut / $dayCount;
                            $stockQty = (float) $currentStocks->get($item->id, 0);
                        @endphp
                        <tr class="tborder-t tborder-gray-200">
                            <td class="tpx-4 tpy-3 wi-sticky-col wi-product-col">
                                <div class="tflex titems-center" style="gap:10px;">
                                    @if($item->image_path)
                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="wi-item-photo">
                                    @else
                                        <span class="wi-item-photo-placeholder"><i class="fas fa-image"></i></span>
                                    @endif
                                    <div style="min-width:0;">
                                        <div class="tfont-bold wi-section-title wi-truncate" title="{{ $item->name }}">{{ $item->name }}</div>
                                        <div class="ttext-xs wi-muted wi-truncate">{{ $item->sku ?: 'No SKU' }} · {{ optional($item->unit)->short_name ?: '-' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold wi-section-title">
                                @include('admin.warehouse_inventory.partials.quantity', ['quantity' => $stockQty, 'unit' => optional($item->unit)->short_name])
                            </td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold" style="color:#dc2626;">
                                {{ $totalOut > 0 ? number_format($totalOut, $totalOut == floor($totalOut) ? 0 : 2) : '-' }}
                            </td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold" style="color:#059669;">
                                {{ $totalIn > 0 ? number_format($totalIn, $totalIn == floor($totalIn) ? 0 : 2) : '-' }}
                            </td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold" style="color:#f40167;">
                                {{ number_format($avgSales, $avgSales == floor($avgSales) ? 0 : 2) }}
                            </td>
                            @foreach($dateColumns as $dateColumn)
                                @php $qty = (float) $daily->get($dateColumn['key'], 0); @endphp
                                <td class="tpx-3 tpy-3 ttext-right {{ $qty > 0 ? 'tfont-bold wi-section-title' : 'wi-muted' }}">
                                    {{ $qty > 0 ? number_format($qty, $qty == floor($qty) ? 0 : 2) : '-' }}
                                </td>
                            @endforeach
                        </tr>
                    @empty
                        <tr>
                            <td colspan="{{ 5 + $dateColumns->count() }}" class="tpx-4 tpy-8 ttext-center wi-muted">No inventory items found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="tp-4">
            {{ $items->appends(request()->only(['search', 'category_id', 'tag_id', 'movement_effect', 'sort_by', 'start_date', 'end_date', 'per_page']))->links() }}
        </div>
    </div>
</div>

<style>
    .wi-report-table {
        min-width: 1120px;
    }

    .wi-report-table th,
    .wi-report-table td {
        white-space: nowrap;
    }

    .wi-sticky-col {
        position: sticky;
        left: 0;
        z-index: 2;
        background: inherit;
        box-shadow: 1px 0 0 #e4e9f2;
    }

    .wi-report-table thead .wi-sticky-col {
        z-index: 3;
        background: #fff7fb;
    }

    .wi-report-table tbody tr:nth-child(even) .wi-sticky-col {
        background: #fbfcff;
    }

    .wi-report-table tbody tr:hover .wi-sticky-col {
        background: #fff4d8;
    }

    .wi-product-col {
        min-width: 290px;
        max-width: 290px;
    }
</style>
@endsection
