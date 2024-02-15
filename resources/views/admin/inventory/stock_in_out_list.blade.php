@extends('admin.inventory.layouts')

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

@section('css')
    <style>
        select:focus, input:focus{
            outline: none;
            border:none;
            -webkit-box-shadow: none!important;
            -moz-box-shadow: none!important;
            box-shadow: none!important;
        }

        .select-dropdown{
            border-bottom: none!important;
            margin-bottom: 0px;
        }
        .select-wrapper{
            height: 31px;
        }
        .caret{
            display: none;
        }
    </style>
@endsection

@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">

        <div class="tborder-b tpx-5 tpy-3">
            <ul class="tflex titems-center">
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="purchase_date" id="purchase_date" value="{{ request()->purchase_date }}" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by purchase date"/>
                    </div>
                </li><!-- purchase_date Filter-->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="review_date" id="review_date" value="{{ request()->review_date }}" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by review date"/>
                    </div>
                </li><!-- review_date Filter-->
                <li class="tml-3 tml-auto tmr-2">
                    <a href="/admin/powerup">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li><!-- REMOVE FILTER -->

                <!-- ***********************SPECIAL BUTTON********************************************************** -->

                @if (auth()->user()->role == 'master')
                    <li class="tml-3 tml-auto tmr-2">
                        <button id="reflect" class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect">Reflect Stocks</button>
                    </li><!-- I USE THIS TO REFLECT THE MANUAL STOCK IN TO THE PRODUCT STOCKS -->
                @endif

                <!-- ***********************SPECIAL BUTTON********************************************************** -->


            </ul>
            <ul class="tflex titems-center tjustify-center tmt-2">
                @if (!request()->purchase_date && !request()->review_date)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                Past 7 Days
                            </span>
                        </div>
                    </li>
                @endif <!-- Default Date |  Past 7 Days-->

                @if (request()->purchase_date)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                Purchase: {{ request()->purchase_date }}
                            </span>
                        </div>
                    </li>
                @endif <!--PURCHASE Date-->

                @if (request()->review_date)
                <li class="tmr-2">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1 ttext-red-500">
                            <i class="fas fa-bookmark"></i>
                            Review: {{ request()->review_date }}
                        </span>
                    </div>
                </li>
                @endif <!--REVIEW Date-->

                @if (request()->stores)
                    <li class="tmr-2">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1 ttext-red-500">
                                <i class="fas fa-bookmark"></i>
                                @foreach ($stores as $store)
                                    @if ($store->id == request()->stores)
                                        {{ $store->store_name }}
                                    @endif
                                @endforeach
                            </span>
                        </div>
                    </li>
                @endif <!--STORE FILTER -->
            </ul>
        </div>

        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tr class="tborder-0">
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">ID</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">User</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Total Qty</th>
                    <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Note</th>
                </tr>
                

                @foreach ($in_out as $list)
                    <tr>
                        
                        <td class="tfont-black tpy-1 ttext-blue-600 ttext-center ttext-sm">
                            <a href="/admin/inventory/stock-in/update/{{ $list->id }}"># {{ $list->id }}</a>
                        </td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $list->user->first_name }} {{ $list->user->last_name }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $list->total_qty }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $list->note }}</td>
                       
                    </tr>
                @endforeach
            </table>
        </div><!-- TABLE -->
        <div class="tbg-white tflex tjustify-end tpb-1">
            {{-- {{ $withdrawal->onEachSide(1)->appends(request()->except('page'))->links() }} --}}
        </div>
    </div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if(session()->has('duplicate'))
    <script>
        $("#{{ session()->get('id') }}").addClass('tbg-green-100');
    </script>
@endif<!-- Duplicate SUCCESSFULL MESSAGE -->

<script>

    // I USE THIS TO REFLECT THE MANUAL STOCK IN TO THE PRODUCT STOCKS

    $('#reflect').click(function () {
        $.ajax({
            url: '/admin/inventory/stock-in/reflect',
            type: 'POST',
            success: ()=>{
                
            }
        });
    })



</script>
@endsection