@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Warehouse Labels</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Barcodes</h4>
                <div class="ttext-sm wi-muted">Manage internal item barcodes and generate printable barcode images.</div>
            </div>
            <div class="tflex titems-center tflex-wrap" style="gap:10px;">
                <div class="wi-mini-stat">
                    <span>With Barcode</span>
                    <strong>{{ number_format($barcodeCount) }}</strong>
                </div>
                <div class="wi-mini-stat wi-mini-stat-warn">
                    <span>Missing</span>
                    <strong>{{ number_format($missingBarcodeCount) }}</strong>
                </div>
            </div>
        </div>
    </div>

    <div class="wi-panel">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                <div>
                    <div class="tfont-bold wi-section-title">Barcode Registry</div>
                    <div class="ttext-xs wi-muted">Bulk-generate missing barcodes without replacing existing item codes.</div>
                </div>
                <form method="GET" action="{{ route('warehouse_inventory.barcodes') }}" class="tflex titems-end tflex-wrap" style="gap:8px;">
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
                        <select name="tag_id" class="browser-default wi-select" style="width:140px;height:41px !important;">
                            <option value="">All tags</option>
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}" {{ (string) request('tag_id') === (string) $tag->id ? 'selected' : '' }}>{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="wi-form-label">Barcode</label>
                        <select name="barcode_status" class="browser-default wi-select" style="width:140px;height:41px !important;">
                            <option value="">All items</option>
                            <option value="missing" {{ request('barcode_status') === 'missing' ? 'selected' : '' }}>Missing only</option>
                            <option value="with" {{ request('barcode_status') === 'with' ? 'selected' : '' }}>With barcode</option>
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
                    @if(request()->hasAny(['search', 'category_id', 'tag_id', 'barcode_status']))
                        <a href="{{ route('warehouse_inventory.barcodes', ['per_page' => $perPage]) }}" class="wi-btn-light waves-effect" style="height:41px;padding:0 12px;">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <form method="POST" action="{{ route('warehouse_inventory.barcodes.generate') }}" id="barcodeBulkForm">
            @csrf
            <div class="tpx-4 tpy-3 tborder-b tborder-gray-200 tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                <div class="tflex titems-center" style="gap:10px;">
                    <label class="wi-check-row">
                        <input type="checkbox" class="browser-default" id="selectAllBarcodeItems">
                        <span>Select visible rows</span>
                    </label>
                    <span class="ttext-xs wi-muted" id="selectedBarcodeCount">0 selected</span>
                </div>
                <button type="submit" class="wi-btn-primary waves-effect" id="generateSelectedBarcodes">
                    <i class="fas fa-barcode tmr-2"></i> Generate Selected
                </button>
            </div>

            <div class="wi-overflow">
                <table class="wi-table tw-full ttext-sm">
                    <thead>
                        <tr class="ttext-xs tuppercase">
                            <th class="ttext-left tpx-4 tpy-3" style="width:48px;"></th>
                            <th class="ttext-left tpx-4 tpy-3">Image</th>
                            <th class="ttext-left tpx-4 tpy-3">Item</th>
                            <th class="ttext-left tpx-4 tpy-3">SKU</th>
                            <th class="ttext-left tpx-4 tpy-3">Barcode</th>
                            <th class="ttext-left tpx-4 tpy-3">Preview</th>
                            <th class="ttext-left tpx-4 tpy-3">Category</th>
                            <th class="ttext-left tpx-4 tpy-3">Tags</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($items as $item)
                            @php
                                $cat = $item->category;
                                $categoryParts = collect([$cat ? optional(optional($cat)->parent)->parent : null, $cat ? $cat->parent : null, $cat])->filter();
                            @endphp
                            <tr class="tborder-t tborder-gray-200">
                                <td class="tpx-4 tpy-3">
                                    <input type="checkbox" name="item_ids[]" value="{{ $item->id }}" class="browser-default barcode-row-checkbox">
                                </td>
                                <td class="tpx-4 tpy-3">
                                    @if($item->image_path)
                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="wi-item-photo">
                                    @else
                                        <span class="wi-item-photo-placeholder"><i class="fas fa-image"></i></span>
                                    @endif
                                </td>
                                <td class="tpx-4 tpy-3">
                                    <div class="tfont-bold wi-section-title">{{ $item->name }}</div>
                                    <div class="ttext-xs wi-muted">ID #{{ $item->id }}</div>
                                </td>
                                <td class="tpx-4 tpy-3 tfont-bold">{{ $item->sku ?: '-' }}</td>
                                <td class="tpx-4 tpy-3">
                                    @if($item->barcode)
                                        <span class="wi-code"><i class="fas fa-barcode"></i>{{ $item->barcode }}</span>
                                    @else
                                        <span class="wi-pill wi-missing-pill">Missing</span>
                                    @endif
                                </td>
                                <td class="tpx-4 tpy-3">
                                    @if($item->barcode)
                                        <div class="wi-barcode-card">
                                            <img src="{{ route('warehouse_inventory.barcodes.image', $item->id) }}" alt="{{ $item->barcode }}">
                                            <a href="{{ route('warehouse_inventory.barcodes.image', $item->id) }}" download="{{ $item->barcode }}.svg" class="wi-barcode-download" title="Download barcode">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </div>
                                    @else
                                        <div class="wi-barcode-empty">
                                            <i class="fas fa-magic"></i>
                                            <span>Generate first</span>
                                        </div>
                                    @endif
                                </td>
                                <td class="tpx-4 tpy-3">{{ $categoryParts->pluck('name')->implode(' / ') ?: '-' }}</td>
                                <td class="tpx-4 tpy-3">
                                    @forelse($item->tags as $tag)
                                        <span class="wi-pill tmb-1">{{ $tag->name }}</span>
                                    @empty
                                        <span class="wi-muted">-</span>
                                    @endforelse
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="tpx-4 tpy-8 ttext-center wi-muted">No inventory items found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </form>

        <div class="tp-4">
            {{ $items->appends(request()->only(['search', 'category_id', 'tag_id', 'barcode_status', 'per_page']))->links() }}
        </div>
    </div>
