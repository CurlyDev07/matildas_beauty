@extends('admin.layouts.app')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('content')
    <div class="tflex tw-full">
        <div class="tw-1/2 tmb-5">
            <input type="hidden" id="chart_data" value="{{ json_encode($chart_data, TRUE) }}">
            <div id="piechart" style="width: 600px; height: 400px;"></div>
           amet consectetur adipisicing elit. Animi vitae nemo dolorum blanditiis quo est eum obcaecati natus non quaerat rerum esse perferendis ad, commodi nisi voluptates, ipsum autem minima.
        </div>
        <div class="tbg-white tmb-5 tp-5 trounded tshadow-lg tw-1/2">
            <h1 class="tfont-medium tmb-3 ttext-2xl">Top 20 Products</h1>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Sku</th>
                    <th>Srp</th>
                    <th>Cogs</th>
                    <th>Diff</th>
                    <th>Diff %</th>
                    <th>Sold</th>
                    <th>Prof</th>
                </tr>
                @foreach ($top_20_products as $products)
                    @php
                        $catch_sp =  ($products['products']['selling_price'] == 0)?? : 1;
                        $selling_price =  $catch_sp + ($catch_sp * 7/100);
                        $price = $products['products']['price'];
                        $profit = ($selling_price) - $price;
                        $price_with_charges = 100 * ($selling_price - $price) / $selling_price;
                    @endphp
                    <tr>
                        {{-- {{ dd($charges) }} --}}
                        <td class="tpy-2"><img src="{{ $products['products']['primary_image'] }}" style="height: 35px;"></td>
                        <td class="tpy-2">{{ $products['products']['sku'] }}</td>
                        <td class="tpy-2">{{ number_format($selling_price, 2) }}</td>
                        <td class="tpy-2">{{ number_format($price, 2) }}</td>
                        <td class="tpy-2">{{ number_format($profit, 2) }}</td>
                        <td class="tpy-2">{{ number_format($price_with_charges, 2) }}%</td>
                        <td class="tpy-2 tfont-medium qty">{{ $products['quantity'] }}</td>
                        <td class="tpy-2 tfont-medium">₱ <span class="profit">{{ ($products['quantity'] * $profit) }}</span></td>
                    </tr>
                @endforeach
                <tr class="tborder-0">
                    <td class="tpy-2 tinvisible"><img src="https://matildasbeautybucket.s3.ap-southeast-1.amazonaws.com/images/products/small-06548abefbc44a08aab795ba7760a531.jpg" style="height: 35px;"></td>
                    <td class="tpy-2 tinvisible">V7</td>
                    <td class="tpy-2 tinvisible">105.93</td>
                    <td class="tpy-2 tinvisible">23.00</td>
                    <td class="tpy-2 tinvisible">82.93</td>
                    <td class="tpy-2 tinvisible">78.29%</td>
                    <td  class="tfont-medium tpy-2 ttext-lg">30</td>
                    <td class="tfont-medium tpy-2 ttext-lg">₱<span id="total_profit"></span></td>
                </tr>
            </table>
        </div>
    </div>

    <ul>
        <li class="tml-3 tml-auto tmr-2">
            <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                <input type="text" name="date" id="date" value="" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
            </div>
        </li>
        <li class="tml-3 tml-auto tmr-2">
            <a href="/admin/dashboard">
                <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
            </a>
        </li><!-- REMOVE FILTER -->
    </ul>

    <h1 class="ttext-xl tfont-medium tml-8">Expenses: {{ number_format($expense) }}</h1>
    <h1 class="ttext-xl tfont-medium tml-20">+</h1>
    <h1 class="ttext-xl tfont-medium tml-8">Purchase: {{ number_format($purchase) }}</h1>
    <h1 class="ttext-xl tfont-medium tml-20">+</h1>
    <h1 class="ttext-xl tfont-medium tml-8">Power Up: {{ number_format($power_up_total) }} <small>(Total Sf: {{ $power_up_sf }})</small></h1>

    ------------------------
    <h1 class="ttext-2xl tfont-medium">Total Expense: {{ number_format($purchase + $expense + $power_up_total) }}</h1>

   
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    
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


        let data = $('#chart_data').val();
        let chart_data = JSON.parse(data)
        
        google.charts.load('current', {'packages':['corechart']});
        google.charts.setOnLoadCallback(drawChart);

        function drawChart() {
        var data = google.visualization.arrayToDataTable(chart_data);
        var options = {
            title: 'My Expenses',
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
        }
    </script>

    <script>
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        let total_qty = 0;
        let total_profit = 0;

        $( ".qty" ).each(function( index ) {
            total_qty+= parseInt($(this).html());
        });
        
        $( ".profit" ).each(function( index ) {
        console.log(parseInt($(this).html()));

            total_profit+= parseInt($(this).html());
        });
        $('#total_qty').html(total_qty);
        $('#total_profit').html(numberWithCommas(total_profit));
    </script>
@endsection