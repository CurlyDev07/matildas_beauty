@extends('admin.fbads.layouts')

@section('css')
<style>
    .bl-shell {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.08);
        overflow: hidden;
    }
    .bl-header {
        padding: 18px 22px;
        border-bottom: 1px solid #e7ebf3;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        flex-wrap: wrap;
        background: linear-gradient(120deg, #fff8f8 0%, #fff1f1 100%);
    }
    .bl-title {
        margin: 0;
        font-size: 22px;
        line-height: 1.2;
        color: #7f1d1d;
        font-weight: 700;
    }
    .bl-subtitle {
        margin-top: 6px;
        color: #7c2d12;
        font-size: 13px;
        font-weight: 500;
    }
    .bl-stats {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .bl-pill {
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #b91c1c;
        border-radius: 999px;
        padding: 6px 10px;
        font-size: 12px;
        font-weight: 700;
        white-space: nowrap;
    }
    .bl-body {
        padding: 18px 22px 22px;
    }
    .bl-tools {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }
    .bl-search {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .bl-input {
        margin: 0 !important;
        height: 38px !important;
        border: 1px solid #cfd8e7 !important;
        border-radius: 10px !important;
        background: #fff !important;
        padding: 0 12px !important;
        min-width: 320px;
        box-sizing: border-box !important;
        font-size: 13px !important;
    }
    .bl-btn {
        border: 0;
        border-radius: 10px;
        height: 38px;
        padding: 0 12px;
        font-size: 13px;
        font-weight: 700;
        cursor: pointer;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .bl-btn-primary {
        background: #dc2626;
        color: #fff;
    }
    .bl-btn-primary:hover {
        background: #b91c1c;
        color: #fff;
    }
    .bl-btn-muted {
        border: 1px solid #d8e1ef;
        background: #fff;
        color: #334155;
    }
    .bl-btn-muted:hover {
        background: #f8fafc;
        color: #334155;
    }
    .bl-table-wrap {
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        overflow: auto;
    }
    .bl-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 900px;
    }
    .bl-table thead th {
        position: sticky;
        top: 0;
        background: #f8fafc;
        color: #334155;
        font-size: 12px;
        font-weight: 700;
        letter-spacing: .01em;
        text-transform: uppercase;
        text-align: left;
        padding: 12px 10px;
        border-bottom: 1px solid #e2e8f0;
    }
    .bl-table tbody td {
        padding: 12px 10px;
        border-bottom: 1px solid #edf2f7;
        font-size: 13px;
        color: #1e293b;
        vertical-align: top;
    }
    .bl-code {
        font-family: ui-monospace, SFMono-Regular, Menlo, Monaco, Consolas, "Liberation Mono", "Courier New", monospace;
        font-size: 12px;
        word-break: break-all;
    }
    .bl-count {
        display: inline-block;
        min-width: 32px;
        text-align: center;
        border: 1px solid #fecaca;
        background: #fef2f2;
        color: #b91c1c;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        padding: 2px 8px;
    }
    .bl-empty {
        text-align: center;
        color: #64748b;
        padding: 24px;
        font-size: 13px;
    }
    .bl-pager {
        margin-top: 12px;
    }
    @media (max-width: 768px) {
        .bl-input {
            min-width: 0;
            width: 100%;
        }
        .bl-search {
            width: 100%;
        }
    }
</style>
@endsection

@section('page')
<div class="bl-shell">
    <div class="bl-header">
        <div>
            <h1 class="bl-title">Order Signal Block List</h1>
            <div class="bl-subtitle">{{ number_format($blockList->total()) }} records</div>
        </div>
        <div class="bl-stats">
            <span class="bl-pill">Total Blocked: {{ number_format($totalBlocked) }}</span>
            <span class="bl-pill">Total Attempts: {{ number_format($totalAttempts) }}</span>
        </div>
    </div>

    <div class="bl-body">
        <div class="bl-tools">
            <form method="GET" action="{{ route('fbads.order_signal_block_list') }}" class="bl-search">
                <input
                    type="text"
                    name="search"
                    value="{{ $search }}"
                    class="bl-input"
                    placeholder="Search fingerprintjs_visitor_id..."
                >
                <button type="submit" class="bl-btn bl-btn-primary">Search</button>
                @if (!empty($search))
                    <a href="{{ route('fbads.order_signal_block_list') }}" class="bl-btn bl-btn-muted">Clear</a>
                @endif
            </form>

            <a href="{{ route('fbads.order_signals') }}" class="bl-btn bl-btn-muted">Go To Signals</a>
        </div>

        <div class="bl-table-wrap">
            <table class="bl-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>FingerprintJS Visitor ID</th>
                    <th>Attempt Count</th>
                    <th>Last Attempt</th>
                    <th>Blocked At</th>
                    <th>Blocked By</th>
                </tr>
                </thead>
                <tbody>
                @forelse($blockList as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td class="bl-code">{{ $item->fingerprintjs_visitor_id }}</td>
                        <td><span class="bl-count">{{ (int) $item->attempt_count }}</span></td>
                        <td class="bl-code">
                            @if (!empty($item->last_attempt_at))
                                {{ \Carbon\Carbon::createFromTimestamp((int) $item->last_attempt_at)->format('M d, Y h:i A') }}
                            @else
                                -
                            @endif
                        </td>
                        <td class="bl-code">
                            @if (!empty($item->timestamp))
                                {{ \Carbon\Carbon::createFromTimestamp((int) $item->timestamp)->format('M d, Y h:i A') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            @if (!empty($item->blocked_by_name))
                                {{ $item->blocked_by_name }}
                            @elseif (!empty($item->blocked_by_email))
                                {{ $item->blocked_by_email }}
                            @elseif (!empty($item->user_id))
                                User #{{ $item->user_id }}
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="bl-empty">No blocked fingerprints found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="bl-pager">
            {{ $blockList->links() }}
        </div>
    </div>
</div>
@endsection