</div>

<style>
    .wi-mini-stat {
        min-width: 132px;
        border: 1px solid #ffd6e8;
        background: #fff;
        border-radius: 12px;
        padding: 10px 12px;
        box-shadow: 0 10px 24px rgba(61, 81, 112, .08);
    }

    .wi-mini-stat span {
        display: block;
        color: #667085;
        font-size: 11px;
        font-weight: 800;
        text-transform: uppercase;
    }

    .wi-mini-stat strong {
        display: block;
        color: #f40167;
        font-size: 22px;
        line-height: 1.1;
    }

    .wi-mini-stat-warn strong {
        color: #f59e0b;
    }

    .wi-check-row {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin: 0;
        color: #23324d;
        font-size: 13px;
        font-weight: 800;
    }

    .barcode-row-checkbox,
    #selectAllBarcodeItems {
        opacity: 1 !important;
        pointer-events: auto !important;
        position: static !important;
        width: 16px !important;
        height: 16px !important;
    }

    .wi-missing-pill {
        background: #fff7ed;
        color: #c2410c;
        border-color: #fed7aa;
    }

    .wi-barcode-card {
        position: relative;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 190px;
        max-width: 240px;
        min-height: 76px;
        border: 1px solid #e4e9f2;
        border-radius: 10px;
        background: #fff;
        padding: 8px;
        box-shadow: 0 6px 18px rgba(61, 81, 112, .08);
    }

    .wi-barcode-card img {
        display: block;
        width: 100%;
        max-height: 70px;
        object-fit: contain;
    }

    .wi-barcode-download {
        position: absolute;
        inset: 0;
        border-radius: 10px;
        background: rgba(35, 50, 77, .74);
        color: #fff;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        visibility: hidden;
        transition: opacity .16s ease, visibility .16s ease;
        text-decoration: none;
        font-size: 22px;
    }

    .wi-barcode-card:hover .wi-barcode-download {
        opacity: 1;
        visibility: visible;
    }

    .wi-barcode-download:hover,
    .wi-barcode-download:focus {
        color: #fff;
        text-decoration: none;
    }

    .wi-barcode-empty {
        min-width: 190px;
        min-height: 76px;
        border: 1px dashed #f9a8d4;
        border-radius: 10px;
        background: #fff7fb;
        color: #be185d;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 12px;
        font-weight: 800;
    }
</style>

<script>
    (function () {
        var selectAll = document.getElementById('selectAllBarcodeItems');
        var checkboxes = Array.prototype.slice.call(document.querySelectorAll('.barcode-row-checkbox'));
        var countLabel = document.getElementById('selectedBarcodeCount');
        var form = document.getElementById('barcodeBulkForm');

        function updateCount() {
            var count = checkboxes.filter(function (checkbox) {
                return checkbox.checked;
            }).length;
            countLabel.textContent = count + ' selected';
            if (selectAll) {
                selectAll.checked = checkboxes.length > 0 && count === checkboxes.length;
                selectAll.indeterminate = count > 0 && count < checkboxes.length;
            }
        }

        if (selectAll) {
            selectAll.addEventListener('change', function () {
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = selectAll.checked;
                });
                updateCount();
            });
        }

        checkboxes.forEach(function (checkbox) {
            checkbox.addEventListener('change', updateCount);
        });

        if (form) {
            form.addEventListener('submit', function (event) {
                var selected = checkboxes.some(function (checkbox) {
                    return checkbox.checked;
                });

                if (!selected) {
                    event.preventDefault();
                    alert('Select at least one item first.');
                }
            });
        }

        updateCount();
    })();
</script>
@endsection
