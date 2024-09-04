@include('pages.fbads.bulb.head')
@include('layouts.nav')
  @yield('nav')

  <div style="scroll-behavior: smooth;max-width: 1280px;" id="body" class="sm:trelative tpb-5 bg-color tmx-auto">
    @yield('content') 
  </div>

  <script>
    function mobile_login(toggle){
      if(toggle){
          return $('#mobile_login').show();
        }
      return $('#mobile_login').hide();
    }
  </script>

  <div id="loader" class="tabsolute th-full thidden tleft-0 ttop-0 tw-full" style="z-index: 999;background-color: rgba(187, 187, 187, 0.1);">
    <div class="tfixed tflex th-full titems-center tjustify-center tw-full">
      <div class="trelative">
        <img src="{{ url('loader/cart.svg') }}" alt="cart">
        <img src="{{ url('loader/progressbar.svg') }}" class="tabsolute" style="top: 52%;left: 40%;" alt="progressbar">
      </div>
    </div>
  </div><!-- Web and Web Loader -->

  <div id="mobile_loader" class="tabsolute th-full thidden tleft-0 ttop-0 tw-full" style="z-index: 999;background-color: rgba(255, 255, 255,0.9);">
    <div class="tfixed tflex th-full titems-center tjustify-center tw-full">
      <div class="trelative">
        <img src="{{ url('loader/four_dots_loader.svg') }}" alt="four_dots_loader">
      </div>
    </div>
  </div><!-- Web and Web Loader -->

@include('layouts.footer')