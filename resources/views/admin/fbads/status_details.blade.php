@extends('admin.fbads.layouts')


@php
    $order_status = ['TO ENCODE', 'TO CALL', 'TO SHIP', 'SHIPPED', 'DELIVERED', 'CANCELLED', 'DELETE', 'RESERVE'];

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
            case "DELETE":
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

@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Status Details</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/store.png') }}" alt="">
                        <select id="supplier" class="supplier tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="#" selected>Choose ...</option>

                            {{-- @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach --}}
                        </select> 
                    </div>
                </li><!-- Store Filter-->
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
                    <a href="/admin/lab/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Customer</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Status</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Admin</th>

                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">image</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Category</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Cancellation Reason</th>
                    </tr>

                    {{-- {{ $status_details }} --}}


                    @foreach ($status_details as $details)
                    
                        <tr class="tborder-0 hover:tbg-blue-100">
                            {{-- {{ dd($details) }} --}}
                            <td class="ttext-center tpx-5">{{ $details->fbAd->full_name }} <br> {{ $details->fbAd->phone_number }}</td>
                            <td class="ttext-center tpx-5">
                                <span class="ttext-xs ttext-gray-500"><strike>{{ $details->previous_status }}</strike></span>
                                <br> 
                                <span class="ttext-lg tpx-2 trounded tfont-medium {{ status_color($details->new_status) }}" >{{ $details->new_status }}</span>
                            </td>
                            <td class="ttext-center tpx-5">{{ $details->admin_name }} <br> <span class="ttext-xs">{{ $details->created_at->diffForHumans() }}</span></td>
                            <td class="ttext-center tpx-5">
                                <a href="{{ $details->reason->img }}" target="_blank" class="tooltipped tcursur-pointer  ttext-center" data-position="top" data-tooltip="Click to View">
                                    <img src="{{ $details->reason->img }}" alt="Reason Image" class="tmx-auto tw-20 th-20 object-contain rounded border" />
                                </a>
                            </td>
                            <td class="ttext-center tpx-5">
                                <span>{{ $details->reason->category }}</span>
                            </td>
                            <td class="ttext-center tpx-5 tmax-w-xs tbreak-words twhitespace-normal">
                                <span>{{ $details->reason->reason }}</span>
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


        function pricePerUnit() {
            let price = parseFloat($('#price').val()) || 0;
            let weight = parseFloat($('#weight').val()) || 0;
            let price_per_grams = 0;

            price_per_grams = price/weight;
            price_per_grams = price_per_grams.toFixed(2); // round to 2 decimal places

            $('#price_per_grams').val(price_per_grams);
        }
        
        $('#price').keyup(function () {
            pricePerUnit();
        })

        $('#weight').keyup(function () {
            pricePerUnit();
        })


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

        $('#supplier').change(function (e) {
        e.preventDefault();

        const parser = new URL(window.location.href);
        parser.searchParams.set("supplier", $(this).val());
        window.location = parser.href;

        return false;

    });
    });
</script>
@endsection