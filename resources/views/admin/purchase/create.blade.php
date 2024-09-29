@extends('admin.purchase.layouts')

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
            background-image: url('/css/searchicon.png'); /* Add a search icon to input */
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


                    <ul id="products" style="height: 400px" class="toverflow-scroll toverflow-x-hidden">
                        @foreach ($products as $product)
                            <li>
                                <a href="javascript:void(0)" class="add-search-product" id="{{ $product->id }}" aria-disabled="true">
                                    <div class="tflex titems-center tpy-1">
                                        <img data-src="{{ $product['primary_image'] }}" class="search-img lazy" style="height: 50px; width: 50px;" alt="">
                                        <div class="tpx-2">
                                            <p class="search-title ttext-md">{{ $product->title }}</p>
                                            <small class="search-sku">{{ $product->sku }}</small>
                                            <input type="hidden" class="search-price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                   
                <div id="products_container" class="tw-3/5 tborder-l tpl-2 toverflow-scroll toverflow-x-hidden tpr-6" style="height: 450px">
                    <div class="product tborder-b tflex tmx-1 trelative thidden tpy-1" id="hidden_product">
                        <div class="tw-3/6 tw-full tflex tflex-col tmr-2">
                            <div class="tflex titems-center tpy-1">
                                <img src="https://cf.shopee.ph/file/d8966eff56f6714d423e261828353033" class="product_img" style="height: 50px; width: 50px;" alt="">
                                <div class="tpx-2">
                                    <p class="product_title truncate ttext-sm ">Matilda's Beauty Bleaching Soap 10x Whitening SoapMatilda's Beauty Bleaching Soap 10x Whitening Soap</p>
                                    <small class="product_sku">VS_AKL</small>
                                </div>
                            </div>
                        </div><!-- Product -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Price</label>
                            <input type="text" onkeyup="allnumeric(this)" value="0" class="product_price browser-default form-control cursor: not-allowed;" style="padding: 6px;">
                        </div><!-- Price -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Quantity</label>
                            <input type="number" onkeyup="allnumeric(this)" value="0" class="product_quantity browser-default form-control" style="padding: 6px;">
                        </div><!-- QTY -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Subtotal</label>
                            <input type="text" onkeyup="allnumeric(this)" disabled="" value="0" class="product_subtotal tcursor-pointer browser-default form-control" style="padding: 6px;background: #f9f9f9; cursor: not-allowed;">
                        </div><!-- Sub Total -->
                        <i class="closeItem hover:tunderline material-icons t-mr-4 tabsolute tcursor-pointer tmt-6 tright-0 ttext-error">close</i>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- Create Order -->

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Transaction
        </div>
        {{-- <div class="tflex tpx-5">
            <div class="tw-2/5 tflex tflex-col tmr-3 thidden">
                <label for="sold_from" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Shipping Fee (Optional, You can add this later.)</label>
                <select name="" id="sold_from" class="tcursor-pointer browser-default form-control" style="padding: 6px;">
                    @foreach ($sold_from as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div><!-- thidden-->
            <div class="tw-2/5 tflex tflex-col tmr-3 thidden">
                <label for="payment_method" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Payment method</label>
                <select name="" id="payment_method" class="tcursor-pointer browser-default form-control" style="padding: 6px;">
                    @foreach ($payment_method as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div><!-- thidden-->
            <div class="tw-1/5 tflex tflex-col tmr-3">
                <label for="package_qty" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Package Qty</label>
                <input type="number" id="package_qty" class="browser-default form-control" style="padding: 6px;" >
            </div><!-- package Qty -->
            <div class="tw-1/5 tflex tflex-col tmr-3">
                <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Date</label>
                <input type="text" class="datepicker browser-default form-control">
            </div>
        </div> --}}

        <div class="tflex tpx-5 tmt-5">
            <div class="tw-1/5 tmr-3">
                <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Date <small class="ttext-gray-600"> (Date of purchased)</small></label>
                <input type="text" class="datepicker browser-default form-control" value="">
            </div><!-- Date -->
            <div class="tw-2/5 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Shipping Fee <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                <input type="text" class="shipping_fee tcursor-pointer browser-default form-control">
            </div><!-- Shipping Fee -->
            
            <div class="tw-2/5 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Transaction Fee <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                <input type="text" class="transaction_fee tcursor-pointer browser-default form-control">
            </div><!-- Transaction Fee -->
        </div>

        <div class="tflex tpx-5 tmt-5">
            <div class="tw-1/2 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Tax <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                <input type="text" class="tax tcursor-pointer browser-default form-control">
            </div><!-- Tax -->

            <div class="tw-1/2 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Suppliers </label>
                <select class="supplier tcursor-pointer browser-default form-control" style="padding: 6px;">
                    <option value="" data-price="" selected="">Choose supplier ...</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier['id'] }}" >{{ $supplier['name'] }} {{ $supplier['surname'] }}</option>
                    @endforeach
                </select>
            </div><!-- suppliers -->
        </div>
        
    </div><!-- Transaction -->

    <div class="tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
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
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>

    <script>
        $('.modal').modal();// initiate modal
        $('.datepicker').datepicker();// initiate datepicker


        let height = 478;
        $('.add-search-product').click(function () {

            $('#search').val('');

            // Get All Data
            let id = $(this).attr('id');
            let img = $(this).find('.search-img').attr('src');
            let title = $(this).find('.search-title').html();
            let sku = $(this).find('.search-sku').html();
            let price = $(this).find('.search-price').val();

            let selected_product = $('#hidden_product').clone(true, true); // clone hidden product sample model
            selected_product.removeClass('thidden'); // remove hidden class

            // Get Last product QTY
            let last_product_qty = $("#products_container").children().last().find('.product_quantity').val();


            // Fillout all fields
            selected_product.attr('id', id);// add ID
            selected_product.find('.product_img').attr('src', img);// add IMG
            selected_product.find('.product_title').html(title);// add ID
            selected_product.find('.product_sku').html(sku);// add SKU
            selected_product.find('.product_price').val(price);// add Price
            selected_product.find('.product_quantity').val(last_product_qty);// add QTY
            selected_product.find('.product_subtotal').val(price);// add product_subtotal


            // Scroll to bottom
            height += 62;
            // $('#products_container').append(selected_product).animate({ scrollTop: height }, height);

            $("#products_container").append(selected_product).animate({ scrollTop: 99999999999 }, 1);

            getTotal();
        }) // Add product by search

        $('.product_quantity').change(function () {
            let price = $(this).parent().parent().find('.product_price').val();
            let qty = $(this).parent().parent().find('.product_quantity').val();
            let subtotal = $(this).parent().parent().find('.product_subtotal');

            subtotal.val(price * qty);

            changeSubtotal($(this).parent().parent());
            getTotal();
        });// On Change Qty

        $('.product_price').change(function () {
            changeSubtotal($(this).parent().parent());
            getTotal();
        });// On Change Price

        function changeSubtotal(parent) {
            let price = parent.find('.product_price').val();
            let qty = parent.find('.product_quantity').val();
            let subtotal = parent.find('.product_subtotal');

            subtotal.val(price * qty);
        }// Change Sub Total

        function getTotal() {
            let subtotal = 0;
            let quantity = 0;

            $('.product_subtotal').each(function () {

                subtotal += parseInt($(this).val());
            });
            $('.product_quantity').each(function () {
                quantity += parseInt($(this).val());
            });

            $('#total').html(numberWithCommas(subtotal));
            $('#total_items').html(numberWithCommas(quantity));
        }// Get Total

        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }// numberWithCommas

        $('.closeItem').click(function () {
            $(this).parent().remove();
            getTotal();
        })// Remove item

        function getAllProducts() {
            let products = [];

            $('#products_container').children().each(function (i) {

                let product_id = $(this).attr('id');
                let price = $(this).find('.product_price').val();
                let qty = $(this).find('.product_quantity').val();
                let subtotal = $(this).find('.product_subtotal').val();

                if (i != 0) {
                    products.push({
                        product_id: product_id,
                        price: price,
                        qty: qty,
                        sub_total: subtotal,
                    })
                }// if product is not the sample clone push
            });

            return products;
        }// get getAllProducts


        $('#submit_btn').click(()=>{
                $('#submit_btn').attr('disabled', 'true');
                progress_loading(true);// show loader

                let products = getAllProducts();

                $.post( "/admin/purchase/store", {
                    'products': products,
                    'total_price': $('#total').html(),
                    'total_qty': $('#total_items').html(),
                    'supplier': $('.supplier').val(),
                    'shipping_fee': $('.shipping_fee').val(),
                    'transaction_fee': $('.transaction_fee').val(),
                    'tax': $('.tax').val(),
                    'date': $('.datepicker').val(),
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
                    location.href = '/admin/purchase';
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