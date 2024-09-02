<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MissTisa | Matilda's Beauty</title>
    {{-- STYLE SHEETS --}}
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" >
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  
    <style>
        /* CHECK BOX */
        [type="checkbox"]:checked+span:not(.lever):before {
            top: -4px;
            left: -5px;
            width: 12px;
            height: 22px;
            border-top: 2px solid transparent;
            border-left: 2px solid transparent;
            border-right: 2px solid #ee4d2d!important;
            border-bottom: 2px solid #ee4d2d!important;
            -webkit-transform: rotate(40deg);
            transform: rotate(40deg);
            -webkit-backface-visibility: hidden;
            backface-visibility: hidden;
            -webkit-transform-origin: 100% 100%;
            transform-origin: 100% 100%;
        }


        .shopee-bg-color{
            background: linear-gradient(-180deg, #f53d2d, #f63);
            transition: transform .2s cubic-bezier(.4,0,.2,1);
        }

        .shopee-bg-green{
            background-color: #26a998;
        }

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
    <script src="https://kit.fontawesome.com/8d4a8c4bc9.js" crossorigin="anonymous"></script>

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
        fbq('init', '1081433249584415');
        fbq('track', 'PageView');
    </script>

    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=1081433249584415&ev=PageView&noscript=1"
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
    
    <div style="scroll-behavior: smooth;max-width: 480px;" class="tmx-auto" id="body">
        <div class="tflex tfont-medium titems-center tjustify-center trelative tshadow-md ttext-center shopee-bg-color" style="height: 45px;">
            <p class="tfont-medium  ttext-lg ttext-white">SAVE UP TO 46% WITH 4 FREE GIFTS</p>
        </div>

        <img src="{{ asset('images/kasoy_oil/goree_banner.png') }}" class="tw-full" alt="top_banner">

        <div class="tmx-2 tflex titems-center tflex-wrap tpy-3">
            <div class="tborder-gray-200 tborder-r-2 tflex tflex-col tflex-grow titems-center tjustify-between tpx-3">
                <span class="tfont-bold ttext-4xl" style="color: #ea353d;">60</span>
                <span class="tfont-medium">Servings</span>
            </div>
            <div class="tborder-gray-200 tborder-r-2 tflex tflex-col tflex-grow titems-center tjustify-between tpx-3">
                <span class="tfont-bold ttext-4xl" style="color: #ea353d;">75</span>
                <span class="tfont-medium">Ingredients</span>
            </div>
            <div class="tborder-gray-200 tborder-r-2 tflex tflex-col tflex-grow titems-center tjustify-between tpx-3">
                <span class="tfont-bold ttext-4xl" style="color: #ea353d;">50</span>
                <span class="tfont-medium">Calories</span>
            </div>
            <div class="tflex tflex-col tflex-grow titems-center tjustify-between tpx-3">
                <span class="tfont-bold ttext-4xl" style="color: #ea353d;">12</span>
                <span class="tfont-medium">Vitamins</span>
            </div>
        </div><!-- Benefits -->

        <div class="tmx-3 tflex titems-center tmy-5">
            <div class="tw-1/2 tborder-gray-200 tborder-r-2 ttext-center ">
                <span class="ttext-sm ttext-white">
                    <i class="fas fa-star" style="color: #ffa633;"></i>
                    <i class="fas fa-star" style="color: #ffa633;"></i>
                    <i class="fas fa-star" style="color: #ffa633;"></i>
                    <i class="fas fa-star" style="color: #ffa633;"></i>
                    <i class="fas fa-star" style="color: #ffa633;"></i>
                </span>
                <span class="ttext-md">
                    <span class="tfont-bold"> &nbsp; 4.8</span>
                    <span class="tfont-medium">Ratings</span>
                </span>
            </div>
            <div class="tw-1/2  ttext-center tfont-medium ">19,586 + Trusted Reviews</div>
        </div><!-- Ratings and reviews -->

        <div class="tborder-dashed tflex titems-center tjustify-center tmx-3 tmy-4 tpx-3 tpy-3" style="border: 2px solid #fe8686; border-style: dashed;">
            <span class="tfont-medium">Order Today for guaranteed </span>
            <span class="ttext-pink-500 tfont-medium tml-2"> FREE 4 Gifts</span>
        </div><!-- ORDER TODAY -->

        {{-- FORM --}}
        
        <form action="{{ route('miss_tisa_submit') }}" id="form" class="relative" method="post" enctype="multipart/form-data">
            <input type="hidden" id="purchase_value" value="{{ request()->amount }}">

            @csrf

            <div class="tmb-2 tp-2 trelative">
                <div class="tflex tflex-wrap">
                    <div class="tw-1/2 tp-1 trelative">
                        <label class="tblock tborder-2  tbg-yellow-100 tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                            <input type="checkbox" id="promo1" name="promo" class="promo" checked="" value="MissTisa_1pc|999|1pc">
                            <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">10 pcs Goree</span>
                            <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱999</span>
                        </label>
                        <div class="tabsolute" style="top: -6px; left: 23%;">
                            <div class="tbg-red-600 tfont-medium tpx-4 trounded ttext-sm ttext-white">
                                BEST SELLER
                            </div>
                        </div>
                    </div><!-- PROMO 4-->
                    <div class="tw-1/2 tp-1">
                        <label class="tblock tborder-2  tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                            <input type="checkbox" id="promo2" name="promo" class="promo"  value="MissTisa_1pc|799|1pc">
                            <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">8 pcs Goree</span>
                            <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱799</span>
                        </label>
                    </div><!-- PROMO 4-->
                    <div class="tw-1/2 tp-1">
                        <label class="tblock tborder-2  tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                            <input type="checkbox" id="promo3" name="promo" class="promo"  value="MissTisa_1pc|499|1pc">
                            <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">6 pcs Goree</span>
                            <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱499</span>
                        </label>
                    </div><!-- PROMO 4-->
                    <div class="tw-1/2 tp-1">
                        <label class="tblock tborder-2  tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                            <input type="checkbox" id="promo4" name="promo" class="promo"  value="MissTisa_1pc|399|1pc">
                            <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">4 pcs Goree</span>
                            <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱399</span>
                        </label>
                    </div><!-- PROMO 4-->
       
                </div>
            </div><!-- PROMO  -->
            
            <div class="tw-full tflex tmb-3 tpx-3">
                <div class="tw-1/2 tmr-1">
                    <label for="full_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Full Name</label>
                    <input required type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="browser-default input-control">
                </div>
                <div class="tw-1/2 tml-1 trelative">
                    @error('phone_number')
                        <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 1%;">{{ $message }}</span>
                    @enderror
                    <label for="phone_number" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Phone Number</label>
                    <input required type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="browser-default input-control">
                </div>
            </div><!--Fullname & Phone Number -->

            <div class="tw-full tflex tmb-3 tpx-3">
                <div class="tw-auto">
                    <label for="address" class=" ttext-sm tmb-2 ttext-black-100">
                        <span class="tfont-medium">Complete Address</span>
                        <small class="ttext-gray-600">(St./House No. | blk & lot/ Subdv / Barangay / City / Province)</small>
                    </label>
                    <input required type="text" name="address" id="address" value="{{ old('address') }}" class="browser-default input-control">
                </div>
            </div><!--Address -->

            @error('promo')
                <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 32%;">{{ $message }}</span>
            @enderror

            <div class="tmt-3 ttext-right tw-full">
                <span class="ttext-gray-900" style="font-size: 16px;">
                    <span class="tfont-medium">TOTAL:</span>
                    <span class="tfont-medium">₱</span>
                    <span id="total" class="tfont-medium t-ml-1">499</span>
                </span>
            </div>
            <div class="tw-full ">
                <button style="background-color: #ee2a7b" class="focus:tbg-pink-500 trelative tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="submit_btn">
                    <span>Checkout Order</span>
                </button>
                <span style="background-color: #ee2a7b" class="thidden focus:tbg-pink-500 trelative ttext-center tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="loader">
                    <img src="{{ asset('/loader/four_dots_loader.svg') }}" style="display: initial; position: absolute; top: -29%; right: 35px;">
                    <span class="tmr-5">Loading please wait</span>
                </span>
            </div><!-- Submit Order -->
        </form><!-- ORDER PROMO -->



        <img class="tmb-3" src="{{ asset('images\kasoy_oil\28_days_challenge.png') }}" alt="28_days_challenge">

       

        <video class="tw-full video-testimonial" controls playsinline webkit-playsinline>
            <source src="{{ asset('images/kasoy_oil/explainer_video.mp4') }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        </video>

        <img src="{{ asset('images/kasoy_oil/before_after.png') }}" class="tw-full tmy-5"  alt="before_after">

        <div class="tmx-auto trelative tp-5">
            <h3 class="tfont-medium tmb-5 ttext-2xl ttext-center">PRODUCT DETAILS</h3>

            <p style="font-size: 20px;" class="ttext-center tmb-4">
                <b><b>"</b>Revitalize Your Skin with Our Melasma Rejuvenating Set<b>"</b></b>
            </p><br>

            <h4 class="tfont-medium tmb-4 ttext-xl">BENEFITS:</h4>
            
            <img class="tmb-5" src="{{ asset('images\kasoy_oil\benefits.png') }}" alt="benefits">
     
            <img class="tmb-5" src="{{ asset('images\kasoy_oil\what_to_expect.png') }}" alt="What to expect">
            <!--WHAT TO EXPECT: -->
            
            <img class="" src="{{ asset('images\kasoy_oil\how_to_use_01.png') }}" alt="how_to_use in the morning">
            <img class="" src="{{ asset('images\kasoy_oil\how_to_use_02.png') }}" alt="how_to_use in the evening">

        </div><!-- PRODUCT DETAILS-->

        <div class="tmb-5 tborder-t" >
            <div class="tborder tpx-4 tpy-5">
                <h1 class="tmb-3 ttext-2xl">Product Ratings</h1>
                <div class="tflex titems-center tjustify-between tmb-3">
                    <p>
                        <span class="ttext-2xl tfont-semibold" style="color: #f51773">5.0</span>
                        <span class="ttext-xl tfont-medium" style="color: #f51773"> out of 5</span>
                    </p>
                    <div class="">
                        <i class="fa-solid fa-star" style="color: #f51773;"></i>
                        <i class="fa-solid fa-star" style="color: #f51773;"></i>
                        <i class="fa-solid fa-star" style="color: #f51773;"></i>
                        <i class="fa-solid fa-star" style="color: #f51773;"></i>
                        <i class="fa-solid fa-star" style="color: #f51773;"></i>
                    </div>
                </div>    
                <div class="tflex titems-center tjustify-between">

                    <div class="trounded ttext-sm tmr-1 ttext-center trelative" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773; background: #f51773; color: white;">
                        <p>5 <i class="fa-solid fa-star" style="color: white;"></i> (9.5k)</p>
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        4<i class="fa-solid fa-star" style="color: #f51773;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        3<i class="fa-solid fa-star" style="color: #f51773;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        2<i class="fa-solid fa-star" style="color: #f51773;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #f51773 1px solid; color: #f51773;">
                        1<i class="fa-solid fa-star" style="color: #f51773;"></i> (0)
                    </div>
                </div>
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review1/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Emerlita Manao</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">April 14, 2023 09:07AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Hala grabi. <b>Effective pala talaga ang MissTisa</b> totoo pala ung napnoud ko na video.
                        Kitang kita naman sa picture ko nag <b>fade talga ung melasma ko in 3 Weeks.</b> 
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 1 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review2/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Aiza Ling</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 14, 2023 12:48PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                       <b> Sobrang problemado talaga ako sa Melasma ko.</b> Maputi naman ung face ko
                       Kaya lalong naging Visible ung Melasma ko. Nakuha ko to sa panga-nganak
                       sa Pangalawa ko. Ang dami ko na din nasubukan ok naman <b> kaso mas na satisfy
                       lang talga ako dito sa MissTisa </b>lang ung may pinaka magandang Effect.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 2 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review3/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Ana Park</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Hi!. <b>I was so frustrated with my melasma.</b>  i'm a korean living here in philippines.
                        My Filipino husband bought me this product. <b>I tried many korean products</b>  but this is only 
                        The Rejuvenating set worked for me. this is my result after using for month </b>
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 3 -->
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review4/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Sharon Tee</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 25, 2023 04:22PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        The before and after of my face is proof that MissTisa Product is very Effective.
                        The Glass Skin Effect is superb, And my melasma is totally Gone.
                        I would definitely recommend this to my co mother who suffer also from melasma.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 4 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review5/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Liza Manalo</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 02, 2023 07:27AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>Wag kayo bibili nito! Kung ayaw nyo Mawala agad ang melasma nyo ng 1 week.</b> 
                        Mga sis Legit at Effective Talga sya lalo na kapag wala ka palya sa pag lagay.
                        1 Week kitang kita na result tulad ng pic ko dito oh.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 5 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="{{ asset('images/kasoy_oil/reviews/review6/profile.png') }}" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Rebecca Morales</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                                <i class="fa-solid fa-star" style="color: #f51773;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 16, 2023 01:29PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b> Dati Palagi nalang ako naka Mask.</b> Kasi Ang Dami kong Melasma. 
                        kaya Thankful ako kasi nakita ko itong MISSTISA isang Set palang
                        at <b>1 week Kitang kita na agad ang effect nya.</b>  at nag Glass SKin pa face ko.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/1.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/2.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/3.png') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/4.png') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 6 -->

            </div>  <!-- RATINGS DIV -->
        </div> <!-- RATINGS -->

        <h4 class="tfont-medium tpy-3 tmb-5 ttext-xl ttext-center">HAPPY & SATISFIED CUSTOMERS</h4>
       
        {{-- REVIEWS --}}

        <img class="" src="{{ asset('images\kasoy_oil\satisfied_customer1.png') }}" alt="fda">
        <img class="" src="{{ asset('images\kasoy_oil\satisfied_customer2.png') }}" alt="fda">

        <div class="tmx-auto trelative tborder tpx-5 tpb-5">
            <div class="tflex tjustify-center tflex-wrap tfont-medium titems-center ttext-center">
                <img src="{{ asset('images\icons\free-shipping.png') }}" class="tmy-3" style="height: ;" alt="">
                <span class="tmb-1">Nationwide Luzon, Visayas & Mindanao </span>
            </div>

            <section class="tflex titems-baseline tmt-5 tmb-3">
                <div class="ttext-center">
                    <i class="fa-solid fa-truck-fast ttext-5xl" style="color: #2d3748"></i>
                    <span class="tinline-block">Fast delivery nationwide</span>
                </div>
                <div class="ttext-center">
                    <i class="fa-solid fa-money-bill-transfer ttext-5xl" style="color: #2d3748"></i>
                    <span class="tinline-block">Moneyback Guarantee</span>
                </div>
                <div class="ttext-center">
                    <i class="fa-solid fa-hand-holding-dollar ttext-5xl" style="color: #2d3748"></i>
                    <span class="tinline-block">Cash on Delivery</span>
                </div>
                <div class="ttext-center">
                    <i class="fa-solid fa-headset ttext-5xl" style="color: #2d3748"></i>
                    <span class="tinline-block">Aftersales Support</span>
                </div>
            </section>
            


            <div id="modal1" class="modal">
                <div class="modal-content" style="padding-bottom: 0px;">
                    <h4 class="tfont-medium ttext-3xl">Thank you</h4>
                    <h5 class="tfont-medium tmb-3 tmt-4 ttext-xl">Your order was completed successfully.</h5>
                
                    <p>We want to assure you that we are working diligently to process and ship your order as quickly as possible.</p><br>
                    <p><span class="tfont-medium">Metro Manila:</span>  1-3 working days.</p>
                    <p><span class="tfont-medium">Visayas & Mindanao:</span> 4-7 days.</p>
                    <br>
                    <p>
                        We truly appreciate your business and look forward to serving you again in the future.
                    </p><br>
                    <p class="tfont-medium">We appreciate your business!</p>

                </div>
                <div class="modal-footer">
                    <a href="" class="modal-close waves-effect waves-green btn-flat">Close</a>
                </div>
            </div> <!-- Modal  -->

            <div id="checkout_page" class="thidden tabsolute tw-full th-full tbottom-0 tfixed tfont-medium tmt-4 ttext-white tw-10/12 tbg-white"
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0; z-index: 999;">
                
                <div class="shopee-bg-color t tflex titems-center tjustify-between tpx-4 tpy-4">
                    <i class="fa-arrow-left fa-solid ttext-3xl ttext-white tfont-light" aria-hidden="true"></i>
                    <span class="tfont-light ttext-3xl">Checkout</span>
                    <i class="fa-solid fa-cart-shopping ttext-2xl" aria-hidden="true"></i>
                </div>


                <div class="tborder-dashed tflex titems-center tjustify-center tmx-3 tmy-4 tpx-3 tpy-3 ttext-green-900" style="border: 2px solid #27ac9b; border-style: dashed;">
                    <span class="tfont-medium">Order Today for guaranteed </span>
                    <span class="tfont-medium tml-2" style="color: #ee4d2d;"> FREE 4 Gifts</span>
                </div>

                {{-- <div class="tpy-2 tpx-3 tflex tjustify-center" style="background-color: #27ac9b;">
                    <div class="tmr-5">
                        <h1 class="ttext-lg">FREE DELIVERY</h1>
                        <img src="{{ asset('/images/fbads/shping_time.png') }}" class="tml-5" alt="">
                    </div>
                    
                    <div class="tflex tjustify-between tflex-col tml-5">
                        <span class="tfont-normal">Luzon: <b>3 Days</b></span>
                        <span class="tfont-normal">Visayas: <b>4-5 Days</b> </span>
                        <span class="tfont-normal">Mindanao: <b>6-8 Days</b> </span>
                    </div>
                </div> --}}


                <div class="tmx-3 tflex titems-center tmy-5">
                    <div class="tw-1/2 tborder-gray-200 tborder-r-2 ttext-center ">
                        <span class="ttext-sm ttext-white">
                            <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                            <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                            <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                            <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                            <i class="fas fa-star" style="color: #ee4d2d;" aria-hidden="true"></i>
                        </span>
                        <span class="ttext-md ttext-green-900">
                            <span class="tfont-bold"> &nbsp; 4.8</span>
                            <span class="tfont-medium">Ratings</span>
                        </span>
                    </div>
                    <div class="tw-1/2 ttext-green-900 ttext-center tfont-medium ">19,586 + Trusted Reviews</div>
                </div>

             

                <hr class="tmx-5 tmy-5">


                {{-- <img src="{{ asset('images/fbads/free_shipping_dicount.png') }}" alt="free sf" width="100%"> --}}

                <form action="http://127.0.0.1:8000/MissTisa-Submit" id="form"  method="post" enctype="multipart/form-data">
                    <h1 class="ttext-gray-900 tmb-5 tmt-8 tml-3 ttext-lg">Shipping Details</h1>
                    <input type="hidden" id="purchase_value" value="">
        
                    <div class="tw-full tflex tmb-3 tpx-3">
                        <div class="tw-1/2 tmr-1">
                            <label for="full_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Full Name</label>
                            <input required="" type="text" name="full_name" id="full_name" value="" class="browser-default input-control">
                        </div>
                        <div class="tw-1/2 tml-1 trelative">
                                                <label for="phone_number" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Phone Number</label>
                            <input required="" type="text" name="phone_number" id="phone_number" value="" class="browser-default input-control">
                        </div>
                    </div><!--Fullname & Phone Number -->
        
                    <div class="tw-full tflex tmb-3 tpx-3">
                        <div class="tw-auto">
                            <label for="address" class="ttext-sm tmb-2 ttext-black-100">
                                <span class="tfont-medium">Complete Address</span>
                                <small class="ttext-gray-600">(St./House No. | blk &amp; lot/ Subdv / Barangay / City / Province)</small>
                            </label>
                            <input required="" type="text" name="address" id="address" value="" class="browser-default input-control">
                        </div>
                    </div><!--Address -->

                    <hr class="tmx-5 tmy-5">

                    <h1 class="ttext-gray-900 tmy-5 tml-3 ttext-lg">Promos</h1>

                    


                    <div class="tmb-2 tp-2 trelative">
                        <div class="tflex tflex-wrap">
                            <div class="tw-1/2 tp-1 trelative">
                                <label class="tblock tborder-2  tbg-yellow-100 tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                                    <input type="checkbox" id="promo1" name="promo" class="promo" checked="" value="MissTisa_1pc|999|1pc">
                                    <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">10 pcs Goree</span>
                                    <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱999</span>
                                </label>
                                <div class="tabsolute" style="top: -6px; left: 23%;">
                                    <div class="tbg-red-600 tfont-medium tpx-4 trounded ttext-sm ttext-white">
                                        BEST SELLER
                                    </div>
                                </div>
                            </div><!-- PROMO 4-->
                            <div class="tw-1/2 tp-1">
                                <label class="tblock tborder-2  tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                                    <input type="checkbox" id="promo2" name="promo" class="promo" value="MissTisa_1pc|799|1pc">
                                    <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">8 pcs Goree</span>
                                    <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱799</span>
                                </label>
                            </div><!-- PROMO 4-->
                            <div class="tw-1/2 tp-1">
                                <label class="tblock tborder-2  tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                                    <input type="checkbox" id="promo3" name="promo" class="promo" value="MissTisa_1pc|499|1pc">
                                    <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">6 pcs Goree</span>
                                    <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱499</span>
                                </label>
                            </div><!-- PROMO 4-->
                            <div class="tw-1/2 tp-1">
                                <label class="tblock tborder-2  tpx-3 tpy-2 trounded" style="border-color: #ee4d2d;">
                                    <input type="checkbox" id="promo4" name="promo" class="promo" value="MissTisa_1pc|399|1pc">
                                    <span class="ttext-gray-900 tfont-medium ttext-sm" style="top: 11px;">4 pcs Goree</span>
                                    <span class="tblock ttext-right ttext-gray-900 tfont-bold ttext-lg">₱399</span>
                                </label>
                            </div><!-- PROMO 4-->
               
                        </div>
                    </div>
        
                </form>

                <div class="tabsolute tbottom-0 tflex tw-full" style="-webkit-box-shadow: 0px -2px 15px -5px #000000; box-shadow: 0px -2px 15px -5px #000000;">
                    <div class="tw-3/5 tbg-white ttext-right tpr-2 tpy-3" style="color: #606060; background-color: white;">
                        <div class="t-mt-3 tpt-1">
                            <span class="" style="margin-top: 17%;">Total Payment</span>
                        </div>
                        <div class="t-mt-1 tfont-bold tfont-medium" style="color: #ee4d2d; font-size: 20px;">
                            ₱150
                        </div>
                    </div>
                    <button class="tfont-medium tpy-3 tw-2/5" style="background-color: #ee4d2d; font-size: 18px;">Buy Now!</button>
                </div>
            </div>

            <button class="order_now shopee-bg-color tabsolute tw-full  tbottom-0 tfixed tfont-medium tmt-4 tpy-5 ttext-lg ttext-white tw-10/12 waves-effect" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;">
                ORDER NOW!
            </button>
    </div>

    <footer>

        @if (request()->amount)
            <script>
                let fb_purchase_value = $('#purchase_value').val()? $('#purchase_value').val() : 0;
            </script>
        @endif

        <script>
             $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ONCLICKS
            $('#province').change(function () {
                $.post("/get-cities",{
                    province: $(this).val()
                },
                function(data, status){
                    let html = "<option value=''>Pick your city</option>"
                    $.each(JSON.parse(data), function(index, value) {
                        html += "<option value='"+value.city+"'>"+value.city+"</option>";
                    });
                    $('#city').html();
                    $('#barangay').html("<option value='Barangay'>Pick your barangay</option>");
                    $('#city').html(html);

                    $('#city').removeAttr("disabled");// Enable City
                });
            });

            $('#city').change(function () {
                $.post("/get-barangay",{
                    city: $(this).val()
                },
                function(data, status){
                    let html = "<option value=''>Pick your barangay</option>"
                    $.each(JSON.parse(data), function(index, value) {
                        html += "<option value='"+value.barangay+"'>"+value.barangay+"</option>";
                    });
                    $('#barangay').html(html);

                    $('#barangay').removeAttr("disabled");// Enable City
                });
            });
            
            $('#promo1').change(function () {
                $('#total').html($(this).val().split('|')[1]);
                $("#promo2").prop('checked', false);
                $("#promo3").prop('checked', false);
                $("#promo4").prop('checked', false);
            });

            $('#promo2').change(function () {
                $('#total').html($(this).val().split('|')[1]);
                $("#promo1").prop('checked', false);
                $("#promo3").prop('checked', false);
                $("#promo4").prop('checked', false);
            });

            $('#promo3').change(function () {
                $('#total').html($(this).val().split('|')[1]);
                $("#promo1").prop('checked', false);
                $("#promo2").prop('checked', false);
                $("#promo4").prop('checked', false);
            });

            $('#promo4').change(function () {
                $('#total').html($(this).val().split('|')[1]);
                $("#promo1").prop('checked', false);
                $("#promo2").prop('checked', false);
                $("#promo3").prop('checked', false);
            });

            var $window = $(window),x
                $document = $(document),
                button = $('.order_now');
                
            // $window.on('scroll', function () {
            //     let scrollH = $(window).height() + $(window).scrollTop();
            //     let H = ($document.height() - 550);

            //     if (scrollH > H) {
                    
            //         button.stop(true).css('z-index', 0).animate({
            //             opacity: 0
            //         }, 50);
            //     } else {
            //         button.stop(true).css('z-index', 999).animate({
            //             opacity: 1
            //         }, 50);
            //     }
            // });// hide show ORDER BUTTON on Scroll


            $('.shopee-bg-color ').click(function () {
                $('.order_now').removeClass('thidden');
                $('#checkout_page').addClass('thidden');

                $('html, body').css({
                    overflow: 'auto',
                    height: 'auto'
                });// ENEBLED SCROLL
            })

            $('.order_now').click(function (e) {

                window.history.replaceState(null, null, "?checkout");



                $('html, body').css({
                    overflow: 'hidden',
                    height: '100%'
                }); // disabled scroll

                $(this).addClass('thidden');
                $('#checkout_page').removeClass('thidden');

                // $('html, body').animate({
                //     scrollTop: $('#form').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
                // }, 'slow');

                $.post("/event-listener",{
                    order_form: 1
                });// EVENT LISTENER Track ORDER FORM

                ttq.track('AddPaymentInfo', {
                    "contents": [
                        {
                            "content_id": "1", 
                            "content_type": "product",
                            "content_name": "" 
                        }
                    ],
                    "description": "" 
                });// Tiktok Event
            });

            $('#full_name').click(function (e) {
                $.post("/event-listener",{
                    full_name: 1
                });// EVENT LISTENER Track ENTER FULL NAME
            });
            
            $('#phone_number').click(function (e) {
                $.post("/event-listener",{
                    phone_number: 1
                });// EVENT LISTENER Track ENTER CONTACT NUMBER
            });

            $('#address').click(function (e) {
                $.post("/event-listener",{
                    address: 1
                });// EVENT LISTENER Track ENTER CONTACT NUMBER
            });

            $('.promo').click(function (e) {
                $.post("/event-listener",{
                    promo: 1
                });// EVENT LISTENER Track ENTER CONTACT NUMBER
            });

            $('#submit_btn').click(function () {
                $.post("/event-listener",{
                    submit_order: 1
                });//  EVENT LISTENER Track SUBMIT ORDER
                
                let amount = $('#total').html();

                ttq.track('InitiateCheckout', {
                    "contents": [
                        {
                            "content_id": "1",
                            "content_type": "product",
                            "content_name": "",
                            "quantity": 1,
                            "price": amount
                        }
                    ],
                    "value": amount,
                    "currency": "PHP" 
                });//TIktok Event

            })

            $("#form").submit(function(event) {
                $('#submit_btn').addClass('thidden');
                $('#loader').removeClass('thidden');
            });

            $.post("/event-listener",{
                visitors: 1
            });//  EVENT LISTENER Track VIEW

        </script>
    </footer>

    @if(session()->has('success'))
    <script>
        $(document).ready(function(){
            $('.modal').modal();
            $('.modal').modal('open');
        });// OPEN THANK YOU MODAL

        $.post("/event-listener",{
            order_success: 1
        });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS
    </script>
    @endif

    @if(session()->get('errors'))
        <script>
            $('html, body').animate({
                scrollTop: $('#form').offset().top + 9999
            }, 'slow');// SCROLL BACK TO FORM AFTER Submit with error validation

            $.post("/event-listener",{
                form_validation_error: "{{ $errors->first() }}"
            });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS
        </script>
    @endif

</body>
</html>