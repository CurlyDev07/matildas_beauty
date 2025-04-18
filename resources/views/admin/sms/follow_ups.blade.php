@extends('admin.sms.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
            <div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                <div class="">Follow Ups</div>
                <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                    <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                    <input type="text" name="date" id="date" value="" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
                </div>
            </div>

            <div class="tflex tp-5 tjustify-center">
                <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tbody>
                        <tr class="tborder-0">
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">CP#</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Message Name</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Send In</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                        </tr>

                        @foreach ($follow_ups as $follow_up)
                            <tr>    
                                <td class="ttext-sm ttext-center tpy-1">{{ $follow_up['name'] }}</td>
                                <td class="ttext-sm ttext-center tpy-1">{{ $follow_up['contact_number'] }}</td>
                                <td class="tmax-w-sm tpy-1 ttext-center">{{ $follow_up['message_name'] }}</td>
                                <td class="ttext-sm ttext-center tpy-1">{{ $follow_up['interval'] }} <small>days</small></td>
                                <td class="ttext-sm ttext-center tpy-1">{{ $follow_up['status'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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