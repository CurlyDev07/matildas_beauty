@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Orders</div>
        <div class="tw-full tmr-10 trounded-lg">
            <ul class="collection  tbg-white  tflex">
                <li onclick="window.location.href = '/admin/orders'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/orders', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-th-list ttext-primary"></i>
                        </a>
                        Order List
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/orders/create'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/orders/create', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-plus-circle ttext-primary"></i>
                        </a>
                        Create Order
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/orders/history'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/orders/history', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-plus-circle ttext-primary"></i>
                        </a>
                        Order History
                    </div>
                </li>
            </ul>
        </div><!-- NAV -->
        <div class="tw-full">    
            @yield('page')
        </div><!-- CONTENT -->
    </div>
@endsection

