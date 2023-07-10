@extends('admin.return.layouts')

@section('css')

    <style>
        .autocomplete-content img {
            display: none;
        }
        .modal .modal-content {
            height: 50vh;
        }
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed #919eab;
            border-image: none;
        }
        .dropzone .dz-message {
            text-align: center;
            margin: 0;
        }
    </style>

    {{-- Search Style --}}
    <style>
        #myInput {
            background-image: url('/image/icons/barcode.png'); /* Add a search icon to input */
            background-position: 10px 12px; /* Position the search icon */
            background-repeat: no-repeat; /* Do not repeat the icon image */
            width: 100%; /* Full-width */
            font-size: 16px; /* Increase font-size */
            padding: 12px 20px 12px 40px; /* Add some padding */
            border: 1px solid #ddd; /* Add a grey border */
            margin-bottom: 12px; /* Add some space below the input */
        }

        #myUL {
            /* Remove default list styling */
            list-style-type: none;
            padding: 0;
            margin: 0;
        }

        #myUL li a {
            border: 1px solid #ddd; /* Add a border to all links */
            margin-top: -1px; /* Prevent double borders */
            background-color: #f6f6f6; /* Grey background color */
            padding: 12px; /* Add some padding */
            text-decoration: none; /* Remove default text underline */
            font-size: 18px; /* Increase the font-size */
            color: black; /* Add a black text color */
            display: block; /* Make it into a block element to fill the whole list */
        }

        #myUL li a:hover:not(.header) {
            background-color: #eee; /* Add a hover effect to all links, except for headers */
        }
    </style>

@endsection

@section('page')

@if(session()->has('success'))
    <div class="tflex tbg-green-100 trounded-lg tp-4 tmb-4 txt-sm ttext-green-700" role="alert">
        <svg class="tw-5 th-5 tinline tmr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div>
            <span class="tfont-medium">{{ session()->get('success') }}! </span> New supplier added
        </div>
    </div>
