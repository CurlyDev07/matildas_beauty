@extends('admin.layouts.app')

@section('content')

@php
$typeConfig = [
    'Upsell'  => ['bg' => '#fee2e2', 'border' => '#fca5a5', 'text' => '#b91c1c', 'icon' => 'fa-arrow-up',      'grad' => 'linear-gradient(135deg,#ef4444,#dc2626)'],
    'InfoTxt' => ['bg' => '#dbeafe', 'border' => '#93c5fd', 'text' => '#1d4ed8', 'icon' => 'fa-comment-alt',   'grad' => 'linear-gradient(135deg,#3b82f6,#2563eb)'],
    'Pancake' => ['bg' => '#fef9c3', 'border' => '#fde047', 'text' => '#92400e', 'icon' => 'fa-layer-group',   'grad' => 'linear-gradient(135deg,#eab308,#ca8a04)'],
    'Events'  => ['bg' => '#dcfce7', 'border' => '#86efac', 'text' => '#15803d', 'icon' => 'fa-calendar-check','grad' => 'linear-gradient(135deg,#22c55e,#16a34a)'],
];
@endphp

{{-- Toast --}}
<div id="ie-toast" style="display:none;position:fixed;bottom:24px;right:24px;z-index:9999;background:#1e293b;color:#fff;border-radius:10px;padding:12px 18px;font-size:13px;font-weight:600;box-shadow:0 4px 20px rgba(0,0,0,.2);transition:opacity .3s;"></div>

