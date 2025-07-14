@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        <div class="ttext-2xl ttext-title tfont-medium tpb-4">Facebook Ads</div>
        <div class="tflex">
            <div class="tw-1/4 tmr-10 trounded-lg">
                
                <ul class="collection with-header tshadow-lg tm-0 tsticky ttop-0">
                    <li onclick="window.location.href = '/admin/fbads/'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/', 'tborder-primary tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Orders
                            <a class="secondary-content">
                                <i class="fas fa-shopping-cart ttext-primary  ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/fbads/dashboard'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/dashboard', 'tborder-pink-600 tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Dashboard
                            <a class="secondary-content">
                                <i class="fas fa-chart-line ttext-pink-600 ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/fbads/meta-metrics'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/meta-metrics', 'tborder-orange-600 tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Meta Metrics
                            <a class="secondary-content">
                                <i class="fas fa-chart-pie ttext-orange-600 ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/fbads/event-listener'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/event-listener', 'tborder-green-600 tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Event Listener
                            <a class="secondary-content">
                                <i class="fas fa-atlas ttext-green-600 ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/fbads/events'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/events', 'tborder-green-600 tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Events
                            <a class="secondary-content">
                                <i class="fas fa-globe ttext-green-600 ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/fbads/create'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/create', 'tborder-blue-600 tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Create 
                            <a class="secondary-content">
                                <i class="fas fa-cart-plus ttext-blue-600 ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                    <li onclick="window.location.href = '/admin/fbads/status-details'" class="collection-item tcursor-pointer waves-block waves-effect hover:tbg-blue-100 {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/status-details', 'tborder-red-600 tborder-l-4') }}">
                        <div class="ttext-md ttext-black-100 tmy-1 ">
                            Status Details
                            <a class="secondary-content">
                                <i class="fas fa-headset ttext-red-600 ttext-lg"></i>
                            </a>
                        </div>
                    </li>
                </ul>
            </div><!-- NAV -->
            <div class="tw-3/4">
                @yield('page')
            </div><!-- CONTENT -->
        </div>
    </div>
@endsection

