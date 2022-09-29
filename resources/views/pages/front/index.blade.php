@extends('layouts.app')

@section('css')
    {{-- <link rel="stylesheet" href="{{ asset('plugins/lightslider/css.css') }}"> --}}
    <style>
        .owl-prev, .owl-next{
            background-color: #88b44e!important;
            height: 45px!important;
            width: 45px!important;
            border-radius: 50%!important;
            outline: none!important;
            position: relative!important;;
        }
        .owl-prev > span, .owl-next > span {
            color: white!important;
            font-size: 35px!important;
            left: 36%!important;
            top: -19%!important;
            position: absolute!important;
        }
        #our_products > .owl-stage-outer {
            position: relative;
            /* overflow-y: visible; */
            overflow-x: hidden;
        }
        .parallax {
            background-image: url("http://chaitan.like-themes.com/wp-content/uploads/2018/06/testimonials_parallax.jpg?id=4906");
            min-height: 100vh;
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            z-index: 1;
            filter: grayscale(15%);
            -webkit-filter: grayscale(15%);
        }
        #testimonial > .owl-nav{
            display: flex;
            justify-content: space-around;
            margin-top: -11%;
            margin-bottom: 10%;
        }
        #testimonial > .owl-nav > .owl-prev, .owl-next{
            background-color: #88b44e;
        }
        .owl-theme .owl-nav.disabled+.owl-dots {
            display: none!important;
        }
        .main_title {
            position: relative;
            text-align: center;
        }

        .main_title span {
            display: block;
            content: attr(data-mask);
            position: absolute;
            text-align: center;
            top: 0;
            font-weight: 900;
            line-height: 1;
            z-index: 1;
            color: #ececec;
            text-transform: uppercase;
            width: 100%;
        }
        .main_title p {
            padding: 0 5%;
            position: relative;
            z-index: 2;
            margin: 0px
        }
        /* @media only screen and (max-width: 600px) {
            body {
                background-color: lightblue;
            }
        } */

    </style>
@endsection

@section('content')

<div class="tflex tbg-white">
    <div class="tw-full md:tw-3/5">
        <div class="main-banner owl-carousel owl-theme owl-loaded owl-drag">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item">
                        <img src="{{ asset('images/banners/banner1.jpg') }}" alt="banner1" class="tw-16 md:tw-32 lg:tw-48">
                    </div>
                    <div class="owl-item">
                        <img src="{{ asset('images/banners/banner2.jpg') }}" alt="banner2" class="tw-16 md:tw-32 lg:tw-48">
                    </div>
                    <div class="owl-item">
                        <img src="{{ asset('images/banners/banner3.jpg') }}" alt="banner3" class="tw-16 md:tw-32 lg:tw-48">
                    </div>
                    <div class="owl-item">
                        <img src="{{ asset('images/banners/banner4.jpg') }}" alt="banner4" class="tw-16 md:tw-32 lg:tw-48">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="thidden md:tblock md:tw-2/5">
        <div class="main-banner owl-carousel owl-theme owl-loaded owl-drag tpl-1">
            <div class="owl-stage-outer">
                <div class="owl-stage">
                    <div class="owl-item">
                        <div class="md:flex-shrink-0">
                            <img src="{{ asset('images/banners/banner-sm-1.jpg') }}" class="md:w-56"  alt="banner1">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- Carousel Banners -->

