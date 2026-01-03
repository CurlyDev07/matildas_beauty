@extends('admin.layouts.app')

@section('content')
    <div id="profile" class="col s12">
        
        <!-- Compact Horizontal Navigation -->
        <div class="tbg-white tflex tgap-1 titems-baseline titems-center tjustify-between tmb-6 tp-2 tpx-5 trounded-lg tshadow-lg">
            <div class="tw-2/12 ttext-2xl ttext-title tfont-medium tpb-4">Facebook Ads</div>

            <ul class="tflex tw-10/12">
                <li onclick="window.location.href = '/admin/fbads/'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-blue-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/', 'tbg-blue-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-shopping-cart ttext-primary ttext-xl tmr-2"></i>
                        <span>Orders</span>
                    </div>
                </li>

                <li onclick="window.location.href = '/admin/fbads/create'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-blue-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/create', 'tbg-blue-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-cart-plus ttext-green-600 ttext-xl tmr-2"></i>
                        <span>Create</span>
                    </div>
                </li>
                
                <li onclick="window.location.href = '/admin/fbads/dashboard'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-pink-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/dashboard', 'tbg-pink-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-chart-line ttext-pink-600 ttext-xl tmr-2"></i>
                        <span>Analytics</span>
                    </div>
                </li>
                
                <li onclick="window.location.href = '/admin/fbads/event-listener'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-green-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/event-listener', 'tbg-green-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-chart-bar ttext-pink-600 ttext-xl tmr-2"></i>
                        <span>Web Metrics</span>
                    </div>
                </li>
                
                <li onclick="window.location.href = '/admin/fbads/events'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-green-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/events', 'tbg-green-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-globe ttext-green-600 ttext-xl tmr-2"></i>
                        <span>Events</span>

                    </div>
                </li>

                <li onclick="window.location.href = '/admin/order-sources'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-green-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/events', 'tbg-green-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-code-branch ttext-purple-600 ttext-xl tmr-2"></i>
                        <span>Order Source</span>
                    </div>
                </li>
                
                <!-- <li onclick="window.location.href = '/admin/fbads/status-details'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-red-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/status-details', 'tbg-red-50') }}">
                    <div class="tflex titems-center tjustify-center tw-16 th-16">
                        <i class="fas fa-headset ttext-red-600 ttext-xl"></i>
                    </div>
                </li> -->

                <li onclick="window.location.href = '/admin/fbads/meta-metrics'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-orange-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/meta-metrics', 'tbg-orange-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-chart-pie ttext-orange-600 ttext-xl tmr-2"></i>
                        <span>Metadata</span>
                    </div>
                </li>

                <li onclick="window.location.href = '/admin/fbads/jandt-reconcile'" 
                    class="tcursor-pointer waves-block waves-effect hover:tbg-orange-50 trounded-lg {{ is_matched_return_class(url()->current(), url('/').'/admin/fbads/jandt-reconcile', 'tbg-orange-50') }}">
                    <div class="tflex titems-center tjustify-center tpx-5 th-16">
                        <i class="fas fa-truck ttext-red-600 ttext-xl tmr-2"></i>
                        <span>J&T</span>
                    </div>
                </li>
            </ul>
        </div><!-- Compact Horizontal NAV -->
        
        <!-- Full Width Content -->
        <div class="tw-full">
            @yield('page')
        </div><!-- CONTENT -->
    </div>
@endsection