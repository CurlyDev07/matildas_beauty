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
                    <a href="{{ request()->fullUrlWithQuery(['period' => $key]) }}"
                        style="padding:5px 11px;border-radius:8px;font-size:11px;font-weight:700;text-decoration:none;white-space:nowrap;
                            {{ $period === $key
                                ? 'background:#ede9fe;color:#7c3aed;'
                                : 'background:#f8fafc;color:#94a3b8;border:1px solid #e2e8f0;' }}">
                        {{ $label }}
                    </a>
                    @endforeach
                </div>

                {{-- Stat rows --}}
                <div style="padding:14px 20px 0;">

                    {{-- Entries + Earnings (approved value) --}}
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
                <div style="padding:14px 20px 0;;display:flex;flex-direction:column;gap:7px;">
                    @foreach($typeConfig as $type => $c)
                    @php
                        $count    = $analytics[$type] ?? 0;
                        $rate     = $rates[$type] ?? 0;
                        $earned   = $count * $rate;
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
                <div style="padding:0 12px 14px;" class="tmt-5">
                    <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-bottom:8px;padding-top:4px;border-top:;">
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
                                    @php $tc = $typeConfig[$type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
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

        {{-- ===== RIGHT: My Entries ===== --}}
        <div style="flex:1;min-width:0;">

            {{-- Header --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
                <div>
                    <div style="font-size:20px;font-weight:800;color:#0f172a;">My Entries</div>
                    <div style="font-size:13px;color:#94a3b8;margin-top:2px;">{{ $myEntries->count() }} total</div>
                </div>
                <a href="{{ route('fbads.incentives.create') }}"
                    style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:10px;padding:10px 18px;font-size:13px;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
                    <i class="fas fa-plus"></i> New Entry
                </a>
            </div>

            {{-- Entries --}}
            @php
            $mobileCount = [];
            foreach ($myEntries as $entry) {
                $key = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $mobileCount[$key] = ($mobileCount[$key] ?? 0) + 1;
            }
            $dupKeys = array_keys(array_filter($mobileCount, fn($c) => $c > 1));
            @endphp

            @forelse($myEntries as $entry)
            @php
                $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8'];
                $dupKey = $entry->customer_mobile . '|' . $entry->created_at->toDateString();
                $isDup = in_array($dupKey, $dupKeys);
            @endphp
            <div style="background:#fff;border:1px solid {{ $isDup ? '#fde68a' : '#e2e8f0' }};border-radius:12px;padding:12px 14px;margin-bottom:8px;display:flex;align-items:center;gap:10px;">

                {{-- Type badge --}}
                <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
                    <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i>
                    {{ $entry->type }}
                </span>

                {{-- Mobile --}}
                <span style="font-size:14px;color:#0f172a;font-weight:600;flex:1;min-width:0;">
                    <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
                </span>

                {{-- DUP badge --}}
                @if($isDup)
                <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:6px;padding:2px 8px;font-size:10px;font-weight:800;flex-shrink:0;white-space:nowrap;">
                    <i class="fas fa-exclamation-triangle" style="font-size:9px;margin-right:2px;"></i>DUP
                </span>
                @endif

                {{-- Delivery / Approved status badge --}}
                @if($entry->payout_id)
                <span style="background:#f0fdfa;border:1px solid #99f6e4;color:#0d9488;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
                    <i class="fas fa-money-bill-wave" style="font-size:10px;margin-right:3px;"></i>Paid &middot; {{ $entry->payout->label ?? '' }}
                </span>
                @elseif($entry->approved)
                <span style="background:#ede9fe;border:1px solid #c4b5fd;color:#7c3aed;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
                    <i class="fas fa-check-double" style="font-size:10px;margin-right:3px;"></i>Approved
                </span>
                @elseif($entry->delivery_status === 'delivered')
                <span style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
                    <i class="fas fa-truck" style="font-size:10px;margin-right:3px;"></i>Delivered
                </span>
                @elseif($entry->delivery_status === 'shipped')
                <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
                    <i class="fas fa-shipping-fast" style="font-size:10px;margin-right:3px;"></i>Shipped
                </span>
                @endif

                {{-- Date --}}
                <div style="text-align:right;flex-shrink:0;">
                    <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
                    <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
                </div>

                {{-- Actions --}}
                <div style="display:flex;gap:4px;flex-shrink:0;margin-left:4px;">

                    {{-- Mark Delivered — visible to entry owner, only if not yet delivered/approved --}}
                    @if(!$entry->delivery_status && !$entry->approved)
                    <form method="POST" action="{{ route('fbads.incentives.deliver', $entry->id) }}">
                        @csrf
                        <button type="submit" title="Mark as Delivered"
                            style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
                            <i class="fas fa-truck"></i>
                        </button>
                    </form>
                    @endif

                    {{-- Master-only: edit & delete --}}
                    @if(auth()->user()->isMaster())
                    <a href="{{ route('fbads.incentives.edit', $entry->id) }}"
                        style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:7px;padding:6px 9px;font-size:11px;text-decoration:none;display:flex;align-items:center;">
                        <i class="fas fa-pen"></i>
                    </a>
                    <form method="POST" action="{{ route('fbads.incentives.destroy', $entry->id) }}" onsubmit="return confirm('Delete this entry?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                    @endif

                </div>
            </div>
            @empty
            <div style="text-align:center;padding:64px 24px;color:#94a3b8;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
                <i class="fas fa-inbox" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0;"></i>
                <div style="font-size:15px;font-weight:600;color:#cbd5e1;">No entries yet</div>
                <div style="font-size:13px;margin-top:6px;">
                    <a href="{{ route('fbads.incentives.create') }}" style="color:#6366f1;text-decoration:none;font-weight:600;">Create the first one</a>
                </div>
            </div>
            @endforelse


        </div>

    </div>
</div>

@endsection
