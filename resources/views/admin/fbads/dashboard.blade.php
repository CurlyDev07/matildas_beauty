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
    


       <div class="tpx-4 tpy-6">
            <!-- Orders & Revenue Cards -->
            <div class="tflex tflex-wrap tgap-6 tmb-6">
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

            <!-- AOV Cards -->
            <div class="tflex tflex-wrap tgap-6">
                <!-- AOV Today -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#fde4ee] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">AOV Today</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($aovToday, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Week -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e0f1ff] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">AOV This Week</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($aovWeek, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Month -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e3fcef] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">AOV This Month</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($aovMonth, 2) }}</p>
                    </div>
                </a>
            </div>

            <!-- AOV Cards -->
            <div class="tflex tflex-wrap tgap-6">
                <!-- AOV Today -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#fde4ee] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">New AOV Today</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($new_aovToday, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Week -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e0f1ff] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">New AOV This Week</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($new_aovWeek, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Month -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e3fcef] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">New AOV This Month</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($new_aovMonth, 2) }}</p>
                    </div>
                </a>
            </div>
            
            <hr>

                        <!-- AOV Cards -->
            <div class="tflex tflex-wrap tgap-6">
                <!-- AOV Today -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#fde4ee] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">Upsell Today</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($upsellToday, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Week -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e0f1ff] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">Upsell This Week</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($upsellWeek, 2) }}</p>
                    </div>
                </a>

                <!-- AOV This Month -->
                <a href="#" class="tgroup tflex-1 tmin-w-[250px] ttransition-all hover:tscale-[1.02] hover:tshadow-lg tduration-200 tm-5">
                    <div class="tbg-[#e3fcef] trounded-2xl tp-4 tpx-6 tshadow-md ttext-center tfade-in">
                        <div class="ttext-3xl tmb-2">📈</div>
                        <h3 class="ttext-lg tfont-semibold">Upsell This Month</h3>
                        <p class="ttext-4xl tfont-bold tmt-2" style="color: #2d2d2d;">₱{{ number_format($upsellMonth, 2) }}</p>
                    </div>
                </a>
            </div>
        </div>





        


        <div class="tpx-4 tpb-6">
            <!-- Title -->
            <h2 class="ttext-md tmt-5 ttext-center tfont-bold ttext-gray-800 tmb-2">Orders in the Last 7 Days</h2>
    
            <!-- Chart Container -->
            <div class="tw-full tmax-w-4xl tmt-8">
                <div id="ordersPerDayChart" class="tbg-white trounded-lg tshadow p-6"></div>
            </div>
        </div>




        <div class="tpx-4 tpb-6">
            <h2 class="ttext-md tmt-5 ttext-center tfont-bold ttext-gray-800 tmb-2">Orders by Promo</h2>
    
            <div class="tw-full tmax-w-4xl tbg-white trounded-lg tshadow tp-6 tmb-8">
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
    
            <div class="tw-full tmax-w-4xl tbg-white trounded-lg tshadow tp-6 tmb-8">
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
            const options = {
                chart: {
                    type: 'bar',
                    height: 350,
                    toolbar: { show: true }
                },
                series: [{
                    name: 'Orders',
                    data: @json($ordersPerDay)
                }],
                xaxis: {
                    categories: @json($days),
                    labels: {
                        style: {
                            colors: '#333',
                            fontSize: '14px'
                        }
                    }
                },
                colors: ['#f02074'],
                plotOptions: {
                    bar: {
                        borderRadius: 6,
                        columnWidth: '50%'
                    }
                },
                dataLabels: { enabled: false },
                yaxis: {
                    title: { text: 'Order Count' }
                }
            };

            const chart = new ApexCharts(document.querySelector("#ordersPerDayChart"), options);
            chart.render();
        });
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

@endsection