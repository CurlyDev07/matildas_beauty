@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    
    <style>
        /* Custom pink theme for Flatpickr */
        .flatpickr-calendar {
            font-family: inherit;
        }
        .flatpickr-day.selected,
        .flatpickr-day.startRange,
        .flatpickr-day.endRange,
        .flatpickr-day.selected:hover,
        .flatpickr-day.startRange:hover,
        .flatpickr-day.endRange:hover {
            background-color: #f02074;
            border-color: #f02074;
            color: #fff;
        }
        .flatpickr-day.inRange {
            background-color: #fbd1df;
            color: #000;
        }
        .flatpickr-day.today {
            border-color: #f02074;
        }
        .flatpickr-months .flatpickr-month {
            color: #f02074;
        }
        .flatpickr-months .flatpickr-next-month,
        .flatpickr-months .flatpickr-prev-month {
            color: #f02074;
        }
        .flatpickr-weekdays {
            color: #f02074;
            font-weight: 500;
        }
    </style>

    <style>
        .tdropzone {
            @apply tbg-blue-100 tborder-blue-500;
        }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

@endsection

@section('page')

    <div class="tbg-white tmx-auto tshadow-2xl tw-full">

        @if(session('success'))
            <div class="tbg-green-100 ttext-green-700 tp-4 trounded tmb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('skipped') && count(session('skipped')))
            <div class="tbg-yellow-100 ttext-yellow-800 tp-4 trounded tmb-4">
                <strong>Skipped duplicates:</strong>
                <ul class="ttext-sm">
                    @foreach(session('skipped') as $ad)
                        <li>- {{ $ad }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('fbads.meta_metrics.post') }}" method="POST" enctype="multipart/form-data"
            class="tborder tborder-dashed tborder-gray-400 trounded tpx-6 tpy-10 ttext-center"
            ondragover="this.classList.add('tdropzone');" 
            ondragleave="this.classList.remove('tdropzone');">
            @csrf

            <label for="excel_file" class="tcursor-pointer tblock ttext-gray-600">
                <span class="ttext-xl tfont-semibold">📤 Drop your Ad Data Excel here</span><br>
                <span class="ttext-sm">or click to browse</span>
            </label>
            <input type="file" name="excel_file" id="excel_file" class="thidden" accept=".xlsx,.xls" onchange="this.form.submit()">

            @error('excel_file')
                <div class="ttext-red-500 tmt-2">{{ $message }}</div>
            @enderror
        </form>
    </div> {{-- UPLOAD --}}

    <div class="tmx-auto tw-full tmt-5">
        <div class="tpy-3 tbg-white tshadow-2xl trelative trounded">
            <span class="tabsolute tfont-medium tml-5 ttext-lg">Spend vs Profit</span>
            <div class="tmb-2 ttext-right tmr-10">
                <i class="fa fa-calendar t-ml-3 tabsolute" style="margin-top: 11px; margin-left: 18px;"></i>&nbsp;
                <input type="text" id="spendProfitRange" class="browser-default tborder tpx-3 tpy-2 trounded ttext-sm tpx-8" readonly style="max-width: 220px;" />
                <span></span> <i class="fa fa-caret-down" style="margin-top: 11px; margin-left: -28px;"></i>
            </div>
            <div id="spendProfitChart" class="tbg-white"></div>
        </div> <!-- spendProfitDate -->

        <div class="tpy-3 tbg-white tshadow-2xl trelative tmt-5">
            <span class="tabsolute tfont-medium tml-5 ttext-lg">ROAS per Ad</span>
             <div class="tmb-2 ttext-right tmr-10">
                <i class="fa fa-calendar t-ml-3 tabsolute" style="margin-top: 11px; margin-left: 18px;"></i>&nbsp;
                <input type="text" id="roasPerAdRange" class="browser-default tborder tpx-3 tpy-2 trounded ttext-sm tpx-8" readonly style="max-width: 220px;" />
                <span></span> <i class="fa fa-caret-down" style="margin-top: 11px; margin-left: -28px;"></i>
            </div>
            <div id="roasPerAdChart" class="tbg-white"></div>
        </div>

        <div class="tpy-3 tbg-white tshadow-2xl trelative tmt-5">
            <span class="tabsolute tfont-medium tml-5 ttext-lg">Ad Insights: CTR / Frequency / ROAS Over Time</span>
            <br>
            <div class="tflex tjustify-end titems-center tgap-4 tmr-10 tmx-5 tmt-3">
                <select id="adSelect" class="tborder tpx-4 tpy-2 trounded ttext-sm browser-default tw-full tmr-5" style="height: 36px;">
                    <option value="">Select Ad</option>
                </select>
                 <div class="trelative">
                    <i class="fa fa-calendar tabsolute" style="margin-top: 11px; margin-left: 10px;"></i>
                    <input type="text" id="historicalRange" class="tborder tpx-8 tpy-2 trounded ttext-sm browser-default" readonly style="max-width: 220px;" />
                    <i class="fa fa-caret-down tabsolute" style="margin-top: 11px; margin-left: -28px;"></i>
                </div>
            </div>

            <div id="adHistoricalChart" class="tbg-white tmt-4"></div>
        </div>

        <div class="tpy-3 tbg-white tshadow-2xl trelative tmt-5">
            <div class="tpy-3 tbg-white tshadow-2xl trelativetmt-5">
                <span class="tabsolute tfont-medium tml-5 ttext-lg">Daily Profit</span>
                <div class="tmb-2 ttext-right tmr-10">
                    <i class="fa fa-calendar tabsolute" style="margin-top: 11px; margin-left: 18px;"></i>&nbsp;
                    <input type="text" id="profitRange" class="browser-default tborder tpx-3 tpy-2 trounded ttext-sm tpx-8 browser-default" readonly style="max-width: 220px;" />
                    <span></span> <i class="fa fa-caret-down" style="margin-top: 11px; margin-left: -28px;"></i>
                </div>
                <div id="profitChart" class="tbg-white"></div>
            </div>
        </div>

    </div>  

