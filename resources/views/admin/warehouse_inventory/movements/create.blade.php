@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<style>
    .wi-stock-pill {
        font-weight: 800;
    }

    .wi-stock-good {
        color: #16a34a;
    }

    .wi-stock-low {
        color: #dc2626;
    }

    .wi-stock-zero {
        color: #94a3b8;
    }

    .wi-catalog-item-empty {
        background: #f8fafc !important;
        border-color: #e5e7eb !important;
        opacity: .72;
        cursor: not-allowed !important;
    }

    .wi-catalog-item-empty .wi-section-title,
    .wi-catalog-item-empty .wi-muted {
        color: #94a3b8 !important;
    }

    .wi-catalog-item-empty:hover {
        transform: none !important;
        box-shadow: none !important;
    }

    .wi-selected-item-stock-error {
        background: #fef2f2 !important;
        border: 1px solid #fecaca !important;
        border-radius: 12px !important;
    }

    .wi-selected-item-stock-error .movement-qty {
        border-color: #ef4444 !important;
        box-shadow: 0 0 0 3px rgba(239, 68, 68, .14) !important;
        color: #b91c1c !important;
        font-weight: 800;
    }

    .wi-selected-item-stock-depleted {
        background: #fffbeb !important;
        border: 1px solid #fde68a !important;
        border-radius: 12px !important;
    }

    .wi-selected-item-stock-depleted .movement-qty {
        border-color: #f59e0b !important;
        box-shadow: 0 0 0 3px rgba(245, 158, 11, .14) !important;
        color: #92400e !important;
        font-weight: 800;
    }

    .wi-stock-warning {
        display: none;
        margin-top: 5px;
        color: #dc2626;
        font-size: 11px;
        font-weight: 800;
        line-height: 1.25;
    }

    .wi-selected-item-stock-error .wi-stock-warning {
        display: block;
    }

    .wi-selected-item-stock-depleted .wi-stock-warning {
        display: block;
        color: #b45309;
    }
