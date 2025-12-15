@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <style>
    .tfade-in {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.6s ease forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endsection

@section('page')


    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
           <div class=" tflex tp-1 trounded ttext-lg titems-center">
                        <span class="tpl-1" style="color: #333;">
                            <i class="fas fa-chart-line"></i>
                            <span>Dashboard</span> 
                        </span>
                    </div>
            <ul class="tflex titems-center">

                @if (request()->date)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                Date: {{ request()->date }}
                            </span>
                        </div>
                    </li>
                @endif <!--PURCHASE Date-->

          
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="date" id="date" value="" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
                    </div>
                </li><!-- date Filter-->
                
                <li class="tml-3 tml-auto tmr-2">
                    <a href="/admin/fbads">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li><!-- REMOVE FILTER -->
            </ul>
        </div>
    

        <!-- ORDERS CHARTS -->
       <div class="tpx-4 tpy-6 tflex titems-stretch">
            <!-- Orders & Revenue Cards -->
            <div class="tw-1/2 tflex tflex-wrap tgap-6 tmb-6">
                <!-- Today -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-white trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📦</div>
                        <h3 class="ttext-lg tfont-semibold">Today</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">
                            {{ $totalOrdersToday }}<br>
                            ₱{{ number_format($totalRevenueToday, 2) }}
                        </p>
                    </div>
                </a>

                <!-- This Week -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-white trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">💰</div>
                        <h3 class="ttext-lg tfont-semibold">This Week</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">
                            {{ $totalOrdersThisWeek }}<br>
                            ₱{{ number_format($totalRevenueThisWeek, 2) }}
                        </p>
                    </div>
                </a>

                <!-- This Month -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-white trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📦</div>
                        <h3 class="ttext-lg tfont-semibold">This Month</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">
                            {{ $totalOrdersThisMonth }}<br>
                            ₱{{ number_format($totalRevenueThisMonth, 2) }}
                        </p>
                    </div>
                </a>
            </div>

            <!-- <h2 class="tfont-bold tmb-2 tmt-5 tpl-5 ttext-2xl ttext-gray-800">AOV</h2> -->

            <!-- AOV Cards -->
            <div class="tw-1/2 tflex tflex-wrap tgap-6 tpy-8">
                <!-- AOV Today -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#fde4ee] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">💰</div>
                        <h3 class="ttext-lg tfont-semibold">Today</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($new_aovToday, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Week -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e0f1ff] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">💰</div>
                        <h3 class="ttext-lg tfont-semibold">This Week</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($new_aovWeek, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Month -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e3fcef] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">💰</div>
                        <h3 class="ttext-lg tfont-semibold">This Month</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($new_aovMonth, 2) }}</p>
                    </div>
                </a>
            </div>
            
            <!-- <h2 class="tfont-bold tmb-2 tmt-5 tpl-5 ttext-2xl ttext-gray-800">Upsell</h2> -->

            <!-- Upsell -->
            <div class="tw-1/2 tflex tflex-wrap tgap-6 tpy-8">
                <!-- Upsell Today -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2"> <i class="fas fa-cart-plus ttext-green-600"></i></div>
                        <h3 class="ttext-md tfont-medium ttext-green-700"> {{ $upsellRateToday }}% </h3>
                        <h3 class="ttext-lg tfont-semibold tmt-2"> Today</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($upsellToday, 2) }}</p>
                    </div>
                </a>

                <!-- Upsell This Week -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2"> <i class="fas fa-cart-plus ttext-green-600"></i></div>
                        <h3 class="ttext-md tfont-medium ttext-green-700"> {{ $upsellRateWeek }}% </h3>
                        <h3 class="ttext-lg tfont-semibold tmt-2"> This Week</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($upsellWeek, 2) }}</p>
                    </div>
                </a>

                <!-- Upsell This Month -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2"> <i class="fas fa-cart-plus ttext-green-600"></i></div>
                        <h3 class="ttext-md tfont-medium ttext-green-700"> {{ $upsellRateMonth }}% </h3>
                        <h3 class="ttext-lg tfont-semibold tmt-2"> This Month </h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($upsellMonth, 2) }}</p>
                    </div>
                </a>
            </div>
        </div>

        <div class="tbg-white trounded-lg tshadow-lg tp-6 tmb-6">
            <!-- Filter Buttons -->
            <div class="tflex tjustify-between titems-center tmb-6 tflex-wrap tgap-4">
                <h2 class="ttext-xl tfont-semibold ttext-gray-800">Orders & Revenue Analytics</h2>
                
                <div class="tflex tgap-2 titems-center tflex-wrap">
                    <button onclick="filterOrdersChart('last30')" 
                        id="chart-btn-last30"
                        class="chart-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1">
                        Last 30 Days
                    </button>
                    <button onclick="filterOrdersChart('month')" 
                        id="chart-btn-month"
                        class="chart-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1">
                        This Month
                    </button>
                    <button onclick="filterOrdersChart('lastmonth')" 
                        id="chart-btn-lastmonth"
                        class="chart-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1">
                        Last Month
                    </button>
                    <button onclick="filterOrdersChart('year')" 
                        id="chart-btn-year"
                        class="chart-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1">
                        Year
                    </button>
                    
                    <!-- Custom Date Range -->
                    <div class="tflex tgap-2 titems-center ">
                        <input type="text" 
                            id="chartCustomDateRange" 
                            class="form-control tpx-4 tpy-2 tborder trounded-lg ttext-sm browser-default tmx-1" 
                            placeholder="Custom Range"
                            style="width: 200px;">
                        <button onclick="applyCustomDateChart()" 
                            class="tpx-4 tml-1 tpy-2 tbg-blue-600 ttext-white trounded-lg hover:tbg-blue-700 ttransition-all ttext-sm browser-default">
                            Apply
                        </button>
                    </div>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div id="chartLoadingIndicator" class="tflex tjustify-center titems-center tpy-8">
                <div class="tborder-4 tborder-pink-200 tborder-t-pink-600 trounded-full tw-10 th-10 tanimate-spin"></div>
            </div>

            <!-- Chart Container -->
            <div id="ordersRevenueChart" style="min-height: 400px;"></div>
            
            <!-- Summary Cards -->
            <div class="tflex tmt-6">
                <div class="tbg-gradient-to-br tfrom-pink-600 tto-pink-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Total Orders</div>
                    <div id="chartTotalOrders" class="ttext-3xl tfont-bold tmt-2">0</div>
                </div>
                <div class="tbg-gradient-to-br tfrom-green-500 tto-green-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Total Revenue</div>
                    <div id="chartTotalRevenue" class="ttext-3xl tfont-bold tmt-2">₱0.00</div>
                </div>
                <div class="tbg-gradient-to-br tfrom-blue-500 tto-blue-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Average Order Value</div>
                    <div id="chartAvgOrderValue" class="ttext-3xl tfont-bold tmt-2">₱0.00</div>
                </div>
            </div>
        </div>
        <!-- ORDERS CHARTS -->


        <!-- Top Products Performance -->
        <div class="tbg-white trounded-lg tshadow-lg tp-6 tmb-6">
            <!-- Header -->
            <div class="tflex tjustify-between titems-center tmb-6 tflex-wrap tgap-4">
                <h2 class="ttext-xl tfont-semibold ttext-gray-800">Top Products Performance</h2>
                
                <div class="tflex tgap-2 titems-center tflex-wrap">
                    <!-- View Toggle -->
                    <div class="tbg-gray-100 trounded-lg tp-1 tflex tgap-1">
                        <button onclick="toggleProductView('orders')" 
                            id="product-view-orders"
                            class="product-view-btn tpx-3 tpy-1 trounded-md ttransition-all tbg-white ttext-gray-900 tshadow-sm ttext-sm tfont-medium">
                            By Orders
                        </button>
                        <button onclick="toggleProductView('revenue')" 
                            id="product-view-revenue"
                            class="product-view-btn tpx-3 tpy-1 trounded-md ttransition-all ttext-gray-600 ttext-sm tfont-medium">
                            By Revenue
                        </button>
                    </div>
                    
                    <!-- Filter Buttons -->
                    <button onclick="filterTopProducts('last30')" 
                        id="products-btn-last30"
                        class="products-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-pink-600 ttext-white ttext-sm">
                        Last 30 Days
                    </button>
                    <button onclick="filterTopProducts('month')" 
                        id="products-btn-month"
                        class="products-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-gray-200 ttext-sm">
                        This Month
                    </button>
                    <button onclick="filterTopProducts('lastmonth')" 
                        id="products-btn-lastmonth"
                        class="products-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-gray-200 ttext-sm">
                        Last Month
                    </button>
                    <button onclick="filterTopProducts('year')" 
                        id="products-btn-year"
                        class="products-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-gray-200 ttext-sm">
                        Year
                    </button>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div id="productsLoadingIndicator" class="thidden tflex tjustify-center titems-center tpy-8">
                <div class="tborder-4 tborder-pink-200 tborder-t-pink-600 trounded-full tw-10 th-10 tanimate-spin"></div>
            </div>

            <!-- Chart Container -->
            <div id="topProductsChart" style="min-height: 500px;"></div>
            
            <!-- Summary Cards -->
            <div class="tflex tmt-6">
                <div class="tbg-gradient-to-br tfrom-indigo-500 tto-indigo-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Total Products</div>
                    <div id="productsTotalProducts" class="ttext-2xl tfont-bold tmt-2">0</div>
                </div>
                <div class="tbg-gradient-to-br tfrom-pink-500 tto-pink-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Top by Orders</div>
                    <div id="productsTopProduct" class="ttext-lg tfont-bold tmt-2 tline-clamp-2">--</div>
                </div>
                <div class="tbg-gradient-to-br tfrom-green-500 tto-green-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Top by Revenue</div>
                    <div id="productsTopRevenue" class="ttext-lg tfont-bold tmt-2 tline-clamp-2">--</div>
                </div>
            </div>
        </div>
        <!-- Top Products Performance -->







        <!-- Customer Repeat Rate -->
        <div class="tbg-white trounded-lg tshadow-lg tp-6 tmb-6">
            <!-- Header -->
            <div class="tflex tjustify-between titems-center tmb-6 tflex-wrap tgap-4">
                <h2 class="ttext-xl tfont-semibold ttext-gray-800">Customer Repeat Rate</h2>
                
                <div class="tflex tgap-2 titems-center tflex-wrap">
                    <button onclick="filterRepeatRate('last30')" 
                        id="repeat-btn-last30"
                        class="repeat-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-pink-600 ttext-white ttext-sm">
                        Last 30 Days
                    </button>
                    <button onclick="filterRepeatRate('month')" 
                        id="repeat-btn-month"
                        class="repeat-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-gray-200 ttext-sm">
                        This Month
                    </button>
                    <button onclick="filterRepeatRate('lastmonth')" 
                        id="repeat-btn-lastmonth"
                        class="repeat-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-gray-200 ttext-sm">
                        Last Month
                    </button>
                <button onclick="filterRepeatRate('year')" 
                        id="repeat-btn-year"
                        class="repeat-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all tbg-gray-100 ttext-gray-700 hover:tbg-gray-200 ttext-sm">
                        All Time
                    </button>   
                </div>
            </div>

            <!-- Loading Indicator -->
            <div id="repeatRateLoadingIndicator" class="thidden tflex tjustify-center titems-center tpy-8">
                <div class="tborder-4 tborder-pink-200 tborder-t-pink-600 trounded-full tw-10 th-10 tanimate-spin"></div>
            </div>

            <div class="tflex tjustify-around tgap-6">
                <!-- Gauge Chart -->
                <div id="repeatRateGauge" style="min-height: 350px;"></div>
            
                <!-- Breakdown Chart -->
                <div id="customerBreakdownChart" style="min-height: 350px;"></div>

                    <!-- Summary Cards -->
                <div class="tmt-6">
                    <div class="tbg-gradient-to-br tfrom-purple-500 tto-purple-600 trounded-lg tp-6">
                        <div class="ttext-sm topacity-90">Total Customers</div>
                        <div id="repeatTotalCustomers" class="ttext-3xl tfont-bold tmt-2">0</div>
                    </div>
                    <div class="tbg-gradient-to-br tfrom-green-500 tto-green-600 trounded-lg tp-6">
                        <div class="ttext-sm topacity-90">Repeat Customers</div>
                        <div id="repeatRepeatCustomers" class="ttext-3xl tfont-bold tmt-2">0</div>
                    </div>
                    <div class="tbg-gradient-to-br tfrom-orange-500 tto-orange-600 trounded-lg tp-6">
                        <div class="ttext-sm topacity-90">One-Time Customers</div>
                        <div id="repeatOneTimeCustomers" class="ttext-3xl tfont-bold tmt-2">0</div>
                    </div>
                    <div class="tbg-gradient-to-br tfrom-blue-500 tto-blue-600 trounded-lg tp-6">
                        <div class="ttext-sm topacity-90">Avg Orders/Customer</div>
                        <div id="repeatAvgOrders" class="ttext-3xl tfont-bold tmt-2">0</div>
                    </div>
                </div>
            </div>
            

            
            <!-- Top Repeat Customers Table -->
            <div class="tmt-6">
                <h3 class="ttext-lg tfont-semibold ttext-gray-800 tmb-4">Top Repeat Customers</h3>
                <div class="toverflow-x-auto">
                    <table class="tw-full tborder-collapse">
                        <thead>
                            <tr class="tbg-gray-50">
                                <th class="ttext-left tp-3 ttext-sm tfont-semibold ttext-gray-700">#</th>
                                <th class="ttext-left tp-3 ttext-sm tfont-semibold ttext-gray-700">Phone Number</th>
                                <th class="ttext-center tp-3 ttext-sm tfont-semibold ttext-gray-700">Orders</th>
                                <th class="ttext-right tp-3 ttext-sm tfont-semibold ttext-gray-700">Revenue</th>
                                <th class="ttext-right tp-3 ttext-sm tfont-semibold ttext-gray-700">AOV</th>
                            </tr>
                        </thead>
                        <tbody id="topRepeatCustomersTable">
                            <tr>
                                <td colspan="5" class="ttext-center tpy-8 ttext-gray-500">Loading...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>









        <!-- Revenue Comparison -->
        <div class="tbg-white trounded-lg tshadow-lg tp-6 tmb-6">
            <!-- Header -->
            <div class="tflex tjustify-between titems-center tmb-6">
                <h2 class="ttext-xl tfont-semibold ttext-gray-800">Revenue Comparison</h2>
                <button onclick="loadRevenueComparison()" class="tpx-4 tpy-2 tbg-gray-100 hover:tbg-gray-200 trounded-lg ttext-sm tfont-medium ttransition-all">
                    <i class="fas fa-sync-alt tmr-2"></i> Refresh
                </button>
            </div>

            <!-- Loading Indicator -->
            <div id="comparisonLoadingIndicator" class="thidden tflex tjustify-center titems-center tpy-8">
                <div class="tborder-4 tborder-pink-200 tborder-t-pink-600 trounded-full tw-10 th-10 tanimate-spin"></div>
            </div>

            <!-- Comparison Grid -->
            <div class="tflex tjustify-around">
                
                <!-- Today vs Yesterday -->
                <div class="tborder-2 tborder-gray-200 trounded-lg tp-6 hover:tshadow-md ttransition-shadow">
                    <div class="tflex titems-center tjustify-between tmb-4">
                        <h3 class="ttext-sm tfont-semibold ttext-gray-500 tuppercase ttracking-wide">Today vs Yesterday</h3>
                        <span id="todayChangePercent" class="tpx-3 tpy-1 trounded-full ttext-xs tfont-bold tbg-gray-100 ttext-gray-600">--</span>
                    </div>
                    
                    <div class="tspace-y-4">
                        <!-- Today -->
                        <div class="tbg-gradient-to-br tfrom-pink-50 tto-pink-100 trounded-lg tp-4">
                            <div class="ttext-xs ttext-pink-700 tfont-medium tmb-1" id="todayLabel">Today</div>
                            <div class="ttext-3xl tfont-bold ttext-pink-900" id="todayRevenue">₱0</div>
                            <div class="ttext-sm ttext-pink-700 tmt-1" id="todayOrders">0 orders</div>
                        </div>
                        
                        <!-- Yesterday -->
                        <div class="tbg-gray-50 trounded-lg tp-4">
                            <div class="ttext-xs ttext-gray-600 tfont-medium tmb-1" id="yesterdayLabel">Yesterday</div>
                            <div class="ttext-2xl tfont-bold ttext-gray-800" id="yesterdayRevenue">₱0</div>
                            <div class="ttext-sm ttext-gray-600 tmt-1" id="yesterdayOrders">0 orders</div>
                        </div>
                    </div>
                </div>

                <!-- Last 7 Days vs Previous 7 Days -->
                <div class="tborder-2 tborder-gray-200 trounded-lg tp-6 hover:tshadow-md ttransition-shadow">
                    <div class="tflex titems-center tjustify-between tmb-4">
                        <h3 class="ttext-sm tfont-semibold ttext-gray-500 tuppercase ttracking-wide">Last 7 vs Prev 7</h3>
                        <span id="week7ChangePercent" class="tpx-3 tpy-1 trounded-full ttext-xs tfont-bold tbg-gray-100 ttext-gray-600">--</span>
                    </div>
                    
                    <div class="tspace-y-4">
                        <!-- Last 7 Days -->
                        <div class="tbg-gradient-to-br tfrom-blue-50 tto-blue-100 trounded-lg tp-4">
                            <div class="ttext-xs ttext-blue-700 tfont-medium tmb-1">Last 7 Days</div>
                            <div class="ttext-3xl tfont-bold ttext-blue-900" id="last7Revenue">₱0</div>
                            <div class="ttext-sm ttext-blue-700 tmt-1" id="last7Orders">0 orders</div>
                        </div>
                        
                        <!-- Days 8-14 Ago -->
                        <div class="tbg-gray-50 trounded-lg tp-4">
                            <div class="ttext-xs ttext-gray-600 tfont-medium tmb-1">Days 8-14 Ago</div>
                            <div class="ttext-2xl tfont-bold ttext-gray-800" id="prev7Revenue">₱0</div>
                            <div class="ttext-sm ttext-gray-600 tmt-1" id="prev7Orders">0 orders</div>
                        </div>
                    </div>
                </div>

                <!-- This Month vs Last Month -->
                <div class="tborder-2 tborder-gray-200 trounded-lg tp-6 hover:tshadow-md ttransition-shadow">
                    <div class="tflex titems-center tjustify-between tmb-4">
                        <h3 class="ttext-sm tfont-semibold ttext-gray-500 tuppercase ttracking-wide">This vs Last Month</h3>
                        <span id="monthChangePercent" class="tpx-3 tpy-1 trounded-full ttext-xs tfont-bold tbg-gray-100 ttext-gray-600">--</span>
                    </div>
                    
                    <div class="tspace-y-4">
                        <!-- This Month -->
                        <div class="tbg-gradient-to-br tfrom-green-50 tto-green-100 trounded-lg tp-4">
                            <div class="ttext-xs ttext-green-700 tfont-medium tmb-1">This Month</div>
                            <div class="ttext-3xl tfont-bold ttext-green-900" id="thisMonthRevenue">₱0</div>
                            <div class="ttext-sm ttext-green-700 tmt-1" id="thisMonthOrders">0 orders</div>
                        </div>
                        
                        <!-- Last Month -->
                        <div class="tbg-gray-50 trounded-lg tp-4">
                            <div class="ttext-xs ttext-gray-600 tfont-medium tmb-1">Last Month</div>
                            <div class="ttext-2xl tfont-bold ttext-gray-800" id="lastMonthRevenue">₱0</div>
                            <div class="ttext-sm ttext-gray-600 tmt-1" id="lastMonthOrders">0 orders</div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script>
        // Update change indicator
        function updateChangeIndicator(elementId, change) {
            const element = document.getElementById(elementId);
            if (!element) return;
            
            const isPositive = change >= 0;
            const arrow = isPositive ? '↑' : '↓';
            
            let colorClass;
            if (change > 0) {
                colorClass = 'tbg-green-100 ttext-green-800';
            } else if (change < 0) {
                colorClass = 'tbg-red-100 ttext-red-800';
            } else {
                colorClass = 'tbg-gray-100 ttext-gray-600';
            }
            
            element.className = 'tpx-3 tpy-1 trounded-full ttext-xs tfont-bold ' + colorClass;
            element.textContent = arrow + ' ' + Math.abs(change).toFixed(1) + '%';
        }

        // Load revenue comparison
        function loadRevenueComparison() {
            console.log('Loading revenue comparison...');
            
            document.getElementById('comparisonLoadingIndicator').classList.remove('thidden');
            
            fetch('{{ url("/admin/fbads/api/revenue-comparison") }}')
                .then(response => response.json())
                .then(data => {
                    console.log('Comparison data received:', data);
                    
                    // Today vs Yesterday
                    const todayData = data.today_vs_yesterday;
                    document.getElementById('todayLabel').textContent = todayData.today.label;
                    document.getElementById('yesterdayLabel').textContent = todayData.yesterday.label;
                    document.getElementById('todayRevenue').textContent = '₱' + todayData.today.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    document.getElementById('todayOrders').textContent = todayData.today.orders.toLocaleString() + ' orders';
                    document.getElementById('yesterdayRevenue').textContent = '₱' + todayData.yesterday.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    document.getElementById('yesterdayOrders').textContent = todayData.yesterday.orders.toLocaleString() + ' orders';
                    updateChangeIndicator('todayChangePercent', todayData.change);
                    
                    // Last 7 vs Previous 7
                    const week7Data = data.last_7_vs_previous_7;
                    document.getElementById('last7Revenue').textContent = '₱' + week7Data.last_7.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    document.getElementById('last7Orders').textContent = week7Data.last_7.orders.toLocaleString() + ' orders';
                    document.getElementById('prev7Revenue').textContent = '₱' + week7Data.previous_7.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    document.getElementById('prev7Orders').textContent = week7Data.previous_7.orders.toLocaleString() + ' orders';
                    updateChangeIndicator('week7ChangePercent', week7Data.change);
                    
                    // This Month vs Last Month
                    const monthData = data.this_month_vs_last_month;
                    document.getElementById('thisMonthRevenue').textContent = '₱' + monthData.this_month.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    document.getElementById('thisMonthOrders').textContent = monthData.this_month.orders.toLocaleString() + ' orders';
                    document.getElementById('lastMonthRevenue').textContent = '₱' + monthData.last_month.revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                    document.getElementById('lastMonthOrders').textContent = monthData.last_month.orders.toLocaleString() + ' orders';
                    updateChangeIndicator('monthChangePercent', monthData.change);
                    
                    document.getElementById('comparisonLoadingIndicator').classList.add('thidden');
                })
                .catch(error => {
                    console.error('Error loading comparison:', error);
                    document.getElementById('comparisonLoadingIndicator').classList.add('thidden');
                });
        }

        // Load on page load
        window.addEventListener('load', function() {
            setTimeout(function() {
                loadRevenueComparison();
            }, 500);
        });
        </script>












        <!-- Order Volume Heatmap -->
        <div class="tbg-white trounded-lg tshadow-lg tp-6 tmb-6">
            <!-- Header -->
            <div class="tflex tjustify-between titems-center tmb-6 tflex-wrap tgap-4">
                <h2 class="ttext-xl tfont-semibold ttext-gray-800">Daily Order Volume Heatmap</h2>
                
                <div class="tflex tgap-2 titems-center tflex-wrap">
                    <button onclick="filterHeatmap('last30')" 
                        id="heatmap-btn-last30"
                        class="heatmap-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1 tbg-pink-600 ttext-white">
                        Last 30 Days
                    </button>
                    <button onclick="filterHeatmap('month')" 
                        id="heatmap-btn-month"
                        class="heatmap-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1 tbg-pink-600 ttext-white">
                        This Month
                    </button>
                    <button onclick="filterHeatmap('lastmonth')" 
                        id="heatmap-btn-lastmonth"
                        class="heatmap-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1 tbg-pink-600 ttext-white">
                        Last Month
                    </button>
                    <button onclick="filterHeatmap('year')" 
                        id="heatmap-btn-year"
                        class="heatmap-filter-btn tpx-4 tpy-2 trounded-lg ttransition-all hover:tbg-white hover:ttext-pink-700 tborder hover:tborder-pink-600 focus:tbg-pink-600 focus:ttext-white browser-default tmx-1 tbg-pink-600 ttext-white">
                        Year
                    </button>
                </div>
            </div>

            <!-- Loading Indicator -->
            <div id="heatmapLoadingIndicator" class="thidden tflex tjustify-center titems-center tpy-8">
                <div class="tborder-4 tborder-pink-200 tborder-t-pink-600 trounded-full tw-10 th-10 tanimate-spin"></div>
            </div>

            <!-- Heatmap Chart -->
            <div id="orderHeatmap" style="min-height: 400px;"></div>
            
            <!-- Summary Cards -->
            <div class="tflex tmt-6">
                <div class="tbg-gradient-to-br tfrom-purple-500 tto-purple-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Peak Hour</div>
                    <div id="heatmapPeakHour" class="ttext-2xl tfont-bold tmt-2">--</div>
                </div>
                <div class="tbg-gradient-to-br tfrom-orange-500 tto-orange-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Peak Day</div>
                    <div id="heatmapPeakDay" class="ttext-2xl tfont-bold tmt-2">--</div>
                </div>
                <div class="tbg-gradient-to-br tfrom-teal-500 tto-teal-600 trounded-lg tp-6">
                    <div class="ttext-sm topacity-90">Busiest Period Orders</div>
                    <div id="heatmapBusiestOrders" class="ttext-2xl tfont-bold tmt-2">0</div>
                </div>
            </div>
        </div>


        <div class="tpx-4 tpb-6">
            <h2 class="ttext-md tmt-5 ttext-center tfont-bold ttext-gray-800 tmb-2">Orders by Promo</h2>
    
            <div class="tw-full tbg-white trounded-lg tshadow tp-6 tmb-8">
                <!-- Filter Buttons -->
                <div class="tflex tgap-3 tmb-4">
                    <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updatePromoChart('today')">Today</button>
                    <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updatePromoChart('last7')">Last 7 Days</button>
                    <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updatePromoChart('last30')">Last 30 Days</button>
                </div>
    
                <!-- Chart Container -->
                <div id="ordersByPromoPieChart"></div>
            </div>
        </div>





            <div class="tpx-4 tpb-6">
                <h2 class="ttext-md tmt-5 ttext-center tfont-bold ttext-gray-800 tmb-2">Order Fulfillment Status</h2>
        
                <div class="tw-full tbg-white trounded-lg tshadow tp-6 tmb-8">
                    <!-- Filter Buttons -->
                    <div class="tflex tgap-3 tmb-4">
                        <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updateStatusChart('today')">Today</button>
                        <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updateStatusChart('last7')">Last 7 Days</button>
                        <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updateStatusChart('last30')">Last 30 Days</button>
                    </div>
        
                    <!-- Chart Container -->
                    <div id="statusPieChart"></div>
                </div>
            </div>



            
            <div class="tpx-4 tpb-6">
                <h2 class="ttext-md tmt-5 ttext-center tfont-bold ttext-gray-800 tmb-2">Orders & Revenue by Time of Day</h2>
        
                <div class="tw-full tmax-w-6xl tbg-white trounded-lg tshadow tp-6 tmb-8">
                    <!-- Filter Buttons -->
                    <div class="tflex tgap-3 tmb-4">
                        <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updateTimeChart('today')">Today</button>
                        <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updateTimeChart('last7')">Last 7 Days</button>
                        <button class="tbg-gray-300 tmr-1 ttext-black tpx-4 tpy-2 trounded ttext-sm" onclick="updateTimeChart('last30')">Last 30 Days</button>
                    </div>
        
                    <!-- Chart Container -->
                    <div id="ordersTimeChart"></div>
                </div>
            </div>


            <div class="tpx-4 tpb-6">
                <table class="tw-full ttext-left">
                    <thead><tr><th>Phone</th><th>Total Orders</th><th>LTV (₱)</th></tr></thead>
                    <tbody>
                        @foreach($ltvData as $customer)
                            <tr>
                                <td>{{ $customer->phone_number }}</td>
                                <td>{{ $customer->orders }}</td>
                                <td>₱{{ number_format($customer->revenue, 2) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    @endsection


    @section('js')

        <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

        <script>

            $('input[name="date"]').daterangepicker({
                maxDate: moment(),
                ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });/// Date picker

            $('#date').change(function () {
                const parser = new URL(window.location.href);
                parser.searchParams.set("date", $(this).val());
                window.location = parser.href;
            });// Date on CHANGE


    
            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }

        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const promoData = {
                    today: {
                        labels: {!! json_encode($ordersByPromoToday->pluck('promo')) !!},
                        values: {!! json_encode($ordersByPromoToday->pluck('count')) !!}
                    },
                    last7: {
                        labels: {!! json_encode($ordersByPromo7->pluck('promo')) !!},
                        values: {!! json_encode($ordersByPromo7->pluck('count')) !!}
                    },
                    last30: {
                        labels: {!! json_encode($ordersByPromo30->pluck('promo')) !!},
                        values: {!! json_encode($ordersByPromo30->pluck('count')) !!}
                    }
                };

                const chartOptions = {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    labels: promoData.today.labels,
                    series: promoData.today.values,
                    colors: ['#f02074', '#FF9F43', '#00CFE8', '#28C76F', '#7367F0', '#EA5455']
                };

                const chart = new ApexCharts(document.querySelector("#ordersByPromoPieChart"), chartOptions);
                chart.render();

                // Handle button click
                window.updatePromoChart = function (range) {
                    chart.updateOptions({
                        labels: promoData[range].labels,
                        series: promoData[range].values
                    });
                };
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const statusData = {
                    today: {
                        labels: {!! json_encode($statusToday['labels']) !!},
                        values: {!! json_encode($statusToday['values']) !!},
                        percentages: {!! json_encode($statusToday['percentages']) !!}
                    },
                    last7: {
                        labels: {!! json_encode($status7['labels']) !!},
                        values: {!! json_encode($status7['values']) !!},
                        percentages: {!! json_encode($status7['percentages']) !!}
                    },
                    last30: {
                        labels: {!! json_encode($status30['labels']) !!},
                        values: {!! json_encode($status30['values']) !!},
                        percentages: {!! json_encode($status30['percentages']) !!}
                    }
                };

                let chart = new ApexCharts(document.querySelector("#statusPieChart"), {
                    chart: {
                        type: 'pie',
                        height: 350
                    },
                    series: statusData.today.values,
                    labels: statusData.today.labels,
                    colors: ['#f02074', '#00CFE8', '#28C76F', '#7367F0', '#FF9F43', '#EA5455'],
                    dataLabels: {
                        enabled: true,
                        formatter: function (val, opts) {
                            const percent = statusData.today.percentages[opts.seriesIndex] || 0;
                            const label = opts.w.globals.labels[opts.seriesIndex];
                            return `${label}: ${percent}%`;
                        }
                    },
                    legend: { position: 'bottom' }
                });

                chart.render();

                // Button click = update chart
                window.updateStatusChart = function (range) {
                    chart.updateOptions({
                        series: statusData[range].values,
                        labels: statusData[range].labels,
                        dataLabels: {
                            formatter: function (val, opts) {
                                const percent = statusData[range].percentages[opts.seriesIndex] || 0;
                                const label = opts.w.globals.labels[opts.seriesIndex];
                                return `${label}: ${percent}%`;
                            }
                        }
                    });
                };
            });
        </script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const timeData = {
                    today: {
                        labels: {!! json_encode($ordersRevenueToday['labels']) !!},
                        orders: {!! json_encode($ordersRevenueToday['orders']) !!},
                        revenue: {!! json_encode($ordersRevenueToday['revenue']) !!}
                    },
                    last7: {
                        labels: {!! json_encode($ordersRevenue7['labels']) !!},
                        orders: {!! json_encode($ordersRevenue7['orders']) !!},
                        revenue: {!! json_encode($ordersRevenue7['revenue']) !!}
                    },
                    last30: {
                        labels: {!! json_encode($ordersRevenue30['labels']) !!},
                        orders: {!! json_encode($ordersRevenue30['orders']) !!},
                        revenue: {!! json_encode($ordersRevenue30['revenue']) !!}
                    }
                };

                const chart = new ApexCharts(document.querySelector("#ordersTimeChart"), {
                    chart: {
                        height: 350,
                        type: 'line',
                        stacked: false
                    },
                    series: [
                        {
                            name: 'Orders',
                            type: 'column',
                            data: timeData.today.orders
                        },
                        {
                            name: 'Revenue',
                            type: 'line',
                            data: timeData.today.revenue
                        }
                    ],
                    xaxis: {
                        categories: timeData.today.labels,
                        labels: { rotate: -45 }
                    },
                    yaxis: [
                        {
                            title: { text: 'Orders' }
                        },
                        {
                            opposite: true,
                            title: { text: 'Revenue (₱)' }
                        }
                    ],
                    colors: ['#f02074', '#28C76F'],
                    dataLabels: { enabled: false },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: [{
                            formatter: val => val + ' orders'
                        }, {
                            formatter: val => '₱' + val.toLocaleString()
                        }]
                    }
                });

                chart.render();

                window.updateTimeChart = function (range) {
                    chart.updateSeries([
                        { name: 'Orders', type: 'column', data: timeData[range].orders },
                        { name: 'Revenue', type: 'line', data: timeData[range].revenue }
                    ]);
                    chart.updateOptions({
                        xaxis: { categories: timeData[range].labels }
                    });
                };
            });
        </script>



        <!-- // getOrdersChart -->
        <script>
            let ordersChart = null;
            let currentChartFilter = 'last30'; // Default to last 30 days

            function initOrdersChart(data) {
                console.log('initOrdersChart called with data:', data);
                
                if (!data || !data.categories || data.categories.length === 0) {
                    console.warn('No chart data available');
                    document.getElementById('chartLoadingIndicator').classList.add('thidden');
                    document.getElementById('ordersRevenueChart').innerHTML = '<div class="tflex tjustify-center titems-center tpy-20 ttext-gray-500">No data available for this period</div>';
                    return;
                }

                var options = {
                    series: [
                        {
                            name: 'Orders',
                            type: 'column',
                            data: data.orders
                        },
                        {
                            name: 'Revenue (₱)',
                            type: 'line',
                            data: data.revenue
                        }
                    ],
                    chart: {
                        height: 400,
                        type: 'line',
                        toolbar: { show: true },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800
                        }
                    },
                    stroke: {
                        width: [0, 4],
                        curve: 'smooth'
                    },
                    plotOptions: {
                        bar: {
                            borderRadius: 8,
                            columnWidth: '50%'
                        }
                    },
                    fill: {
                        type: ['solid', 'gradient'],
                        gradient: {
                            shade: 'light',
                            type: "vertical",
                            shadeIntensity: 0.25,
                            inverseColors: true,
                            opacityFrom: 0.85,
                            opacityTo: 0.85,
                            stops: [50, 0, 100]
                        }
                    },
                    colors: ['#ff1e8bff', '#10b981'],
                    labels: data.categories,
                    markers: { size: 0 },
                    xaxis: {
                        type: 'category',
                        labels: { 
                            style: { fontSize: '12px' },
                            rotate: -45,
                            rotateAlways: false
                        }
                    },
                    yaxis: [
                        {
                            title: {
                                text: 'Number of Orders',
                                style: { color: '#ff1e8bff', fontSize: '14px', fontWeight: 600 }
                            },
                            labels: { style: { colors: '#ff1e8bff' } }
                        },
                        {
                            opposite: true,
                            title: {
                                text: 'Revenue (₱)',
                                style: { color: '#10b981', fontSize: '14px', fontWeight: 600 }
                            },
                            labels: {
                                style: { colors: '#10b981' },
                                formatter: function(val) {
                                    return '₱' + val.toLocaleString();
                                }
                            }
                        }
                    ],
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function (y, { seriesIndex }) {
                                if (seriesIndex === 1) {
                                    return '₱' + y.toLocaleString();
                                }
                                return y + ' orders';
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                        fontSize: '14px',
                        markers: { width: 12, height: 12, radius: 12 }
                    },
                    grid: { borderColor: '#f1f1f1' }
                };

                if (ordersChart !== null) {
                    ordersChart.destroy();
                }
                
                const chartElement = document.querySelector("#ordersRevenueChart");
                if (chartElement) {
                    chartElement.innerHTML = ''; // Clear any "no data" message
                    ordersChart = new ApexCharts(chartElement, options);
                    ordersChart.render();
                    console.log('Chart rendered successfully');
                }
            }

            function updateChartButtonState(filter) {
                document.querySelectorAll('.chart-filter-btn').forEach(btn => {
                    btn.classList.remove('tbg-pink-600', 'ttext-white');
                    btn.classList.add('tbg-gray-100', 'ttext-gray-700');
                });
                
                const activeBtn = document.getElementById('chart-btn-' + filter);
                if (activeBtn) {
                    activeBtn.classList.remove('tbg-gray-100', 'ttext-gray-700');
                    activeBtn.classList.add('tbg-pink-600', 'ttext-white');
                }
            }

            function updateChartSummary(data) {
                if (!data || !data.summary) return;
                
                document.getElementById('chartTotalOrders').textContent = data.summary.total_orders.toLocaleString();
                document.getElementById('chartTotalRevenue').textContent = '₱' + data.summary.total_revenue.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
                document.getElementById('chartAvgOrderValue').textContent = '₱' + data.summary.avg_order_value.toLocaleString(undefined, {minimumFractionDigits: 2, maximumFractionDigits: 2});
            }

            function filterOrdersChart(filter) {
                console.log('filterOrdersChart called with filter:', filter);
                
                currentChartFilter = filter;
                updateChartButtonState(filter);
                
                document.getElementById('chartLoadingIndicator').classList.remove('thidden');
                document.getElementById('ordersRevenueChart').style.opacity = '0.3';
                
                fetch('{{ url("/admin/fbads/api/orders-chart") }}?filter=' + filter)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Chart data received:', data);
                        initOrdersChart(data);
                        updateChartSummary(data);
                        document.getElementById('chartLoadingIndicator').classList.add('thidden');
                        document.getElementById('ordersRevenueChart').style.opacity = '1';
                    })
                    .catch(error => {
                        console.error('Error loading chart:', error);
                        document.getElementById('chartLoadingIndicator').classList.add('thidden');
                        document.getElementById('ordersRevenueChart').style.opacity = '1';
                    });
            }

            function applyCustomDateChart() {
                const dateRange = document.getElementById('chartCustomDateRange').value;
                if (!dateRange) {
                    alert('Please select a date range');
                    return;
                }
                
                currentChartFilter = 'custom';
                updateChartButtonState('custom');
                
                document.getElementById('chartLoadingIndicator').classList.remove('thidden');
                document.getElementById('ordersRevenueChart').style.opacity = '0.3';
                
                fetch('{{ url("/admin/fbads/api/orders-chart") }}?filter=custom&date=' + encodeURIComponent(dateRange))
                    .then(response => response.json())
                    .then(data => {
                        console.log('Chart data received:', data);
                        initOrdersChart(data);
                        updateChartSummary(data);
                        document.getElementById('chartLoadingIndicator').classList.add('thidden');
                        document.getElementById('ordersRevenueChart').style.opacity = '1';
                    })
                    .catch(error => {
                        console.error('Error loading chart:', error);
                        document.getElementById('chartLoadingIndicator').classList.add('thidden');
                        document.getElementById('ordersRevenueChart').style.opacity = '1';
                    });
            }

            window.addEventListener('load', function() {
            console.log('Page fully loaded, initializing chart...');
            
            $('#chartCustomDateRange').daterangepicker({
                autoUpdateInput: false,
                locale: {
                    cancelLabel: 'Clear',
                    format: 'MM/DD/YYYY'
                }
            });
            
            $('#chartCustomDateRange').on('apply.daterangepicker', function(ev, picker) {
                $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            });
            
            $('#chartCustomDateRange').on('cancel.daterangepicker', function(ev, picker) {
                $(this).val('');
            });
            
            setTimeout(function() {
                console.log('Loading initial last30 data...');
                filterOrdersChart('last30');
            }, 100);
        });
        </script>

        <!-- Heatmap Chart -->
        <script>
            let orderHeatmap = null;
            let currentHeatmapFilter = 'last30';


            function initOrderHeatmap(data) {
        console.log('initOrderHeatmap called with data:', data);
        
        if (!data || !data.heatmap || data.heatmap.length === 0) {
            console.warn('No heatmap data available');
            document.getElementById('heatmapLoadingIndicator').classList.add('thidden');
            document.getElementById('orderHeatmap').innerHTML = '<div class="tflex tjustify-center titems-center tpy-20 ttext-gray-500">No data available for this period</div>';
            return;
        }

        var options = {
            series: data.heatmap,
            chart: {
                height: 450,
                type: 'heatmap',
                toolbar: { show: true }
            },
            plotOptions: {
                heatmap: {
                    shadeIntensity: 0.5,
                    radius: 0,
                    useFillColorAsStroke: true,
                    colorScale: {
                        ranges: [
                            {
                                from: 0,
                                to: 0,
                                name: 'No Orders',
                                color: '#e5e7eb'  // Gray - Coldest
                            },
                            {
                                from: 0.1,
                                to: 1,
                                name: '< 1 avg',
                                color: '#bfdbfe'  // Light Blue
                            },
                            {
                                from: 1.1,
                                to: 3,
                                name: '1-3 avg',
                                color: '#60a5fa'  // Blue
                            },
                            {
                                from: 3.1,
                                to: 5,
                                name: '3-5 avg',
                                color: '#fbbf24'  // Yellow/Orange
                            },
                            {
                                from: 5.1,
                                to: 8,
                                name: '5-8 avg',
                                color: '#f97316'  // Orange
                            },
                            {
                                from: 8.1,
                                to: 999,
                                name: '8+ avg',
                                color: '#dc2626'  // Red - Hottest
                            }
                        ]
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            xaxis: {
                type: 'category',
                labels: {
                    rotate: -45,
                    style: {
                        fontSize: '11px'
                    }
                }
            },
            yaxis: {
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            title: {
                text: 'Average Orders by Day of Week and Hour',
                align: 'center',
                style: {
                    fontSize: '16px',
                    fontWeight: 600,
                    color: '#374151'
                }
            },
            tooltip: {
                y: {
                    formatter: function(value) {
                        return value.toFixed(1) + ' avg orders';
                    }
                }
            },
            legend: {
                show: true,
                position: 'bottom',
                horizontalAlign: 'center',
                fontSize: '12px'
            }
        };

        if (orderHeatmap !== null) {
            orderHeatmap.destroy();
        }
        
        const chartElement = document.querySelector("#orderHeatmap");
        if (chartElement) {
            chartElement.innerHTML = '';
            orderHeatmap = new ApexCharts(chartElement, options);
            orderHeatmap.render();
            console.log('Heatmap rendered successfully');
        }
    }


            // Update heatmap button states
            function updateHeatmapButtonState(filter) {
                document.querySelectorAll('.heatmap-filter-btn').forEach(btn => {
                    btn.classList.remove('tbg-pink-600', 'ttext-white');
                    btn.classList.add('tbg-gray-100', 'ttext-gray-700');
                });
                
                const activeBtn = document.getElementById('heatmap-btn-' + filter);
                if (activeBtn) {
                    activeBtn.classList.remove('tbg-gray-100', 'ttext-gray-700');
                    activeBtn.classList.add('tbg-pink-600', 'ttext-white');
                }
            }

            // Update heatmap summary
            function updateHeatmapSummary(data) {
                if (!data || !data.summary) return;
                
                document.getElementById('heatmapPeakHour').textContent = data.summary.peak_hour;
                document.getElementById('heatmapPeakDay').textContent = data.summary.peak_day;
                document.getElementById('heatmapBusiestOrders').textContent = data.summary.busiest_orders.toLocaleString();
            }

            // Filter heatmap
            function filterHeatmap(filter) {
                console.log('filterHeatmap called with filter:', filter);
                
                currentHeatmapFilter = filter;
                updateHeatmapButtonState(filter);
                
                document.getElementById('heatmapLoadingIndicator').classList.remove('thidden');
                document.getElementById('orderHeatmap').style.opacity = '0.3';
                
                fetch('{{ url("/admin/fbads/api/order-heatmap") }}?filter=' + filter)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Heatmap data received:', data);
                        initOrderHeatmap(data);
                        updateHeatmapSummary(data);
                        document.getElementById('heatmapLoadingIndicator').classList.add('thidden');
                        document.getElementById('orderHeatmap').style.opacity = '1';
                    })
                    .catch(error => {
                        console.error('Error loading heatmap:', error);
                        document.getElementById('heatmapLoadingIndicator').classList.add('thidden');
                        document.getElementById('orderHeatmap').style.opacity = '1';
                    });
            }

            // Load heatmap on page load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    console.log('Loading initial heatmap data...');
                    filterHeatmap('last30');
                }, 200);
            });
        </script>
        <!-- Heatmap Chart -->


        <!-- TOP 10 Products By Order Volume -->
        <script>
            let topProductsChart = null;
            let currentProductsFilter = 'last30';
            let currentProductsView = 'orders'; // 'orders' or 'revenue'
            let productsData = null;


            function initTopProductsChart(data, view) {
                console.log('initTopProductsChart called with view:', view);
                
                if (!data || !data.by_orders || !data.by_revenue) {
                    console.warn('No products data available');
                    document.getElementById('productsLoadingIndicator').classList.add('thidden');
                    document.getElementById('topProductsChart').innerHTML = '<div class="tflex tjustify-center titems-center tpy-20 ttext-gray-500">No data available for this period</div>';
                    return;
                }
                
                productsData = data;
                
                // Select data based on view
                const chartData = view === 'orders' ? data.by_orders : data.by_revenue;
                
                // Truncate long product names
                const truncatedProducts = chartData.products.map(p => {
                    return p.length > 40 ? p.substring(0, 37) + '...' : p;
                });

                var options = {
                    series: [
                        {
                            name: 'Orders',
                            type: 'bar',
                            data: chartData.orders
                        },
                        {
                            name: 'Revenue (₱)',
                            type: 'bar',
                            data: chartData.revenue
                        }
                    ],
                    chart: {
                        height: 600, // Increased height
                        type: 'bar',
                        toolbar: { show: true },
                        animations: {
                            enabled: true,
                            easing: 'easeinout',
                            speed: 800
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: true,
                            barHeight: '80%', // Increased bar height
                            dataLabels: {
                                position: 'right' // Changed from 'top' to 'right'
                            }
                        }
                    },
                    colors: ['#ec4899', '#6bafeaff'], // Pink for orders, your green for revenue
                    dataLabels: {
                        enabled: true,
                        formatter: function(val, opts) {
                            if (opts.seriesIndex === 0) {
                                return val + ' orders';
                            } else {
                                return '₱' + val.toLocaleString();
                            }
                        },
                        offsetX: 5,
                        style: {
                            fontSize: '12px',
                            fontWeight: 600,
                            colors: ['#fff', 'black']
                        },
                        background: {
                            enabled: true,
                            foreColor: '#fff',
                            padding: 4,
                            borderRadius: 2,
                            borderWidth: 0,
                            opacity: 0.9
                        }
                    },
                    xaxis: {
                        categories: truncatedProducts,
                        labels: {
                            formatter: function(val) {
                                if (typeof val === 'number') {
                                    return val.toLocaleString();
                                }
                                return val;
                            },
                            style: {
                                fontSize: '11px'
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                fontSize: '13px',
                                fontWeight: 500
                            },
                            maxWidth: 250 // Increased max width for product names
                        }
                    },
                    title: {
                        text: view === 'orders' ? 'Top 10 Products by Order Volume' : 'Top 10 Products by Revenue',
                        align: 'center',
                        style: {
                            fontSize: '16px',
                            fontWeight: 600,
                            color: '#374151'
                        }
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        y: {
                            formatter: function (y, { seriesIndex, dataPointIndex }) {
                                if (seriesIndex === 0) {
                                    return y + ' orders';
                                } else {
                                    const aov = chartData.aov[dataPointIndex];
                                    return '₱' + y.toLocaleString() + ' (AOV: ₱' + aov.toLocaleString() + ')';
                                }
                            }
                        }
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'left',
                        fontSize: '14px',
                        markers: { width: 12, height: 12, radius: 12 }
                    },
                    grid: {
                        borderColor: '#f1f1f1',
                        padding: {
                            right: 30 // Add padding on the right for labels
                        }
                    }
                };

                if (topProductsChart !== null) {
                    topProductsChart.destroy();
                }
                
                const chartElement = document.querySelector("#topProductsChart");
                if (chartElement) {
                    chartElement.innerHTML = '';
                    topProductsChart = new ApexCharts(chartElement, options);
                    topProductsChart.render();
                    console.log('Products chart rendered successfully');
                }
            }

            // Toggle between orders and revenue view
            function toggleProductView(view) {
                currentProductsView = view;
                
                // Update button states
                document.querySelectorAll('.product-view-btn').forEach(btn => {
                    btn.classList.remove('tbg-white', 'ttext-gray-900', 'tshadow-sm');
                    btn.classList.add('ttext-gray-600');
                });
                
                const activeBtn = document.getElementById('product-view-' + view);
                if (activeBtn) {
                    activeBtn.classList.remove('ttext-gray-600');
                    activeBtn.classList.add('tbg-white', 'ttext-gray-900', 'tshadow-sm');
                }
                
                // Re-render chart with new view
                if (productsData) {
                    initTopProductsChart(productsData, view);
                }
            }

            // Update products button states
            function updateProductsButtonState(filter) {
                document.querySelectorAll('.products-filter-btn').forEach(btn => {
                    btn.classList.remove('tbg-pink-600', 'ttext-white');
                    btn.classList.add('tbg-gray-100', 'ttext-gray-700');
                });
                
                const activeBtn = document.getElementById('products-btn-' + filter);
                if (activeBtn) {
                    activeBtn.classList.remove('tbg-gray-100', 'ttext-gray-700');
                    activeBtn.classList.add('tbg-pink-600', 'ttext-white');
                }
            }

            // Update products summary
            function updateProductsSummary(data) {
                if (!data || !data.summary) return;
                
                document.getElementById('productsTotalProducts').textContent = data.summary.total_products;
                document.getElementById('productsTopProduct').textContent = data.summary.top_product;
                document.getElementById('productsTopRevenue').textContent = data.summary.top_revenue_product;
            }


            // Filter products
            function filterTopProducts(filter) {
                console.log('filterTopProducts called with filter:', filter);
                
                currentProductsFilter = filter;
                updateProductsButtonState(filter);
                
                document.getElementById('productsLoadingIndicator').classList.remove('thidden');
                document.getElementById('topProductsChart').style.opacity = '0.3';
                
                const url = '{{ url("/admin/fbads/api/top-products") }}?filter=' + filter;
                console.log('Fetching from URL:', url); // Debug log
                
                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok: ' + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Products data received:', data);
                        initTopProductsChart(data, currentProductsView);
                        updateProductsSummary(data);
                        document.getElementById('productsLoadingIndicator').classList.add('thidden');
                        document.getElementById('topProductsChart').style.opacity = '1';
                    })
                    .catch(error => {
                        console.error('Error loading products:', error);
                        document.getElementById('productsLoadingIndicator').classList.add('thidden');
                        document.getElementById('topProductsChart').style.opacity = '1';
                        alert('Failed to load products data. Check console for details.');
                    });
            }


            // Load products on page load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    console.log('Loading initial products data...');
                    filterTopProducts('last30');
                }, 300);
            });
        </script>
        <!-- TOP 10 Products By Order Volume -->

        <!-- Revenue Comparison with Smart Time Periods! 🚀 -->
        <script>
            let repeatRateGauge = null;
            let customerBreakdownChart = null;
            let currentRepeatRateFilter = 'last30';

            // Initialize gauge chart
            function initRepeatRateGauge(repeatRate) {
                var options = {
                    series: [repeatRate],
                    chart: {
                        height: 350,
                        type: 'radialBar',
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -135,
                            endAngle: 135,
                            hollow: {
                                margin: 0,
                                size: '70%',
                                background: '#fff',
                            },
                            track: {
                                background: '#e7e7e7',
                                strokeWidth: '97%',
                                margin: 5,
                            },
                            dataLabels: {
                                show: true,
                                name: {
                                    offsetY: -10,
                                    show: true,
                                    color: '#374151',
                                    fontSize: '16px',
                                    fontWeight: 600
                                },
                                value: {
                                    formatter: function(val) {
                                        return val.toFixed(1) + '%';
                                    },
                                    color: '#111',
                                    fontSize: '42px',
                                    fontWeight: 700,
                                    show: true,
                                }
                            }
                        }
                    },
                    fill: {
                        type: 'gradient',
                        gradient: {
                            shade: 'dark',
                            type: 'horizontal',
                            shadeIntensity: 0.5,
                            gradientToColors: ['#10b981'],
                            inverseColors: false,
                            opacityFrom: 1,
                            opacityTo: 1,
                            stops: [0, 100]
                        }
                    },
                    colors: ['#ec4899'],
                    labels: ['Repeat Rate'],
                };

                if (repeatRateGauge !== null) {
                    repeatRateGauge.destroy();
                }
                
                const chartElement = document.querySelector("#repeatRateGauge");
                if (chartElement) {
                    chartElement.innerHTML = '';
                    repeatRateGauge = new ApexCharts(chartElement, options);
                    repeatRateGauge.render();
                }
            }

            // Initialize breakdown chart
            function initCustomerBreakdownChart(breakdown) {
                var options = {
                    series: [
                        breakdown['1_order'],
                        breakdown['2_orders'],
                        breakdown['3_orders'],
                        breakdown['4_orders'],
                        breakdown['5_plus_orders']
                    ],
                    chart: {
                        height: 350,
                        type: 'donut',
                    },
                    labels: ['1 Order', '2 Orders', '3 Orders', '4 Orders', '5+ Orders'],
                    colors: ['#ef4444', '#f59e0b', '#10b981', '#3b82f6', '#8b5cf6'],
                    legend: {
                        position: 'bottom',
                        fontSize: '13px'
                    },
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '65%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: true,
                                        label: 'Total Customers',
                                        fontSize: '14px',
                                        fontWeight: 600,
                                        color: '#374151',
                                        formatter: function (w) {
                                            return w.globals.seriesTotals.reduce((a, b) => a + b, 0);
                                        }
                                    }
                                }
                            }
                        }
                    },
                    dataLabels: {
                        enabled: true,
                        formatter: function(val, opts) {
                            return opts.w.config.series[opts.seriesIndex];
                        },
                        style: {
                            fontSize: '13px',
                            fontWeight: 600
                        }
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + ' customers';
                            }
                        }
                    }
                };

                if (customerBreakdownChart !== null) {
                    customerBreakdownChart.destroy();
                }
                
                const chartElement = document.querySelector("#customerBreakdownChart");
                if (chartElement) {
                    chartElement.innerHTML = '';
                    customerBreakdownChart = new ApexCharts(chartElement, options);
                    customerBreakdownChart.render();
                }
            }

            // Update summary cards
            function updateRepeatRateSummary(data) {
                if (!data) return;
                
                document.getElementById('repeatTotalCustomers').textContent = data.total_customers.toLocaleString();
                document.getElementById('repeatRepeatCustomers').textContent = data.repeat_customers.toLocaleString();
                document.getElementById('repeatOneTimeCustomers').textContent = data.one_time_customers.toLocaleString();
                document.getElementById('repeatAvgOrders').textContent = data.avg_orders_per_customer.toFixed(1);
            }

            // Update top customers table
            function updateTopCustomersTable(customers) {
                const tableBody = document.getElementById('topRepeatCustomersTable');
                
                if (!customers || customers.length === 0) {
                    tableBody.innerHTML = '<tr><td colspan="5" class="ttext-center tpy-8 ttext-gray-500">No repeat customers found</td></tr>';
                    return;
                }
                
                let html = '';
                customers.forEach((customer, index) => {
                    html += `
                        <tr class="tborder-t hover:tbg-gray-50">
                            <td class="tp-3 ttext-sm ttext-gray-900">${index + 1}</td>
                            <td class="tp-3 ttext-sm tfont-medium ttext-gray-900">${customer.phone}</td>
                            <td class="tp-3 ttext-sm ttext-center ttext-gray-900">
                                <span class="tbg-pink-100 ttext-pink-800 tpx-2 tpy-1 trounded-full ttext-xs tfont-semibold">
                                    ${customer.orders} orders
                                </span>
                            </td>
                            <td class="tp-3 ttext-sm ttext-right ttext-gray-900 tfont-semibold">₱${customer.revenue.toLocaleString()}</td>
                            <td class="tp-3 ttext-sm ttext-right ttext-gray-600">₱${customer.aov.toLocaleString()}</td>
                        </tr>
                    `;
                });
                
                tableBody.innerHTML = html;
            }

            // Update button states
            function updateRepeatRateButtonState(filter) {
                document.querySelectorAll('.repeat-filter-btn').forEach(btn => {
                    btn.classList.remove('tbg-pink-600', 'ttext-white');
                    btn.classList.add('tbg-gray-100', 'ttext-gray-700');
                });
                
                const activeBtn = document.getElementById('repeat-btn-' + filter);
                if (activeBtn) {
                    activeBtn.classList.remove('tbg-gray-100', 'ttext-gray-700');
                    activeBtn.classList.add('tbg-pink-600', 'ttext-white');
                }
            }

            // Filter repeat rate
            function filterRepeatRate(filter) {
                console.log('filterRepeatRate called with filter:', filter);
                
                currentRepeatRateFilter = filter;
                updateRepeatRateButtonState(filter);
                
                document.getElementById('repeatRateLoadingIndicator').classList.remove('thidden');
                document.getElementById('repeatRateGauge').style.opacity = '0.3';
                document.getElementById('customerBreakdownChart').style.opacity = '0.3';
                
                fetch('{{ url("/admin/fbads/api/customer-repeat-rate") }}?filter=' + filter)
                    .then(response => response.json())
                    .then(data => {
                        console.log('Repeat rate data received:', data);
                        initRepeatRateGauge(data.repeat_rate);
                        initCustomerBreakdownChart(data.breakdown);
                        updateRepeatRateSummary(data);
                        updateTopCustomersTable(data.top_repeat_customers);
                        document.getElementById('repeatRateLoadingIndicator').classList.add('thidden');
                        document.getElementById('repeatRateGauge').style.opacity = '1';
                        document.getElementById('customerBreakdownChart').style.opacity = '1';
                    })
                    .catch(error => {
                        console.error('Error loading repeat rate:', error);
                        document.getElementById('repeatRateLoadingIndicator').classList.add('thidden');
                        document.getElementById('repeatRateGauge').style.opacity = '1';
                        document.getElementById('customerBreakdownChart').style.opacity = '1';
                    });
            }

            // Load on page load
            window.addEventListener('load', function() {
                setTimeout(function() {
                    console.log('Loading initial repeat rate data...');
                    filterRepeatRate('last30');
                }, 400);
            });
        </script>
        <!-- Revenue Comparison with Smart Time Periods! 🚀 -->

@endsection