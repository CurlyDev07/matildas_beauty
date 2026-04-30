@extends('admin.layouts.app')

@section('content')
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

<div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;align-items:start;">
    <div style="background:#fff;border-radius:12px;padding:16px 18px;box-shadow:0 1px 4px rgba(0,0,0,.07);">
        <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:14px;">
            <h2 style="font-size:14px;font-weight:800;color:#0f172a;margin:0;">Upload History</h2>
            <span style="font-size:11px;color:#94a3b8;">{{ $uploads->total() }} files</span>
        </div>

        <div>
            @forelse($uploads as $upload)
                <div style="display:flex;align-items:center;gap:10px;padding:10px;border:1px solid #f1f5f9;border-radius:10px;margin-bottom:8px;">
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
                    </div>
                    <div style="font-size:11px;color:#64748b;font-weight:700;">
                        {{ number_format($upload->rows_imported) }} rows
                    </div>
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

    <div style="background:#fff;border-radius:12px;padding:16px 18px;box-shadow:0 1px 4px rgba(0,0,0,.07);">
        <h2 style="font-size:14px;font-weight:800;color:#0f172a;margin:0 0 12px;">Upload</h2>
        <p style="font-size:12px;color:#64748b;margin:0 0 12px;">
            Upload Excel file like <strong>Madella-Enterprises fb ads metrics.xlsx</strong>
        </p>

        <form action="{{ route('fbads.metrics.store') }}" method="POST" enctype="multipart/form-data" style="border:1px dashed #cbd5e1;border-radius:12px;padding:18px;background:#f8fafc;">
            @csrf
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

            <button type="submit" style="border:none;background:#2563eb;color:#fff;padding:8px 14px;border-radius:9px;font-size:12px;font-weight:700;cursor:pointer;">
                Upload File
            </button>
        </form>
    </div>
</div>
@endsection

