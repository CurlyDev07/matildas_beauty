<style>
/* ===================== MB ADMIN SIDEBAR ===================== */
:root { --mb-sidebar-w: 240px; }

body { font-family: 'Poppins', 'Segoe UI', sans-serif; margin: 0; padding: 0; }

/* ── Sidebar shell ── */
.mb-sidebar {
    position: fixed;
    left: 0; top: 0;
    height: 100vh;
    width: var(--mb-sidebar-w);
    background: linear-gradient(180deg, #ffffff 0%, #fef8fd 100%);
    border-right: 1px solid #f3e8f0;
    display: flex;
    flex-direction: column;
    z-index: 1000;
    overflow: hidden;
    box-shadow: 2px 0 16px rgba(0,0,0,0.06);
}

/* ── Header ── */
.mb-sb-header {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 15px 14px 12px;
    border-bottom: 1px solid #f9eef5;
    flex-shrink: 0;
    background: linear-gradient(135deg, #fff0f8 0%, #ffffff 100%);
}
.mb-sb-logo {
    width: 34px; height: 34px;
    border-radius: 50%;
    object-fit: cover;
    flex-shrink: 0;
    box-shadow: 0 0 0 2px #f9a8d4, 0 2px 8px rgba(236,72,153,0.2);
}
.mb-sb-brand { display: block; color: #1f2937; font-weight: 700; font-size: 13.5px; line-height: 1.1; }
.mb-sb-sub   { display: block; color: #d1d5db; font-size: 9px; text-transform: uppercase; letter-spacing: 1.3px; margin-top: 2px; }

/* ── Scrollable nav ── */
.mb-sb-nav {
    flex: 1;
    overflow-y: auto;
    padding: 8px 0 4px;
    scrollbar-width: thin;
    scrollbar-color: #f3e8f0 transparent;
}
.mb-sb-nav::-webkit-scrollbar { width: 3px; }
.mb-sb-nav::-webkit-scrollbar-thumb { background: #f3e8f0; border-radius: 4px; }

/* ── Section label (replaces plain divider) ── */
.mb-sb-section-label {
    font-size: 9px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.2px;
    color: #d8b4cc;
    padding: 12px 18px 3px;
    display: flex;
    align-items: center;
    gap: 7px;
}
.mb-sb-section-label::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #f5edf3;
}

/* ── Nav group ── */
.mb-sb-group { position: relative; }

/* ── Direct link (no children) ── */
.mb-sb-link {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 6px 10px 6px 14px;
    margin: 1px 8px;
    color: #4b5563;
    text-decoration: none;
    font-size: 13.5px;
    font-weight: 400;
    border-radius: 9px;
    line-height: 1;
    border-left: 3px solid transparent;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
    animation: mbNavIn 0.32s ease both;
}
.mb-sb-link:hover { background: #fdf2f8; color: #db2777; text-decoration: none; }
.mb-sb-link.mb-active {
    background: #fce7f3;
    color: #be185d;
    font-weight: 600;
    border-left-color: #ec4899;
}

/* ── Toggle (parent with children) ── */
.mb-sb-toggle {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 6px 10px 6px 14px;
    margin: 1px 8px;
    color: #4b5563;
    font-size: 13.5px;
    font-weight: 400;
    border-radius: 9px;
    line-height: 1;
    border-left: 3px solid transparent;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
    animation: mbNavIn 0.32s ease both;
    cursor: pointer;
    user-select: none;
}
.mb-sb-toggle:hover { background: #fdf2f8; color: #db2777; }

/* ── Icon box (replaces flat icon) ── */
.mb-sb-icon-box {
    width: 26px;
    height: 26px;
    border-radius: 7px;
    background: var(--ib-bg, #f3f4f6);
    color: var(--ib-cl, #6b7280);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    font-size: 11px;
    transition: transform 0.22s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.18s;
}
.mb-sb-toggle:hover .mb-sb-icon-box,
.mb-sb-link:hover   .mb-sb-icon-box {
    transform: scale(1.13);
    box-shadow: 0 2px 8px rgba(0,0,0,0.10);
}
.mb-sb-group:has(.mb-active) .mb-sb-icon-box {
    transform: scale(1.06);
    box-shadow: 0 2px 10px rgba(0,0,0,0.10);
}

/* ── Chevron ── */
.mb-sb-chevron {
    margin-left: auto;
    font-size: 9px;
    color: #e2c8dc;
    flex-shrink: 0;
    transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), color 0.2s ease;
}
.mb-sb-toggle:hover .mb-sb-chevron { color: #f472b6; }
.mb-sb-group.mb-open .mb-sb-chevron,
.mb-sb-group:has(.mb-active) .mb-sb-chevron {
    transform: rotate(90deg);
}

/* ── Sub-nav container ── */
.mb-sb-children {
    max-height: 0;
    overflow: hidden;
    opacity: 0;
    transform: translateY(-8px);
    transition:
        max-height 0.22s ease 0s,
        opacity    0.18s ease 0s,
        transform  0.18s ease 0s;
}
.mb-sb-group.mb-open .mb-sb-children {
    max-height: 500px;
    opacity: 1;
    transform: translateY(0);
    transition:
        max-height 0.45s cubic-bezier(0.16, 1, 0.3, 1) 0.08s,
        opacity    0.35s cubic-bezier(0.16, 1, 0.3, 1) 0.08s,
        transform  0.4s  cubic-bezier(0.34, 1.56, 0.64, 1) 0.08s;
}
.mb-sb-group:has(.mb-active) .mb-sb-children {
    max-height: 500px;
    opacity: 1;
    transform: translateY(0);
    transition: none;
}

/* staggered child fade-in */
.mb-sb-group.mb-open .mb-sb-child:nth-child(1)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.10s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(2)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.15s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(3)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.20s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(4)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.25s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(5)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.28s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(6)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.31s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(7)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.34s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(8)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.37s both; }

@keyframes mbNavIn   { from { opacity:0; transform:translateX(-6px); } to { opacity:1; transform:translateX(0); } }
@keyframes mbChildIn { from { opacity:0; transform:translateX(-8px); } to { opacity:1; transform:translateX(0); } }

/* ── Sub-nav links ── */
.mb-sb-child {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 7px 10px 7px 36px;
    margin: 0 8px;
    color: #6b7280;
    text-decoration: none;
    font-size: 12.5px;
    border-radius: 6px;
    line-height: 1;
    transition: background 0.13s, color 0.13s;
}
.mb-sb-child:hover { background: #fdf2f8; color: #db2777; text-decoration: none; }
.mb-sb-child.mb-active { font-weight: 600; }

.mb-sb-child-dot {
    width: 5px; height: 5px;
    border-radius: 50%;
    background: #e9d5f0;
    flex-shrink: 0;
    transition: background 0.13s, transform 0.13s;
}
.mb-sb-child:hover .mb-sb-child-dot  { background: #f472b6; transform: scale(1.3); }
.mb-sb-child.mb-active .mb-sb-child-dot { transform: scale(1.4); }

.mb-sb-child-icon {
    width: 13px;
    text-align: center;
    font-size: 11px;
    color: #d1d5db;
    flex-shrink: 0;
    line-height: 1;
    transition: color 0.13s;
}
.mb-sb-child:hover .mb-sb-child-icon { color: #f472b6; }

/* ── Per-group color accents ── */

/* blue — FB Ads */
.mb-g-blue:has(.mb-active) .mb-sb-toggle  { background:#eff6ff; border-left-color:#3b82f6; color:#1d4ed8; }
.mb-g-blue:has(.mb-active) .mb-sb-chevron { color:#3b82f6; }
.mb-g-blue .mb-sb-child.mb-active         { color:#1d4ed8; }
.mb-g-blue .mb-sb-child.mb-active .mb-sb-child-icon { color:#3b82f6; }
.mb-g-blue .mb-sb-child.mb-active .mb-sb-child-dot  { background:#3b82f6; }

/* purple — Staff */
.mb-g-purple:has(.mb-active) .mb-sb-toggle  { background:#f5f3ff; border-left-color:#7c3aed; color:#5b21b6; }
.mb-g-purple:has(.mb-active) .mb-sb-chevron { color:#7c3aed; }
.mb-g-purple .mb-sb-child.mb-active         { color:#5b21b6; }
.mb-g-purple .mb-sb-child.mb-active .mb-sb-child-icon { color:#7c3aed; }
.mb-g-purple .mb-sb-child.mb-active .mb-sb-child-dot  { background:#7c3aed; }

/* amber — Lab */
.mb-g-amber:has(.mb-active) .mb-sb-toggle  { background:#fffbeb; border-left-color:#d97706; color:#92400e; }
.mb-g-amber:has(.mb-active) .mb-sb-chevron { color:#d97706; }
.mb-g-amber .mb-sb-child.mb-active         { color:#92400e; }
.mb-g-amber .mb-sb-child.mb-active .mb-sb-child-icon { color:#d97706; }
.mb-g-amber .mb-sb-child.mb-active .mb-sb-child-dot  { background:#d97706; }

/* orange — Packaging */
.mb-g-orange:has(.mb-active) .mb-sb-toggle  { background:#fff7ed; border-left-color:#ea580c; color:#9a3412; }
.mb-g-orange:has(.mb-active) .mb-sb-chevron { color:#ea580c; }
.mb-g-orange .mb-sb-child.mb-active         { color:#9a3412; }
.mb-g-orange .mb-sb-child.mb-active .mb-sb-child-icon { color:#ea580c; }
.mb-g-orange .mb-sb-child.mb-active .mb-sb-child-dot  { background:#ea580c; }

/* emerald — Finance */
.mb-g-emerald:has(.mb-active) .mb-sb-toggle  { background:#f0fdf4; border-left-color:#059669; color:#065f46; }
.mb-g-emerald:has(.mb-active) .mb-sb-chevron { color:#059669; }
.mb-g-emerald .mb-sb-child.mb-active         { color:#065f46; }
.mb-g-emerald .mb-sb-child.mb-active .mb-sb-child-icon { color:#059669; }
.mb-g-emerald .mb-sb-child.mb-active .mb-sb-child-dot  { background:#059669; }

/* indigo — Orders */
.mb-g-indigo:has(.mb-active) .mb-sb-toggle  { background:#eef2ff; border-left-color:#4f46e5; color:#3730a3; }
.mb-g-indigo:has(.mb-active) .mb-sb-chevron { color:#4f46e5; }
.mb-g-indigo .mb-sb-child.mb-active         { color:#3730a3; }
.mb-g-indigo .mb-sb-child.mb-active .mb-sb-child-dot { background:#4f46e5; }

/* teal — Products */
.mb-g-teal:has(.mb-active) .mb-sb-toggle  { background:#f0fdfa; border-left-color:#0d9488; color:#0f766e; }
.mb-g-teal:has(.mb-active) .mb-sb-chevron { color:#0d9488; }
.mb-g-teal .mb-sb-child.mb-active         { color:#0f766e; }
.mb-g-teal .mb-sb-child.mb-active .mb-sb-child-dot { background:#0d9488; }

/* cyan — Inventory */
.mb-g-cyan:has(.mb-active) .mb-sb-toggle  { background:#ecfeff; border-left-color:#0891b2; color:#0e7490; }
.mb-g-cyan:has(.mb-active) .mb-sb-chevron { color:#0891b2; }
.mb-g-cyan .mb-sb-child.mb-active         { color:#0e7490; }
.mb-g-cyan .mb-sb-child.mb-active .mb-sb-child-dot { background:#0891b2; }

/* violet — Purchase */
.mb-g-violet:has(.mb-active) .mb-sb-toggle  { background:#faf5ff; border-left-color:#9333ea; color:#7e22ce; }
.mb-g-violet:has(.mb-active) .mb-sb-chevron { color:#9333ea; }
.mb-g-violet .mb-sb-child.mb-active         { color:#7e22ce; }
.mb-g-violet .mb-sb-child.mb-active .mb-sb-child-dot { background:#9333ea; }

/* slate — Suppliers */
.mb-g-slate:has(.mb-active) .mb-sb-toggle  { background:#f8fafc; border-left-color:#475569; color:#334155; }
.mb-g-slate:has(.mb-active) .mb-sb-chevron { color:#475569; }
.mb-g-slate .mb-sb-child.mb-active         { color:#334155; }
.mb-g-slate .mb-sb-child.mb-active .mb-sb-child-dot { background:#475569; }

/* rose — FB Products */
.mb-g-rose:has(.mb-active) .mb-sb-toggle  { background:#fff1f2; border-left-color:#e11d48; color:#9f1239; }
.mb-g-rose:has(.mb-active) .mb-sb-chevron { color:#e11d48; }
.mb-g-rose .mb-sb-child.mb-active         { color:#9f1239; }
.mb-g-rose .mb-sb-child.mb-active .mb-sb-child-dot { background:#e11d48; }

/* red — Fraud Guard */
.mb-g-red:has(.mb-active) .mb-sb-toggle  { background:#fef2f2; border-left-color:#dc2626; color:#991b1b; }
.mb-g-red:has(.mb-active) .mb-sb-chevron { color:#dc2626; }
.mb-g-red .mb-sb-child.mb-active         { color:#991b1b; }
.mb-g-red .mb-sb-child.mb-active .mb-sb-child-icon { color:#dc2626; }
.mb-g-red .mb-sb-child.mb-active .mb-sb-child-dot  { background:#dc2626; }

/* fuchsia — Gallery */
.mb-g-fuchsia .mb-sb-link.mb-active { background:#fdf4ff; border-left-color:#a21caf; color:#86198f; }

/* sky — SMS */
.mb-g-sky:has(.mb-active) .mb-sb-toggle  { background:#f0f9ff; border-left-color:#0284c7; color:#075985; }
.mb-g-sky:has(.mb-active) .mb-sb-chevron { color:#0284c7; }
.mb-g-sky .mb-sb-child.mb-active         { color:#075985; }
.mb-g-sky .mb-sb-child.mb-active .mb-sb-child-dot { background:#0284c7; }

/* gray — Users */
.mb-g-gray:has(.mb-active) .mb-sb-toggle  { background:#f9fafb; border-left-color:#374151; color:#1f2937; }
.mb-g-gray:has(.mb-active) .mb-sb-chevron { color:#374151; }
.mb-g-gray .mb-sb-child.mb-active         { color:#1f2937; }
.mb-g-gray .mb-sb-child.mb-active .mb-sb-child-dot { background:#374151; }

/* ── Footer ── */
.mb-sb-footer {
    padding: 11px 14px;
    border-top: 1px solid #f9eef5;
    background: #fdfbfe;
    flex-shrink: 0;
}
.mb-sb-user { display: flex; align-items: center; gap: 9px; margin-bottom: 9px; }
.mb-sb-avatar { font-size: 26px; color: #e9d5f0; line-height: 1; flex-shrink: 0; }
.mb-sb-uname {
    display: block; color: #1f2937; font-size: 12px; font-weight: 500;
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis; max-width: 136px; line-height: 1.2;
}
.mb-sb-urole { display: block; color: #9ca3af; font-size: 10px; text-transform: capitalize; }
.mb-sb-actions { display: flex; gap: 6px; }
.mb-sb-btn {
    display: flex; align-items: center; justify-content: center;
    width: 30px; height: 30px;
    border-radius: 8px;
    background: #f9f0f6; color: #c4b5c8;
    border: none; cursor: pointer; font-size: 11px;
    text-decoration: none; padding: 0;
    transition: background 0.18s, color 0.18s, transform 0.18s;
}
.mb-sb-btn:hover { background: #fce7f3; color: #ec4899; transform: translateY(-2px); text-decoration: none; }

/* ── Main content offset ── */
.admin-main-content {
    margin-left: var(--mb-sidebar-w);
    min-height: 100vh;
    background: #f9f5fb;
}
/* ============================================================ */
</style>

<aside class="mb-sidebar">

    {{-- Header --}}
    <div class="mb-sb-header">
        <img src="{{ asset('images/logo/main.png') }}" class="mb-sb-logo" alt="MB logo">
        <div>
            <span class="mb-sb-brand">Matilda's</span>
            <span class="mb-sb-sub">Admin Panel</span>
        </div>
    </div>

    {{-- Nav --}}
    <div class="mb-sb-nav">

        {{-- Dashboard --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group">
            <a href="/admin/dashboard" class="mb-sb-link {{ request()->is('admin/dashboard') ? 'mb-active' : '' }}">
                <div class="mb-sb-icon-box" style="--ib-bg:#fce7f3;--ib-cl:#ec4899;">
                    <i class="fas fa-desktop"></i>
                </div>
                <span>Dashboard</span>
            </a>
        </div>
        @endif

        {{-- FB Ads --}}
        @if (in_array(auth()->user()->role, ['master', 'sa', 'admin', 'sales']))
        <div class="mb-sb-group mb-g-blue">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#dbeafe;--ib-cl:#3b82f6;">
                    <i class="fab fa-facebook"></i>
                </div>
                <span>FB Ads</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/fbads/" class="mb-sb-child {{ request()->is('admin/fbads') && !request()->is('admin/fbads/*') ? 'mb-active' : '' }}">
                    <i class="fas fa-shopping-cart mb-sb-child-icon"></i> Orders
                </a>
                <a href="/admin/fbads/create" class="mb-sb-child {{ request()->is('admin/fbads/create') ? 'mb-active' : '' }}">
                    <i class="fas fa-cart-plus mb-sb-child-icon"></i> Create
                </a>
                <a href="/admin/fbads/incentives" class="mb-sb-child {{ request()->is('admin/fbads/incentives*') ? 'mb-active' : '' }}">
                    <i class="fas fa-star mb-sb-child-icon"></i> Incentives
                </a>
                <a href="/admin/fbads/dashboard" class="mb-sb-child {{ request()->is('admin/fbads/dashboard') ? 'mb-active' : '' }}">
                    <i class="fas fa-chart-line mb-sb-child-icon"></i> Analytics
                </a>
                <a href="/admin/fbads/event-listener" class="mb-sb-child {{ request()->is('admin/fbads/event-listener') ? 'mb-active' : '' }}">
                    <i class="fas fa-chart-bar mb-sb-child-icon"></i> Web
                </a>
                <a href="/admin/fbads/events" class="mb-sb-child {{ request()->is('admin/fbads/events') ? 'mb-active' : '' }}">
                    <i class="fas fa-globe mb-sb-child-icon"></i> Events
                </a>
                <a href="/admin/fbads/metrics" class="mb-sb-child {{ request()->is('admin/fbads/metrics') ? 'mb-active' : '' }}">
                    <i class="fas fa-file-excel mb-sb-child-icon"></i> Ad Metrics
                </a>
                <a href="/admin/fbads/pancake" class="mb-sb-child {{ request()->is('admin/fbads/pancake') ? 'mb-active' : '' }}">
                    <i class="fas fa-layer-group mb-sb-child-icon"></i> Pancake
                </a>
                <a href="/admin/order-sources" class="mb-sb-child {{ request()->is('admin/order-sources') ? 'mb-active' : '' }}">
                    <i class="fas fa-code-branch mb-sb-child-icon"></i> Source
                </a>
                <a href="/admin/fbads/jandt-reconcile" class="mb-sb-child {{ request()->is('admin/fbads/jandt-reconcile') ? 'mb-active' : '' }}">
                    <i class="fas fa-truck mb-sb-child-icon"></i> J&amp;T
                </a>
                <a href="/admin/fbads/jandt-payouts" class="mb-sb-child {{ request()->is('admin/fbads/jandt-payouts') ? 'mb-active' : '' }}">
                    <i class="fas fa-file-invoice-dollar mb-sb-child-icon"></i> J&amp;T Payouts
                </a>
                <a href="/admin/fbads/customer-feedback" class="mb-sb-child {{ request()->is('admin/fbads/customer-feedback') ? 'mb-active' : '' }}">
                    <i class="fas fa-comment-dots mb-sb-child-icon"></i> Customer Feedback
                </a>
            </div>
        </div>
        @endif

        {{-- Fraud Guard --}}
        @if (in_array(auth()->user()->role, ['master', 'sa', 'admin', 'sales']))
        <div class="mb-sb-group mb-g-red">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#fee2e2;--ib-cl:#dc2626;">
                    <i class="fas fa-shield-alt"></i>
                </div>
                <span>Fraud Guard</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/fbads/order-signals" class="mb-sb-child {{ request()->is('admin/fbads/order-signals') ? 'mb-active' : '' }}">
                    <i class="fas fa-wave-square mb-sb-child-icon"></i> Order Signals
                </a>
                <a href="/admin/fbads/order-signal-block-list" class="mb-sb-child {{ request()->is('admin/fbads/order-signal-block-list') ? 'mb-active' : '' }}">
                    <i class="fas fa-user-slash mb-sb-child-icon"></i> Block List
                </a>
            </div>
        </div>
        @endif

        {{-- Staff --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group mb-g-purple">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#ede9fe;--ib-cl:#7c3aed;">
                    <i class="fas fa-users"></i>
                </div>
                <span>Staff</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/staff-performance" class="mb-sb-child {{ request()->is('admin/staff-performance') ? 'mb-active' : '' }}">
                    <i class="fas fa-chart-bar mb-sb-child-icon"></i> Performance
                </a>
                <a href="/admin/staff/incentive-entries" class="mb-sb-child {{ request()->is('admin/staff/incentive-entries*') ? 'mb-active' : '' }}">
                    <i class="fas fa-list mb-sb-child-icon"></i> Incentive Entries
                </a>
                <a href="/admin/staff/incentive-rates" class="mb-sb-child {{ request()->is('admin/staff/incentive-rates') ? 'mb-active' : '' }}">
                    <i class="fas fa-percentage mb-sb-child-icon"></i> Incentive Rates
                </a>
                <a href="/admin/staff/incentive-approvals" class="mb-sb-child {{ request()->is('admin/staff/incentive-approvals') ? 'mb-active' : '' }}">
                    <i class="fas fa-check-circle mb-sb-child-icon"></i> Verify Incentives
                </a>
                <a href="/admin/staff/payouts" class="mb-sb-child {{ request()->is('admin/staff/payouts*') ? 'mb-active' : '' }}">
                    <i class="fas fa-money-bill-wave mb-sb-child-icon"></i> Payouts
                </a>
            </div>
        </div>
        @endif

        {{-- Lab & Packaging --}}
        @if (in_array(auth()->user()->role, ['master', 'lab']))

        <div class="mb-sb-section-label">Operations</div>

        <div class="mb-sb-group mb-g-amber">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#fef3c7;--ib-cl:#d97706;">
                    <i class="fas fa-flask"></i>
                </div>
                <span>Lab</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/lab" class="mb-sb-child {{ request()->is('admin/lab') ? 'mb-active' : '' }}">
                    <i class="fas fa-vial mb-sb-child-icon"></i> Chemicals List
                </a>
                <a href="/admin/lab/inventory" class="mb-sb-child {{ request()->is('admin/lab/inventory*') ? 'mb-active' : '' }}">
                    <i class="fas fa-boxes mb-sb-child-icon"></i> Inventory
                </a>
                <a href="/admin/lab/purchase" class="mb-sb-child {{ request()->is('admin/lab/purchase*') ? 'mb-active' : '' }}">
                    <i class="fas fa-receipt mb-sb-child-icon"></i> Purchases
                </a>
                <a href="/admin/lab/formulations" class="mb-sb-child {{ request()->is('admin/lab/formulations*') ? 'mb-active' : '' }}">
                    <i class="fas fa-scroll mb-sb-child-icon"></i> Formulations
                </a>
                <a href="/admin/lab/production" class="mb-sb-child {{ request()->is('admin/lab/production*') ? 'mb-active' : '' }}">
                    <i class="fas fa-industry mb-sb-child-icon"></i> Production
                </a>
                <a href="/admin/lab/batches" class="mb-sb-child {{ request()->is('admin/lab/batches*') ? 'mb-active' : '' }}">
                    <i class="fas fa-layer-group mb-sb-child-icon"></i> Batches
                </a>
            </div>
        </div>

        <div class="mb-sb-group mb-g-orange">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#ffedd5;--ib-cl:#ea580c;">
                    <i class="fas fa-box"></i>
                </div>
                <span>Packaging</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/packaging" class="mb-sb-child {{ request()->is('admin/packaging') ? 'mb-active' : '' }}">
                    <i class="fas fa-box mb-sb-child-icon"></i> Packaging List
                </a>
                <a href="/admin/packaging/inventory" class="mb-sb-child {{ request()->is('admin/packaging/inventory*') ? 'mb-active' : '' }}">
                    <i class="fas fa-boxes mb-sb-child-icon"></i> Inventory
                </a>
                <a href="/admin/packaging/purchases" class="mb-sb-child {{ request()->is('admin/packaging/purchase*') ? 'mb-active' : '' }}">
                    <i class="fas fa-receipt mb-sb-child-icon"></i> Purchases
                </a>
                <a href="/admin/packaging/stock-out" class="mb-sb-child {{ request()->is('admin/packaging/stock-out*') ? 'mb-active' : '' }}">
                    <i class="fas fa-minus-circle mb-sb-child-icon"></i> Stock Out
                </a>
                <a href="/admin/packaging/movements" class="mb-sb-child {{ request()->is('admin/packaging/movements*') ? 'mb-active' : '' }}">
                    <i class="fas fa-exchange-alt mb-sb-child-icon"></i> Movements
                </a>
            </div>
        </div>
        @endif

        {{-- Finance --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group mb-g-emerald">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#d1fae5;--ib-cl:#059669;">
                    <i class="fas fa-university"></i>
                </div>
                <span>Finance</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/finance/bank-transactions" class="mb-sb-child {{ request()->is('admin/finance/bank-transactions*') ? 'mb-active' : '' }}">
                    <i class="fas fa-exchange-alt mb-sb-child-icon"></i> Bank Transactions
                </a>
            </div>
        </div>
        @endif

        {{-- Orders --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group mb-g-indigo">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#e0e7ff;--ib-cl:#4f46e5;">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <span>Orders</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/orders" class="mb-sb-child {{ request()->is('admin/orders') && !request()->is('admin/orders/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> All Orders
                </a>
                <a href="/admin/orders?status=pending" class="mb-sb-child">
                    <span class="mb-sb-child-dot"></span> Pending
                </a>
                <a href="/admin/orders?status=processing" class="mb-sb-child">
                    <span class="mb-sb-child-dot"></span> Processing
                </a>
            </div>
        </div>
        @endif

        <div class="mb-sb-section-label">Commerce</div>

        {{-- Products --}}
        <div class="mb-sb-group mb-g-teal">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#ccfbf1;--ib-cl:#0d9488;">
                    <i class="fas fa-box-open"></i>
                </div>
                <span>Products</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/products" class="mb-sb-child {{ request()->is('admin/products') && !request()->is('admin/products/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> All Products
                </a>
                <a href="/admin/products/create" class="mb-sb-child {{ request()->is('admin/products/create') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Add Product
                </a>
            </div>
        </div>

        {{-- Inventory --}}
        <div class="mb-sb-group mb-g-cyan">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#cffafe;--ib-cl:#0891b2;">
                    <i class="fas fa-warehouse"></i>
                </div>
                <span>Inventory</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/inventory" class="mb-sb-child {{ request()->is('admin/inventory') && !request()->is('admin/inventory/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Stock List
                </a>
                <a href="/admin/inventory/movements" class="mb-sb-child {{ request()->is('admin/inventory/movements') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Movements
                </a>
            </div>
        </div>

        {{-- Purchase --}}
        @if (in_array(auth()->user()->role, ['master', 'inventory']))
        <div class="mb-sb-group mb-g-violet">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#f3e8ff;--ib-cl:#9333ea;">
                    <i class="fas fa-store-alt"></i>
                </div>
                <span>Purchase</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/purchase" class="mb-sb-child {{ request()->is('admin/purchase') && !request()->is('admin/purchase/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> All Purchases
                </a>
                <a href="/admin/purchase/create" class="mb-sb-child {{ request()->is('admin/purchase/create') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Add Purchase
                </a>
            </div>
        </div>
        @endif

        {{-- Suppliers --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group mb-g-slate">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#f1f5f9;--ib-cl:#475569;">
                    <i class="fas fa-truck"></i>
                </div>
                <span>Suppliers</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/suppliers" class="mb-sb-child {{ request()->is('admin/suppliers') && !request()->is('admin/suppliers/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> All Suppliers
                </a>
                <a href="/admin/suppliers/create" class="mb-sb-child {{ request()->is('admin/suppliers/create') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Add Supplier
                </a>
            </div>
        </div>
        @endif

        {{-- FB Products --}}
        @if (auth()->user()->isMaster())

        <div class="mb-sb-section-label">Catalog</div>

        <div class="mb-sb-group mb-g-rose">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#ffe4e6;--ib-cl:#e11d48;">
                    <i class="fas fa-gem"></i>
                </div>
                <span>FB Products</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/fb-ads" class="mb-sb-child {{ request()->is('admin/fb-ads') && !request()->is('admin/fb-ads/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> All FB Products
                </a>
                <a href="/admin/fb-ads/create" class="mb-sb-child {{ request()->is('admin/fb-ads/create') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Add FB Product
                </a>
            </div>
        </div>
        @endif

        {{-- Gallery --}}
        @if (auth()->user()->isMaster())

        <div class="mb-sb-section-label">Tools</div>

        <div class="mb-sb-group mb-g-fuchsia">
            <a href="/admin/file-manager" class="mb-sb-link {{ request()->is('admin/file-manager*') ? 'mb-active' : '' }}">
                <div class="mb-sb-icon-box" style="--ib-bg:#fdf4ff;--ib-cl:#a21caf;">
                    <i class="fas fa-images"></i>
                </div>
                <span>Gallery</span>
            </a>
        </div>
        @endif

        {{-- SMS --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group mb-g-sky">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#e0f2fe;--ib-cl:#0284c7;">
                    <i class="fas fa-comment-dots"></i>
                </div>
                <span>SMS</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/sms" class="mb-sb-child {{ request()->is('admin/sms') && !request()->is('admin/sms/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Send SMS
                </a>
                <a href="/admin/sms/history" class="mb-sb-child {{ request()->is('admin/sms/history') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> History
                </a>
            </div>
        </div>
        @endif

        {{-- Users --}}
        @if (auth()->user()->isMaster())

        <div class="mb-sb-section-label">System</div>

        <div class="mb-sb-group mb-g-gray">
            <div class="mb-sb-toggle">
                <div class="mb-sb-icon-box" style="--ib-bg:#f3f4f6;--ib-cl:#374151;">
                    <i class="fas fa-users-cog"></i>
                </div>
                <span>Users</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/users" class="mb-sb-child {{ request()->is('admin/users') && !request()->is('admin/users/*') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> All Users
                </a>
                <a href="/admin/users/create" class="mb-sb-child {{ request()->is('admin/users/create') ? 'mb-active' : '' }}">
                    <span class="mb-sb-child-dot"></span> Add User
                </a>
            </div>
        </div>
        @endif

    </div>

    {{-- Footer --}}
    <div class="mb-sb-footer">
        <div class="mb-sb-user">
            <div class="mb-sb-avatar"><i class="fas fa-user-circle"></i></div>
            <div style="overflow:hidden;">
                <span class="mb-sb-uname">{{ auth()->user()->name ?? 'Admin' }}</span>
                <span class="mb-sb-urole">{{ ucfirst(auth()->user()->role ?? '') }}</span>
            </div>
        </div>
        <div class="mb-sb-actions">
            <a href="{{ url('/') }}" class="mb-sb-btn" title="Back to site">
                <i class="fas fa-external-link-alt"></i>
            </a>
            <form action="{{ route('logout') }}" method="post" style="margin:0;padding:0;">
                @csrf
                <button type="submit" class="mb-sb-btn" title="Logout">
                    <i class="fas fa-sign-out-alt"></i>
                </button>
            </form>
        </div>
    </div>

</aside>

<script>
(function () {
    document.querySelectorAll('.mb-sb-group').forEach(function (group) {
        if (group.querySelector('.mb-active')) {
            group.classList.add('mb-open');
        }
    });

    document.querySelectorAll('.mb-sb-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            var group = this.closest('.mb-sb-group');
            var isOpen = group.classList.contains('mb-open');

            document.querySelectorAll('.mb-sb-group.mb-open').forEach(function (g) {
                if (!g.querySelector('.mb-active')) {
                    g.classList.remove('mb-open');
                }
            });

            if (!isOpen && !group.querySelector('.mb-active')) {
                group.classList.add('mb-open');
            }
        });
    });
})();
</script>
