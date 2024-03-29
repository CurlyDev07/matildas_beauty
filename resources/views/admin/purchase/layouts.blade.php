@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Shopee</div>
        <div class="tflex">
            <div class="tw-1/5 tmr-3 trounded-lg">
                <ul class="collection with-header tshadow-lg tm-0 tsticky ttop-0">
                    <li onclick="window.location.href = '/admin/purchase'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase', 'tborder-primary tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Purchase History
                            <a class="secondary-content">
                                <i class="fas fa-shopping-basket ttext-primary"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/purchase/report'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase/report', 'tborder-primary tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Purchase Report
                            <a class="secondary-content">
                                <i class="fas fa-shopping-basket ttext-primary"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/purchase/create'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/purchase/create', 'tborder-primary tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Make a Purchase Order
                            <a class="secondary-content">
                                <i class="fas fa-cart-plus ttext-primary"></i>
                            </a>
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
            <div class="tw-4/5">
                @yield('page')
            </div><!-- CONTENT -->
        </div>
    </div>
@endsection

