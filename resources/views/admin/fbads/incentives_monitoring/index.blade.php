@extends('admin.fbads.layouts')

@section('page')

@php
$typeConfig = [
    'Upsell'  => ['bg' => '#fee2e2', 'border' => '#fca5a5', 'text' => '#b91c1c', 'icon' => 'fa-arrow-up',      'grad' => 'linear-gradient(135deg,#ef4444,#dc2626)'],
    'InfoTxt' => ['bg' => '#dbeafe', 'border' => '#93c5fd', 'text' => '#1d4ed8', 'icon' => 'fa-comment-alt',   'grad' => 'linear-gradient(135deg,#3b82f6,#2563eb)'],
    'Pancake' => ['bg' => '#fef9c3', 'border' => '#fde047', 'text' => '#92400e', 'icon' => 'fa-layer-group',   'grad' => 'linear-gradient(135deg,#eab308,#ca8a04)'],
    'Events'  => ['bg' => '#dcfce7', 'border' => '#86efac', 'text' => '#15803d', 'icon' => 'fa-calendar-check','grad' => 'linear-gradient(135deg,#22c55e,#16a34a)'],
];

$periods = [
    'today'      => 'Today',
    'yesterday'  => 'Yesterday',
    'this_week'  => 'This Week',
    'last_week'  => 'Last Week',
    'this_month' => 'This Month',
];

$total = array_sum($analytics);

$totalEarnings = 0;
foreach ($analytics as $type => $count) {
    $totalEarnings += $count * ($rates[$type] ?? 0);
}

// Segment entries into stages
$newEntries       = $myEntries->filter(fn($e) => !$e->delivery_status && !$e->approved && !$e->payout_id);
$deliveredEntries = $myEntries->filter(fn($e) => $e->delivery_status === 'delivered' && !$e->approved && !$e->payout_id);
$approvedEntries  = $myEntries->filter(fn($e) => $e->approved && !$e->payout_id);
$paidEntries      = $myEntries->filter(fn($e) => (bool) $e->payout_id);
$returnedEntries  = $myEntries->filter(fn($e) => $e->delivery_status === 'returned');

// Dup detection
$mobileCount = [];
foreach ($myEntries as $entry) {
    $key = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
    $mobileCount[$key] = ($mobileCount[$key] ?? 0) + 1;
}
$dupKeys = array_keys(array_filter($mobileCount, fn($c) => $c > 1));
@endphp

