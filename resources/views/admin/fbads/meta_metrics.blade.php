@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    
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
    </div>

    <div class="tmax-w-5xl tmx-auto tp-10">

        <div class="tmb-6">
            {{-- Quick Buttons --}}
            <div class="tflex tgap-2 tmb-4 tflex-wrap">
                <button type="button" class="tpx-3 tmr-2 tpy-1 tbg-gray-100 thover:tbg-gray-200 trounded ttext-sm" onclick="setQuickRange('today')">Today</button>
                <button type="button" class="tpx-3 tmr-2 tpy-1 tbg-gray-100 thover:tbg-gray-200 trounded ttext-sm" onclick="setQuickRange('yesterday')">Yesterday</button>
                <button type="button" class="tpx-3 tmr-2 tpy-1 tbg-gray-100 thover:tbg-gray-200 trounded ttext-sm" onclick="setQuickRange('7')">Last 7 Days</button>
                <button type="button" class="tpx-3 tmr-2 tpy-1 tbg-gray-100 thover:tbg-gray-200 trounded ttext-sm" onclick="setQuickRange('30')">Last 30 Days</button>
            </div>

            {{-- Filter Form --}}
            <form method="GET" id="dateFilterForm" action="{{ route('fbads.meta_metrics') }}" class="tflex tgap-4 titems-center">

                <input 
                    type="text" 
                    id="dateRange" 
                    name="date_range" 
                    value="{{ request('date_range') ?? ($start . ' to ' . $end) }}" 
                    class="tborder trounded tpx-3 tpy-3 tw-full tmax-w-xs browser-default tmr-2" 
                    placeholder="Select date range"
                />

                <select name="campaign_name" class="tborder trounded tpx-3 tpy-2 ttext-sm tmax-w-xs browser-default tmr-2" onchange="this.form.submit()">
                    <option value="">All Campaigns</option>
                    @foreach ($campaigns as $name)
                        <option value="{{ $name }}" {{ request('campaign_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>

                <select name="ad_set_name" class="tborder trounded tpx-3 tpy-2 ttext-sm tmax-w-xs browser-default tmr-2" onchange="this.form.submit()">
                    <option value="">All Ad Sets</option>
                    @foreach ($adsets as $name)
                        <option value="{{ $name }}" {{ request('ad_set_name') == $name ? 'selected' : '' }}>{{ $name }}</option>
                    @endforeach
                </select>

                @if(request()->hasAny(['date_range', 'campaign_name', 'ad_set_name']))
                    <a href="{{ route('fbads.meta_metrics') }}" class="ttext-sm ttext-gray-600 tml-2 thover:tunderline tmr-2">
                        <i class="far fa-times-circle ttext-red-500 ttext-2xl"></i>
                    </a>
                @endif

                <button type="submit" class="tml-auto tbg-pink-600 thover:tbg-blue-700 ttext-white tpx-4 tpy-2 trounded">Filter</button>

            </form>
        </div>

        {{-- Active Filters as Tags --}}
        @if(request()->filled('date_range') || request()->filled('campaign_name') || request()->filled('ad_set_name'))
        <div class="tmb-4 tflex tgap-2 tflex-wrap">
            @if(request()->filled('date_range'))
                <span class="tbg-pink-100 ttext-pink-700 ttext-sm tpx-2 tpy-1 trounded">📅 {{ request('date_range') }}</span>
            @endif
            @if(request()->filled('campaign_name'))
                <span class="tbg-blue-100 ttext-blue-700 ttext-sm tpx-2 tpy-1 trounded">📢 {{ request('campaign_name') }}</span>
            @endif
            @if(request()->filled('ad_set_name'))
                <span class="tbg-green-100 ttext-green-700 ttext-sm tpx-2 tpy-1 trounded">🎯 {{ request('ad_set_name') }}</span>
            @endif
        </div>
        @endif

        {{-- Charts --}}
        <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6">
            <h2 class="ttext-lg tfont-semibold tmb-4">Spend vs Profit (Top Ads)</h2>
            <div id="spendProfitChart"></div>
        </div>

        <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6 tmt-8">
            <h2 class="ttext-lg tfont-semibold tmb-4">ROAS per Ad</h2>
            <div id="roasChart"></div>
        </div>

        <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6 tmt-8">
            <h2 class="ttext-lg tfont-semibold tmb-4">CTR (Link Click) per Ad</h2>
            <div id="ctrChart"></div>
        </div>

        <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6 tmt-8">
            <h2 class="ttext-lg tfont-semibold tmb-4">ROAS Trend Over Time</h2>
            <div id="roasTrendChart"></div>
        </div>

    </div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>

        const labels = @json($metrics->pluck('ad_name'));
        const spent = @json($metrics->pluck('amount_spent'));
        const profit = @json($metrics->pluck('profit'));
        const roas = @json($metrics->pluck('purchase_roas'));
        const ctr = @json($metrics->pluck('ctr_link_click'));

        // Spend vs Profit
        new ApexCharts(document.querySelector("#spendProfitChart"), {
            chart: {
                type: 'bar',
                height: 450 // Optional: raise this if you have many rows
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '30px', // ⬅ Adjust row height here
                    dataLabels: {
                        position: 'top'
                    }
                }
            },
            colors: ['tomato', '#00a67d'],
            dataLabels: {
                enabled: true,
                offsetX: -30,
                style: {
                    fontSize: '12px'
                }
            },
            series: [
                {
                    name: 'Spend',
                    data: spent
                },
                {
                    name: 'Profit',
                    data: profit
                }
            ],
            xaxis: {
                categories: labels,
                labels: {
                    style: { fontSize: '12px' }
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
                position: 'top'
            },
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '90%', // ✅ makes bar thicker inside same row
                    dataLabels: {
                        position: 'top'
                    }
                }
            }
        }).render();

        // ROAS per Ad
        new ApexCharts(document.querySelector("#roasChart"), {
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#f02074'],
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '70%',
                    borderRadius: 4,
                    dataLabels: {
                        position: 'center'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    if (val === null || isNaN(val)) return '0.00 ROAS';
                    return `${parseFloat(val).toFixed(2)} ROAS`;
                },
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                }
            },
            series: [{
                name: 'ROAS',
                data: roas
            }],
            xaxis: {
                categories: labels,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        if (val === null || isNaN(val)) return '0.00 ROAS';
                        return `${parseFloat(val).toFixed(2)} ROAS`;
                    }
                }
            }
        }).render();

        new ApexCharts(document.querySelector("#ctrChart"), {
            chart: {
                type: 'bar',
                height: 350
            },
            colors: ['#3b82f6'], // current blue or change to pastel if you want
            plotOptions: {
                bar: {
                    horizontal: true,
                    barHeight: '80%',
                    borderRadius: 4,
                    dataLabels: {
                        position: 'center'
                    }
                }
            },
            dataLabels: {
                enabled: true,
                formatter: function (val) {
                    return `${val.toFixed(2)}% CTR`;
                },
                style: {
                    fontSize: '12px',
                    colors: ['#fff']
                }
            },
            series: [{
                name: 'CTR (Link Click)',
                data: ctr
            }],
            xaxis: {
                categories: labels,
                labels: {
                    style: {
                        fontSize: '12px'
                    }
                }
            },
            tooltip: {
                y: {
                    formatter: val => `${val.toFixed(2)}% CTR`
                }
            }
        }).render();
    </script>

    {{-- // DATE PICKER --}}
    <script>
        const flatpickrInstance = flatpickr("#dateRange", {
            mode: "range",
            dateFormat: "Y-m-d",
            defaultDate: "{{ request('date_range') }}"
        });

        function setQuickRange(type) {
            const today = new Date();
            let start = new Date();
            let end = new Date();

            if (type === 'today') {
                // do nothing — already today
            } else if (type === 'yesterday') {
                start.setDate(today.getDate() - 1);
                end.setDate(today.getDate() - 1);
            } else if (type === '7') {
                start.setDate(today.getDate() - 6);
            } else if (type === '30') {
                start.setDate(today.getDate() - 29);
            }

            const format = date => date.toISOString().split('T')[0];
            const range = `${format(start)} to ${format(end)}`;

            // Update Flatpickr + Input Field
            flatpickrInstance.setDate([start, end], true);
            document.getElementById('dateRange').value = range;

            // Auto-submit the form
            document.getElementById('dateFilterForm').submit();
        }
    </script>

    {{-- ROAS TREND --}}
   <script>
        const roasTrendLabels = @json($roasTrendLabels);
        const roasTrendValues = @json($roasTrendValues);

        new ApexCharts(document.querySelector("#roasTrendChart"), {
            chart: {
                type: 'line',
                height: 350,
                zoom: { enabled: true }
            },
            series: [{
                name: "ROAS",
                data: roasTrendValues
            }],
            xaxis: {
                categories: roasTrendLabels,
                title: { text: "Date" },
                labels: { rotate: -45 }
            },
            yaxis: {
                title: { text: "ROAS" },
                labels: {
                    formatter: val => `${val.toFixed(2)}`
                }
            },
            tooltip: {
                y: {
                    formatter: val => `${val.toFixed(2)} ROAS`
                }
            },
            colors: ['#f02074'],
            stroke: {
                curve: 'smooth',
                width: 3
            }
        }).render();
    </script>
@endsection
