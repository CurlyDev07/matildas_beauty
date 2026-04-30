@extends('admin.layouts.app')

@section('css')
<style>
.metrics-wrap {
    background: linear-gradient(180deg, #fff 0%, #f8fafc 100%);
    border: 1px solid #eef2f7;
    border-radius: 16px;
    padding: 14px;
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
@media (max-width: 1100px) {
    .metrics-grid { grid-template-columns: 1fr; }
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
                        <div style="font-size:11px;color:#64748b;">
                            Exported Date: {{ $upload->exported_date ? date_f($upload->exported_date, 'M d, Y') : '—' }}
                        </div>
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
            <input type="date" name="exported_date" id="exported_date" value="{{ old('exported_date', date('Y-m-d')) }}" required class="browser-default js-exported-date metrics-date-input">
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
    </div>
</div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
    var dateInput = document.querySelector('.js-exported-date');
    if (!dateInput) return;

    dateInput.addEventListener('click', function () {
        if (typeof this.showPicker === 'function') {
            this.showPicker();
        } else {
            this.focus();
        }
    });
});
</script>
@endsection