@endsection

@section('js')
    <!-- JS Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>



    <script>
        $(document).ready(function () {

            // <!-- ================= Spend vs Profit ================= -->
                let spendProfitChart = null;

                function fetchSpendProfitData(startDate, endDate) {
                    $.ajax({
                        url: "/admin/fbads/meta-metrics/data/spend-profit",
                        method: "GET",
                        data: {
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function (response) {
                            if (!Array.isArray(response)) {
                                console.error("Invalid response format", response);
                                return;
                            }

                            const cleaned = response.filter(item =>
                                item.ad_name && (item.amount_spent !== null || item.profit !== null)
                            );

                            // ✅ If no data, show message and stop rendering
                            if (cleaned.length === 0) {
                                if (spendProfitChart) spendProfitChart.destroy();
                                $('#spendProfitChart').html('<div class="ttext-center ttext-gray-500 tpy-10">No data available</div>');
                                return;
                            }

                            $('#spendProfitChart').empty(); // Clear old message if exists

                            const categories = cleaned.map(item => item.ad_name);
                            const spendData = cleaned.map(item => parseFloat(item.amount_spent) || 0);
                            const profitData = cleaned.map(item => parseFloat(item.profit) || 0);

                            const chartOptions = {
                                chart: {
                                    type: 'bar',
                                    height: 450
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: true,
                                        barHeight: '90%',
                                        dataLabels: {
                                            position: 'top'
                                        }
                                    }
                                },
                                colors: ['#f87171', '#34d399'],
                                dataLabels: {
                                    enabled: true,
                                    offsetX: -40,
                                    style: {
                                        fontSize: '12px'
                                    },
                                    formatter: val => `₱${parseFloat(val).toLocaleString()}`
                                },
                                series: [
                                    { name: 'Ad Spend', data: spendData },
                                    { name: 'Profit', data: profitData }
                                ],
                                xaxis: {
                                    categories: categories,
                                    labels: {
                                        style: { fontSize: '12px' }
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: 100,
                                        right: 100
                                    }
                                },
                                tooltip: {
                                    shared: true,
                                    intersect: false,
                                    y: {
                                        formatter: val => `₱${parseFloat(val).toLocaleString()}`
                                    }
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            if (spendProfitChart) spendProfitChart.destroy();
                            spendProfitChart = new ApexCharts(document.querySelector("#spendProfitChart"), chartOptions);
                            spendProfitChart.render();
                        },
                        error: function (xhr, status, error) {
                            console.error("Fetch failed:", error);
                        }
                    });
                }

                // 📅 Initialize Date Range Picker with Predefined Ranges
                const initialStart = moment().subtract(6, 'days');
                const initialEnd = moment();

                $('#spendProfitRange').daterangepicker({
                    startDate: initialStart,
                    endDate: initialEnd,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function (start, end) {
                    fetchSpendProfitData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                });

                // 🔁 Initial Load
                fetchSpendProfitData(initialStart.format('YYYY-MM-DD'), initialEnd.format('YYYY-MM-DD'));

            // <!-- ================= Spend vs Profit ================= -->




            // <!-- =================  <!-- Roas Per Ad -->  ================= -->

                let roasChart = null;

                function fetchRoasPerAdData(startDate, endDate) {
                    $.ajax({
                        url: "/admin/fbads/meta-metrics/data/roas-per-ad",
                        method: "GET",
                        data: {
                            start_date: startDate,
                            end_date: endDate
                        },
                        success: function (response) {
                            if (!Array.isArray(response)) {
                                console.error("Invalid response format", response);
                                return;
                            }

                            const cleaned = response.filter(item => item.ad_name && item.roas !== null);

                            if (cleaned.length === 0) {
                                $('#roasPerAdChart').html('<div class="ttext-center ttext-gray-500 tpy-10">No data available</div>');
                                if (roasChart) roasChart.destroy();
                                return;
                            }

                            const labels = cleaned.map(item => item.ad_name);
                            const values = cleaned.map(item => parseFloat(item.roas));

                            const chartOptions = {
                                chart: {
                                    type: 'bar',
                                    height: 250
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: true,
                                        barHeight: '90%',
                                        dataLabels: {
                                            position: 'top'
                                        }
                                    }
                                },
                                colors: ['#3b82f6'],
                                dataLabels: {
                                    enabled: true,
                                    offsetX: -40,
                                    style: {
                                        fontSize: '12px'
                                    },
                                    formatter: val => `${val.toFixed(2)}x`
                                },
                                series: [{ name: 'ROAS', data: values }],
                                xaxis: {
                                    categories: labels,
                                    labels: {
                                        style: { fontSize: '12px' }
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: 100,
                                        right: 100
                                    }
                                },
                                tooltip: {
                                    y: {
                                        formatter: val => `${val.toFixed(2)}x`
                                    }
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            $('#roasPerAdChart').empty();
                            roasChart = new ApexCharts(document.querySelector("#roasPerAdChart"), chartOptions);
                            roasChart.render();
                        },
                        error: function (xhr, status, error) {
                            console.error("Fetch failed:", error);
                        }
                    });
                }

                const start = moment().subtract(6, 'days');
                const end = moment();

                $('#roasPerAdRange').daterangepicker({
                    startDate: start,
                    endDate: end,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function (start, end) {
                    fetchRoasPerAdData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                });

                // Auto fetch on load
                fetchRoasPerAdData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));

            // <!-- =================  <!-- Roas Per Ad -->  ================= -->



            // <!-- =================  <!-- CTR, Frequency & ROAS per Ad -->  ================= -->
                let selectedAd = '';
                    let selectedStart = moment().subtract(6, 'days');
                    let selectedEnd = moment();

                    function loadAdList() {
                        $.get('/admin/fbads/meta-metrics/data/ad-list', function (ads) {
                            ads.forEach(ad => {
                                $('#adSelect').append(`<option value="${ad}">${ad}</option>`);
                            });
                        });
                    }

                    function fetchAdHistory(adName, startDate, endDate) {
                        $.get('/admin/fbads/meta-metrics/data/ad-history', {
                            ad_name: adName,
                            start_date: startDate,
                            end_date: endDate
                        }, function (data) {
                            if (!Array.isArray(data) || data.length === 0) {
                                $('#adHistoricalChart').html('<div class="ttext-center ttext-gray-500 tpy-10">No historical data</div>');
                                return;
                            }

                            const labels = data.map(d => d.reporting_start);
                            const ctr = data.map(d => parseFloat(d.ctr ?? 0));
                            const freq = data.map(d => parseFloat(d.frequency ?? 0));
                            const roas = data.map(d => parseFloat(d.roas ?? 0));

                            const options = {
                                chart: { type: 'line', height: 450 },
                                stroke: { width: 2, curve: 'smooth' },
                                colors: ['#60a5fa', '#facc15', '#34d399'],
                                series: [
                                    { name: 'CTR (%)', data: ctr },
                                    { name: 'Frequency', data: freq },
                                    { name: 'ROAS', data: roas }
                                ],
                                xaxis: {
                                    categories: labels,
                                    title: { text: 'Date' },
                                    labels: { style: { fontSize: '12px' } }
                                },
                                tooltip: {
                                    shared: true,
                                    intersect: false,
                                    y: {
                                        formatter: val => parseFloat(val).toFixed(2)
                                    }
                                },
                                legend: { position: 'top' }
                            };

                            const chartEl = document.querySelector("#adHistoricalChart");
                            chartEl.innerHTML = "";
                            const chart = new ApexCharts(chartEl, options);
                            chart.render();
                        });
                    }

                    $('#adSelect').on('change', function () {
                        selectedAd = $(this).val();
                        if (selectedAd) {
                            fetchAdHistory(selectedAd, selectedStart.format('YYYY-MM-DD'), selectedEnd.format('YYYY-MM-DD'));
                        } else {
                            $('#adHistoricalChart').html('');
                        }
                    });

                    $('#historicalRange').daterangepicker({
                        startDate: selectedStart,
                        endDate: selectedEnd,
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                        },
                        locale: {
                            format: 'YYYY-MM-DD'
                        }
                    }, function (start, end) {
                        selectedStart = start;
                        selectedEnd = end;
                        if (selectedAd) {
                            fetchAdHistory(selectedAd, selectedStart.format('YYYY-MM-DD'), selectedEnd.format('YYYY-MM-DD'));
                        }
                    });

                    // Initial
                    loadAdList();
            // <!-- =================  <!-- CTR, Frequency & ROAS per Ad -->  ================= -->


            // <!-- =================  Daily Profit  ================= -->
               // Setup initial range

                window.profitChart = null;
                        
                const profitRangeInitialStart = moment().subtract(6, 'days');
                const profitRangeInitialEnd = moment();

                // Init daterangepicker
                $('#profitRange').daterangepicker({
                    startDate: profitRangeInitialStart,
                    endDate: profitRangeInitialEnd,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                    },
                    locale: {
                        format: 'YYYY-MM-DD'
                    }
                }, function (start, end) {
                    fetchDailyProfit(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
                });

                // Fetch and render chart
                function fetchDailyProfit(startDate, endDate) {
                    $.ajax({
                        url: "/admin/fbads/meta-metrics/data/profit-daily",
                        method: "GET",
                        data: { start_date: startDate, end_date: endDate },
                        success: function (response) {
                            if (!Array.isArray(response)) {
                                console.error("Invalid response format", response);
                                return;
                            }

                            const labels = response.map(item => item.date);
                            const profits = response.map(item => parseFloat(item.total_profit || 0));

                            // Destroy existing chart if it exists
                            if (window.profitChart) {
                                window.profitChart.destroy();
                            }

                            // Handle no data
                            if (profits.length === 0) {
                                $('#profitChart').html('<div class="ttext-center ttext-gray-500 tpy-10">No data available</div>');
                                return;
                            }

                            const options = {
                                chart: {
                                    type: 'bar',
                                    height: 450
                                },
                                series: [{
                                    name: 'Profit',
                                    data: profits
                                }],
                                xaxis: {
                                    categories: labels,
                                    labels: {
                                        style: { fontSize: '12px' }
                                    }
                                },
                                colors: ['#ff0073'],
                                dataLabels: {
                                    enabled: true,
                                    formatter: val => `₱${parseFloat(val).toLocaleString()}`,
                                    style: {
                                        fontSize: '12px'
                                    }
                                },
                                tooltip: {
                                    shared: false,
                                    intersect: false,
                                    y: {
                                        formatter: val => `₱${parseFloat(val).toLocaleString()}`
                                    }
                                },
                                grid: {
                                    padding: {
                                        left: 80,
                                        right: 80
                                    }
                                },
                                legend: {
                                    position: 'bottom'
                                }
                            };

                            // Render and store chart
                            window.profitChart = new ApexCharts(document.querySelector("#profitChart"), options);
                            window.profitChart.render();
                        },
                        error: function (xhr, status, error) {
                            console.error("AJAX error:", error);
                        }
                    });
                }

                // Load chart on page load
                fetchDailyProfit(initialStart.format('YYYY-MM-DD'), initialEnd.format('YYYY-MM-DD'));
                    // <!-- =================  Daily Profit  ================= -->
                });
    </script> 

@endsection
