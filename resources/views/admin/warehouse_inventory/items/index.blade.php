@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')
    <style>
        .wi-items-list-table th,
        .wi-items-list-table td {
            padding-left: 10px !important;
            padding-right: 10px !important;
        }

        .wi-items-list-table .wi-item-photo,
        .wi-items-list-table .wi-item-photo-placeholder {
            width: 42px;
            height: 42px;
            flex-basis: 42px;
        }

    </style>

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Master Data</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Inventory Items</h4>
                <div class="ttext-sm wi-muted">Create and manage SKUs, barcodes, costs, units, categories, and tags.</div>
            </div>
            <div class="tflex titems-center tflex-wrap" style="gap:8px;">
                <button type="button" id="openCreateItemModal" class="wi-btn-primary waves-effect openInventoryModal" data-target="createItemModal">
                    <i class="fas fa-plus tmr-2"></i> Create Item
                </button>
                <a href="{{ route('warehouse_inventory.movements') }}" class="wi-btn-dark waves-effect">
                    <i class="fas fa-exchange-alt tmr-2"></i> New Movement
                </a>
            </div>
        </div>
    </div>

    <div id="createItemModal" class="wi-modal-backdrop">
        <div class="wi-modal">
            <div class="wi-modal-header tpx-4 tpy-3">
                <div class="tflex titems-center tjustify-between">
                    <div>
                        <div class="tfont-bold wi-section-title">Create Item</div>
                        <div class="ttext-xs wi-muted">Add a new inventory master record.</div>
                    </div>
                    <button type="button" id="closeCreateItemModal" class="wi-icon-btn wi-btn-light">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('warehouse_inventory.items.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="wi-modal-body">
            <div class="wi-form-section">
                <div class="wi-form-section-title"><i class="fas fa-box-open"></i> Item Identity</div>
                <div class="row tmb-0">
                    <div class="col s12 m3 tmb-3">
                        <label class="wi-form-label">SKU</label>
                        <input name="sku" type="text" class="browser-default wi-input">
                    </div>
                    <div class="col s12 m3 tmb-3">
                        <label class="wi-form-label tflex titems-center tjustify-between">
                            <span>Barcode</span>
                            <button type="button" id="generateCreateBarcode" class="wi-row-action-btn wi-row-action-save" title="Generate barcode" style="width:24px !important;height:24px !important;min-width:24px !important;">
                                <i class="fas fa-barcode"></i>
                            </button>
                        </label>
                        <div class="wi-input-icon">
                            <i class="fas fa-barcode"></i>
                            <input name="barcode" id="createBarcodeInput" type="text" class="browser-default wi-input">
                        </div>
                    </div>
                    <div class="col s12 m6 tmb-3">
                        <label class="wi-form-label">Item Name</label>
                        <input name="name" type="text" required class="browser-default wi-input">
                    </div>
                    <div class="col s12 m12 tmb-3">
                        <label class="wi-form-label">Item Image</label>
                        <input name="image" type="file" accept="image/*" class="browser-default wi-input">
                        <div class="ttext-xs wi-muted tmt-1">Images are resized and compressed before saving.</div>
                    </div>
                </div>
            </div>
            <div class="wi-form-section">
                <div class="wi-form-section-title"><i class="fas fa-folder-tree"></i> Classification</div>
                <div class="row tmb-0">
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Category</label>
                        <select name="category_level_1_id" id="categoryLevel1" class="browser-default wi-select">
                            <option value="">No category</option>
                            @foreach($categories->where('parent_id', null) as $r)<option value="{{ $r->id }}" {{ (string) $defaultCategoryLevel1Id === (string) $r->id ? 'selected' : '' }}>{{ $r->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col s12 m4 tmb-3" id="categoryLevel2Wrap" style="display:none;">
                        <label class="wi-form-label">Sub Category</label>
                        <select name="category_level_2_id" id="categoryLevel2" class="browser-default wi-select">
                            <option value="">No sub category</option>
                            @foreach($categories->where('parent_id', '!=', null) as $r)<option value="{{ $r->id }}" data-parent="{{ $r->parent_id }}" {{ (string) $defaultCategoryLevel2Id === (string) $r->id ? 'selected' : '' }}>{{ $r->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col s12 m4 tmb-3" id="categoryLevel3Wrap" style="display:none;">
                        <label class="wi-form-label">3rd Level Category</label>
                        <select name="category_id" id="categoryLevel3" class="browser-default wi-select">
                            <option value="">No 3rd level</option>
                            @foreach($categories->where('parent_id', '!=', null) as $r)<option value="{{ $r->id }}" data-parent="{{ $r->parent_id }}" {{ (string) $defaultCategoryLevel3Id === (string) $r->id ? 'selected' : '' }}>{{ $r->name }}</option>@endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="wi-form-section">
                <div class="wi-form-section-title"><i class="fas fa-calculator"></i> Unit & Pricing</div>
                <div class="row tmb-0">
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Unit</label>
                        <select name="unit_id" class="browser-default wi-select">
                            @foreach($units as $r)<option value="{{ $r->id }}" {{ (string) $defaultUnitId === (string) $r->id ? 'selected' : '' }}>{{ $r->name }} ({{ $r->short_name }})</option>@endforeach
                        </select>
                    </div>
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Cost</label>
                        <input name="cost" type="number" step="0.01" min="0" class="browser-default wi-input">
                    </div>
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Selling Price</label>
                        <input name="selling_price" type="number" step="0.01" min="0" value="0" class="browser-default wi-input">
                    </div>
                </div>
            </div>
            <div class="wi-form-section">
                <div class="wi-form-section-title"><i class="fas fa-tags"></i> Details & Tags</div>
                <div class="row tmb-0">
                    <div class="col s12 m5 tmb-3">
                        <label class="wi-form-label">Description</label>
                        <input name="description" type="text" class="browser-default wi-input">
                    </div>
                    <div class="col s12 m3 tmb-3">
                        <label class="wi-form-label">Existing Tags</label>
                        <select name="tag_ids[]" multiple class="browser-default wi-select" style="height:90px !important;">
                            @foreach($tags as $r)<option value="{{ $r->id }}">{{ $r->name }}</option>@endforeach
                        </select>
                    </div>
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Add Tags</label>
                        <input name="new_tags" type="text" class="browser-default wi-input" placeholder="best seller, fragile, bundle">
                        <div class="ttext-xs wi-muted tmt-1">Type new tags separated by comma.</div>
                    </div>
                </div>
            </div>
            </div>
            <div class="wi-modal-footer tflex titems-center tjustify-between tflex-wrap">
                <label class="tinline-flex titems-center tmb-2">
                    <input type="checkbox" name="is_active" checked class="browser-default">
                    <span class="tml-2 tfont-bold wi-section-title">Active item</span>
                </label>
                <button class="wi-btn-primary waves-effect tmb-2">
                    <i class="fas fa-plus tmr-2"></i> Create Item
                </button>
            </div>
        </form>
        </div>
    </div>

    <div class="wi-panel">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                <div>
                    <div class="tfont-bold wi-section-title">Item List</div>
                    <div class="ttext-xs wi-muted">All inventory master records.</div>
                </div>
                <form method="GET" action="{{ route('warehouse_inventory.items') }}" class="tflex titems-end tflex-wrap" style="gap:8px;">
                    <div>
                        <label class="wi-form-label">Search</label>
                        <input type="text" name="search" value="{{ request('search') }}" class="browser-default wi-input" placeholder="Name, SKU, barcode" style="width:220px;height:36px !important;">
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
                    <button class="wi-btn-primary waves-effect" style="height:36px;padding:0 12px;">
                        <i class="fas fa-search tmr-2"></i> Filter
                    </button>
                    @if(request()->hasAny(['search', 'category_id', 'tag_id']))
                        <a href="{{ route('warehouse_inventory.items') }}" class="wi-btn-light waves-effect" style="height:36px;padding:0 12px;">
                            <i class="fas fa-times"></i>
                        </a>
                    @endif
                </form>
            </div>
        </div>
        <div class="wi-overflow">
            <table class="wi-table wi-table-fixed wi-items-list-table tw-full ttext-sm">
                <thead>
                    <tr class="ttext-xs tuppercase">
                        <th class="ttext-left tpx-4 tpy-3" style="width:54px;">ID</th>
                        <th class="ttext-left tpx-4 tpy-3" style="width:170px;">Codes</th>
                        <th class="ttext-left tpx-4 tpy-3" style="width:260px;">Item</th>
                        <th class="ttext-left tpx-4 tpy-3" style="width:230px;">Category</th>
                        <th class="ttext-left tpx-4 tpy-3" style="width:76px;">Unit</th>
                        <th class="ttext-right tpx-4 tpy-3" style="width:95px;">Cost</th>
                        <th class="ttext-left tpx-4 tpy-3" style="width:160px;">Tags</th>
                        <th class="ttext-center tpx-4 tpy-3" style="width:92px;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($items as $item)
                        <tr class="tborder-t tborder-gray-200">
                            <td class="tpx-4 tpy-3 tfont-bold wi-section-title">#{{ $item->id }}</td>
                            <td class="tpx-4 tpy-3">
                                <div class="wi-code tmb-1" title="{{ $item->sku ?: 'No SKU' }}">
                                    <i class="fas fa-tag"></i><span class="wi-truncate">{{ $item->sku ?: 'No SKU' }}</span>
                                </div>
                                <div class="wi-code" title="{{ $item->barcode ?: 'No barcode' }}">
                                    <i class="fas fa-barcode"></i><span class="wi-truncate">{{ $item->barcode ?: 'No barcode' }}</span>
                                </div>
                            </td>
                            <td class="tpx-4 tpy-3">
                                <div class="tflex titems-center">
                                    @if($item->image_path)
                                        <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="wi-item-photo tmr-3">
                                    @else
                                        <span class="wi-item-photo-placeholder tmr-3"><i class="fas fa-image"></i></span>
                                    @endif
                                    <div style="min-width:0;">
                                        <div class="tfont-bold wi-section-title wi-truncate" title="{{ $item->name }}">{{ $item->name }}</div>
                                        <div class="ttext-xs wi-muted wi-truncate" title="{{ $item->description ?: '' }}">{{ $item->description ?: 'No description' }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="tpx-4 tpy-3">
                                @php
                                    $cat = $item->category;
                                    $parts = collect([$cat ? optional(optional($cat)->parent)->parent : null, $cat ? $cat->parent : null, $cat])->filter();
                                @endphp
                                <span class="wi-truncate" title="{{ $parts->pluck('name')->implode(' / ') }}">{{ $parts->pluck('name')->implode(' / ') ?: '-' }}</span>
                            </td>
                            <td class="tpx-4 tpy-3"><span class="wi-pill">{{ optional($item->unit)->short_name }}</span></td>
                            <td class="tpx-4 tpy-3 ttext-right tfont-bold">₱{{ number_format($item->cost,2) }}</td>
                            <td class="tpx-4 tpy-3 wi-muted">
                                <span class="wi-truncate" title="{{ $item->tags->pluck('name')->implode(', ') }}">{{ $item->tags->pluck('name')->implode(', ') ?: '-' }}</span>
                            </td>
                            <td class="tpx-4 tpy-3 ttext-center">
                                <div class="wi-row-actions">
                                    <button type="button" class="wi-row-action-btn wi-row-action-edit openInventoryModal" data-target="editItemModal{{ $item->id }}" title="Edit item">
                                        <i class="fas fa-pen"></i>
                                    </button>
                                    <form action="{{ route('warehouse_inventory.items.delete', $item->id) }}" method="POST" class="tinline-block tm-0">
                                        @csrf @method('DELETE')
                                        <button class="wi-row-action-btn wi-row-action-delete" onclick="return confirm('Deactivate this item? It will be hidden from item lists, P.O Draft, current stock, and new stock movements.')" title="Deactivate item">
                                            <i class="fas fa-ban"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tp-4">{{ $items->appends(request()->only(['search', 'category_id', 'tag_id', 'per_page']))->links() }}</div>
    </div>

    @foreach($items as $item)
        <div id="editItemModal{{ $item->id }}" class="wi-modal-backdrop">
            <div class="wi-modal">
                <div class="wi-modal-header tpx-4 tpy-3">
                    <div class="tflex titems-center tjustify-between">
                        <div>
                            <div class="tfont-bold wi-section-title">Edit Item</div>
                            <div class="ttext-xs wi-muted">{{ $item->name }}</div>
                        </div>
                        <button type="button" class="wi-icon-btn wi-btn-light closeInventoryModal">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
                <form action="{{ route('warehouse_inventory.items.update', $item->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="wi-modal-body">
                        <div class="wi-form-section">
                            <div class="wi-form-section-title"><i class="fas fa-box-open"></i> Item Identity</div>
                            <div class="row tmb-0">
                                <div class="col s12 m3 tmb-3">
                                    <label class="wi-form-label">SKU</label>
                                    <input name="sku" type="text" value="{{ $item->sku }}" class="browser-default wi-input">
                                </div>
                                <div class="col s12 m3 tmb-3">
                                    <label class="wi-form-label tflex titems-center tjustify-between">
                                        <span>Barcode</span>
                                        <button type="button" class="wi-row-action-btn wi-row-action-save generateEditBarcode" data-target="editBarcodeInput{{ $item->id }}" title="Generate barcode" style="width:24px !important;height:24px !important;min-width:24px !important;">
                                            <i class="fas fa-barcode"></i>
                                        </button>
                                    </label>
                                    <div class="wi-input-icon">
                                        <i class="fas fa-barcode"></i>
                                        <input name="barcode" id="editBarcodeInput{{ $item->id }}" type="text" value="{{ $item->barcode }}" class="browser-default wi-input">
                                    </div>
                                </div>
                                <div class="col s12 m6 tmb-3">
                                    <label class="wi-form-label">Item Name</label>
                                    <input name="name" type="text" value="{{ $item->name }}" required class="browser-default wi-input">
                                </div>
                                <div class="col s12 m12 tmb-3">
                                    <label class="wi-form-label">Replace Image</label>
                                    <div class="tflex titems-center">
                                        @if($item->image_path)
                                            <img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}" class="wi-item-photo tmr-3">
                                        @else
                                            <span class="wi-item-photo-placeholder tmr-3"><i class="fas fa-image"></i></span>
                                        @endif
                                        <input name="image" type="file" accept="image/*" class="browser-default wi-input">
                                    </div>
                                    <div class="ttext-xs wi-muted tmt-1">Upload only if you want to replace the current image.</div>
                                </div>
                            </div>
                        </div>

                        <div class="wi-form-section">
                            <div class="wi-form-section-title"><i class="fas fa-folder-tree"></i> Classification</div>
                            <div class="row tmb-0">
                                <div class="col s12 m12 tmb-3">
                                    <label class="wi-form-label">Category</label>
                                    <select name="category_id" class="browser-default wi-select">
                                        <option value="">No category</option>
                                        @foreach($categories as $category)
                                            @php
                                                $labelParts = collect([$category->parent ? optional($category->parent)->parent : null, $category->parent, $category])->filter();
                                            @endphp
                                            <option value="{{ $category->id }}" {{ (int) $item->category_id === (int) $category->id ? 'selected' : '' }}>
                                                {{ $labelParts->pluck('name')->implode(' / ') }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="wi-form-section">
                            <div class="wi-form-section-title"><i class="fas fa-calculator"></i> Unit & Pricing</div>
                            <div class="row tmb-0">
                                <div class="col s12 m4 tmb-3">
                                    <label class="wi-form-label">Unit</label>
                                    <select name="unit_id" class="browser-default wi-select">
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}" {{ (int) $item->unit_id === (int) $unit->id ? 'selected' : '' }}>{{ $unit->name }} ({{ $unit->short_name }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col s12 m4 tmb-3">
                                    <label class="wi-form-label">Cost</label>
                                    <input name="cost" type="number" step="0.01" min="0" value="{{ $item->cost }}" class="browser-default wi-input">
                                </div>
                                <div class="col s12 m4 tmb-3">
                                    <label class="wi-form-label">Selling Price</label>
                                    <input name="selling_price" type="number" step="0.01" min="0" value="{{ $item->selling_price }}" class="browser-default wi-input">
                                </div>
                            </div>
                        </div>

                        <div class="wi-form-section">
                            <div class="wi-form-section-title"><i class="fas fa-tags"></i> Details & Tags</div>
                            <div class="row tmb-0">
                                <div class="col s12 m5 tmb-3">
                                    <label class="wi-form-label">Description</label>
                                    <input name="description" type="text" value="{{ $item->description }}" class="browser-default wi-input">
                                </div>
                                <div class="col s12 m3 tmb-3">
                                    <label class="wi-form-label">Existing Tags</label>
                                    <select name="tag_ids[]" multiple class="browser-default wi-select" style="height:90px !important;">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ $item->tags->contains('id', $tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col s12 m4 tmb-3">
                                    <label class="wi-form-label">Add Tags</label>
                                    <input name="new_tags" type="text" class="browser-default wi-input" placeholder="best seller, fragile, bundle">
                                    <div class="ttext-xs wi-muted tmt-1">Type new tags separated by comma.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wi-modal-footer tflex titems-center tjustify-end tflex-wrap">
                        <button class="wi-btn-primary waves-effect tmb-2">
                            <i class="fas fa-save tmr-2"></i> Save Changes
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach
</div>
<script>
    (function () {
        var modal = document.getElementById('createItemModal');
        var openModal = document.getElementById('openCreateItemModal');
        var closeModal = document.getElementById('closeCreateItemModal');
        var allModals = document.querySelectorAll('.wi-modal-backdrop');
        var level1 = document.getElementById('categoryLevel1');
        var level2 = document.getElementById('categoryLevel2');
        var level3 = document.getElementById('categoryLevel3');
        var level2Wrap = document.getElementById('categoryLevel2Wrap');
        var level3Wrap = document.getElementById('categoryLevel3Wrap');
        var generateCreateBarcode = document.getElementById('generateCreateBarcode');
        var createBarcodeInput = document.getElementById('createBarcodeInput');
        var defaultCategoryLevel2Id = '{{ $defaultCategoryLevel2Id }}';
        var defaultCategoryLevel3Id = '{{ $defaultCategoryLevel3Id }}';

        function showModal() {
            if (modal) {
                modal.classList.add('is-open');
            }
        }

        function hideModal() {
            if (modal) {
                modal.classList.remove('is-open');
            }
        }

        function closeAllModals() {
            Array.prototype.forEach.call(allModals, function (itemModal) {
                itemModal.classList.remove('is-open');
            });
        }

        if (openModal) {
            openModal.addEventListener('click', showModal);
        }

        if (closeModal) {
            closeModal.addEventListener('click', hideModal);
        }

        Array.prototype.forEach.call(document.querySelectorAll('.openInventoryModal'), function (button) {
            button.addEventListener('click', function () {
                var target = document.getElementById(button.getAttribute('data-target'));
                if (target) {
                    target.classList.add('is-open');
                }
            });
        });

        Array.prototype.forEach.call(document.querySelectorAll('.closeInventoryModal'), function (button) {
            button.addEventListener('click', closeAllModals);
        });

        Array.prototype.forEach.call(allModals, function (itemModal) {
            itemModal.addEventListener('click', function (event) {
                if (event.target === itemModal) {
                    itemModal.classList.remove('is-open');
                }
            });
        });

        document.addEventListener('keydown', function (event) {
            if (event.key === 'Escape') {
                closeAllModals();
            }
        });

        function filterOptions(select, parentId, selectedValue) {
            var hasOptions = false;
            Array.prototype.forEach.call(select.options, function (option) {
                if (!option.value) {
                    option.hidden = false;
                    return;
                }
                var isMatch = option.getAttribute('data-parent') === parentId;
                option.hidden = !isMatch;
                if (isMatch) {
                    hasOptions = true;
                }
            });
            select.value = selectedValue || '';
            return hasOptions;
        }

        if (level1 && level2 && level3) {
            var hasDefaultLevel2 = filterOptions(level2, level1.value, defaultCategoryLevel2Id);
            var hasDefaultLevel3 = filterOptions(level3, level2.value, defaultCategoryLevel3Id);
            level2Wrap.style.display = hasDefaultLevel2 ? '' : 'none';
            level3Wrap.style.display = hasDefaultLevel3 ? '' : 'none';

            level1.addEventListener('change', function () {
                var hasLevel2 = filterOptions(level2, level1.value);
                filterOptions(level3, '');
                level2Wrap.style.display = hasLevel2 ? '' : 'none';
                level3Wrap.style.display = 'none';
            });

            level2.addEventListener('change', function () {
                var hasLevel3 = filterOptions(level3, level2.value);
                level3Wrap.style.display = hasLevel3 ? '' : 'none';
            });
        }

        if (generateCreateBarcode && createBarcodeInput) {
            generateCreateBarcode.addEventListener('click', function () {
                var randomPart = Math.floor(1000 + Math.random() * 9000);
                createBarcodeInput.value = 'MEI' + Date.now().toString().slice(-9) + randomPart;
                createBarcodeInput.focus();
                createBarcodeInput.select();
            });
        }

        Array.prototype.forEach.call(document.querySelectorAll('.generateEditBarcode'), function (button) {
            button.addEventListener('click', function () {
                var target = document.getElementById(button.getAttribute('data-target'));
                if (target) {
                    var randomPart = Math.floor(1000 + Math.random() * 9000);
                    target.value = 'MEI' + Date.now().toString().slice(-9) + randomPart;
                    target.focus();
                    target.select();
                }
            });
        });
    })();
</script>
@endsection
