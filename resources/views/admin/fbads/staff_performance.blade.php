@extends('admin.fbads.layouts')

@section('page')

@php
$statusColors = [
    'TO ENCODE'  => ['bg' => '#f0f9ff', 'border' => '#bae6fd', 'text' => '#0284c7', 'label' => 'Encoded'],
    'TO CALL'    => ['bg' => '#fffbeb', 'border' => '#fde68a', 'text' => '#d97706', 'label' => 'To Call'],
    'TO SHIP'    => ['bg' => '#f5f3ff', 'border' => '#ddd6fe', 'text' => '#7c3aed', 'label' => 'To Ship'],
    'SHIPPED'    => ['bg' => '#eff6ff', 'border' => '#bfdbfe', 'text' => '#1d4ed8', 'label' => 'Shipped'],
    'DUPPLICATE' => ['bg' => '#fff1f2', 'border' => '#fecdd3', 'text' => '#be123c', 'label' => 'Duplicate'],
    'DELIVERED'  => ['bg' => '#f0fdf4', 'border' => '#bbf7d0', 'text' => '#15803d', 'label' => 'Delivered'],
];

$periods = [
    'today'     => 'Today',
    'yesterday' => 'Yesterday',
    '7days'     => '7 Days',
    '14days'    => '14 Days',
    '30days'    => '30 Days',
    'thismonth' => 'This Month',
    'lastmonth' => 'Last Month',
];

// Grand totals per status
$grandTotals = array_fill_keys($statuses, 0);
$grandTotal  = 0;
foreach ($staffData as $staff) {
    foreach ($statuses as $s) {
        $grandTotals[$s] += $staff['counts'][$s];
    }
    $grandTotal += $staff['total'];
}
@endphp

