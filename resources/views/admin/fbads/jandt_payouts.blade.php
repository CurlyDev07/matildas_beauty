@extends('admin.layouts.app')

@section('css')
<style>
.jt-wrap {
    background: #be0000;
    border-radius: 16px;
    border: 1px solid #d11b1b;
    color: #fff;
    padding: 20px;
}
.jt-grid {
    display: grid;
    grid-template-columns: 1.2fr .8fr;
    gap: 20px;
}
.jt-card {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 14px;
    padding: 18px;
}
.jt-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px;
    border-radius: 10px;
    border: 1px solid rgba(255, 255, 255, 0.18);
    background: rgba(255, 255, 255, 0.05);
    margin-bottom: 8px;
}
.jt-upload-btn {
    border: none;
    background: #ffffff;
    color: #be0000;
    font-weight: 800;
    border-radius: 10px;
    padding: 11px 16px;
    cursor: pointer;
}
.jt-upload-btn:hover { background: #ffe4e6; }
.jt-delete-btn {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 8px;
    background: #fee2e2;
    color: #b91c1c;
    cursor: pointer;
}
.jt-delete-btn:hover { background: #fecaca; }
.jt-view-btn {
    width: 30px;
    height: 30px;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    color: #be0000;
    text-decoration: none;
}
.jt-view-btn:hover { background: #ffe4e6; color: #991b1b; }
.jt-form {
    border: 1px dashed rgba(255,255,255,.45);
    border-radius: 12px;
    padding: 16px;
    background: rgba(255,255,255,.04);
}
.jt-field {
    margin-bottom: 14px;
}
.jt-label {
    display: block;
    font-size: 12px;
    font-weight: 700;
    color: #fff;
    margin-bottom: 7px;
}
.jt-input {
    width: 100%;
    height: 42px;
    padding: 9px 12px;
    border-radius: 10px;
    border: 1px solid rgba(255,255,255,.55);
    background: #fff;
    color: #7f1d1d;
    font-size: 13px;
    line-height: 1.2;
}
.jt-input:focus {
    outline: none;
    box-shadow: 0 0 0 3px rgba(255,255,255,.22);
    border-color: #fff;
}
.jt-input::-webkit-calendar-picker-indicator {
    cursor: pointer;
}
.jt-analytics {
    background: rgba(255, 255, 255, 0.08);
    border: 1px solid rgba(255,255,255,.2);
    border-radius: 14px;
    padding: 16px;
    margin-bottom: 18px;
}
.jt-kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
    margin-bottom: 12px;
}
.jt-kpi {
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 10px;
    padding: 10px;
    background: rgba(255,255,255,.05);
}
.jt-kpi-label { font-size: 11px; color: #fecdd3; }
.jt-kpi-val { font-size: 17px; font-weight: 800; color: #fff; }
.jt-progress-track {
    width: 100%;
    height: 10px;
    border-radius: 999px;
    background: rgba(255,255,255,.24);
    overflow: hidden;
    margin: 6px 0 2px;
}
.jt-progress-fill {
    height: 100%;
    background: #fff;
}
.jt-month-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}
.jt-month-table th, .jt-month-table td {
    padding: 8px 6px;
    border-bottom: 1px solid rgba(255,255,255,.2);
    text-align: right;
    color: #fff;
}
.jt-month-table th:first-child, .jt-month-table td:first-child { text-align: left; }
.jt-target-form {
    display:flex;
    align-items:center;
    gap:8px;
}
.jt-target-input {
    width: 180px;
    height: 34px;
    border: 1px solid rgba(255,255,255,.45);
    border-radius: 9px;
    padding: 6px 10px;
    color: #fff;
    background: rgba(255,255,255,.14);
    font-size: 12px;
    font-weight: 700;
    text-align: right;
}
.jt-target-btn {
    border: none;
    height: 34px;
    border-radius: 9px;
    padding: 0 12px;
    background: #fff;
    color: #be0000;
    font-size: 12px;
    font-weight: 800;
    cursor: pointer;
}
.jt-chart-card {
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 10px;
    background: rgba(255,255,255,.05);
    padding: 10px;
}
.jt-analytics-half {
    margin-top: 10px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.jt-breakdown {
    border: 1px solid rgba(255,255,255,.22);
    border-radius: 10px;
    background: rgba(255,255,255,.05);
    padding: 10px;
}
.jt-breakdown table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}
.jt-breakdown th, .jt-breakdown td {
    padding: 8px 6px;
    border-bottom: 1px solid rgba(255,255,255,.16);
    color: #fff;
}
.jt-breakdown th { color: #fecdd3; font-weight: 700; text-align: left; }
.jt-breakdown td:nth-child(2),
.jt-breakdown td:nth-child(3),
.jt-breakdown td:nth-child(4),
.jt-breakdown th:nth-child(2),
.jt-breakdown th:nth-child(3),
.jt-breakdown th:nth-child(4) { text-align: right; }
@media (max-width: 1100px) {
    .jt-kpi-grid { grid-template-columns: 1fr 1fr; }
    .jt-grid { grid-template-columns: 1fr; }
    .jt-analytics-half { grid-template-columns: 1fr; }
}
</style>
@endsection

@section('content')
<div class="jt-wrap">
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <h1 style="margin:0;font-size:22px;font-weight:800;color:#fff;">
            <i class="fas fa-truck" style="margin-right:8px;"></i>J&amp;T Payouts
        </h1>
    </div>

    @if(session('success'))
        <div style="background:#ecfdf3;color:#065f46;border:1px solid #6ee7b7;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background:#fff1f2;color:#9f1239;border:1px solid #fecdd3;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
            {{ session('error') }}
        </div>
    @endif
    @if($errors->any())
        <div style="background:#fff1f2;color:#9f1239;border:1px solid #fecdd3;padding:10px 12px;border-radius:10px;margin-bottom:12px;">
            @foreach($errors->all() as $error)
                <div style="font-size:12px;line-height:1.5;">{{ $error }}</div>
            @endforeach
        </div>
    @endif

    <div class="jt-analytics">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;margin-bottom:8px;">
            <h2 style="margin:0;font-size:14px;font-weight:800;color:#fff;">6-Month Progress</h2>
            <form class="jt-target-form" method="GET" action="{{ route('fbads.jandt_payouts') }}">
                <label for="target_amount" style="font-size:12px;color:#fff;font-weight:700;">Target</label>
                <input id="target_amount" class="browser-default ttext-center jt-target-input" style="text-align: center;" type="text" name="target_amount" value="{{ number_format((int) round($targetAmount)) }}">
                <button class="jt-target-btn" type="submit">Update</button>
            </form>
        </div>
        <div class="jt-progress-track">
            <div class="jt-progress-fill" style="width: {{ min(100, max(0, $progressPct)) }}%;"></div>
        </div>
        <div style="font-size:12px;color:#ffe4e6;margin-bottom:10px;">
            {{ number_format($progressPct, 2) }}% achieved
        </div>

        <div class="jt-kpi-grid">
            <div class="jt-kpi">
                <div class="jt-kpi-label">Actual (Net)</div>
                <div class="jt-kpi-val">₱{{ number_format($actualAmount, 0) }}</div>
            </div>
            <div class="jt-kpi">
                <div class="jt-kpi-label">Remaining</div>
                <div class="jt-kpi-val">₱{{ number_format($remainingAmount, 0) }}</div>
            </div>
            <div class="jt-kpi">
                <div class="jt-kpi-label">Best Month</div>
                <div class="jt-kpi-val" style="font-size:14px;">{{ $bestMonth['label'] }}<br>₱{{ number_format($bestMonth['net_total'], 0) }}</div>
            </div>
            <div class="jt-kpi">
                <div class="jt-kpi-label">Worst Month</div>
                <div class="jt-kpi-val" style="font-size:14px;">{{ $worstMonth['label'] }}<br>₱{{ number_format($worstMonth['net_total'], 0) }}</div>
            </div>
        </div>

        <div class="jt-analytics-half">
            <div class="jt-chart-card">
                <canvas id="jtMonthChart" height="120"></canvas>
            </div>

            <div class="jt-breakdown">
                <div style="font-size:12px;font-weight:800;color:#fff;margin-bottom:6px;">Breakdown Per Month</div>
                <table>
                    <thead>
                        <tr>
                            <th>Month</th>
                            <th>COD Total Amount</th>
                            <th>Total Deductions</th>
                            <th>Net (After Deduction)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($monthly as $m)
                            <tr>
                                <td>{{ $m['month_short'] }}</td>
                                <td>₱{{ number_format((float)$m['cod_total'], 2) }}</td>
                                <td>₱{{ number_format((float)$m['total_deduction'], 2) }}</td>
                                <td style="color: #fde68a; font-style: italic; font-weight: 600;">₱{{ number_format((float)$m['net_total'], 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="jt-grid">
        <div class="jt-card">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:12px;">
                <h2 style="margin:0;font-size:14px;font-weight:800;color:#fff;">Upload History</h2>
                <span style="font-size:11px;opacity:.85;">{{ $uploads->total() }} files</span>
            </div>

            @forelse($uploads as $upload)
                <div class="jt-item">
                    <div style="width:34px;height:34px;border-radius:9px;background:#fff;color:#be0000;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-file-excel"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:12px;font-weight:700;color:#fff;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $upload->original_file_name }}
                        </div>
                        <div style="font-size:11px;color:#ffe4e6;">
                            Uploaded: {{ date_f($upload->created_at, 'M d, Y h:i A') }}
                        </div>
                        <div style="font-size:11px;color:#ffe4e6;">
                            Payout Date: {{ $upload->payout_date ? date_f($upload->payout_date, 'M d, Y') : '—' }}
                        </div>
                    </div>
                    <div style="font-size:11px;font-weight:700;color:#fff;">
                        {{ number_format($upload->rows_imported) }} rows
                    </div>
                    <a href="{{ route('fbads.jandt_payouts_show', $upload->id) }}" class="jt-view-btn" title="View">
                        <i class="fas fa-eye"></i>
                    </a>
                    <form action="{{ route('fbads.jandt_payouts_destroy', $upload->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this upload entry and imported payouts?')" class="jt-delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div style="font-size:12px;color:#ffe4e6;padding:14px;border:1px dashed rgba(255,255,255,.45);border-radius:10px;text-align:center;">
                    No uploaded files yet.
                </div>
            @endforelse

            <div style="margin-top:12px;">
                {{ $uploads->links() }}
            </div>
        </div>

        <div class="jt-card">
            <h2 style="margin:0 0 10px;font-size:14px;font-weight:800;color:#fff;">Upload Excel</h2>
            <p style="margin:0 0 12px;font-size:12px;color:#ffe4e6;">
                Upload your J&amp;T payout file (example: <strong>J&amp;T Payouts.xlsx</strong>)
            </p>

            <form action="{{ route('fbads.jandt_payouts_upload') }}" method="POST" enctype="multipart/form-data" class="jt-form">
                @csrf
                <div class="jt-field">
                    <label for="payout_date" class="jt-label">Payout Date</label>
                    <input type="date" name="payout_date" id="payout_date" value="{{ old('payout_date', date('Y-m-d')) }}" required class="browser-default js-payout-date jt-input" style="cursor:pointer;">
                    @error('payout_date')
                        <div style="font-size:12px;color:#fecaca;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <div class="jt-field">
                    <label for="excel_file" class="jt-label">Excel File</label>
                    <input type="file" id="excel_file" name="excel_file" accept=".xlsx,.xls" required class="browser-default jt-input" style="padding:8px;">
                    @error('excel_file')
                        <div style="font-size:12px;color:#fecaca;margin-top:6px;">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="jt-upload-btn">
                    Upload File
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var dateInput = document.querySelector('.js-payout-date');
    if (!dateInput) return;

    var openPicker = function () {
        if (typeof this.showPicker === 'function') {
            this.showPicker();
        }
    };

    dateInput.addEventListener('click', openPicker);
    dateInput.addEventListener('focus', openPicker);

    var targetForm = document.querySelector('.jt-target-form');
    var targetInput = document.getElementById('target_amount');
    if (targetForm && targetInput) {
        targetForm.addEventListener('submit', function () {
            targetInput.value = String(targetInput.value || '').replace(/,/g, '').trim();
        });
    }

    var monthLabels = @json(array_column($monthly, 'label'));
    var codSeries = @json(array_map(function($m){ return round((float)$m['cod_total'], 2); }, $monthly));
    var netSeries = @json(array_map(function($m){ return round((float)$m['net_total'], 2); }, $monthly));
    var deductionRateSeries = @json(array_map(function($m){ return round((float)$m['deduction_rate'], 2); }, $monthly));

    var chartEl = document.getElementById('jtMonthChart');
    if (chartEl && window.Chart) {
        new Chart(chartEl, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [
                    {
                        label: 'COD Total',
                        data: codSeries,
                        backgroundColor: 'rgba(255,255,255,0.35)',
                        borderColor: 'rgba(255,255,255,0.75)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Net (After Deduction)',
                        data: netSeries,
                        backgroundColor: 'rgba(255,255,255,0.85)',
                        borderColor: 'rgba(255,255,255,1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        type: 'line',
                        label: 'Deduction Rate %',
                        data: deductionRateSeries,
                        borderColor: '#fde68a',
                        backgroundColor: '#fde68a',
                        borderWidth: 2,
                        tension: 0.35,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { labels: { color: '#fff' } }
                },
                scales: {
                    x: { ticks: { color: '#ffe4e6' }, grid: { color: 'rgba(255,255,255,.12)' } },
                    y: {
                        ticks: { color: '#ffe4e6' },
                        grid: { color: 'rgba(255,255,255,.12)' }
                    },
                    y1: {
                        position: 'right',
                        ticks: {
                            color: '#fde68a',
                            callback: function(value) { return value + '%'; }
                        },
                        grid: { drawOnChartArea: false }
                    }
                }
            }
        });
    }
});
</script>
@endsection
