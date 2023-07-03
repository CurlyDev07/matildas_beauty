@extends('admin.power_up.layouts')

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
            <ul class="tflex titems-center tjustify-center">
                {{-- <li class="tmr-2">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <button type="submit" style="height: 40px; border-right-style: dashed;" class="focus:tbg-white focus:toutline-none tborder-r grey-text tborder tborder-gray-200 tborder-r-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-l-full waves-effect">
                            <img class="" src="{{ asset('images/icons/store.png') }}" alt="">
                        </button>
                        
                        <input type="text" placeholder="Not working yet. . ." name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-r-full trounded-tl" placeholder="Search order number">
                    </form>
                </li><!-- SEARCH --> --}}
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/platform.png') }}" alt="">

                        <select id="platform" class="platform tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="fb">FB</option>
                            <option value="shopee">Shopee</option>
                            <option value="lazada">Lazada</option>
                            <option value="tiktok">Tiktok</option>
                        </select> 
                    </div>
                </li><!-- Platform Filter-->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/store.png') }}" alt="">
                        <select id="stores" class="stores tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="#" selected>Choose ...</option>

                            {{-- @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                            @endforeach --}}
                        </select> 
                    </div>
                </li><!-- Store Filter-->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 tpy-1 trounded ttext-sm" >
                        <img class="tpr-1" src="{{ asset('images/icons/calendar.png') }}" alt="">
                        <input type="text" name="dates" id="dates" value="{{ request()->dates }}" class="browser-default tooltipped" data-position="top" data-tooltip="Filter by date"/>
                    </div>
                </li><!-- Dates Filter-->
                <li>    
                    @if (request()->orders == 'desc')
                        <a href="?orders=asc" class="tooltipped" data-position="top" data-tooltip="Sort by orders">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Orders: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_down.png') }}" alt="">
                            </div>
                        </a> 
                    @else
                        <a href="?orders=desc" class="tooltipped" data-position="top" data-tooltip="Sort by orders">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Orders: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT ORDERS-->
                <li class="tml-2">    
                    @if (request()->sales == 'desc')
                    <a href="?sales=asc" class="tooltipped" data-position="top" data-tooltip="Sort by sales">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1">Sales: &nbsp;</span>
                            <img class="tpr-1" src="{{ asset('images/icons/number_sort_down.png') }}" alt="">
                        </div>
                    </a> 
                    @else
                        <a href="?sales=desc" class="tooltipped" data-position="top" data-tooltip="Sort by sales">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Sales: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT SALES-->
                <li class="tml-2">    
                    @if (request()->conversion_rate == 'desc')
                        <a href="?conversion_rate=asc" class="tooltipped" data-position="top" data-tooltip="Sort by conversion rate">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Conversion rate: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_down.png') }}" alt="">
                            </div>
                        </a> 
                    @else
                        <a href="?conversion_rate=desc" class="tooltipped" data-position="top" data-tooltip="Sort by conversion rate">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Conversion rate: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT CONVERSION RATE-->
                <li class="tml-2">    
                    @if (request()->visitors == 'desc')
                        <a href="?visitors=asc" class="tooltipped" data-position="top" data-tooltip="Sort by Visitors">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Visitors: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_down.png') }}" alt="">
                            </div>
                        </a> 
                    @else
                        <a href="?visitors=desc" class="tooltipped" data-position="top" data-tooltip="Sort by Visitors">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Visitors: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('images/icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT VISITORS-->
                <li class="tml-3">
                    <a href="/admin/store-metrics">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li><!-- REMOVE FILTER -->
            </ul>
            <ul class="tflex titems-center tjustify-center tmt-2">
                <li class="tmr-2">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1">Results:  &nbsp;</span>
                    </div>
                </li><!-- Results -->
                <li class="tmr-2">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1">Orders:  &nbsp;</span>
                    </div>
                </li><!-- Orders -->
                <li>    
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1">Sales:  &nbsp;</span>
                    </div>
                </li><!-- Sales-->
                <li class="tml-2">    
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1">Conversion rate:% &nbsp;</span>
                    </div>
                </li><!-- Conversion rate -->
                <li class="tml-2">    
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                        <span class="tpl-1">Visitors:  &nbsp;</span>
                    </div>
                </li><!-- Visitors --> 
             
            </ul>

        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Store</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">User</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Account</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Device</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Amount(sf/total)</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Purchase</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Review</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Action</th>
                    </tr>

                    @foreach ($metrics as $metric)

                        <tr class="hover:tshadow-2xl">
                            <td class="ttext-sm ttext-center tpy-1">{{ date_f($metric->date, 'd M (D)') }}</td>
                            
                                {{-- <a href="/admin/store-metrics/update/{{ $metric->id }}">
                                    <i class="fas fa-edit hover:ttext-pink-500 tcursor-pointer tpx-1 icon_color tooltipped" data-position="right" data-tooltip="Edit"></i>       
                                </a> --}}
                        </tr>
                    @endforeach
            </table>
        </div><!-- TABLE -->

    </div>
@endsection


@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

    $('input[name="dates"]').daterangepicker({
        maxDate: moment(),
        ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    $('#dates').change(function () {
        const parser = new URL(window.location.href);
        parser.searchParams.set("dates", $(this).val());
        window.location = parser.href;
    });

    $('#stores').change(function (e) {
        e.preventDefault();

        const parser = new URL(window.location.href);
        parser.searchParams.set("stores", $(this).val());
        window.location = parser.href;

        return false;

    });


    $('#platform').change(function (e) {
        e.preventDefault();

        const parser = new URL(window.location.href);
        parser.searchParams.set("platform", $(this).val());
        window.location = parser.href;

        return false;

    });


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
</script>
@endsection