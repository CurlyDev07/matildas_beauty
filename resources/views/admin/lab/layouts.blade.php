@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Shopee</div>
        <div class="tw-full tmr-3 trounded-lg">
            <ul class="collection  tbg-white  tflex">
                <li onclick="window.location.href = '/admin/lab/chemicals'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-flask ttext-green-600"></i>
                        </a>
                        Chemicals
                    </div>
                </li>
                <li onclick="window.location.href = '/admin/lab/inventory'" class="tmy-1 tpx-5 tpy-2  tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/lab/create', 'tborder-primary tborder-l-4') }}">
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

