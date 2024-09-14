@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endsection

@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">FB Orders</span>
            <ul class="tflex titems-center">
                <li class="tmr-2">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1" style="color: #333;">
                            <i class="fas fa-shopping-cart"></i>
                            {{ count($orders) }} 
                            <span>Orders</span> 
                        </span>
                    </div>
                </li>
                <li class="tmr-2">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1" style="color: #333;">
                            <span class="tfont-bold ttext-md">₱</span>
                            <span id="sales" class="tfont-bold ttext-md"></span>
                        </span>
                    </div>
                </li>

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

                @if (request()->status)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                Status: {{ request()->status }}
                            </span>
                        </div>
                    </li>
                @endif <!--REVIEW Date-->

                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <i class="fas fa-shipping-fast ttext-xl" style="color: #f05538;"></i>
                        <select id="status" class="status tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="" selected>ALL</option>
                            <option value="TO SHIP" selected>TO SHIP</option>
                            <option value="SHIPPED" selected>SHIPPED</option>
                            <option value="#" selected>Choose&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</option>
                        </select> 
                    </div>
                </li><!-- STATUS Filter-->

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
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tr class="tborder-0">

                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">#</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Customer</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">CP#</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Address</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Product</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Promo</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Amount</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Date</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                    </tr>

                    @foreach ($orders as $order)
                        <tr>

                            <td class="ttext-sm ttext-center tpy-1 tcapitalize">{{ $order->id }}</td>
                            <td class="ttext-sm ttext-center tpy-1 tcapitalize">{{ $order->full_name }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->phone_number }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->address }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->product }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->promo }}</td>
                            <td class="ttext-sm ttext-center tpy-1 amount">{{ $order->total }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->created_at->format('d M, h:i:s A') }}</td>
                            <td class="ttext-sm ttext-center tpy-1">
                                @if ($order->status == 'TO SHIP')
                                        <span class="to-ship tm-0 chip orange lighten-5 waves-effect waves-orange tooltipped" data-id="{{ $order->id }}" data-position="top" data-tooltip="Mark as Shipped?" style="cursor: pointer; width: 73px;">
                                            <span class="orange-text" style="cursor: pointer;">TO SHIP</span>
                                        </span>
                                    @endif

                                    @if ($order->status == 'SHIPPED')
                                    <span class="tm-0 chip green lighten-5 waves-effect waves-green" style="cursor: pointer;">
                                        <span class="green-text" style="cursor: pointer;" style="width: 73px;">{{ $order->status }}</span>
                                    </span>
                                @endif
                                
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div><!-- TABLE -->

    </div>
@endsection


@section('js')

    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>

        $('input[name="date"]').daterangepicker({
            "startDate": moment().subtract(6, 'days'),
            "endDate": moment(),
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

        $('#status').change(function (e) {
            e.preventDefault();

            const parser = new URL(window.location.href);
            parser.searchParams.set("status", $(this).val());
            window.location = parser.href;

            return false;
        });

        $('.to-ship').click(function(){
            let self = $(this);
            
            Swal.fire({
                title: 'Mark as Shipped?',
                text: "You won't be able to revert this!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/admin/fbads/change-status',
                        type: 'POST',
                        data: { id: $(this).data('id') },
                        success: ()=>{
                             // Change Button text and color
                            self.attr('class', 'tm-0 chip green lighten-5 waves-effect waves-green');
                            self.children().html('SHIPPED')
                            self.children().attr('class', 'green-text')

                            Swal.fire(
                                'Mark as Shipped!',
                                'The order has been updated.',
                                'success'
                            )// success prompt
                        }
                    });// update via Ajax request
                }
            })// swal
        });

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }


        function getAllSalesAmount(){
            let amount = 0;

            $('.amount').each(function() {
                amount = (amount + parseInt($(this).html()))
            });

            $('#sales').html(numberWithCommas(amount))
        }

        getAllSalesAmount()

    </script>
@endsection