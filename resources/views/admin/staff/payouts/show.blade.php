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

    {{-- Back --}}
    <a href="{{ route('staff.payouts.index') }}"
        style="font-size:12px;color:#94a3b8;text-decoration:none;display:inline-flex;align-items:center;gap:5px;margin-bottom:16px;">
        <i class="fas fa-arrow-left" style="font-size:10px;"></i> Back to Payouts
    </a>

    {{-- Payout header card --}}
    <div style="background:linear-gradient(135deg,#6366f1,#8b5cf6);border-radius:16px;padding:20px 24px;margin-bottom:20px;">
        <div style="font-size:20px;font-weight:800;color:#fff;">{{ $payout->label }}</div>
        <div style="font-size:13px;color:rgba(255,255,255,.7);margin-top:3px;">
            {{ $payout->period_start->format('M d, Y') }} – {{ $payout->period_end->format('M d, Y') }}
        </div>
        <div style="display:flex;gap:20px;margin-top:16px;flex-wrap:wrap;">
            <div>
                <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;">Staff</div>
                <div style="font-size:26px;font-weight:800;color:#fff;line-height:1.1;">{{ $byUser->count() }}</div>
            </div>
            <div>
                <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;">Entries</div>
                <div style="font-size:26px;font-weight:800;color:#fff;line-height:1.1;">{{ $payout->entries->count() }}</div>
            </div>
            <div>
                <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;">Grand Total</div>
                <div style="font-size:26px;font-weight:800;color:#fff;line-height:1.1;">₱{{ number_format($payout->total_amount, 0) }}</div>
            </div>
            <div style="margin-left:auto;text-align:right;">
                <div style="font-size:10px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.5px;">Released by</div>
                <div style="font-size:13px;font-weight:700;color:#fff;margin-top:2px;">{{ $payout->releasedBy->first_name ?? '' }} {{ $payout->releasedBy->last_name ?? '' }}</div>
                <div style="font-size:11px;color:rgba(255,255,255,.6);">{{ $payout->released_at->format('M d, Y · g:i A') }}</div>
            </div>
        </div>
    </div>

    {{-- Per-staff breakdown --}}
    <div style="font-size:14px;font-weight:700;color:#475569;margin-bottom:10px;">
        <i class="fas fa-users" style="margin-right:6px;color:#94a3b8;"></i>Staff Breakdown
    </div>

    @foreach($byUser as $row)
    @php $user = $row['user']; @endphp
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:16px 18px;margin-bottom:8px;">

        <div style="display:flex;align-items:center;gap:14px;">

            {{-- Name & type badges --}}
            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:700;color:#0f172a;">
                    {{ $user->first_name ?? '' }} {{ $user->last_name ?? '' }}
                </div>
                <div style="display:flex;flex-wrap:wrap;gap:5px;margin-top:6px;">
                    @foreach($row['byType'] as $type => $count)
                    @php $tc = $typeConfig[$type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
                    <span style="background:{{ $tc['bg'] }};border:1px solid {{ $tc['border'] }};color:{{ $tc['text'] }};border-radius:6px;padding:3px 9px;font-size:11px;font-weight:700;">
                        <i class="fas {{ $tc['icon'] }}" style="font-size:9px;margin-right:2px;"></i>{{ $type }} × {{ $count }}
                        <span style="opacity:.7;margin-left:3px;">₱{{ number_format($row['byTypeEarned'][$type] ?? 0, 0) }}</span>
                    </span>
                    @endforeach
                </div>
            </div>

            {{-- Their total --}}
            <div style="background:#f0fdf4;border:1px solid #86efac;border-radius:10px;padding:10px 16px;flex-shrink:0;text-align:center;">
                <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">Payout</div>
                <div style="font-size:20px;font-weight:800;color:#059669;">₱{{ number_format($row['total'], 0) }}</div>
            </div>

        </div>

    </div>
    @endforeach

</div>

@endsection
