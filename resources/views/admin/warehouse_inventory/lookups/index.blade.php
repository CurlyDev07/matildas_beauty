@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Setup</div>
                <h4 class="tm-0 tfont-bold wi-section-title">{{ $title }}</h4>
                <div class="ttext-sm wi-muted">Manage reusable inventory lookup values without touching existing inventory data.</div>
            </div>
            <a href="{{ route('warehouse_inventory.dashboard') }}" class="wi-btn-dark waves-effect">
                <i class="fas fa-chart-pie tmr-2"></i> Dashboard
            </a>
        </div>
    </div>

    @php
        $lookupTabs = [
            'defaults' => ['label' => 'Defaults', 'icon' => 'fas fa-cog'],
            'units' => ['label' => 'Units', 'icon' => 'fas fa-ruler-combined'],
            'categories' => ['label' => 'Categories', 'icon' => 'fas fa-folder-open'],
            'tags' => ['label' => 'Tags', 'icon' => 'fas fa-tags'],
            'statuses' => ['label' => 'Statuses', 'icon' => 'fas fa-info-circle'],
            'movement-types' => ['label' => 'Movement Types', 'icon' => 'fas fa-random'],
        ];
    @endphp
    <div class="wi-panel tp-3 tmb-5">
        <div class="tflex titems-center tflex-wrap" style="gap:8px;">
            @foreach($lookupTabs as $lookupType => $lookupTab)
                <a href="{{ route('warehouse_inventory.lookups', $lookupType) }}"
                    class="{{ $type === $lookupType ? 'wi-btn-primary' : 'wi-btn-light' }} waves-effect">
                    <i class="{{ $lookupTab['icon'] }} tmr-2"></i> {{ $lookupTab['label'] }}
                </a>
            @endforeach
        </div>
    </div>

    @if($type === 'defaults')
        <div class="wi-panel tp-4">
            <div class="tflex titems-start tjustify-between tflex-wrap tmb-4" style="gap:12px;">
                <div>
                    <div class="tfont-bold wi-section-title">Create Item Defaults</div>
                    <div class="ttext-xs wi-muted">These values are automatically selected when opening the Create Item form.</div>
                </div>
                <a href="{{ route('warehouse_inventory.items') }}" class="wi-btn-dark waves-effect">
                    <i class="fas fa-box-open tmr-2"></i> Inventory Items
                </a>
            </div>

            <form action="{{ route('warehouse_inventory.lookups.store', 'defaults') }}" method="POST">
                @csrf
                <div class="row tmb-0">
                    <div class="col s12 m6 tmb-3">
                        <label class="wi-form-label">Default Category</label>
                        <select name="default_category_id" class="browser-default wi-select">
                            <option value="">No default category</option>
                            @foreach($categories as $category)
                                @php
                                    $parts = collect([$category->parent ? optional($category->parent)->parent : null, $category->parent, $category])->filter();
                                @endphp
                                <option value="{{ $category->id }}" {{ (string) $defaultCategoryId === (string) $category->id ? 'selected' : '' }}>
                                    {{ $parts->pluck('name')->implode(' / ') }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Default Unit</label>
                        <select name="default_unit_id" class="browser-default wi-select">
                            <option value="">No default unit</option>
                            @foreach($units as $unit)
                                <option value="{{ $unit->id }}" {{ (string) $defaultUnitId === (string) $unit->id ? 'selected' : '' }}>
                                    {{ $unit->name }} ({{ $unit->short_name }})
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col s12 m2 tmb-3" style="padding-top:22px;">
                        <button class="wi-btn-primary waves-effect tw-full">
                            <i class="fas fa-save tmr-2"></i> Save
                        </button>
                    </div>
                </div>
            </form>
        </div>
    @else
    <div class="wi-panel tp-4 tmb-5">
        <div class="tfont-bold wi-section-title tmb-3">Add New</div>
        <form action="{{ route('warehouse_inventory.lookups.store', $type) }}" method="POST">
            @csrf
            <div class="row tmb-0">
                <div class="col s12 m4 tmb-3">
                    <label class="wi-form-label">Name</label>
                    <input name="name" type="text" required class="browser-default wi-input">
                </div>
                @if ($type === 'units')
                    <div class="col s12 m2 tmb-3">
                        <label class="wi-form-label">Short Name</label>
                        <input name="short_name" type="text" required class="browser-default wi-input">
                    </div>
                @endif
                @if ($type === 'categories')
                    <div class="col s12 m3 tmb-3">
                        <label class="wi-form-label">Parent Category</label>
                        <select name="parent_id" class="browser-default wi-select">
                            <option value="">Main category</option>
                            @foreach($categoryOptions as $category)
                                @if(!$category->parent || !$category->parent->parent)
                                    <option value="{{ $category->id }}">
                                        {{ optional($category->parent)->name ? optional($category->parent)->name . ' / ' : '' }}{{ $category->name }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                @endif
                @if ($type === 'categories')
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Description</label>
                        <input name="description" type="text" class="browser-default wi-input">
                    </div>
                @endif
                @if ($type === 'movement-types')
                    <div class="col s12 m3 tmb-3">
                        <label class="wi-form-label">Stock Effect</label>
                        <select name="stock_effect" class="browser-default wi-select" required>
                            <option value="add">Add stock</option>
                            <option value="subtract">Subtract stock</option>
                            <option value="transfer">Transfer stock</option>
                            <option value="none">No stock change</option>
                        </select>
                    </div>
                    <div class="col s12 m4 tmb-3">
                        <label class="wi-form-label">Description</label>
                        <input name="description" type="text" class="browser-default wi-input">
                    </div>
                @endif
                <div class="col s12 m2 tmb-3">
                    <label class="wi-form-label">Status</label>
                    <label class="tinline-flex titems-center" style="height:40px;">
                        <input type="checkbox" name="is_active" value="1" checked class="browser-default">
                        <span class="tml-2 tfont-bold wi-section-title">Active</span>
                    </label>
                </div>
                <div class="col s12 m2 tmb-3" style="padding-top:22px;">
                    <button class="wi-btn-primary waves-effect tw-full">
                        <i class="fas fa-plus tmr-2"></i> Create
                    </button>
                </div>
            </div>
        </form>
    </div>

    <div class="wi-panel">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div class="tfont-bold wi-section-title">List</div>
            <div class="ttext-xs wi-muted">Edit lookup records inline.</div>
        </div>
        <div class="wi-overflow">
            <table class="wi-table tw-full ttext-sm">
                <thead>
                    <tr class="ttext-xs tuppercase">
                        <th class="ttext-left tpx-4 tpy-3">ID</th>
                        <th class="ttext-left tpx-4 tpy-3">Name</th>
                        <th class="ttext-left tpx-4 tpy-3">{{ $type === 'movement-types' ? 'Stock Effect' : 'Parent / Code' }}</th>
                        <th class="ttext-left tpx-4 tpy-3">Active</th>
                        <th class="ttext-left tpx-4 tpy-3">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rows as $row)
                        <tr class="tborder-t tborder-gray-200">
                            <td class="tpx-4 tpy-3 tfont-bold wi-section-title">#{{ $row->id }}</td>
                            <td class="tpx-4 tpy-3 tfont-bold wi-section-title">{{ $row->name }}</td>
                            <td class="tpx-4 tpy-3 wi-muted">
                                @if($type === 'categories')
                                    {{ optional($row->parent)->name ?: 'Main category' }}
                                @elseif($type === 'movement-types')
                                    @include('admin.warehouse_inventory.partials.movement_type_badge', ['label' => $row->name, 'effect' => $row->stock_effect ?: 'none', 'key' => $row->slug])
                                @else
                                    {{ $row->short_name ?? $row->slug ?? '-' }}
                                @endif
                            </td>
                            <td class="tpx-4 tpy-3">
                                <span class="wi-pill">{{ $row->is_active ? 'Active' : 'Inactive' }}</span>
                            </td>
                            <td class="tpx-4 tpy-3">
                                <form action="{{ route('warehouse_inventory.lookups.update', [$type, $row->id]) }}" method="POST" class="tinline-flex titems-center tflex-wrap" style="gap:8px;">
                                    @csrf @method('PUT')
                                    <input type="text" name="name" value="{{ $row->name }}" required class="browser-default wi-input" style="width:180px;height:34px !important;">
                                    @if(isset($row->short_name))
                                        <input type="text" name="short_name" value="{{ $row->short_name }}" class="browser-default wi-input" style="width:90px;height:34px !important;">
                                    @endif
                                    @if($type === 'categories')
                                        <select name="parent_id" class="browser-default wi-select" style="width:190px;height:34px !important;">
                                            <option value="">Main category</option>
                                            @foreach($categoryOptions->where('id', '!=', $row->id) as $category)
                                                @if(!$category->parent || !$category->parent->parent)
                                                    <option value="{{ $category->id }}" {{ (int) $row->parent_id === (int) $category->id ? 'selected' : '' }}>
                                                        {{ optional($category->parent)->name ? optional($category->parent)->name . ' / ' : '' }}{{ $category->name }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    @endif
                                    @if($type === 'movement-types')
                                        <select name="stock_effect" class="browser-default wi-select" style="width:150px;height:34px !important;">
                                            <option value="add" {{ $row->stock_effect === 'add' ? 'selected' : '' }}>Add</option>
                                            <option value="subtract" {{ $row->stock_effect === 'subtract' ? 'selected' : '' }}>Subtract</option>
                                            <option value="transfer" {{ $row->stock_effect === 'transfer' ? 'selected' : '' }}>Transfer</option>
                                            <option value="none" {{ $row->stock_effect === 'none' ? 'selected' : '' }}>None</option>
                                        </select>
                                    @endif
                                    @if(isset($row->description))
                                        <input type="text" name="description" value="{{ $row->description }}" class="browser-default wi-input" style="width:220px;height:34px !important;">
                                    @endif
                                    @if($row->is_active)
                                        <input type="hidden" name="is_active" value="1" class="browser-default">
                                    @endif
                                    <span class="wi-row-actions">
                                        <button class="wi-row-action-btn wi-row-action-save" title="Save changes">
                                            <i class="fas fa-save"></i>
                                        </button>
                                    </span>
                                </form>
                                <span class="wi-row-actions tml-1">
                                    <form action="{{ route('warehouse_inventory.lookups.delete', [$type, $row->id]) }}" method="POST" class="tinline-block tm-0">
                                        @csrf @method('DELETE')
                                        <button class="wi-row-action-btn wi-row-action-delete" onclick="return confirm('Delete this record? If it is already used by inventory items or stock records, the system will block deletion. Reassign linked records first before deleting.')" title="Delete record">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tp-4">{{ $rows->links() }}</div>
    </div>
    @endif
</div>
@endsection