<style>
.sp-card  { background:#fff; border-radius:14px; padding:20px 24px; box-shadow:0 1px 4px rgba(0,0,0,.07); margin-bottom:16px; }
.sp-table { width:100%; border-collapse:collapse; font-size:13px; }
.sp-table th {
    padding:10px 14px; text-align:center;
    font-size:10px; font-weight:700; color:#94a3b8;
    text-transform:uppercase; letter-spacing:.5px;
    border-bottom:2px solid #f1f5f9;
    white-space:nowrap;
}
.sp-table th:first-child { text-align:left; }
.sp-table td {
    padding:11px 14px; border-bottom:1px solid #f8fafc;
    text-align:center; color:#334155;
    vertical-align:middle;
}
.sp-table td:first-child { text-align:left; }
.sp-table tbody tr:hover td { background:#fafbfc; }
.sp-table tfoot td { border-top:2px solid #e2e8f0; font-weight:800; background:#f8fafc; }
.sp-count {
    display:inline-block;
    min-width:36px; padding:3px 10px;
    border-radius:8px; font-size:13px; font-weight:700;
}
.sp-count.zero { color:#cbd5e1; font-weight:600; }
.period-btn {
    padding:6px 14px; border-radius:8px; font-size:12px; font-weight:700;
    cursor:pointer; text-decoration:none; display:inline-block;
    border:2px solid transparent; transition:all .12s;
}
.period-btn.active {
    background:#7c3aed; color:#fff; border-color:#7c3aed;
}
.period-btn.inactive {
    background:#f8fafc; color:#64748b; border-color:#e2e8f0;
}
.period-btn.inactive:hover {
    border-color:#c4b5fd; color:#7c3aed;
}
.rank-badge {
    display:inline-flex; align-items:center; justify-content:center;
    width:22px; height:22px; border-radius:50%;
    font-size:11px; font-weight:800; margin-right:8px;
    flex-shrink:0;
}
.rank-1 { background:#fef9c3; color:#854d0e; }
.rank-2 { background:#f1f5f9; color:#475569; }
.rank-3 { background:#fff7ed; color:#c2410c; }
.rank-n { background:#f8fafc; color:#94a3b8; }
</style>

{{-- ══ HEADER ══════════════════════════════════════════════ --}}
<div class="tborder tbg-white tpx-5 tpy-2" style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;flex-wrap:wrap;gap:10px; border-radius:12px;">
    <div>
        <h2 style="font-size:18px;font-weight:800;color:#0f172a;margin:0;">
            <i class="fas fa-users" style="color:#7c3aed;margin-right:7px;"></i>Staff Performance
        </h2>
        <p style="font-size:12px;color:#94a3b8;margin:4px 0 0;">
            Orders grouped by assigned staff &middot; <strong style="color:#475569;">{{ $periodLabel }}</strong>
        </p>
    </div>
    <div style="font-size:12px;color:#64748b;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:8px 14px;">
        <span style="font-weight:700;color:#0f172a;">{{ $grandTotal }}</span> total orders &middot;
        <span style="font-weight:700;color:#7c3aed;">{{ count($staffData) }}</span> staff members
    </div>
</div>

{{-- ══ PERIOD FILTER ═══════════════════════════════════════ --}}
<div class="sp-card" style="padding:14px 18px;margin-bottom:16px;">
    <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
        <span style="font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-right:4px;">Period:</span>
        @foreach($periods as $key => $label)
            <a href="?period={{ $key }}"
               class="period-btn {{ $period === $key ? 'active' : 'inactive' }}">
                {{ $label }}
            </a>
        @endforeach
    </div>
</div>

{{-- ══ STATUS SUMMARY PILLS ════════════════════════════════ --}}
<div style="display:flex;flex-wrap:wrap;gap:10px;margin-bottom:16px;">
    @foreach($statuses as $s)
    @php $sc = $statusColors[$s]; @endphp
    <div style="background:{{ $sc['bg'] }};border:1px solid {{ $sc['border'] }};border-radius:12px;padding:10px 16px;min-width:120px;">
        <div style="font-size:10px;font-weight:700;color:{{ $sc['text'] }};text-transform:uppercase;letter-spacing:.5px;margin-bottom:4px;">
            {{ $sc['label'] }}
        </div>
        <div style="font-size:22px;font-weight:800;color:#0f172a;line-height:1;">
            {{ number_format($grandTotals[$s]) }}
        </div>
        @if($grandTotal > 0)
        <div style="font-size:11px;color:#94a3b8;margin-top:2px;">
            {{ number_format($grandTotals[$s] / $grandTotal * 100, 1) }}%
        </div>
        @endif
    </div>
    @endforeach
</div>

{{-- ══ STAFF TABLE ═════════════════════════════════════════ --}}
<div class="sp-card" style="padding:0;overflow:hidden;">
    @if(empty($staffData))
        <div style="text-align:center;padding:56px;color:#94a3b8;">
            <i class="fas fa-users" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0;"></i>
            No order data found for the selected period.
        </div>
    @else
    <div style="overflow-x:auto;">
        <table class="sp-table">
            <thead>
                <tr>
                    <th style="padding-left:20px;">Staff Member</th>
                    @foreach($statuses as $s)
                    <th style="color:{{ $statusColors[$s]['text'] }};">
                        {{ $statusColors[$s]['label'] }}
                    </th>
                    @endforeach
                    <th style="color:#0f172a;">Total</th>
                    <th>Share</th>
                </tr>
            </thead>
            <tbody>
                @foreach($staffData as $rank => $staff)
                @php
                    $rankN   = $rank + 1;
                    $rankCls = $rankN === 1 ? 'rank-1' : ($rankN === 2 ? 'rank-2' : ($rankN === 3 ? 'rank-3' : 'rank-n'));
                    $share   = $grandTotal > 0 ? round($staff['total'] / $grandTotal * 100, 1) : 0;
                @endphp
                <tr>
                    <td style="padding-left:20px;">
                        <div style="display:flex;align-items:center;">
                            <span class="rank-badge {{ $rankCls }}">
                                @if($rankN === 1)<i class="fas fa-trophy" style="font-size:11px;"></i>
                                @elseif($rankN === 2)<i class="fas fa-medal" style="font-size:11px;"></i>
                                @elseif($rankN === 3)<i class="fas fa-award" style="font-size:11px;"></i>
                                @else{{ $rankN }}@endif
                            </span>
                            <span style="font-weight:700;color:#0f172a;">{{ $staff['name'] }}</span>
                        </div>
                    </td>
                    @foreach($statuses as $s)
                    @php $cnt = $staff['counts'][$s]; $sc = $statusColors[$s]; @endphp
                    <td>
                        @if($cnt > 0)
                            <span class="sp-count" style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">
                                {{ number_format($cnt) }}
                            </span>
                        @else
                            <span class="sp-count zero">—</span>
                        @endif
                    </td>
                    @endforeach
                    <td>
                        <span style="font-weight:800;font-size:14px;color:#0f172a;">{{ number_format($staff['total']) }}</span>
                    </td>
                    <td>
                        <div style="display:flex;align-items:center;gap:6px;min-width:80px;">
                            <div style="flex:1;height:6px;background:#f1f5f9;border-radius:99px;overflow:hidden;">
                                <div style="height:100%;width:{{ $share }}%;background:#7c3aed;border-radius:99px;"></div>
                            </div>
                            <span style="font-size:11px;font-weight:700;color:#64748b;white-space:nowrap;">{{ $share }}%</span>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td style="padding-left:20px;font-weight:800;color:#0f172a;">Grand Total</td>
                    @foreach($statuses as $s)
                    @php $sc = $statusColors[$s]; @endphp
                    <td>
                        <span class="sp-count" style="background:{{ $sc['bg'] }};color:{{ $sc['text'] }};">
                            {{ number_format($grandTotals[$s]) }}
                        </span>
                    </td>
                    @endforeach
                    <td style="font-size:16px;font-weight:800;color:#7c3aed;">{{ number_format($grandTotal) }}</td>
                    <td style="font-size:11px;font-weight:700;color:#94a3b8;">100%</td>
                </tr>
            </tfoot>
        </table>
    </div>
    @endif
</div>


{{-- ══════════════════════════════════════════════════════════════════════ --}}
{{-- INCENTIVES MONITORING BLOCK --}}
{{-- ══════════════════════════════════════════════════════════════════════ --}}

@php
$iTypes = [
    'Upsell'  => ['#fee2e2', '#b91c1c'],
    'InfoTxt' => ['#dbeafe', '#1d4ed8'],
    'Pancake' => ['#fef9c3', '#92400e'],
    'Events'  => ['#dcfce7', '#15803d'],
];

$iPeriods = [
    'today'     => 'Today',
    'yesterday' => 'Yesterday',
    '7days'     => '7 Days',
    '14days'    => '14 Days',
    '30days'    => '30 Days',
    'thismonth' => 'This Month',
    'lastmonth' => 'Last Month',
];

// Totals per user per type
$iTotals = [];
foreach ($incentiveUsers as $uid => $uname) {
    $iTotals[$uid] = array_fill_keys($incentiveTypes, 0);
}
foreach ($incentiveDates as $d) {
    foreach ($incentiveUsers as $uid => $uname) {
        foreach ($incentiveTypes as $t) {
            $cnt = $incentiveData[$d][$uid][$t] ?? 0;
            $iTotals[$uid][$t] += $cnt;
        }
    }
}

// Grand total per user
$iUserTotals = [];
foreach ($incentiveUsers as $uid => $uname) {
    $iUserTotals[$uid] = array_sum($iTotals[$uid]);
}

// Top 3 per type scoreboard
$iScoreboard = [];
foreach ($incentiveTypes as $t) {
    $ranked = [];
    foreach ($incentiveUsers as $uid => $uname) {
        $ranked[] = ['uid' => $uid, 'name' => $uname, 'score' => $iTotals[$uid][$t] ?? 0];
    }
    usort($ranked, fn($a, $b) => $b['score'] - $a['score']);
    $iScoreboard[$t] = array_slice($ranked, 0, 3);
}

// Heatmap: max count per type across all (date, user) cells
$iTypeRgb = [
    'Upsell'  => '185,28,28',
    'InfoTxt' => '29,78,216',
    'Pancake' => '146,64,14',
    'Events'  => '21,128,61',
];
$iHeatmax = array_fill_keys($incentiveTypes, 1);
foreach ($incentiveDates as $d) {
    foreach ($incentiveUsers as $uid => $uname) {
        foreach ($incentiveTypes as $t) {
            $v = $incentiveData[$d][$uid][$t] ?? 0;
            if ($v > $iHeatmax[$t]) $iHeatmax[$t] = $v;
        }
    }
}
@endphp

<style>
.im-wrap   { margin-top:40px; }
.im-card   { background:#fff; border-radius:14px; box-shadow:0 1px 4px rgba(0,0,0,.07); overflow:hidden; margin-top:16px; }
.im-table  { width:100%; border-collapse:collapse; font-size:12px; }
.im-table th {
    padding:8px 6px; text-align:center;
    font-size:10px; font-weight:700; color:#94a3b8;
    text-transform:uppercase; letter-spacing:.4px;
    border-bottom:2px solid #f1f5f9;
    white-space:nowrap;
}
.im-table th.col-date { text-align:left; padding-left:14px; min-width:110px; }
.im-table th.col-user { font-size:11px; font-weight:800; color:#0f172a; text-align:center; }
.im-table td {
    padding:7px 6px; border-bottom:1px solid #f8fafc;
    text-align:center; color:#334155;
}
.im-table td.col-date { text-align:left; padding-left:14px; font-weight:600; color:#475569; font-size:12px; white-space:nowrap; }
.im-table tbody tr:hover td { background:#fafbfc; }
.im-table tfoot td { border-top:2px solid #e2e8f0; font-weight:800; background:#f8fafc; }
.im-table tr.weekend td { background:#fffbeb; }
.im-count { display:inline-block; min-width:26px; padding:2px 7px; border-radius:6px; font-size:12px; font-weight:700; }
.im-count.zero { color:#cbd5e1; font-weight:400; }
.im-period-btn {
    padding:5px 12px; border-radius:8px; font-size:12px; font-weight:700;
    cursor:pointer; text-decoration:none; display:inline-block;
    border:2px solid transparent; transition:all .12s;
}
.im-period-btn.active  { background:#7c3aed; color:#fff; border-color:#7c3aed; }
.im-period-btn.inactive { background:#f8fafc; color:#64748b; border-color:#e2e8f0; }
.im-period-btn.inactive:hover { border-color:#c4b5fd; color:#7c3aed; }
</style>

<div class="im-wrap">
    {{-- Header --}}
    <div class="tborder tbg-white tpx-5 tpy-2" style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px;border-radius:12px;">
        <div>
            <h2 style="font-size:18px;font-weight:800;color:#0f172a;margin:0;">
                <i class="fas fa-star" style="color:#7c3aed;margin-right:7px;"></i>Incentives Monitoring
            </h2>
            <p style="font-size:12px;color:#94a3b8;margin:4px 0 0;">
                Daily activity counts per agent &middot; <strong style="color:#475569;">{{ $iPeriodLabel }}</strong>
            </p>
        </div>
        <div style="font-size:12px;color:#64748b;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:8px 14px;">
            <span style="font-weight:700;color:#7c3aed;">{{ count($incentiveUsers) }}</span> agents &middot;
            <span style="font-weight:700;color:#0f172a;">{{ count($incentiveDates) }}</span> days
        </div>
    </div>

    {{-- Period filter (separate from staff performance, preserves ?period= param) --}}
    <div class="im-card" style="padding:14px 18px;margin-top:12px;">
        <div style="display:flex;flex-wrap:wrap;gap:8px;align-items:center;">
            <span style="font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;margin-right:4px;">Period:</span>
            @foreach($iPeriods as $key => $label)
                <a href="?period={{ $period }}&iperiod={{ $key }}"
                   class="im-period-btn {{ $iperiod === $key ? 'active' : 'inactive' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>
    </div>

    {{-- Scoreboard --}}
    @if(!empty($incentiveUsers))
    <div style="display:grid;grid-template-columns:repeat(4,1fr);gap:12px;margin-top:16px;">
        @foreach($incentiveTypes as $t)
        @php
            [$tbg, $ttxt] = $iTypes[$t];
            $medals = [
                1 => ['#fef9c3','#854d0e','fas fa-trophy','Gold'],
                2 => ['#f1f5f9','#475569','fas fa-medal','Silver'],
                3 => ['#fff7ed','#c2410c','fas fa-award','Bronze'],
            ];
        @endphp
        <div style="background:#fff;border-radius:14px;box-shadow:0 1px 4px rgba(0,0,0,.07);overflow:hidden;">
            <div style="background:{{ $tbg }};border-bottom:2px solid {{ $ttxt }}20;padding:12px 16px;display:flex;align-items:center;gap:8px;">
                <span style="font-size:13px;font-weight:800;color:{{ $ttxt }};">{{ $t }}</span>
            </div>
            <div style="padding:10px 14px;">
                @foreach($iScoreboard[$t] as $rank => $entry)
                @php $r = $rank+1; $m = $medals[$r] ?? [$tbg,$ttxt,'fas fa-circle','']; @endphp
                <div style="display:flex;align-items:center;gap:8px;padding:7px 0;{{ $rank < 2 ? 'border-bottom:1px solid #f1f5f9;' : '' }}">
                    <div style="width:26px;height:26px;border-radius:50%;background:{{ $m[0] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="{{ $m[2] }}" style="font-size:11px;color:{{ $m[1] }};"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:12px;font-weight:700;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $entry['name'] }}</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="font-size:15px;font-weight:800;color:{{ $ttxt }};">
                            {{ $entry['score'] > 0 ? $entry['score'] : '—' }}
                        </div>
                        @php
                            $prevScore = $iPrevTotals[$entry['uid']][$t] ?? 0;
                            $scoreDiff = $entry['score'] - $prevScore;
                        @endphp
                        @if($prevScore > 0 || $entry['score'] > 0)
                            @if($scoreDiff > 0)
                                <div title="{{ $iPrevPeriodLabel }}: {{ $prevScore }}" style="font-size:10px;font-weight:700;color:#16a34a;cursor:default;">
                                    <i class="fas fa-arrow-up" style="font-size:9px;"></i>
                                    +{{ $scoreDiff }}
                                </div>
                            @elseif($scoreDiff < 0)
                                <div title="{{ $iPrevPeriodLabel }}: {{ $prevScore }}" style="font-size:10px;font-weight:700;color:#dc2626;cursor:default;">
                                    <i class="fas fa-arrow-down" style="font-size:9px;"></i>
                                    {{ $scoreDiff }}
                                </div>
                            @else
                                <div title="{{ $iPrevPeriodLabel }}: {{ $prevScore }}" style="font-size:10px;color:#94a3b8;cursor:default;">—</div>
                            @endif
                        @endif
                    </div>
                </div>
                @endforeach
                @if(empty($iScoreboard[$t]))
                    <div style="text-align:center;padding:16px;font-size:12px;color:#cbd5e1;">No data</div>
                @endif
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Table --}}
    <div class="im-card">
        @if(empty($incentiveUsers))
            <div style="text-align:center;padding:56px;color:#94a3b8;">
                <i class="fas fa-star" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0;"></i>
                No incentive entries for the selected period.
            </div>
        @else
        <div style="overflow-x:auto;">
            <table class="im-table">
                <thead>
                    {{-- Row 1: Date + Staff group headers --}}
                    <tr>
                        <th class="col-date" rowspan="2">Date</th>
                        @foreach($incentiveUsers as $uid => $uname)
                            <th class="col-user" colspan="4" style="border-left:2px solid #f1f5f9;">
                                {{ $uname }}
                            </th>
                        @endforeach
                        <th colspan="4" style="border-left:2px solid #f1f5f9;color:#7c3aed;">Total</th>
                    </tr>
                    {{-- Row 2: Sub-column type headers --}}
                    <tr>
                        @foreach($incentiveUsers as $uid => $uname)
                            @foreach($incentiveTypes as $t)
                            @php [$tbg, $ttxt] = $iTypes[$t]; @endphp
                            <th style="color:{{ $ttxt }};{{ $loop->first ? 'border-left:2px solid #f1f5f9;' : '' }}">{{ $t }}</th>
                            @endforeach
                        @endforeach
                        @foreach($incentiveTypes as $t)
                        @php [$tbg, $ttxt] = $iTypes[$t]; @endphp
                        <th style="color:{{ $ttxt }};{{ $loop->first ? 'border-left:2px solid #f1f5f9;' : '' }}">{{ $t }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach($incentiveDates as $d)
                    @php
                        $dayOfWeek = \Carbon\Carbon::parse($d)->dayOfWeek;
                        $isWeekend = in_array($dayOfWeek, [0, 6]);
                        $dayLabel  = \Carbon\Carbon::parse($d)->format('M d, D');
                        // Row totals
                        $rowTypeTotals = array_fill_keys($incentiveTypes, 0);
                        foreach ($incentiveUsers as $uid => $uname) {
                            foreach ($incentiveTypes as $t) {
                                $rowTypeTotals[$t] += $incentiveData[$d][$uid][$t] ?? 0;
                            }
                        }
                    @endphp
                    <tr class="{{ $isWeekend ? 'weekend' : '' }}">
                        <td class="col-date">
                            {{ $dayLabel }}
                            @if($isWeekend)
                                <span style="font-size:10px;color:#d97706;font-weight:700;margin-left:4px;">REST</span>
                            @endif
                        </td>
                        @foreach($incentiveUsers as $uid => $uname)
                            @foreach($incentiveTypes as $t)
                            @php
                                $cnt = $incentiveData[$d][$uid][$t] ?? 0;
                                [$tbg, $ttxt] = $iTypes[$t];
                            @endphp
                            <td style="{{ $loop->first ? 'border-left:2px solid #f1f5f9;' : '' }}">
                                @if($cnt > 0)
                                    <span class="im-count" style="background:{{ $tbg }};color:{{ $ttxt }};">{{ $cnt }}</span>
                                @else
                                    <span class="im-count zero">—</span>
                                @endif
                            </td>
                            @endforeach
                        @endforeach
                        {{-- Row type totals --}}
                        @foreach($incentiveTypes as $t)
                        @php [$tbg, $ttxt] = $iTypes[$t]; @endphp
                        <td style="{{ $loop->first ? 'border-left:2px solid #f1f5f9;' : '' }}">
                            @if($rowTypeTotals[$t] > 0)
                                <span class="im-count" style="background:{{ $tbg }};color:{{ $ttxt }};">{{ $rowTypeTotals[$t] }}</span>
                            @else
                                <span class="im-count zero">—</span>
                            @endif
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td class="col-date" style="font-weight:800;color:#0f172a;">Total</td>
                        @foreach($incentiveUsers as $uid => $uname)
                            @foreach($incentiveTypes as $t)
                            @php [$tbg, $ttxt] = $iTypes[$t]; @endphp
                            <td style="{{ $loop->first ? 'border-left:2px solid #f1f5f9;' : '' }}">
                                <span class="im-count" style="background:{{ $tbg }};color:{{ $ttxt }};">{{ $iTotals[$uid][$t] }}</span>
                            </td>
                            @endforeach
                        @endforeach
                        {{-- Grand total per type --}}
                        @php
                            $grandTypeTotals = array_fill_keys($incentiveTypes, 0);
                            foreach ($incentiveUsers as $uid => $uname) {
                                foreach ($incentiveTypes as $t) {
                                    $grandTypeTotals[$t] += $iTotals[$uid][$t];
                                }
                            }
                        @endphp
                        @foreach($incentiveTypes as $t)
                        @php [$tbg, $ttxt] = $iTypes[$t]; @endphp
                        <td style="{{ $loop->first ? 'border-left:2px solid #f1f5f9;' : '' }}">
                            <span class="im-count" style="background:{{ $tbg }};color:{{ $ttxt }};">{{ $grandTypeTotals[$t] }}</span>
                        </td>
                        @endforeach
                    </tr>
                    {{-- User grand totals row --}}
                    <tr style="background:#f0f4ff;">
                        <td class="col-date" style="font-weight:800;color:#7c3aed;">Grand Total</td>
                        @foreach($incentiveUsers as $uid => $uname)
                            <td colspan="4" style="font-size:16px;font-weight:800;color:#7c3aed;border-left:2px solid #e2e8f0;">
                                {{ $iUserTotals[$uid] }}
                            </td>
                        @endforeach
                        <td colspan="4" style="font-size:16px;font-weight:800;color:#7c3aed;border-left:2px solid #e2e8f0;">
                            {{ array_sum($iUserTotals) }}
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
        @endif
    </div>
</div>

@endsection
