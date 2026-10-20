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