<div class="md:tpt-10 tbg-white tpt-6 trelative ttext-center">
    <div class="main_title tmb-5">
        <span class="md:t-mt-6 md:ttext-6xl t-mt-4 ttext-5xl ttracking-widest">Products</span>
        <p class="tfont-medium ttext-4xl">Top Selling</p>
        <p class="tmt-3 ttext-lg ttracking-wider ttext-gray-700">We offer the best and high quality product that you looking for</p>
    </div>

    <div class="tflex tflex-wrap tmx-0 tpx-0 md:tmx-10 md:tpx-8 tpy-5">
        @foreach ($products as $item)
            <div class="product tw-1/2 sm:tw-1/3 lg:tw-1/4 xl:tw-1/5 tmb-8" style="padding-right: 5px !important; padding-left: 5px !important;">
                <div class="product-hover hover:tshadow-xl tbg-white tshadow-md trounded-lg toverflow-hidden">
                    <div class="tpx-4 tpy-2" style="min-height: 60.75px;">
                        <a href="{{ item_show_slug($item['title'], $item['id']) }}" style="font-size: 14px; height: 43px;" class="hover:ttext-primary hover:tunderline product-title tfont-medium tmt-1 truncate ttext-sm">
                            {{ $item['title'] }}
                        </a>
                    </div>
                    <div class="toverflow-hidden tcursor-pointer" onclick="item_show('{{ item_show_slug($item['title'], $item['id']) }}')">
                        <img class="product-image th-40 md:th-56 tw-full tobject-cover tmt-2" src="{{ asset($item['images'][0]['img']) }}" alt="{{$item['title']}}">
                    </div>
                    <div 
                        class="tcursor-pointer tflex titems-center tjustify-between tpx-4 tbg-primary">
                        <h1 class="ttext-gray-200 tfont-bold ttext-xl"><span class="ttext-md tfont-normal">{{ currency() }}</span>{{$item['price']}}</h1>
                        <span data-id="{{$item['id']}}" class="add_to_cart  fa-cart-plus fas tcursor-pointer tp-2 trounded-full ttext-white waves-effect waves-light" style="font-size: 21px;"></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div><!-- Top Selling Products -->


<div class="tbg-center tbg-cover tbg-fixed tbg-no-repeat trelative ttext-white" style="height: 400px; background-image: url({{ asset('images/banners/banner-parallax.jpg') }});">
    <div class="tflex titems-center tw-full th-full ttop-0 tleft-0" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="tpy-16 tw-full">
            <div class="tmx-0 tpx-4 md:tmx-10 md:tpx-8">
                <h3 class="tfont-bold tleading-none ttext-4xl tmb-2">CORSAIR ONE <br> i145 Compact Gaming PC (EU)</h3>
                <p class="md:tw-1/2 text-lg ttracking-wider tmb-5">CORSAIR ONE i145 redefines what you can expect from a high-performance gaming PC. Incredibly fast, amazingly compact, quiet and stunningly designed.</p>
                <div class="tflex titems-center">
                    <div class="">
                        <span class="tfont-medium ttext-4xl">{{ currency() }}2499</span>
                        <span class="tline-through tfont-medium" style="color: #afadad">{{ currency() }}2750</span>
                    </div>
                    <a href="/products" class="tbg-purple-800 tfont-medium tpx-6 tpy-3 trounded tml-5">Shop Now</a>
                </div>
            </div>
        </div>
    </div>
</div><!-- Parallax -->

