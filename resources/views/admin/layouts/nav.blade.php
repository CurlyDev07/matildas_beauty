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
    background: #ffffff;
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

/* ── Divider ── */
.mb-sb-divider {
    height: 1px;
    background: #f5edf3;
    margin: 4px 14px;
}

/* ── Nav group ── */
.mb-sb-group { position: relative; }

/* ── Direct link (no children) ── */
.mb-sb-link {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 10px 10px 10px 14px;
    margin: 0 8px;
    color: #4b5563;
    text-decoration: none;
    font-size: 14px;
    font-weight: 400;
    border-radius: 8px;
    line-height: 1;
    border-left: 3px solid transparent;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
    animation: mbNavIn 0.32s ease both;
}
.mb-sb-link:hover { background: #fdf2f8; color: #db2777; text-decoration: none; }
.mb-sb-link.mb-active {
    background: #fce7f3;
    color: #be185d;
    font-weight: 500;
    border-left-color: #ec4899;
}
.mb-sb-link.mb-active .mb-sb-icon { color: #ec4899; }
.mb-sb-link:hover .mb-sb-icon { color: #f472b6; }

/* ── Toggle (parent with children — click only, no href) ── */
.mb-sb-toggle {
    display: flex;
    align-items: center;
    gap: 9px;
    padding: 10px 10px 10px 14px;
    margin: 0 8px;
    color: #4b5563;
    font-size: 14px;
    font-weight: 400;
    border-radius: 8px;
    line-height: 1;
    border-left: 3px solid transparent;
    transition: background 0.15s, color 0.15s, border-color 0.15s;
    animation: mbNavIn 0.32s ease both;
    cursor: pointer;
    user-select: none;
}
.mb-sb-toggle:hover { background: #fdf2f8; color: #db2777; }
.mb-sb-toggle:hover .mb-sb-icon { color: #f472b6; }

/* active parent — when a child is active */
.mb-sb-group:has(.mb-active) .mb-sb-toggle {
    background: #fce7f3;
    color: #be185d;
    font-weight: 500;
    border-left-color: #ec4899;
}
.mb-sb-group:has(.mb-active) .mb-sb-toggle .mb-sb-icon { color: #ec4899; }

@keyframes mbNavIn {
    from { opacity: 0; transform: translateX(-6px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* ── Icon ── */
.mb-sb-icon {
    width: 14px;
    text-align: center;
    font-size: 13px;
    color: #d1d5db;
    flex-shrink: 0;
    margin-right: 5px;
    line-height: 1;
    transition: color 0.15s;
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
    color: #ec4899;
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
/* open on click — 0.08s delay for premium feel */
.mb-sb-group.mb-open .mb-sb-children {
    max-height: 500px;
    opacity: 1;
    transform: translateY(0);
    transition:
        max-height 0.45s cubic-bezier(0.16, 1, 0.3, 1) 0.08s,
        opacity    0.35s cubic-bezier(0.16, 1, 0.3, 1) 0.08s,
        transform  0.4s  cubic-bezier(0.34, 1.56, 0.64, 1) 0.08s;
}
/* active child — instant open on page load */
.mb-sb-group:has(.mb-active) .mb-sb-children {
    max-height: 500px;
    opacity: 1;
    transform: translateY(0);
    transition: none;
}

/* staggered child fade-in when group opens */
.mb-sb-group.mb-open .mb-sb-child:nth-child(1)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.10s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(2)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.15s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(3)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.20s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(4)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.25s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(5)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.28s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(6)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.31s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(7)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.34s both; }
.mb-sb-group.mb-open .mb-sb-child:nth-child(8)  { animation: mbChildIn 0.3s cubic-bezier(0.16,1,0.3,1) 0.37s both; }
@keyframes mbChildIn {
    from { opacity: 0; transform: translateX(-8px); }
    to   { opacity: 1; transform: translateX(0); }
}

/* ── Sub-nav links ── */
.mb-sb-child {
    display: flex;
    align-items: center;
    gap: 7px;
    padding: 8px 10px 8px 36px;
    margin: 0 8px;
    color: #6b7280;
    text-decoration: none;
    font-size: 13px;
    border-radius: 6px;
    line-height: 1;
    transition: background 0.13s, color 0.13s;
}
.mb-sb-child:hover { background: #fdf2f8; color: #db2777; text-decoration: none; }
.mb-sb-child.mb-active { color: #be185d; font-weight: 500; }

.mb-sb-child-dot {
    width: 4px; height: 4px;
    border-radius: 50%;
    background: #e9d5f0;
    flex-shrink: 0;
    transition: background 0.13s;
}
.mb-sb-child:hover .mb-sb-child-dot     { background: #f472b6; }
.mb-sb-child.mb-active .mb-sb-child-dot { background: #ec4899; }

.mb-sb-child-icon {
    width: 13px;
    text-align: center;
    font-size: 12px;
    color: #d1d5db;
    flex-shrink: 0;
    line-height: 1;
    transition: color 0.13s;
}
.mb-sb-child:hover .mb-sb-child-icon     { color: #f472b6; }
.mb-sb-child.mb-active .mb-sb-child-icon { color: #ec4899; }

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
                <i class="fas fa-desktop mb-sb-icon"></i>
                <span>Dashboard</span>
            </a>
        </div>
        @endif

        {{-- FB Ads --}}
        @if (in_array(auth()->user()->role, ['master', 'sa', 'admin', 'sales']))
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fab fa-facebook mb-sb-icon"></i>
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
                <a href="/admin/order-sources" class="mb-sb-child {{ request()->is('admin/order-sources') ? 'mb-active' : '' }}">
                    <i class="fas fa-code-branch mb-sb-child-icon"></i> Source
                </a>
                <a href="/admin/fbads/jandt-reconcile" class="mb-sb-child {{ request()->is('admin/fbads/jandt-reconcile') ? 'mb-active' : '' }}">
                    <i class="fas fa-truck mb-sb-child-icon"></i> J&amp;T
                </a>
            </div>
        </div>
        @endif

        {{-- Staff --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-users mb-sb-icon"></i>
                <span>Staff</span>
                <i class="fas fa-chevron-right mb-sb-chevron"></i>
            </div>
            <div class="mb-sb-children">
                <a href="/admin/staff-performance" class="mb-sb-child {{ request()->is('admin/staff-performance') ? 'mb-active' : '' }}">
                    <i class="fas fa-chart-bar mb-sb-child-icon"></i> Performance
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
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-flask mb-sb-icon"></i>
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

        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-box mb-sb-icon"></i>
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
                <a href="/admin/packaging/purchase" class="mb-sb-child {{ request()->is('admin/packaging/purchase*') ? 'mb-active' : '' }}">
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
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-university mb-sb-icon"></i>
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
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-shopping-cart mb-sb-icon"></i>
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

        <div class="mb-sb-divider"></div>

        {{-- Products --}}
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-box-open mb-sb-icon"></i>
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
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-warehouse mb-sb-icon"></i>
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
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-store-alt mb-sb-icon"></i>
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
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-truck mb-sb-icon"></i>
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

        <div class="mb-sb-divider"></div>

        {{-- FB Products --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-gem mb-sb-icon"></i>
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

        <div class="mb-sb-divider"></div>

        {{-- Gallery --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group">
            <a href="/admin/file-manager" class="mb-sb-link {{ request()->is('admin/file-manager*') ? 'mb-active' : '' }}">
                <i class="fas fa-images mb-sb-icon"></i>
                <span>Gallery</span>
            </a>
        </div>
        @endif

        {{-- SMS --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-comment-dots mb-sb-icon"></i>
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

        <div class="mb-sb-divider"></div>

        {{-- Users --}}
        @if (auth()->user()->isMaster())
        <div class="mb-sb-group">
            <div class="mb-sb-toggle">
                <i class="fas fa-users-cog mb-sb-icon"></i>
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
    // Auto-open the group whose child is currently active
    document.querySelectorAll('.mb-sb-group').forEach(function (group) {
        if (group.querySelector('.mb-active')) {
            group.classList.add('mb-open');
        }
    });

    // Click toggle — accordion: one open at a time
    document.querySelectorAll('.mb-sb-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            var group = this.closest('.mb-sb-group');
            var isOpen = group.classList.contains('mb-open');

            // Close all non-active groups
            document.querySelectorAll('.mb-sb-group.mb-open').forEach(function (g) {
                if (!g.querySelector('.mb-active')) {
                    g.classList.remove('mb-open');
                }
            });

            // Open this group if it was closed and has no active child
            if (!isOpen && !group.querySelector('.mb-active')) {
                group.classList.add('mb-open');
            }
        });
    });
})();
</script>
