@extends('admin.layouts.app')

@section('content')
<style>
/* =========================================================
   HEADER TOOLBAR (shared across all pages)
   ========================================================= */

.inv-header{
  padding:14px 18px;
  border-bottom:1px solid #eef2f7;
  display:flex;
  align-items:center;
  justify-content:space-between;
  gap:16px;
  background:#ffffff;
}

.inv-title{
  font-size:20px;
  font-weight:800;
  color:#0f172a;
  display:flex;
  align-items:center;
  gap:10px;
  white-space:nowrap;
}

/* Right-side toolbar */
.inv-tools{
  display:flex;
  align-items:center;
  gap:12px;
  flex-wrap:wrap;
  justify-content:flex-end;
}

/* Icon buttons (Add / Sort / Clear / Action) */
.inv-icon-btn{
  width:44px;
  height:44px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  border-radius:12px;
  border:1px solid #dbeafe;
  background:#dcfce7;
  color:#166534;
  text-decoration:none;
  transition: transform .12s ease,
              box-shadow .12s ease,
              background-color .12s ease;
  position:relative;
}

.inv-icon-btn:hover{
  background:#bbf7d0;
  box-shadow:0 14px 24px rgba(22,163,74,.16);
  transform: translateY(-1px);
}

.inv-icon-btn:active{
  transform: scale(.96);
}

/* =========================================================
   SEARCH BAR
   ========================================================= */

.inv-search{
  display:flex;
  align-items:center;
  border:1px solid #e2e8f0;
  border-radius:14px;
  overflow:hidden;
  background:#fff;
  height:44px;
}

.inv-search input{
  border:0 !important;
  outline:none !important;
  padding:10px 14px !important;
  width:260px;
  font-size:14px;
  color:#0f172a;
}

.inv-search button{
  border:0;
  background:#fff;
  width:48px;
  height:44px;
  display:flex;
  align-items:center;
  justify-content:center;
  color:#64748b;
  cursor:pointer;
  transition: background-color .12s ease,
              transform .12s ease;
}

.inv-search button:hover{
  background:#f1f5f9;
}

.inv-search button:active{
  transform: scale(.96);
}

/* =========================================================
   SELECT / FILTER DROPDOWN
   ========================================================= */

.inv-select{
  display:flex;
  align-items:center;
  gap:8px;
  border:1px solid #e2e8f0;
  border-radius:14px;
  padding:0 10px;
  height:44px;
  background:#fff;
}

.inv-select img{
  width:20px;
  height:20px;
}

.inv-select select{
  border:0 !important;
  outline:none !important;
  background:transparent !important;
  height:42px;
  cursor:pointer;
  font-size:13px;
  color:#334155;
}

/* =========================================================
   TABLE CARD (Chemicals / Purchases / Inventory / Formulation)
   ========================================================= */

.chem-card{
  background:#fff;
  border:1px solid #eef2f7;
  border-radius:16px;
  box-shadow:0 6px 18px rgba(15,23,42,.06);
  overflow:hidden;
}

.chem-table{
  width:100%;
  border-collapse:separate;
  border-spacing:0;
  font-size:14px;
}

.chem-table thead th{
  background:#f8fafc;
  color:#475569;
  font-weight:800;
  padding:16px 18px;
  border-bottom:1px solid #eef2f7;
  text-align:left;
  white-space:nowrap;
}

.chem-table tbody td{
  padding:16px 18px;
  border-bottom:1px solid #f1f5f9;
  color:#0f172a;
  vertical-align:middle;
}

.chem-table tbody tr:nth-child(even){
  background:#fcfdff;
}

.chem-table tbody tr{
  transition: background-color .12s ease;
}

.chem-table tbody tr:hover{
  background:#eff6ff;
}

/* Alignment helpers */
.chem-right{
  text-align:right;
}

.chem-center{
  text-align:center;
}

/* Name + subtitle inside table cells */
.chem-name{
  font-weight:800;
  color:#0f172a;
  line-height:1.1;
}

.chem-sub{
  font-size:12px;
  color:#94a3b8;
  margin-top:3px;
}

/* Action buttons inside table */
.chem-action{
  width:36px;
  height:36px;
  display:inline-flex;
  align-items:center;
  justify-content:center;
  border-radius:10px;
  background:#ecfdf5;
  border:1px solid #dcfce7;
  color:#16a34a;
  text-decoration:none;
  transition: transform .12s ease,
              box-shadow .12s ease,
              background-color .12s ease;
}

.chem-action:hover{
  background:#dcfce7;
  box-shadow:0 12px 22px rgba(22,163,74,.14);
  transform: translateY(-1px);
}

.chem-action:active{
  transform: scale(.96);
}

/* =========================================================
   MODAL OVERLAY (Materialize compatibility)
   ========================================================= */

.modal-overlay{
  background: rgba(15,23,42,.55) !important;
}
</style>


    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Laboratory</div>
        <div class="tw-full tmr-3 trounded-lg">
            <ul class="collection  tbg-white  tflex">
                <li onclick="window.location.href = '/admin/lab'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-flask ttext-green-600"></i>
                        </a>
                        Chemicals
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/lab/inventory'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab/inventory', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-clipboard-list ttext-primary"></i>
                        </a>Inventory
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/lab/purchase'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab/purchase', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-shopping-cart ttext-orange-400"></i>
                        </a>
                        Purchases
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/lab/formulations'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab/formulations', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-flask ttext-purple-600"></i>
                        </a>
                        Formulations
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/lab/production'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab/production', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-flask ttext-orange-600"></i>
                        </a>
                        Production
                    </div>
                </li>
              
                {{-- <li onclick="window.location.href = '/admin/lab/suggestions'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab/suggestions', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        lab Suggestions
                        <a class="secondary-content">
                            <i class="fas fa-cash-register ttext-primary"></i>
                        </a>
                    </div>
                </li> --}}
            </ul>
        </div><!-- NAV -->
        <div class="tw-full">
            @yield('page')
        </div><!-- CONTENT -->
    </div>
@endsection

