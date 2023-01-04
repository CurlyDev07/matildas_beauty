@extends('admin.layouts.app')

@section('content')
    <div class="tbg-white tp-8 trelative" id="receipt">   
        <img src="{{ asset('icons\printer.png') }}" class="tabsolute" id="print" style="top: -2%;left: 47%;border: 15px solid #f3f5f7;border-radius: 50%;background-color: #f3f5f7;" >
        <div class="tflex tjustify-between">
            <div class="ttext-2xl ttext-title tfont-medium tpb-4">
                Order#: {{ $orders['order_number'] }}
            </div>
            <div class="">
                @if ($orders['payments']['payment_status'] == 'completed')
                    <span class="chip green lighten-5">
                        <span class="green-text">{{ ucwords($orders['payments']['payment_status']) }}</span>
                    </span>
                @else
                    <span class="chip red lighten-5">
                        <span class="red-text">{{ ucwords($orders['payments']['payment_status']) }}</span>
                    </span>
                @endif
            </div>
        </div>
        <div class="">
            <div class="tflex tmb-5">
                <div class="tw-1/3">
                    <div class="tmb-2">
                        <div class="tfont-medium">Name:</div>
                        <div class="">{{ $orders['first_name'] .' '. $orders['last_name'] }}</div>
                    </div>
                    {{-- <div class="tmb-2">
                        <div class="tfont-medium">Phone number:</div>
                        <div class="">{{ $orders['phone_number'] }}</div>
                    </div> --}}
                </div>
               
                <div class="tw-1/3">
                    <div class="tmb-2">
                        <div class="tfont-medium">Date:</div>
                        <div class="">{{ date_f($orders['created_at'], 'M d, Y - ga') }}</div>
                    </div>
                </div>
                
                <div class="tw-1/3">
                    <div class="tmb-2">
                        <div class="tfont-medium">Package Qty</div>
                        <div class="">{{ number_format($orders['package_qty']) }}</div>
                    </div>
                </div>

                {{-- <div class="tw-1/3">
                    <div class="tmr-4 tfont-medium tmb-1">Shipping Address:</div>
                    <div class="tleading-loose ttracking-wide">
                        {{ $orders['address'] }}
                        {{ $orders['barangay'] }}
                        {{ $orders['city'] }}
                        {{ $orders['province'] }}
                        {{ $orders['zip_code'] }}
                    </div>
                </div> --}}
            </div>{{-- Customer's Details --}}
           

            <table class="responsive-table centered">
                <thead>
                    <tr class="">
                        <th class="ttext-left ttext-title tpt-0 tinvisible">Item</th>
                        {{-- <th class="ttext-center ttext-title tpt-0">Price</th> --}}
                        <th class="ttext-center ttext-title tpt-0">Quantity</th>
                        {{-- <th class="ttext-center ttext-title tpt-0">Subtotal</th> --}}
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($orders['products'] as $item)
                        <tr>
                            <td style="width: 55%;!important" class="tpy-1">
                                <div class="tflex titems-center">
                                    <img src="{{ $item['product']['images'][0]['img'] }}" style="height: 55px;width: 55px;" alt="">
                                    <span class="ttext-primary hover:tunderline"></span>
                                    <a href="{{ item_show_slug($item['product']['title'], $item['product']['id']) }}" class="hover:tunderline tmax-w-sm tml-3 ttext-primary truncate">
                                        {{ $item['product']['title'] }}
                                    </a>
                                </div>
                            </td>
                            {{-- <td style="width: 15%;!important">{{ currency() }}{{ number_format($item['price'], 2) }}</td> --}}
                            <td style="width: 15%;!important">{{ $item['qty'] }}</td>
                            {{-- <td style="width: 15%;!important">{{ currency() }}{{ number_format($item['subtotal'], 2) }}</td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tborder-gray-400">Subtotal</div>
                {{-- <div class="tw-1/5 ttext-center tp-4">{{ currency() }}{{ number_format($orders['payments']['subtotal'], 2) }}</div> --}}
            </div>  
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tborder-gray-400">Shipping Fee</div>
                <div class="tw-1/5 ttext-center tp-4">{{ currency() }}{{ number_format($orders['payments']['shipping_fee'], 2) }}</div>
            </div>  
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tfont-medium tborder-gray-400 tbg-gray-200">Order Total</div>
                <div class="tw-1/5 ttext-center tpx-4 tpy-3 tfont-medium tbg-gray-200 ttext-xl">
                    {{ currency() }}{{ number_format($orders['payments']['total'], 2) }}
                </div>
            </div>  
        </div>
    </div>

@endsection
@section('js')
    <script src="{{ asset('js/plugins/print_this.js') }}"></script>
    <script>
        $('#print').click(function () {
            $(this).addClass('thidden');
            $('#receipt').printThis({
                importCSS: false,
                loadCSS: "/css/app.css",
                afterPrint: function () {
                    $('#print').removeClass('thidden');
                }
            });
        });
    </script>
@endsection