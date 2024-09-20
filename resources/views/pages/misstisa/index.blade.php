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

    <div style="scroll-behavior: smooth;max-width: 480px;" class="tmx-auto" id="body">
        <div class="tflex tfont-medium titems-center tjustify-center trelative tshadow-md ttext-center" style="height: 76px; background: linear-gradient(180deg, rgb(250 25 158 / 53%) 0%, rgb(251 0 148) 100%);">
            <div >
                <div class="">
                    <p class="t-mt-2 tfont-medium  ttext-4xl ttext-white">Good Bye Melasma</p>
                </div>
                <div class="">
                    <span class="ttext-sm ttext-white">
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                        <i class="fas fa-star ttext-yellow-300"></i>
                    </span>
                    <span class="ttext-md ttext-white">
                        <span><u>9.5k</u> Ratings</span>
                        <span> | </span>
                        <span><u>23.6k</u> Sold</span>
                    </span>
                </div>
            </div>
            <button class="focus:tbg-pink-300 order_now tabsolute tbottom-0 tfixed tfont-medium tpy-2 trounded-full tshadow-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" style="bottom: -52%;max-width: 240px;width: 36%;right: 4%;color: #ffffff;background-color: #ee2a7b;">ORDER NOW!
            </button>
        </div>


        <img src="{{ asset('images/kasoy_oil/top_banner.png') }}" class="tw-full tmb-5" alt="top_banner">

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
            <div class="tw-1/2 ttext-green-900 ttext-center tfont-medium ">19,586 Trusted Reviews</div>
        </div><!-- Trusted Reviews -->

         <div class="tborder-dashed tflex titems-center tjustify-center tmx-3 tmy-4 tpx-3 tpy-3" style="border: 2px solid #ee2a7b; border-style: dashed;">
            <span class="tfont-medium">Order Today for guaranteed </span>
            <span class="theme-color tfont-medium tml-2"> FREE 4 Gifts</span>
        </div><!-- FREE 4 Gifts -->

        <div class="tflex tw-full tflex-wrap tjustify-center tpy-3 tpx-3 tmb-3">
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> Melasma Remover</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> Korean Glass Skin</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> No More Pekas</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> No More Dark Spots</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> Uneven Skin Tone</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> Deep Scars</div>
            <div class="tw-1/2"><i class="fa-solid fa-circle-check tmb-1" style="color: #fa5230;"></i> Whiteheads</div>
            <div class="tw-1/2  tmb-3"><i class="fa-solid fa-circle-check" style="color: #fa5230;"></i> Blackheads</div>

            <div class="tw-full"><i class="fa-solid fa-circle-check tmb-1" style="color: #12bc39;"></i> Good for Sensitive Skin</div>
            <div class="tw-full"><i class="fa-solid fa-circle-check tmb-1" style="color: #12bc39;"></i> No Irritation & Side Effects</div>
            <div class="tw-full tmt-3"><i class="fa-solid fa-circle-check tmb-1" style="color: #12bc39;"></i> Safe</div>
            <div class="tw-full"><i class="fa-solid fa-circle-check tmb-1" style="color: #12bc39;"></i> FDA Approved</div>
            <div class="tw-full"><i class="fa-solid fa-circle-check tmb-1" style="color: #12bc39;"></i> Proven & tested by many users</div>
        </div>



        <img src="{{ asset('images/kasoy_oil/before_after.png') }}" class="tw-full tmy-5"  alt="before_after">
        
        <img class="tmb-3" src="{{ asset('images\kasoy_oil\28_days_challenge.png') }}" alt="28_days_challenge">

        <video class="tw-full video-testimonial" controls playsinline webkit-playsinline>
            <source src="{{ asset('images/kasoy_oil/explainer_video.mp4') }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        </video>

        <h4 class="tfont-medium tpy-3 tmt-8 ttext-xl ttext-center">HAPPY & SATISFIED CUSTOMERS</h4>
       
        {{-- REVIEWS --}}

        <img class="" src="{{ asset('images\kasoy_oil\satisfied_customer1.png') }}" alt="satisfied_customer1">
        <img class="" src="{{ asset('images\kasoy_oil\satisfied_customer2.png') }}" alt="satisfied_customer2">


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
                            <p>Maricel Batang</p>
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
                            <p>Analiza Pareo</p>
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
                            <p>Sharon Temon</p>
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


        <h3 class="tfont-medium tmb-8 ttext-2xl ttext-center tmt-10">MissTisa FDA Certificates</h3>

        <img class="" src="{{ asset('images\kasoy_oil\fda_certificates.png') }}" alt="fda_certificates">

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
            
            <form action="{{ route('miss_tisa_submit') }}" id="form" class="relative" method="post" enctype="multipart/form-data">
                <input type="hidden" id="purchase_value" value="{{ request()->amount }}">
                <h3 class="tfont-medium tmb-4 tpt-5 ttext-center">ORDER FORM</h3>

                @csrf
                <div class="tw-full tflex tmb-3">
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
                <div class="tw-full tflex tmb-3">
                    <div class="tw-auto tmr-1">
                        <label for="address" class=" ttext-sm tmb-2 ttext-black-100">
                            <span class="tfont-medium">Complete Address</span>
                            <small class="ttext-gray-600">(St./House No. | blk & lot/ Subdv / Barangay / City / Province)</small>
                        </label>
                        <input required type="text" name="address" id="address" value="{{ old('address') }}" class="browser-default input-control">
                    </div>
                </div><!--Address -->

                {{-- <div class="tflex tmb-3">
                    <div class="tw-full">
                        <label for="province" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Province</label>
                        <select required name="province" id="province" class="browser-default input-control" style="font-size: 12px;">
                            <option value="">Province</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province }}">{{ $province }}</option>
                            @endforeach
                        </select>
                    </div><!--province -->
                </div><!--province -->
                <div class="tflex tmb-5">
                    <div class="tw-1/2">
                        <label for="city" class="tfont-medium ttext-sm tmb-2 ttext-black-100">City</label>
                        <select required name="city" id="city" disabled class="browser-default input-control" style="font-size: 12px;border-right: 0px;">
                            <option value="">City</option>
                        </select>
                    </div><!--city -->
                    <div class="tw-1/2">
                        <label for="barangay" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Barangay</label>
                        <select required name="barangay" disabled id="barangay" class="browser-default input-control" style=" font-size: 12px;border-left: none;">
                            <option value="">Barangay</option>
                        </select>
                    </div><!--barangay -->
                </div><!--province/city/barangay --> --}}

                <div class="tborder-2 tmb-2 tp-2 trelative" style="border-color: #ee2a7ba8">
                    <div class="tflex tflex-wrap tjustify-center">
                        <div class="tflex titems-center tw-full tjustify-center">
                            <label>
                                <input type="checkbox" id="promo4" name="promo" class="promo" checked="" value="MissTisa_1pc|499|1pc">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium ttext-sm">₱499</span>
                                    MissTisa Melasma Remover 1 Set
                                </span>
                            </label>
                        </div><!-- PROMO 4-->
                        <div class="tflex titems-center tw-full tjustify-center">
                            <label>
                                <input type="checkbox" id="promo3" name="promo" class="promo" value="MissTisa_2pcs|849|2pcs">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium ttext-sm">₱849</span>
                                    MissTisa Melasma Remover 2 Set
                                </span>
                            </label>
                        </div><!-- PROMO 3 -->
                    </div>
                   
                    @error('promo')
                        <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 32%;">{{ $message }}</span>
                    @enderror
                </div><!-- ORDER PROMO -->

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
{{-- 
            <p class="tmt-6 ttext-2xl ttext-center">Pweding ibalik ang bayad if hindi effective.</p>

            <img class="th-48 tmx-auto" src="{{ asset('images\icons\promises\money_back_guarantee.webp') }}" alt="money_back_guarantee"> --}}

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

            <button class="order_now tabsolute  tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-full ttext-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;background-color: #ee2a7b;">
                ORDER NOW!
            </button>
        </div>
    </div>

    <footer>
        
        <!----- Tiktok Pixel ViewContent ----->
        <script>

            ttq.track('ViewContent', {
                "contents": [
                    {
                        "content_id": "1",
                        "content_type": "product", 
                        "content_name": "Matilda's Beauty MissTisa Melasma Rejuvenating Skincare Set", 
                        "content_category": "Beauty Products",
                        "brand": "MissTisa"
                    }
                ]
            });

        </script>

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

              
                
            $window.on('scroll', function () {
                let scrollH = $(window).height() + $(window).scrollTop();
                let H = ($document.height() - 550);

                if (scrollH > H) {
                    
                    button.stop(true).css('z-index', 0).animate({
                        opacity: 0
                    }, 50);
                } else {
                    button.stop(true).css('z-index', 999).animate({
                        opacity: 1
                    }, 50);
                }
            });// hide show ORDER BUTTON on Scroll

            $('.order_now').click(function (e) {
                $('html, body').animate({
                    scrollTop: $('#form').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
                }, 'slow');

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