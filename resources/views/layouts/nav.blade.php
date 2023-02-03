<div class="tbg-white sm:tbg-primary">
    <div class="thidden sm:tblock tcontainer tpy-10 sm:tpy-3">
        <div class="tflex tjustify-between">
            <h1 class="logo">
                <a href="/">
                    <img src="{{ asset('images\logo\main.png') }}" class="tabsolute" style="height: 100px;margin-top: -1px;" alt="shopickers logo">
                </a>
            </h1>
            <ul class="lg:tml-5 sm:tml-24 tflex tfont-medium titems-center ttext-white tlist-none">
                {{-- @foreach (\App\Category::categories() as $item)
                    <li class="tborder-white tpx-2 hover:tunderline tcursor-pointer">
                        <i class="fab fa-envira"></i>
                        <a href="{{ $item['link'] }}">{{ $item['title'] }}</a>
                    </li>
                @endforeach --}}
                @auth
                    @if (auth()->user()->role == 'admin')
                        <li class="tborder-white tpx-2 hover:tunderline tcursor-pointer">
                            <i class="fab fa-envira"></i>
                            <a href="/admin/products">ADMIN</a>
                        </li>
                    @endif
                @endauth
            </ul>
            <div class="tself-center trelative thidden sm:tblock">
                <a href="{{ route('cart') }}" id="cart" class="btn-floating hover:tbg-white tbg-white waves-effect waves-light">
                    <i class="material-icons">shopping_cart</i>
                </a>
                <span class="cart_item_count thidden t-ml-4 t-mt-2 tabsolute tbg-red-500 trounded-full ttext-white" style="z-index: 999;padding: 0px 7px;">1</span>
            </div>
        </div>
    </div>

    <div class="tblock sm:thidden tbg-primary tflex titems-center tpx-3 tpy-2">
        <a href="/">
            <img style="height:38px;" class="" src="{{ asset('images\logo\main.png') }}" alt="shopickers logo">
        </a>
        <div class="tfont-extrabold ttext-white ttext-lg tml-2">Shopickers</div>
    </div><!-- MOBILE NAV  -->
</div>

<div class="tbg-white thidden sm:tblock">
    <div class="tcontainer tpy-5">
        <div class="tflex tflex-growt tjustify-between titems-center">
            <ul class="tflex tml-40 tlist-none">
                <li>
                    <h4 class="text-base tfont-medium ttext-title thidden">a</h4>
                </li>
            </ul>
            <ul class="tflex tfont-bold ttext-primary ttext-xs tlist-none">
                <li class="hover:tunderline tmr-8 tcursor-default">
                    <a href="{{ route('products.all') }}">PRODUCTS</a>
                </li>
                <li class="hover:tunderline tmr-8 tcursor-default">
                    <a href="{{ route('contactus') }}">CONTACT US</a>
                </li>
                <li class="hover:tunderline tmr-8 tcursor-default">
                    <a href="{{ route('aboutus') }}">ABOUT US</a>
                </li>
                @auth
                    <li class="hover:tunderline tmr-8 tcursor-default"><a href="{{ route('dashboard') }}">MY ACCOUNT</a></li>
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <li >
                            <button type="submit" class="hover:tunderline tcursor-default tfont-bold">LOGOUT</button>
                        </li>
                    </form>
                @else
                    <li class="hover:tunderline tmr-8 tcursor-default"><a href="{{ route('register') }}">SIGN UP</a></li>
                    <li class="hover:tunderline tcursor-default"><a href="{{ route('login') }}">LOGIN</a></li>
                @endauth
            </ul>
        </div>
    </div>
</div>


