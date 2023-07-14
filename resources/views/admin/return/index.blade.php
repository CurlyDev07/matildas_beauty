@extends('admin.return.layouts')


@section('page')



    <div class="tbg-white trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-1">
            <div class="">
                <div class="ttext-sm">Rts: <span class="tfont-semibold">{{ number_format($rts_count) }}</span></div>
                <div class="ttext-sm">Potential Profit Total: <span class="tfont-semibold">{{ number_format($potential_profit) }}</span></div>
                <div class="ttext-sm">Total Items: 
                    <span class="tfont-semibold ttext-green-700">Good ({{ number_format($total_good_items) }}) </span>
                    <span class="tfont-semibold ttext-red-700">Damaged ({{ number_format($total_damaged_items) }}) </span>
                    {{-- <span class="tfont-semibold">1,831</span> --}}
                </div>
            </div>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center tooltipped" data-position="top" data-tooltip="Search Transaction Number">
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
                    <a href="/admin/rts/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">#</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Transaction #</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Platform</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Courrier</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Package</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Product Value</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Potential Profit</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                    </tr>
                </tbody>

                @foreach ($return as $rts)
                
                    <tr>    
                        <td class="ttext-sm ttext-center tpy-1">{{ $rts->id }}</td>
                        <td class="ttext-sm ttext-center tpy-1">
                            <a href="{{ route('rts.update', ['transaction_id' => $rts->id]) }}" class="ttext-blue-500">
                                {{ $rts->transaction_id }}
                            </a>
                        </td>
                        <td class="ttext-sm tpy-1">
                            @if ($rts->platform == 'shopee')
                                <img class="th-10 tmx-auto" src="{{ asset('/images/icons/shopee.png') }}">
                            @elseif($rts->platform == 'lazada')
                                <img class="th-10 tmx-auto" src="{{ asset('/images/icons/lazada.png') }}">
                            @elseif($rts->platform == 'tiktok')
                                <img class="th-10 tmx-auto" src="{{ asset('/images/icons/tiktok.png') }}">
                            @endif
                        </td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $rts->courier }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $rts->products()->count() }} items</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $rts->products()->sum('capital') }}</td>
                        <td class="ttext-sm ttext-center tpy-1">{{ $rts->products()->sum('potential_profit') }}</td>
                        <td class="ttext-sm ttext-center tpy-1">
                            @if ($rts->status == 'complete')
                                <span class="tm-0 chip green lighten-5 waves-effect waves-green status" data-status="inactive" data-id="20" style="cursor: pointer;">
                                    <span class="green-text" style="cursor: pointer;">{{ $rts->status }}</span>
                                </span>
                            @else
                                <span class="tm-0 chip red lighten-5 waves-effect waves-red status" data-status="inactive" data-id="20" style="cursor: pointer;">
                                    <span class="red-text" style="cursor: pointer;">{{ $rts->status }}</span>
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div><!-- TABLE -->

        <div class="tbg-white tflex tjustify-end tpb-1">
            {{ $return->onEachSide(1)->appends(request()->except('page'))->links() }}
        </div>
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
@endsection