<div style="max-width:1100px;margin:0 auto;padding:24px 16px;">

    {{-- Page header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:12px;">
        <div>
            <div style="font-size:22px;font-weight:800;color:#0f172a;">Incentive Entries</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:2px;">
                @if($search)
                    Showing results for <strong>"{{ $search }}"</strong> &mdash; {{ number_format($entries->total()) }} found
                @else
                    Showing {{ number_format($entries->total()) }} entries
                @endif
            </div>
        </div>
    </div>

    {{-- Search --}}
    <form method="GET" action="{{ route('staff.incentive_entries') }}" style="margin-bottom:18px;display:flex;gap:8px;align-items:flex-end;flex-wrap:wrap;">
        <div style="flex:1;min-width:230px;position:relative;">
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Search</label>
            <i class="fas fa-search" style="position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:13px;pointer-events:none;"></i>
            <input type="text" name="search" value="{{ $search }}"
                placeholder="Search by mobile number or staff name…"
                style="width:100%;padding:10px 12px 10px 34px;border:1px solid #e2e8f0;border-radius:10px;font-size:14px;color:#0f172a;outline:none;box-sizing:border-box;">
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Date From</label>
            <div class="ie-date-picker" onclick="ieOpenDatePicker(this)" style="width:155px;border:1px solid #e2e8f0;border-radius:10px;height:41px;background:#fff;display:flex;align-items:center;gap:8px;padding:0 10px;box-sizing:border-box;cursor:pointer;">
                <i class="fas fa-calendar-alt" style="font-size:12px;color:#8b5cf6;pointer-events:none;"></i>
                <input type="date" name="date_from" value="{{ $dateFrom }}"
                    style="width:100%;padding:0;border:none;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:39px;background:transparent;cursor:pointer;pointer-events:none;text-align:center;line-height:39px;">
            </div>
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Date To</label>
            <div class="ie-date-picker" onclick="ieOpenDatePicker(this)" style="width:155px;border:1px solid #e2e8f0;border-radius:10px;height:41px;background:#fff;display:flex;align-items:center;gap:8px;padding:0 10px;box-sizing:border-box;cursor:pointer;">
                <i class="fas fa-calendar-alt" style="font-size:12px;color:#8b5cf6;pointer-events:none;"></i>
                <input type="date" name="date_to" value="{{ $dateTo }}"
                    style="width:100%;padding:0;border:none;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:39px;background:transparent;cursor:pointer;pointer-events:none;text-align:center;line-height:39px;">
            </div>
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Show</label>
            <select name="per_page" class="browser-default"
                style="display:block!important;opacity:1!important;position:static!important;pointer-events:auto!important;width:125px;padding:9px 32px 9px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:41px;background:#fff;appearance:auto!important;-webkit-appearance:menulist!important;">
                @foreach([50, 100, 200] as $option)
                    <option value="{{ $option }}" {{ (int) $perPage === $option ? 'selected' : '' }}>{{ $option }} rows</option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Delivery</label>
            <select name="delivery_status" class="browser-default"
                style="display:block!important;opacity:1!important;position:static!important;pointer-events:auto!important;width:135px;padding:9px 32px 9px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:41px;background:#fff;appearance:auto!important;-webkit-appearance:menulist!important;">
                <option value="">All</option>
                @foreach(['shipped' => 'Shipped', 'delivered' => 'Delivered', 'returned' => 'Returned'] as $value => $label)
                    <option value="{{ $value }}" {{ $deliveryStatus === $value ? 'selected' : '' }}>{{ $label }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Approved</label>
            <select name="approved" class="browser-default"
                style="display:block!important;opacity:1!important;position:static!important;pointer-events:auto!important;width:135px;padding:9px 32px 9px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:41px;background:#fff;appearance:auto!important;-webkit-appearance:menulist!important;">
                <option value="">All</option>
                <option value="1" {{ (string) $approved === '1' ? 'selected' : '' }}>Approved</option>
                <option value="0" {{ (string) $approved === '0' ? 'selected' : '' }}>Not Approved</option>
            </select>
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">User</label>
            <select name="user_id" class="browser-default"
                style="display:block!important;opacity:1!important;position:static!important;pointer-events:auto!important;width:175px;padding:9px 32px 9px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:41px;background:#fff;appearance:auto!important;-webkit-appearance:menulist!important;">
                <option value="">All Users</option>
                @foreach($users as $filterUser)
                    @php $filterUserName = trim($filterUser->first_name . ' ' . $filterUser->last_name); @endphp
                    <option value="{{ $filterUser->id }}" {{ (string) $userId === (string) $filterUser->id ? 'selected' : '' }}>
                        {{ $filterUserName ?: 'User #' . $filterUser->id }}
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label style="display:block;font-size:11px;font-weight:800;color:#64748b;margin-bottom:5px;text-transform:uppercase;">Type</label>
            <select name="type" class="browser-default"
                style="display:block!important;opacity:1!important;position:static!important;pointer-events:auto!important;width:135px;padding:9px 32px 9px 12px;border:1px solid #e2e8f0;border-radius:10px;font-size:13px;color:#0f172a;outline:none;box-sizing:border-box;height:41px;background:#fff;appearance:auto!important;-webkit-appearance:menulist!important;">
                <option value="">All Types</option>
                @foreach($types as $filterType)
                    <option value="{{ $filterType }}" {{ $type === $filterType ? 'selected' : '' }}>{{ $filterType }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit"
            style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:10px;padding:10px 20px;font-size:13px;font-weight:700;cursor:pointer;white-space:nowrap;height:41px;">
            Search
        </button>
        @if($search || $dateFrom || $dateTo || $deliveryStatus || (string) $approved !== '' || $userId || $type)
        <a href="{{ route('staff.incentive_entries') }}"
            style="background:#f1f5f9;color:#64748b;border-radius:10px;padding:10px 16px;font-size:13px;font-weight:600;text-decoration:none;display:flex;align-items:center;gap:5px;white-space:nowrap;height:41px;">
            <i class="fas fa-times" style="font-size:11px;"></i> Clear
        </a>
        @endif
    </form>

    <div style="margin:-6px 0 14px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;color:#64748b;font-size:12px;font-weight:700;">
        <span style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:999px;padding:6px 12px;display:inline-flex;align-items:center;gap:6px;">
            <i class="fas fa-filter" style="font-size:11px;color:#8b5cf6;"></i>
            {{ number_format($entries->total()) }} result{{ $entries->total() == 1 ? '' : 's' }}
        </span>
        @if($entries->total() > 0)
            <span style="color:#94a3b8;">
                Showing {{ number_format($entries->firstItem()) }}-{{ number_format($entries->lastItem()) }} of {{ number_format($entries->total()) }}
            </span>
        @endif
    </div>

    {{-- Entries list --}}
    @forelse($entries as $entry)
    @php
        $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
        $userName = $entry->user ? trim($entry->user->first_name . ' ' . $entry->user->last_name) : 'Unknown';
    @endphp
    <div id="ie-row-{{ $entry->id }}" style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:12px 14px;margin-bottom:8px;display:flex;align-items:center;gap:10px;flex-wrap:wrap;transition:opacity .3s;">

        {{-- Type badge --}}
        <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
            <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i>
            {{ $entry->type }}
        </span>

        {{-- Staff name --}}
        <span style="font-size:13px;color:#6366f1;font-weight:600;flex-shrink:0;white-space:nowrap;">
            <i class="fas fa-user" style="color:#a5b4fc;margin-right:4px;font-size:11px;"></i>{{ $userName }}
        </span>

        {{-- Mobile --}}
        <span style="font-size:14px;color:#0f172a;font-weight:600;flex:1;min-width:120px;">
            <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
        </span>

        {{-- Status badge --}}
        <span id="ie-status-{{ $entry->id }}" style="flex-shrink:0;">
        @if($entry->payout_id)
            <span style="background:#f0fdfa;border:1px solid #99f6e4;color:#0d9488;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;">
                <i class="fas fa-money-bill-wave" style="font-size:10px;margin-right:3px;"></i>Paid &middot; {{ $entry->payout->label ?? '' }}
            </span>
        @elseif($entry->invalid)
            <span style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;">
                <i class="fas fa-ban" style="font-size:10px;margin-right:3px;"></i>Invalid
            </span>
        @elseif($entry->approved)
            <span style="background:#ede9fe;border:1px solid #c4b5fd;color:#7c3aed;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;">
                <i class="fas fa-check-double" style="font-size:10px;margin-right:3px;"></i>Approved
            </span>
        @elseif($entry->delivery_status === 'delivered')
            <span style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;">
                <i class="fas fa-truck" style="font-size:10px;margin-right:3px;"></i>Delivered
            </span>
        @elseif($entry->delivery_status === 'shipped')
            <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;">
                <i class="fas fa-shipping-fast" style="font-size:10px;margin-right:3px;"></i>Shipped
            </span>
        @else
            <span style="background:#f8fafc;border:1px solid #e2e8f0;color:#94a3b8;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;">
                Pending
            </span>
        @endif
        </span>

        {{-- Rate --}}
        <span style="font-size:12px;font-weight:700;color:#059669;flex-shrink:0;white-space:nowrap;">
            ₱{{ number_format($rates[$entry->type] ?? 0, 0) }}
        </span>

        {{-- Date --}}
        <div style="text-align:right;flex-shrink:0;">
            <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
            <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
        </div>

        {{-- Actions --}}
        <div style="display:flex;gap:4px;flex-shrink:0;margin-left:4px;">

            {{-- Mark Delivered — only if not yet delivered/approved --}}
            @if(!$entry->delivery_status && !$entry->approved)
            <button type="button" title="Mark as Delivered"
                onclick="ieDeliver({{ $entry->id }}, this)"
                style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
                <i class="fas fa-truck"></i>
            </button>
            @endif

            <a href="{{ route('fbads.incentives.edit', $entry->id) }}"
                style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:7px;padding:6px 9px;font-size:11px;text-decoration:none;display:flex;align-items:center;">
                <i class="fas fa-pen"></i>
            </a>

            <button type="button" title="Delete"
                onclick="ieDelete({{ $entry->id }}, this)"
                style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
                <i class="fas fa-trash"></i>
            </button>

        </div>

    </div>
    @empty
    <div style="text-align:center;padding:64px 24px;color:#94a3b8;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
        <i class="fas fa-inbox" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0;"></i>
        <div style="font-size:15px;font-weight:600;color:#cbd5e1;">No entries found</div>
        @if($search)
        <div style="font-size:13px;margin-top:6px;">
            <a href="{{ route('staff.incentive_entries') }}" style="color:#6366f1;text-decoration:none;font-weight:600;">Clear search</a> to see all entries
        </div>
        @endif
    </div>
    @endforelse

    @if($entries->hasPages())
        <div style="margin-top:18px;">
            {{ $entries->links() }}
        </div>
    @endif

</div>

<style>
.ie-date-picker input[type="date"]::-webkit-calendar-picker-indicator {
    display: none;
    -webkit-appearance: none;
}
</style>

<script>
var _token = '{{ csrf_token() }}';

function ieToast(msg, ok) {
    var t = document.getElementById('ie-toast');
    t.textContent = msg;
    t.style.background = ok ? '#064e3b' : '#7f1d1d';
    t.style.display = 'block';
    t.style.opacity = '1';
    clearTimeout(window._ieToastTimer);
    window._ieToastTimer = setTimeout(function () {
        t.style.opacity = '0';
        setTimeout(function () { t.style.display = 'none'; }, 300);
    }, 2500);
}

function ieOpenDatePicker(wrapper) {
    var input = wrapper.querySelector('input[type="date"]');
    if (!input) return;

    input.focus();

    if (typeof input.showPicker === 'function') {
        input.showPicker();
        return;
    }

    input.click();
}

function ieDeliver(id, btn) {
    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    fetch('/admin/fbads/incentives/' + id + '/deliver', {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': _token, 'Accept': 'application/json' }
    })
    .then(function (r) { return r.ok ? r : Promise.reject(r.status); })
    .then(function () {
        // Swap status badge to Delivered
        var statusEl = document.getElementById('ie-status-' + id);
        if (statusEl) {
            statusEl.innerHTML = '<span style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;"><i class="fas fa-truck" style="font-size:10px;margin-right:3px;"></i>Delivered</span>';
        }
        // Remove the deliver button
        btn.parentNode.removeChild(btn);
        ieToast('Marked as delivered', true);
    })
    .catch(function () {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-truck"></i>';
        ieToast('Failed — please try again', false);
    });
}

function ieDelete(id, btn) {
    if (!confirm('Delete this entry?')) return;

    btn.disabled = true;
    btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

    fetch('/admin/fbads/incentives/' + id, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': _token, 'Accept': 'application/json', 'Content-Type': 'application/x-www-form-urlencoded' },
        body: '_method=DELETE'
    })
    .then(function (r) { return r.ok ? r : Promise.reject(r.status); })
    .then(function () {
        var row = document.getElementById('ie-row-' + id);
        if (row) {
            row.style.opacity = '0';
            setTimeout(function () { row.remove(); }, 300);
        }
        ieToast('Entry deleted', true);
    })
    .catch(function () {
        btn.disabled = false;
        btn.innerHTML = '<i class="fas fa-trash"></i>';
        ieToast('Failed — please try again', false);
    });
}
</script>

@endsection
