@extends('admin.layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


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


<br>
<br>

<h1 class="ttext-xl tfont-medium tml-8">Expenses: {{ number_format($expense) }}</h1>
<h1 class="ttext-xl tfont-medium tml-20">+</h1>
<h1 class="ttext-xl tfont-medium tml-8">Purchase: {{ number_format($purchase) }}</h1>
<h1 class="ttext-xl tfont-medium tml-20">+</h1>
<h1 class="ttext-xl tfont-medium tml-8">Power Up: {{ number_format($power_up_total) }} <small>(Total Sf: {{ $power_up_sf }})</small></h1>

------------------------
<h1 class="ttext-2xl tfont-medium">Total Expense: {{ number_format($purchase + $expense + $power_up_total) }}</h1>

<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

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
</script>
@endsection