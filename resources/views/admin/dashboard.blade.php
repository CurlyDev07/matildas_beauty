@extends('admin.layouts.app')

@section('css')
<style>
/* ── CEO Dashboard ─────────────────────────────────────── */
.dash-card {
    background: #fff;
    border-radius: 14px;
    padding: 20px 24px;
    box-shadow: 0 1px 4px rgba(0,0,0,.07);
    margin-bottom: 16px;
}
.kpi-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 14px;
    margin-bottom: 16px;
}
.sec-grid-4 {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 14px;
    margin-bottom: 16px;
}
.chart-grid-2-1 {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 14px;
}
.chart-grid-3 {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    gap: 14px;
}
.chart-grid-2-1b {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 14px;
}

/* KPI card */
.kpi-card {
    background: #fff;
    border-radius: 14px;
    padding: 18px 20px;
    box-shadow: 0 1px 4px rgba(0,0,0,.07);
    border-top: 4px solid #e2e8f0;
    position: relative;
    overflow: hidden;
}
.kpi-label  { font-size: 11px; font-weight: 700; color: #94a3b8; text-transform: uppercase; letter-spacing: .6px; margin-bottom: 6px; }
.kpi-value  { font-size: 26px; font-weight: 800; color: #0f172a; line-height: 1; margin-bottom: 8px; }
.kpi-change { font-size: 12px; font-weight: 700; display: flex; align-items: center; gap: 4px; }
.kpi-change.up   { color: #16a34a; }
.kpi-change.down { color: #dc2626; }
.kpi-sub    { font-size: 11px; color: #94a3b8; margin-top: 4px; }
.kpi-icon {
    position: absolute; right: 16px; top: 16px;
    width: 38px; height: 38px; border-radius: 10px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px;
}

/* Section title */
.dash-title {
    font-size: 13px; font-weight: 700; color: #0f172a;
    margin-bottom: 14px;
    display: flex; align-items: center; gap: 7px;
}
.dash-title small { font-size: 11px; font-weight: 500; color: #94a3b8; }
.dash-title .ml-auto { margin-left: auto; }

/* Table */
.dash-table { width: 100%; border-collapse: collapse; font-size: 13px; }
.dash-table th {
    text-align: left; padding: 8px 12px;
    font-size: 10px; font-weight: 700; color: #94a3b8;
    text-transform: uppercase; letter-spacing: .5px;
    border-bottom: 2px solid #f1f5f9;
}
.dash-table td { padding: 10px 12px; border-bottom: 1px solid #f8fafc; color: #334155; vertical-align: middle; }
.dash-table tr:last-child td { border-bottom: none; }
.dash-table tbody tr:hover td { background: #fafbfc; }

/* Badges */
.badge { padding: 3px 10px; border-radius: 99px; font-size: 11px; font-weight: 700; white-space: nowrap; }
.badge-delivered  { background: #dcfce7; color: #15803d; }
.badge-processing { background: #fef9c3; color: #854d0e; }
.badge-shipped    { background: #dbeafe; color: #1d4ed8; }
.badge-cancelled  { background: #fee2e2; color: #b91c1c; }
.badge-active     { background: #dcfce7; color: #15803d; }
.badge-paused     { background: #f1f5f9; color: #64748b; }

/* Alerts */
.alert-item {
    display: flex; align-items: center; gap: 10px;
    padding: 10px 12px; border-radius: 10px; margin-bottom: 8px;
}
.alert-critical { background: #fff5f5; border: 1px solid #fca5a5; }
.alert-warning  { background: #fffbeb; border: 1px solid #fde68a; }
.alert-name  { font-size: 13px; font-weight: 700; color: #0f172a; }
.alert-sub   { font-size: 11px; color: #64748b; margin-top: 1px; }
.alert-badge { font-size: 10px; font-weight: 800; padding: 2px 8px; border-radius: 99px; margin-left: auto; }
.alert-critical .alert-badge { background: #fee2e2; color: #b91c1c; }
.alert-warning  .alert-badge { background: #fef9c3; color: #854d0e; }
.filter-pill {
    height: 32px;
    display: inline-flex;
    align-items: center;
    white-space: nowrap;
    border-radius: 99px;
    padding: 0 12px;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
    border: 1px solid #e2e8f0;
    color: #64748b;
    background: #fff;
    cursor: pointer;
}
.filter-pill.active {
    border-color: #7c3aed;
    color: #7c3aed;
    background: #f5f3ff;
}
#customRangeForm {
    width: auto;
}
#customRangePicker {
    position: absolute;
    opacity: 0;
    width: 1px;
    height: 1px;
    pointer-events: none;
}
.filter-icon-btn {
    width: 32px;
    height: 32px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 999px;
    border: 1px solid #e2e8f0;
    color: #64748b;
    background: #fff;
    text-decoration: none;
    cursor: pointer;
    transition: all .15s ease;
}
.filter-icon-btn:hover {
    border-color: #cbd5e1;
    background: #f8fafc;
}
.filter-icon-btn.active {
    border-color: #7c3aed;
    color: #7c3aed;
    background: #f5f3ff;
}
.filter-icon-btn.clear {
    border-color: #fecaca;
    color: #b91c1c;
    background: #fff5f5;
}

.flatpickr-calendar {
    border: none !important;
    border-radius: 14px !important;
    box-shadow: 0 18px 45px rgba(15, 23, 42, 0.16) !important;
    font-family: 'Poppins', 'Segoe UI', sans-serif !important;
    overflow: hidden;
}
.flatpickr-months {
    background: #fdf2f8;
    border-bottom: 1px solid #fbcfe8;
}
.flatpickr-current-month {
    padding-top: 10px;
}
.flatpickr-current-month .flatpickr-monthDropdown-months,
.flatpickr-current-month input.cur-year {
    font-weight: 700;
    color: #be185d;
}
.flatpickr-weekday {
    color: #94a3b8 !important;
    font-weight: 700 !important;
    font-size: 11px !important;
}
.flatpickr-day {
    border-radius: 9px !important;
    font-weight: 600;
    color: #334155;
}
.flatpickr-day:hover {
    background: #fce7f3 !important;
    border-color: #fce7f3 !important;
    color: #be185d !important;
}
.flatpickr-day.selected,
.flatpickr-day.startRange,
.flatpickr-day.endRange {
    background: #ec4899 !important;
    border-color: #ec4899 !important;
    color: #fff !important;
}
.flatpickr-day.inRange {
    background: #fce7f3 !important;
    border-color: #fce7f3 !important;
    box-shadow: none !important;
    color: #be185d !important;
}

@media (max-width: 1200px) {
    .kpi-grid       { grid-template-columns: repeat(2, 1fr); }
    .sec-grid-4     { grid-template-columns: repeat(2, 1fr); }
    .chart-grid-2-1,
    .chart-grid-2-1b,
    .chart-grid-3   { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')
@php
$recentOrders = [
    ['id' => '#ORD-4821', 'customer' => 'Maria Santos',     'product' => 'V7 Serum × 2',          'total' => '₱1,650', 'status' => 'delivered',  'date' => 'Mar 5'],
    ['id' => '#ORD-4820', 'customer' => 'Ana Reyes',        'product' => 'Melasma Kit',             'total' => '₱2,100', 'status' => 'shipped',    'date' => 'Mar 5'],
    ['id' => '#ORD-4819', 'customer' => 'Jennifer Cruz',    'product' => 'Brightening Toner × 3',  'total' => '₱1,290', 'status' => 'processing', 'date' => 'Mar 4'],
    ['id' => '#ORD-4818', 'customer' => 'Rosario Lim',      'product' => 'Night Cream × 2',         'total' => '₱980',   'status' => 'delivered',  'date' => 'Mar 4'],
    ['id' => '#ORD-4817', 'customer' => 'Cynthia Tan',      'product' => 'V7 Serum + Eye Serum',   'total' => '₱1,875', 'status' => 'shipped',    'date' => 'Mar 4'],
    ['id' => '#ORD-4816', 'customer' => 'Marisol Aquino',   'product' => 'Starter Kit',             'total' => '₱3,500', 'status' => 'processing', 'date' => 'Mar 3'],
    ['id' => '#ORD-4815', 'customer' => 'Luisa Villanueva', 'product' => 'Melasma Kit × 2',         'total' => '₱4,200', 'status' => 'delivered',  'date' => 'Mar 3'],
    ['id' => '#ORD-4814', 'customer' => 'Elena Mendoza',    'product' => 'V7 Serum',                'total' => '₱825',   'status' => 'cancelled',  'date' => 'Mar 2'],
];

$campaigns = [
    ['name' => 'V7 Serum — Remarketing',  'spend' => '₱12,400', 'reach' => '84,200', 'clicks' => '3,240', 'ctr' => '3.85%', 'cpc' => '₱3.83', 'revenue' => '₱189,500', 'roas' => '15.3×', 'status' => 'active'],
    ['name' => 'Melasma Kit — Cold',       'spend' => '₱9,800',  'reach' => '62,100', 'clicks' => '1,890', 'ctr' => '3.04%', 'cpc' => '₱5.19', 'revenue' => '₱112,300', 'roas' => '11.5×', 'status' => 'active'],
    ['name' => 'Brightening — Lookalike',  'spend' => '₱7,300',  'reach' => '48,500', 'clicks' => '1,420', 'ctr' => '2.93%', 'cpc' => '₱5.14', 'revenue' => '₱78,400',  'roas' => '10.7×', 'status' => 'active'],
    ['name' => 'Night Cream — Engagement', 'spend' => '₱5,200',  'reach' => '31,700', 'clicks' => '980',   'ctr' => '3.09%', 'cpc' => '₱5.31', 'revenue' => '₱54,600',  'roas' => '10.5×', 'status' => 'paused'],
    ['name' => 'Bundle Deal — Conversion', 'spend' => '₱3,800',  'reach' => '22,900', 'clicks' => '720',   'ctr' => '3.14%', 'cpc' => '₱5.28', 'revenue' => '₱50,400',  'roas' => '13.3×', 'status' => 'active'],
];

$lowStock = [
    ['name' => 'Niacinamide 10%',   'type' => 'chemical',  'qty' => '120 g',   'level' => 'critical'],
    ['name' => 'Hyaluronic Acid',   'type' => 'chemical',  'qty' => '85 g',    'level' => 'critical'],
    ['name' => 'Amber Glass 30ml',  'type' => 'packaging', 'qty' => '48 pcs',  'level' => 'warning'],
    ['name' => 'White Box Small',   'type' => 'packaging', 'qty' => '120 pcs', 'level' => 'warning'],
    ['name' => 'Retinol 0.5%',     'type' => 'chemical',  'qty' => '200 g',   'level' => 'warning'],
];
@endphp

{{-- ══ PAGE HEADER ══════════════════════════════════════════ --}}
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:10px;">
    <div>
        <h1 style="font-size:22px;font-weight:800;color:#0f172a;margin:0;line-height:1.2;">
            <i class="fas fa-chart-line" style="color:#7c3aed;margin-right:8px;font-size:18px;"></i>CEO Dashboard
        </h1>
        <p style="font-size:13px;color:#94a3b8;margin:5px 0 0;">
            Overview for <strong style="color:#475569;">{{ $dateSummary }}</strong>
        </p>
    </div>
    <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;justify-content:flex-end;">
        @php
            $quickFilters = [
                'yesterday' => 'Yesterday',
                '7_days' => '7 Days',
                '14_days' => '14 Days',
                '30_days' => '30 Days',
                'this_month' => 'This Month',
                'last_month' => 'Last Month',
            ];
        @endphp
        @foreach($quickFilters as $key => $label)
            <a href="{{ url('/admin/dashboard') }}?quick_range={{ $key }}"
               class="filter-pill {{ $quickRange === $key ? 'active' : '' }}">
                {{ $label }}
            </a>
        @endforeach

        <form id="customRangeForm" method="GET" action="{{ url('/admin/dashboard') }}" style="display:inline-flex;align-items:center;">
            <input type="hidden" name="quick_range" value="custom">
            <input type="hidden" name="start_date" id="startDateInput" value="{{ $filterStartDate }}">
            <input type="hidden" name="end_date" id="endDateInput" value="{{ $filterEndDate }}">
            <input
                type="text"
                id="customRangePicker"
                class="{{ $quickRange === 'custom' ? 'active' : '' }}"
                value=""
                readonly
            >
            <button type="button" id="customRangeTrigger" class="filter-icon-btn {{ $quickRange === 'custom' ? 'active' : '' }}" title="Custom date range" aria-label="Custom date range">
                <i class="fas fa-calendar-alt"></i>
            </button>
        </form>

        <a href="{{ url('/admin/dashboard') }}?quick_range=today" class="filter-icon-btn clear" title="Remove filter" aria-label="Remove filter">
            <i class="fas fa-times"></i>
        </a>
    </div>
</div>

{{-- ══ KPI CARDS ═══════════════════════════════════════════ --}}
<div class="kpi-grid">
    @foreach($kpis as $kpi)
    <div class="kpi-card" style="border-top-color:{{ $kpi['color'] }};">
        <div class="kpi-icon" style="background:{{ $kpi['bg'] }};color:{{ $kpi['color'] }};">
            <i class="fas {{ $kpi['icon'] }}"></i>
        </div>
        <div class="kpi-label">{{ $kpi['label'] }}</div>
        <div class="kpi-value">{{ $kpi['value'] }}</div>
        <div class="kpi-change {{ $kpi['up'] ? 'up' : 'down' }}">
            <i class="fas {{ $kpi['up'] ? 'fa-arrow-up' : 'fa-arrow-down' }}" style="font-size:10px;"></i>
            {{ $kpi['change'] }} {{ $kpi['change_label'] }}
        </div>
        <div class="kpi-sub">{{ $kpi['sub'] }}</div>
    </div>
    @endforeach
</div>

{{-- ══ SECONDARY STAT STRIP ════════════════════════════════ --}}
<div class="sec-grid-4">
    <div class="dash-card" style="padding:14px 18px;margin-bottom:0;display:flex;align-items:center;gap:14px;">
        <div style="width:40px;height:40px;background:#f5f3ff;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-flask" style="color:#7c3aed;font-size:15px;"></i>
        </div>
        <div>
            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Chemicals Stock</div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">{{ currency() }}{{ number_format($chemicalsStockTotal, 2) }}</div>
            <div style="font-size:11px;color:#94a3b8;">{{ number_format($chemicalsBelowOneWeight) }} chemicals below 1 weight</div>
        </div>
    </div>
    <div class="dash-card" style="padding:14px 18px;margin-bottom:0;display:flex;align-items:center;gap:14px;">
        <div style="width:40px;height:40px;background:#f0f9ff;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-box" style="color:#0284c7;font-size:15px;"></i>
        </div>
        <div>
            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Packaging Stock</div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">{{ currency() }}{{ number_format($packagingStockTotal, 2) }}</div>
            <div style="font-size:11px;color:#94a3b8;">{{ number_format($packagingSkuCount) }} total SKUs</div>
        </div>
    </div>
    <div class="dash-card" style="padding:14px 18px;margin-bottom:0;display:flex;align-items:center;gap:14px;">
        <div style="width:40px;height:40px;background:#f0fdf4;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-users" style="color:#16a34a;font-size:15px;"></i>
        </div>
        <div>
            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Total Customers</div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">{{ number_format($totalCustomers) }}</div>
            <div style="font-size:11px;color:{{ $customersMonthDiff >= 0 ? '#16a34a' : '#dc2626' }};">{{ $customersMonthDiff >= 0 ? '+' : '' }}{{ number_format($customersMonthDiff) }} this month</div>
        </div>
    </div>
    <div class="dash-card" style="padding:14px 18px;margin-bottom:0;display:flex;align-items:center;gap:14px;">
        <div style="width:40px;height:40px;background:#fff7ed;border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas fa-sync-alt" style="color:#f97316;font-size:15px;"></i>
        </div>
        <div>
            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Repeat Rate</div>
            <div style="font-size:18px;font-weight:800;color:#0f172a;">{{ number_format($repeatRate, 1) }}%</div>
            <div style="font-size:11px;color:{{ $repeatRateDiff >= 0 ? '#16a34a' : '#dc2626' }};">
                {{ $repeatRateDiff >= 0 ? '+' : '' }}{{ number_format($repeatRateDiff, 1) }}% {{ $quickRange === 'today' ? 'vs yesterday' : ($quickRange === 'yesterday' ? 'vs previous day' : 'vs previous period') }}
            </div>
            <div style="font-size:11px;color:#94a3b8;">{{ number_format($repeatCustomersCount) }} repeat customers</div>
        </div>
    </div>
</div>

{{-- ══ CHARTS ROW 1: Revenue Trend + Orders Comparison ═════ --}}
<div class="chart-grid-2-1" style="margin-bottom:16px;">
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-title">
            <i class="fas fa-chart-area" style="color:#7c3aed;"></i>
            Revenue &amp; Ad Spend Trend
            <small>— last 6 months</small>
        </div>
        <canvas id="revenueChart" height="85"></canvas>
    </div>
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-title">
            <i class="fas fa-exchange-alt" style="color:#0284c7;"></i>
            Orders by Week
            <small>— this vs last month</small>
        </div>
        <canvas id="ordersChart" height="185"></canvas>
    </div>
</div>

{{-- ══ CHARTS ROW 2: Doughnuts + Top Products ═════════════ --}}
<div class="chart-grid-3" style="margin-bottom:16px;">
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-title">
            <i class="fas fa-chart-pie" style="color:#7c3aed;"></i>
            Revenue Sources
        </div>
        <canvas id="sourcesChart" height="185"></canvas>
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-top:12px;">
            <span style="font-size:11px;background:#f5f3ff;color:#7c3aed;padding:3px 9px;border-radius:99px;font-weight:700;">FB Ads 58%</span>
            <span style="font-size:11px;background:#f0f9ff;color:#0284c7;padding:3px 9px;border-radius:99px;font-weight:700;">Organic 22%</span>
            <span style="font-size:11px;background:#f0fdf4;color:#16a34a;padding:3px 9px;border-radius:99px;font-weight:700;">Resellers 12%</span>
            <span style="font-size:11px;background:#fffbeb;color:#d97706;padding:3px 9px;border-radius:99px;font-weight:700;">Other 8%</span>
        </div>
    </div>
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-title">
            <i class="fas fa-coins" style="color:#f59e0b;"></i>
            Expense Breakdown
        </div>
        <canvas id="expenseChart" height="185"></canvas>
        <div style="display:flex;flex-wrap:wrap;gap:6px;margin-top:12px;">
            <span style="font-size:11px;background:#fffbeb;color:#d97706;padding:3px 9px;border-radius:99px;font-weight:700;">Ads 45%</span>
            <span style="font-size:11px;background:#f0fdf4;color:#16a34a;padding:3px 9px;border-radius:99px;font-weight:700;">Materials 21%</span>
            <span style="font-size:11px;background:#f0f9ff;color:#0284c7;padding:3px 9px;border-radius:99px;font-weight:700;">Packaging 14%</span>
            <span style="font-size:11px;background:#fdf2f8;color:#db2777;padding:3px 9px;border-radius:99px;font-weight:700;">Shipping 11%</span>
            <span style="font-size:11px;background:#f8fafc;color:#64748b;padding:3px 9px;border-radius:99px;font-weight:700;">Ops 9%</span>
        </div>
    </div>
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-title">
            <i class="fas fa-star" style="color:#f59e0b;"></i>
            Top 5 Products by Revenue
        </div>
        <canvas id="topProductsChart" height="215"></canvas>
    </div>
</div>

{{-- ══ ROW 3: Recent Orders + Low Stock ════════════════════ --}}
<div class="chart-grid-2-1b" style="margin-bottom:16px;">

    {{-- Recent Orders --}}
    <div class="dash-card" style="margin-bottom:0;">
        <div class="dash-title">
            <i class="fas fa-shopping-bag" style="color:#0284c7;"></i>
            Recent Orders
            <small>— latest 8 transactions</small>
        </div>
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Order</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $o)
                <tr>
                    <td style="font-weight:700;color:#7c3aed;font-size:12px;">{{ $o['id'] }}</td>
                    <td style="font-weight:600;">{{ $o['customer'] }}</td>
                    <td style="color:#64748b;font-size:12px;">{{ $o['product'] }}</td>
                    <td style="font-weight:700;">{{ $o['total'] }}</td>
                    <td><span class="badge badge-{{ $o['status'] }}">{{ ucfirst($o['status']) }}</span></td>
                    <td style="color:#94a3b8;font-size:12px;">{{ $o['date'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    {{-- Low Stock Alerts --}}
    <div class="dash-card" style="margin-bottom:0;">
        @php $criticalCount = count(array_filter($lowStock, function($i){ return $i['level'] === 'critical'; })); @endphp
        <div class="dash-title">
            <i class="fas fa-exclamation-triangle" style="color:#f59e0b;"></i>
            Low Stock Alerts
            @if($criticalCount > 0)
                <span style="background:#fee2e2;color:#b91c1c;font-size:11px;font-weight:800;padding:2px 9px;border-radius:99px;margin-left:2px;">{{ $criticalCount }} critical</span>
            @endif
        </div>
        @foreach($lowStock as $alert)
        <div class="alert-item alert-{{ $alert['level'] }}">
            <div style="width:32px;height:32px;background:{{ $alert['type'] === 'chemical' ? '#f5f3ff' : '#f0f9ff' }};border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                <i class="fas {{ $alert['type'] === 'chemical' ? 'fa-flask' : 'fa-box' }}" style="font-size:13px;color:{{ $alert['type'] === 'chemical' ? '#7c3aed' : '#0284c7' }};"></i>
            </div>
            <div style="flex:1;min-width:0;">
                <div class="alert-name">{{ $alert['name'] }}</div>
                <div class="alert-sub">{{ ucfirst($alert['type']) }} &middot; {{ $alert['qty'] }} remaining</div>
            </div>
            <span class="alert-badge">{{ ucfirst($alert['level']) }}</span>
        </div>
        @endforeach
        <div style="display:flex;gap:12px;margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9;">
            <a href="/admin/lab/inventory" style="font-size:12px;color:#7c3aed;font-weight:700;text-decoration:none;">
                <i class="fas fa-flask" style="font-size:10px;"></i> Chemicals
            </a>
            <a href="/admin/packaging/inventory" style="font-size:12px;color:#0284c7;font-weight:700;text-decoration:none;">
                <i class="fas fa-box" style="font-size:10px;"></i> Packaging
            </a>
        </div>
    </div>
</div>

{{-- ══ FB ADS CAMPAIGN TABLE ════════════════════════════════ --}}
<div class="dash-card">
    <div class="dash-title">
        <i class="fab fa-facebook" style="color:#1877f2;font-size:15px;"></i>
        FB Ads Campaign Performance
        <small>— March 2026</small>
        <span class="ml-auto" style="background:#1877f2;color:#fff;font-size:11px;font-weight:700;padding:4px 12px;border-radius:99px;">
            Total Spend: ₱38,500
        </span>
    </div>
    <table class="dash-table">
        <thead>
            <tr>
                <th>Campaign</th>
                <th>Status</th>
                <th>Spend</th>
                <th>Reach</th>
                <th>Clicks</th>
                <th>CTR</th>
                <th>CPC</th>
                <th>Revenue</th>
                <th>ROAS</th>
            </tr>
        </thead>
        <tbody>
            @foreach($campaigns as $c)
            <tr>
                <td style="font-weight:600;color:#0f172a;">{{ $c['name'] }}</td>
                <td><span class="badge badge-{{ $c['status'] }}">{{ ucfirst($c['status']) }}</span></td>
                <td style="font-weight:700;">{{ $c['spend'] }}</td>
                <td style="color:#64748b;">{{ $c['reach'] }}</td>
                <td style="color:#64748b;">{{ $c['clicks'] }}</td>
                <td>
                    <span style="font-weight:700;color:{{ floatval($c['ctr']) >= 3 ? '#16a34a' : '#d97706' }};">
                        {{ $c['ctr'] }}
                    </span>
                </td>
                <td style="color:#64748b;">{{ $c['cpc'] }}</td>
                <td style="font-weight:700;color:#16a34a;">{{ $c['revenue'] }}</td>
                <td style="font-weight:800;color:#7c3aed;">{{ $c['roas'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="display:flex;flex-wrap:wrap;gap:20px;margin-top:14px;padding-top:12px;border-top:1px solid #f1f5f9;">
        <div style="font-size:12px;color:#64748b;"><span style="font-weight:700;color:#0f172a;">Blended ROAS:</span> <span style="color:#7c3aed;font-weight:800;">12.6×</span></div>
        <div style="font-size:12px;color:#64748b;"><span style="font-weight:700;color:#0f172a;">Total Revenue from Ads:</span> ₱485,200</div>
        <div style="font-size:12px;color:#64748b;"><span style="font-weight:700;color:#0f172a;">Total Reach:</span> 249,400</div>
        <div style="font-size:12px;color:#64748b;"><span style="font-weight:700;color:#0f172a;">Total Clicks:</span> 8,250</div>
        <div style="font-size:12px;color:#64748b;"><span style="font-weight:700;color:#0f172a;">Avg CTR:</span> <span style="color:#16a34a;font-weight:700;">3.31%</span></div>
    </div>
</div>

@endsection

@section('js')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
function formatRangeLabel(start, end) {
    return flatpickr.formatDate(start, 'M d') + ' to ' + flatpickr.formatDate(end, 'M d');
}

var customPicker = flatpickr('#customRangePicker', {
    mode: 'range',
    dateFormat: 'Y-m-d',
    defaultDate: ['{{ $filterStartDate }}', '{{ $filterEndDate }}'],
    disableMobile: true,
    onReady: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            instance.input.value = formatRangeLabel(selectedDates[0], selectedDates[1]);
        }
    },
    onChange: function(selectedDates, dateStr, instance) {
        if (selectedDates.length === 2) {
            instance.input.value = formatRangeLabel(selectedDates[0], selectedDates[1]);
        }
    },
    onClose: function(selectedDates) {
        if (selectedDates.length === 2) {
            document.getElementById('startDateInput').value = flatpickr.formatDate(selectedDates[0], 'Y-m-d');
            document.getElementById('endDateInput').value = flatpickr.formatDate(selectedDates[1], 'Y-m-d');
            document.getElementById('customRangeForm').submit();
        }
    }
});

document.getElementById('customRangeTrigger').addEventListener('click', function () {
    customPicker.open();
});

if (customPicker.selectedDates.length === 2) {
    customPicker.input.value = formatRangeLabel(customPicker.selectedDates[0], customPicker.selectedDates[1]);
}

Chart.defaults.font.family = "'Helvetica Neue', 'Inter', Arial, sans-serif";
Chart.defaults.plugins.legend.display = false;

/* ── 1. Revenue & Ad Spend Line ──────────────────────────── */
(function () {
    var ctx = document.getElementById('revenueChart').getContext('2d');

    var gradRev = ctx.createLinearGradient(0, 0, 0, 220);
    gradRev.addColorStop(0, 'rgba(124,58,237,0.15)');
    gradRev.addColorStop(1, 'rgba(124,58,237,0)');

    var gradAds = ctx.createLinearGradient(0, 0, 0, 220);
    gradAds.addColorStop(0, 'rgba(245,158,11,0.15)');
    gradAds.addColorStop(1, 'rgba(245,158,11,0)');

    new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Oct 2025', 'Nov 2025', 'Dec 2025', 'Jan 2026', 'Feb 2026', 'Mar 2026'],
            datasets: [
                {
                    label: 'Revenue',
                    data: [320000, 380000, 445000, 410000, 431500, 485200],
                    borderColor: '#7c3aed',
                    backgroundColor: gradRev,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#7c3aed',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4,
                },
                {
                    label: 'Ad Spend',
                    data: [22000, 28000, 35000, 29000, 36600, 38500],
                    borderColor: '#f59e0b',
                    backgroundColor: gradAds,
                    borderWidth: 2.5,
                    pointBackgroundColor: '#f59e0b',
                    pointRadius: 4,
                    pointHoverRadius: 6,
                    fill: true,
                    tension: 0.4,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    align: 'end',
                    labels: {
                        boxWidth: 10, boxHeight: 10, borderRadius: 3,
                        useBorderRadius: true,
                        font: { size: 11, weight: '700' },
                        color: '#475569'
                    }
                },
                tooltip: {
                    callbacks: {
                        label: function (ctx) {
                            return ' ' + ctx.dataset.label + ': ₱' + ctx.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                y: {
                    grid: { color: '#f1f5f9' },
                    ticks: {
                        font: { size: 11 }, color: '#94a3b8',
                        callback: function (v) {
                            return v >= 1000 ? '₱' + (v / 1000).toFixed(0) + 'k' : '₱' + v;
                        }
                    }
                }
            }
        }
    });
}());

/* ── 2. Orders Comparison Bar ────────────────────────────── */
(function () {
    var ctx = document.getElementById('ordersChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Week 1', 'Week 2', 'Week 3', 'Week 4'],
            datasets: [
                {
                    label: 'This Month',
                    data: [280, 342, 318, 307],
                    backgroundColor: '#7c3aed',
                    borderRadius: 6,
                    barPercentage: 0.55,
                },
                {
                    label: 'Last Month',
                    data: [245, 298, 305, 299],
                    backgroundColor: '#e2e8f0',
                    borderRadius: 6,
                    barPercentage: 0.55,
                }
            ]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    align: 'end',
                    labels: {
                        boxWidth: 10, boxHeight: 10, borderRadius: 3,
                        useBorderRadius: true,
                        font: { size: 11, weight: '700' },
                        color: '#475569'
                    }
                }
            },
            scales: {
                x: { grid: { display: false }, ticks: { font: { size: 11 }, color: '#94a3b8' } },
                y: { grid: { color: '#f1f5f9' }, ticks: { font: { size: 11 }, color: '#94a3b8' } }
            }
        }
    });
}());

/* ── 3. Revenue Sources Doughnut ─────────────────────────── */
(function () {
    var ctx = document.getElementById('sourcesChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['FB Ads', 'Organic', 'Resellers', 'Other'],
            datasets: [{
                data: [58, 22, 12, 8],
                backgroundColor: ['#7c3aed', '#0284c7', '#16a34a', '#f59e0b'],
                borderWidth: 0,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            cutout: '68%',
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (ctx) { return ' ' + ctx.label + ': ' + ctx.parsed + '%'; }
                    }
                }
            }
        }
    });
}());

/* ── 4. Expense Breakdown Doughnut ───────────────────────── */
(function () {
    var ctx = document.getElementById('expenseChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['FB Ads', 'Raw Materials', 'Packaging', 'Shipping', 'Operations'],
            datasets: [{
                data: [38500, 18000, 12000, 9500, 8000],
                backgroundColor: ['#f59e0b', '#10b981', '#0284c7', '#db2777', '#94a3b8'],
                borderWidth: 0,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            cutout: '68%',
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (ctx) { return ' ' + ctx.label + ': ₱' + ctx.parsed.toLocaleString(); }
                    }
                }
            }
        }
    });
}());

/* ── 5. Top Products Horizontal Bar ──────────────────────── */
(function () {
    var ctx = document.getElementById('topProductsChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['V7 Serum', 'Melasma Kit', 'Bright. Toner', 'Night Cream', 'Eye Serum'],
            datasets: [{
                data: [182500, 145200, 89400, 72100, 58300],
                backgroundColor: ['#7c3aed', '#0284c7', '#10b981', '#f59e0b', '#db2777'],
                borderRadius: 6,
                barPercentage: 0.6,
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            plugins: {
                tooltip: {
                    callbacks: {
                        label: function (ctx) { return ' ₱' + ctx.parsed.x.toLocaleString(); }
                    }
                }
            },
            scales: {
                x: {
                    grid: { color: '#f1f5f9' },
                    ticks: {
                        font: { size: 10 }, color: '#94a3b8',
                        callback: function (v) { return '₱' + (v / 1000).toFixed(0) + 'k'; }
                    }
                },
                y: {
                    grid: { display: false },
                    ticks: { font: { size: 11 }, color: '#475569' }
                }
            }
        }
    });
}());
</script>
@endsection
