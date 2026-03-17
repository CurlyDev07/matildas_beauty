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

<div style="max-width:860px;">

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:14px;font-weight:600;">
            <i class="fas fa-check-circle" style="margin-right:6px;"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div style="margin-bottom:24px;">
        <div style="font-size:22px;font-weight:800;color:#0f172a;">Verify Incentives</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:4px;">
            Delivered entries pending your approval.
            <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:2px 10px;font-size:12px;font-weight:700;margin-left:6px;">
                {{ $entries->count() }} pending
            </span>
        </div>
    </div>

    @forelse($entries as $entry)
    @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:14px 18px;margin-bottom:10px;display:flex;align-items:center;gap:14px;">

        {{-- Type badge --}}
        <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
            <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i>
            {{ $entry->type }}
        </span>

        {{-- Mobile --}}
        <div style="flex:1;min-width:0;">
            <div style="font-size:14px;font-weight:700;color:#0f172a;">
                <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
            </div>
            <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                By {{ $entry->user->first_name ?? '' }} {{ $entry->user->last_name ?? '' }}
            </div>
        </div>

        {{-- Delivered badge --}}
        <span style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;flex-shrink:0;">
            <i class="fas fa-truck" style="font-size:10px;margin-right:4px;"></i>Delivered
        </span>

        {{-- Date --}}
        <div style="text-align:right;flex-shrink:0;">
            <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
            <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
        </div>

        {{-- Approve button --}}
        <form method="POST" action="{{ route('staff.incentive_approvals.approve', $entry->id) }}">
            @csrf
            <button type="submit"
                style="background:linear-gradient(135deg,#22c55e,#16a34a);color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                <i class="fas fa-check"></i> Approve
            </button>
        </form>

    </div>
    @empty
    <div style="text-align:center;padding:64px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
        <i class="fas fa-clipboard-check" style="font-size:40px;display:block;margin-bottom:14px;color:#86efac;"></i>
        <div style="font-size:16px;font-weight:700;color:#0f172a;">All clear!</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:6px;">No delivered incentives pending approval.</div>
    </div>
    @endforelse

</div>

@endsection