<div style="max-width:1100px;margin:0 auto;padding:24px 16px;">

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:14px;font-weight:600;">
            <i class="fas fa-check-circle" style="margin-right:6px;"></i>{{ session('success') }}
        </div>
    @endif

    <div style="display:flex;gap:20px;align-items:flex-start;flex-wrap:wrap;">

        {{-- ===== LEFT: Analytics ===== --}}
        <div style="width:300px;flex-shrink:0;">
            <div style="background:#fff;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden;box-shadow:0 2px 8px rgba(0,0,0,.05);">

                {{-- Header --}}
                <div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);padding:16px 20px;">
                    <div style="font-size:15px;font-weight:800;color:#fff;">
                        <i class="fas fa-chart-bar" style="margin-right:7px;"></i>My Performance
                    </div>
                    <div style="font-size:12px;color:rgba(255,255,255,.7);margin-top:3px;">
                        {{ auth()->user()->first_name }} {{ auth()->user()->last_name }}
                    </div>
                </div>

                {{-- Period filter --}}
                <div style="padding:12px 12px 0;display:flex;flex-wrap:wrap;gap:5px;">
                    @foreach($periods as $key => $label)
                    <a href="{{ request()->fullUrlWithQuery(['period' => $key, 'date_from' => '', 'date_to' => '']) }}"
                        style="padding:5px 11px;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none;white-space:nowrap;
                            {{ $period === $key
                                ? 'background:#ede9fe;color:#7c3aed;'
                                : 'background:#f8fafc;color:#94a3b8;border:1px solid #e2e8f0;' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                    <button type="button" onclick="document.getElementById('custom-range').style.display=document.getElementById('custom-range').style.display==='none'?'flex':'none'"
                        style="padding:5px 11px;border-radius:8px;font-size:11px;font-weight:700;white-space:nowrap;cursor:pointer;border:none;
                            {{ $period === 'custom'
                                ? 'background:#ede9fe;color:#7c3aed;'
                                : 'background:#f8fafc;color:#94a3b8;border:1px solid #e2e8f0;' }}">
                        <i class="fas fa-calendar-alt" style="margin-right:4px;font-size:10px;"></i>Custom
                    </button>
                </div>

                {{-- Custom date range --}}
                <div id="custom-range" style="display:{{ $period === 'custom' ? 'flex' : 'none' }};flex-direction:column;gap:6px;padding:8px 12px 0;">
                    <form method="GET" action="{{ request()->url() }}" style="display:flex;flex-direction:column;gap:6px;">
                        <input type="hidden" name="period" value="custom">
                        <div style="display:flex;gap:6px;align-items:center;">
                            <div style="flex:1;">
                                <div style="font-size:10px;font-weight:700;color:#94a3b8;margin-bottom:3px;text-transform:uppercase;letter-spacing:.4px;">From</div>
                                <input type="date" name="date_from" value="{{ $dateFrom ?? '' }}" class="browser-default"
                                    style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:6px 8px;font-size:12px;color:#0f172a;background:#f8fafc;cursor:pointer;">
                            </div>
                            <div style="flex:1;">
                                <div style="font-size:10px;font-weight:700;color:#94a3b8;margin-bottom:3px;text-transform:uppercase;letter-spacing:.4px;">To</div>
                                <input type="date" name="date_to" value="{{ $dateTo ?? '' }}" class="browser-default"
                                    style="width:100%;border:1px solid #e2e8f0;border-radius:8px;padding:6px 8px;font-size:12px;color:#0f172a;background:#f8fafc;cursor:pointer;">
                            </div>
                        </div>
                        <button type="submit"
                            style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:8px;padding:7px 12px;font-size:11px;font-weight:700;cursor:pointer;text-align:center;">
                            <i class="fas fa-search" style="margin-right:4px;"></i>Apply
                        </button>
                    </form>
                </div>

                {{-- Stat rows --}}
                <div style="padding:14px 20px 0;">
                    <div style="display:flex;gap:10px;margin-bottom:10px;">
                        <div style="flex:1;background:#f8fafc;border-radius:10px;padding:10px 12px;">
                            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Entries</div>
                            <div style="font-size:26px;font-weight:800;color:#0f172a;line-height:1.1;">{{ $total }}</div>
                        </div>
                        <div style="flex:1;background:#f0fdf4;border-radius:10px;padding:10px 12px;">
                            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Earnings</div>
                            <div style="font-size:22px;font-weight:800;color:#059669;line-height:1.1;">₱{{ number_format($approvedValue, 0) }}</div>
                        </div>
                    </div>

                    {{-- Delivered --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:9px 12px;margin-bottom:8px;">
                        <div style="display:flex;align-items:center;gap:7px;">
                            <i class="fas fa-truck" style="color:#15803d;font-size:13px;"></i>
                            <span style="font-size:12px;font-weight:700;color:#15803d;">Delivered</span>
                        </div>
                        <span style="font-size:20px;font-weight:800;color:#15803d;">{{ $deliveredCount }}</span>
                    </div>

                    {{-- Approved --}}
                    <div style="display:flex;align-items:center;justify-content:space-between;background:#ede9fe;border:1px solid #c4b5fd;border-radius:10px;padding:9px 12px;margin-bottom:14px;">
                        <div style="display:flex;align-items:center;gap:7px;">
                            <i class="fas fa-check-double" style="color:#7c3aed;font-size:13px;"></i>
                            <span style="font-size:12px;font-weight:700;color:#7c3aed;">Approved</span>
                        </div>
                        <span style="font-size:20px;font-weight:800;color:#7c3aed;">{{ $approvedCount }}</span>
                    </div>
                </div>

                {{-- Type cards --}}
                <div style="padding:0 12px 14px;display:flex;flex-direction:column;gap:7px;">
                    @foreach($typeConfig as $type => $c)
                    @php
                        $count  = $analytics[$type] ?? 0;
                        $rate   = $rates[$type] ?? 0;
                        $earned = $count * $rate;
                    @endphp
                    <div style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:10px;">
                        <div style="width:30px;height:30px;border-radius:8px;background:{{ $c['grad'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                            <i class="fas {{ $c['icon'] }}" style="color:#fff;font-size:12px;"></i>
                        </div>
                        <div style="flex:1;min-width:0;">
                            <div style="font-size:12px;font-weight:700;color:{{ $c['text'] }};">{{ $type }}</div>
                            <div style="font-size:10px;color:{{ $c['text'] }};opacity:.7;">₱{{ number_format($rate, 0) }} each</div>
                        </div>
                        <div style="text-align:right;flex-shrink:0;">
                            <div style="font-size:20px;font-weight:800;color:{{ $c['text'] }};line-height:1;">{{ $count }}</div>
                            <div style="font-size:11px;font-weight:600;color:#059669;">₱{{ number_format($earned, 0) }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                {{-- Payout History --}}
                @if($myPayouts->isNotEmpty())
                <div style="padding:0 12px 14px;">
                    <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;padding-top:10px;border-top:1px solid #f1f5f9;">
                        <i class="fas fa-history" style="margin-right:4px;"></i>Payout History
                    </div>
                    @foreach($myPayouts as $row)
                    @php $p = $row['payout']; @endphp
                    <div style="background:#f8fafc;border-radius:10px;padding:9px 12px;margin-bottom:6px;">
                        <div style="display:flex;align-items:center;justify-content:space-between;gap:8px;">
                            <div style="min-width:0;">
                                <div style="font-size:12px;font-weight:700;color:#0f172a;line-height:1.2;">{{ $p->label ?? '' }}</div>
                                <div style="display:flex;flex-wrap:wrap;gap:3px;margin-top:4px;">
                                    @foreach($row['byType'] as $type => $count)
                                    @php $tc = $typeConfig[$type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569']; @endphp
                                    <span style="background:{{ $tc['bg'] }};border:1px solid {{ $tc['border'] }};color:{{ $tc['text'] }};border-radius:5px;padding:1px 6px;font-size:10px;font-weight:700;">
                                        {{ $type }} ×{{ $count }}
                                    </span>
                                    @endforeach
                                </div>
                            </div>
                            <div style="text-align:right;flex-shrink:0;">
                                <div style="font-size:14px;font-weight:800;color:#0d9488;">₱{{ number_format($row['myTotal'], 0) }}</div>
                                <div style="font-size:10px;color:#94a3b8;">{{ $p ? $p->released_at->format('M d') : '' }}</div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endif

            </div>
        </div>

        {{-- ===== RIGHT: My Entries (Roadmap Tabs) ===== --}}
        <div style="flex:1;min-width:0;">

            {{-- Top bar --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
                <div>
                    <div style="font-size:20px;font-weight:800;color:#0f172a;">My Entries</div>
                    <div style="font-size:13px;color:#94a3b8;margin-top:2px;">{{ $myEntries->count() }} total</div>
                </div>
                <a href="{{ route('fbads.incentives.create') }}"
                    style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:10px;padding:10px 18px;font-size:13px;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
                    <i class="fas fa-plus"></i> New Entry
                </a>
            </div>

            {{-- ===== Roadmap Tab Bar ===== --}}
            @php
            $tabs = [
                'new'       => ['label' => 'New',       'icon' => 'fa-plus-circle',    'color' => '#6366f1', 'light' => '#ede9fe', 'count' => $newEntries->count()],
                'delivered' => ['label' => 'Delivered',  'icon' => 'fa-truck',          'color' => '#15803d', 'light' => '#dcfce7', 'count' => $deliveredEntries->count()],
                'approved'  => ['label' => 'Approved',   'icon' => 'fa-check-double',   'color' => '#7c3aed', 'light' => '#ede9fe', 'count' => $approvedEntries->count()],
                'paid'      => ['label' => 'Paid',       'icon' => 'fa-money-bill-wave','color' => '#0d9488', 'light' => '#f0fdfa', 'count' => $paidEntries->count()],
                'returned'  => ['label' => 'Returned',   'icon' => 'fa-undo',           'color' => '#ef4444', 'light' => '#fee2e2', 'count' => $returnedEntries->count()],
            ];
            @endphp

            <div style="display:flex;align-items:stretch;margin-bottom:20px;background:#fff;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden;">
                @foreach($tabs as $tabKey => $tab)
                @php $isLast = $loop->last; $isFirst = $loop->first; @endphp
                <button onclick="switchTab('{{ $tabKey }}')" id="tab-{{ $tabKey }}"
                    style="flex:1;padding:11px 6px;border:none;background:{{ $tabKey === 'new' ? $tab['light'] : '#fff' }};cursor:pointer;position:relative;border-right:{{ !$isLast ? '1px solid #f1f5f9' : 'none' }};transition:background .15s;">
                    <div style="font-size:13px;font-weight:800;color:{{ $tabKey === 'new' ? $tab['color'] : '#94a3b8' }};">
                        <i class="fas {{ $tab['icon'] }}" style="font-size:11px;margin-right:3px;"></i>
                        {{ $tab['label'] }}
                    </div>
                    @if($tab['count'] > 0 || $tabKey === 'returned')
                    <div id="badge-{{ $tabKey }}" style="font-size:18px;font-weight:800;color:{{ $tabKey === 'new' ? $tab['color'] : '#cbd5e1' }};line-height:1.2;margin-top:2px;">
                        {{ $tab['count'] }}
                    </div>
                    @else
                    <div id="badge-{{ $tabKey }}" style="font-size:18px;font-weight:800;color:#cbd5e1;line-height:1.2;margin-top:2px;">0</div>
                    @endif
                    {{-- Arrow connector --}}
                    @if(!$isLast)
                    <div style="position:absolute;right:-10px;top:50%;transform:translateY(-50%);z-index:1;font-size:11px;color:#cbd5e1;pointer-events:none;">&#8250;</div>
                    @endif
                </button>
                @endforeach
            </div>

            {{-- ===== Panel: New ===== --}}
            <div id="panel-new">
                @forelse($newEntries as $entry)
                @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
                $dupKey = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $isDup  = in_array($dupKey, $dupKeys); @endphp
                @php $tab = 'new'; @endphp
                @include('admin.fbads.incentives_monitoring._entry_row', compact('entry','c','isDup','tab'))
                @empty
                <div style="text-align:center;padding:48px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                    <i class="fas fa-inbox" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0;"></i>
                    <div style="font-size:14px;font-weight:600;color:#cbd5e1;">No new entries</div>
                </div>
                @endforelse
            </div>

            {{-- ===== Panel: Delivered ===== --}}
            <div id="panel-delivered" style="display:none;">
                @forelse($deliveredEntries as $entry)
                @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
                $dupKey = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $isDup  = in_array($dupKey, $dupKeys); @endphp
                @php $tab = 'delivered'; @endphp
                @include('admin.fbads.incentives_monitoring._entry_row', compact('entry','c','isDup','tab'))
                @empty
                <div style="text-align:center;padding:48px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                    <i class="fas fa-truck" style="font-size:36px;display:block;margin-bottom:12px;color:#86efac;"></i>
                    <div style="font-size:14px;font-weight:600;color:#cbd5e1;">No delivered entries</div>
                </div>
                @endforelse
            </div>

            {{-- ===== Panel: Approved ===== --}}
            <div id="panel-approved" style="display:none;">
                @forelse($approvedEntries as $entry)
                @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
                $dupKey = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $isDup  = in_array($dupKey, $dupKeys); @endphp
                @php $tab = 'approved'; @endphp
                @include('admin.fbads.incentives_monitoring._entry_row', compact('entry','c','isDup','tab'))
                @empty
                <div style="text-align:center;padding:48px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                    <i class="fas fa-check-double" style="font-size:36px;display:block;margin-bottom:12px;color:#c4b5fd;"></i>
                    <div style="font-size:14px;font-weight:600;color:#cbd5e1;">No approved entries</div>
                </div>
                @endforelse
            </div>

            {{-- ===== Panel: Paid ===== --}}
            <div id="panel-paid" style="display:none;">
                @forelse($paidEntries as $entry)
                @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
                $dupKey = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $isDup  = in_array($dupKey, $dupKeys); @endphp
                @php $tab = 'paid'; @endphp
                @include('admin.fbads.incentives_monitoring._entry_row', compact('entry','c','isDup','tab'))
                @empty
                <div style="text-align:center;padding:48px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                    <i class="fas fa-money-bill-wave" style="font-size:36px;display:block;margin-bottom:12px;color:#99f6e4;"></i>
                    <div style="font-size:14px;font-weight:600;color:#cbd5e1;">No paid entries yet</div>
                </div>
                @endforelse
            </div>

            {{-- ===== Panel: Returned ===== --}}
            <div id="panel-returned" style="display:none;">
                @forelse($returnedEntries as $entry)
                @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
                $dupKey = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $isDup  = in_array($dupKey, $dupKeys); @endphp
                @php $tab = 'returned'; @endphp
                @include('admin.fbads.incentives_monitoring._entry_row', compact('entry','c','isDup','tab'))
                @empty
                <div style="text-align:center;padding:48px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                    <i class="fas fa-undo" style="font-size:36px;display:block;margin-bottom:12px;color:#fca5a5;"></i>
                    <div style="font-size:14px;font-weight:600;color:#cbd5e1;">No returned entries</div>
                </div>
                @endforelse
            </div>

        </div>
    </div>
</div>

{{-- Toast --}}
<div id="mb-toast" style="position:fixed;top:20px;left:20px;z-index:9999;display:none;align-items:center;gap:10px;background:#fff;border:1px solid #86efac;border-left:4px solid #22c55e;border-radius:10px;padding:12px 16px;box-shadow:0 4px 20px rgba(0,0,0,.1);min-width:220px;max-width:300px;">
    <i class="fas fa-check-circle" style="color:#22c55e;font-size:16px;flex-shrink:0;"></i>
    <span id="mb-toast-msg" style="font-size:13px;font-weight:600;color:#0f172a;"></span>
</div>

<script>
var tabColors = {
    'new':       { color: '#6366f1', light: '#ede9fe' },
    'delivered': { color: '#15803d', light: '#dcfce7' },
    'approved':  { color: '#7c3aed', light: '#ede9fe' },
    'paid':      { color: '#0d9488', light: '#f0fdfa' },
    'returned':  { color: '#ef4444', light: '#fee2e2' },
};

function switchTab(tab) {
    var all = ['new','delivered','approved','paid','returned'];
    all.forEach(function(t) {
        document.getElementById('panel-' + t).style.display = t === tab ? 'block' : 'none';
        var btn = document.getElementById('tab-' + t);
        var badge = document.getElementById('badge-' + t);
        if (t === tab) {
            btn.style.background = tabColors[t].light;
            btn.querySelector('div').style.color = tabColors[t].color;
            badge.style.color = tabColors[t].color;
        } else {
            btn.style.background = '#fff';
            btn.querySelector('div').style.color = '#94a3b8';
            badge.style.color = '#cbd5e1';
        }
    });
}

function mbShowToast(msg) {
    var t = document.getElementById('mb-toast');
    document.getElementById('mb-toast-msg').textContent = msg;
    t.style.display = 'flex';
    setTimeout(function() { t.style.display = 'none'; }, 3000);
}

document.addEventListener('click', function(e) {
    var btn = e.target.closest('.btn-deliver');
    if (!btn) return;
    btn.disabled = true;
    btn.style.opacity = '0.6';
    var url  = btn.dataset.url;
    var csrf = document.querySelector('meta[name="csrf-token"]')
               ? document.querySelector('meta[name="csrf-token"]').content
               : '{{ csrf_token() }}';
    fetch(url, {
        method: 'POST',
        headers: { 'X-CSRF-TOKEN': csrf, 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
    })
    .then(function(r) { return r.json(); })
    .then(function(data) {
        if (data.success) {
            var row = btn.closest('[data-entry-row]');
            if (row) row.remove();
            mbShowToast('Marked as delivered.');
        }
    })
    .catch(function() { btn.disabled = false; btn.style.opacity = '1'; });
});
</script>

<script>
document.querySelectorAll('input[type="date"]').forEach(function(el) {
    el.addEventListener('click', function() {
        try { this.showPicker(); } catch(e) {}
    });
});
</script>

@endsection
