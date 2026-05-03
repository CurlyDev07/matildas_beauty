@extends('admin.layouts.app')

@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<style>
.metrics-wrap {
    background: linear-gradient(180deg, #fff 0%, #f8fafc 100%);
    border: 1px solid #eef2f7;
    border-radius: 16px;
    padding: 14px;
}
.metrics-tabs {
    display: inline-flex;
    gap: 8px;
    margin-bottom: 14px;
}
.metrics-tab {
    height: 34px;
    display: inline-flex;
    align-items: center;
    padding: 0 12px;
    border-radius: 999px;
    border: 1px solid #dbe7f3;
    color: #64748b;
    background: #fff;
    font-size: 12px;
    font-weight: 700;
    text-decoration: none;
}
.metrics-tab.active {
    border-color: #2563eb;
    color: #1d4ed8;
    background: #eff6ff;
}
.metrics-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
    align-items: start;
}
.metrics-card {
    background: #fff;
    border-radius: 14px;
    padding: 16px 18px;
    box-shadow: 0 10px 26px rgba(15, 23, 42, 0.06);
    border: 1px solid #eef2f7;
}
.metrics-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 11px;
    border: 1px solid #eef2f7;
    border-radius: 12px;
    margin-bottom: 8px;
    transition: background .15s ease, border-color .15s ease;
}
.metrics-item:hover {
    background: #f8fafc;
    border-color: #dbeafe;
}
.delete-btn {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 8px;
    background: #fee2e2;
    color: #b91c1c;
    cursor: pointer;
}
.delete-btn:hover { background: #fecaca; }
.save-btn {
    width: 30px;
    height: 30px;
    border: none;
    border-radius: 8px;
    background: #dbeafe;
    color: #1d4ed8;
    cursor: pointer;
}
.save-btn:hover { background: #bfdbfe; }
.reupload-mini {
    margin-top: 6px;
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
}
.reupload-file {
    font-size: 10px;
    max-width: 180px;
}
.reupload-btn {
    height: 28px;
    border: none;
    border-radius: 8px;
    padding: 0 10px;
    background: #e0e7ff;
    color: #3730a3;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
}
.reupload-btn:hover { background: #c7d2fe; }
.upload-box {
    border: 1px dashed #cbd5e1;
    border-radius: 14px;
    padding: 18px;
    background: #f8fafc;
}
.metrics-date-input {
    width: 100%;
    font-size: 12px;
    margin-bottom: 10px;
    padding: 9px 10px;
    border: 1px solid #dbe7f3;
    border-radius: 10px;
    background: #fff;
    color: #0f172a;
    cursor: pointer;
    transition: border-color .15s ease, box-shadow .15s ease;
}
.metrics-date-input:hover { border-color: #93c5fd; }
.metrics-date-input:focus {
    outline: none;
    border-color: #60a5fa;
    box-shadow: 0 0 0 3px rgba(96, 165, 250, 0.16);
}
.metrics-date-input::-webkit-calendar-picker-indicator {
    cursor: pointer;
    opacity: .9;
    filter: hue-rotate(300deg) saturate(1.1);
}
.upload-btn {
    border: none;
    background: #2563eb;
    color: #fff;
    padding: 9px 14px;
    border-radius: 10px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}
.upload-btn:hover { background: #1d4ed8; }
.adspend-box {
    margin-top: 14px;
    border-top: 1px solid #eef2f7;
    padding-top: 12px;
}
.adspend-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 12px;
}
.adspend-table th {
    text-align: left;
    padding: 7px 6px;
    color: #64748b;
    font-size: 11px;
    border-bottom: 1px solid #eef2f7;
}
.adspend-table td {
    padding: 8px 6px;
    border-bottom: 1px solid #f8fafc;
    color: #334155;
}
.adspend-table th:last-child,
.adspend-table td:last-child {
    text-align: right;
    font-weight: 700;
}
.report-controls {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px;
    margin-bottom: 12px;
    background: #f8fafc;
}
.report-columns-grid {
    display: grid;
    grid-template-columns: repeat(2, minmax(0,1fr));
    gap: 8px 14px;
    margin-top: 12px;
    max-height: calc(80vh - 230px);
    overflow: auto;
    padding-right: 4px;
}
.report-col-item {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 11px;
    color: #334155;
    padding: 6px 4px;
    border-radius: 8px;
}
.report-col-item:hover { background: #f8fafc; }
.report-col-item span { font-size: 12px; line-height: 1.25; }
.col-modal-backdrop {
    position: fixed;
    inset: 0;
    background: rgba(15,23,42,.45);
    z-index: 1000;
    display: none;
    align-items: center;
    justify-content: center;
    padding: 18px;
}
.col-modal {
    width: min(1280px, 100%);
    height: 80vh;
    background: #fff;
    border-radius: 14px;
    border: 1px solid #e2e8f0;
    box-shadow: 0 22px 50px rgba(15,23,42,.24);
    display: flex;
    flex-direction: column;
}
.col-modal-head {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    border-bottom: 1px solid #e2e8f0;
}
.col-modal-close {
    border: none;
    width: 30px;
    height: 30px;
    border-radius: 8px;
    background: #f1f5f9;
    color: #334155;
    cursor: pointer;
}
.col-modal-body {
    flex: 1;
    min-height: 0;
    display: grid;
    grid-template-columns: 2.15fr 1fr;
}
.col-modal-left {
    padding: 14px 16px;
    border-right: 1px solid #e2e8f0;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}
.col-modal-right {
    padding: 14px 12px;
    overflow: auto;
    background: #fcfdff;
}
.col-search {
    width: 100%;
    height: 40px;
    border: 1px solid #cbd5e1;
    border-radius: 10px;
    padding: 0 12px;
    font-size: 13px;
    color: #0f172a;
}
.col-tabs {
    margin-top: 10px;
    display: inline-flex;
    gap: 8px;
    flex-wrap: wrap;
}
.col-tab {
    border: 1px solid #dbe7f3;
    background: #fff;
    color: #334155;
    border-radius: 10px;
    padding: 6px 10px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}
.col-tab.active {
    border-color: #93c5fd;
    background: #eff6ff;
    color: #1d4ed8;
}
.selected-list {
    margin-top: 12px;
    border-top: 1px solid #e2e8f0;
}
.selected-item {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 8px;
    padding: 10px 4px;
    border-bottom: 1px solid #f1f5f9;
    font-size: 12px;
    color: #0f172a;
}
.selected-remove {
    border: none;
    background: transparent;
    color: #64748b;
    font-size: 18px;
    line-height: 1;
    cursor: pointer;
}
.col-modal-foot {
    border-top: 1px solid #e2e8f0;
    padding: 12px 16px;
    display: flex;
    justify-content: flex-end;
    gap: 8px;
    background: #fff;
}
.report-btn {
    border: none;
    background: #2563eb;
    color: #fff;
    padding: 8px 12px;
    border-radius: 9px;
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
}
.report-btn.secondary {
    background: #e2e8f0;
    color: #334155;
}
.quick-row {
    display: flex;
    align-items: center;
    gap: 6px;
    flex-wrap: wrap;
    margin-bottom: 8px;
}
.quick-pill {
    height: 28px;
    display: inline-flex;
    align-items: center;
    padding: 0 10px;
    border: 1px solid #dbe7f3;
    border-radius: 999px;
    font-size: 11px;
    font-weight: 700;
    color: #64748b;
    text-decoration: none;
    background: #fff;
}
.quick-pill.active {
    border-color: #2563eb;
    color: #1d4ed8;
    background: #eff6ff;
}
.report-table-wrap {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    overflow: auto;
}
.report-table {
    width: 100%;
    min-width: 1000px;
    border-collapse: collapse;
    font-size: 12px;
}
.report-table th {
    padding: 8px 10px;
    border-bottom: 1px solid #e2e8f0;
    text-align: left;
    color: #64748b;
    font-size: 11px;
    background: #f8fafc;
}
.sort-link {
    color: #64748b;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.sort-link.active {
    color: #1d4ed8;
    font-weight: 800;
}
.sort-chevron {
    font-size: 10px;
    opacity: .65;
}
.report-table td {
    padding: 8px 10px;
    border-bottom: 1px solid #f1f5f9;
    color: #334155;
    white-space: nowrap;
}
.campaign-cell {
    max-width: 240px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.flatpickr-calendar {
    border: 1px solid #e2e8f0 !important;
    border-radius: 12px !important;
    box-shadow: 0 14px 32px rgba(15, 23, 42, 0.14) !important;
}
.flatpickr-months {
    background: #f8fafc !important;
    border-bottom: 1px solid #e2e8f0 !important;
}
.flatpickr-current-month,
.flatpickr-current-month .flatpickr-monthDropdown-months,
.flatpickr-current-month input.cur-year {
    color: #0f172a !important;
    font-weight: 700 !important;
}
.flatpickr-current-month {
    opacity: 1 !important;
    visibility: visible !important;
}
.flatpickr-current-month .flatpickr-monthDropdown-months,
.flatpickr-current-month .cur-month,
.flatpickr-current-month input.cur-year {
    opacity: 1 !important;
    visibility: visible !important;
    -webkit-text-fill-color: #0f172a !important;
}
.flatpickr-prev-month svg,
.flatpickr-next-month svg {
    fill: #334155 !important;
}
.flatpickr-weekday {
    color: #64748b !important;
    font-weight: 700 !important;
}
.report-toolbar {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    flex-wrap: wrap;
}
.report-left-controls {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
.range-input {
    width: 250px;
    height: 34px;
    border: 1px solid #dbe7f3;
    border-radius: 10px;
    padding: 0 10px;
    font-size: 11px;
    color: #334155;
    background: #fff;
    cursor: pointer;
}
.monthly-kpi-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 10px;
    margin-bottom: 12px;
}
.monthly-kpi {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px 12px;
    background: #fff;
}
.monthly-kpi .k-label { font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; letter-spacing: .3px; }
.monthly-kpi .k-val { font-size: 18px; color: #0f172a; font-weight: 800; margin-top: 4px; }
.monthly-kpi .k-sub { font-size: 11px; margin-top: 4px; }
.monthly-kpi .up { color: #16a34a; }
.monthly-kpi .down { color: #dc2626; }
.monthly-chart-wrap {
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 10px;
    background: #fff;
}
.sim-box {
    margin-top: 12px;
    border: 1px solid #e2e8f0;
    border-radius: 12px;
    padding: 12px;
    background: #fff;
}
.sim-grid {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr 1fr;
    gap: 10px;
}
.sim-input {
    height: 34px;
    border: 1px solid #dbe7f3;
    border-radius: 10px;
    padding: 0 10px;
    font-size: 12px;
    color: #334155;
    width: 100%;
}
.sim-kpi {
    border: 1px solid #edf2f7;
    border-radius: 10px;
    padding: 8px 10px;
    background: #f8fafc;
}
.sim-kpi .s-label { font-size: 10px; color: #64748b; font-weight: 700; text-transform: uppercase; }
.sim-kpi .s-val { font-size: 16px; color: #0f172a; font-weight: 800; margin-top: 2px; }
@media (max-width: 1100px) {
    .metrics-grid { grid-template-columns: 1fr; }
    .col-modal {
        width: 100%;
        height: calc(100vh - 24px);
    }
    .col-modal-body { grid-template-columns: 1fr; }
    .col-modal-left { border-right: none; border-bottom: 1px solid #e2e8f0; }
    .report-columns-grid { grid-template-columns: 1fr; max-height: 38vh; }
    .monthly-kpi-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    .sim-grid { grid-template-columns: 1fr 1fr; }
}
</style>
@endsection

@section('content')
<div class="metrics-wrap">
<div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:18px;">
    <h1 style="font-size:22px;font-weight:800;color:#0f172a;margin:0;">
        <i class="fas fa-file-excel" style="color:#16a34a;margin-right:8px;"></i>FB Ads Metrics Upload
    </h1>
</div>

<div class="metrics-tabs">
    <a href="{{ route('fbads.metrics.index', ['tab' => 'uploads']) }}" class="metrics-tab {{ ($tab ?? 'uploads') === 'uploads' ? 'active' : '' }}">
        Upload History & Upload
    </a>
    <a href="{{ route('fbads.metrics.index', ['tab' => 'reports']) }}" class="metrics-tab {{ ($tab ?? 'uploads') === 'reports' ? 'active' : '' }}">
        Meta Ads Reports
    </a>
    <a href="{{ route('fbads.metrics.index', ['tab' => 'monthly']) }}" class="metrics-tab {{ ($tab ?? 'uploads') === 'monthly' ? 'active' : '' }}">
        Monthly Report
    </a>
</div>

@if(session('success'))
    <div style="background:#dcfce7;color:#166534;border:1px solid #bbf7d0;padding:10px 12px;border-radius:10px;margin-bottom:14px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background:#fee2e2;color:#991b1b;border:1px solid #fecaca;padding:10px 12px;border-radius:10px;margin-bottom:14px;">
        {{ session('error') }}
    </div>
@endif

@if(($tab ?? 'uploads') === 'uploads')
<div class="metrics-grid">
    <div class="metrics-card">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
            <h2 style="font-size:14px;font-weight:800;color:#0f172a;margin:0;">Upload History</h2>
            <span style="font-size:11px;color:#94a3b8;">{{ $uploads->total() }} files</span>
        </div>

        <div>
            @forelse($uploads as $upload)
                <div class="metrics-item">
                    <div style="width:34px;height:34px;border-radius:9px;background:#ecfdf5;color:#16a34a;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <i class="fas fa-file-excel"></i>
                    </div>
                    <div style="flex:1;min-width:0;">
                        <div style="font-size:12px;font-weight:700;color:#0f172a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">
                            {{ $upload->original_file_name }}
                        </div>
                        <div style="font-size:11px;color:#64748b;">
                            Uploaded: {{ date_f($upload->created_at, 'M d, Y h:i A') }}
                        </div>
                        <div style="font-size:11px;color:#475569;font-weight:700;">
                            Adspent: ₱{{ number_format((float) $upload->summary_ad_spend, 2) }}
                            &nbsp;|&nbsp;
                            ROAS: {{ number_format((float) $upload->summary_roas, 2) }}x
                        </div>
                        <form action="{{ route('fbads.metrics.update_exported_date', $upload->id) }}" method="POST" style="display:flex;align-items:center;gap:6px;margin-top:5px;">
                            @csrf
                            @method('PATCH')
                            <input type="text" name="exported_date" value="{{ $upload->exported_date ? date('Y-m-d', strtotime($upload->exported_date)) : date('Y-m-d') }}" required class="browser-default js-exported-date-inline" style="height:30px;padding:0 8px;border:1px solid #dbe7f3;border-radius:8px;font-size:11px;color:#334155;cursor:pointer;">
                            <button type="submit" class="save-btn" title="Save exported date">
                                <i class="fas fa-check"></i>
                            </button>
                        </form>
                        <form action="{{ route('fbads.metrics.reupload', $upload->id) }}" method="POST" enctype="multipart/form-data" class="reupload-mini">
                            @csrf
                            <input type="hidden" name="exported_date" value="{{ $upload->exported_date ? date('Y-m-d', strtotime($upload->exported_date)) : date('Y-m-d') }}">
                            <input type="file" name="excel_file" accept=".xlsx,.xls" required class="browser-default reupload-file">
                            <button type="submit" class="reupload-btn">Reupload</button>
                        </form>
                    </div>
                    <div style="font-size:11px;color:#64748b;font-weight:700;">
                        {{ number_format($upload->rows_imported) }} rows
                    </div>
                    <form action="{{ route('fbads.metrics.destroy', $upload->id) }}" method="POST" style="margin:0;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Delete this upload entry and imported metrics?')" class="delete-btn">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>
            @empty
                <div style="font-size:12px;color:#94a3b8;padding:16px;border:1px dashed #e2e8f0;border-radius:10px;text-align:center;">
                    No uploaded files yet.
                </div>
            @endforelse
        </div>

        <div style="margin-top:12px;">
            {{ $uploads->links() }}
        </div>

    </div>

    <div class="metrics-card">
        <h2 style="font-size:14px;font-weight:800;color:#0f172a;margin:0 0 12px;">Upload</h2>
        <p style="font-size:12px;color:#64748b;margin:0 0 12px;">
            Upload Excel file like <strong>Madella-Enterprises fb ads metrics.xlsx</strong>
        </p>

        <form action="{{ route('fbads.metrics.store') }}" method="POST" enctype="multipart/form-data" class="upload-box">
            @csrf
            <label for="exported_date" style="display:block;font-size:12px;font-weight:700;color:#334155;margin-bottom:6px;">
                Export Date (from FB Ads)
            </label>
            <input type="text" name="exported_date" id="exported_date" value="{{ old('exported_date', $nextExportedDate ?? date('Y-m-d')) }}" required class="browser-default js-exported-date metrics-date-input">
            @error('exported_date')
                <div style="font-size:12px;color:#dc2626;margin-bottom:10px;">{{ $message }}</div>
            @enderror

            <div style="display:flex;align-items:center;gap:10px;margin-bottom:12px;">
                <div style="width:36px;height:36px;border-radius:10px;background:#dbeafe;color:#2563eb;display:flex;align-items:center;justify-content:center;">
                    <i class="fas fa-upload"></i>
                </div>
                <div style="font-size:12px;color:#334155;font-weight:600;">Select `.xlsx` or `.xls` file</div>
            </div>

            <input type="file" name="excel_file" accept=".xlsx,.xls" required class="browser-default" style="width:100%;font-size:12px;margin-bottom:10px;">
            @error('excel_file')
                <div style="font-size:12px;color:#dc2626;margin-bottom:10px;">{{ $message }}</div>
            @enderror

            <button type="submit" class="upload-btn">
                Upload File
            </button>
        </form>

        <div class="adspend-box">
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:8px;">
                <div style="font-size:13px;font-weight:800;color:#0f172a;">Total Adspent</div>
                <div style="font-size:13px;font-weight:800;color:#16a34a;">₱{{ number_format((float) $totalAdSpend, 2) }}</div>
            </div>
            <table class="adspend-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Filename</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($adSpendByFile as $row)
                        <tr>
                            <td>{{ $row->exported_date ? date_f($row->exported_date, 'M d, Y') : '—' }}</td>
                            <td style="max-width:260px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $row->original_file_name }}</td>
                            <td>₱{{ number_format((float) $row->total_ad_spend, 2) }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" style="text-align:center;color:#94a3b8;">No ad spend data yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
@elseif(($tab ?? 'uploads') === 'reports')
<div class="metrics-card">
    @php
        $baseQuery = request()->query();
        $currentSortBy = $sortBy ?? 'reporting_starts';
        $currentSortDir = $sortDir ?? 'desc';
        $rangeLabel = date('M d, Y', strtotime($reportStartDate)) . ' to ' . date('M d, Y', strtotime($reportEndDate));
    @endphp
    <h2 style="font-size:15px;font-weight:800;color:#0f172a;margin:0 0 10px;">Meta Ads Reports</h2>

    <form method="GET" action="{{ route('fbads.metrics.index') }}" class="report-controls">
        <input type="hidden" name="tab" value="reports">
        <input type="hidden" name="report_start_date" id="report_start_date" value="{{ $reportStartDate }}">
        <input type="hidden" name="report_end_date" id="report_end_date" value="{{ $reportEndDate }}">
        <div class="quick-row">
            <span style="font-size:11px;font-weight:700;color:#64748b;margin-right:2px;">Quick Filter</span>
            @php($q = $quickRange ?? '')
            <a class="quick-pill {{ $q === 'today' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'today'])) }}">Today</a>
            <a class="quick-pill {{ $q === 'yesterday' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'yesterday'])) }}">Yesterday</a>
            <a class="quick-pill {{ $q === '7d' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'7d'])) }}">7D</a>
            <a class="quick-pill {{ $q === '14d' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'14d'])) }}">14D</a>
            <a class="quick-pill {{ $q === '30d' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'30d'])) }}">30D</a>
            <a class="quick-pill {{ $q === 'last_month' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'last_month'])) }}">Last Month</a>
            <a class="quick-pill {{ $q === 'this_month' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge(request()->query(), ['tab'=>'reports','quick_range'=>'this_month'])) }}">This Month</a>
        </div>
        <div class="report-toolbar">
            <div class="report-left-controls">
                <input type="text" id="report_range_display" class="browser-default range-input" value="{{ $rangeLabel }}">
            <div>
                <select name="per_page" class="browser-default" style="height:34px;border:1px solid #dbe7f3;border-radius:10px;padding:0 8px;font-size:11px;color:#334155;">
                    <option value="50" {{ (int)($perPage ?? 50) === 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ (int)($perPage ?? 50) === 100 ? 'selected' : '' }}>100</option>
                    <option value="200" {{ (int)($perPage ?? 50) === 200 ? 'selected' : '' }}>200</option>
                </select>
            </div>
            <button type="submit" class="report-btn" style="height:34px;padding:0 10px;">Apply</button>
            </div>
            <button type="submit" name="export" value="1" class="report-btn" style="background:#0f766e;height:34px;padding:0 10px;">Export</button>
        </div>
    </form>

    <div class="report-table-wrap">
        <table class="report-table">
            <thead>
                <tr>
                    <th>
                        <a class="sort-link {{ $currentSortBy === 'export_date' ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge($baseQuery, ['sort_by' => 'export_date', 'sort_dir' => (($currentSortBy === 'export_date' && $currentSortDir === 'asc') ? 'desc' : 'asc')])) }}">
                            Date
                            <i class="fas {{ ($currentSortBy === 'export_date' && $currentSortDir === 'asc') ? 'fa-chevron-up' : 'fa-chevron-down' }} sort-chevron"></i>
                        </a>
                    </th>
                    @foreach($selectedColumns as $col)
                        <th>
                            <a class="sort-link {{ $currentSortBy === $col ? 'active' : '' }}" href="{{ route('fbads.metrics.index', array_merge($baseQuery, ['sort_by' => $col, 'sort_dir' => (($currentSortBy === $col && $currentSortDir === 'asc') ? 'desc' : 'asc')])) }}">
                                @if($col === 'campaign_name')
                                    campaign
                                @elseif($col === 'amount_spent_php')
                                    Adspent
                                @elseif($col === 'purchase_roas_return_on_ad_spend')
                                    roas
                                @elseif($col === 'cost_per_purchase_php')
                                    cpp
                                @elseif($col === 'aov_average_order_value')
                                    AOV
                                @elseif($col === 'conversion_rate_percent')
                                    CR%
                                @elseif($col === 'purchases_conversion_value')
                                    Purchase value
                                @else
                                    {{ $availableColumns[$col] ?? $col }}
                                @endif
                                <i class="fas {{ ($currentSortBy === $col && $currentSortDir === 'asc') ? 'fa-chevron-up' : 'fa-chevron-down' }} sort-chevron"></i>
                            </a>
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @forelse($reportRows as $row)
                    <tr>
                        <td>{{ $row->export_date ? date('M d, Y', strtotime($row->export_date)) : '—' }}</td>
                        @foreach($selectedColumns as $col)
                            @php($val = $row->{$col})
                            <td class="{{ $col === 'campaign_name' ? 'campaign-cell' : '' }}" @if($col === 'campaign_name' && $val) title="{{ $val }}" @endif>
                                @if(in_array($col, ['reporting_starts','reporting_ends','date_created','date_last_edited']))
                                    {{ $val ? date('M d, Y', strtotime($val)) : '—' }}
                                @elseif(is_numeric($val) && strpos($col, 'php') !== false)
                                    ₱{{ number_format((float) $val, 2) }}
                                @elseif(is_numeric($val) && in_array($col, ['purchase_roas_return_on_ad_spend','frequency','ctr_all','ctr_link_click_through_rate','initiate_check_out_rate','hook_rate']))
                                    {{ number_format((float) $val, 2) }}
                                @elseif(is_numeric($val))
                                    {{ number_format((float) $val, 0) }}
                                @else
                                    {{ $val !== null && $val !== '' ? $val : '—' }}
                                @endif
                            </td>
                        @endforeach
                    </tr>
                @empty
                    <tr>
                        <td colspan="{{ max(1, count($selectedColumns)) + 1 }}" style="text-align:center;color:#94a3b8;">No report data for selected date range.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div style="margin-top:12px;">
        {{ $reportRows->links() }}
    </div>
</div>
@else
<div class="metrics-card">
    <h2 style="font-size:15px;font-weight:800;color:#0f172a;margin:0 0 10px;">Monthly Report</h2>
    <div style="font-size:12px;color:#64748b;margin-bottom:10px;">Monitor ad spend and core performance in one glance (this month vs last month).</div>

    <div class="monthly-kpi-grid">
        <div class="monthly-kpi">
            <div class="k-label">Adspent</div>
            <div class="k-val">₱{{ number_format((float)$kpiMonth['ad_spend'], 0) }}</div>
            <div class="k-sub {{ $kpiChange['ad_spend'] >= 0 ? 'up' : 'down' }}">{{ $kpiChange['ad_spend'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['ad_spend'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">Purchase value</div>
            <div class="k-val">₱{{ number_format((float)$kpiMonth['purchase_value'], 0) }}</div>
            <div class="k-sub {{ $kpiChange['purchase_value'] >= 0 ? 'up' : 'down' }}">{{ $kpiChange['purchase_value'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['purchase_value'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">ROAS</div>
            <div class="k-val">{{ number_format((float)$kpiMonth['avg_roas'], 2) }}x</div>
            <div class="k-sub {{ $kpiChange['avg_roas'] >= 0 ? 'up' : 'down' }}">{{ $kpiChange['avg_roas'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['avg_roas'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">Purchases</div>
            <div class="k-val">{{ number_format((float)$kpiMonth['purchases'], 0) }}</div>
            <div class="k-sub {{ $kpiChange['purchases'] >= 0 ? 'up' : 'down' }}">{{ $kpiChange['purchases'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['purchases'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">CPP</div>
            <div class="k-val">₱{{ number_format((float)$kpiMonth['avg_cpp'], 2) }}</div>
            <div class="k-sub {{ $kpiChange['avg_cpp'] <= 0 ? 'up' : 'down' }}">{{ $kpiChange['avg_cpp'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['avg_cpp'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">AOV</div>
            <div class="k-val">₱{{ number_format((float)$kpiMonth['avg_aov'], 2) }}</div>
            <div class="k-sub {{ $kpiChange['avg_aov'] >= 0 ? 'up' : 'down' }}">{{ $kpiChange['avg_aov'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['avg_aov'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">CR%</div>
            <div class="k-val">{{ number_format((float)$kpiMonth['avg_cr'], 2) }}%</div>
            <div class="k-sub {{ $kpiChange['avg_cr'] >= 0 ? 'up' : 'down' }}">{{ $kpiChange['avg_cr'] >= 0 ? '+' : '' }}{{ number_format($kpiChange['avg_cr'], 1) }}% vs last month</div>
        </div>
        <div class="monthly-kpi">
            <div class="k-label">Efficiency</div>
            <div class="k-val">{{ number_format(((float)$kpiMonth['ad_spend'] > 0 ? ((float)$kpiMonth['purchase_value']/(float)$kpiMonth['ad_spend']) : 0), 2) }}x</div>
            <div class="k-sub">Value / Adspent</div>
        </div>
    </div>

    <div class="monthly-chart-wrap">
        <canvas id="monthlyMetricsChart" height="120"></canvas>
    </div>

    <div class="sim-box">
        <div style="display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;margin-bottom:10px;">
            <div style="font-size:13px;font-weight:800;color:#0f172a;">Projection Simulator</div>
            <div style="font-size:11px;color:#64748b;">
                Baseline: {{ $prevMonthLabel ?? 'Last Month' }} Adspent <b style="color:#0f172a;">₱{{ number_format((float)($kpiPrevMonth['ad_spend'] ?? 0), 2) }}</b>
            </div>
        </div>
        <div class="sim-grid" style="margin-bottom:10px;">
            <div>
                <label style="display:block;font-size:11px;color:#64748b;font-weight:700;margin-bottom:5px;">Increase Budget %</label>
                <input type="number" step="0.1" id="sim_budget_increase" class="sim-input" value="10">
            </div>
            <div>
                <label style="display:block;font-size:11px;color:#64748b;font-weight:700;margin-bottom:5px;">Target ROAS (x)</label>
                <input type="number" step="0.01" id="sim_target_roas" class="sim-input" value="{{ number_format((float)($kpiPrevMonth['avg_roas'] ?? 0), 2, '.', '') }}">
            </div>
            <div class="sim-kpi">
                <div class="s-label">Projected Adspent</div>
                <div class="s-val" id="sim_projected_spend">₱0</div>
            </div>
            <div class="sim-kpi">
                <div class="s-label">Projected Purchase Value</div>
                <div class="s-val" id="sim_projected_value">₱0</div>
            </div>
            <div class="sim-kpi">
                <div class="s-label">Incremental Adspent</div>
                <div class="s-val" id="sim_incremental_spend">₱0</div>
            </div>
            <div class="sim-kpi">
                <div class="s-label">Incremental Value</div>
                <div class="s-val" id="sim_incremental_value">₱0</div>
            </div>
            <div class="sim-kpi">
                <div class="s-label">Baseline Value ({{ $prevMonthLabel ?? 'Last Month' }})</div>
                <div class="s-val" id="sim_baseline_value">₱0</div>
            </div>
            <div class="sim-kpi">
                <div class="s-label">Target vs Baseline ROAS</div>
                <div class="s-val" id="sim_roas_diff">0.00x</div>
            </div>
        </div>
    </div>
</div>
@endif
</div>
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var pickerOptions = {
        dateFormat: 'Y-m-d',
        altInput: true,
        altFormat: 'M d, Y',
        allowInput: false,
        monthSelectorType: 'static'
    };

    document.querySelectorAll('.js-exported-date, .js-exported-date-inline').forEach(function (input) {
        if (typeof flatpickr !== 'undefined') {
            flatpickr(input, pickerOptions);
        }
    });

    var rangeDisplay = document.getElementById('report_range_display');
    var startHidden = document.getElementById('report_start_date');
    var endHidden = document.getElementById('report_end_date');
    if (rangeDisplay && startHidden && endHidden && typeof flatpickr !== 'undefined') {
        flatpickr(rangeDisplay, {
            mode: 'range',
            dateFormat: 'Y-m-d',
            altInput: false,
            defaultDate: [startHidden.value, endHidden.value],
            monthSelectorType: 'static',
            onClose: function(selectedDates) {
                if (selectedDates.length >= 1) {
                    var s = selectedDates[0];
                    var yyyy = s.getFullYear(), mm = String(s.getMonth()+1).padStart(2,'0'), dd = String(s.getDate()).padStart(2,'0');
                    startHidden.value = yyyy + '-' + mm + '-' + dd;
                }
                if (selectedDates.length >= 2) {
                    var e = selectedDates[1];
                    var yyyy2 = e.getFullYear(), mm2 = String(e.getMonth()+1).padStart(2,'0'), dd2 = String(e.getDate()).padStart(2,'0');
                    endHidden.value = yyyy2 + '-' + mm2 + '-' + dd2;
                } else {
                    endHidden.value = startHidden.value;
                }
            },
            formatDate: function(date, format, locale) {
                var months = ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
                return months[date.getMonth()] + ' ' + String(date.getDate()).padStart(2,'0') + ', ' + date.getFullYear();
            }
        });
    }

    var openBtn = document.getElementById('openColumnsModal');
    var closeBtn = document.getElementById('closeColumnsModal');
    var modal = document.getElementById('columnsModal');
    if (openBtn && closeBtn && modal) {
        var cancelBtn = document.getElementById('cancelColumnsModal');
        var saveBtn = document.getElementById('saveColumnsModal');
        var selectedList = document.getElementById('selectedList');
        var selectedCountText = document.getElementById('selectedCountText');
        var searchInput = document.getElementById('columnSearch');
        var activeCat = 'all';
        var gridItems = Array.prototype.slice.call(document.querySelectorAll('[data-col-item]'));
        var colTabs = Array.prototype.slice.call(document.querySelectorAll('.col-tab'));

        var renderSelected = function () {
            if (!selectedList || !selectedCountText) return;
            var checked = Array.prototype.slice.call(document.querySelectorAll('input[name=\"columns[]\"]:checked'));
            selectedCountText.textContent = checked.length + ' columns selected';
            selectedList.innerHTML = checked.map(function (cb) {
                var label = cb.closest('label') ? cb.closest('label').querySelector('span').textContent : cb.value;
                return '<div class=\"selected-item\"><span>' + label + '</span><button type=\"button\" class=\"selected-remove\" data-remove-col=\"' + cb.value + '\">×</button></div>';
            }).join('');
        };

        var filterGrid = function () {
            var q = (searchInput && searchInput.value ? searchInput.value : '').toLowerCase().trim();
            gridItems.forEach(function (item) {
                var label = item.getAttribute('data-label') || '';
                var cat = item.getAttribute('data-cat') || 'custom';
                var matchCat = (activeCat === 'all' || activeCat === cat);
                var matchText = (q === '' || label.indexOf(q) !== -1);
                item.style.display = (matchCat && matchText) ? '' : 'none';
            });
        };

        openBtn.addEventListener('click', function () {
            modal.style.display = 'flex';
            renderSelected();
            filterGrid();
        });
        closeBtn.addEventListener('click', function () { modal.style.display = 'none'; });
        if (cancelBtn) cancelBtn.addEventListener('click', function () { modal.style.display = 'none'; });
        if (saveBtn) saveBtn.addEventListener('click', function () { modal.style.display = 'none'; });

        if (searchInput) searchInput.addEventListener('input', filterGrid);
        colTabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                activeCat = tab.getAttribute('data-cat') || 'all';
                colTabs.forEach(function (t) { t.classList.remove('active'); });
                tab.classList.add('active');
                filterGrid();
            });
        });

        document.addEventListener('change', function (e) {
            if (e.target && e.target.matches('input[name=\"columns[]\"]')) {
                renderSelected();
            }
        });
        document.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-remove-col]');
            if (!btn) return;
            var val = btn.getAttribute('data-remove-col');
            var cb = document.querySelector('input[name=\"columns[]\"][value=\"' + val + '\"]');
            if (cb) {
                cb.checked = false;
                renderSelected();
            }
        });
        modal.addEventListener('click', function (e) {
            if (e.target === modal) modal.style.display = 'none';
        });
    }

    var monthlyChartEl = document.getElementById('monthlyMetricsChart');
    if (monthlyChartEl && window.Chart) {
        new Chart(monthlyChartEl, {
            type: 'bar',
            data: {
                labels: @json($monthlyLabels ?? []),
                datasets: [
                    {
                        label: 'Adspent',
                        data: @json($monthlyAdSpend ?? []),
                        backgroundColor: 'rgba(37,99,235,0.65)',
                        borderColor: 'rgba(37,99,235,1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Purchase value',
                        data: @json($monthlyPurchaseValue ?? []),
                        backgroundColor: 'rgba(16,185,129,0.55)',
                        borderColor: 'rgba(16,185,129,1)',
                        borderWidth: 1,
                        yAxisID: 'y'
                    },
                    {
                        type: 'line',
                        label: 'ROAS',
                        data: @json($monthlyAvgRoas ?? []),
                        borderColor: '#f59e0b',
                        backgroundColor: '#f59e0b',
                        borderWidth: 2,
                        tension: 0.35,
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { position: 'top' } },
                scales: {
                    y: { beginAtZero: true },
                    y1: { position: 'right', beginAtZero: true, grid: { drawOnChartArea: false } }
                }
            }
        });
    }

    // Projection simulator (based on last month adspent)
    var baseSpend = parseFloat(@json((float)($kpiPrevMonth['ad_spend'] ?? 0)));
    var baseRoas = parseFloat(@json((float)($kpiPrevMonth['avg_roas'] ?? 0)));
    var budgetInput = document.getElementById('sim_budget_increase');
    var roasInput = document.getElementById('sim_target_roas');
    var projectedSpendEl = document.getElementById('sim_projected_spend');
    var projectedValueEl = document.getElementById('sim_projected_value');
    var incSpendEl = document.getElementById('sim_incremental_spend');
    var incValueEl = document.getElementById('sim_incremental_value');
    var baselineValueEl = document.getElementById('sim_baseline_value');
    var roasDiffEl = document.getElementById('sim_roas_diff');

    function formatPeso(n) {
        return '₱' + (n || 0).toLocaleString(undefined, { maximumFractionDigits: 0 });
    }
    function updateSim() {
        if (!budgetInput || !roasInput) return;
        var pct = parseFloat(budgetInput.value || '0');
        var targetRoas = parseFloat(roasInput.value || '0');
        if (isNaN(pct)) pct = 0;
        if (isNaN(targetRoas)) targetRoas = 0;

        var projectedSpend = baseSpend * (1 + (pct / 100));
        var projectedValue = projectedSpend * targetRoas;
        var baselineValue = baseSpend * baseRoas;
        var incSpend = projectedSpend - baseSpend;
        var incValue = projectedValue - baselineValue;
        var roasDiff = targetRoas - baseRoas;

        if (projectedSpendEl) projectedSpendEl.textContent = formatPeso(projectedSpend);
        if (projectedValueEl) projectedValueEl.textContent = formatPeso(projectedValue);
        if (incSpendEl) incSpendEl.textContent = formatPeso(incSpend);
        if (incValueEl) incValueEl.textContent = formatPeso(incValue);
        if (baselineValueEl) baselineValueEl.textContent = formatPeso(baselineValue);
        if (roasDiffEl) roasDiffEl.textContent = (roasDiff >= 0 ? '+' : '') + roasDiff.toFixed(2) + 'x';
    }
    if (budgetInput && roasInput) {
        budgetInput.addEventListener('input', updateSim);
        roasInput.addEventListener('input', updateSim);
        updateSim();
    }
});
</script>
@endsection
