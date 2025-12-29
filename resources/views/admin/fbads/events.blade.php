@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">FB Event Listener</span>

            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ route('fbads.events') }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li>
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="date" id="date" value="" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
                    </div>
                </li><!-- date Filter-->
                
                <li>
                    <a href="/admin/fbads/events">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>


        <div class="tp-3">
            <div class="tflex tflex-wrap">
                <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Session ID</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">CP#</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Product</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Details</th>
                    </tr>
                    
                    @foreach ($events as $event)
                        <tr @if (!in_array($event->value, $contact_number)) class="tbg-red-200" @endif>
                            <td class="ttext-sm ttext-center tpy-1 tcapitalize">{{ $event->session_id }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $event->value }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $event->website }}</td>
                            <td class="ttext-sm ttext-center tpy-1">
                                @if ($event->session_id != '' && isset($allDetails[$event->session_id]))
                                    @foreach ($allDetails[$event->session_id] as $index => $detail)
                                        @if ($index == 0)
                                            <span class="tfont-medium">{{ $detail->value }}</span>
                                            /
                                        @else 
                                            <span class="tfont-medium">{{ $detail->value }}</span>
                                        @endif
                                    @endforeach
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>

        <!-- Pagination with Bootstrap 4 styling -->
        <div class="d-flex tpx-5 justify-content-between align-items-center mt-4">
            <div>
                Showing {{ $events->firstItem() }} to {{ $events->lastItem() }} of {{ $events->total() }} results
            </div>
            <div>
                {{ $events->links() }}
            </div>
        </div>

    </div>
@endsection


@section('js')

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

    let visitors = $('#visitors').next().html();
    let order_success = $('#order_success').next().html();
    let order_form = $('#order_form').next().html();
    let phone_number = $('#phone_number').next().html();
    let address = $('#address').next().html();
    let full_name = $('#full_name').next().html();
    let submit_order = $('#submit_order').next().html();
    let form_validation_error = $('#form_validation_error').next().html();

    let conversion_rate = parseFloat((order_success/visitors) * 100).toFixed(2);
    let order_form_rate = parseFloat((order_form/visitors) * 100).toFixed(2);
    let phone_number_rate = parseFloat((phone_number/order_form) * 100).toFixed(2);
    let submit_order_rate = parseFloat((submit_order/order_form) * 100).toFixed(2);
    let form_validation_error_rate = parseFloat((form_validation_error/submit_order) * 100).toFixed(2);

    $('#conversion_rate').html(NanReplacer(conversion_rate));
    $('#order_form_rate').html(NanReplacer(order_form_rate));
    $('#phone_number_rate').html(NanReplacer(phone_number_rate));
    $('#submit_order_rate').html(NanReplacer(submit_order_rate));
    $('#form_validation_error_rate').html(NanReplacer(form_validation_error_rate));

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

    $(document).ready(function(){
        $('.modal').modal();
        $('.dropdown-trigger').dropdown();

        // CHANGE STATUS
        $('.change_status').click(function(){
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: '/admin/orders/change-status',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                },
                success: ()=>{
                   
                }
            });
        });
    });

    
    function NanReplacer(number){
        if (!isNaN(number)) {
            return number;
        }
        return 0
    }
</script>
@endsection