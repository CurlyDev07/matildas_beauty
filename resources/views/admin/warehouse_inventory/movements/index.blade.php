@extends('admin.layouts.app')

@section('content')
@include('admin.warehouse_inventory.partials.styles')

<div class="wi-page">
    @include('admin.warehouse_inventory.partials.toast')

    <div class="wi-hero trounded-lg tp-5 tmb-5">
        <div class="wi-toolbar">
            <div>
                <div class="ttext-xs tfont-bold tuppercase" style="color:#f40167;">Inventory Audit Trail</div>
                <h4 class="tm-0 tfont-bold wi-section-title">Stock Movements</h4>
                <div class="ttext-sm wi-muted">Every stock change should have a movement reason before balance is updated.</div>
            </div>
            <div class="tflex titems-center tflex-wrap" style="gap:8px;">
                <a href="{{ route('warehouse_inventory.movements.create') }}" class="wi-btn-primary waves-effect">
                    <i class="fas fa-plus tmr-2"></i> Create Movement
                </a>
                <a href="{{ route('warehouse_inventory.stocks') }}" class="wi-btn-dark waves-effect">
                    <i class="fas fa-warehouse tmr-2"></i> Current Stock
                </a>
            </div>
        </div>
    </div>

    <div class="wi-panel">
        <div class="tpx-4 tpy-3 tborder-b tborder-gray-200">
            <div class="tflex titems-center tjustify-between tflex-wrap" style="gap:12px;">
                <div>
                    <div class="tfont-bold wi-section-title">Movement History</div>
                    <div class="ttext-xs wi-muted">Latest warehouse activity and references.</div>
                </div>
                <div class="tflex titems-end tflex-wrap" style="gap:8px;">
                    <form method="GET" action="{{ route('warehouse_inventory.movements') }}" class="tflex titems-end tflex-wrap" style="gap:8px;">
                        <input type="hidden" name="display" value="{{ $displayMode }}" class="browser-default">
                        <div>
                            <label class="wi-form-label">Search</label>
                            <input type="text" name="search" value="{{ request('search') }}" class="browser-default wi-input" placeholder="Movement ID, item, SKU" style="width:210px;height:41px !important;">
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
                            <a href="{{ route('warehouse_inventory.movements', ['display' => $displayMode, 'per_page' => $perPage]) }}" class="wi-btn-light waves-effect" style="height:41px;padding:0 12px;">
                                <i class="fas fa-times"></i>
                            </a>
                        @endif
                    </form>
                    <a href="{{ route('warehouse_inventory.movements', request()->only(['search', 'category_id', 'tag_id']) + ['display' => 'summary', 'per_page' => $perPage]) }}"
                        class="{{ $displayMode === 'summary' ? 'wi-btn-primary' : 'wi-btn-light' }} waves-effect">
                        <i class="fas fa-layer-group tmr-2"></i> Grouped
                    </a>
                    <a href="{{ route('warehouse_inventory.movements', request()->only(['search', 'category_id', 'tag_id']) + ['display' => 'details', 'per_page' => $perPage]) }}"
                        class="{{ $displayMode === 'details' ? 'wi-btn-primary' : 'wi-btn-light' }} waves-effect">
                        <i class="fas fa-list tmr-2"></i> Detailed
                    </a>
                </div>
            </div>
        </div>
        <div class="wi-overflow">
            <table class="wi-table tw-full ttext-sm">
                <thead>
                    @if($displayMode === 'summary')
                        <tr class="ttext-xs tuppercase">
                            <th class="ttext-left tpx-4 tpy-3">Date</th>
                            <th class="ttext-left tpx-4 tpy-3">Movement ID</th>
                            <th class="ttext-left tpx-4 tpy-3">Type</th>
                            <th class="ttext-left tpx-4 tpy-3">Created By</th>
                            <th class="ttext-right tpx-4 tpy-3">Total Qty</th>
                            <th class="ttext-right tpx-4 tpy-3">Action</th>
                        </tr>
                    @else
                        <tr class="ttext-xs tuppercase">
                            <th class="ttext-left tpx-4 tpy-3">Date</th>
                            <th class="ttext-left tpx-4 tpy-3">Movement ID</th>
                            <th class="ttext-left tpx-4 tpy-3">Item</th>
                            <th class="ttext-left tpx-4 tpy-3">Type</th>
                            <th class="ttext-left tpx-4 tpy-3">Created By</th>
                            <th class="ttext-right tpx-4 tpy-3">Qty</th>
                            <th class="ttext-left tpx-4 tpy-3">Notes</th>
                            <th class="ttext-right tpx-4 tpy-3">Action</th>
                        </tr>
                    @endif
                </thead>
                <tbody>
                    @foreach($movements as $m)
                        @if($displayMode === 'summary')
                            <tr class="tborder-t tborder-gray-200">
                                <td class="tpx-4 tpy-3 tfont-medium wi-muted">{{ \Carbon\Carbon::parse($m->latest_created_at)->format('M d, g:iA') }}</td>
                                <td class="tpx-4 tpy-3"><span class="wi-code">{{ $m->batch_code ?: '-' }}</span></td>
                                <td class="tpx-4 tpy-3">
                                    @include('admin.warehouse_inventory.partials.movement_type_badge', ['label' => $m->type_name ?: '-', 'effect' => $m->stock_effect ?: 'none', 'key' => $m->type_name ?: ''])
                                </td>
                                <td class="tpx-4 tpy-3 wi-muted">{{ $m->creator_first_name ?: 'Unknown' }}</td>
                                <td class="tpx-4 tpy-3 ttext-right tfont-bold" style="color:#f40167;">
                                    {{ fmod((float) $m->total_quantity, 1.0) === 0.0 ? number_format((float) $m->total_quantity, 0) : number_format((float) $m->total_quantity, 3) }}
                                </td>
                                <td class="tpx-4 tpy-3 ttext-right">
                                    <span class="wi-row-actions">
                                        <a href="{{ route('warehouse_inventory.movements.audits', $m->edit_key) }}" class="wi-row-action-btn wi-row-action-save" title="View audit history">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        <a href="{{ route('warehouse_inventory.movements.edit', $m->edit_key) }}" class="wi-row-action-btn wi-row-action-edit" title="Edit batch">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @else
                            <tr class="tborder-t tborder-gray-200">
                                <td class="tpx-4 tpy-3 tfont-medium wi-muted">{{ optional($m->created_at)->format('M d, g:iA') }}</td>
                                <td class="tpx-4 tpy-3"><span class="wi-code">{{ $m->batch_code ?: '-' }}</span></td>
                                <td class="tpx-4 tpy-3 tfont-bold wi-section-title">{{ optional($m->item)->name ?: '-' }}</td>
                                <td class="tpx-4 tpy-3">
                                    @include('admin.warehouse_inventory.partials.movement_type_badge', ['label' => optional($m->movementType)->name ?: $m->movement_type, 'effect' => optional($m->movementType)->stock_effect ?: 'none', 'key' => $m->movement_type])
                                </td>
                                <td class="tpx-4 tpy-3 wi-muted">{{ optional($m->creator)->first_name ?: 'Unknown' }}</td>
                                <td class="tpx-4 tpy-3 ttext-right tfont-bold" style="color:#f40167;">@include('admin.warehouse_inventory.partials.quantity', ['quantity' => $m->quantity, 'unit' => optional(optional($m->item)->unit)->short_name])</td>
                                <td class="tpx-4 tpy-3 wi-muted">{{ $m->notes ?: '-' }}</td>
                                <td class="tpx-4 tpy-3 ttext-right">
                                    <span class="wi-row-actions">
                                        <a href="{{ route('warehouse_inventory.movements.audits', $m->batch_code ?: $m->id) }}" class="wi-row-action-btn wi-row-action-save" title="View audit history">
                                            <i class="fas fa-history"></i>
                                        </a>
                                        <a href="{{ route('warehouse_inventory.movements.edit', $m->batch_code ?: $m->id) }}" class="wi-row-action-btn wi-row-action-edit" title="Edit batch">
                                            <i class="fas fa-pen"></i>
                                        </a>
                                    </span>
                                </td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="tp-4">{{ $movements->appends(request()->only(['search', 'category_id', 'tag_id']) + ['display' => $displayMode, 'per_page' => $perPage])->links() }}</div>
    </div>
</div>
@endsection
