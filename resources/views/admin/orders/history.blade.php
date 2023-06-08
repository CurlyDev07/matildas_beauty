@extends('admin.orders.layouts')


@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Orders List</span>
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
                    <a href="/admin/orders/">
                        {{-- <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter"> --}}
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex">
            <table style="width: 100%;">
                <tr>
                    <th>Products</th>
                    @foreach ($dates as $date)
                        <th>{{ date_f($date['date'], 'M d') }}</th>    
                    @endforeach
                    <th>Avg</th>
                </tr>

                    @foreach ($products as $product)
                        <tr>
                            <td>{{ $product->title }}</td> <!-- Foreach Product -->

                            @if (count($dates) > 0)
                                @foreach ($dates as $date)
                                    <td class="tfont-semibold ttext-xs">
                                        {{ \App\TransactionPorductSummary::select('qty')->where(['product_id' => $product->id ,'date' => $date['date']])->first()['qty']?? '0' }}
                                    </td>
                                @endforeach
                            @endif


                            <td class="tfont-semibold ttext-md">
                                @if (count($dates) > 0)
                                    @php
                                        $sum = \App\TransactionPorductSummary::select('qty')->where('product_id', $product->id)->whereBetween('date', [$dates[0]['date'], $dates[(count($dates) - 1)]['date']])->sum('qty');
                                        $date_count = count($dates);

                                        echo number_format($sum/$date_count);
                                    @endphp
                                @endif

                            </td>
                        </tr>
                    @endforeach
               
            </table>
         <hr>

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
@endsection