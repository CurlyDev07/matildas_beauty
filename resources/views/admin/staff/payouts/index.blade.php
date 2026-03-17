@extends('admin.layouts.app')

@section('content')

<div style="max-width:860px;">

    @if(session('success'))
        <div style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:14px;font-weight:600;">
            <i class="fas fa-check-circle" style="margin-right:6px;"></i>{{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:14px;font-weight:600;">
            <i class="fas fa-exclamation-circle" style="margin-right:6px;"></i>{{ session('error') }}
        </div>
    @endif

    {{-- Header --}}
    <div style="margin-bottom:24px;">
        <div style="font-size:22px;font-weight:800;color:#0f172a;">Incentive Payouts</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:4px;">
            Release approved incentives every 15th and end of month.
            @if($pendingCount > 0)
            <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:2px 10px;font-size:12px;font-weight:700;margin-left:6px;">
                {{ $pendingCount }} approved &amp; unpaid
            </span>
            @endif
        </div>
    </div>

    {{-- New Release Form --}}
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:18px 20px;margin-bottom:20px;">
        <div style="font-size:13px;font-weight:700;color:#475569;margin-bottom:12px;">
            <i class="fas fa-paper-plane" style="color:#6366f1;margin-right:6px;"></i>New Release — Select Period
        </div>
        <form method="GET" action="{{ route('staff.payouts.preview') }}" style="display:flex;gap:10px;align-items:flex-end;flex-wrap:wrap;">
            <div>
                <div style="font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:4px;text-transform:uppercase;letter-spacing:.5px;">From</div>
                <input type="date" name="period_start" value="{{ $suggestStart }}" class="browser-default"
                    style="border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:13px;color:#0f172a;outline:none;">
            </div>
            <div>
                <div style="font-size:11px;font-weight:700;color:#94a3b8;margin-bottom:4px;text-transform:uppercase;letter-spacing:.5px;">To</div>
                <input type="date" name="period_end" value="{{ $suggestEnd }}" class="browser-default"
                    style="border:1px solid #e2e8f0;border-radius:8px;padding:8px 12px;font-size:13px;color:#0f172a;outline:none;">
            </div>
            <button type="submit"
                style="background:linear-gradient(135deg,#6366f1,#8b5cf6);color:#fff;border:none;border-radius:8px;padding:9px 20px;font-size:13px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:6px;">
                <i class="fas fa-eye"></i> Preview
            </button>
        </form>
    </div>

    {{-- Payout History --}}
    <div style="font-size:14px;font-weight:700;color:#475569;margin-bottom:10px;">
        <i class="fas fa-history" style="margin-right:6px;color:#94a3b8;"></i>Past Payouts
    </div>

    @forelse($payouts as $payout)
    <div style="background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:14px 18px;margin-bottom:8px;display:flex;align-items:center;gap:14px;">

        {{-- Label --}}
        <div style="flex:1;min-width:0;">
            <div style="font-size:14px;font-weight:700;color:#0f172a;">{{ $payout->label }}</div>
            <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                {{ $payout->period_start->format('M d') }} – {{ $payout->period_end->format('M d, Y') }}
            </div>
        </div>

        {{-- Entry count --}}
        <div style="text-align:center;flex-shrink:0;">
            <div style="font-size:18px;font-weight:800;color:#0f172a;">{{ $payout->entries_count }}</div>
            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">entries</div>
        </div>

        {{-- Total --}}
        <div style="background:#f0fdf4;border-radius:10px;padding:8px 14px;flex-shrink:0;text-align:center;">
            <div style="font-size:18px;font-weight:800;color:#059669;">₱{{ number_format($payout->total_amount, 0) }}</div>
            <div style="font-size:10px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.5px;">total</div>
        </div>

        {{-- Released by / when --}}
        <div style="text-align:right;flex-shrink:0;">
            <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $payout->releasedBy->first_name ?? '' }} {{ $payout->releasedBy->last_name ?? '' }}</div>
            <div style="font-size:11px;color:#94a3b8;">{{ $payout->released_at->format('M d, Y') }}</div>
        </div>

        {{-- View link --}}
        <a href="{{ route('staff.payouts.show', $payout->id) }}"
            style="background:#ede9fe;border:1px solid #c4b5fd;color:#7c3aed;border-radius:8px;padding:7px 14px;font-size:12px;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0;display:flex;align-items:center;gap:5px;">
            <i class="fas fa-list-ul" style="font-size:11px;"></i> View
        </a>

    </div>
    @empty
    <div style="text-align:center;padding:64px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
        <i class="fas fa-money-check-alt" style="font-size:40px;display:block;margin-bottom:14px;color:#e2e8f0;"></i>
        <div style="font-size:16px;font-weight:700;color:#0f172a;">No payouts released yet.</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:6px;">Use the form above to preview and release the first payout.</div>
    </div>
    @endforelse

</div>

@endsection
