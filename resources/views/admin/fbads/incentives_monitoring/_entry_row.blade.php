<div data-entry-row style="background:#fff;border:1px solid {{ $isDup ? '#fde68a' : '#e2e8f0' }};border-radius:12px;padding:12px 14px;margin-bottom:8px;display:flex;align-items:center;gap:10px;">

    {{-- Type badge --}}
    <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
        <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i>
        {{ $entry->type }}
    </span>

    {{-- Mobile --}}
    <span style="font-size:14px;color:#0f172a;font-weight:600;flex:1;min-width:0;">
        <span style="display:block;">
            <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
        </span>
        @if($entry->invalid && $entry->invalid_note)
            <span style="display:block;margin-top:5px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;border-radius:8px;padding:6px 8px;font-size:12px;font-weight:600;line-height:1.35;">
                <i class="fas fa-sticky-note" style="margin-right:5px;"></i>{{ $entry->invalid_note }}
            </span>
        @endif
    </span>

    {{-- DUP badge --}}
    @if($isDup)
    <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:6px;padding:2px 8px;font-size:10px;font-weight:800;flex-shrink:0;white-space:nowrap;">
        <i class="fas fa-exclamation-triangle" style="font-size:9px;margin-right:2px;"></i>DUP
    </span>
    @endif

    {{-- Status badge --}}
    @if($entry->payout_id)
    <span style="background:#f0fdfa;border:1px solid #99f6e4;color:#0d9488;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
        <i class="fas fa-money-bill-wave" style="font-size:10px;margin-right:3px;"></i>Paid &middot; {{ $entry->payout->label ?? '' }}
    </span>
    @elseif($entry->invalid)
    <span style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
        <i class="fas fa-ban" style="font-size:10px;margin-right:3px;"></i>Invalid
    </span>
    @elseif($entry->approved)
    <span style="background:#ede9fe;border:1px solid #c4b5fd;color:#7c3aed;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
        <i class="fas fa-check-double" style="font-size:10px;margin-right:3px;"></i>Approved
    </span>
    @elseif($entry->delivery_status === 'delivered')
    <span style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
        <i class="fas fa-truck" style="font-size:10px;margin-right:3px;"></i>Delivered
    </span>
    @elseif($entry->delivery_status === 'shipped')
    <span style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;flex-shrink:0;white-space:nowrap;">
        <i class="fas fa-shipping-fast" style="font-size:10px;margin-right:3px;"></i>Shipped
    </span>
    @endif

    {{-- Date --}}
    <div style="text-align:right;flex-shrink:0;">
        <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
        <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
    </div>

    {{-- Actions --}}
    @php $isMaster = auth()->user()->isMaster(); $tab = $tab ?? 'new'; @endphp
    <div style="display:flex;gap:4px;flex-shrink:0;margin-left:4px;">

        {{-- Mark Delivered — only if not yet delivered/approved (New tab only) --}}
        @if($tab === 'new' && !$entry->delivery_status && !$entry->approved && !$entry->payout_id)
        <button type="button" title="Mark as Delivered"
            class="btn-deliver"
            data-id="{{ $entry->id }}"
            data-url="{{ route('fbads.incentives.deliver', $entry->id) }}"
            style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
            <i class="fas fa-truck"></i>
        </button>
        @endif

        {{-- Mark Returned — master only, not on returned/approved/paid tabs --}}
        @if($isMaster && !in_array($tab, ['returned','approved','paid']) && !$entry->approved && !$entry->payout_id && $entry->delivery_status !== 'returned')
        <form method="POST" action="{{ route('fbads.incentives.return', $entry->id) }}" onsubmit="return confirm('Mark this entry as returned? It will no longer be eligible for payout.')">
            @csrf
            <button type="submit" title="Mark as Returned"
                style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
                <i class="fas fa-undo-alt"></i>
            </button>
        </form>
        @endif

        {{-- Edit — master only, not on returned tab --}}
        @if($isMaster && $tab !== 'returned')
        <a href="{{ route('fbads.incentives.edit', $entry->id) }}"
            style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:7px;padding:6px 9px;font-size:11px;text-decoration:none;display:flex;align-items:center;">
            <i class="fas fa-pen"></i>
        </a>
        @endif

        {{-- Delete — master only on delivered/approved/paid/returned; anyone on new --}}
        @if($tab === 'new' || $isMaster)
        @if($tab !== 'returned')
        <form method="POST" action="{{ route('fbads.incentives.destroy', $entry->id) }}" onsubmit="return confirm('Delete this entry?')">
            @csrf
            @method('DELETE')
            <button type="submit" style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:7px;padding:6px 9px;font-size:11px;cursor:pointer;display:flex;align-items:center;">
                <i class="fas fa-trash"></i>
            </button>
        </form>
        @endif
        @endif

    </div>

</div>
