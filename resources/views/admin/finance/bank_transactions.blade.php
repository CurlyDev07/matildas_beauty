@extends('admin.layouts.app')

@section('content')

<style>
    .fin-card {
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 1px 8px rgba(0,0,0,0.07);
        padding: 24px 28px;
    }
    .fin-title { font-size: 20px; font-weight: 600; color: #1f2937; margin: 0 0 4px; }
    .fin-sub   { font-size: 13px; color: #9ca3af; margin: 0 0 16px; }

    /* Filter bar */
    .fin-filters { display: flex; align-items: center; flex-wrap: wrap; gap: 6px; margin-bottom: 16px; }
    .fin-filter-btn {
        padding: 5px 14px;
        border-radius: 20px;
        border: 1px solid #f3e8f0;
        background: #fff;
        color: #6b7280;
        font-size: 12px;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.15s;
        white-space: nowrap;
    }
    .fin-filter-btn:hover { background: #fdf2f8; color: #db2777; border-color: #f9a8d4; text-decoration: none; }
    .fin-filter-btn.active { background: #ec4899; color: #fff; border-color: #ec4899; }
    .fin-custom-range { display: none; align-items: center; gap: 6px; flex-wrap: wrap; }
    .fin-custom-range.show { display: flex; }
    /* Override Materialize CSS on date inputs */
    .fin-date-input,
    .fin-custom-range input[type="date"] {
        padding: 5px 10px !important;
        border: 1px solid #f3e8f0 !important;
        border-radius: 8px !important;
        border-bottom: 1px solid #f3e8f0 !important;
        font-size: 12px !important;
        color: #374151 !important;
        outline: none !important;
        box-shadow: none !important;
        height: auto !important;
        margin: 0 !important;
        background-color: #fff !important;
        box-sizing: border-box !important;
    }
    .fin-date-input:focus,
    .fin-custom-range input[type="date"]:focus {
        border: 1px solid #f9a8d4 !important;
        border-bottom: 1px solid #f9a8d4 !important;
        box-shadow: none !important;
    }
    .fin-apply-btn {
        padding: 5px 14px;
        background: #ec4899;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 12px;
        font-weight: 600;
        cursor: pointer;
    }

    .fin-table { width: 100%; border-collapse: collapse; font-size: 13px; }
    .fin-table thead th {
        background: #fdf2f8; color: #be185d; font-weight: 600;
        padding: 10px 12px; text-align: left; border-bottom: 2px solid #fce7f3; white-space: nowrap;
    }
    .fin-table tbody tr { border-bottom: 1px solid #f9f0f6; transition: background 0.12s; }
    .fin-table tbody tr:hover { background: #fdf9fe; }
    .fin-table tbody td { padding: 10px 12px; color: #374151; vertical-align: middle; }
    .fin-badge { display: inline-block; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; text-transform: capitalize; }
    .fin-badge-pending    { background: #fef3c7; color: #92400e; }
    .fin-badge-completed  { background: #d1fae5; color: #065f46; }
    .fin-badge-failed     { background: #fee2e2; color: #991b1b; }
    .fin-badge-default    { background: #f3f4f6; color: #6b7280; }
    .fin-img-thumb { width: 42px; height: 42px; object-fit: cover; border-radius: 6px; border: 1px solid #f3e8f0; cursor: pointer; transition: transform 0.15s; }
    .fin-img-thumb:hover { transform: scale(1.1); }
    .fin-no-img { width: 42px; height: 42px; border-radius: 6px; background: #f3f4f6; display: flex; align-items: center; justify-content: center; color: #d1d5db; font-size: 16px; }
    .fin-amount { font-weight: 600; color: #059669; }
    .fin-ref { font-size: 11px; color: #6b7280; font-family: monospace; }

    .fin-lightbox { display: none; position: fixed; inset: 0; background: rgba(0,0,0,0.75); z-index: 9999; align-items: center; justify-content: center; }
    .fin-lightbox.active { display: flex; }
    .fin-lightbox img { max-width: 90vw; max-height: 90vh; border-radius: 10px; box-shadow: 0 8px 40px rgba(0,0,0,0.5); }
    .fin-lightbox-close { position: absolute; top: 20px; right: 24px; color: #fff; font-size: 28px; cursor: pointer; line-height: 1; }

    /* Action buttons */
    .fin-btn-edit {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 4px 10px; border-radius: 6px;
        background: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe;
        font-size: 11px; font-weight: 600; cursor: pointer;
        transition: all 0.15s; white-space: nowrap;
    }
    .fin-btn-edit:hover { background: #dbeafe; color: #1d4ed8; }
    .fin-btn-delete {
        display: inline-flex; align-items: center; gap: 4px;
        padding: 4px 10px; border-radius: 6px;
        background: #fff1f2; color: #e11d48; border: 1px solid #fecdd3;
        font-size: 11px; font-weight: 600; cursor: pointer;
        transition: all 0.15s; white-space: nowrap;
    }
    .fin-btn-delete:hover { background: #ffe4e6; color: #be123c; }

    /* Edit Modal */
    .fin-modal-overlay {
        display: none; position: fixed; inset: 0;
        background: rgba(0,0,0,0.45); z-index: 8888;
        align-items: center; justify-content: center;
    }
    .fin-modal-overlay.active { display: flex; }
    .fin-modal {
        background: #fff; border-radius: 14px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.18);
        width: 560px; max-width: 95vw; max-height: 90vh;
        overflow-y: auto; padding: 28px 28px 24px;
    }
    .fin-modal-title {
        font-size: 16px; font-weight: 700; color: #1f2937;
        margin: 0 0 20px; display: flex; align-items: center; gap: 8px;
    }
    .fin-modal-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .fin-modal-field { display: flex; flex-direction: column; gap: 4px; }
    .fin-modal-field.full { grid-column: span 2; }
    .fin-modal-label { font-size: 11px; font-weight: 600; color: #6b7280; text-transform: uppercase; letter-spacing: 0.5px; }
    .fin-modal-input {
        padding: 7px 10px !important;
        border: 1px solid #e5e7eb !important;
        border-bottom: 1px solid #e5e7eb !important;
        border-radius: 7px !important;
        font-size: 13px !important;
        color: #1f2937 !important;
        outline: none !important;
        box-shadow: none !important;
        height: auto !important;
        margin: 0 !important;
        background: #fff !important;
        box-sizing: border-box !important;
        width: 100% !important;
        transition: border-color 0.15s !important;
    }
    .fin-modal-input:focus {
        border-color: #f9a8d4 !important;
        border-bottom-color: #f9a8d4 !important;
        box-shadow: none !important;
    }
    .fin-modal-select {
        padding: 7px 10px !important;
        border: 1px solid #e5e7eb !important;
        border-radius: 7px !important;
        font-size: 13px !important;
        color: #1f2937 !important;
        height: auto !important;
        margin: 0 !important;
        background: #fff !important;
        box-sizing: border-box !important;
        width: 100% !important;
        cursor: pointer;
        display: block !important;
    }
    .fin-modal-footer { display: flex; justify-content: flex-end; gap: 8px; margin-top: 20px; }
    .fin-modal-cancel {
        padding: 8px 18px; border-radius: 8px;
        border: 1px solid #e5e7eb; background: #fff;
        color: #6b7280; font-size: 13px; font-weight: 600; cursor: pointer;
    }
    .fin-modal-save {
        padding: 8px 20px; border-radius: 8px;
        border: none; background: #ec4899;
        color: #fff; font-size: 13px; font-weight: 600; cursor: pointer;
    }
    .fin-modal-save:hover { background: #db2777; }

    /* Flash */
    .fin-flash { padding: 10px 16px; border-radius: 8px; margin-bottom: 14px; font-size: 13px; font-weight: 500; }
    .fin-flash-success { background: #d1fae5; color: #065f46; border: 1px solid #6ee7b7; }
</style>

<div class="fin-card">

    {{-- Header --}}
    <div style="display:flex;align-items:flex-start;justify-content:space-between;margin-bottom:4px;">
        <p class="fin-title" style="margin:0;"><i class="fas fa-university" style="color:#ec4899;margin-right:8px;"></i>Bank Transactions</p>
        <div style="text-align:right;">
            <div style="font-size:11px;color:#9ca3af;text-transform:uppercase;letter-spacing:1px;margin-bottom:2px;">Total</div>
            <div style="font-size:22px;font-weight:700;color:#059669;">PHP {{ number_format($total, 2) }}</div>
        </div>
    </div>
    <p class="fin-sub">{{ $transactions->total() }} records</p>

    {{-- Flash --}}
    @if(session('success'))
        <div class="fin-flash fin-flash-success"><i class="fas fa-check-circle" style="margin-right:6px;"></i>{{ session('success') }}</div>
    @endif

    {{-- Filter bar --}}
    <div class="fin-filters">
        <a href="?filter=all"       class="fin-filter-btn {{ $filter === 'all'       ? 'active' : '' }}">All</a>
        <a href="?filter=today"     class="fin-filter-btn {{ $filter === 'today'     ? 'active' : '' }}">Today</a>
        <a href="?filter=yesterday" class="fin-filter-btn {{ $filter === 'yesterday' ? 'active' : '' }}">Yesterday</a>
        <a href="?filter=7days"     class="fin-filter-btn {{ $filter === '7days'     ? 'active' : '' }}">7 Days</a>
        <a href="?filter=30days"    class="fin-filter-btn {{ $filter === '30days'    ? 'active' : '' }}">30 Days</a>
        <button type="button"
            class="fin-filter-btn {{ $filter === 'custom' ? 'active' : '' }}"
            onclick="document.getElementById('finCustomRange').classList.toggle('show')">
            <i class="fas fa-calendar-alt" style="margin-right:4px;"></i>Custom
        </button>

        <form method="GET" id="finCustomRange" class="fin-custom-range {{ $filter === 'custom' ? 'show' : '' }}">
            <input type="hidden" name="filter" value="custom">
            <input type="date" name="date_from" class="fin-date-input browser-default" value="{{ $dateFrom ?? '' }}" onclick="try{this.showPicker()}catch(e){}" required>
            <span style="color:#9ca3af;font-size:12px;">to</span>
            <input type="date" name="date_to"   class="fin-date-input browser-default" value="{{ $dateTo ?? '' }}" onclick="try{this.showPicker()}catch(e){}" required>
            <button type="submit" class="fin-apply-btn">Apply</button>
        </form>
    </div>

    @if($transactions->isEmpty())
        <div style="text-align:center;padding:60px 0;color:#9ca3af;">
            <i class="fas fa-inbox" style="font-size:40px;margin-bottom:12px;display:block;"></i>
            No transactions found.
        </div>
    @else
    <div style="overflow-x:auto;">
        <table class="fin-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date / Time</th>
                    <th>Bank/Type</th>
                    <th>Amount</th>
                    <th>Sender</th>
                    <th>Receiver</th>
                    <th>Reference</th>
                    <th>Note</th>
                    <th>Status</th>
                    <th>Conf.</th>
                    <th>Receipt</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $t)
                <tr>
                    <td style="color:#9ca3af;">{{ $t->id }}</td>
                    <td style="white-space:nowrap;">
                        <div>{{ $t->date ? \Carbon\Carbon::parse($t->date)->format('M d') : '—' }}</div>
                        <div style="font-size:11px;color:#9ca3af;">{{ $t->time ?? '' }}</div>
                    </td>
                    <td style="white-space:nowrap;">
                        <div class="tfont-medium">{{ $t->bank }}</div>
                        <div class="ttext-xs">{{ $t->transaction_type }}</div>
                        <div style="font-size:11px;color:#9ca3af;">{{ $t->platform_type }}</div>
                    </td>
                    <td class="fin-amount">₱{{ number_format($t->amount, 0) }}</td>
                    <td>{{ $t->sender_name ?? '—' }}</td>
                    <td>
                        <div class="tfont-medium">{{ $t->receiver_name ?? '—' }}</div>
                        <div class="fin-ref">{{ $t->receiver_account ?? '—' }}</div>
                    </td>
                    <td class="fin-ref">{{ $t->reference_number ?? '—' }}</td>
                    <td style="max-width:140px;">{{ $t->note ?? '—' }}</td>
                    <td>
                        @php
                            $s = strtolower($t->status ?? '');
                            if ($s === 'pending')        $badge = 'fin-badge-pending';
                            elseif ($s === 'completed')  $badge = 'fin-badge-completed';
                            elseif ($s === 'failed')     $badge = 'fin-badge-failed';
                            else                         $badge = 'fin-badge-default';
                        @endphp
                        <span class="fin-badge {{ $badge }}">{{ $t->status ?? '—' }}</span>
                    </td>
                    <td style="text-align:center;">
                        @if($t->confidence_score)
                            {{ round($t->confidence_score * 100) }}%
                        @else —
                        @endif
                    </td>
                    <td>
                        @if($t->receipt_image)
                            <img src="{{ asset($t->receipt_image) }}" class="fin-img-thumb"
                                onclick="finOpenLightbox('{{ asset($t->receipt_image) }}')" alt="Receipt">
                        @else
                            <div class="fin-no-img"><i class="fas fa-image"></i></div>
                        @endif
                    </td>
                    <td style="white-space:nowrap;">
                        <div style="display:flex;gap:4px;">
                            <button type="button" class="fin-btn-edit"
                                onclick="finOpenEdit({{ json_encode($t) }})">
                                <i class="fas fa-pen"></i> Edit
                            </button>
                            <form method="POST" action="/admin/finance/bank-transactions/{{ $t->id }}"
                                onsubmit="return confirm('Delete this transaction? This cannot be undone.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="fin-btn-delete">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div style="margin-top:20px;">{{ $transactions->links() }}</div>
    @endif

</div>

{{-- Lightbox --}}
<div class="fin-lightbox" id="finLightbox" onclick="finCloseLightbox()">
    <span class="fin-lightbox-close" onclick="finCloseLightbox()">&times;</span>
    <img id="finLightboxImg" src="" alt="Receipt">
</div>

{{-- Edit Modal --}}
<div class="fin-modal-overlay" id="finEditModal">
    <div class="fin-modal" onclick="event.stopPropagation()">
        <div class="fin-modal-title">
            <i class="fas fa-pen" style="color:#ec4899;font-size:14px;"></i>
            Edit Transaction
        </div>
        <form method="POST" id="finEditForm">
            @csrf
            @method('PUT')
            <div class="fin-modal-grid">
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Bank</label>
                    <input type="text" name="bank" id="fe_bank" class="fin-modal-input browser-default" required>
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Platform Type</label>
                    <input type="text" name="platform_type" id="fe_platform_type" class="fin-modal-input browser-default">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Transaction Type</label>
                    <input type="text" name="transaction_type" id="fe_transaction_type" class="fin-modal-input browser-default" required>
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Amount</label>
                    <input type="number" step="0.01" name="amount" id="fe_amount" class="fin-modal-input browser-default" required>
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Date</label>
                    <input type="date" name="date" id="fe_date" class="fin-modal-input browser-default" onclick="try{this.showPicker()}catch(e){}">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Time</label>
                    <input type="text" name="time" id="fe_time" class="fin-modal-input browser-default" placeholder="HH:MM:SS">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Sender Name</label>
                    <input type="text" name="sender_name" id="fe_sender_name" class="fin-modal-input browser-default">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Receiver Name</label>
                    <input type="text" name="receiver_name" id="fe_receiver_name" class="fin-modal-input browser-default">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Receiver Account</label>
                    <input type="text" name="receiver_account" id="fe_receiver_account" class="fin-modal-input browser-default">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Reference Number</label>
                    <input type="text" name="reference_number" id="fe_reference_number" class="fin-modal-input browser-default">
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Status</label>
                    <select name="status" id="fe_status" class="fin-modal-select browser-default">
                        <option value="pending">Pending</option>
                        <option value="completed">Completed</option>
                        <option value="failed">Failed</option>
                    </select>
                </div>
                <div class="fin-modal-field">
                    <label class="fin-modal-label">Currency</label>
                    <input type="text" name="currency" id="fe_currency" class="fin-modal-input browser-default">
                </div>
                <div class="fin-modal-field full">
                    <label class="fin-modal-label">Note</label>
                    <input type="text" name="note" id="fe_note" class="fin-modal-input browser-default">
                </div>
            </div>
            <div class="fin-modal-footer">
                <button type="button" class="fin-modal-cancel" onclick="finCloseEdit()">Cancel</button>
                <button type="submit" class="fin-modal-save"><i class="fas fa-save" style="margin-right:5px;"></i>Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function finOpenLightbox(src) {
        document.getElementById('finLightboxImg').src = src;
        document.getElementById('finLightbox').classList.add('active');
    }
    function finCloseLightbox() {
        document.getElementById('finLightbox').classList.remove('active');
    }

    function finOpenEdit(t) {
        document.getElementById('finEditForm').action = '/admin/finance/bank-transactions/' + t.id;
        document.getElementById('fe_bank').value             = t.bank || '';
        document.getElementById('fe_platform_type').value    = t.platform_type || '';
        document.getElementById('fe_transaction_type').value = t.transaction_type || '';
        document.getElementById('fe_amount').value           = t.amount || '';
        document.getElementById('fe_date').value             = t.date || '';
        document.getElementById('fe_time').value             = t.time || '';
        document.getElementById('fe_sender_name').value      = t.sender_name || '';
        document.getElementById('fe_receiver_name').value    = t.receiver_name || '';
        document.getElementById('fe_receiver_account').value = t.receiver_account || '';
        document.getElementById('fe_reference_number').value = t.reference_number || '';
        document.getElementById('fe_status').value           = t.status || 'pending';
        document.getElementById('fe_currency').value         = t.currency || 'PHP';
        document.getElementById('fe_note').value             = t.note || '';
        document.getElementById('finEditModal').classList.add('active');
    }
    function finCloseEdit() {
        document.getElementById('finEditModal').classList.remove('active');
    }

    document.getElementById('finEditModal').addEventListener('click', function(e) {
        if (e.target === this) finCloseEdit();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { finCloseLightbox(); finCloseEdit(); }
    });
</script>

@endsection
