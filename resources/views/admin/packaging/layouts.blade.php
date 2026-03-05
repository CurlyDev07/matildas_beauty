@extends('admin.layouts.app')

@section('content')
<style>
/* =========================================================
   PACKAGING SHARED STYLES
   ========================================================= */

.pkg-header {
    padding: 14px 18px;
    border-bottom: 1px solid #eef2f7;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    background: #ffffff;
    flex-wrap: wrap;
}

.pkg-title {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    display: flex;
    align-items: center;
    gap: 10px;
    white-space: nowrap;
}

.pkg-tools {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: flex-end;
}

.pkg-icon-btn {
    width: 44px;
    height: 44px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 12px;
    border: 1px solid #fed7aa;
    background: #fff7ed;
    color: #c2410c;
    text-decoration: none;
    transition: transform .12s ease, box-shadow .12s ease, background-color .12s ease;
    position: relative;
}

.pkg-icon-btn:hover {
    background: #ffedd5;
    box-shadow: 0 14px 24px rgba(194,65,12,.16);
    transform: translateY(-1px);
}

.pkg-icon-btn:active { transform: scale(.96); }

.pkg-search {
    display: flex;
    align-items: center;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    overflow: hidden;
    background: #fff;
    height: 44px;
}

.pkg-search input {
    border: 0 !important;
    outline: none !important;
    padding: 10px 14px !important;
    width: 240px;
    font-size: 14px;
    color: #0f172a;
}

.pkg-search button {
    border: 0;
    background: #fff;
    width: 48px;
    height: 44px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    cursor: pointer;
    transition: background-color .12s ease, transform .12s ease;
}

.pkg-search button:hover { background: #f1f5f9; }

/* Table card */
.pkg-card {
    background: #fff;
    border: 1px solid #eef2f7;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(15,23,42,.06);
    overflow: hidden;
}

.pkg-table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    font-size: 14px;
}

.pkg-table thead th {
    background: #f8fafc;
    color: #475569;
    font-weight: 800;
    padding: 14px 18px;
    border-bottom: 1px solid #eef2f7;
    text-align: left;
    white-space: nowrap;
}

.pkg-table tbody td {
    padding: 13px 18px;
    border-bottom: 1px solid #f1f5f9;
    color: #0f172a;
    vertical-align: middle;
}

.pkg-table tbody tr:nth-child(even) { background: #fcfdff; }
.pkg-table tbody tr { transition: background-color .12s ease; }
.pkg-table tbody tr:hover { background: #fff7ed; }

.pkg-name { font-weight: 800; color: #0f172a; line-height: 1.1; }
.pkg-sub  { font-size: 12px; color: #94a3b8; margin-top: 3px; }
.pkg-right  { text-align: right; }
.pkg-center { text-align: center; }

/* Action buttons */
.pkg-action {
    width: 34px;
    height: 34px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    border-radius: 10px;
    background: #ecfdf5;
    border: 1px solid #dcfce7;
    color: #16a34a;
    text-decoration: none;
    transition: transform .12s ease, box-shadow .12s ease, background-color .12s ease;
}

.pkg-action:hover {
    background: #dcfce7;
    box-shadow: 0 12px 22px rgba(22,163,74,.14);
    transform: translateY(-1px);
}

.pkg-action.red {
    background: #fff;
    border-color: #fee2e2;
    color: #ef4444;
}

.pkg-action.red:hover {
    background: #fee2e2;
    box-shadow: 0 12px 22px rgba(239,68,68,.14);
}

/* Category badge */
.pkg-badge {
    display: inline-block;
    padding: 3px 10px;
    border-radius: 99px;
    font-size: 12px;
    font-weight: 700;
    background: #fff7ed;
    color: #c2410c;
    border: 1px solid #fed7aa;
}

/* Form inputs */
.pkg-input {
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    padding: 8px 12px;
    font-size: 14px;
    color: #0f172a;
    width: 100%;
    outline: none;
    background: #fff;
    transition: border-color .12s ease;
}

.pkg-input:focus { border-color: #d97706; }

.pkg-label {
    display: block;
    font-size: 13px;
    font-weight: 700;
    color: #475569;
    margin-bottom: 6px;
}

.pkg-form-card {
    background: #fff;
    border: 1px solid #eef2f7;
    border-radius: 16px;
    box-shadow: 0 6px 18px rgba(15,23,42,.06);
    padding: 28px;
}

.pkg-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 10px 24px;
    border-radius: 12px;
    font-weight: 700;
    font-size: 14px;
    border: none;
    cursor: pointer;
    transition: transform .12s ease, box-shadow .12s ease;
    text-decoration: none;
}

.pkg-btn-primary {
    background: #d97706;
    color: #fff;
}

.pkg-btn-primary:hover {
    background: #b45309;
    box-shadow: 0 8px 18px rgba(217,119,6,.25);
    color: #fff;
    transform: translateY(-1px);
}

.pkg-btn-secondary {
    background: #f1f5f9;
    color: #475569;
    border: 1px solid #e2e8f0;
}

.pkg-btn-secondary:hover {
    background: #e2e8f0;
    color: #334155;
}
</style>

    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Packaging</div>
        <div class="tw-full tmr-3 trounded-lg">
            <ul class="collection tbg-white tflex">
                <li onclick="window.location.href = '/admin/packaging'"
                    class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-orange-50 {{ is_matched_return_class(url()->current(), url('/').'/admin/packaging', 'tborder-l-4') }}"
                    style="{{ url()->current() === url('/admin/packaging') ? 'border-left: 4px solid #d97706;' : '' }}">
                    <div class="ttext-md ttext-black-100 tmy-1">
                        <a class="tmr-2"><i class="fas fa-th-list" style="color:#d97706;"></i></a>
                        Materials
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/packaging/inventory'"
                    class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-orange-50"
                    style="{{ strpos(url()->current(), '/admin/packaging/inventory') !== false ? 'border-left: 4px solid #d97706;' : '' }}">
                    <div class="ttext-md ttext-black-100 tmy-1">
                        <a class="tmr-2"><i class="fas fa-clipboard-list" style="color:#0284c7;"></i></a>
                        Inventory
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/packaging/purchases'"
                    class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-orange-50"
                    style="{{ strpos(url()->current(), '/admin/packaging/purchases') !== false ? 'border-left: 4px solid #d97706;' : '' }}">
                    <div class="ttext-md ttext-black-100 tmy-1">
                        <a class="tmr-2"><i class="fas fa-shopping-cart" style="color:#16a34a;"></i></a>
                        Purchases
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/packaging/stock-out'"
                    class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-orange-50"
                    style="{{ strpos(url()->current(), '/admin/packaging/stock-out') !== false ? 'border-left: 4px solid #d97706;' : '' }}">
                    <div class="ttext-md ttext-black-100 tmy-1">
                        <a class="tmr-2"><i class="fas fa-minus-circle" style="color:#ef4444;"></i></a>
                        Stock Out
                    </div>
                </li>
            </ul>
        </div><!-- NAV -->

        <div class="tw-full tmt-3">
            @if(session('success'))
                <div class="tflex tbg-green-100 trounded-lg tp-4 tmb-4 ttext-sm ttext-green-700" role="alert">
                    <i class="fas fa-check-circle tmr-2 tmt-1"></i>
                    <span class="tfont-medium">{{ session('success') }}</span>
                </div>
            @endif

            @yield('page')
        </div><!-- CONTENT -->
    </div>
@endsection
