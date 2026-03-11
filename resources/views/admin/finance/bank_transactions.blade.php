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
            <input type="date" name="date_from" class="fin-date-input" value="{{ $dateFrom ?? '' }}" required>
            <span style="color:#9ca3af;font-size:12px;">to</span>
            <input type="date" name="date_to"   class="fin-date-input" value="{{ $dateTo ?? '' }}" required>
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
                        <div>{{ $t->bank }}</div>
                        <div>{{ $t->transaction_type }}</div>
                        <div style="font-size:11px;color:#9ca3af;">{{ $t->platform_type }}</div>
                    </td>
                    <td class="fin-amount">₱{{ number_format($t->amount, 0) }}</td>
                    <td>{{ $t->sender_name ?? '—' }}</td>
                    <td>
                        <div>{{ $t->receiver_name ?? '—' }}</div>
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

<script>
    function finOpenLightbox(src) {
        document.getElementById('finLightboxImg').src = src;
        document.getElementById('finLightbox').classList.add('active');
    }
    function finCloseLightbox() {
        document.getElementById('finLightbox').classList.remove('active');
    }
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') finCloseLightbox();
    });
</script>

@endsection
