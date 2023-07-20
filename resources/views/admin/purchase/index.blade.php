@extends('admin.purchase.layouts')


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
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/store.png') }}" alt="">
                        <select id="supplier" class="supplier tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="#" selected>Choose ...</option>

                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach
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
                    <a href="/admin/shopee/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Date</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Supplier</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Total</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Actions</th>
                    </tr>

                    @foreach ($purchases as $purchase)
                    
                        <tr class="tborder-0 hover:tbg-blue-100">
                            <td class="tp-3 tpx-5">{{ date('M d, Y',strtotime($purchase['date'])) }}</td>
                            <td class="tp-3 tpx-5">{{ $purchase->suppliers->name }} {{ $purchase->suppliers->surname }}</td>
                            <td class="tp-3 tpx-5">{{ currency() }}{{ number_format($purchase->total_price + $purchase->shipping_fee + $purchase->transaction_fee + $purchase->tax, 2) }}</td>
                            <td class="tp-3 tpx-5">
                                @if ($purchase->status == 'OTW')
                                    <span class="chip orange lighten-5 waves-effect waves-orange status" data-status="inactive" data-id="1" style="cursor: pointer;">
                                        <span class="orange-text" style="cursor: pointer;">{{ $purchase->status }}</span>
                                    </span>
                                @elseif($purchase->status == 'INCOMPLETE')
                                    <span class="chip red lighten-5 waves-effect waves-red status" data-status="active" data-id="2" style="cursor: pointer;">
                                        <span class="red-text" style="cursor: pointer;">{{ $purchase->status }}</span>
                                    </span>
                                @elseif($purchase->status == 'COMPLETED')
                                    <span class="chip green lighten-5 waves-effect waves-green status" data-status="inactive" data-id="1" style="cursor: pointer;">
                                        <span class="green-text" style="cursor: pointer;">{{ $purchase->status }}</span>
                                    </span>
                                @endif

                                
                                
                            </td>
                            <td class="tp-3 tpx-5 ttext-center">
                                <a href="/admin/purchase/view/{{ $purchase->id }}" >
                                    <i class="fa-external-link-alt fas gray-text tcursor-pointer tooltipped" data-position="left" data-tooltip="view transaction"></i>
                                </a>
                                <a href="/admin/purchase/update/{{ $purchase->id }}" >
                                    <i class="fas fa-edit hover:ttext-pink-500 tcursor-pointer tpx-1 icon_color tooltipped" data-position="right" data-tooltip="Edit"></i>       
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