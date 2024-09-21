@extends('admin.fbads.layouts')

@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


    <style>
   
        .dropdown {
          position: relative;
          display: inline-block;
        }
        
        .dropdown-content {
          display: none;
          position: absolute;
          background-color: #f1f1f1;
          min-width: 160px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          z-index: 1;
        }
        
        .dropdown-content a {
          color: black;
          padding: 12px 16px;
          text-decoration: none;
          display: block;
        }
        
        .dropdown-content a:hover {background-color: #ddd;}
        
        .dropdown:hover .dropdown-content {display: block;}
        
        .dropdown:hover .dropbtn {background-color: #3e8e41;}
        </style>
@endsection

@section('page')

@php
    $order_status = ['TO ENCODE', 'TO CALL', 'TO SHIP', 'SHIPPED', 'DELIVERED', 'CANCELLED', 'DUPLICATE', 'RESERVE'];

    function status_color($status){
        switch ($status) {
            case "TO ENCODE":
                echo "tbg-yellow-200 ttext-yellow-900 tborder-yellow-300";
                break;
            case "TO CALL":
                echo "tbg-blue-200 ttext-blue-900 tborder-blue-300";
                break;
            case "TO SHIP":
                echo "tbg-orange-200 ttext-orange-900 tborder-orange-300";
                break;
            case "SHIPPED":
                echo "tbg-green-200 ttext-green-900 tborder-green-300";
                break;
            case "DELIVERED":
                echo "tbg-green-300 ttext-green-900 tborder-green-300";
                break;
            case "CANCELLED":
                echo "tbg-red-300 ttext-red-900 tborder-red-300";
                break;
            case "DUPLICATE":
                echo "tbg-pink-200 ttext-pink-900 tborder-pink-300";
                break;
            case "RESERVE":
                echo "tbg-purple-200 ttext-purple-900 tborder-purple-300";
                break;
            default:
                echo "tbg-pink-200 ttext-pink-900 tborder-pink-300";
            }
    }
@endphp

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
                        <select id="status" class="status ttext-center tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="" selected>Choose</option>
                            <option value="">ALL</option>
                            @foreach ($order_status as $status)
                                <option value="{{ $status }}">{{ $status }}</option>
                            @endforeach
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
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Product/Promo</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Amount</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Date</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium tw-32">Status</th>
                    </tr>

                    @foreach ($orders as $order)
                        <tr>

                            <td class="ttext-sm ttext-center tpy-1 tcapitalize">
                                <a href="{{ route('fbads.order', ['id' => $order->id]) }}" class="ttext-blue-700 tooltipped" data-tooltip="Click to view/edit order">{{ $order->id }}</a>
                            </td>
                            <td class="ttext-sm ttext-center tpy-1 tcapitalize">{{ $order->full_name }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->phone_number }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->address }}</td>
                            <td class="ttext-sm ttext-center tpy-1 ">
                                <span class="tfont-medium {{ $order->product == 'MissTisa'? 'ttext-pink-600' : "ttext-green-700" }}">{{ $order->promo }}</span>
                            </td>
                            <td class="ttext-sm ttext-center tpy-1 amount">{{ $order->total }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $order->created_at->format('M d, h:i:s A') }}</td>
                            <td class="ttext-sm ttext-center tpy-1">
                                <select data-id="{{ $order->id }}" class="change_status tfont-medium browser-default tborder-gray-300 th-8 tpx-2 trounded-full ttext-center {{ status_color($order->status) }}">
                                    @foreach ($order_status as $status)
                                        <option value="{{ $status }}"
                                            @if ($order->status == $status)
                                                selected
                                            @endif
                                        >{{ $status }}</option>
                                    @endforeach
                                    
                                </select>
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
        function status_color(self, status) {
            switch(status){
                case "TO ENCODE":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-yellow-200 ttext-yellow-900 tborder-yellow-300")
                    break;
                case "TO CALL":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-blue-200 ttext-blue-900 tborder-blue-300")
                    break;
                case "TO SHIP":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-orange-200 ttext-orange-900 tborder-orange-300")
                    break;
                case "SHIPPED":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-green-200 ttext-green-900 tborder-green-300")
                    break;
                case "DELIVERED":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-green-300 ttext-green-900 tborder-green-300")
                    break;
                case "CANCELLED":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-red-300 ttext-red-900 tborder-red-300")
                    break;
                case "DUPLICATE":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-pink-200 ttext-pink-900 tborder-pink-300")
                    break;
                case "RESERVE":
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-purple-200 ttext-purple-900 tborder-purple-300")
                    break;
                default:
                    self.attr('class', "change_status tfont-medium browser-default th-8 tpx-2 trounded-full ttext-center tbg-pink-200 ttext-pink-900 tborder-pink-300")
            }
        }

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

        $('#status').change(function (e) {
            e.preventDefault();

            const parser = new URL(window.location.href);
            parser.searchParams.set("status", $(this).val());
            window.location = parser.href;

            return false;
        });

        $('.change_status').change(function () {
            let self = $(this);

            Swal.fire({
                title: 'Change Order Status?',
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
                        data: { id: $(this).data('id'), status: $(this).val() },
                        success: ()=>{
                            status_color(self, $(this).val())
                            // Swal.fire(
                            //     'Status Changed Successfully!',
                            //     'The order has been updated.',
                            //     'success'
                            // )// success prompt
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