@extends('admin.shopee.layouts')

<script src="sweetalert2.min.js"></script>
<link rel="stylesheet" href="sweetalert2.min.css">

@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Uploaded Orders</span>
        </div>
        <div class="tpx-3 tpy-4 tpt-0 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-b">
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium">SKU</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium">QUANTITY</th>
                        <th class="tpy-1 ttext-center ttext-black-100 tfont-medium">REMARKS</th>
                    </tr>
                    @foreach ($picklist as $sku)
                       <tr 
                            @if (!sku_check($sku->sku_reference_no))
                                class='tbg-red-200'
                            @endif
                       >
                            <td class="ttext-center tpy-0">
                                {{ $sku->sku_reference_no }}
                            </td>
                            <td class="ttext-center tpy-0">
                                {{ $sku->quantity }}
                            </td>
                            <td class="ttext-center tpy-0">
                                @if (!sku_check($sku->sku_reference_no))
                                    <span class="">Missing/Invalid SKU</span>
                                @else
                                    <span class="">Good</span>
                                @endif
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