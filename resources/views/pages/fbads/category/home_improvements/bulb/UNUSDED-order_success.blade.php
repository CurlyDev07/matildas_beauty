@extends('pages.fbads.category.home_improvements.layouts.app')

@section('content')
        @php
            $price_qty = explode('|', $data['promo']);
        @endphp


    <div class="container">
        <div class="tmax-w-md tpy-10 tflex titems-center tjustify-center tmx-auto">

            <div class="tabsolute ttop-0">
                <div class="tflex tjustify-center">
                    <img src="{{ asset('images/fbads/lightbulb/light-bulb-logo.png') }}" class="tmt-10" width="60px" alt="">
                </div><!-- LOGO -->
            </div>

            <div class="tflex titems-center tflex-col tmt-5">
                
                <p class="ttext-center tfont-medium ttext-2xl tmt-12" style="color: #367d54">Smart Home PH</p>

                <div class="tflex tjustify-center tw-full tmy-3 tborder tp-3">
                    <i class="fa-regular fa-circle-check ttext-5xl ttext-green-500 tmr-3"></i>
                    
                    <div class="tflex tflex-col trelative">
                        <span>Order Success</span>
                        {{-- <span class="tfont-medium">Thank You {{ $data['full_name'] }}</span> --}}
                        <span class="ttext-sm">#{{ $data['order_number'] }}</span>
                    </div>
                </div>

                <div class="tw-full tborder tborder-2 tp-3 tm-2">
                    <h2 class="ttext-xl tfont-medium">Customer Information</h2>

                    <div class="tw-full tflex tmt-5">
                        <div class="tw-1/2 tflex tflex-col">
                            <span class="ttext-md tfont-medium">Fullname</span>
                            <span class="">{{ $data['full_name'] }}</span>
                        </div>
                        <div class="tw-1/2 tflex tflex-col">
                            <span class="ttext-md tfont-medium">Contact Number</span>
                            <span class="">{{ $data['phone_number'] }}</span>
                            <input type="hidden" id="phone_number"  value="{{ hash('sha256', $data['phone_number']) }}">
                        </div>
                    </div>
                    <div class="tw-full tflex tmt-3">
                        <div class="">
                            <h2 class="ttext-md tfont-medium">Shipping Address</h2>
                        </div>
                    </div>
                    <div class="tw-full tflex tmt-3">
                        <span>{{ $data['address'] }}</span>
                    </div>
                </div>  

                <div class="tw-full tborder tborder-2 tp-3 tm-2">
                    <div class="tflex titems-center tjustify-between">
                        <img width="100" src="{{ asset('images/fbads/lightbulb/product.jpg') }}" class="tmr-3" alt="Product Image">
                        <div class="">Smart Light Movement Detector |  {{ $price_qty[2] }}</div>
                    </div>

                    <div class="tflex tjustify-end titems-center">
                        <span class="tfont-medium tmx-2 ttext-gray-700 ttext-md">Total: </span>
                        <span class="tmr-3 tmb-2 ttext-xl tfont-medium" style="color: #ee4d2d">₱{{ $price_qty[1] }}</span>
                        <input type="hidden" name="purchase_value" id="purchase_value" value="{{ $price_qty[1] }}">
                    </div>
                </div>

            </div>
        </div>
    </div>

    @if (request()->amount)
        <script>
            let fb_purchase_value = $('#purchase_value').val()? $('#purchase_value').val() : 0;
            fbq('track', 'Purchase', {currency: "PHP", value: fb_purchase_value});

            ttq.track('PlaceAnOrder', {
                "contents": [
                    {
                        "content_id": "1", // string. ID of the product. Example: "1077218".
                        "quantity": 1, // number. The number of items. Example: 4.
                        "price": fb_purchase_value // number. The price of a single item. Example: 25.
                    }
                ],
                "value": fb_purchase_value, // number. Value of the order or items sold. Example: 100.
                "currency": "PHP", // string. The 4217 currency code. Example: "USD".
                "description": "" // string. Non-hashed public IP address of the browser.
            });

            ttq.track('CompletePayment', {
                "contents": [
                    {
                        "content_id": 1, // string. ID of the product. Example: "1077218".
                        "quantity": 1, // number. The number of items. Example: 4.
                        "price": fb_purchase_value // number. The price of a single item. Example: 25.
                    }
                ],
                "value": fb_purchase_value, // number. Value of the order or items sold. Example: 100.
                "currency": "PHP", // string. The 4217 currency code. Example: "USD".
                "description": "" // string. Non-hashed public IP address of the browser.
            });

        </script>
    @endif

    <script>
        // add this before event code to all pages where PII data postback is expected and appropriate 
        ttq.identify({
            "email": "", // string. The email of the customer if available. It must be hashed with SHA-256 on the client side.
            "phone_number": $('#phone_number').val(), // string. The phone number of the customer if available. It must be hashed with SHA-256 on the client side.
            "external_id": "" // string. Any unique identifier, such as loyalty membership IDs, user IDs, and external cookie IDs.It must be hashed with SHA-256 on the client side.
        });
    </script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        let data = {!! json_encode($data) !!};
        $.post("/Madella-Order-Success-Email",{
            data,
        });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS

        $.post("/event-listener",{
            order_success: 1
        });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS

    </script>

@endsection
