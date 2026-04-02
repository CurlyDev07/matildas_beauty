@extends('admin.fbads.layouts')

@section('css')
<style>
    .os-shell {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }
    .os-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e7ebf3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        background: linear-gradient(120deg, #f8fafc 0%, #f3f7ff 100%);
    }
    .os-title {
        margin: 0;
        font-size: 22px;
        line-height: 1.2;
        color: #0f172a;
        font-weight: 700;
    }
    .os-subtitle {
        margin-top: 6px;
        color: #64748b;
        font-size: 13px;
        font-weight: 500;
    }
    .os-header-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .os-stat {
        background: #eaf0ff;
        color: #1d4ed8;
        border: 1px solid #d7e3ff;
        border-radius: 9999px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }
    .os-group-note {
        margin-top: 8px;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #eef4ff;
        color: #1e3a8a;
        border: 1px solid #dbe7ff;
        border-radius: 9999px;
        padding: 4px 10px;
        font-size: 12px;
        font-weight: 600;
    }
    .os-clear {
        background: #111827;
        color: #fff;
        border-radius: 10px;
        padding: 8px 12px;
        font-size: 12px;
        font-weight: 600;
        transition: .2s ease;
    }
    .os-clear:hover {
        background: #1f2937;
    }
    .os-body {
        padding: 18px 22px 22px;
    }
    .os-panel {
        border: 1px solid #e5eaf3;
        border-radius: 12px;
        padding: 14px;
        background: #f9fbff;
        margin-bottom: 14px;
    }
    .os-panel-title {
        margin: 0 0 10px;
        color: #1e293b;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
    }
    .os-filter-form {
        display: grid;
        grid-template-columns: 220px minmax(240px, 1fr) 140px;
        gap: 10px;
        align-items: center;
    }
    .os-input {
        margin: 0 !important;
        height: 40px !important;
        border: 1px solid #cfd8e7 !important;
        border-radius: 10px !important;
        background: #fff !important;
        padding: 0 12px !important;
        box-sizing: border-box !important;
        font-size: 13px !important;
    }
    .os-add-btn {
        background: #2563eb;
        color: #fff;
        border: 0;
        border-radius: 10px;
        height: 40px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: .2s ease;
    }
    .os-add-btn:hover {
        background: #1d4ed8;
    }
    .os-tags {
        margin-top: 10px;
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    .os-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        border-radius: 9999px;
        border: 1px solid #fbcaca;
        background: #fff1f1;
        color: #b91c1c;
        font-size: 12px;
        line-height: 1;
        padding: 8px 10px;
        max-width: 100%;
    }
    .os-tag .os-tag-text {
        max-width: 360px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .os-tag .os-remove {
        font-weight: 800;
        font-size: 12px;
        color: #ef4444;
    }
    .os-empty {
        color: #64748b;
        font-size: 13px;
    }
    .os-quick-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 10px;
    }
    .os-quick-card {
        border: 1px solid #dce5f3;
        border-radius: 10px;
        background: #fff;
        overflow: hidden;
    }
    .os-quick-head {
        padding: 10px 12px;
        border-bottom: 1px solid #edf1f7;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
    }
    .os-quick-head strong {
        font-size: 13px;
        color: #334155;
    }
    .os-quick-count {
        font-size: 11px;
        color: #64748b;
    }
    .os-quick-list {
        max-height: 210px;
        overflow: auto;
        padding: 6px;
    }
    .os-quick-item {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        border-radius: 8px;
        padding: 8px 9px;
        color: #334155;
        font-size: 12px;
    }
    .os-quick-item:hover {
        background: #f1f5ff;
    }
    .os-quick-value {
        min-width: 0;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .os-quick-meta {
        color: #2563eb;
        font-weight: 700;
    }
    .os-table-layout {
        margin-bottom: 8px;
    }
    .os-table-tools {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 8px;
        margin-bottom: 8px;
    }
    .os-table-tools-left {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .os-tool-btn {
        border: 1px solid #d8e1ef;
        background: #fff;
        color: #1e293b;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }
    .os-tool-btn:hover {
        background: #f8fafc;
    }
    .os-columns-panel {
        position: absolute;
        top: 38px;
        left: 0;
        z-index: 5;
        /* width: 320px; */
        max-height: 320px;
        overflow: auto;
        background: #fff;
        border: 1px solid #d9e2ef;
        border-radius: 10px;
        box-shadow: 0 10px 28px rgba(15, 23, 42, 0.15);
        padding: 10px;
        display: none;
    }
    .os-columns-panel.open {
        display: block;
    }
    .os-columns-title {
        margin: 0 0 8px;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .04em;
        color: #64748b;
    }
    .os-columns-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 6px 8px;
    }
    .os-col-item {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #334155;
    }
    .os-col-item input[disabled] + span {
        color: #94a3b8;
    }
    .os-table-resize-shell {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        background: #fff;
        overflow: hidden;
    }
    .os-table-wrap {
        overflow: auto;
        max-height: 460px;
    }
    .os-table-resize-handle {
        height: 14px;
        cursor: ns-resize;
        border-top: 1px solid #e2e8f0;
        background: linear-gradient(180deg, #f8fafc 0%, #eef2f7 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .os-table-resize-handle::before {
        content: '';
        width: 36px;
        height: 4px;
        border-radius: 9999px;
        background: #cbd5e1;
    }
    .os-table {
        width: 100%;
        min-width: 1400px;
        border-collapse: separate;
        border-spacing: 0;
    }
    .os-table thead th {
        position: sticky;
        top: 0;
        z-index: 1;
        background: #f7f9fd;
        color: #334155;
        font-size: 12px;
        text-transform: uppercase;
        letter-spacing: .03em;
        font-weight: 700;
        padding: 12px 10px;
        border-bottom: 1px solid #dce3ee;
        text-align: left;
        white-space: nowrap;
    }
    .os-table tbody td {
        padding: 11px 10px;
        border-bottom: 1px solid #eef2f8;
        font-size: 13px;
        color: #0f172a;
        vertical-align: top;
        line-height: 1.3;
    }
    .os-table tbody tr:hover {
        background: #f8fbff;
    }
    .os-col-hidden {
        display: none !important;
    }
    .os-id {
        font-weight: 700;
        color: #1d4ed8;
    }
    .os-count {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 24px;
        border-radius: 9999px;
        background: #dbeafe;
        color: #1e40af;
        font-weight: 700;
        font-size: 12px;
        padding: 0 8px;
    }
    .os-code {
        font-family: "SFMono-Regular", Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 12px;
    }
    .os-truncate {
        display: inline-block;
        max-width: 220px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .os-date {
        white-space: nowrap;
        color: #475569;
        font-size: 12px;
    }
    .os-pager {
        margin-top: 14px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
    }
    .os-pager-info {
        font-size: 12px;
        color: #64748b;
    }
    .os-pager-nav {
        display: flex;
        gap: 8px;
    }
    .os-page-btn {
        padding: 7px 12px;
        border: 1px solid #d8e1ef;
        border-radius: 8px;
        background: #fff;
        color: #1e293b;
        font-size: 12px;
        font-weight: 600;
    }
    .os-page-btn:hover {
        background: #f8fafc;
    }
    .os-page-btn.disabled {
        color: #94a3b8;
        background: #f8fafc;
        cursor: not-allowed;
    }
    .os-alert-success {
        margin-bottom: 14px;
        border: 1px solid #bbf7d0;
        background: #f0fdf4;
        color: #166534;
        border-radius: 10px;
        padding: 10px 12px;
        font-size: 13px;
        font-weight: 600;
    }
    .os-block-btn {
        border: 1px solid #fecaca;
        background: #fff1f2;
        color: #be123c;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 11px;
        font-weight: 700;
        cursor: pointer;
        text-transform: uppercase;
        letter-spacing: .03em;
    }
    .os-block-btn:hover {
        background: #ffe4e6;
    }
    .os-blocked-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9999px;
        border: 1px solid #bbf7d0;
        background: #f0fdf4;
        color: #166534;
        font-size: 11px;
        font-weight: 700;
        padding: 5px 8px;
        text-transform: uppercase;
    }

    @media (max-width: 900px) {
        .os-body,
        .os-header {
            padding: 14px;
        }
        .os-filter-form {
            grid-template-columns: 1fr;
        }
        .os-tag .os-tag-text {
            max-width: 220px;
        }
    }
</style>
@endsection

@section('page')
@php
    $currentFields = array_column($appliedFilters, 'field');
    $currentValues = array_column($appliedFilters, 'value');
    $tableColumnOptions = [
        'id' => 'ID',
        'count' => 'Count',
        'website' => 'Website',
        'fb_ads_id' => 'FB Ads ID',
        'name' => 'Name',
        'phone' => 'Phone',
        'promo' => 'Promo',
        'fingerprint' => 'Fingerprint',
        'fingerprintjs_visitor_id' => 'FingerprintJS Visitor ID',
        'session_id' => 'Session ID',
        'local_session_id' => 'Local Session ID',
        'fbclid' => 'FBCLID',
        'user_agent' => 'User Agent',
        'ip_address' => 'IP Address',
        'timestamp' => 'Timestamp',
        'created' => 'Created',
        'action' => 'Action',
    ];
    $nonHideableColumns = ['id', 'count', 'action'];
@endphp

<div class="os-shell">
    <div class="os-header">
        <div>
            <h2 class="os-title">Order Signals</h2>
            <div class="os-subtitle">
                @if ($isGroupedMode)
                    {{ number_format($orderSignals->total()) }} grouped row{{ $orderSignals->total() == 1 ? '' : 's' }} from {{ number_format($rawSignalsCount) }} matched entr{{ $rawSignalsCount == 1 ? 'y' : 'ies' }}
                @else
                    {{ number_format($orderSignals->total()) }} result{{ $orderSignals->total() == 1 ? '' : 's' }}
                @endif
            </div>
            @if ($isGroupedMode)
                <div class="os-group-note">
                    Grouped by: {{ collect($groupByFields)->map(function ($field) use ($filterLabels) { return $filterLabels[$field] ?? $field; })->implode(', ') }}
                </div>
            @endif
        </div>
        <div class="os-header-actions">
            <span class="os-stat">{{ count($appliedFilters) }} active filter{{ count($appliedFilters) == 1 ? '' : 's' }}</span>
            <a href="{{ route('fbads.order_signals') }}" class="os-clear">Clear All Filters</a>
        </div>
    </div>

    <div class="os-body">
        @if (session('order_signal_block_message'))
            <div class="os-alert-success">{{ session('order_signal_block_message') }}</div>
        @endif

        <div class="os-panel">
            <p class="os-panel-title">Stackable Filter Builder</p>
            <form action="{{ route('fbads.order_signals') }}" method="GET" class="os-filter-form">
                @foreach ($appliedFilters as $filter)
                    <input type="hidden" name="filter_fields[]" value="{{ $filter['field'] }}">
                    <input type="hidden" name="filter_values[]" value="{{ $filter['value'] }}">
                @endforeach

                <select name="new_field" class="browser-default os-input">
                    <option value="">Choose field</option>
                    @foreach ($filterableFields as $field)
                        <option value="{{ $field }}" {{ request('new_field') === $field ? 'selected' : '' }}>
                            {{ $filterLabels[$field] ?? $field }}
                        </option>
                    @endforeach
                </select>
                <input type="text" name="new_value" value="{{ request('new_value') }}" class="browser-default os-input" placeholder="Enter value to match">
                <button type="submit" class="os-add-btn">Add Filter</button>
            </form>

            <div class="os-tags">
                @if (count($appliedFilters))
                    @foreach ($appliedFilters as $index => $filter)
                        @php
                            $removeFields = $currentFields;
                            $removeValues = $currentValues;
                            unset($removeFields[$index], $removeValues[$index]);
                        @endphp
                        <a
                            href="{{ route('fbads.order_signals', ['filter_fields' => array_values($removeFields), 'filter_values' => array_values($removeValues)]) }}"
                            class="os-tag"
                        >
                            <span class="os-tag-text" title="{{ $filterLabels[$filter['field']] ?? $filter['field'] }}: {{ $filter['value'] }}">
                                <strong>{{ $filterLabels[$filter['field']] ?? $filter['field'] }}:</strong>
                                {{ \Illuminate\Support\Str::limit($filter['value'], 55) }}
                            </span>
                            <span class="os-remove">x</span>
                        </a>
                    @endforeach
                @else
                    <span class="os-empty">No active filters. Add one to narrow suspicious behavior quickly.</span>
                @endif
            </div>
        </div>

        <div class="os-panel">
            <p class="os-panel-title">Grouped Quick Filters (Top 10 each)</p>
            <div class="os-quick-grid">
                @foreach ($filterableFields as $field)
                    <div class="os-quick-card">
                        <div class="os-quick-head">
                            <strong>{{ $filterLabels[$field] ?? $field }}</strong>
                            <span class="os-quick-count">{{ count($groupedSignals[$field]) }} value{{ count($groupedSignals[$field]) == 1 ? '' : 's' }}</span>
                        </div>
                        <div class="os-quick-list">
                            @if (count($groupedSignals[$field]))
                                @foreach ($groupedSignals[$field] as $group)
                                    @php
                                        $value = $group->{$field};
                                    @endphp
                                    <a
                                        href="{{ route('fbads.order_signals', ['filter_fields' => $currentFields, 'filter_values' => $currentValues, 'new_field' => $field, 'new_value' => $value]) }}"
                                        class="os-quick-item"
                                        title="Add {{ $filterLabels[$field] ?? $field }}: {{ $value }}"
                                    >
                                        <span class="os-quick-value">{{ \Illuminate\Support\Str::limit($value, 48) }}</span>
                                        <span class="os-quick-meta">{{ $group->total }}</span>
                                    </a>
                                @endforeach
                            @else
                                <div class="os-empty">No values found.</div>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="os-table-layout">
            <div class="os-table-tools">
                <div class="os-table-tools-left">
                    <button type="button" class="os-tool-btn" id="osColumnsToggle">Columns</button>
                    <button type="button" class="os-tool-btn" id="osResetLayout">Reset Layout</button>
                </div>
                <div class="os-columns-panel" id="osColumnsPanel">
                    <p class="os-columns-title">Show / Hide Columns</p>
                    <div class="os-columns-grid">
                        @foreach ($tableColumnOptions as $colKey => $colLabel)
                            <label class="os-col-item">
                                <input
                                    type="checkbox"
                                    class="os-col-toggle"
                                    data-col-target="{{ $colKey }}"
                                    checked
                                    {{ in_array($colKey, $nonHideableColumns, true) ? 'disabled' : '' }}
                                >
                                <span>{{ $colLabel }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="os-table-resize-shell">
                <div class="os-table-wrap" id="orderSignalsTableWrap">
                    <table class="os-table" id="osTable">
                <thead>
                <tr>
                    <th data-col="id">ID</th>
                    <th data-col="count">Count</th>
                    <th data-col="website">Website</th>
                    <th data-col="fb_ads_id">FB Ads ID</th>
                    <th data-col="name">Name</th>
                    <th data-col="phone">Phone</th>
                    <th data-col="promo">Promo</th>
                    <th data-col="fingerprint">Fingerprint</th>
                    <th data-col="fingerprintjs_visitor_id">FingerprintJS Visitor ID</th>
                    <th data-col="session_id">Session ID</th>
                    <th data-col="local_session_id">Local Session ID</th>
                    <th data-col="fbclid">FBCLID</th>
                    <th data-col="user_agent">User Agent</th>
                    <th data-col="ip_address">IP Address</th>
                    <th data-col="timestamp">Timestamp</th>
                    <th data-col="created">Created</th>
                    <th data-col="action">Action</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($rows as $row)
                    @php
                        $signal = $row['signal'];
                        $isBlocked = in_array($signal->fingerprintjs_visitor_id, $blockedFingerprintIds ?? [], true);
                    @endphp
                    <tr>
                        <td data-col="id" class="os-id tw-0" >{{ $signal->id }}</td>
                        <td data-col="count" class="tw-0"><span class="os-count">{{ $row['count'] }}</span></td>
                        <td data-col="website" class="tw-0"><span class="os-truncate" title="{{ $signal->website }}">{{ $signal->website ?? '-' }}</span></td>
                        <td data-col="fb_ads_id" class="tw-0"><span class="os-code">{{ $signal->fb_ads_id ?? '-' }}</span></td>
                        <td data-col="name" class="tw-0"><span class="os-truncate" title="{{ $signal->full_name }}">{{ $signal->full_name ?? '-' }}</span></td>
                        <td data-col="phone" class="tw-0"><span class="os-code">{{ $signal->phone_number ?? '-' }}</span></td>
                        <td data-col="promo" class="tw-0"><span class="os-truncate" title="{{ $signal->promo }}">{{ $signal->promo ?? '-' }}</span></td>
                        <td data-col="fingerprint" class="tw-0"><span class="os-code os-truncate" title="{{ $signal->fingerprint }}">{{ \Illuminate\Support\Str::limit($signal->fingerprint, 120) }}</span></td>
                        <td data-col="fingerprintjs_visitor_id" class="tw-0"><span class="os-code " title="{{ $signal->fingerprintjs_visitor_id }}">{{ $signal->fingerprintjs_visitor_id ?? '-' }}</span></td>
                        <td data-col="session_id" class="tw-0"><span class="os-code os-truncate" title="{{ $signal->session_id }}">{{ $signal->session_id ?? '-' }}</span></td>
                        <td data-col="local_session_id" class="tw-0"><span class="os-code os-truncate" title="{{ $signal->local_session_id }}">{{ $signal->local_session_id ?? '-' }}</span></td>
                        <td data-col="fbclid" class="tw-0"><span class="os-code os-truncate" title="{{ $signal->fbclid }}">{{ \Illuminate\Support\Str::limit($signal->fbclid, 120) }}</span></td>
                        <td data-col="user_agent" class="tw-0"><span class="os-truncate" title="{{ $signal->user_agent }}">{{ \Illuminate\Support\Str::limit($signal->user_agent, 120) }}</span></td>
                        <td data-col="ip_address" class="tw-0"><span class="os-code">{{ $signal->ip_address ?? '-' }}</span></td>
                        <td data-col="timestamp" class="tw-0"><span class="os-code">{{ $signal->timestamp ?? '-' }}</span></td>
                        <td data-col="created" class="tw-0"><span class="os-date">{{ $signal->created_at ? $signal->created_at->format('M d, Y h:i A') : '-' }}</span></td>
                        <td data-col="action">
                            @if (!empty($signal->fingerprintjs_visitor_id))
                                @if ($isBlocked)
                                    <span class="os-blocked-badge">Blocked</span>
                                @else
                                    <form action="{{ route('order-signal.block-user') }}" method="POST" onsubmit="return confirm('Block this fingerprint user?');">
                                        @csrf
                                        <input type="hidden" name="fingerprintjs_visitor_id" value="{{ $signal->fingerprintjs_visitor_id }}">
                                        <button type="submit" class="os-block-btn">Block User</button>
                                    </form>
                                @endif
                            @else
                                <span class="os-empty">No Fingerprint ID</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="17" class="os-empty" style="padding: 20px; text-align: center;">
                            No order signals found for the current filters.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
                </div>
                <div class="os-table-resize-handle" id="osTableResizeHandle" title="Drag to resize table height"></div>
            </div>
        </div>

        @if ($orderSignals->hasPages())
            <div class="os-pager">
                <div class="os-pager-info">
                    Page {{ $orderSignals->currentPage() }} of {{ $orderSignals->lastPage() }}
                </div>
                <div class="os-pager-nav">
                    @if ($orderSignals->onFirstPage())
                        <span class="os-page-btn disabled">Prev</span>
                    @else
                        <a href="{{ $orderSignals->previousPageUrl() }}" class="os-page-btn">Prev</a>
                    @endif

                    @if ($orderSignals->hasMorePages())
                        <a href="{{ $orderSignals->nextPageUrl() }}" class="os-page-btn">Next</a>
                    @else
                        <span class="os-page-btn disabled">Next</span>
                    @endif
                </div>
            </div>
        @endif
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var storageKey = 'order_signals_table_layout_v1';
    var defaultHeight = 460;
    var minHeight = 260;
    var maxHeight = 900;

    var tableWrap = document.getElementById('orderSignalsTableWrap');
    var resizeHandle = document.getElementById('osTableResizeHandle');
    var columnsToggle = document.getElementById('osColumnsToggle');
    var columnsPanel = document.getElementById('osColumnsPanel');
    var resetBtn = document.getElementById('osResetLayout');
    var toggles = Array.prototype.slice.call(document.querySelectorAll('.os-col-toggle'));

    if (!tableWrap || !resizeHandle || !columnsToggle || !columnsPanel || !resetBtn || !toggles.length) {
        return;
    }

    function getPreferences() {
        try {
            var raw = localStorage.getItem(storageKey);
            if (!raw) {
                return { hiddenColumns: [], height: defaultHeight };
            }

            var parsed = JSON.parse(raw);
            if (!parsed || typeof parsed !== 'object') {
                return { hiddenColumns: [], height: defaultHeight };
            }

            return {
                hiddenColumns: Array.isArray(parsed.hiddenColumns) ? parsed.hiddenColumns : [],
                height: typeof parsed.height === 'number' ? parsed.height : defaultHeight
            };
        } catch (e) {
            return { hiddenColumns: [], height: defaultHeight };
        }
    }

    function savePreferences(prefs) {
        localStorage.setItem(storageKey, JSON.stringify(prefs));
    }

    function applyHeight(height) {
        var bounded = Math.max(minHeight, Math.min(maxHeight, Number(height) || defaultHeight));
        tableWrap.style.maxHeight = bounded + 'px';
        return bounded;
    }

    function applyColumnVisibility(colKey, hidden) {
        var cells = document.querySelectorAll('[data-col="' + colKey + '"]');
        for (var i = 0; i < cells.length; i++) {
            cells[i].classList.toggle('os-col-hidden', hidden);
        }
    }

    function collectHiddenColumns() {
        return toggles
            .filter(function (toggle) {
                return !toggle.disabled && !toggle.checked;
            })
            .map(function (toggle) {
                return toggle.getAttribute('data-col-target');
            });
    }

    function syncToggleStateFromHidden(hiddenColumns) {
        toggles.forEach(function (toggle) {
            var colKey = toggle.getAttribute('data-col-target');
            var shouldHide = !toggle.disabled && hiddenColumns.indexOf(colKey) !== -1;
            if (!toggle.disabled) {
                toggle.checked = !shouldHide;
            }
            applyColumnVisibility(colKey, shouldHide);
        });
    }

    var prefs = getPreferences();
    prefs.height = applyHeight(prefs.height);
    syncToggleStateFromHidden(prefs.hiddenColumns);
    savePreferences(prefs);

    toggles.forEach(function (toggle) {
        toggle.addEventListener('change', function () {
            var colKey = toggle.getAttribute('data-col-target');
            var shouldHide = !toggle.checked;
            applyColumnVisibility(colKey, shouldHide);

            prefs.hiddenColumns = collectHiddenColumns();
            savePreferences(prefs);
        });
    });

    columnsToggle.addEventListener('click', function () {
        columnsPanel.classList.toggle('open');
    });

    document.addEventListener('click', function (event) {
        if (!columnsPanel.contains(event.target) && !columnsToggle.contains(event.target)) {
            columnsPanel.classList.remove('open');
        }
    });

    resetBtn.addEventListener('click', function () {
        toggles.forEach(function (toggle) {
            if (!toggle.disabled) {
                toggle.checked = true;
            }
            applyColumnVisibility(toggle.getAttribute('data-col-target'), false);
        });

        prefs.hiddenColumns = [];
        prefs.height = applyHeight(defaultHeight);
        savePreferences(prefs);
        columnsPanel.classList.remove('open');
    });

    resizeHandle.addEventListener('mousedown', function (event) {
        event.preventDefault();

        var startY = event.clientY;
        var startHeight = tableWrap.offsetHeight;

        function onMouseMove(moveEvent) {
            var delta = moveEvent.clientY - startY;
            prefs.height = applyHeight(startHeight + delta);
            savePreferences(prefs);
        }

        function onMouseUp() {
            document.removeEventListener('mousemove', onMouseMove);
            document.removeEventListener('mouseup', onMouseUp);
        }

        document.addEventListener('mousemove', onMouseMove);
        document.addEventListener('mouseup', onMouseUp);
    });
});
</script>
@endsection