<div class="md:tpt-10 tbg-white tpt-6 trelative ttext-center">
    <div class="main_title tmb-5">
        <span class="md:t-mt-6 md:ttext-6xl t-mt-4 ttext-5xl ttracking-widest">Products</span>
        <p class="tfont-medium ttext-4xl">Featured</p>
        <p class="tmt-3 ttext-lg ttracking-wider ttext-gray-700">We give you a unique product with a cheap price but high in quality items</p>
    </div>

    <div class="tflex tflex-wrap tmx-0 tpx-0 md:tmx-10 md:tpx-8 tpy-5">
        @foreach ($products as $item)
            <div class="product tw-1/2 sm:tw-1/3 lg:tw-1/4 xl:tw-1/5 tmb-8" style="padding-right: 5px !important; padding-left: 5px !important;">
                <div class="product-hover hover:tshadow-xl tbg-white tshadow-md trounded-lg toverflow-hidden">
                    <div class="tpx-4 tpy-2"  style="min-height: 60.75px;">
                        <a href="{{ item_show_slug($item['title'], $item['id']) }}" style="font-size: 14px;" class="hover:ttext-primary hover:tunderline product-title tfont-medium tmt-1 truncate ttext-sm">
                            {{ $item['title'] }}
                        </a>
                    </div>
                    <div class="toverflow-hidden tcursor-pointer" onclick="item_show('{{ item_show_slug($item['title'], $item['id']) }}')">
                        <img class="product-image th-40 md:th-56 tw-full tobject-cover tmt-2" src="{{ asset($item['images'][0]['img']) }}" alt="{{$item['title']}}">
                    </div>
                    <div 
                        class="tcursor-pointer tflex titems-center tjustify-between tpx-4 tbg-primary">
                        <h1 class="ttext-gray-200 tfont-bold ttext-xl"><span class="ttext-md tfont-normal">{{ currency() }}</span>{{$item['price']}}</h1>
                        <span data-id="{{$item['id']}}" class="add_to_cart  fa-cart-plus fas tcursor-pointer tp-2 trounded-full ttext-white waves-effect waves-light" style="font-size: 21px;"></span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div><!-- Featured Products -->




{{-- <div id="our_products" class="owl-carousel owl-theme tpb-8" style="">
    <div class="item">
        <img id="test" src="http://chaitan.like-themes.com/wp-content/uploads/2018/07/razdel_01-740x520.jpg" alt="promo-1" style="margin-bottom: 14%;">
        <div class="trelative">
            <div class="tflex tjustify-center">
                <div class="px-5 tabsolute trounded tshadow-md"
                    style=" left: 6%;
                            right: 6%;
                            background-color: #ffffff;
                            bottom: -10%;
                            height: 115px;
                            padding: 15px 25px 25px;
                            border: 2px;"
                >
                    <div class="hover:ttext-primary tfont-extrabold ttext-2xl ttext-center ttext-gray-800">Green Tea</div>
                    <div class="ttext-center ttext-black-100">Nullam dictum molestie quam, non feugiat dui eleifend eget.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <img src="http://chaitan.like-themes.com/wp-content/uploads/2018/07/razdel_03-740x520.jpg" class="hover:topacity-75" alt="promo-1" style="margin-bottom: 14%;">
        <div class="trelative">
            <div class="tflex tjustify-center">
                <div class="px-5 tabsolute trounded tshadow-md"
                    style=" left: 6%;
                            right: 6%;
                            background-color: #ffffff;
                            bottom: -10%;
                            height: 115px;
                            padding: 15px 25px 25px;
                            border: 2px;"
                >
                    <div class="hover:ttext-primary tfont-extrabold ttext-2xl ttext-center ttext-gray-800">Organic Tea</div>
                    <div class="ttext-center ttext-black-100">Nullam dictum molestie quam, non feugiat dui eleifend eget.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <img src="http://chaitan.like-themes.com/wp-content/uploads/2018/07/razdel_04-740x520.jpg" class="hover:topacity-75" alt="promo-1" style="margin-bottom: 14%;">
        <div class="trelative">
            <div class="tflex tjustify-center">
                <div class="px-5 tabsolute trounded tshadow-md"
                    style=" left: 6%;
                            right: 6%;
                            background-color: #ffffff;
                            bottom: -10%;
                            height: 115px;
                            padding: 15px 25px 25px;
                            border: 2px;"
                >
                    <div class="hover:ttext-primary tfont-extrabold ttext-2xl ttext-center ttext-gray-800">Oolong Tea</div>
                    <div class="ttext-center ttext-black-100">Nullam dictum molestie quam, non feugiat dui eleifend eget.</div>
                </div>
            </div>
        </div>
    </div>
    <div class="item">
        <img src="http://chaitan.like-themes.com/wp-content/uploads/2018/07/razdel_02-740x520.jpg" class="hover:topacity-75" alt="promo-1" style="margin-bottom: 14%;">
        <div class="trelative">
            <div class="tflex tjustify-center">
                <div class="px-5 tabsolute trounded tshadow-md"
                    style=" left: 6%;
                            right: 6%;
                            background-color: #ffffff;
                            bottom: -10%;
                            height: 115px;
                            padding: 15px 25px 25px;
                            border: 2px;"
                >
                    <div class="hover:ttext-primary tfont-extrabold ttext-2xl ttext-center ttext-gray-800">Black Tea</div>
                    <div class="ttext-center ttext-black-100">Nullam dictum molestie quam, non feugiat dui eleifend eget.</div>
                </div>
            </div>
        </div>
    </div>
</div> --}}
   
