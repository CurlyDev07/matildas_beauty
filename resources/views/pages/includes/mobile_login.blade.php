<div id="mobile_login" class="thidden tfixed th-full tleft-0 ttop-0 tw-full tbg-white toverflow-hidden" style="z-index: 998;">
    <div class="tpy-3 tshadow tsticky ttop-0 tflex tjustify-between titems-center tpr-3 tbg-white"  style="z-index: 997;">
      <div class="tflex trelative">
        <span onclick="mobile_login(false)" class="material-icons tabsolute trounded-full ttext-primary waves-effect" style="padding: 9px;margin-top: -11px;">keyboard_backspace</span>
        <span class="tfont-medium tml-12">Login</span>
      </div>
      <span class="ttext-gray-600">Help</span>
    </div>
    <div class="tp-5 th-full">

      <img src="{{ url('images/logo/main.png') }}" class="tmx-auto tpb-10 tpt-8 tw-24" alt="Shopickers Logo">
      
      <div class="tw-full">

        <section id="mobile_login_error_msg" class="thidden">
          <div class="tflex tflex-col titems-center tjustify-center ttext-error">
            <span class="material-icons">
              warning
            </span>
            <span>These credentials do not match our records.</span>
          </div>
        </section>

        <form id="mobile_login_form"  style="z-index: 990;">
          <div class="input-field col s12 tmb-0 trelative tmb-6" >
            <span class="tabsolute tbg-white tbg-white tright-0" style="padding: 13px 1px 13px 13px;">
              <svg class="" fill="none" height="15" viewBox="0 0 17 17"><defs></defs><path fill="#000" fill-opacity=".54" fill-rule="evenodd" d="M6.647.376a4.728 4.728 0 00-1.736 1.298 4.418 4.418 0 00-.905 1.927 6.409 6.409 0 00-.103 1.833c.052.594.186 1.182.413 1.696.124.28.295.606.531.971.19.293.42.607.698.937.049.087.22.44-.123.645-.393.235-1.35.812-2.24 1.355-.582.357-1.16.714-1.575.978-.302.193-.666.435-.97.746-.338.346-.597.77-.629 1.29-.009.153-.01.938-.004 1.118.016.416.103.78.314 1.062.233.308.583.492 1.104.504h.009a1976.8 1976.8 0 017.066-.011c2.671 0 5.02.003 7.066.01h.009c.52-.01.871-.195 1.103-.503.212-.281.299-.646.315-1.062.007-.18.01-.386.01-.595 0-.189-.005-.37-.014-.523-.032-.52-.291-.944-.63-1.29-.304-.31-.667-.553-.969-.746-.415-.264-.993-.621-1.576-.978-.89-.543-1.846-1.12-2.24-1.355-.341-.205-.171-.558-.122-.645a9.31 9.31 0 00.698-.937c.236-.365.407-.691.53-.971a5.396 5.396 0 00.413-1.696 6.41 6.41 0 00-.102-1.833 4.418 4.418 0 00-.905-1.927A4.728 4.728 0 0010.345.376a4.188 4.188 0 00-.875-.278A4.968 4.968 0 008.513 0H8.48a4.968 4.968 0 00-.958.098c-.295.06-.592.151-.875.278zM5.598 2.24c.413-.503.93-.834 1.412-1.05.222-.1.456-.171.69-.22a4.06 4.06 0 01.785-.08h.024c.249.002.516.026.784.08.235.049.469.12.69.22.483.216 1 .547 1.413 1.05.323.394.585.898.72 1.544.1.48.132 1.03.085 1.574a4.51 4.51 0 01-.339 1.414c-.109.247-.258.532-.462.846-.173.267-.388.56-.654.873l-.019.023-.016.024c-.009.014-.78 1.202.404 1.91.371.22 1.31.787 2.232 1.351.619.378 1.204.74 1.563.968.259.165.568.37.808.617.206.21.362.452.378.722.01.155.014.316.015.47 0 .19-.004.385-.01.564-.01.242-.048.438-.137.556-.069.092-.197.147-.408.152-2.685-.01-5.033-.015-7.06-.015-2.025 0-4.373.005-7.058.015-.212-.005-.34-.06-.408-.152-.09-.118-.127-.314-.137-.556a13.665 13.665 0 01-.01-.564c0-.155.005-.315.014-.47.017-.27.173-.512.379-.722.24-.246.55-.452.808-.617.359-.229.944-.59 1.562-.967.923-.565 1.862-1.131 2.233-1.353 1.185-.708.41-1.898.403-1.908l-.015-.025-.02-.023a8.483 8.483 0 01-.654-.873 6.077 6.077 0 01-.461-.846 4.507 4.507 0 01-.34-1.414 5.508 5.508 0 01.086-1.574c.135-.646.397-1.15.72-1.544z" clip-rule="evenodd" stroke="none"></path></svg>
            </span>
            <input id="mobile_login_email" type="email" name="mobile_login_email" class="validate">
            <label for="mobile_login_email">Email</label>
          </div><!-- EMAIL -->
          <div class="input-field col s12 tmb-0 trelative tmb-6" >
            <span class="tabsolute tbg-white tbg-white tright-0"  style="padding: 13px 1px 13px 13px;">
              <svg class="" fill="none" height="15" style="font-size: 17px;" viewBox="0 0 18 19"><defs></defs><path fill="#000" fill-opacity=".54" fill-rule="evenodd" d="M14.732 5.74v1.39a2.39 2.39 0 012.344 2.392v7.087A2.39 2.39 0 0114.688 19H3.314A2.39 2.39 0 01.926 16.61V9.522A2.39 2.39 0 013.314 7.13h-.045V5.739a5.732 5.732 0 1111.463 0zm-.955 0v1.393H4.225V5.739A4.78 4.78 0 019 .954h.002a4.783 4.783 0 014.776 4.785zM3.314 18.043h11.375c.791-.001 1.432-.644 1.431-1.435V9.522c.001-.792-.64-1.435-1.432-1.435H3.314c-.792 0-1.433.643-1.433 1.435v7.088c0 .791.641 1.433 1.433 1.434z" clip-rule="evenodd" stroke="none"></path><rect width="2"  x="8" y="11" fill="#000" fill-opacity=".54" rx="1" stroke="none"></rect></svg>
            </span>
            <input id="mobile_login_password" type="password" name="mobile_login_password" class="validate">
            <label for="mobile_login_password">Password</label>
          </div><!-- PASSWORD -->
        </div>

        <button class="focus:tbg-primary tbg-primary tpy-3 trounded ttext-white ttracking-wider tw-full waves-effect waves-light">Login</button>
      </form>

      <div class="tflex titems-center tjustify-between tmt-3 ttext-sm" style="margin-bottom: 25px;">
        <a href="" class="ttext-primary">Sign Up</a>
        <a href="" class="ttext-primary">Forgot</a>
      </div>

      <div class="tflex titems-center tjustify-center tmb-5">
        <div class="" style="width: 25%;border: .5px solid rgba(0,0,0,.12);"></div>
        <span class="tpx-4 ttext-gray-600 ttext-sm">OR</span>
        <div class="tmr-3" style="width: 25%;border: .5px solid rgba(0,0,0,.12);"></div>
      </div>

      <div class="tflex titems-center tjustify-center">
        <button class="focus:tbg-gray-300 fous:tbg-white tbg-gray-300 tflex tpx-4 tpy-2 trounded waves-effect waves-light tmr-2">
          <img src="https://accounts.google.com/favicon.ico" class="tmr-2" alt="google icon" width="24" height="24">
          Google
        </button>
        <button class="focus:tbg-gray-300 fous:tbg-white t-mr-1 tbg-gray-300 tflex tml-2 tpx-4 tpy-2 trounded waves-effect waves-light">
          <img src="https://facebookbrand.com/wp-content/uploads/2016/05/flogo_rgb_hex-brc-site-250.png" class="tmr-2" alt="google icon" width="24" height="24">
          Facebook
        </button>
      </div>

    </div>
  </div>