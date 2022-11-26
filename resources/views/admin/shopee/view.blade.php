@extends('admin.shopee.layouts')

<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Uploaded Orders</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
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
                    <a href="/admin/shopee/view/{{ $filename }}">
                        <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
                <li>
                    <a href="/admin/shopee/view/{{ $filename }}/{{ $store }}/picklist" class="ttext-blue-400">
                       Picklist
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tpt-0 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-b">
                        <th class="tpy-1 ttext-left ttext-black-100 tfont-medium">ID</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium">Status</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium">Sku</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium ttext-center">Qty</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium ttext-center">Sub total</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium ttext-center">Trans Fee</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium ttext-center">Comm Fee</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium ttext-center">Profit</th>
                    </tr>
                    
                    @foreach ($orders as $order)
                        <tr 
                            @if ($order->profit > 0 )
                                class="tborder-0 hover:tbg-green-100"
                            @elseif($order->power_up == true)
                                class="tooltipped hover:tbg-yellow-300 tbg-yellow-200 tborder-0"
                                data-tooltip="POWER UP"
                            @else
                                class="tooltipped tborder-1 tbg-red-300 hover:tbg-red-400"
                                data-tooltip="WRONG SKU"
                            @endif
                        >
                            <td class="">
                                {{ $order->order_id }}
                            </td>
                            <td class="ttext-center tpy-0">
                                {{ $order->order_status }}
                            </td>
                            <td class="tpy-0 ttext-center">
                                @if ($order->profit > 0)
                                    {{ $order->sku }}
                                @elseif($order->power_up == true)
                                    {{ $order->sku }}
                                @else
                                    <input type="text" data-id="{{ $order->id }}" value="{{ $order->sku }}" class="browser-default ttext-center tw-24 tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl">
                                    <button class="go hover:tbg-red-400 waves-effect tborder tp-2 trounded-br-full trounded-tr-full ttext-white">Go</button>
                                @endif
                            </td>
                            <td class="tpy-0 ttext-center">
                                {{ $order->quantity }}
                            </td>
                            <td class="tpy-0 ttext-center">
                                {{ $order->product_subtotal }}
                            </td>
                            <td class="tpy-0 ttext-center">
                                {{ $order->transaction_fee }}
                            </td>
                            <td class="tpy-0 ttext-center">
                                {{ $order->comission_fee }}
                            </td>
                            <td class="tpy-0 ttext-center">
                                {{ $order->profit }}
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div><!-- TABLE -->

    </div>
@endsection


@section('js')
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
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $('.fix_seller_voucher').click(function () {
        $(this).addClass('pulse');// add pulse effect

        let original_file_name = $(this).attr('original_file_name');
        let store = $(this).attr('store');

        $.ajax({
            method: "POST",
            url: "/admin/shopee/fix-seller-voucher",
            data: {
                original_file_name: original_file_name,
                store: store 
            }
        })
        .done(function( msg ) {
            console.log(msg);
        });
        
        console.log(original_file_name);
        console.log(store);
    });


    $('.go').click(function () {
        let sku = $(this).prev().val();
        let id = $(this).prev().data('id');
        // todo send and update
        console.log(id)
        console.log(sku)

        $.ajax({
            url: '/admin/shopee/view/update',
            type: "POST",
            data: {
                id: id,
                sku: sku
            }
        }).done(function (data) {
            console.log(data.success)
            if (data.success) {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'Your work has been saved',
                    showConfirmButton: false,
                    timer: 1500
                })
            }

            if (data.error) {
                Swal.fire({
                    icon: 'error',
                    title: 'Ooops...',
                    text: data.error,
                    footer: '<a style="color: #125bff; text-decoration: underline;" href="/admin/products">Please find the sku here</a>'
                })
            }
        })
    });
</script>
@endsection