@endif

    <div class="tbg-white  trounded-lg tshadow-lg ttext-black-100">
        <div class="tflex tjustify-between tborder-b ">
            <div class="ttext-base tfont-medium tpx-5 tpy-4 ttext-title">
                Orders
            </div>
            <div class="tflex titems-center tjustify-end tmx-5 tpr-3 tpy-3">
                <div class="tpr-5 tborder-r"><small class="ttext-gray-500"><span id="total_items">0</span> item(s)</small> TOTAL</div>
                <div class="tpx-6" style="font-size: 24px;">₱<span id="total">0</span> </div>
            </div>
        </div>
     
        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3">
            <div class="tflex tpx-5 tmt-5">
                <div class="tw-2/5 tborder-r tpr-2">

                    <div action="?" class="tflex titems-center tmb-4">
                        <input type="text" id="search" onkeyup="Search()" class="browser-default tw-full tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </div>


                    <ul id="products" style="height: 200px" class="toverflow-scroll toverflow-x-hidden">
                        @foreach ($products as $product)
                            <li>
                                <a href="javascript:void(0)" class="add-search-product" id="{{ $product->id }}" aria-disabled="true">
                                    <div class="tflex titems-center tpy-1">
                                        <img src="{{ $product['primary_image'] }}" class="search-img" style="height: 50px; width: 50px;" alt="">
                                        {{-- <img src="https://cf.shopee.ph/file/d8966eff56f6714d423e261828353033" class="search-img" style="height: 50px; width: 50px;" alt=""> --}}
                                        <div class="tpx-2">
                                            <p class="search-title ttext-md">{{ $product->title }}</p>
                                            <small class="search-sku">{{ $product->sku }}</small>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>

                {{-- HIDDEN ID{{ dd($rts->id)}} --}}
                <input type="hidden" id="id" value="{{ $rts->id }}">

                <div id="products_container" class="tw-3/5 tborder-l tpl-2 toverflow-scroll toverflow-x-hidden tpr-6" style="height: 250px">
                    <div action="?" class="tflex titems-center tmb-4 trelative">
                        <input autofocus type="text" id="transaction_id" value="{{ $rts->transaction_id }}" height: 58px; class="browser-default focus:tborder-blue-400 tborder tborder-gray-200 toutline-none tpx-3 tpy-2 tw-full" placeholder="Scan/Type tracking number...">
                        <img src="{{ asset('/images/icons/barcode.png') }}" class="tabsolute tright-0 tp-2" style="height: auto;width: 49px;">
                    </div>
                    <div class="product tborder-b tflex tmx-1 trelative thidden tpy-1" id="hidden_product">
                        <div class="tw-4/6 tw-full tflex tflex-col tmr-2">
                            <div class="tflex titems-center tpy-1">
                                <img src="https://cf.shopee.ph/file/d8966eff56f6714d423e261828353033" class="product_img" style="height: 50px; width: 50px;" alt="">
                                <div class="tpx-2">
                                    <p class="product_title truncate ttext-sm">Matilda's Beauty Bleaching Soap 10x Whitening SoapMatilda's Beauty Bleaching Soap 10x Whitening Soap</p>
                                    <small class="product_sku">VS_AKL</small>
                                </div>
                            </div>
                        </div><!-- Product -->
                        <div class="tw-2/6 tflex tflex-col tjustify-center tmr-3">
                            <select class="condition browser-default form-control cursor: not-allowed;" style="padding: 6px;">
                                <option value="good">Good</option>
                                <option value="damaged">Damaged</option>
                            </select>
                        </div><!-- Price -->
                        <i class="closeItem hover:tunderline material-icons t-mr-4 tabsolute tcursor-pointer tmt-6 tright-0 ttext-error" style="top: -2px;">close</i>
                    </div>

                    @foreach ($rts->products as $products)
                        <div class="product tborder-b tflex tmx-1 trelative tpy-1" id="{{ $products->products[0]['id'] }}">
                            <div class="tw-4/6 tw-full tflex tflex-col tmr-2">
                                <div class="tflex titems-center tpy-1">
                                    <img src="{{ $products->products[0]['primary_image'] }}" class="product_img" style="height: 50px; width: 50px;" alt="">
                                    <div class="tpx-2">
                                        <p class="product_title truncate ttext-sm">{{ $products->products[0]['title'] }}</p>
                                        <small class="product_sku">{{ $products->products[0]['sku'] }}</small>
                                    </div>
                                </div>
                            </div><!-- Product -->
                            <div class="tw-2/6 tflex tflex-col tjustify-center tmr-3">
                                <select class="condition browser-default form-control cursor: not-allowed;" style="padding: 6px;">
                                    @if ($products->condition == 'good')
                                        <option value="good">Good</option>
                                    @else
                                        <option value="damaged">Damaged</option>
                                    @endif
                                </select>
                            </div><!-- Price -->
                            <i class="closeItem hover:tunderline material-icons t-mr-4 tabsolute tcursor-pointer tmt-6 tright-0 ttext-error" style="top: -2px;">close</i>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div><!-- Create Order -->
{{-- {{ dd($rts) }} --}}
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Package Information
        </div>
        <div class="tflex tpx-5">
            <div class="tw-1/4 tflex tflex-col tmr-3">
                <label for="status" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Status</label>
                <select id="status" class="browser-default form-control" style="padding: 6px;" >
                    <option value="complete" {{ $rts->status == 'complete'? 'selected':'' }}>Complete</option>
                    <option value="incomplete" {{ $rts->status == 'incomplete'? 'selected':'' }}>Incomplete</option>
                    <option value="request_a_refund" {{ $rts->status == 'request_a_refund'? 'selected':'' }}>Request for Refund</option>
                    <option value="refund_complete" {{ $rts->status == 'refund_complete'? 'selected':'' }}>Refund Complete</option>
                    <option value="refund_rejected" {{ $rts->status == 'refund_rejected'? 'selected':'' }}>Refund Rejected</option>
                </select>
            </div><!-- Status -->
            <div class="tw-1/4 tflex tflex-col tmr-3">
                <label for="platform" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Platform</label>
                <select id="platform" class="browser-default form-control" style="padding: 6px;" >
                    <option value="shopee"  {{ $rts->platform == 'shopee'? 'selected':'' }}>Shopee</option>
                    <option value="tiktok" {{ $rts->platform == 'tiktok'? 'selected':'' }}>Tiktok</option>
                    <option value="lazada" {{ $rts->platform == 'lazada'? 'selected':'' }}>Lazada</option>
                </select>
            </div><!-- Platform -->
            <div class="tw-1/4 tflex tflex-col tmr-3">
                <label for="courier" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Courier</label>
                <select id="courier" class="browser-default form-control" style="padding: 6px;" >
                    <option value="j&t" {{ $rts->courier == 'j&t'? 'selected':'' }}>J&T</option>
                    <option value="spx" {{ $rts->courier == 'spx'? 'selected':'' }}>Shopee Express</option>
                    <option value="lex" {{ $rts->courier == 'lex'? 'selected':'' }}>LEX/Lazada Express</option>
                    <option value="xde" {{ $rts->courier == 'xde'? 'selected':'' }}>XDE/XIMEX</option>
                    <option value="ninjavan" {{ $rts->courier == 'ninjavan'? 'selected':'' }}>Ninja Van</option>
                </select>
            </div><!-- Courier -->
            <div class="tw-1/4 tflex tflex-col">
                <label for="pouch_size" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Pouch Size</label>
                <select id="pouch_size" class="browser-default form-control" style="padding: 6px;" >
                    <option value="sm" {{ $rts->pouch_size == 'sm'? 'selected':'' }}>Small</option>
                    <option value="md" {{ $rts->pouch_size == 'md'? 'selected':'' }}>Medium</option>
                    <option value="lg" {{ $rts->pouch_size == 'lg'? 'selected':'' }}>Large</option>
                    <option value="xl" {{ $rts->pouch_size == 'xl'? 'selected':'' }}>XL</option>
                    <option value="xxl" {{ $rts->pouch_size == 'xxl'? 'selected':'' }}>XXL</option>
                    <option value="nopouch" {{ $rts->pouch_size == 'nopouch'? 'selected':'' }}>No Pouch</option>
                </select>
            </div><!-- Pouch Size -->
        </div>
        <div class="tw-full tpx-5 tmt-3">
            <textarea id="comment" class="browser-default form-control" style="padding: 6px;"  rows="1" maxlength="250">{{ $rts->comment }}</textarea>
        </div>
    </div><!-- Package Information -->

    <div class="tflex tjustify-end tpy-5 trounded-lg 100">
        <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn">Save</button>
    </div><!-- Save -->

    <!-- Modal Structure -->
    <div id="err_msg_modal" class="modal modal-fixed-footer">
        <div class="modal-content tbg-white">
            <div class="ttext-center tmb-5">
                <a class="btn-floating pulse tbg-red-500 hover:tbg-red-500"><i class="fas fa-exclamation"></i></a>
                <h4 class="ttext-lg">Ooops</h4>
            </div>
            <ul class="modal_err_msg">
            </ul>
        </div>
        <div class="modal-footer">
            <a href="#!" id class="modal-close waves-effect waves-light btn-flat ttext-white" style="background: #f65656;">Okay</a>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>

    <script>
        $('.modal').modal();// initiate modal
        $('.datepicker').datepicker();// initiate datepicker

        $('.add-search-product').click(function () {
            // Get All Data
            let id = $(this).attr('id');
            let img = $(this).find('.search-img').attr('src');
            let title = $(this).find('.search-title').html();
            let sku = $(this).find('.search-sku').html();

            let selected_product = $('#hidden_product').clone(true, true); // clone hidden product sample model
            selected_product.removeClass('thidden'); // remove hidden class

            // Fillout all fields
            selected_product.attr('id', id);// add ID
            selected_product.find('.product_img').attr('src', img);// add IMG
            selected_product.find('.product_title').html(title);// add ID
            selected_product.find('.product_sku').html(sku);// add SKU


            // Scroll to bottom
            $("#products_container").append(selected_product).animate({ scrollTop: 99999999999 }, 1);

        }) // Add product by search

        $('.closeItem').click(function () {
            $(this).parent().remove();
        })// Remove item

        function getAllProducts() {
            let products = [];

            $('#products_container').find('.product').each(function (i) {

                let product_id = $(this).attr('id');
                let condition = $(this).find('.condition').val();
              
                if (product_id != "hidden_product") {
                    products.push({
                        product_id: product_id,
                        condition: condition,
                    })
                }// if product is not the sample clone push
            });

            return products;
        }// get getAllProducts

        $('#transaction_id').change(function(){
            let search = $('#transaction_id').val();

            if (search.startsWith("MP")) {
                $('#platform option[value="lazada"]').prop('selected', true)
                $('#courier option[value="lex"]').prop('selected', true)
                // Lazada-PH-LEX PH
                // MP0599139654
            }

            if (search.startsWith("NLPHMP")) {
                $('#platform option[value="lazada"]').prop('selected', true)
                $('#courier option[value="ninjavan"]').prop('selected', true)
                // Lazada-PH-Ninja Van PH
                // NLPHMP0072555801
            }

            if (search.startsWith("XSM")) {
                $('#platform option[value="lazada"]').prop('selected', true)
                $('#courier option[value="xde"]').prop('selected', true)
                // Lazada-PH-Ximex Delivery Express
                // XSM000008131196
            }

            if (search.startsWith("8200")) {
                $('#platform option[value="lazada"]').prop('selected', true)
                $('#courier option[value="j&t"]').prop('selected', true)
                // Lazada-PH-J&T Express PH
                // 820047127024
            }
            
            if (search.startsWith("9712")) {
                $('#platform option[value="tiktok"]').prop('selected', true)
                $('#courier option[value="j&t"]').prop('selected', true)
                // TikTok-PH-J&T Express
                // 971202861030
            }

            if (search.startsWith("SPEPH")) {
                $('#platform option[value="shopee"]').prop('selected', true)
                $('#courier option[value="spx"]').prop('selected', true)
                // Shopee-PH-Shopee Xpress
                // SPEPH037962123347
            }
            
            if (search.startsWith("7867")) {
                $('#platform option[value="shopee"]').prop('selected', true)
                $('#courier option[value="j&t"]').prop('selected', true)
                // Shopee-PH-J&T Express
                // 786702672484
            }
        })

        $('#submit_btn').click(()=>{
                $('#submit_btn').attr('disabled', 'true');
                progress_loading(true);// show loader

                let products = getAllProducts();
  
                $.post( "/admin/rts/patch", {
                    'id': $('#id').val(),
                    'transaction_id': $('#transaction_id').val(),
                    'products': products,
                    'status': $('#status').val(),
                    'platform': $('#platform').val(),
                    'courier': $('#courier').val(),
                    'store': $('#store').val(),
                    'pouch_size': $('#pouch_size').val(),
                    'comment': $('#comment').val(),
                })
                .fail(function(response) {
                    $('#submit_btn').removeAttr('disabled');
                    progress_loading(false);// show loader

                    let errDecoded = JSON.parse(response.responseText);
                    let markup = '';

                    if (errDecoded.errors < 1) {
                        return;
                    }

                    $('#err_msg_modal').modal('open'); 
                    $.each(errDecoded.errors, function (key, val) {
                        markup +=   `<li class="tmb-3" style="color:#f65656;">
                                        <i class="fas fa-dot-circle tmr-3"></i>
                                        ${val}
                                    </li>`;

                    });
                    $('.modal_err_msg').html(markup);
                })
                .done(function( res ) {
                    $('#submit_btn').removeAttr('disabled');
                    progress_loading(false);// show loader

                    Swal.fire({
                        icon: 'success',
                        title: 'Awesome',
                        text: 'Added Successfuly',
                    });
                    location.reload();
                });
            })// Submit

    </script>

     {{-- Search --}}
    <script>
        function Search() {
          // Declare variables
          var input, filter, ul, li, a, i, txtValue;
          input = document.getElementById('search');
          filter = input.value.toUpperCase();
          ul = document.getElementById("products");
          li = ul.getElementsByTagName('li');
        
          // Loop through all list items, and hide those who don't match the search query
          for (i = 0; i < li.length; i++) {
            a = li[i].getElementsByTagName("a")[0];
            txtValue = a.textContent || a.innerText;
            if (txtValue.toUpperCase().indexOf(filter) > -1) {
              li[i].style.display = "";
            } else {
              li[i].style.display = "none";
            }
          }
        }
    </script>

@endsection