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
    </div> {{-- UPLOAD --}}

    <div class="tmax-w-6xl tmx-auto tp-10">
        {{-- Spend vs Profit Chart --}}
        <div class="tmb-10">
            <form method="GET" class="tflex tgap-4 titems-center tmb-4">
                <input type="date" name="spend_start" value="{{ request('spend_start') }}" class="tborder trounded tpx-3 tpy-2">
                <input type="date" name="spend_end" value="{{ request('spend_end') }}" class="tborder trounded tpx-3 tpy-2">
                <button class="tbg-pink-600 thover:tbg-blue-700 ttext-white tpx-4 tpy-2 trounded">Filter</button>
            </form>
            <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6">
                <h2 class="ttext-lg tfont-semibold tmb-4">Spend vs Profit (Top Ads)</h2>
                <div id="spendProfitChart"></div>
            </div>
        </div>

        {{-- ROAS per Ad --}}
        <div class="tmb-10">
            <form method="GET" class="tflex tgap-4 titems-center tmb-4">
                <input type="date" name="roas_start" value="{{ request('roas_start') }}" class="tborder trounded tpx-3 tpy-2">
                <input type="date" name="roas_end" value="{{ request('roas_end') }}" class="tborder trounded tpx-3 tpy-2">
                <button class="tbg-pink-600 thover:tbg-blue-700 ttext-white tpx-4 tpy-2 trounded">Filter</button>
            </form>
            <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6">
                <h2 class="ttext-lg tfont-semibold tmb-4">ROAS per Ad</h2>
                <div id="roasChart"></div>
            </div>
        </div>

        {{-- CTR per Ad --}}
        <div class="tmb-10">
            <form method="GET" class="tflex tgap-4 titems-center tmb-4">
                <input type="date" name="ctr_start" value="{{ request('ctr_start') }}" class="tborder trounded tpx-3 tpy-2">
                <input type="date" name="ctr_end" value="{{ request('ctr_end') }}" class="tborder trounded tpx-3 tpy-2">
                <button class="tbg-pink-600 thover:tbg-blue-700 ttext-white tpx-4 tpy-2 trounded">Filter</button>
            </form>
            <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6">
                <h2 class="ttext-lg tfont-semibold tmb-4">CTR (Link Click) per Ad</h2>
                <div id="ctrChart"></div>
            </div>
        </div>

        {{-- ROAS Trend --}}
        <div class="tmb-10">
            <form method="GET" class="tflex tgap-4 titems-center tmb-4">
                <select name="roas_range" onchange="this.form.submit()" class="tborder trounded tpx-3 tpy-2">
                    <option value="30" {{ request('roas_range') == '30' ? 'selected' : '' }}>Last 30 Days</option>
                    <option value="60" {{ request('roas_range') == '60' ? 'selected' : '' }}>Last 60 Days</option>
                    <option value="90" {{ request('roas_range') == '90' ? 'selected' : '' }}>Last 90 Days</option>
                </select>
            </form>
            <div class="tbg-white tshadow-sm trounded tpx-4 tpy-6">
                <h2 class="ttext-lg tfont-semibold tmb-4">ROAS Trend Over Time</h2>
                <div id="roasTrendChart"></div>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
   
    <script>
        const labels = @json($spendProfit->pluck('ad_name'));
        const spent = @json($spendProfit->pluck('amount_spent'));
        const profit = @json($spendProfit->pluck('profit'));
        const roasLabels = @json($roasPerAd->pluck('ad_name'));
        const roas = @json($roasPerAd->pluck('avg_roas'));
        const ctrLabels = @json($ctrPerAd->pluck('ad_name'));
        const ctr = @json($ctrPerAd->pluck('avg_ctr'));
        const roasTrendLabels = @json($roasTrendLabels);
        const roasTrendValues = @json($roasTrendValues);

        new ApexCharts(document.querySelector("#spendProfitChart"), {
            chart: { type: 'bar', height: 400 },
            plotOptions: { bar: { horizontal: true, barHeight: '80%' } },
            colors: ['tomato', '#00a67d'],
            series: [
                { name: 'Spend', data: spent },
                { name: 'Profit', data: profit }
            ],
            xaxis: { categories: labels }
        }).render();

        new ApexCharts(document.querySelector("#roasChart"), {
            chart: { type: 'bar', height: 350 },
            colors: ['#f02074'],
            plotOptions: { bar: { horizontal: true, barHeight: '70%' } },
            dataLabels: {
                enabled: true,
                formatter: val => `${val.toFixed(2)} ROAS`,
                style: { colors: ['#fff'] }
            },
            series: [{ name: 'ROAS', data: roas }],
            xaxis: { categories: roasLabels }
        }).render();

        new ApexCharts(document.querySelector("#ctrChart"), {
            chart: { type: 'bar', height: 350 },
            colors: ['#3b82f6'],
            plotOptions: { bar: { horizontal: true, barHeight: '80%' } },
            dataLabels: {
                enabled: true,
                formatter: val => `${val.toFixed(2)}% CTR`,
                style: { colors: ['#fff'] }
            },
            series: [{ name: 'CTR (Link Click)', data: ctr }],
            xaxis: { categories: ctrLabels }
        }).render();

        new ApexCharts(document.querySelector("#roasTrendChart"), {
            chart: { type: 'line', height: 350 },
            colors: ['#f02074'],
            series: [{ name: 'ROAS', data: roasTrendValues }],
            xaxis: { categories: roasTrendLabels },
            tooltip: {
                y: { formatter: val => `${val.toFixed(2)} ROAS` }
            }
        }).render();
    </script>

@endsection
