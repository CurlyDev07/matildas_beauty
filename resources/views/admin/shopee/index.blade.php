@extends('admin.shopee.layouts')

{{-- @section('style') --}}
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
{{-- @endsection --}}

<style>
    .order-text{
        font-size: 14px;
        color: #333;
        max-height: 42px;
        overflow: hidden;
        font-weight: 400;
        padding: 0 12px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        position: relative;
    }

    .order-text-2{
        font-size: 13;
        color: #333;
        max-height: 42px;
        overflow: hidden;
        font-weight: 400;
        padding: 0 12px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        position: relative;
    }
    
    .order-value{
        font-size: 16px;
        min-height: 18px;
        color: #2673dd;
        font-weight: 500;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        position: relative;
    }

    .order-value-2{
        font-size: 14px;
        min-height: 18px;
        color: #2673dd;
        font-weight: 500;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        justify-content: center;
        position: relative;
    }
</style>

@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b">
            <div class="tflex tflex titems-center tjustify-between tpx-5 tpt-3">
                <span class="ttext-base ttext-title tfont-medium">Uploaded Orders</span>
                <ul class="tflex titems-center">
                    <li class="tmr-4">
                        <input type="text" name="dates" id="dates" value="{{ request()->dates }}"/>
                    </li><!-- DATE -->
                    <li class="tmr-4 tpt-1">
                        @if (request()->sort == 'asc')
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by newest">
                                <i class="material-icons grey-text tmr-3">sort_by_alpha</i>
                            </a>
                        @else
                            <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by oldest">
                                <i class="material-icons grey-text">sort_by_alpha</i>
                            </a>
                        @endif
                    </li><!-- SORT -->
                    <li>
                        <a href="/admin/shopee/">
                            <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                        </a>
                    </li><!-- REMOVE FILTER -->
                </ul>
            </div>
            <div class="tpx-3 tpy-4">
                <ul class="tflex ">
                    <li class="">
                        <a id="matilda007" href="{{ request()->fullUrlWithQuery(['store' => 'matilda007']) }}" 
                            class="thidden sm:tblock  tborder tborder-gray-300 tcursor-pointer waves-effect tmr-1 tpx-5 tpy-2 trounded ttext-sm
                            @if (request()->store == 'matilda007')
                                tbg-primary ttext-white
                            @endif
                        ">matilda007</a>
                    </li>
                    <li class="">
                        <a id="enlarge_oil" id="enlarge_oil" href="{{ request()->fullUrlWithQuery(['store' => 'enlarge_oil']) }}" 
                            class="thidden sm:tblock  tborder tborder-gray-300 tcursor-pointer waves-effect tmr-1 tpx-5 tpy-2 trounded ttext-sm
                            @if (request()->store == 'enlarge_oil')
                                tbg-primary ttext-white
                            @endif
                        ">enlarge_oil</a>
                    </li>
                    <li class="">
                        <a id="matilda_merchandise" href="{{ request()->fullUrlWithQuery(['store' => 'matilda_merchandise']) }}" 
                            class="thidden sm:tblock  tborder tborder-gray-300 tcursor-pointer waves-effect tmr-1 tpx-5 tpy-2 trounded ttext-sm
                            @if (request()->store == 'matilda_merchandise')
                                tbg-primary ttext-white
                            @endif
                        ">matilda_merchandise</a>
                    </li>
                    <li class="">
                        <a id="storelle" href="{{ request()->fullUrlWithQuery(['store' => 'storelle']) }}" 
                            class="thidden sm:tblock  tborder tborder-gray-300 tcursor-pointer waves-effect tmr-1 tpx-5 tpy-2 trounded ttext-sm
                            @if (request()->store == 'storelle')
                                tbg-primary ttext-white
                            @endif
                        ">storelle</a>
                    </li>
                    <li class="">
                        <a id="yvonne_coruna67" href="{{ request()->fullUrlWithQuery(['store' => 'yvonne_coruna67']) }}" 
                            class="thidden sm:tblock  tborder tborder-gray-300 tcursor-pointer waves-effect tmr-1 tpx-5 tpy-2 trounded ttext-sm
                            @if (request()->store == 'yvonne_coruna67')
                                tbg-primary ttext-white
                            @endif
                        ">yvonne_coruna67</a>
                    </li>
                </ul>
            </div><!--FOR FILTER PORPUSE ONLY DO NOT DELETE THIS SECTION -->
        </div>  

        <div class="tpx-3 tpy-4">
            <div class="tflex tjustify-between tpx-5 t-ml-1">

                @foreach ($status as $stats)
                    <div class="">
                        <div class="" style="width: 118px;">
                            <img src="<?= asset('icons/'.str_replace(' ', '_', strtolower($stats["order_status"])).'.gif') ?>" alt="{{ $stats['order_status'] }}">
                            <div class="order-value">{{ $stats['total_orders'] }}</div>
                            <div class="order-text tborder-b-2 tmb-2 tpb-2">{{ $stats['order_status'] }}</div>
                            
                            <div class="order-value-2">{{ $stats['total_profit'] }}</div>
                            <div class="order-text-2">Profit</div>

                            <hr class="tmy-2">
                            
                            <div class="order-value-2">{{ $stats['total_item_quantity'] }}</div>
                            <div class="order-text-2">Units</div>

                            <hr class="tmy-2">
                            
                            <div class="order-value-2">{{ $stats['total_service_fee'] }}</div>
                            <div class="order-text-2">Service fee</div>

                            <hr class="tmy-2">
                            
                            <div class="order-value-2">{{ $stats['total_seller_voucher'] }}</div>
                            <div class="order-text-2">Seller Voucher</div>

                            <hr class="tmy-2">
                            
                            <div class="order-value-2">{{ $stats['total_seller_bundle_discount'] }}</div>
                            <div class="order-text-2">Bundle Discount</div>

                        </div>
                    </div>
                @endforeach
             
            </div>
        </div><!-- TABLE -->
    </div>
@endsection

@section('js')
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<script>

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

{{-- DATE --}}

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
</script>
@endsection

