<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasoy Oil | Great Life</title>
    {{-- STYLE SHEETS --}}
    {{-- <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"> --}}
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
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
    <script src="{{ asset('js/main.js') }}"  crossorigin="anonymous"></script>
    <script src="{{ asset('js/materialize.min.js') }}"  crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/8d4a8c4bc9.js" crossorigin="anonymous"></script>

    <!-- Facebook Pixel Code -->
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '1393765810823713');
        fbq('track', 'ViewContent');

    </script>
    <noscript>
        <img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=1614979632011184&ev=PageView&noscript=1"/>
    </noscript>
    <!-- End Facebook Pixel Code -->

</head>
<body>

    <div style="scroll-behavior: smooth;max-width: 480px;" class="tmx-auto" id="body">
        <div class="tflex tfont-medium titems-center tjustify-between trelative tshadow-md ttext-center" style="height: 76px; background: linear-gradient(180deg, rgba(255, 106, 0, 1) 0%, rgba(238, 9, 9, 1) 100%)">
            <div style="margin-left: 4%;">
                <s class="ttext-sm ttext-white">Orig Price ₱1,000</s>
                <p class="t-mt-2 tfont-medium tshadow-2xl ttext-4xl ttext-white"><u>Promo ₱399</u></p>
            </div>
            <button class="focus:tbg-red-500 order_now tabsolute tbg-white tbottom-0 tfixed tfont-black tpy-2 trounded-full tw-10/12 waves-effect zoom-in-out-box" style="bottom: 18%;max-width: 240px;width: 34%;right: 4%;color: #f63604;">ORDER NOW!
            </button>
        </div>

        <img src="{{ asset('images/kasoy_oil/benefits.webp') }}" class="tw-full tmt-2 tmb-5" alt="kasoy_oil_promo">

        <div class="tmt-8 tmb-5" >
            <div class="tborder tpx-4 tpy-5">
                <h1 class="tmb-3 ttext-2xl">Product Ratings</h1>
                <div class="tflex titems-center tjustify-between tmb-3">
                    <p>
                        <span class="ttext-2xl tfont-semibold" style="color: #ee4d2d">5.0</span>
                        <span class="ttext-xl tfont-medium" style="color: #ee4d2d"> out of 5</span>
                    </p>
                    <div class="">
                        <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                        <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                        <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                        <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                        <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                    </div>
                </div>    
                <div class="tflex titems-center tjustify-between">

                    <div class="trounded ttext-sm tmr-1 ttext-center trelative" style="padding: 5px 5px; border: #ee4d2d 1px solid; color: #ee4d2d; background: #ee4d2d; color: white;">
                        <p>5 <i class="fa-solid fa-star" style="color: white;"></i> (9.5k)</p>
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #ee4d2d 1px solid; color: #ee4d2d;">
                        4<i class="fa-solid fa-star" style="color: #ee4d2d;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #ee4d2d 1px solid; color: #ee4d2d;">
                        3<i class="fa-solid fa-star" style="color: #ee4d2d;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #ee4d2d 1px solid; color: #ee4d2d;">
                        2<i class="fa-solid fa-star" style="color: #ee4d2d;"></i> (0)
                    </div>
                    <div class="trounded ttext-sm tmr-1 ttext-center" style="padding: 5px 5px; border: #ee4d2d 1px solid; color: #ee4d2d;">
                        1<i class="fa-solid fa-star" style="color: #ee4d2d;"></i> (0)
                    </div>
                </div>
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="https://down-ph.img.susercontent.com/file/718815ca359b01a19d455b41782dc93a_tn" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Sunshine Sauqillo</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">April 14, 2023 09:07AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Grabe effective nya, nakakatanggal talaga sya ng nunal. At first nag w-worry ako baka kasi di matanggal at mag stay lang sya,
                        <b>pero after ilang days and pag tumigas na dun mo na sya pwede i-peel off.</b> For now gumagamit ako ng cebo de macho para mawala ang scar
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/1.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/2.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/3.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review1/4.webp') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 1 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="https://down-ph.img.susercontent.com/file/c245932fb8207140fb36221c278834dd_tn" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Aiza Melina</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 14, 2023 12:48PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        I received correct and complete order Ang bilis ng Shipping. <b>Wala pang 1 week natangal na agad ung warts ko sa paa.</b>
                        Grabe Highly recommended itong product na to. Kudos kay seller
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/1.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/2.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/3.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review2/4.webp') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 2 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="https://down-ph.img.susercontent.com/file/6c5ce453d8cc6b1d60ce389b24a595f4_tn" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Cynthia Sariolacasia</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 01, 2023 08:03PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Matagal ko na Problem ang warts ko sa kamay Nakaka Irita kasi lalo kapag mag luluto ako
                        Ang dami ko na din na subukan na ibang product pero
                        <b>Ito lang talaga ang nag work sakin. Lessthan 1 week lang Tangal na warts ko</b>
                        Ang bait pa ng Seller.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/1.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/2.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/3.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review3/4.webp') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 3 -->
                
                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="https://down-ph.img.susercontent.com/file/b0f1e1ab8148360fcdaeae8e692ea7f1_tn" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Melanie Paz</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 25, 2023 04:22PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        <b>Picture nalang mag explain ng effect</b> Super Thankful ako sa Friend ko na nag recommend sakin nito
                        Mas malaki kasi Nunal nya kesa sakin sa Nuo pa hahaha pero
                        Ang Galing ng product na to FDA Approved <b>4days kusa nalang bumagsak ung warts ko sa gilid ng ilong</b>
                        Natuyo nalang bigya ung warts ko
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/1.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/2.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/3.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review4/4.webp') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 4 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="https://down-ph.img.susercontent.com/file/39dc0c6845820a47f9053fae10036078_tn" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Emilita Rorasio</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">July 02, 2023 07:27AM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Nag try lang naman ako bumili. Nag babaka sakali lang na mag effect
                        <b>Nakaka inis kasi kapag kiniKISS ako ng asawa ko sa leeg May warts hahaha.</b>
                        Buti nalang Nag try ako EFFECTIVE Talaga sya. Ngayon smooth na ang hali ng asawa ko sa leeg ko 
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/1.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/2.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/3.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review5/4.webp') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 5 -->

                <div class="tmt-5 tpb-5">
                    <div class="tflex titems-center">
                        <img src="https://down-ph.img.susercontent.com/file/fc787aa4a2cde90abf3b7e70edb239a8_tn" class="trounded-full" style="width: 40px;" alt="">
                        <div class="tml-2">
                            <p>Robert Atienza</p>
                            <div class="">
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                                <i class="fa-solid fa-star" style="color: #ee4d2d;"></i>
                            </div>
                            <span style="margin-top: 0.25rem;margin-bottom: 0.9375rem;font-size: .75rem;color: rgba(0,0,0,.54);">June 16, 2023 01:29PM</span>
                        </div>
                    </div>
                    <div class="tpy-2" >
                        Hindi naman ako masyado concious sa Warts ko. Pero ung asawa ko kasi nag pupumilit Kaya nag order na ako.
                        Madami na kasi ako na try dati pero hindi nag effect. Dito sa Product nato
                        <b> wala pang 4 Days na tuyo na agad ung warts ko sa batok</b>
                        Ang Bilis pa ng shipping.
                    </div>
                    <div class="tflex" style="">
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/1.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/2.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/3.webp') }}" class="tmr-1 trounded">
                        </div>
                        <div class="tmr-2">
                            <img src="{{ asset('images/kasoy_oil/reviews/review6/4.webp') }}" class="tmr-1 trounded">
                        </div>
                    </div>
                </div><!-- REVIEW 6 -->

            </div>  <!-- RATINGS DIV -->
        </div> <!-- RATINGS -->

        <div class="tp-5 tmb-5 gredient-border">
            <h4 class="tfont-medium tmb-4 ttext-xl ttext-center">BEFORE AND AFTER</h4>
            <img src="{{ asset('images/kasoy_oil/before_after.webp') }}" class="tw-full"  alt="kasoy_oil_promo">
        </div>

        <video class="tw-full" controls playsinline webkit-playsinline autoplay muted loop>
            <source src="{{ asset('images/kasoy_oil/testimonial_vid.mp4') }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        </video>

        <div class="tmx-auto trelative tp-5">
            <h3 class="tfont-medium tmb-5 ttext-2xl ttext-center">PRODUCT DETAILS</h3>

            <p style="font-size: 20px;" class="ttext-center tmb-4">
                The ultimate solution for your skin concerns.
            </p><br>

            <h4 class="tfont-medium tmb-4 ttext-xl">CURE SKIN PROBLEM SUCH AS:</h4>
            
            <ul class="tpx-5 tml-8">
                <li class="ttext-xl">All Types of Warts</li>
                <li class="ttext-xl">Skin Tags</li>
                <li class="ttext-xl">Moles</li>
                <li class="ttext-xl">Kulugo</li>
                <li class="ttext-xl">Kalyo</li>
                <li class="ttext-xl">Nunal</li>
                <li class="ttext-xl">Buni</li>
                <li class="ttext-xl">Syringoma</li>
            </ul><br><!-- CURE SKIN PROBLEM SUCH AS: -->
            

            <h4 class="tfont-medium tmb-4 ttext-xl">INGREDIENTS:</h4>
            
            <ul class="tpx-5 tml-8">
                <li class="ttext-xl">Pure Kasoy Oil</li>
                <li class="ttext-xl">Garlic Extract</li>
                <li class="ttext-xl">Pineapple Extract</li>
                <li class="ttext-xl">Aloe Vera</li>
            </ul><br><!--INGREDIENTS: -->
            
 
            <h4 class="tfont-medium tmb-4 ttext-xl">WHAT TO EXPECT:</h4>
            
            <ul class="tpx-5 tml-8">
                <li class="ttext-xl">You will feel a burning effect that is not too painful</li>
                <li class="ttext-xl">You will feel that it is taking effect</li>
                <li class="ttext-xl">in 3 to 7 days you will see results up to the final result</li>
            </ul><br><!--WHAT TO EXPECT: -->
            
            
            <h4 class="tfont-medium tmb-4 ttext-xl">HOW TO USE:</h4>
            
            <ul class="tpx-5 tml-8">
                <li class="ttext-xl">Use the dropper to place 3 to 4 drops of the oil to your skin insecurities</li>
                <li class="ttext-xl">Let the oil sit on the skin for 10 to 15 minutes</li>
                <li class="ttext-xl">Repeat 2x a day</li>
            </ul><br><!--HOW TO USE: -->
            
            <p style="font-size: 20px;" class="ttext-center">
                Experience the confidence of flawless skin with Kasoy Oil Warts Remover. 
            </p>
        </div>

        <h4 class="tfont-medium tpy-3 tmb-5 ttext-xl ttext-center">WATCH OUR CUSTOMER VIDEO  FEEDBACK</h4>
       
        <video class="tw-full" controls playsinline webkit-playsinline autoplay muted loop>
            <source src="{{ asset('images/kasoy_oil/testimonial_vid3.mp4') }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        </video>
        <video class="tw-full" controls playsinline webkit-playsinline autoplay muted loop>
            <source src="{{ asset('images/kasoy_oil/testimonial_vid2.mp4') }}" type="video/mp4">
            <source src="movie.ogg" type="video/ogg">
        </video>

        <img src="{{ asset('images/kasoy_oil/doc_willie.webp') }}" class="tw-full tmy-5" alt="doc_willie">
        {{-- <img src="{{ asset('images/kasoy_oil/testimonial1.png') }}" class="tw-full" alt="kasoy_oil_promo">
        <img src="{{ asset('images/kasoy_oil/testimonial2.png') }}" class="tw-full" alt="kasoy_oil_promo">
        <img src="{{ asset('images/kasoy_oil/testimonial3.png') }}" class="tw-full" alt="kasoy_oil_promo">
        <img src="{{ asset('images/kasoy_oil/testimonial4.png') }}" class="tw-full" alt="kasoy_oil_promo"> --}}

        {{-- <img src="{{ asset('images/kasoy_oil/kasoy_oil_promo.png') }}" class="tw-full" alt="kasoy_oil_promo"> --}}

        {{-- REVIEWS --}}

            <img class="" src="{{ asset('images\icons\promises\fda.webp') }}" alt="fda">

            <div class="tmx-auto trelative tborder tpx-5 tpb-5">

            <section class="tflex titems-baseline tmt-5">
                <div class="ttext-center">
                    <img class="tmx-auto" src="{{ asset('/images/icons/promises/fast_delivery.webp') }}" alt="fast_delivery">
                    <span>Fast delivery nationwide</span>
                </div>
                <div class="ttext-center">
                    <img class="tmx-auto" src="{{ asset('/images/icons/promises/money_back.webp') }}" alt="cash_on_delivery">
                    <span>Moneyback Guarantee</span>
                </div>
                <div class="ttext-center">
                    <img class="tmx-auto" src="{{ asset('/images/icons/promises/cash_on_delivery.webp') }}" alt="cash_on_delivery">
                    <span>Cash on Delivery</span>
                </div>
                <div class="ttext-center">
                    <img class="tmx-auto" src="{{ asset('/images/icons/promises/customer_service.webp') }}" alt="customer_service">
                    <span>Aftersales Support</span>
                </div>
            </section>
            <form action="{{ route('kasoy_oil_store') }}" id="form" class="relative" method="post" enctype="multipart/form-data">
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

                <div class="tborder tmb-2 tp-2 trelative">
                    <div class="tflex tflex-wrap tjustify-center">
                        <div class="tflex titems-center tw-1/2">
                            <label>
                                <input type="checkbox" id="promo4" name="promo" class="promo" checked="" value="2pcs_kasoy_oil|399">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium">₱399</span>
                                    Buy 1 Take 1 Kasoy Oil 
                                </span>
                            </label>
                        </div><!-- PROMO 4-->
                        <div class="tflex titems-center tw-1/2">
                            <label>
                                <input type="checkbox" id="promo3" name="promo" class="promo" value="5pcs_kasoy_oil|749">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium">₱749</span>
                                    5pcs Kasoy Oil
                                </span>
                            </label>
                        </div><!-- PROMO 3 -->
                        <div class="tflex titems-center tw-1/2">
                            <label>
                                <input type="checkbox" id="promo2" name="promo" class="promo" value="7pcs_kasoy_oil|1099">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium">₱1099</span>
                                    7pcs Kasoy Oil
                                </span>
                            </label>
                        </div><!-- PROMO 2-->
                        <div class="tflex titems-center tw-1/2">
                            <label>
                                <input type="checkbox" id="promo1" name="promo" class="promo" value="10pc_kasoy_oil|1399">
                                <span class="ttext-gray-900" style="font-size: 13px;">
                                    <span class="tfont-medium">₱1399</span>
                                    10 pcs Kasoy Oil
                                </span>
                            </label>
                        </div><!-- PROMO 1 -->
                    </div>
                   
                    @error('promo')
                        <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 32%;">{{ $message }}</span>
                    @enderror
                </div><!-- ORDER PROMO -->
             
                <img src="{{ asset('loader/four_dots_loader.svg') }}" id="loader" style="bottom: 83%;left: 38%;" class="tabsolute thidden" alt="four_dots_loader">

                <div class="tmt-3 ttext-right tw-full">
                    <span class="ttext-gray-900" style="font-size: 16px;">
                        <span class="tfont-medium">TOTAL:</span>
                        <span class="tfont-medium">₱</span>
                        <span id="total" class="tfont-medium t-ml-1">399</span>
                    </span>
                </div>
                <div class="tw-full ">
                    <button class="focus:tbg-red-500 tbg-red-500 tshadow tfont-medium tmt-4 tpy-3 trounded-full ttext-2xl ttext-white tw-full waves-effect z-depth-5" id="submit_btn">Checkout Order</button>
                </div><!-- Submit Order -->
            </form><!-- ORDER PROMO -->

            <p class="tmt-6 ttext-2xl ttext-center">Pweding ibalik ang bayad if hindi effective.</p>

            <img class="th-48 tmx-auto" src="{{ asset('images\icons\promises\money_back_guarantee.webp') }}" alt="money_back_guarantee">

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

            <button class="order_now focus:tbg-red-500 tabsolute tbg-red-500 tbottom-0 tfixed tfont-medium tmb-5 tmt-4 tpy-3 trounded-full ttext-lg ttext-white tw-10/12 waves-effect zoom-in-out-box" 
                style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0;">
                ORDER NOW!
            </button>
        </div>
    </div>

    <footer>
        @if (request()->amount)
            <script>
                let fb_purchase_value = $('#purchase_value').val()? $('#purchase_value').val() : 0;
                fbq('track', 'Purchase', {currency: "PHP", value: fb_purchase_value});
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
                $('#loader').removeClass('thidden');// Show Loader

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
                    $('#loader').addClass('thidden');// Hide Loader
                });
            });

            $('#city').change(function () {
                $('#loader').removeClass('thidden');// Show Loader

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
                    $('#loader').addClass('thidden');// Hide Loader
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
            })

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