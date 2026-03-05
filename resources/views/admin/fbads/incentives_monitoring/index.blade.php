@extends('admin.fbads.layouts')

@section('page')

@php
$typeColors = [
    'Upsell'  => ['bg' => '#fee2e2', 'border' => '#fca5a5', 'text' => '#b91c1c', 'icon' => 'fa-arrow-trend-up'],
    'InfoTxt' => ['bg' => '#dbeafe', 'border' => '#93c5fd', 'text' => '#1d4ed8', 'icon' => 'fa-message'],
    'Pancake' => ['bg' => '#fef9c3', 'border' => '#fde047', 'text' => '#92400e', 'icon' => 'fa-layer-group'],
    'Events'  => ['bg' => '#dcfce7', 'border' => '#86efac', 'text' => '#15803d', 'icon' => 'fa-calendar-check'],
];
@endphp

<div style="max-width:640px;margin:0 auto;padding:24px 0;">

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:14px;font-weight:600;">
            {{ session('success') }}
        </div>
    @endif

    <!-- Header bar -->
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:16px;">
        <div>
            <div style="font-size:20px;font-weight:800;color:#0f172a;">Incentive Entries</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:2px;">{{ $entries->count() }} total entries</div>
        </div>
        <a href="{{ route('fbads.incentives.create') }}"
            style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border-radius:10px;padding:10px 18px;font-size:14px;font-weight:700;text-decoration:none;display:flex;align-items:center;gap:6px;">
            <i class="fas fa-plus"></i> New Entry
        </a>
    </div>

    <!-- Entries list -->
    @forelse($entries as $entry)
        @php $c = $typeColors[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:14px 16px;margin-bottom:10px;display:flex;align-items:flex-start;gap:12px;">
            <!-- Type badge -->
            <div style="flex-shrink:0;padding-top:2px;">
                <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:13px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;">
                    <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i>
                    {{ $entry->type }}
                </span>
            </div>

            <!-- Info -->
            <div style="flex:1;min-width:0;">
                <div style="display:flex;align-items:center;gap:8px;flex-wrap:wrap;">
                    <span style="font-size:14px;font-weight:700;color:#0f172a;">
                        {{ $entry->user->first_name ?? '' }} {{ $entry->user->last_name ?? '' }}
                    </span>
                    <span style="font-size:12px;color:#94a3b8;">
                        <i class="fas fa-clock" style="margin-right:3px;"></i>{{ $entry->created_at->format('M d, Y g:i A') }}
                    </span>
                </div>
                <div style="font-size:14px;color:#475569;margin-top:4px;">
                    <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;"></i>{{ $entry->customer_mobile }}
                </div>
            </div>

            <!-- Actions (master only) -->
            @if(auth()->user()->isMaster())
            <div style="display:flex;gap:6px;flex-shrink:0;">
                <a href="{{ route('fbads.incentives.edit', $entry->id) }}"
                    style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:6px 10px;font-size:12px;text-decoration:none;display:flex;align-items:center;gap:4px;">
                    <i class="fas fa-pen"></i>
                </a>
                <form method="POST" action="{{ route('fbads.incentives.destroy', $entry->id) }}"
                    onsubmit="return confirm('Delete this entry?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:6px 10px;font-size:12px;cursor:pointer;display:flex;align-items:center;gap:4px;">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
            @endif
        </div>
    @empty
        <div style="text-align:center;padding:64px 24px;color:#94a3b8;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
            <i class="fas fa-inbox" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0;"></i>
            <div style="font-size:15px;font-weight:600;color:#cbd5e1;">No entries yet</div>
            <div style="font-size:13px;margin-top:6px;">
                <a href="{{ route('fbads.incentives.create') }}" style="color:#6366f1;text-decoration:none;font-weight:600;">Create the first one</a>
            </div>
        </div>
    @endforelse

</div>

@endsection
