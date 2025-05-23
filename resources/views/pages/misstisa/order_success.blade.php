<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MissTisa | Matilda's Beauty</title>
    {{-- STYLE SHEETS --}}
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css" integrity="sha512-gMjQeDaELJ0ryCI+FtItusU9MkAifCZcGq789FrzkiM49D8lbDhoaUaIX4ASU187wofMNlgBJ4ckbrXM9sE6Pg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
       .input-control {
            width: 100%;
            padding: 12px!important;
            font-size: 14px;
            line-height: 1.5;
            color: #495057;
            background-color: #fff;
            border: 1px solid #e1e5eb;
            font-weight: 400;
            will-change: border-color,box-shadow;
            border-radius: 0.25rem;
            box-shadow: none;
            transition: box-shadow 250ms cubic-bezier(.27,.01,.38,1.06),border 250ms cubic-bezier(.27,.01,.38,1.06);
        }

        .zoom-in-out-box {
            animation: zoom-in-zoom-out 1s ease infinite;
        }

        @keyframes zoom-in-zoom-out {
            0% {
                transform: scale(1, 1);
            }
            30% {
                transform: scale(1.1, 1.1);
            }
            100% {
                transform: scale(1, 1);
            }
        }

        li{
            list-style-type: disc !important;
        }

        .gredient-border{
            border: linear-gradient(180deg, rgba(255, 106, 0, 1) 0%, rgba(238, 9, 9, 1) 100%);
            background: linear-gradient(#fff, #fff), linear-gradient(to right, #f63705, #fc5b01);
            background-origin: padding-box, border-box;
            background-repeat: no-repeat;
            border: 5px solid transparent;
        }

    </style>

    <script src="{{ asset('js/jquery-3.4.1.min.js') }}"  crossorigin="anonymous"></script>
    <script src="{{ asset('js/materialize.min.js') }}"  crossorigin="anonymous"></script>

<!-- Meta Pixel Code -->
<script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '375777585581364');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=375777585581364&ev=PageView&noscript=1"
/></noscript>
    <!-- End Meta Pixel Code -->


    <!----- Tiktok Pixel Code ----->
        <script>
            !function (w, d, t) {
                w.TiktokAnalyticsObject=t;var ttq=w[t]=w[t]||[];ttq.methods=["page","track","identify","instances","debug","on","off","once","ready","alias","group","enableCookie","disableCookie"],ttq.setAndDefer=function(t,e){t[e]=function(){t.push([e].concat(Array.prototype.slice.call(arguments,0)))}};for(var i=0;i<ttq.methods.length;i++)ttq.setAndDefer(ttq,ttq.methods[i]);ttq.instance=function(t){for(var e=ttq._i[t]||[],n=0;n<ttq.methods.length;n++)ttq.setAndDefer(e,ttq.methods[n]);return e},ttq.load=function(e,n){var i="https://analytics.tiktok.com/i18n/pixel/events.js";ttq._i=ttq._i||{},ttq._i[e]=[],ttq._i[e]._u=i,ttq._t=ttq._t||{},ttq._t[e]=+new Date,ttq._o=ttq._o||{},ttq._o[e]=n||{};var o=document.createElement("script");o.type="text/javascript",o.async=!0,o.src=i+"?sdkid="+e+"&lib="+t;var a=document.getElementsByTagName("script")[0];a.parentNode.insertBefore(o,a)};
            
                ttq.load('CNAPJGJC77U3KI9K4LG0');
                ttq.page();
            }(window, document, 'ttq');
        </script>
    <!----- Tiktok Pixel Code ----->

