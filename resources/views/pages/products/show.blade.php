@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/animate.css') }}">
    <style>
        h2#swal2-title {
            font-size: 22px;
        }
        .owl-nav{
            display: none!important;
        }
        .owl-dots{
            display: none!important;
        }

        ol, ul {
            list-style: inside;
            margin: 0;
            padding: 0;
        }

        
    </style>
@endsection

@section('content')
    <div class="tmx-0 tpx-0 md:tmx-10 md:tpx-8 sm:tpt-16 sm:tpb-8 md:tpy-8">
        <div class="tflex tflex-wrap tw-full">
            <div class="tw-full sm:tw-2/5 tshadow tpb-3 tbg-white">
                <div class="owl-main owl-carousel owl-theme">
                    <div class="item"  data-hash="1">
                        <div class="md:flex-shrink-0">
                            <img class="rounded-lg md:w-56" src="{{$product['primary_image']}}" alt="shopickers.com {{ ($product['title']) }}">
                        </div>
                    </div>
                    
                    @foreach ($product['images'] as $item)
                        @if ($item['primary'])
                            @continue
                        @endif
                        <div class="item"  data-hash="{{ $item['id'] }}">
                            <div class="md:flex-shrink-0">
                                <img class="rounded-lg md:w-56" src="{{$item['img']}}" alt="shopickers.com {{ ($product['title']) }}">
                            </div>
                        </div>
                    @endforeach
                </div><!-- MAIN IMAGE -->
                <div class="owl-small owl-carousel owl-theme tmt-3">
                    <a class="item" href="#1" data-hash="1">
                        <div style="
                            width: 100%;
                            height: 50px;
                            background-image: url('{{$product['primary_image']}}');
                            background-repeat: no-repeat;
                            background-size: contain;
                            background-position: center;
                        "></div>
                    </a>
                    @foreach ($product['images'] as $item)
                        @if ($item['primary'])
                            @continue
                        @endif
                        <a class="item" href="#{{ $item['id'] }}" data-hash="{{ $item['id'] }}">
                            <div style="
                                width: 100%;
                                height: 50px;
                                background-image: url('{{$item['img']}}');
                                background-repeat: no-repeat;
                                background-size: contain;
                                background-position: center;
                            "></div>
                        </a>
                    @endforeach
                </div><!-- SMALL IMAGE -->
                {{-- <ul class="thidden md:tflex tmt-8">
                    <li class="tmr-4">
                        <a href="#"><i class="fab fa-facebook fa-3x ttext-blue-600"></i></a>
                    </li>
                    <li class="tmr-4">
                        <a href="#"><i class="fab fa-google-plus-square fa-3x ttext-red-600"></i></a>
                    </li>
                    <li class="tmr-4">
                        <a href="#"><i class="fab fa-twitter-square fa-3x ttext-blue-500"></i></a>
                    </li>
                    <li class="">
                        <a href="#"><i class="fab fa-instagram fa-3x ttext-pink-500"></i></a>
                    </li>
                </ul><!-- SOCIAL MEDIA ICONS --> --}}
            </div><!-- IMAGES -->
            <div class="tw-full sm:tw-3/5">
                <div class="sm:tpx-5 md:tml-8 tbg-white th-full tshadow">
                    <h2 class="tpt-4 sm:tpt-4 tpx-4 sm:tpx-0 tfont-medium tleading-tight ttext-gray-800 ttext-xl">{{ $product['title'] }}</h2>
                    <div class="tpx-4 sm:tpx-0 tflex tjustify-end tpy-3 ttext-md">
                        <div class="tmr-5 ttext-primary">
                            <i class="fas fa-star"></i>
                            <span class="tunderline">4.8</span>
                        </div>
                        <div class="tborder-gray-400 tborder-l  tpx-5">182 Ratings</div>
                        <div class="tborder-gray-400 tborder-l  tpl-5">336 Sold</div>
                    </div><!-- RATINGS -->
                    <div class="tpx-4 sm:tpx-0 tleading-relaxed tmt-1">
                        {!! nl2br($product['short_description']) !!}
                    </div><!-- SHORT DESCRIPTION -->
                    <div class="tpx-4 sm:tpx-0  tborder-b  tmt-2 tpb-5">
                        <div class="tflex titems-center tjustify-center sm:tjustify-start sm:titems-start sm:tflex-col tmt-4">
                            <span class="tfont-extrabold ttext-2xl ttext-primary tmr-4" style="font-family: arial;" id="price" data-price="{{ $product['price'] }}"><span class="ttext-base tfont-normal tmr-1">{{ currency() }}</span>{{ $product['price'] }}</span>
                            @if ($product['compare_price'] != '')
                                <div class="">
                                    <span class="tline-through ttext-gray-500"><span class="ttext-base tfont-normal tmr-1">{{ currency() }}</span>{{ $product['compare_price'] }}</span>
                                    <span class="tbg-primary tfont-medium tpx-2 ttext-white">-{{ percentage_discount($product['compare_price'], $product['price']) }}% OFF</span>
                                </div>
                            @endif
                        </div>
                    </div><!-- PRICE -->
                    <div class="sm:tpb-0 sm:tpx-0 tpb-5 tpx-4">
                        <p class="ttext-center sm:ttext-left tmb-3 tpt-3">Availability: In stock </p>
                        <div class="tflex tflex-col sm:tflex-row titems-center tjustify-center sm:tjustify-start">
                            {!! number_spinner_markup() !!}
                            <div class="ttext-sm ttext-gray-500 tml-4 tmt-2 sm:mt-0">{{ quantity($product['qty']) }}</div>
                        </div>
                    </div>
                    <div class="tpy-5 sm:tpy-8 thidden sm:tflex titems-center tjustify-around sm:tjustify-between">
                        <div class="thidden sm:tflex ">
                            <div class="tborder tpx-5 tpy-3 trounded tmr-4">
                                <a href="{{url()->current()}}" target="_blank" onclick="fb_share()" class="d-flex flex-column text-light mx-2" style="color: red!important;">
                                    <i class="fas fa-share-alt ttext-primary"></i>
                                </a>
                            </div><!-- SHARE BUTTON -->

                            @auth
                                <div class="tborder tcursor-pointer tpx-5 tpy-3 trounded waves-effect waves-green" id="add_to_wishlist" product_id="{{ $product['id'] }}">
                                    <i class="fas fa-heart ttext-primary"></i>
                                </div>
                            @else
                                <a href="{{ route('login') }}" class="tborder tcursor-pointer tpx-5 tpy-3 trounded waves-effect waves-green">
                                    <i class="fas fa-heart ttext-primary"></i>
                                </a>
                            @endauth

                        </div>
                        <a data-id="{{ $product['id'] }}" class="add_to_cart sm:tblock focus:tbg-primary tbg-blue-100 tborder tborder-primary tpy-3 trounded-b trounded-t ttext-primary ttext-center tw-1/3 waves-effect waves-light">Add To Cart</a>
                        <a data-id="{{ $product['id'] }}" class="checkout tborder tborder-primary focus:tbg-primary hover:tbg-primary tbg-primary tpy-3 trounded-b trounded-t ttext-center ttext-white tw-1/3 waves-effect waves-light">Buy Now</a>

                    </div>
                </div>    
            </div><!-- DETAILS -->
        
        </div>
        <div class="tflex tflex-col tmt-5 sm:tmt-8 tshadow">
            <div class="tw-full tbg-white">
                <ul class="tabs">
                    {{-- <li class="tab col s3 tfont-medium"><a href="#description">OVERVIEW</a></li>
                    <li class="tab col s3 tfont-medium"><a href="#ratingsAndReviews">CUSTOMER REVIEWS</a></li> --}}
                    <li class="tab col s3 tfont-medium"><a href="#specifications" class="active">Descriptions</a></li>
                </ul>
            </div><!-- TABS -->
            {{-- <div id="description" class="tbg-white tw-full tpy-5 tpx-4">
                <div class="tflex tflex-wrap">
                    <img src="http://ae01.alicdn.com/kf/HTB1Sv0NaRr0gK0jSZFnq6zRRXXaM.jpg" alt="asd">
                    <img src="http://ae01.alicdn.com/kf/HTB1Sv0NaRr0gK0jSZFnq6zRRXXaM.jpg" alt="asd">
                    <img src="http://ae01.alicdn.com/kf/HTB1Sv0NaRr0gK0jSZFnq6zRRXXaM.jpg" alt="asd">
                    <img src="http://ae01.alicdn.com/kf/HTB1Sv0NaRr0gK0jSZFnq6zRRXXaM.jpg" alt="asd">
                </div>
            </div><!-- OVERVIEW -->
            <div id="ratingsAndReviews" class="tbg-white tw-full tpy-5 tpx-4">
                <div class="tfont-medium tmb-3">CUSTOMER REVIEWS (204)</div>
                <div class="tflex">
                    <div class="tw-2/5">
                        <div class="tflex titems-center tmb-3">
                            <div class="ttext-sm tw-16 tmr-5">5 Stars</div>
                            <div class="progress tm-0">
                                <div class="determinate" style="width: 70%;"></div>
                            </div>
                            <div class="tborder tml-5 trounded ttext-black ttext-center ttext-sm tw-1/5 tw-16 tborder-gray-500">87%</div>
                        </div>
                        <div class="tflex titems-center tmb-3">
                            <div class="ttext-sm tw-16 tmr-5">4 Stars</div>
                            <div class="progress tm-0 tbg-blue-300">
                                <div class="determinate" style="width: 9%; background-color: #4299e1;"></div>
                            </div>
                            <div class="tborder tml-5 trounded ttext-black ttext-center ttext-sm tw-1/5 tw-16 tborder-gray-500">9%</div>
                        </div>
                        <div class="tflex titems-center tmb-3">
                            <div class="ttext-sm tw-16 tmr-5">3 Stars</div>
                            <div class="progress tm-0 tbg-blue-300">
                                <div class="determinate" style="width: 2%; background-color: #4299e1;"></div>
                            </div>
                            <div class="tborder tml-5 trounded ttext-black ttext-center ttext-sm tw-1/5 tw-16 tborder-gray-500">2%</div>
                        </div>
                        <div class="tflex titems-center tmb-3">
                            <div class="ttext-sm tw-16 tmr-5">2 Stars</div>
                            <div class="progress tm-0 tbg-blue-300">
                                <div class="determinate" style="width: 1%; background-color: #4299e1;"></div>
                            </div>
                            <div class="tborder tml-5 trounded ttext-black ttext-center ttext-sm tw-1/5 tw-16 tborder-gray-500">1%</div>
                        </div>
                        <div class="tflex titems-center tmb-3">
                            <div class="ttext-sm tw-16 tmr-5">1 Stars</div>
                            <div class="progress tm-0 tbg-blue-300">
                                <div class="determinate" style="width: 1%; background-color: #4299e1;"></div>
                            </div>
                            <div class="tborder tml-5 trounded ttext-black ttext-center ttext-sm tw-1/5 tw-16 tborder-gray-500">1%</div>
                        </div>
                    </div>
                    <div class="tw-3/5 tflex  tjustify-center">
                        <div class="tflex titems-center">
                            <div class="ttext-primary"><b class="ttext-5xl">4.8</b> <small class="tmr-4"> / 5</small></div>
                            <div class="">
                                <i class="fas fa-star ttext-primary"></i>
                                <i class="fas fa-star ttext-primary"></i>
                                <i class="fas fa-star ttext-primary"></i>
                                <i class="fas fa-star ttext-primary"></i>
                                <i class="fas fa-star ttext-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ([1,2,3] as $item)
                    <div class="tflex">
                        <div class="tw-full tflex tborder-b tpy-4">
                            <div class="tw-1/12">
                                <img src="https://cf.shopee.ph/file/72c47a2917ec8014f7b8018a6c96bb28_tn" class="trounded-full" width="60px" alt="">
                            </div>
                            <div class="tw-11/12">
                                <div class="tflex tjustify-between">
                                    <div class="tw-3/5 tflex tflex-col">
                                        <div class="ttext-sm">rklamata</div>
                                        <div class=""><small><b>4.5</b></small><i class="fas fa-star ttext-primary tml-1"></i></div>
                                        <div class="ttext-md ttext-gray-400">Variation: Grey - US:9</div>
                                    </div>
                                    <div class="tw-2/5 tflex tjustify-end titems-center">
                                        <div class="ttext-sm ttext-center tmr-2 ttext-gray-900">Helpful?</div>
                                        <button class="tborder tborder-gray-500 tmr-2 tpx-3 tpy-1 ttext-gray-900 trounded ttext-sm waves tmr-2">Yes (0)</button>
                                        <button class="tborder tborder-gray-500 tmr-2 tpx-3 tpy-1 ttext-gray-900 trounded ttext-sm waves">No (0)</button>
                                    </div>
                                </div>
                                <div class="tmt-3">
                                    maganda ang quality, magaan lang sa paa, mabilis ang delivery, medyo malaki nga lang sakin kasi wala ng yung size ko, pero pwede na din... order ulit ako, pero sana next time meron ng stocks, hindi puro cancel., thanks seller! 😇
                                </div>
                            </div>
                        </div>
                    </div><!-- CUSTOMER REVIEWS PREVIEW-->
                @endforeach
            </div><!-- RATINGS & REVIEWS --> --}}
            <div class="sm:tpb-5 sm:tpx-4 tbg-white tpb-12 tw-full">
                <style>
                    /*TABLE */
                    td, th {
                        padding: 0px 0px 0px 10px;
                        display: table-cell;
                        text-align: left;
                        vertical-align: middle;
                    }
                    table, th, td {
                        border-style: double;
                    }
                </style>
                <div class="tcontainer toverflow-x-auto tpy-5">
                    {!! $product['description'] !!}
                </div>
            </div><!-- SPECIFICATIONS -->
        </div><!-- TABS -->
    </div>

    <!-- FIXED BOTTOM NAVIGATION ON MOBILE DEVICES -->
    <div class="sm:thidden tbg-white tblock tbottom-0 tfixed tflex titems-center tw-full tz-40">
        <button data-id="{{ $product['id'] }}" class="add_to_cart focus:tbg-primary focus:ttext-white tw-1/2 tcursor-pointer tpy-4 ttext-center ttext-primary waves-effect waves-light fa-cart-plus fas" style="font-size: 21px;">
            {{-- <i class="" ></i> --}}
        </button>
        {{-- <span data-id="{{ $product['id'] }}" class="add_to_cart tw-1/2 fa-cart-plus fas tcursor-pointer tpy-4 ttext-center ttext-primary waves-effect waves-light" style="font-size: 21px;"></span> --}}
        <button data-id="{{ $product['id'] }}" class="checkout focus:tbg-primary tbg-primary tfont-medium tpy-4 ttext-white tw-1/2 waves-effect waves-light">Checkout</button>
    </div>

