@extends('admin.shopee.layouts')


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
                    <a href="/admin/shopee/">
                        <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Store</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Filename</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium"></th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium ttext-center">Fix Seller Discount</th>
                    </tr>   
                    
                    @foreach ($uploaded as $uploaded)
                        <tr class="tborder-0 hover:tbg-blue-100">
                            <td class="tp-3 tpx-5 ttext-black-100 tfont-medium">
                                {{ $uploaded->store }}
                            </td>
                            <td class="tp-3 tpx-5 ttext-black-100 tfont-medium">
                                <a href="{{ route('shopee.view', ['filename' => $uploaded->original_file_name, 'store' => $uploaded->store]) }}" class="ttext-blue-500">
                                    {{ $uploaded->original_file_name }}
                                </a>
                            </td>
                            <td class="tp-3 tpx-5 ttext-black-100 tfont-medium">
                                {{ $uploaded->total }} rows
                            </td>
                            <td class="ttext-center">
                                <a href="#" id="cart" store="{{ $uploaded->store }}" original_file_name="{{ $uploaded->original_file_name }}" class="fix_seller_voucher btn-floating hover:tbg-white  tbg-blue-200 waves-light">
                                    <i class="material-icons">autorenew</i>
                                </a>
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
</script>
@endsection