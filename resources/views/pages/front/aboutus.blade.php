@extends('layouts.app')

@section('css')
    <style>
        .about-us-cover-img{
            background: url('http://www.portotheme.com/magento/porto/media/wysiwyg/porto/aboutus/4/top-bg.jpg') no-repeat; 
            background-size: cover;
            text-align: left;
            padding: 80px 0;
        }
    </style>
@endsection

@section('nav')
    <div class="about-us-cover-img">
        <div class="tcontainer">
            <h1 class="tfont-bold ttext-lg ttext-xl">ABOUT US</h1>
            <h2 class="tfont-bold ttext-4xl ttext-xl tmt-1">OUR COMPANY</h2>
            {{-- <button class="tbg-black tmt-6 tpx-5 tpy-3 trounded ttext-white focus:tbg-black waves-light">CONCTACT</button> --}}
        </div>
    </div>
@endsection

@section('content')

    <div class="tbg-white">
        <div class="tcontainer tpy-8">
            <h1 class="tfont-bold ttext-2xl tmb-5">OUR STORY</h1>

            <p class="ttext-base ttracking-widest ttext-gray-600 tleading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                It has survived not only five centuries, but also the leap into
                electronic typesetting, remaining essentially unchanged.
            </p>
            <br>
            <p class="ttext-base ttracking-widest ttext-gray-600 tleading-relaxed">
                Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <br>
            <p class="ttext-lg ttracking-widest tleading-normal">
                “ Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model search 
                for evolved over sometimes by accident, sometimes on purpose ”
            </p>
        </div>
    </div>



    <div class="tcontainer tpy-12">
        <h1 class="tfont-bold ttext-2xl tmb-5">WHY CHOOSE US</h1>

        <div class="tflex tflex-wrap">
            <div class="tw-full lg:tw-1/3  lg:tpr-4 tmb-8 lg:mb-0">
                <div class="sm:tflex sm:titems-center lg:tblock tbg-white tp-8 lg:tp-10 trounded tw-full">
                    <div class="lg:tw-full sm:tw-2/5">
                        <p class="ttext-center tm-0">
                            <i class="fas fa-shipping-fast fa-3x ttext-blue-400 tmb-6"></i>
                        </p>
                        <p class="ttext-base tm-0 leading-5 tfont-medium tmb-6 sm:tmb-0 lg:tmb-6 ttext-center">Free Shipping</p>
                    </div>
                    <p class="lg:tw-full tm-0 sm:tw-3/5 tleading-loose ttext-gray-600 ">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industr.
                    </p>
                </div>
            </div>
            <div class="tw-full lg:tw-1/3  lg:tpx-2 tmb-8 lg:mb-0">
                <div class="sm:tflex sm:titems-center lg:tblock tbg-white tp-8 lg:tp-10 trounded tw-full">
                    <div class="lg:tw-full sm:tw-2/5">
                        <p class="ttext-center tm-0">
                            <i class="fas fa-dollar-sign fa-3x ttext-blue-400 tmb-6"></i>
                        </p>
                        <p class="ttext-base tm-0 leading-5 tfont-medium tmb-6 sm:tmb-0 lg:tmb-6 ttext-center">Free Shipping</p>
                    </div>
                    <p class="lg:tw-full tm-0 sm:tw-3/5 tleading-loose ttext-gray-600 ">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industr.
                    </p>
                </div>
            </div>
            <div class="tw-full lg:tw-1/3  lg:tpl-4 tmb-8 lg:mb-0">
                <div class="sm:tflex sm:titems-center lg:tblock tbg-white tp-8 lg:tp-10 trounded tw-full">
                    <div class="lg:tw-full sm:tw-2/5">
                        <p class="ttext-center tm-0">
                            <i class="fas fa-headset  fa-3x ttext-blue-400 tmb-6"></i>
                        </p>
                        <p class="ttext-base tm-0 leading-5 tfont-medium tmb-6 sm:tmb-0 lg:tmb-6 ttext-center">Free Shipping</p>
                    </div>
                    <p class="lg:tw-full tm-0 sm:tw-3/5 tleading-loose ttext-gray-600 ">
                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industr.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="tbg-white">
        <div class="tcontainer tpy-12">
            <h1 class="tfont-bold ttext-2xl tpb-12 ttext-center">TESTIMONIAL</h1>
        
            <div class="owl-carousel owl-theme">
                @for ($i = 0; $i < 8; $i++)
                    <div class="item">
                        <div class="tw-full">
                            <div class="tflex titems-center">
                                <img src="http://www.portotheme.com/magento/porto/media/wysiwyg/porto/aboutus/4/client1.png" class="trounded-full" style="height:60px; width:60px" alt="">
                                <div class="tml-4 tflex tflex-col titems-center">
                                    <div class="tfont-medium">John Smith</div>
                                    <div class="ttext-sm">{{ now()->diffForHumans() }}</div>
                                </div>
                            </div>
                            <div class="tflex tpy-2 tpx-16">
                                <div class="tmr-5">
                                    <i class="fas fa-quote-left ttext-blue-700"></i>
                                </div>
                                <span class="tfont-light ttext-black ttracking-wider">
                                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Reprehenderit animi cupiditate ratione iusto facilis nostrum a, sint quam doloribus architecto tenetur delectus dolorum ex molestiae modi. Maxime numquam voluptas laudantium?
                                </span>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

@endsection


@section('js')
    <script>
        $('.owl-carousel').owlCarousel({
            loop:true,
            margin:10,
            nav:false,
            autoplay:true,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:2
                }
            }
        })
    </script>
@endsection