<div id="checkout_page" class="tabsolute tw-full th-full tbottom-0 tfixed tfont-medium tmt-4 ttext-white tw-10/12 tbg-white" style="position: fixed; max-width: 480px; z-index: 999; opacity: 1; margin-left: auto; margin-right: auto; left: 0; right: 0; z-index: 999;">
                
    <div class="shopee-bg-color t tflex titems-center tjustify-between tpx-4 tpy-4">
        <i class="fa-arrow-left fa-solid ttext-3xl ttext-white tfont-light" aria-hidden="true"></i>
        <span class="tfont-light ttext-3xl">Checkout</span>
        <i class="fa-solid fa-cart-shopping ttext-2xl" aria-hidden="true"></i>
    </div>


    <div class="tborder-dashed tflex titems-center tjustify-center tmx-3 tmy-4 tpx-3 tpy-3 ttext-green-900" style="border: 2px solid #27ac9b; border-style: dashed;">
        <span class="tfont-medium">Order Today for guaranteed </span>
        <span class="tfont-medium tml-2" style="color: #ee4d2d;"> FREE 4 Gifts</span>
    </div>

    


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

    <form action="http://127.0.0.1:8000/Madella-Submit" id="form" method="post" enctype="multipart/form-data">
        <input type="hidden" name="_token" value="eq5AjYqRfBgsObhTKvIgj4O7RYYRykuiLJfXbySV">                    <h1 class="ttext-gray-900 tmb-5 tmt-8 tml-3 ttext-lg">Shipping Details</h1>
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


        <div class="tabsolute tbottom-0 tflex tw-full" style="-webkit-box-shadow: 0px -2px 15px -5px #000000; box-shadow: 0px -2px 15px -5px #000000;     z-index: 999;">
            <div class="tw-3/5 tbg-white ttext-right tpr-2 tpy-3" style="color: #606060; background-color: white;">
                <div class="t-mt-3 tpt-1">
                    <span class="" style="margin-top: 17%;">Total Payment</span>
                </div>
                <div class="t-mt-1 tfont-bold tfont-medium" style="color: #ee4d2d; font-size: 20px;">
                  150
                  <input type="hidden" name="price" value="150">
                </div>
            </div>
            <button class="tfont-medium tpy-3 tw-2/5" style="background-color: #ee4d2d; font-size: 18px;">Buy Now!</button>
        </div>
    </form>
    
</div>

{{-- FRONT PAGE --}}





<div class="tborder-dashed tflex titems-center tjustify-center tmx-3 tmy-4 tpx-3 tpy-3" style="border: 2px solid #fe8686; border-style: dashed;">
    <span class="tfont-medium">Order Today for guaranteed </span>
    <span class="ttext-pink-500 tfont-medium tml-2"> FREE 4 Gifts</span>
</div>