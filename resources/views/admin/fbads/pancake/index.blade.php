@extends('admin.fbads.layouts')

@section('title') Pancake @endsection

@section('content')
<div class="container-fluid" style="padding: 18px 16px 24px;">
    <style>
        .pc-hero {
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 35%, #0ea5e9 100%);
            border-radius: 16px;
            padding: 16px;
            box-shadow: 0 16px 34px rgba(30, 64, 175, 0.26);
            color: #fff;
        }
        .pc-card {
            background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%);
            border: 1px solid #dbeafe;
            border-radius: 14px;
            box-shadow: 0 8px 24px rgba(15, 23, 42, 0.06);
        }
        .pc-input, .pc-select {
            height: 38px;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            padding: 6px 10px;
            font-size: 13px;
            color: #0f172a;
            width: 100%;
            background: #fff;
            box-shadow: inset 0 1px 2px rgba(15, 23, 42, 0.04);
        }
        .pc-input:focus, .pc-select:focus {
            border-color: #60a5fa;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.18);
            outline: none;
        }
        .pc-btn {
            height: 38px;
            border: 0;
            border-radius: 10px;
            padding: 0 14px;
            font-weight: 600;
            font-size: 13px;
            cursor: pointer;
            transition: all .18s ease;
        }
        .pc-btn-primary {
            background: linear-gradient(135deg, #2563eb 0%, #0ea5e9 100%);
            color:#fff;
            box-shadow: 0 10px 20px rgba(37, 99, 235, 0.26);
        }
        .pc-btn-primary:hover { transform: translateY(-1px); }
        .pc-btn-ghost { background:#eaf2ff; color:#1e3a8a; }
        .pc-badge {
            display:inline-block; padding:4px 9px; border-radius:999px; font-size:11px; font-weight:700;
        }
        .pc-stage-sales { background:#eff6ff; color:#1d4ed8; }
        .pc-stage-production { background:#ecfeff; color:#0e7490; }
        .pc-stage-packing { background:#fff7ed; color:#c2410c; }
        .pc-stage-handover { background:#f5f3ff; color:#6d28d9; }
        .pc-stage-shipped { background:#f0fdf4; color:#15803d; }
        .pc-status-active { background:#ecfdf5; color:#047857; }
        .pc-status-on_hold { background:#fffbeb; color:#b45309; }
        .pc-status-cancelled { background:#fef2f2; color:#b91c1c; }
        .pc-status-completed { background:#e0f2fe; color:#0369a1; }
        .pc-table th { font-size:12px; text-transform:uppercase; letter-spacing:.4px; color:#475569; border-top:0 !important; background:#f0f7ff; }
        .pc-table td { vertical-align: middle !important; font-size:13px; color:#1e293b; }
        .pc-table th, .pc-table td { padding-left: 14px !important; padding-right: 14px !important; }
        /* Materialize/global CSS hides native checkboxes; force-enable for this page */
        .pc-table input[type="checkbox"],
        #checkAllRows {
            position: relative !important;
            opacity: 1 !important;
            pointer-events: auto !important;
            appearance: auto !important;
            -webkit-appearance: checkbox !important;
            width: 16px !important;
            height: 16px !important;
            margin: 0 !important;
            cursor: pointer !important;
            z-index: 3 !important;
        }
    </style>

    <div class="pc-hero" style="display:flex;align-items:flex-start;justify-content:space-between;gap:14px;flex-wrap:wrap;margin-bottom:14px;">
        <div>
            <h4 style="margin:0;font-weight:800;color:#fff;">Pancake Orders</h4>
            <p style="margin:4px 0 0;color:#dbeafe;font-size:13px;">Track VIP orders from sales to J&amp;T handover.</p>
        </div>
        <button type="button" id="openPancakeImportModal" class="pc-btn pc-btn-primary">
            <i class="fas fa-file-import" style="margin-right:6px;"></i> Import Orders (Pancake)
        </button>
    </div>

    @if(session('success'))
        <div class="alert alert-success" style="border-radius:10px;">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger" style="border-radius:10px;">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger" style="border-radius:10px;">
            <ul style="margin:0;padding-left:18px;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="pc-card" style="padding:12px;margin-bottom:12px;">
        <form method="GET" action="{{ route('fbads.pancake.index') }}">
            <div style="display:flex;gap:8px;align-items:flex-end;flex-wrap:nowrap;overflow-x:auto;padding-bottom:4px;">
                <div style="min-width:280px;flex:0 0 280px;">
                    <label style="font-size:11px;color:#64748b;margin-bottom:4px;">Search</label>
                    <input
                        type="text"
                        name="search"
                        class="pc-input browser-default"
                        value="{{ request('search') }}"
                        placeholder="Mobile number, tracking number, customer name"
                    >
                </div>
                <div style="min-width:150px;flex:0 0 150px;">
                    <label style="font-size:11px;color:#64748b;margin-bottom:4px;">Status</label>
                    <select name="status" class="pc-select browser-default">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="on_hold" {{ request('status') === 'on_hold' ? 'selected' : '' }}>On Hold</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>
                <div style="min-width:160px;flex:0 0 160px;">
                    <label style="font-size:11px;color:#64748b;margin-bottom:4px;">Workflow</label>
                    <select name="workflow_stage" class="pc-select browser-default">
                        <option value="">All Stages</option>
                        <option value="sales" {{ request('workflow_stage') === 'sales' ? 'selected' : '' }}>Sales</option>
                        <option value="production" {{ request('workflow_stage') === 'production' ? 'selected' : '' }}>Production</option>
                        <option value="packing" {{ request('workflow_stage') === 'packing' ? 'selected' : '' }}>Packing</option>
                        <option value="handover" {{ request('workflow_stage') === 'handover' ? 'selected' : '' }}>Handover</option>
                        <option value="shipped" {{ request('workflow_stage') === 'shipped' ? 'selected' : '' }}>Shipped</option>
                    </select>
                </div>
                <div style="min-width:150px;flex:0 0 150px;">
                    <label style="font-size:11px;color:#64748b;margin-bottom:4px;">Created Date</label>
                    <input type="date" name="created_date" value="{{ request('created_date') }}" class="pc-input browser-default">
                </div>
                <div style="display:flex;gap:8px;justify-content:flex-end;min-width:160px;flex:0 0 160px;">
                <a href="{{ route('fbads.pancake.index') }}" class="pc-btn pc-btn-ghost" style="display:inline-flex;align-items:center;">Reset</a>
                <button type="submit" class="pc-btn pc-btn-primary">Apply Filters</button>
                </div>
            </div>
        </form>
    </div>

    <div class="pc-card" style="overflow:hidden;padding-left:10px;padding-right:10px;">
        <form id="pancakeBulkForm" action="{{ route('fbads.pancake.bulk_action') }}" method="POST">
            @csrf
            <input type="hidden" name="action" value="delete_selected">
            <div style="padding:10px 12px;border-bottom:1px solid #e2e8f0;display:flex;justify-content:space-between;align-items:center;gap:10px;flex-wrap:wrap;">
                <div style="font-size:12px;color:#475569;">
                    <strong id="selectedCount">0</strong> selected
                </div>
                <div style="display:flex;align-items:center;gap:6px;">
                    <span style="font-size:12px;color:#64748b;font-weight:600;">Bulk Action</span>
                    <select id="bulkActionSelect" name="action" class="pc-select browser-default" style="min-width:185px;height:34px;padding:4px 8px;">
                        <option value="">Select Action</option>
                        <option value="delete_selected">🗑 Delete Selected</option>
                    </select>
                    <button type="submit" id="bulkApplyBtn" class="pc-btn pc-btn-primary" style="height:34px;padding:0 12px;opacity:.55;cursor:not-allowed;" disabled>
                        <i class="fas fa-check"></i>
                    </button>
                </div>
            </div>
        <div style="overflow:auto;">
            <table class="table table-hover pc-table" style="margin:0;min-width:1100px;">
                <thead style="background:#f8fafc;">
                    <tr>
                        <th style="width:44px;">
                            <input type="checkbox" id="checkAllRows" class="browser-default">
                        </th>
                        <th>ID</th>
                        <th>Tracking #</th>
                        <th>Phone</th>
                        <th>Customer</th>
                        <th>Product List</th>
                        <th>Workflow Stage</th>
                        <th>Status</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td>
                                <input type="checkbox" name="selected_ids[]" value="{{ $order->id }}" class="rowCheckbox browser-default">
                            </td>
                            <td>{{ $order->id }}</td>
                            <td style="font-weight:600;">{{ $order->tracking_number ?: '—' }}</td>
                            <td>{{ $order->phone_number ?: '—' }}</td>
                            <td>{{ $order->customer }}</td>
                            <td style="max-width:280px;white-space:normal;">{{ $order->product_list ?: '—' }}</td>
                            <td>
                                <span class="pc-badge pc-stage-{{ $order->workflow_stage }}">
                                    {{ strtoupper(str_replace('_', ' ', $order->workflow_stage)) }}
                                </span>
                            </td>
                            <td>
                                <span class="pc-badge pc-status-{{ $order->status }}">
                                    {{ strtoupper(str_replace('_', ' ', $order->status)) }}
                                </span>
                            </td>
                            <td>{{ optional($order->created_at)->format('M d, Y') }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" style="text-align:center;color:#94a3b8;padding:28px;">No records found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        </form>
    </div>

    <div style="margin-top:12px;">
        {{ $orders->appends(request()->query())->links() }}
    </div>
</div>

<div id="pancakeImportModal" style="position:fixed;inset:0;background:rgba(15,23,42,.52);z-index:1300;display:none;align-items:center;justify-content:center;padding:16px;">
    <div style="width:100%;max-width:540px;background:#fff;border-radius:12px;overflow:hidden;box-shadow:0 16px 40px rgba(15,23,42,.28);">
        <div style="display:flex;align-items:center;justify-content:space-between;padding:14px 16px;border-bottom:1px solid #e2e8f0;">
            <h5 style="margin:0;font-weight:700;color:#0f172a;">Import Orders (Pancake)</h5>
            <button type="button" id="closePancakeImportModalX" style="border:0;background:transparent;font-size:22px;line-height:1;color:#64748b;cursor:pointer;">&times;</button>
        </div>
        <form action="{{ route('fbads.pancake.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div style="padding:16px;">
                <p style="font-size:13px;color:#64748b;margin-bottom:10px;">
                    Upload your Pancake orders Excel file (<strong>.xlsx</strong> or <strong>.xls</strong>).
                </p>
                <input type="file" name="excel_file" accept=".xlsx,.xls" required class="browser-default" style="width:100%;">
            </div>
            <div style="display:flex;justify-content:flex-end;gap:8px;padding:12px 16px;border-top:1px solid #e2e8f0;">
                <button type="button" id="closePancakeImportModal" class="pc-btn pc-btn-ghost">Cancel</button>
                <button type="submit" class="pc-btn pc-btn-primary">Import</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    var modal = document.getElementById('pancakeImportModal');
    var openBtn = document.getElementById('openPancakeImportModal');
    var closeBtn = document.getElementById('closePancakeImportModal');
    var closeBtnX = document.getElementById('closePancakeImportModalX');
    if (!modal || !openBtn) return;

    function openModal() { modal.style.display = 'flex'; }
    function closeModal() { modal.style.display = 'none'; }

    openBtn.addEventListener('click', openModal);
    if (closeBtn) closeBtn.addEventListener('click', closeModal);
    if (closeBtnX) closeBtnX.addEventListener('click', closeModal);
    modal.addEventListener('click', function (e) {
        if (e.target === modal) closeModal();
    });

    var checkAll = document.getElementById('checkAllRows');
    var rowCheckboxes = Array.prototype.slice.call(document.querySelectorAll('.rowCheckbox'));
    var selectedCountEl = document.getElementById('selectedCount');
    var bulkApplyBtn = document.getElementById('bulkApplyBtn');
    var bulkActionSelect = document.getElementById('bulkActionSelect');
    var bulkForm = document.getElementById('pancakeBulkForm');

    function syncBulkUI() {
        var selectedCount = rowCheckboxes.filter(function (cb) { return cb.checked; }).length;
        selectedCountEl.textContent = selectedCount;
        var canApply = selectedCount > 0 && bulkActionSelect && bulkActionSelect.value !== '';
        if (canApply) {
            bulkApplyBtn.disabled = false;
            bulkApplyBtn.style.opacity = '1';
            bulkApplyBtn.style.cursor = 'pointer';
        } else {
            bulkApplyBtn.disabled = true;
            bulkApplyBtn.style.opacity = '.55';
            bulkApplyBtn.style.cursor = 'not-allowed';
        }
        if (checkAll) {
            checkAll.checked = rowCheckboxes.length > 0 && selectedCount === rowCheckboxes.length;
        }
    }

    if (checkAll) {
        checkAll.addEventListener('change', function () {
            rowCheckboxes.forEach(function (cb) { cb.checked = checkAll.checked; });
            syncBulkUI();
        });
    }

    rowCheckboxes.forEach(function (cb) {
        cb.addEventListener('change', syncBulkUI);
    });
    if (bulkActionSelect) {
        bulkActionSelect.addEventListener('change', syncBulkUI);
    }

    if (bulkForm) {
        bulkForm.addEventListener('submit', function (e) {
            var selectedCount = rowCheckboxes.filter(function (cb) { return cb.checked; }).length;
            if (!selectedCount) {
                e.preventDefault();
                return;
            }
            if (!bulkActionSelect || bulkActionSelect.value !== 'delete_selected') {
                e.preventDefault();
                return;
            }
            if (!confirm('Delete all selected orders?')) {
                e.preventDefault();
            }
        });
    }

    syncBulkUI();
});
</script>
@endsection
