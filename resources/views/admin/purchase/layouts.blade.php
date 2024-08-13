@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Shopee</div>
        <div class="tw-full tmr-3 trounded-lg">
            <ul class="collection  tbg-white  tflex">
                <li onclick="window.location.href = '/admin/purchase'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-shopping-basket ttext-primary"></i>
                        </a>
                        Purchase History
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/purchase/create'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase/create', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-cart-plus ttext-primary"></i>
                        </a>
                        Make a Purchase Order
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/purchase/report'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase/report', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-shopping-basket ttext-primary"></i>
                        </a>
                        Purchase Report
                    </div>
                </li>
              
                {{-- <li onclick="window.location.href = '/admin/purchase/suggestions'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase/suggestions', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        Purchase Suggestions
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

