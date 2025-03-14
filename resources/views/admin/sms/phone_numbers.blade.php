@extends('admin.sms.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
            <div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                <div class="">Phone Numbers</div>
                <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                    <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                    <input type="text" name="date" id="date" value="" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
                </div>
            </div>

            <div class="tflex tp-5 tjustify-between">
                @foreach ($phoneNumbers as $item)
                    {{ $item }} <br>
                @endforeach
            </div>
        </div>
    </div>

@endsection


@section('js')

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