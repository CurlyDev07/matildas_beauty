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
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Order#</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Total</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Date</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                        <th class="ttext-left tp-3 tpx-5 ttext-black-100 tfont-medium">Actions</th>
                    </tr>
                    
                    @foreach ($orders as $order)
                    {{-- {{ dd($order) }} --}}
                        <tr class="tborder-0 hover:tbg-blue-100">
                            <td class="tp-3 tpx-5 ttext-black-100 tfont-medium">#{{ $order['order_number'] }}</td>
                            <td class="tp-3 tpx-5">{{ $order['first_name'] .' '. $order['last_name'] }}</td>
                            <td class="tp-3 tpx-5">₱{{ number_format($order['payments']['total']) }}</td>
                            <td class="tp-3 tpx-5">{{ $order['created_at']->format('M d, Y g:i a') }}</td>
                            <td class="tp-3 tpx-5">
                                @if ($order['payments']['payment_status'] == 'completed')
                                    <span class="chip green lighten-5">
                                        <span class="green-text">{{ ucwords($order['payments']['payment_status']) }}</span>
                                    </span>
                                @else
                                    <span class="chip red lighten-5">
                                        <span class="red-text">{{ ucwords($order['payments']['payment_status']) }}</span>
                                    </span>
                                @endif
                            </td>
                            <td class="tp-3 tpx-5">
                                <a href="orders/view/{{ $order->id }}">
                                    <i class="fa-external-link-alt fas gray-text tcursor-pointer tooltipped" data-position="left" data-tooltip="view transaction"></i>
                                    <a class="modal-trigger" href="#modal-{{ $order['order_number'] }}">
                                        <i class="fa-cog fas gray-text tcursor-pointer tooltipped" data-position="top" data-tooltip="settings"></i>
                                    </a>

                                    <div id="modal-{{ $order['order_number'] }}" class="modal modal-fixed-footer">
                                        <div class="modal-content">
                                            <h4>#{{ $order['order_number'] }}</h4>
                                            <!-- Dropdown Trigger -->
                                            <a class='dropdown-trigger btn' href='#' data-target="dropdown-{{ $order['order_number'] }}">Change Status</a>

                                            <!-- Dropdown Structure -->
                                            <ul id="dropdown-{{ $order['order_number'] }}" class='dropdown-content'>
                                                <li><a href="javascript:void(0)" class="change_status" data-id="{{ $order->id }}" data-status="processing">Processing</a></li>
                                                <li><a href="javascript:void(0)" class="change_status" data-id="{{ $order->id }}" data-status="to_ship">To ship</a></li>
                                                <li><a href="javascript:void(0)" class="change_status" data-id="{{ $order->id }}" data-status="to_receive">To recieve</a></li>
                                                <li><a href="javascript:void(0)" class="change_status" data-id="{{ $order->id }}" data-status="completed">Completed</a></li>
                                                <li><a href="javascript:void(0)" class="change_status" data-id="{{ $order->id }}" data-status="declined">Declined</a></li>
                                            </ul>
                                                
                                        </div>
                                        <div class="modal-footer">
                                            <a href="#!" class="modal-close waves-effect waves-green btn-flat">Done</a>
                                        </div>
                                    </div>
                                </a>
                            </td>
                        </tr>
                    @endforeach

                    @if (count($orders) < 1)
                        <tr>
                            <td colspan="6">
                                <p class="tfont-medium ttext-center">Orders is empty...</p>
                            </td>
                        </tr>
                    @endif

                </tbody>
            </table>
        </div><!-- TABLE -->

        {{ $orders->appends(request()->except('page'))->links() }}
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