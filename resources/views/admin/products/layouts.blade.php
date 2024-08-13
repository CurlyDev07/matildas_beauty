@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Products</div>
        <div class="tw-full tmr-10 trounded-lg">
            <ul class="collection  tbg-white  tflex">
                <li onclick="window.location.href = '/admin/products'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/products', 'tborder-primary tborder-l-4') }}">
                    <div class="ttext-md ttext-black-100 tmy-1 ">
                        <a class="tmr-2">
                            <i class="fas fa-th-list ttext-primary"></i>
                        </a>
                        Product List
                    </div>
                </li><!-- PRODUCT LIST -->
                <li onclick="window.location.href = '/admin/products/add'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/products/add', 'tborder-primary tborder-l-4 ') }}">
                    <div class="ttext-md ttext-black-100 tmy-1">
                        <a class="tmr-2">
                            <i class="fas fa-plus-circle ttext-primary"></i>
                        </a>
                        Add Product
                    </div>
                </li><!-- ADD PRODUCT -->
                <li onclick="window.location.href = '/admin/products/archive'" class="tmy-1 tpx-5 tpy-2 tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/products/archive', 'tborder-primary tborder-l-4 ') }}">
                    <div class="ttext-md ttext-black-100 tmy-1">
                        <a class="tmr-2">
                            <i class="fas fa-file-alt ttext-primary"></i>
                        </a>
                        Archive
                    </div>
                </li><!-- PRODUCT ARCHIVE -->
            </ul>
        </div><!-- NAV -->

        <div class="tw-full">
            @yield('page')
        </div><!-- CONTENT -->
    </div>
@endsection