</head>
<body>
        @php
            $price_qty = explode('|', $data['promo']);
        @endphp


    <div class="container">
        <div class="tmax-w-md tpy-10 tflex titems-center tjustify-center tmx-auto">

            <div class="tabsolute ttop-0">
                <div class="tflex tjustify-center">
                    <img src="{{ asset('/images/logo/main.png') }}" class="" width="60px" alt="">
                </div>
                {{-- <p class="tfont-medium ttext-center ttext-md" style="color: #ef0e5f;margin: -10px;">Matilda's Beauty</p> --}}
            </div>

            <div class="tflex titems-center tflex-col">
                
                <p class="ttext-center tfont-medium ttext-2xl tmt-5" style="color: #ef0e5f">MissTisa Melasma</p>

                <div class="tflex tjustify-center tw-full tmy-3 tborder tp-3">
                    <i class="fas fa-check-circle ttext-5xl ttext-green-500 tmr-3"></i>
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
                            <span class=""  id="name">{{ $data['full_name'] }}</span>
                        </div>
                        <div class="tw-1/2 tflex tflex-col">
                            <span class="ttext-md tfont-medium">Contact Number</span>
                            <span class="">{{ $data['phone_number'] }}</span>
                            <input type="hidden" id="phone_number" value="{{ hash('sha256', $data['phone_number']) }}">
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
                        @if ($price_qty[0]== '1_MissTisa_Set_1Serum')
                            <img width="100" src="https://matildasbeauty.com/filemanager/9d372f1034674394b23c84857fd1f2e8.png" class="tmr-3" alt="MissTisa Melasma Remover">
                        @endif

                        @if ($price_qty[0]== 'MissTisaSerum_1pc')
                            <img width="100" src="https://matildasbeauty.com/filemanager/b6d6e20c2ca549efb5d4e4ea2a83bc87.png" class="tmr-3" alt="MissTisa Melasma Remover">
                        @endif

                        @if ($price_qty[0]== 'MissTisaSerum_2pcs')
                            <img width="100" src="https://matildasbeauty.com/filemanager/8449a9bc19c341eea5488ca059d84e13.png" class="tmr-3" alt="MissTisa Melasma Remover">
                        @endif

                        @if ($price_qty[0]== 'MissTisa_1pc')
                            <img width="100" src="https://matildasbeauty.com/filemanager/7c631048d01544f8bc9616f98ca66f59.png" class="tmr-3" alt="MissTisa Melasma Remover">
                        @endif

                        <div class="">{{ str_replace('_', ' ', $price_qty[0]) }}</div>
                    </div>

                    <div class="tflex tjustify-end titems-center">
                        <span class="tfont-medium tmx-2 ttext-gray-700 ttext-md">Total: </span>
                        <span class="tmr-3 tmb-2 ttext-xl tfont-medium" style="color: #ef0e5f">{{ $price_qty[1] }}₱</span>
                        <input type="hidden" name="purchase_value" id="purchase_value" value="{{ $price_qty[1] }}">
                    </div>
                </div>

                <div class="tw-full tborder ttext-center tborder-2 tp-3 tm-2">
                   
                    <a href="https://www.facebook.com/groups/422982666836465"  target="_blank" rel="noopener noreferrer">
                        <span class="tfont-medium"> Join Our Facebook Group</span>
                        <br>

                         <span class="ttext-blue-600">
                            <i class="fas fa-arrow-right"></i>
                             https://www.facebook.com/groups/MissTisa 
                            <i class="fas fa-arrow-left"></i>
                        </span> 
                    </a>
                </div>

            </div>
        </div>
    </div>

    <footer>

        <script>

            // add this before event code to all pages where PII data postback is expected and appropriate 
            ttq.identify({
                "email": "", // string. The email of the customer if available. It must be hashed with SHA-256 on the client side.
                "phone_number": $('#phone_number').val(), // string. The phone number of the customer if available. It must be hashed with SHA-256 on the client side.
                "external_id": "" // string. Any unique identifier, such as loyalty membership IDs, user IDs, and external cookie IDs.It must be hashed with SHA-256 on the client side.
            });
        </script>


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
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.post("/event-listener",{
                order_success: 1,
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
                name: $('#name').html(),
                contact_number: '{{ request("phone_number") }}'
            });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS

        </script>
    </footer>

</body>
</html>