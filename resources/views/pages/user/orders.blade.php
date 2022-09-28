<div id="orders" class="col s12">
    <div class="ttext-2xl ttext-title tfont-medium tpb-4">Order History</div>

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-4">
            <span class="ttext-base ttext-title tfont-medium">Order List</span>
            <ul class="tflex">
                {{-- <li class="">
                    <i class="material-icons grey-text">delete</i>
                </li>
                <li class="ttext-center">
                    <i class="material-icons grey-text">sort</i>
                </li> --}}
                <li class="ttext-center">
                    <i class="material-icons grey-text">more_vert</i>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4">
            
            {{-- ORDERS MOBILE DISPLAY --}}
            @foreach ($orders as $order)
                <div class="tflex sm:hidden tbg-white tmb-3 trounded tshadow">
                    <img src="{{ url($order['products'][0]['product']['primary_image']) }}" class="tmr-3 trounded-l" alt="cart item" style="max-width: 112px;height: auto;">
                    <div class="tflex tflex-wrap toverflow-x-hidden">
                        <a href="{{ route('dashboard.order.view', ['transaction_id' => $order['id']]) }}" target="_blank">
                            <p class="truncate ttext-blue-500 ttext-sm tunderline" style="height: 38px;line-height: 17px;">{{ $order['products'][0]['product']['title'] }} </p>
                        </a>
                        <div class="tflex titems-center tjustify-between tw-full">
                            <span class="rounded tbg-green-200 tno-underline tpx-3 tpy-1 trounded ttext-green-700 ttext-sm">{{ $order['status'] }}</span>
                            <span class="tmr-3 ttext-gray-600 ttext-sm">{{ count($order['products']) }} Item(s)</span>
                        </div>
                        <div class="tflex titems-center tjustify-between tw-full">
                            <span class="ttext-gray-600 ttext-sm">#{{ $order['order_number'] }}</span>
                            <span class="ttext-primary tmr-3 tfont-medium">{{ currency() }}{{ number_format($order['payments']['total'], 2) }}</span>
                        </div>
                    </div>
                </div>
            @endforeach

        </div>
    </div>
</div>