<!-- <div class="parallax tpy-12">
    <div class="tfont-extrabold ttext-3xl ttext-center ttext-primary tmb-12 tpt-8">Testimonials</div>
    <div id="testimonial" class="owl-carousel owl-theme trelative" style="">
        @for ($i = 0; $i < 5; $i++)
            <div class="item">
                <div class="tw-1/2 tmx-auto tbg-white tpx-12 tpy-8">
                    <div class="ttext-center">Reggie Frias</div>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis voluptate perferendis rem aperiam unde qui repellat velit incidunt quos, quo, quisquam doloribus nulla deleniti molestias provident eveniet quam! Totam, eveniet?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis voluptate perferendis rem aperiam unde qui repellat velit incidunt quos, quo, quisquam doloribus nulla deleniti molestias provident eveniet quam! Totam, eveniet?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Perspiciatis voluptate perferendis rem aperiam unde qui repellat velit incidunt quos, quo, quisquam doloribus nulla deleniti molestias provident eveniet quam! Totam, eveniet?
            </div>
        </div>
        @endfor
    </div>
</div> -->


    <!-- <div class="parallax tpy-24">
        <div class="ttext-center trelative">
            <h1 class="tfont-extrabold ttext-3xl ttext-white tpt-8 tz-20">Testimonials</h1>
            <div class="tabsolute ttext-5xl tz-10" style="font-size: 150px;font-family: cursive;top: -114%;left: 1%;right:1%;opacity: 0.1;">Testimonials</div>
        </div>
        <div id="testimonial" class="owl-carousel owl-theme tz-30">
            @for ($i = 0; $i < 10; $i++)
                <div class="item">
                    <div class="trelative  tflex tjustify-center tmt-20">
                        <img class="tabsolute trounded-full" style="height: 80px;width: 80px;top: -17%;" src="https://imgur.com/I80W1Q0.png" alt="">
                        <div class="tw-1/2 tpx-12 tpy-8 tbg-white trounded ">
                            <div class="tfont-medium ttext-center ttext-lg ttext-primary tmy-3">Reggie Frias</div>
                            <div class="">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, dolores sed cupiditate eos dolor at provident earum soluta laboriosam sint deserunt hic quisquam explicabo quibusdam veniam molestiae optio commodi omnis!
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Id, dolores sed cupiditate eos dolor at provident earum soluta laboriosam sint deserunt hic quisquam explicabo quibusdam veniam molestiae optio commodi omnis!
                            </div>
                            <div class="ttext-center  tmt-5">
                                <i class="fa-quote-left fas ttext-4xl" style="color: #88b44e;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div> -->

@endsection

@section('js')
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>

    {{-- <script src="{{ asset('plugins/lightslider/js.js') }}"></script> --}}
    <script>
        // $("#lightSlider").lightSlider(); 
        let side_promo_banner = $('#our_products.owl-carousel').owlCarousel({
            items: 3,
            nav: true,
            margin: 8,
            dots: false,
            autoplay: true,
        });

        let testimonial = $('#testimonial.owl-carousel').owlCarousel({
            items: 1,
            nav: true,
            margin: 30,
            dots: false,
            autoplay: true,
        });

    </script>

    @include('plugins.fb_messenger')

@endsection