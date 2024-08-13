@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Inventory</div>
        <div class="tw-full tmr-10 trounded-lg">
            <ul class="collection  tbg-white  tflex">
                <li onclick="window.location.href = '/admin/inventory'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/inventory', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-th-list ttext-primary"></i>
                        </a>
                        Inventory List
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/inventory/in-out-list'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/inventory/in-out-list', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-th-list ttext-primary"></i>
                        </a>
                        Stock In/Out List
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/inventory/stock-in'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/inventory/stock-in', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-th-list ttext-primary"></i>
                        </a>
                        Manual Stock-in
                    </div>
                </li>
            </ul>
        </div><!-- NAV -->
        <div class="tw-full">
            @yield('page')
        </div><!-- CONTENT -->
    </div>
@endsection

