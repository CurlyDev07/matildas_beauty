@extends('admin.packaging.layouts')

@section('page')

<div class="pkg-card">
    <!-- Header -->
    <div class="pkg-header">
        <span class="pkg-title">
            <i class="fas fa-history" style="color:#7c3aed;"></i>
            Stock Movements
        </span>
        <span style="font-size:13px;color:#94a3b8;">Combined history of all purchases and stock outs</span>
    </div>

    <!-- Legend -->
    <div style="display:flex;gap:16px;padding:12px 18px;border-bottom:1px solid #f1f5f9;flex-wrap:wrap;">
        <div style="display:flex;align-items:center;gap:6px;font-size:13px;color:#475569;">
            <span style="width:12px;height:12px;border-radius:3px;background:#fee2e2;border:1px solid #fca5a5;display:inline-block;"></span>
            Stock In (Purchase)
        </div>
        <div style="display:flex;align-items:center;gap:6px;font-size:13px;color:#475569;">
            <span style="width:12px;height:12px;border-radius:3px;background:#dcfce7;border:1px solid #86efac;display:inline-block;"></span>
            Stock Out (Usage)
        </div>
    </div>

    <!-- Movement cards -->
    <div style="padding:16px 18px;">
        @forelse($movements as $m)
            @php
                $isIn     = $m['type'] === 'stock_in';
                $bgColor  = $isIn ? '#fff5f5'   : '#f0fdf4';
                $bdColor  = $isIn ? '#fca5a5'   : '#86efac';
                $tagBg    = $isIn ? '#fee2e2'   : '#dcfce7';
                $tagText  = $isIn ? '#b91c1c'   : '#15803d';
                $icon     = $isIn ? 'fa-arrow-down' : 'fa-arrow-up';
                $label    = $isIn ? 'Stock In'  : 'Stock Out';
            @endphp
            <div style="background:{{ $bgColor }};border:1px solid {{ $bdColor }};border-radius:12px;padding:14px 16px;margin-bottom:10px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:10px;flex-wrap:wrap;">
                    <!-- Type badge -->
                    <span style="background:{{ $tagBg }};color:{{ $tagText }};border:1px solid {{ $bdColor }};border-radius:99px;padding:3px 12px;font-size:12px;font-weight:800;display:flex;align-items:center;gap:5px;">
                        <i class="fas {{ $icon }}" style="font-size:10px;"></i> {{ $label }}
                    </span>
                    <!-- Date -->
                    <span style="font-size:14px;font-weight:700;color:#0f172a;">
                        {{ \Carbon\Carbon::parse($m['date'])->format('M d, Y') }}
                    </span>
                    @if($m['ref'])
                        <span style="font-size:12px;color:#94a3b8;">{{ $m['ref'] }}</span>
                    @endif
                    @if($m['notes'])
                        <span style="font-size:12px;color:#64748b;font-style:italic;">{{ $m['notes'] }}</span>
                    @endif
                </div>
                <!-- Items -->
                <div style="display:flex;flex-wrap:wrap;gap:6px;">
                    @foreach($m['items'] as $item)
                        <span style="background:#fff;border:1px solid {{ $bdColor }};border-radius:8px;padding:4px 10px;font-size:13px;color:#0f172a;">
                            <b>{{ $item['name'] }}</b>: {{ number_format($item['qty'], 0) }}{{ $item['unit'] ? ' ' . $item['unit'] : '' }}
                        </span>
                    @endforeach
                </div>
            </div>
        @empty
            <div style="text-align:center;padding:48px;color:#94a3b8;">
                <i class="fas fa-history" style="font-size:32px;display:block;margin-bottom:10px;color:#e2e8f0;"></i>
                No movements recorded yet.
            </div>
        @endforelse
    </div>
</div>

@endsection