{{-- MOBILE NAV --}}
<div id="mobile-nav" class="sm:thidden tpy-1 tbg-primary tborder-t tbottom-0 tfixed tflex titems-center tw-full tz-40">
    <a href="/" class="tleading-tight tp-1 ttext-center waves-effect tw-1/4">
        <svg class="tmx-auto" fill="#FFFFFF" height="21px" viewBox="0 1 511 511.999" width="21px" xmlns="http://www.w3.org/2000/svg"><path d="m498.699219 222.695312c-.015625-.011718-.027344-.027343-.039063-.039062l-208.855468-208.847656c-8.902344-8.90625-20.738282-13.808594-33.328126-13.808594-12.589843 0-24.425781 4.902344-33.332031 13.808594l-208.746093 208.742187c-.070313.070313-.144532.144531-.210938.214844-18.28125 18.386719-18.25 48.21875.089844 66.558594 8.378906 8.382812 19.441406 13.234375 31.273437 13.746093.484375.046876.96875.070313 1.457031.070313h8.320313v153.695313c0 30.417968 24.75 55.164062 55.167969 55.164062h81.710937c8.285157 0 15-6.71875 15-15v-120.5c0-13.878906 11.292969-25.167969 25.171875-25.167969h48.195313c13.878906 0 25.167969 11.289063 25.167969 25.167969v120.5c0 8.28125 6.714843 15 15 15h81.710937c30.421875 0 55.167969-24.746094 55.167969-55.164062v-153.695313h7.71875c12.585937 0 24.421875-4.902344 33.332031-13.8125 18.359375-18.367187 18.367187-48.253906.027344-66.632813zm-21.242188 45.421876c-3.238281 3.238281-7.542969 5.023437-12.117187 5.023437h-22.71875c-8.285156 0-15 6.714844-15 15v168.695313c0 13.875-11.289063 25.164062-25.167969 25.164062h-66.710937v-105.5c0-30.417969-24.746094-55.167969-55.167969-55.167969h-48.195313c-30.421875 0-55.171875 24.75-55.171875 55.167969v105.5h-66.710937c-13.875 0-25.167969-11.289062-25.167969-25.164062v-168.695313c0-8.285156-6.714844-15-15-15h-22.328125c-.234375-.015625-.464844-.027344-.703125-.03125-4.46875-.078125-8.660156-1.851563-11.800781-4.996094-6.679688-6.679687-6.679688-17.550781 0-24.234375.003906 0 .003906-.003906.007812-.007812l.011719-.011719 208.847656-208.839844c3.234375-3.238281 7.535157-5.019531 12.113281-5.019531 4.574219 0 8.875 1.78125 12.113282 5.019531l208.800781 208.796875c.03125.03125.066406.0625.097656.09375 6.644531 6.691406 6.632813 17.539063-.03125 24.207032zm0 0"/></svg>
    </a>
    <a href="{{ route('dashboard') }}" class="tleading-tight tp-1 ttext-center waves-effect tw-1/4">
        <svg class="tmx-auto" fill="#FFFFFF" height="21px" viewBox="0 1 511 511.999" width="21px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0c-74.439,0-135,60.561-135,135s60.561,135,135,135s135-60.561,135-135S330.439,0,256,0z M256,240c-57.897,0-105-47.103-105-105c0-57.897,47.103-105,105-105c57.897,0,105,47.103,105,105C361,192.897,313.897,240,256,240z"/></g></g><g><g><path d="M423.966,358.195C387.006,320.667,338.009,300,286,300h-60c-52.008,0-101.006,20.667-137.966,58.195C51.255,395.539,31,444.833,31,497c0,8.284,6.716,15,15,15h420c8.284,0,15-6.716,15-15C481,444.833,460.745,395.539,423.966,358.195z M61.66,482c7.515-85.086,78.351-152,164.34-152h60c85.989,0,156.825,66.914,164.34,152H61.66z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
    </a>
    <a href="{{ route('products.all') }}" class="tleading-tight tp-1 ttext-center waves-effect tw-1/4">
        <svg  class="tmx-auto" x="0px" y="0px" height="25px"  fill="#FFFFFF" width="25px" viewBox="0 0 489.4 489.4" style="enable-background:new 0 0 489.4 489.4;" xml:space="preserve"><g><g><path d="M347.7,263.75h-66.5c-18.2,0-33,14.8-33,33v51c0,18.2,14.8,33,33,33h66.5c18.2,0,33-14.8,33-33v-51C380.7,278.55,365.9,263.75,347.7,263.75z M356.7,347.75c0,5-4.1,9-9,9h-66.5c-5,0-9-4.1-9-9v-51c0-5,4.1-9,9-9h66.5c5,0,9,4.1,9,9V347.75z"/><path d="M489.4,171.05c0-2.1-0.5-4.1-1.6-5.9l-72.8-128c-2.1-3.7-6.1-6.1-10.4-6.1H84.7c-4.3,0-8.3,2.3-10.4,6.1l-72.7,128c-1,1.8-1.6,3.8-1.6,5.9c0,28.7,17.3,53.3,42,64.2v211.1c0,6.6,5.4,12,12,12h66.3c0.1,0,0.2,0,0.3,0h93c0.1,0,0.2,0,0.3,0h221.4c6.6,0,12-5.4,12-12v-209.6c0-0.5,0-0.9-0.1-1.3C472,224.55,489.4,199.85,489.4,171.05z M91.7,55.15h305.9l56.9,100.1H34.9L91.7,55.15z M348.3,179.15c-3.8,21.6-22.7,38-45.4,38c-22.7,0-41.6-16.4-45.4-38H348.3z M232,179.15c-3.8,21.6-22.7,38-45.4,38s-41.6-16.4-45.5-38H232z M24.8,179.15h90.9c-3.8,21.6-22.8,38-45.5,38C47.5,217.25,28.6,200.75,24.8,179.15z M201.6,434.35h-69v-129.5c0-9.4,7.6-17.1,17.1-17.1h34.9c9.4,0,17.1,7.6,17.1,17.1v129.5H201.6z M423.3,434.35H225.6v-129.5c0-22.6-18.4-41.1-41.1-41.1h-34.9c-22.6,0-41.1,18.4-41.1,41.1v129.6H66v-193.3c1.4,0.1,2.8,0.1,4.2,0.1c24.2,0,45.6-12.3,58.2-31c12.6,18.7,34,31,58.2,31s45.5-12.3,58.2-31c12.6,18.7,34,31,58.1,31c24.2,0,45.5-12.3,58.1-31c12.6,18.7,34,31,58.2,31c1.4,0,2.7-0.1,4.1-0.1L423.3,434.35L423.3,434.35z M419.2,217.25c-22.7,0-41.6-16.4-45.4-38h90.9C460.8,200.75,441.9,217.25,419.2,217.25z"/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
    </a>
    <a href="{{ route('cart') }}" class="tleading-tight tp-1 ttext-center waves-effect tw-1/4 trelative">
        <svg class="tmx-auto"  fill="#FFFFFF"  height="25px" width="25px" viewBox="-1 0 420 420.00112"  xmlns="http://www.w3.org/2000/svg"><path d="m152.171875 327.882812c-25.4375 0-46.058594 20.625-46.058594 46.0625.003907 25.4375 20.625 46.054688 46.0625 46.054688s46.058594-20.621094 46.058594-46.058594c-.03125-25.425781-20.636719-46.03125-46.0625-46.058594zm0 72.117188c-14.390625 0-26.058594-11.667969-26.058594-26.0625.003907-14.390625 11.667969-26.054688 26.0625-26.054688 14.390625 0 26.058594 11.667969 26.058594 26.058594-.019531 14.386719-11.675781 26.042969-26.0625 26.058594zm0 0"/><path d="m333.449219 327.882812c-25.4375 0-46.058594 20.621094-46.058594 46.058594s20.621094 46.058594 46.058594 46.058594 46.058593-20.621094 46.058593-46.058594c-.03125-25.425781-20.632812-46.027344-46.058593-46.058594zm0 72.117188c-14.394531 0-26.058594-11.667969-26.058594-26.058594 0-14.394531 11.667969-26.058594 26.058594-26.058594s26.058593 11.667969 26.058593 26.058594c-.015624 14.386719-11.675781 26.042969-26.058593 26.058594zm0 0"/><path d="m408.265625 81.679688h-313.566406l-6.800781-40.046876c-4.027344-24.070312-24.886719-41.6835932-49.289063-41.632812h-28.609375c-5.523438 0-10 4.476562-10 10s4.476562 10 10 10h28.605469c14.644531-.03125 27.160156 10.539062 29.578125 24.980469l36.207031 213.3125c4.03125 24.074219 24.894531 41.691406 49.300781 41.632812h213.171875c5.519531 0 10-4.476562 10-10 0-5.523437-4.480469-10-10-10h-213.175781c-14.640625.035157-27.15625-10.535156-29.574219-24.976562l-3.640625-21.449219h209.023438c26.089844.058594 49.210937-16.804688 57.128906-41.664062l31.160156-97.101563c.976563-3.042969.441406-6.367187-1.441406-8.949219-1.882812-2.582031-4.882812-4.105468-8.078125-4.105468zm-40.683594 104.046874c-5.28125 16.574219-20.695312 27.8125-38.089843 27.773438h-212.414063l-18.984375-111.820312h296.457031zm0 0"/></svg>
        <span class="cart_item_count thidden t-mt-8 tabsolute tbg-red-500 tml-2 trounded-full ttext-white" 
            style="z-index: 999;padding: 2px 5px;font-size: 11px;line-height: 1;">
            0
        </span>
    </a>
</div>