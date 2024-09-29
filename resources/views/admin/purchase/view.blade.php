@extends('admin.layouts.app')

@section('content')
    <div class="tbg-white tp-8 trelative" id="receipt">   
        <img src="{{ asset('icons\printer.png') }}" class="tabsolute" id="print" style="top: -2%;left: 47%;border: 15px solid #f3f5f7;border-radius: 50%;background-color: #f3f5f7;" >
        <div class="tflex tjustify-between">
            {{-- {{ dd($purchase) }} --}}
            <div class="ttext-2xl ttext-title tfont-medium tpb-4">
                Order#: #MBP{{ date('dmy',strtotime($purchase['created_at'])) }}{{ $purchase['id'] }}
            </div>
        </div>
        <div class="">
            <div class="tflex tmb-5">
                <div class="tw-full">
                    <div class="tmb-2">
                        <div class="tfont-medium">Supplier:</div>
                        <div class="">{{ $purchase['supplier'] ?? 'N/A'  }}</div>
                    </div>
                </div>
               
                <div class="tw-full">
                    <div class="tmb-2 ttext-right">
                        <div class="tfont-medium">Date:</div>
                        <div class="">{{ date('M d, Y',strtotime($purchase['created_at'])) }}</div>
                    </div>
                </div>
            </div>{{-- Customer's Details --}}
           

            <table class="responsive-table centered">
                <thead>
                    <tr class="">
                        <th class="ttext-left ttext-title tpt-0 tinvisible">Item</th>
                        <th class="ttext-center ttext-title tpt-0">Price</th>
                        <th class="ttext-center ttext-title tpt-0">Quantity</th>
                        <th class="ttext-center ttext-title tpt-0">Subtotal</th>
                    </tr>
                </thead>
        
                <tbody>
                    @foreach ($purchase['purchase_product'] as $product)
                        <tr>
                            <td style="width: 55%;!important" class="tpy-0">
                                <div class="tflex titems-center">
                                    <img src="{{ $product['product']['primary_image'] }}" class="" style="height: 80px;width: 80px;" alt="">
                                    <span class="ttext-primary hover:tunderline"></span>
                                    <a href="{{ item_show_slug($product['product']['title'], $product['product']['id']) }}" class="hover:tunderline tmax-w-sm tml-3 ttext-primary truncate">
                                        {{ $product['product']['title'] }}
                                    </a>
                                </div>
                            </td>
                            <td style="width: 15%;!important">{{ currency() }}{{ number_format($product['price'], 2) }}</td>
                            <td style="width: 15%;!important">{{ $product['qty'] }}</td>
                            <td style="width: 15%;!important">{{ currency() }}{{ number_format($product['sub_total'], 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tborder-gray-400">Subtotal</div>
                <div class="tw-1/5 ttext-center tp-4">{{ currency() }}{{ number_format($purchase['total_price'], 2) }}</div>
            </div>  
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tborder-gray-400">Shipping Fee</div>
                <div class="tw-1/5 ttext-center tp-4">{{ currency() }}{{ number_format($purchase['shipping_fee'], 2) }}</div>
            </div>  
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tborder-gray-400">Transaction Fee</div>
                <div class="tw-1/5 ttext-center tp-4">{{ currency() }}{{ number_format($purchase['transaction_fee'], 2) }}</div>
            </div>  
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tborder-gray-400">Tax/VAT</div>
                <div class="tw-1/5 ttext-center tp-4">{{ currency() }}{{ number_format($purchase['tax'], 2) }}</div>
            </div>  
            <div class="tborder-b tflex">
                <div class="tw-4/5 ttext-right tp-4 tborder-r-2 tfont-medium tborder-gray-400 tbg-gray-200">Order Total</div>
                <div class="tw-1/5 ttext-center tpx-4 tpy-3 tfont-medium tbg-gray-200 ttext-xl">
                    {{ currency() }}{{ number_format($purchase['total_price'] + $purchase['shipping_fee'] + $purchase['transaction_fee'] + $purchase['tax'], 2 )}}
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