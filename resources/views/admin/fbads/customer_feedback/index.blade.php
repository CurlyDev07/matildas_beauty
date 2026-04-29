@extends('admin.fbads.layouts')

@section('css')
<style>
    /* ── Page shell ── */
    .cf-page { padding: 0 4px 32px; }

    /* ── Stats row ── */
    .cf-stats {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
        margin-bottom: 22px;
    }
    .cf-stat-card {
        background: #fff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 2px 12px rgba(236,72,153,0.07);
        border: 1px solid #fce7f3;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .cf-stat-icon {
        width: 44px;
        height: 44px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        flex-shrink: 0;
    }
    .cf-stat-label { font-size: 11px; color: #9ca3af; font-weight: 600; text-transform: uppercase; letter-spacing: .8px; margin-bottom: 3px; }
    .cf-stat-value { font-size: 26px; font-weight: 700; color: #1f2937; line-height: 1; }

    /* ── Filters bar ── */
    .cf-filters {
        background: #fff;
        border-radius: 12px;
        border: 1px solid #fce7f3;
        padding: 14px 18px;
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(236,72,153,0.05);
    }
    .cf-filter-label { font-size: 12px; font-weight: 600; color: #be185d; white-space: nowrap; }
    .cf-select {
        border: 1px solid #fce7f3;
        border-radius: 8px;
        padding: 6px 10px;
        font-size: 12.5px;
        color: #374151;
        background: #fff9fb;
        outline: none;
        cursor: pointer;
        transition: border-color .15s;
    }
    .cf-select:focus { border-color: #f9a8d4; }
    .cf-filter-btn {
        padding: 6px 16px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        border: none;
        cursor: pointer;
        transition: background .15s, transform .15s;
    }
    .cf-filter-btn-apply  { background: #ec4899; color: #fff; }
    .cf-filter-btn-apply:hover  { background: #db2777; transform: translateY(-1px); }
    .cf-filter-btn-reset  { background: #fce7f3; color: #be185d; }
    .cf-filter-btn-reset:hover  { background: #fbcfe8; }

    /* ── Main card ── */
    .cf-card {
        background: #fff;
        border-radius: 14px;
        box-shadow: 0 2px 16px rgba(236,72,153,0.08);
        border: 1px solid #fce7f3;
        overflow: hidden;
    }
    .cf-card-header {
        padding: 16px 22px;
        border-bottom: 1px solid #fdf2f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(120deg, #fff0f8 0%, #ffffff 100%);
    }
    .cf-card-title { font-size: 16px; font-weight: 700; color: #1f2937; margin: 0; }
    .cf-count-badge {
        background: #fce7f3;
        color: #be185d;
        border-radius: 9999px;
        padding: 3px 10px;
        font-size: 12px;
        font-weight: 600;
    }

    /* ── Table ── */
    .cf-table-wrap { overflow-x: auto; }
    .cf-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }
    .cf-table th {
        padding: 10px 14px;
        text-align: left;
        font-size: 11px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .8px;
        color: #be185d;
        background: #fff9fb;
        border-bottom: 1px solid #fce7f3;
        white-space: nowrap;
    }
    .cf-table td {
        padding: 12px 14px;
        color: #374151;
        border-bottom: 1px solid #fdf2f8;
        vertical-align: top;
    }
    .cf-table tr:last-child td { border-bottom: none; }
    .cf-table tr:hover td { background: #fff9fb; }

    /* ── Message cell ── */
    .cf-msg { max-width: 220px; }
    .cf-msg-text {
        font-size: 13px;
        color: #1f2937;
        line-height: 1.5;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .cf-summary-text {
        font-size: 11.5px;
        color: #9ca3af;
        margin-top: 3px;
        display: -webkit-box;
        -webkit-line-clamp: 1;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* ── Badges ── */
    .cf-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 3px 9px;
        border-radius: 9999px;
        font-size: 11px;
        font-weight: 600;
        white-space: nowrap;
    }
    .cf-badge-positive  { background: #dcfce7; color: #15803d; }
    .cf-badge-negative  { background: #fee2e2; color: #b91c1c; }
    .cf-badge-neutral   { background: #f3f4f6; color: #4b5563; }
    .cf-badge-good      { background: #eff6ff; color: #1d4ed8; }
    .cf-badge-bad       { background: #fef2f2; color: #dc2626; }
    .cf-badge-other     { background: #faf5ff; color: #7c3aed; }
    .cf-badge-low       { background: #dcfce7; color: #166534; }
    .cf-badge-medium    { background: #fef9c3; color: #854d0e; }
    .cf-badge-high      { background: #fee2e2; color: #991b1b; }
    .cf-badge-yes       { background: #fce7f3; color: #be185d; }
    .cf-badge-no        { background: #f3f4f6; color: #6b7280; }
    .cf-badge-source    { background: #eff6ff; color: #1e40af; }
    .cf-badge-cat       { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }

    /* ── Action ── */
    .cf-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 5px 11px;
        border-radius: 7px;
        font-size: 11.5px;
        font-weight: 600;
        background: #fce7f3;
        color: #be185d;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: background .13s, color .13s;
    }
    .cf-action-btn:hover { background: #fbcfe8; color: #9d174d; text-decoration: none; }

    /* ── Empty state ── */
    .cf-empty {
        text-align: center;
        padding: 60px 20px;
        color: #9ca3af;
    }
    .cf-empty i { font-size: 40px; color: #fce7f3; margin-bottom: 12px; display: block; }
    .cf-empty p { font-size: 14px; margin: 0; }

    /* ── Pagination ── */
    .cf-pagination { padding: 14px 22px; border-top: 1px solid #fdf2f8; display: flex; justify-content: flex-end; }
    .cf-pagination .pagination { margin: 0; }

    /* ── Modal ── */
    .cf-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0,0,0,0.35);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    .cf-modal-overlay.active { display: flex; }
    .cf-modal {
        background: #fff;
        border-radius: 16px;
        width: 100%;
        max-width: 560px;
        max-height: 90vh;
        overflow-y: auto;
        box-shadow: 0 20px 60px rgba(0,0,0,0.18);
        border: 1px solid #fce7f3;
    }
    .cf-modal-head {
        padding: 18px 22px;
        border-bottom: 1px solid #fdf2f8;
        display: flex;
        align-items: center;
        justify-content: space-between;
        background: linear-gradient(120deg, #fff0f8 0%, #fff 100%);
        border-radius: 16px 16px 0 0;
        position: sticky;
        top: 0;
    }
    .cf-modal-title { font-size: 15px; font-weight: 700; color: #1f2937; margin: 0; }
    .cf-modal-close {
        background: #fce7f3;
        border: none;
        border-radius: 8px;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        color: #be185d;
        font-size: 13px;
        transition: background .13s;
    }
    .cf-modal-close:hover { background: #fbcfe8; }
    .cf-modal-body { padding: 20px 22px; }
    .cf-field { margin-bottom: 16px; }
    .cf-field-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .9px; color: #be185d; margin-bottom: 5px; }
    .cf-field-value { font-size: 13.5px; color: #1f2937; line-height: 1.6; }
    .cf-field-value.muted { color: #6b7280; font-style: italic; }
    .cf-field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }

    @media (max-width: 768px) {
        .cf-stats { grid-template-columns: repeat(2, 1fr); }
        .cf-field-row { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('page')
<div class="cf-page">

    {{-- Stats --}}
    <div class="cf-stats">
        <div class="cf-stat-card">
            <div class="cf-stat-icon" style="background:#fce7f3; color:#ec4899;">
                <i class="fas fa-comments"></i>
            </div>
            <div>
                <div class="cf-stat-label">Total</div>
                <div class="cf-stat-value">{{ number_format($total) }}</div>
            </div>
        </div>
        <div class="cf-stat-card">
            <div class="cf-stat-icon" style="background:#dcfce7; color:#16a34a;">
                <i class="fas fa-smile"></i>
            </div>
            <div>
                <div class="cf-stat-label">Positive</div>
                <div class="cf-stat-value">{{ number_format($positive) }}</div>
            </div>
        </div>
        <div class="cf-stat-card">
            <div class="cf-stat-icon" style="background:#fee2e2; color:#dc2626;">
                <i class="fas fa-frown"></i>
            </div>
            <div>
                <div class="cf-stat-label">Negative</div>
                <div class="cf-stat-value">{{ number_format($negative) }}</div>
            </div>
        </div>
        <div class="cf-stat-card">
            <div class="cf-stat-icon" style="background:#fdf4ff; color:#a21caf;">
                <i class="fas fa-star"></i>
            </div>
            <div>
                <div class="cf-stat-label">Testimonials</div>
                <div class="cf-stat-value">{{ number_format($testimonials) }}</div>
            </div>
        </div>
    </div>

    {{-- Filters --}}
    <form method="GET" action="/admin/fbads/customer-feedback">
        <div class="cf-filters">
            <span class="cf-filter-label"><i class="fas fa-filter" style="margin-right:5px;"></i>Filter</span>

            <select name="sentiment" class="cf-select">
                <option value="">All Sentiments</option>
                <option value="positive" {{ request('sentiment') === 'positive' ? 'selected' : '' }}>Positive</option>
                <option value="negative" {{ request('sentiment') === 'negative' ? 'selected' : '' }}>Negative</option>
                <option value="neutral"  {{ request('sentiment') === 'neutral'  ? 'selected' : '' }}>Neutral</option>
            </select>

            <select name="risk_level" class="cf-select">
                <option value="">All Risk Levels</option>
                <option value="low"    {{ request('risk_level') === 'low'    ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ request('risk_level') === 'medium' ? 'selected' : '' }}>Medium</option>
                <option value="high"   {{ request('risk_level') === 'high'   ? 'selected' : '' }}>High</option>
            </select>

            <select name="category" class="cf-select">
                <option value="">All Categories</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat }}" {{ request('category') === $cat ? 'selected' : '' }}>
                        {{ ucwords(str_replace('_', ' ', $cat)) }}
                    </option>
                @endforeach
            </select>

            <select name="testimonial" class="cf-select">
                <option value="">All</option>
                <option value="1" {{ request('testimonial') === '1' ? 'selected' : '' }}>Testimonials only</option>
                <option value="0" {{ request('testimonial') === '0' ? 'selected' : '' }}>Non-testimonials</option>
            </select>

            <button type="submit" class="cf-filter-btn cf-filter-btn-apply">Apply</button>
            <a href="/admin/fbads/customer-feedback" class="cf-filter-btn cf-filter-btn-reset" style="text-decoration:none;">Reset</a>
        </div>
    </form>

    {{-- Table Card --}}
    <div class="cf-card">
        <div class="cf-card-header">
            <h2 class="cf-card-title"><i class="fas fa-comment-dots" style="color:#ec4899;margin-right:8px;"></i>Customer Feedback</h2>
            <span class="cf-count-badge">{{ $feedbacks->total() }} records</span>
        </div>

        <div class="cf-table-wrap">
            @if($feedbacks->isEmpty())
                <div class="cf-empty">
                    <i class="fas fa-inbox"></i>
                    <p>No feedback records yet. They will appear here once n8n starts sending data.</p>
                </div>
            @else
                <table class="cf-table">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Message</th>
                            <th>Sentiment</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Risk</th>
                            <th>Testimonial</th>
                            <th>Date</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($feedbacks as $fb)
                        <tr>
                            <td>
                                @if($fb->source)
                                    <span class="cf-badge cf-badge-source">
                                        @if($fb->source === 'telegram')
                                            <i class="fab fa-telegram-plane"></i>
                                        @else
                                            <i class="fas fa-globe"></i>
                                        @endif
                                        {{ ucfirst($fb->source) }}
                                    </span>
                                @else
                                    <span style="color:#d1d5db;">—</span>
                                @endif
                            </td>
                            <td class="cf-msg">
                                <div class="cf-msg-text">{{ $fb->message }}</div>
                                @if($fb->summary)
                                    <div class="cf-summary-text">{{ $fb->summary }}</div>
                                @endif
                            </td>
                            <td>
                                @php
                                    $s = strtolower($fb->sentiment ?? '');
                                    $sc = in_array($s, ['positive','negative','neutral']) ? $s : 'neutral';
                                @endphp
                                @if($fb->sentiment)
                                    <span class="cf-badge cf-badge-{{ $sc }}">
                                        @if($sc === 'positive') <i class="fas fa-arrow-up"></i>
                                        @elseif($sc === 'negative') <i class="fas fa-arrow-down"></i>
                                        @else <i class="fas fa-minus"></i>
                                        @endif
                                        {{ ucfirst($fb->sentiment) }}
                                    </span>
                                @else
                                    <span style="color:#d1d5db;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($fb->type)
                                    @php
                                        $tc = $fb->type === 'good' ? 'good' : ($fb->type === 'bad' ? 'bad' : 'other');
                                    @endphp
                                    <span class="cf-badge cf-badge-{{ $tc }}">{{ ucfirst($fb->type) }}</span>
                                @else
                                    <span style="color:#d1d5db;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($fb->category)
                                    <span class="cf-badge cf-badge-cat">
                                        {{ ucwords(str_replace('_', ' ', $fb->category)) }}
                                    </span>
                                @else
                                    <span style="color:#d1d5db;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($fb->risk_level)
                                    @php $rc = in_array(strtolower($fb->risk_level), ['low','medium','high']) ? strtolower($fb->risk_level) : 'low'; @endphp
                                    <span class="cf-badge cf-badge-{{ $rc }}">{{ ucfirst($fb->risk_level) }}</span>
                                @else
                                    <span style="color:#d1d5db;">—</span>
                                @endif
                            </td>
                            <td>
                                @if($fb->is_usable_as_testimonial)
                                    <span class="cf-badge cf-badge-yes"><i class="fas fa-check"></i> Yes</span>
                                @else
                                    <span class="cf-badge cf-badge-no">No</span>
                                @endif
                            </td>
                            <td style="white-space:nowrap; color:#9ca3af; font-size:12px;">
                                {{ $fb->created_at->format('M d, Y') }}<br>
                                <span style="font-size:11px;">{{ $fb->created_at->format('h:i A') }}</span>
                            </td>
                            <td>
                                <button class="cf-action-btn" onclick="openModal({{ $fb->id }})">
                                    <i class="fas fa-eye"></i> View
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        @if($feedbacks->hasPages())
            <div class="cf-pagination">
                {{ $feedbacks->links() }}
            </div>
        @endif
    </div>

</div>

{{-- Detail Modals --}}
@foreach($feedbacks as $fb)
<div class="cf-modal-overlay" id="modal-{{ $fb->id }}">
    <div class="cf-modal">
        <div class="cf-modal-head">
            <h3 class="cf-modal-title"><i class="fas fa-comment-dots" style="color:#ec4899;margin-right:8px;"></i>Feedback Detail</h3>
            <button class="cf-modal-close" onclick="closeModal({{ $fb->id }})"><i class="fas fa-times"></i></button>
        </div>
        <div class="cf-modal-body">

            <div class="cf-field-row">
                <div class="cf-field">
                    <div class="cf-field-label">Source</div>
                    <div class="cf-field-value">
                        @if($fb->source)
                            <span class="cf-badge cf-badge-source">
                                @if($fb->source === 'telegram') <i class="fab fa-telegram-plane"></i> @endif
                                {{ ucfirst($fb->source) }}
                            </span>
                        @else
                            <span class="muted">—</span>
                        @endif
                    </div>
                </div>
                <div class="cf-field">
                    <div class="cf-field-label">Date Received</div>
                    <div class="cf-field-value">{{ $fb->created_at->format('M d, Y h:i A') }}</div>
                </div>
            </div>

            <div class="cf-field">
                <div class="cf-field-label">Original Message</div>
                <div class="cf-field-value" style="background:#fff9fb; padding:12px 14px; border-radius:10px; border:1px solid #fce7f3;">{{ $fb->message }}</div>
            </div>

            <div class="cf-field">
                <div class="cf-field-label">AI Summary</div>
                <div class="cf-field-value {{ $fb->summary ? '' : 'muted' }}">{{ $fb->summary ?? 'None' }}</div>
            </div>

            <div class="cf-field">
                <div class="cf-field-label">Recommended Action</div>
                <div class="cf-field-value {{ $fb->recommended_action ? '' : 'muted' }}">{{ $fb->recommended_action ?? 'None' }}</div>
            </div>

            <div class="cf-field-row">
                <div class="cf-field">
                    <div class="cf-field-label">Sentiment</div>
                    <div class="cf-field-value">
                        @if($fb->sentiment)
                            @php $s = in_array(strtolower($fb->sentiment), ['positive','negative','neutral']) ? strtolower($fb->sentiment) : 'neutral'; @endphp
                            <span class="cf-badge cf-badge-{{ $s }}">{{ ucfirst($fb->sentiment) }}</span>
                        @else <span class="muted">—</span> @endif
                    </div>
                </div>
                <div class="cf-field">
                    <div class="cf-field-label">Type</div>
                    <div class="cf-field-value">
                        @if($fb->type)
                            @php $tc = $fb->type === 'good' ? 'good' : ($fb->type === 'bad' ? 'bad' : 'other'); @endphp
                            <span class="cf-badge cf-badge-{{ $tc }}">{{ ucfirst($fb->type) }}</span>
                        @else <span class="muted">—</span> @endif
                    </div>
                </div>
            </div>

            <div class="cf-field-row">
                <div class="cf-field">
                    <div class="cf-field-label">Category</div>
                    <div class="cf-field-value">
                        @if($fb->category)
                            <span class="cf-badge cf-badge-cat">{{ ucwords(str_replace('_', ' ', $fb->category)) }}</span>
                        @else <span class="muted">—</span> @endif
                    </div>
                </div>
                <div class="cf-field">
                    <div class="cf-field-label">Risk Level</div>
                    <div class="cf-field-value">
                        @if($fb->risk_level)
                            @php $rc = in_array(strtolower($fb->risk_level), ['low','medium','high']) ? strtolower($fb->risk_level) : 'low'; @endphp
                            <span class="cf-badge cf-badge-{{ $rc }}">{{ ucfirst($fb->risk_level) }}</span>
                        @else <span class="muted">—</span> @endif
                    </div>
                </div>
            </div>

            <div class="cf-field">
                <div class="cf-field-label">Usable as Testimonial</div>
                <div class="cf-field-value">
                    @if($fb->is_usable_as_testimonial)
                        <span class="cf-badge cf-badge-yes"><i class="fas fa-check"></i> Yes — this feedback can be used as a testimonial</span>
                    @else
                        <span class="cf-badge cf-badge-no">No</span>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endforeach

<script>
function openModal(id) {
    document.getElementById('modal-' + id).classList.add('active');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById('modal-' + id).classList.remove('active');
    document.body.style.overflow = '';
}
document.querySelectorAll('.cf-modal-overlay').forEach(function(overlay) {
    overlay.addEventListener('click', function(e) {
        if (e.target === overlay) {
            overlay.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
});
</script>
@endsection