@endsection

@section('js')
    {!! number_spinner_js() !!}
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.tabs').tabs();
        });

        $('.qty_min').click(function(){
            var qty = parseInt($(this).next().val()) - 1;
            
            if (qty+1 == 1) {
                return;
            }
            var base_price = parseInt($('#price').data('price'));
            var static_price = $('#price').text();
            var total = parseInt(base_price * qty);
            $('#price').html('{{currency()}}'+total);
        });

        $('.qty_add').click(function(){
            var base_price = parseInt($('#price').data('price'));
            var static_price = $('#price').text();
            var qty = parseInt($(this).prev().val()) + 1;
            var total = parseInt(base_price * qty);

            $('#price').html('{{currency()}}'+total);
        });

        var main_image = $('.owl-main').owlCarousel({
            items:1,
            loop:false,
            center:true,
            margin:10,
            dots: false,
            animateOut: 'fadeOut',
            URLhashListener:true,
            autoplayHoverPause:true,
            startPosition: 'URLHash'
        }); // MAIN IMAGE

        var small_image = $('.owl-small').owlCarousel({
            loop:false,
            margin:10,
            nav:true,
            items:5
        })


        //CHECKOUT OLD - go to checkout
        // $('#checkout').click(function () {
            //     let items = [];
            //     let id = $(this).data('id');
            //     let qty = $('.number_spinner').val();

            //     items.push({
            //         id:id,
            //         qty:qty
            //     });

            //     items = window.btoa(JSON.stringify(items)); // encode a string
            //     window.location.href = "checkout/"+items;
        // });

        $('.checkout').click(function () {
            let id = $(this).data('id');
            $.get( "cart/add/" + id, function( data ) {
                window.location.href = "/cart";
            });
        });

        //ADD TO WISHLIST
        $('#add_to_wishlist').click(function () {
            let product_id = $(this).attr('product_id');
            $.get( "wishlist/add/" + product_id, function( data ) {
                Swal.fire({
                    icon: 'success',
                    title: 'item has been added to your wish list',
                    showConfirmButton: false,
                    timer: 2500,
                    showClass: {
                        popup: 'animated tada fast'
                    },
                    hideClass: {
                        popup: 'animated fadeOut slow'
                    }
                })
            });
        });

        $('#mobile-nav').removeClass("tz-40");// remove bottom nav
    </script>
@endsection