@extends('admin.layouts.app')

@section('content')

@php
$typeConfig = [
    'Upsell'  => ['bg' => '#fee2e2', 'border' => '#fca5a5', 'text' => '#b91c1c', 'icon' => 'fa-arrow-up'],
    'InfoTxt' => ['bg' => '#dbeafe', 'border' => '#93c5fd', 'text' => '#1d4ed8', 'icon' => 'fa-comment-alt'],
    'Pancake' => ['bg' => '#fef9c3', 'border' => '#fde047', 'text' => '#92400e', 'icon' => 'fa-layer-group'],
    'Events'  => ['bg' => '#dcfce7', 'border' => '#86efac', 'text' => '#15803d', 'icon' => 'fa-calendar-check'],
];
@endphp

<div style="max-width:700px;">

    {{-- Header --}}
    <div style="margin-bottom:20px;">
        <a href="{{ route('staff.payouts.index') }}"
            style="font-size:12px;color:#94a3b8;text-decoration:none;display:inline-flex;align-items:center;gap:5px;margin-bottom:10px;">
            <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Payouts
        </a>
        <div style="font-size:22px;font-weight:800;color:#0f172a;">Payout Preview</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:4px;">
            Period: <strong style="color:#0f172a;">{{ \Carbon\Carbon::parse($periodStart)->format('M d, Y') }} – {{ \Carbon\Carbon::parse($periodEnd)->format('M d, Y') }}</strong>
        </div>
    </div>

    @if($byUser->isEmpty())
    <div style="text-align:center;padding:64px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;margin-bottom:20px;">
        <i class="fas fa-inbox" style="font-size:40px;display:block;margin-bottom:14px;color:#e2e8f0;"></i>
        <div style="font-size:16px;font-weight:700;color:#0f172a;">No approved unpaid entries</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:6px;">There are no approved entries without a payout in this period.</div>
    </div>
    @else

    {{-- Summary bar --}}
    <div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:14px;padding:16px 20px;margin-bottom:20px;display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
        <div style="flex:1;min-width:120px;">
            <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.5px;">Staff</div>
            <div style="font-size:28px;font-weight:800;color:#fff;line-height:1.1;">{{ $byUser->count() }}</div>
        </div>
        <div style="flex:1;min-width:120px;">
            <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.5px;">Entries</div>
            <div style="font-size:28px;font-weight:800;color:#fff;line-height:1.1;">{{ $entryCount }}</div>
        </div>
        <div style="flex:1;min-width:120px;">
            <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.7);text-transform:uppercase;letter-spacing:.5px;">Grand Total</div>
            <div style="font-size:28px;font-weight:800;color:#fff;line-height:1.1;">₱{{ number_format($grandTotal, 0) }}</div>
        </div>
    </div>

    {{-- Per-staff breakdown --}}
    @foreach($byUser as $row)
    @php $user = $row['user']; @endphp
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 18px;margin-bottom:8px;display:flex;align-items:center;gap:14px;">

        {{-- Name --}}
        <div style="flex:1;min-width:0;">
            <div style="font-size:14px;font-weight:700;color:#0f172a;">
                {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
            </div>
            <div style="display:flex;flex-wrap:wrap;gap:5px;margin-top:6px;">
                @foreach($row['byType'] as $type => $count)
                @php $tc = $typeConfig[$type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
                <span style="background:{{ $tc['bg'] }};border:1px solid {{ $tc['border'] }};color:{{ $tc['text'] }};border-radius:6px;padding:2px 8px;font-size:11px;font-weight:700;">
                    <i class="fas {{ $tc['icon'] }}" style="font-size:9px;margin-right:2px;"></i>{{ $type }} × {{ $count }}
                </span>
                @endforeach
            </div>
        </div>

        {{-- Amount --}}
        <div style="background:#f0fdf4;border-radius:10px;padding:8px 14px;flex-shrink:0;text-align:center;">
            <div style="font-size:18px;font-weight:800;color:#059669;">₱{{ number_format($row['total'], 0) }}</div>
        </div>

    </div>
    @endforeach

    {{-- Confirm button --}}
    <div style="margin-top:20px;background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;">
        <div style="font-size:13px;color:#64748b;margin-bottom:14px;">
            Releasing this payout will mark all <strong>{{ $entryCount }} entries</strong> as paid and cannot be undone for this period.
        </div>
        <form method="POST" action="{{ route('staff.payouts.release') }}" style="display:flex;gap:10px;flex-wrap:wrap;">
            @csrf
            <input type="hidden" name="period_start" value="{{ $periodStart }}">
            <input type="hidden" name="period_end"   value="{{ $periodEnd }}">
            <button type="submit"
                style="background:linear-gradient(135deg,#22c55e,#16a34a);color:#fff;border:none;border-radius:8px;padding:10px 24px;font-size:14px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:6px;">
                <i class="fas fa-paper-plane"></i> Confirm &amp; Release — ₱{{ number_format($grandTotal, 0) }}
            </button>
            <a href="{{ route('staff.payouts.index') }}"
                style="background:#f1f5f9;color:#64748b;border-radius:8px;padding:10px 18px;font-size:13px;font-weight:600;text-decoration:none;display:flex;align-items:center;">
                Cancel
            </a>
        </form>
    </div>

    @endif

</div>

@endsection
