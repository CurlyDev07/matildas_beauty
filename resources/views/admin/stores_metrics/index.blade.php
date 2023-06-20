@extends('admin.stores_metrics.layouts')


@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Stores</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <button type="submit" style="height: 40px; border-right-style: dashed;" class="focus:tbg-white focus:toutline-none tborder-r grey-text tborder tborder-gray-200 tborder-r-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-l-full waves-effect">
                            <img class="" src="{{ asset('icons/store.png') }}" alt="">
                        </button>
                        
                        <input type="text" placeholder="Not working yet. . ." name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-r-full trounded-tl" placeholder="Search order number">
                    </form>
                </li><!-- SEARCH -->

                <li>    
                    @if (request()->orders == 'desc')
                        <a href="?orders=asc" class="tooltipped" data-position="top" data-tooltip="Sort by orders">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Orders: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('icons/number_sort_down.png') }}" alt="">
                            </div>
                        </a> 
                    @else
                        <a href="?orders=desc" class="tooltipped" data-position="top" data-tooltip="Sort by orders">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Orders: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT ORDERS-->
                <li class="tml-1">    
                    @if (request()->sales == 'desc')
                    <a href="?sales=asc" class="tooltipped" data-position="top" data-tooltip="Sort by sales">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1">Sales: &nbsp;</span>
                            <img class="tpr-1" src="{{ asset('icons/number_sort_down.png') }}" alt="">
                        </div>
                    </a> 
                @else
                    <a href="?sales=desc" class="tooltipped" data-position="top" data-tooltip="Sort by sales">
                        <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                            <span class="tpl-1">Sales: &nbsp;</span>
                            <img class="tpr-1" src="{{ asset('icons/number_sort_up.png') }}" alt="">
                        </div>
                    </a>
                @endif
                </li><!-- SORT SALES-->
                <li class="tml-1">    
                    @if (request()->conversion_rate == 'desc')
                        <a href="?conversion_rate=asc" class="tooltipped" data-position="top" data-tooltip="Sort by conversion rate">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Conversion rate: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('icons/number_sort_down.png') }}" alt="">
                            </div>
                        </a> 
                    @else
                        <a href="?conversion_rate=desc" class="tooltipped" data-position="top" data-tooltip="Sort by conversion rate">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Conversion rate: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT CONVERSION RATE-->
                <li class="tml-1">    
                    @if (request()->visitors == 'desc')
                        <a href="?visitors=asc" class="tooltipped" data-position="top" data-tooltip="Sort by Visitors">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Visitors: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('icons/number_sort_down.png') }}" alt="">
                            </div>
                        </a> 
                    @else
                        <a href="?visitors=desc" class="tooltipped" data-position="top" data-tooltip="Sort by Visitors">
                            <div class="tborder tflex tp-1 trounded ttext-sm titems-center">
                                <span class="tpl-1">Visitors: &nbsp;</span>
                                <img class="tpr-1" src="{{ asset('icons/number_sort_up.png') }}" alt="">
                            </div>
                        </a>
                    @endif
                </li><!-- SORT VISITORS-->
                <li class="tml-2">
                    <a href="/admin/store-metrics">
                        <img src="{{ asset('icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Date</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Store</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Sales</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Orders</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Conversion Rate</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Visitors</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Action</th>
                    </tr>

                    @foreach ($metrics as $metric)

                        <tr>
                            <td class="ttext-sm ttext-center">{{ $metric->date }}</td>
                            <td class="ttext-sm ttext-center">{{ $metric->store->store_name }}</td>
                            <td class="ttext-sm ttext-center">{{ $metric->sales }}</td>
                            <td class="ttext-sm ttext-center">{{ $metric->orders }}</td>
                            <td class="ttext-sm ttext-center">{{ $metric->conversion_rate }} %</td>
                            <td class="ttext-sm ttext-center">{{ $metric->visitors }}</td>
                            <td class="ttext-sm ttext-center">
                                <a href="/admin/store-metrics/update/{{ $metric->id }}">
                                    <i class="fas fa-edit hover:ttext-pink-500 tcursor-pointer tpx-1 icon_color tooltipped" data-position="right" data-tooltip="Edit"></i>       
                                </a>
                            </td>
                        </tr>
                    @endforeach
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
@endsection