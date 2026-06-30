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

<div style="max-width:960px;">

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
    <div style="margin-bottom:20px;">
        <div style="font-size:22px;font-weight:800;color:#0f172a;">Verify Incentives</div>
        <div style="font-size:13px;color:#94a3b8;margin-top:4px;">Review delivered entries and manage approvals.</div>
    </div>

    {{-- Tab bar --}}
    <div style="display:flex;gap:6px;margin-bottom:20px;border-bottom:2px solid #f1f5f9;padding-bottom:0;">
        <button onclick="switchTab('pending')" id="tab-pending"
            style="padding:9px 20px;font-size:13px;font-weight:700;border:none;background:none;cursor:pointer;border-bottom:3px solid #ec4899;margin-bottom:-2px;color:#be185d;">
            To Approve
            <span id="badge-pending" style="background:#fef9c3;border:1px solid #fde047;color:#92400e;border-radius:8px;padding:1px 8px;font-size:11px;font-weight:700;margin-left:6px;">{{ $entries->count() }}</span>
        </button>
        <button onclick="switchTab('approved')" id="tab-approved"
            style="padding:9px 20px;font-size:13px;font-weight:700;border:none;background:none;cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-2px;color:#94a3b8;">
            Approved
            <span style="background:#ede9fe;border:1px solid #c4b5fd;color:#7c3aed;border-radius:8px;padding:1px 8px;font-size:11px;font-weight:700;margin-left:6px;">{{ $approvedEntries->count() }}</span>
        </button>
        <button onclick="switchTab('invalid')" id="tab-invalid"
            style="padding:9px 20px;font-size:13px;font-weight:700;border:none;background:none;cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-2px;color:#94a3b8;">
            Invalid
            <span style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:1px 8px;font-size:11px;font-weight:700;margin-left:6px;">{{ $invalidEntries->count() }}</span>
        </button>
        <button onclick="switchTab('returned')" id="tab-returned"
            style="padding:9px 20px;font-size:13px;font-weight:700;border:none;background:none;cursor:pointer;border-bottom:3px solid transparent;margin-bottom:-2px;color:#94a3b8;">
            Returned
            <span style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:1px 8px;font-size:11px;font-weight:700;margin-left:6px;">{{ $returnedEntries->count() }}</span>
        </button>
    </div>

    {{-- ===== TAB: To Approve ===== --}}
    <div id="panel-pending">
        @forelse($entries as $entry)
        @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:14px 18px;margin-bottom:10px;display:flex;align-items:center;gap:14px;">

            <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
                <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i> {{ $entry->type }}
            </span>

            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:700;color:#0f172a;">
                    <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
                </div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                    By {{ $entry->user->first_name ?? '' }} {{ $entry->user->last_name ?? '' }}
                </div>
            </div>

            <span style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;flex-shrink:0;">
                <i class="fas fa-truck" style="font-size:10px;margin-right:4px;"></i>Delivered
            </span>

            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
                <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
            </div>

            <form method="POST" action="{{ route('staff.incentive_approvals.approve', $entry->id) }}">
                @csrf
                <button type="submit"
                    style="background:linear-gradient(135deg,#22c55e,#16a34a);color:#fff;border:none;border-radius:8px;padding:8px 16px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-check"></i> Approve
                </button>
            </form>

            <form method="POST" action="{{ route('staff.incentive_approvals.invalid', $entry->id) }}"
                onsubmit="return setInvalidNote(this, 'Mark this incentive as invalid? This will keep it unapproved.')">
                @csrf
                <input type="hidden" name="invalid_note" class="invalid-note-input">
                <button type="submit"
                    style="background:#fff;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-ban"></i> Invalid
                </button>
            </form>

            <form method="POST" action="{{ route('staff.incentive_approvals.returned', $entry->id) }}"
                onsubmit="return confirm('Mark this incentive as returned? This will keep it unapproved.')">
                @csrf
                <button type="submit"
                    style="background:#fff;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-undo"></i> Returned
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

    {{-- ===== TAB: Approved ===== --}}
    <div id="panel-approved" style="display:none;">
        @if($approvedEntries->isEmpty())
        <div style="text-align:center;padding:64px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
            <i class="fas fa-check-double" style="font-size:40px;display:block;margin-bottom:14px;color:#c4b5fd;"></i>
            <div style="font-size:16px;font-weight:700;color:#0f172a;">No approved entries yet.</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:6px;">Approved entries that haven't been paid out will appear here.</div>
        </div>
        @else
        <div style="font-size:12px;color:#94a3b8;margin-bottom:12px;">Approved but not yet included in a payout. You can still mark them unapproved.</div>
        @foreach($approvedEntries as $entry)
        @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
        <div style="background:#fff;border:1px solid #e2e8f0;border-radius:14px;padding:14px 18px;margin-bottom:8px;display:flex;align-items:center;gap:14px;">

            <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
                <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i> {{ $entry->type }}
            </span>

            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:700;color:#0f172a;">
                    <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
                </div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                    By {{ $entry->user->first_name ?? '' }} {{ $entry->user->last_name ?? '' }}
                </div>
            </div>

            <span style="background:#ede9fe;border:1px solid #c4b5fd;color:#7c3aed;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;flex-shrink:0;">
                <i class="fas fa-check-double" style="font-size:10px;margin-right:3px;"></i>Approved
            </span>

            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
                <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
            </div>

            <form method="POST" action="{{ route('staff.incentive_approvals.disapprove', $entry->id) }}"
                onsubmit="return confirm('Mark this incentive as unapproved?')">
                @csrf
                <button type="submit"
                    style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border:none;border-radius:8px;padding:8px 14px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-times-circle"></i> Unapprove
                </button>
            </form>

            <form method="POST" action="{{ route('staff.incentive_approvals.invalid', $entry->id) }}"
                onsubmit="return setInvalidNote(this, 'Mark this approved incentive as invalid? This will remove approval.')">
                @csrf
                <input type="hidden" name="invalid_note" class="invalid-note-input">
                <button type="submit"
                    style="background:#fff;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-ban"></i> Invalid
                </button>
            </form>

            <form method="POST" action="{{ route('staff.incentive_approvals.returned', $entry->id) }}"
                onsubmit="return confirm('Mark this approved incentive as returned? This will remove approval.')">
                @csrf
                <button type="submit"
                    style="background:#fff;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-undo"></i> Returned
                </button>
            </form>

        </div>
        @endforeach
        @endif
    </div>

    {{-- ===== TAB: Invalid ===== --}}
    <div id="panel-invalid" style="display:none;">
        @if($invalidEntries->isEmpty())
        <div style="text-align:center;padding:64px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
            <i class="fas fa-ban" style="font-size:40px;display:block;margin-bottom:14px;color:#fca5a5;"></i>
            <div style="font-size:16px;font-weight:700;color:#0f172a;">No invalid entries.</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:6px;">Entries marked invalid will appear here.</div>
        </div>
        @else
        <div style="font-size:12px;color:#94a3b8;margin-bottom:12px;">Invalid entries are automatically unapproved. Restore them to valid if they should return to normal review.</div>
        @foreach($invalidEntries as $entry)
        @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
        <div style="background:#fff;border:1px solid #fecaca;border-radius:14px;padding:14px 18px;margin-bottom:8px;display:flex;align-items:center;gap:14px;">

            <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
                <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i> {{ $entry->type }}
            </span>

            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:700;color:#0f172a;">
                    <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
                </div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                    By {{ $entry->user->first_name ?? '' }} {{ $entry->user->last_name ?? '' }}
                </div>
                @if($entry->invalid_note)
                    <div style="margin-top:6px;background:#fff1f2;border:1px solid #fecdd3;color:#9f1239;border-radius:8px;padding:7px 9px;font-size:12px;font-weight:600;line-height:1.35;">
                        <i class="fas fa-sticky-note" style="margin-right:5px;"></i>{{ $entry->invalid_note }}
                    </div>
                @endif
            </div>

            <span style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;flex-shrink:0;">
                <i class="fas fa-ban" style="font-size:10px;margin-right:3px;"></i>Invalid
            </span>

            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
                <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
            </div>

            <form method="POST" action="{{ route('staff.incentive_approvals.valid', $entry->id) }}"
                onsubmit="return confirm('Restore this incentive to valid?')">
                @csrf
                <button type="submit"
                    style="background:#dcfce7;border:1px solid #86efac;color:#15803d;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:700;cursor:pointer;white-space:nowrap;display:flex;align-items:center;gap:5px;">
                    <i class="fas fa-redo"></i> Restore Valid
                </button>
            </form>

        </div>
        @endforeach
        @endif
    </div>

    {{-- ===== TAB: Returned ===== --}}
    <div id="panel-returned" style="display:none;">
        @if($returnedEntries->isEmpty())
        <div style="text-align:center;padding:64px 24px;background:#fff;border-radius:14px;border:1px solid #e2e8f0;">
            <i class="fas fa-undo" style="font-size:40px;display:block;margin-bottom:14px;color:#fca5a5;"></i>
            <div style="font-size:16px;font-weight:700;color:#0f172a;">No returned entries.</div>
            <div style="font-size:13px;color:#94a3b8;margin-top:6px;">Entries marked returned will appear here.</div>
        </div>
        @else
        <div style="font-size:12px;color:#94a3b8;margin-bottom:12px;">Returned entries are automatically unapproved.</div>
        @foreach($returnedEntries as $entry)
        @php $c = $typeConfig[$entry->type] ?? ['bg'=>'#f1f5f9','border'=>'#cbd5e1','text'=>'#475569','icon'=>'fa-tag']; @endphp
        <div style="background:#fff;border:1px solid #fecaca;border-radius:14px;padding:14px 18px;margin-bottom:8px;display:flex;align-items:center;gap:14px;">

            <span style="background:{{ $c['bg'] }};border:1px solid {{ $c['border'] }};color:{{ $c['text'] }};border-radius:8px;padding:5px 12px;font-size:12px;font-weight:800;display:inline-flex;align-items:center;gap:5px;white-space:nowrap;flex-shrink:0;">
                <i class="fas {{ $c['icon'] }}" style="font-size:11px;"></i> {{ $entry->type }}
            </span>

            <div style="flex:1;min-width:0;">
                <div style="font-size:14px;font-weight:700;color:#0f172a;">
                    <i class="fas fa-mobile-alt" style="color:#94a3b8;margin-right:5px;font-size:12px;"></i>{{ $entry->customer_mobile }}
                </div>
                <div style="font-size:12px;color:#94a3b8;margin-top:2px;">
                    By {{ $entry->user->first_name ?? '' }} {{ $entry->user->last_name ?? '' }}
                </div>
            </div>

            <span style="background:#fee2e2;border:1px solid #fca5a5;color:#b91c1c;border-radius:8px;padding:4px 10px;font-size:11px;font-weight:700;white-space:nowrap;flex-shrink:0;">
                <i class="fas fa-undo" style="font-size:10px;margin-right:3px;"></i>Returned
            </span>

            <div style="text-align:right;flex-shrink:0;">
                <div style="font-size:12px;color:#64748b;font-weight:500;">{{ $entry->created_at->format('M d, Y') }}</div>
                <div style="font-size:11px;color:#94a3b8;">{{ $entry->created_at->format('g:i A') }}</div>
            </div>

        </div>
        @endforeach
        @endif
    </div>

</div>

<script>
function switchTab(tab) {
    var panels = ['pending', 'approved', 'invalid', 'returned'];
    panels.forEach(function(p) {
        document.getElementById('panel-' + p).style.display = p === tab ? 'block' : 'none';
        var t = document.getElementById('tab-' + p);
        if (p === tab) {
            t.style.borderBottomColor = '#ec4899';
            t.style.color = '#be185d';
        } else {
            t.style.borderBottomColor = 'transparent';
            t.style.color = '#94a3b8';
        }
    });
}

function setInvalidNote(form, message) {
    if (!confirm(message)) {
        return false;
    }

    var note = prompt('Invalid note');
    if (note === null) {
        return false;
    }

    note = note.trim();
    if (!note) {
        alert('Invalid note is required.');
        return false;
    }

    form.querySelector('.invalid-note-input').value = note;
    return true;
}
</script>

@endsection