</style>

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Audit Trail</div>
                <h4 class="tm-0 tfont-bold wi-section-title">{{ $isEdit ? 'Edit Movement' : 'Create Movement' }}</h4>
                <div class="ttext-sm wi-muted">
                    {{ $isEdit ? 'Update this movement batch and recalculate stock balances.' : 'Create one movement batch for multiple products.' }}
                    @if($isEdit)
                        <span class="wi-code tml-2">{{ $batchCode }}</span>
                    @endif
                </div>
            </div>
            <a href="{{ route('warehouse_inventory.movements') }}" class="wi-btn-dark waves-effect">
                <i class="fas fa-list tmr-2"></i> Movement History
            </a>
        </div>
    </div>

    <div class="wi-panel tp-4">
        <form action="{{ $isEdit ? route('warehouse_inventory.movements.update', $batchCode) : route('warehouse_inventory.movements.store') }}" method="POST">
            @csrf
            @if($isEdit)
                @method('PUT')
            @endif
            <div class="row tmb-0">
                <div class="col s12 m4 tmb-3">
                    <label class="wi-form-label">Movement Type</label>
                    <select name="movement_type_id" class="browser-default wi-select" required>
                        <option value="">Select movement type</option>
                        @foreach($movementTypes as $movementType)
                            <option value="{{ $movementType->id }}" data-stock-effect="{{ $movementType->stock_effect }}" {{ (string) $selectedMovementTypeId === (string) $movementType->id ? 'selected' : '' }}>{{ $movementType->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col s12 m6 tmb-3">
                    <label class="wi-form-label">Notes</label>
                    <input name="notes" type="text" class="browser-default wi-input" value="{{ $selectedNotes }}">
                </div>
                <div class="col s12 m2 tmb-3" style="padding-top:22px;">
                    <button class="wi-btn-primary waves-effect tw-full">
                        <i class="fas fa-save tmr-2"></i> {{ $isEdit ? 'Update' : 'Save' }}
                    </button>
                </div>
            </div>
            <div class="wi-movement-board">
                <div class="wi-movement-catalog">
                    <div class="wi-movement-header">
                        <label class="wi-form-label">Search Products</label>
                        <input type="text" id="movementProductSearch" class="browser-default wi-input" placeholder="Barcode, SKU, or product name" autocomplete="off" autofocus>
                    </div>
                    <div class="wi-product-scroll" id="movementProductCatalog">
                        @foreach($items as $item)
                            @php
                                $remainingStock = $item->stocks->filter(function ($stock) {
                                    $status = optional($stock->status);
                                    return strtolower((string) $status->slug) === 'available' || strtolower((string) $status->name) === 'available';
                                })->sum('quantity');
                                $remainingStock = (float) $remainingStock;
                                $remainingFormatted = fmod($remainingStock, 1.0) === 0.0 ? number_format($remainingStock, 0) : number_format($remainingStock, 3);
                                $stockClass = $remainingStock <= 0 ? 'wi-stock-zero' : ($remainingStock < 10 ? 'wi-stock-low' : 'wi-stock-good');
                            @endphp
                            <button type="button"
                                class="wi-catalog-item"
                                data-id="{{ $item->id }}"
                                data-name="{{ $item->name }}"
                                data-sku="{{ $item->sku }}"
                                data-barcode="{{ $item->barcode }}"
                                data-cost="{{ $item->cost }}"
                                data-image="{{ $item->image_path ? asset($item->image_path) : '' }}"
                                data-stock="{{ $remainingStock }}"
                                data-search="{{ strtolower(trim($item->name . ' ' . $item->sku . ' ' . $item->barcode)) }}">
                                @if($item->image_path)
                                    <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="wi-item-photo tmr-3">
                                @else
                                    <span class="wi-item-photo-placeholder tmr-3"><i class="fas fa-image"></i></span>
                                @endif
                                <span style="min-width:0;">
                                    <span class="tfont-bold wi-section-title wi-truncate">{{ $item->name }}</span>
                                    <span class="ttext-xs wi-muted wi-truncate">
                                        SKU: {{ $item->sku ?: '-' }} · Barcode: {{ $item->barcode ?: '-' }}
                                        · <span class="wi-stock-pill {{ $stockClass }}">
                                            {{ $remainingStock <= 0 ? 'Out of stock' : 'Stock: ' . $remainingFormatted . ' ' . optional($item->unit)->short_name }}
                                        </span>
                                    </span>
                                </span>
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="wi-movement-selected">
                    <div class="wi-movement-header tflex titems-center tjustify-between">
                        <div>
                            <div class="tfont-bold wi-section-title">Selected Products</div>
                            <div class="ttext-xs wi-muted"><span id="selectedMovementCount">0</span> item(s)</div>
                        </div>
                        <button type="button" id="clearMovementItems" class="wi-btn-light waves-effect">
                            <i class="fas fa-times tmr-2"></i> Clear
                        </button>
                    </div>
                    <div class="wi-selected-scroll" id="movementItems">
                        <div class="tpy-8 ttext-center wi-muted" id="emptyMovementItems">Select products from the left.</div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<script>
    (function () {
        var rowsContainer = document.getElementById('movementItems');
        var emptyState = document.getElementById('emptyMovementItems');
        var selectedCount = document.getElementById('selectedMovementCount');
        var searchInput = document.getElementById('movementProductSearch');
        var catalog = document.getElementById('movementProductCatalog');
        var clearButton = document.getElementById('clearMovementItems');
        var movementTypeSelect = document.querySelector('select[name="movement_type_id"]');
        var preloadItems = {!! json_encode($selectedItems) !!};

        setTimeout(function () {
            if (searchInput) {
                searchInput.focus();
            }
        }, 150);

        function updateSelectedState() {
            var rows = rowsContainer.querySelectorAll('.wi-selected-item');
            emptyState.style.display = rows.length ? 'none' : 'block';
            selectedCount.textContent = rows.length;
            Array.prototype.forEach.call(rows, function (row, index) {
                row.querySelector('.movement-item-id').setAttribute('name', 'items[' + index + '][inventory_item_id]');
                row.querySelector('.movement-qty').setAttribute('name', 'items[' + index + '][quantity]');
                row.querySelector('.movement-unit-cost').setAttribute('name', 'items[' + index + '][unit_cost]');
            });
        }

        function imageNode(data) {
            if (data.image) {
                var img = document.createElement('img');
                img.src = data.image;
                img.alt = data.name;
                img.className = 'wi-item-photo tmr-3';
                return img;
            }
            var placeholder = document.createElement('span');
            placeholder.className = 'wi-item-photo-placeholder tmr-3';
            placeholder.innerHTML = '<i class="fas fa-image"></i>';
            return placeholder;
        }

        function addSelectedData(data) {
            var quantityValue = parseFloat(data.quantity || 1);
            quantityValue = quantityValue % 1 === 0 ? quantityValue.toFixed(0) : quantityValue.toString();
            var availableStock = parseFloat(data.stock || 0);
            var availableLabel = availableStock % 1 === 0 ? availableStock.toFixed(0) : availableStock.toString();

            var row = document.createElement('div');
            row.className = 'wi-selected-item';
            row.setAttribute('data-stock', availableStock);
            row.appendChild(imageNode(data));

            var info = document.createElement('div');
            info.style.minWidth = '0';
            info.style.maxWidth = '310px';
            var nameLine = document.createElement('div');
            nameLine.className = 'tfont-bold wi-section-title wi-truncate';
            nameLine.title = data.name;
            nameLine.textContent = data.name;
            var metaLine = document.createElement('div');
            metaLine.className = 'ttext-xs wi-muted wi-truncate';
            metaLine.textContent = 'SKU: ' + (data.sku || '-') + ' · Barcode: ' + (data.barcode || '-');
            info.appendChild(nameLine);
            info.appendChild(metaLine);
            row.appendChild(info);

            var fields = document.createElement('div');
            fields.className = 'wi-selected-fields';
            fields.innerHTML =
                '<input type="hidden" class="browser-default movement-item-id" value="' + data.id + '">' +
                '<div><label class="wi-form-label">Qty</label><input type="number" step="0.001" min="0.001" value="' + quantityValue + '" required class="browser-default wi-input movement-qty"><div class="wi-stock-warning"></div></div>' +
                '<div><label class="wi-form-label">Unit Cost</label><input type="number" step="0.01" min="0" value="' + parseFloat(data.cost || 0).toFixed(2) + '" class="browser-default wi-input movement-unit-cost"></div>' +
                '<span class="wi-row-actions"><button type="button" class="wi-row-action-btn wi-row-action-remove remove-movement-row" title="Remove product"><i class="fas fa-trash"></i></button></span>';
            row.appendChild(fields);

            var quantityInput = fields.querySelector('.movement-qty');

            function validateQuantity() {
                var requestedQty = parseFloat(quantityInput.value || 0);
                var selectedType = movementTypeSelect ? movementTypeSelect.options[movementTypeSelect.selectedIndex] : null;
                var stockEffect = selectedType ? selectedType.getAttribute('data-stock-effect') : '';
                var shouldLimitByStock = stockEffect === 'subtract';
                var hasError = shouldLimitByStock && requestedQty > availableStock;
                var willDeplete = shouldLimitByStock && requestedQty === availableStock;
                var warning = fields.querySelector('.wi-stock-warning');

                row.classList.toggle('wi-selected-item-stock-error', hasError);
                row.classList.toggle('wi-selected-item-stock-depleted', !hasError && willDeplete);
                if (warning) {
                    warning.textContent = hasError
                        ? 'Only ' + availableLabel + ' available.'
                        : (willDeplete ? 'This will leave 0 stock.' : '');
                }
                quantityInput.setCustomValidity(hasError ? 'Quantity cannot be greater than current stock.' : '');
            }

            quantityInput.addEventListener('input', validateQuantity);
            quantityInput.addEventListener('change', validateQuantity);

            fields.querySelector('.remove-movement-row').addEventListener('click', function () {
                row.parentNode.removeChild(row);
                updateSelectedState();
            });

            rowsContainer.appendChild(row);
            validateQuantity();
            updateSelectedState();
        }

        function currentStockEffect() {
            var selectedType = movementTypeSelect ? movementTypeSelect.options[movementTypeSelect.selectedIndex] : null;
            return selectedType ? selectedType.getAttribute('data-stock-effect') : '';
        }

        function refreshCatalogStockState() {
            var stockEffect = currentStockEffect();
            Array.prototype.forEach.call(catalog.querySelectorAll('.wi-catalog-item'), function (option) {
                var remainingStock = parseFloat(option.getAttribute('data-stock') || 0);
                option.classList.toggle('wi-catalog-item-empty', stockEffect === 'subtract' && remainingStock <= 0);
            });
        }

        function addSelectedItem(option) {
            var remainingStock = parseFloat(option.getAttribute('data-stock') || 0);
            var stockEffect = currentStockEffect();

            if (stockEffect === 'subtract' && remainingStock <= 0) {
                return;
            }

            addSelectedData({
                id: option.getAttribute('data-id'),
                name: option.getAttribute('data-name') || '',
                sku: option.getAttribute('data-sku') || '-',
                barcode: option.getAttribute('data-barcode') || '-',
                quantity: 1,
                cost: option.getAttribute('data-cost') || '0',
                image: option.getAttribute('data-image') || '',
                stock: remainingStock
            });
        }

        Array.prototype.forEach.call(catalog.querySelectorAll('.wi-catalog-item'), function (option) {
            option.addEventListener('click', function () {
                addSelectedItem(option);
            });
        });

        if (movementTypeSelect) {
            movementTypeSelect.addEventListener('change', function () {
                refreshCatalogStockState();
                Array.prototype.forEach.call(rowsContainer.querySelectorAll('.movement-qty'), function (input) {
                    input.dispatchEvent(new Event('input'));
                });
            });
        }

        searchInput.addEventListener('input', function () {
            var query = searchInput.value.toLowerCase().trim();
            Array.prototype.forEach.call(catalog.querySelectorAll('.wi-catalog-item'), function (option) {
                var haystack = option.getAttribute('data-search') || '';
                option.style.display = !query || haystack.indexOf(query) !== -1 ? 'flex' : 'none';
            });
        });

        clearButton.addEventListener('click', function () {
            Array.prototype.forEach.call(rowsContainer.querySelectorAll('.wi-selected-item'), function (row) {
                row.parentNode.removeChild(row);
            });
            updateSelectedState();
        });

        Array.prototype.forEach.call(preloadItems, function (item) {
            addSelectedData(item);
        });

        refreshCatalogStockState();
        updateSelectedState();
    })();
</script>
@endsection
