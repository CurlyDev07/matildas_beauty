@extends('admin.layouts.app')

@section('content')

@php
$typeConfig = [
    'Upsell'  => ['bg' => '#fee2e2', 'border' => '#fca5a5', 'text' => '#b91c1c', 'icon' => 'fa-arrow-up',  'grad' => 'linear-gradient(135deg,#ef4444,#dc2626)'],
    'InfoTxt' => ['bg' => '#dbeafe', 'border' => '#93c5fd', 'text' => '#1d4ed8', 'icon' => 'fa-comment-alt',         'grad' => 'linear-gradient(135deg,#3b82f6,#2563eb)'],
    'Pancake' => ['bg' => '#fef9c3', 'border' => '#fde047', 'text' => '#92400e', 'icon' => 'fa-layer-group',     'grad' => 'linear-gradient(135deg,#eab308,#ca8a04)'],
    'Events'  => ['bg' => '#dcfce7', 'border' => '#86efac', 'text' => '#15803d', 'icon' => 'fa-calendar-check',  'grad' => 'linear-gradient(135deg,#22c55e,#16a34a)'],
];
@endphp

<div style="max-width:560px;">

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:14px;font-weight:600;">
            <i class="fas fa-check-circle" style="margin-right:6px;"></i>{{ session('success') }}
        </div>
    @endif

    {{-- Header --}}
    <div style="margin-bottom:24px;">
        <div style="font-size:22px;font-weight:800;color:#0f172a;">Incentive Rates</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:4px;">PHP earnings per entry, per type. Changes take effect immediately.</div>
    </div>

    {{-- Rate cards --}}
    @foreach($rates as $rate)
    @php $c = $typeConfig[$rate->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag','grad'=>'#94a3b8']; @endphp
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;margin-bottom:12px;display:flex;align-items:center;gap:16px;">

        {{-- Icon --}}
        <div style="width:42px;height:42px;border-radius:10px;background:{{ $c['grad'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;">
            <i class="fas {{ $c['icon'] }}" style="color:#fff;font-size:16px;"></i>
        </div>

        {{-- Label --}}
        <div style="flex:1;">
            <div style="font-size:15px;font-weight:800;color:#0f172a;">{{ $rate->type }}</div>
            <div style="font-size:12px;color:#94a3b8;margin-top:2px;">per entry</div>
        </div>

        {{-- Inline edit form --}}
        <form method="POST" action="{{ route('staff.incentive_rates.update', $rate->type) }}"
            style="display:flex;align-items:center;gap:8px;">
            @csrf
            @method('PUT')
            <div style="display:flex;align-items:center;background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};border-radius:10px;padding:6px 12px;gap:4px;">
                <span style="font-size:14px;font-weight:700;color:{{ $c['text'] }};">₱</span>
                <input type="number" name="rate" value="{{ number_format($rate->rate, 2, '.', '') }}"
                    min="0" step="0.01"
                    style="width:80px;border:none;background:transparent;font-size:16px;font-weight:800;color:{{ $c['text'] }};outline:none;text-align:right;">
            </div>
            <button type="submit"
                style="background:{{ $c['grad'] }};color:#fff;border:none;border-radius:8px;padding:8px 14px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;">
                Save
            </button>
        </form>

    </div>
    @endforeach

</div>

@endsection
