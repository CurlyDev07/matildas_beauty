@extends('admin.lab.layouts')

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
                Formulation / Create
            </div>
            <div class="tflex titems-center tjustify-end tmx-5 tpr-3 tpy-3">
                <div class="tpr-5 tborder-r"><small class="ttext-gray-500"><span id="total_items">0</span> item(s)</small> TOTAL</div>
                <div class="tpx-6 tfont-medium" style="font-size: 24px;color: black;">₱<span id="total">0</span> </div>
            </div>
        </div>

        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Transaction
        </div>
        <div class="tflex tpx-5">
            <div class="tw-2/5 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Product Name </label>
                <input type="text" value="{{ $formulations->product_name }}" class="product_name tcursor-pointer browser-default form-control">
            </div><!-- Product Name -->
            <div class="tw-2/5 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Net Content ( grams/ml )</label>
                <input type="text" value="{{ $formulations->net_content }}" class="net_content tcursor-pointer browser-default form-control">
            </div><!-- Net Content -->
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
                        @foreach ($ingredients as $ingredient)
                            <li>
                                <a href="javascript:void(0)" class="add-search-product" id="{{ $ingredient->id }}" aria-disabled="true">
                                    <div class="tflex titems-center tpy-1">
                                        <img src="https://myfoodsafety.net/wp-content/uploads/2020/03/RAW-MATERIALS-SMALL.png" class="search-img" style="height: 50px; width: 50px;" alt="">

                                        <div class="tpx-2">
                                            <p class="search-name ttext-md">{{ $ingredient->name }}</p>
                                            <input type="hidden" class="search-price" value="{{ $ingredient->price }}">
                                            <input type="hidden" class="search-weight" value="{{ $ingredient->weight }}">
                                            <input type="hidden" class="search-price_per_grams" value="{{ $ingredient->price_per_grams }}">
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul>

                </div>
                   
                <div id="products_container" class="tw-3/5 tborder-l tpl-2 toverflow-scroll toverflow-x-hidden tpr-6" style="height: 450px">
                    <div class="product tborder-b tflex tmx-1 trelative thidden tpy-1" id="hidden_product">
                        <div class="tw-1/3 tw-full tflex tflex-col tmr-2">
                            <div class="tflex titems-center tpy-1">
                                <img src="https://myfoodsafety.net/wp-content/uploads/2020/03/RAW-MATERIALS-SMALL.png" class="product_img" style="height: 50px; width: 50px;" alt="">
                                <div class="tpx-2">
                                    <p class="product_name truncate ttext-sm ">Matilda's Beauty Bleaching Soap 10x Whitening SoapMatilda's Beauty Bleaching Soap 10x Whitening Soap</p>
                                    <small>
                                        ₱
                                        <small class="product_price_per_grams">0</small>
                                    </small>
                                </div>
                            </div>
                        </div><!-- Product -->
                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Percentage</label>
                            <input type="number" value="1" class="product_percentage browser-default form-control" style="padding: 6px;">
                        </div><!-- QTY -->
                      
                        <i class="closeItem hover:tunderline material-icons t-mr-4 tabsolute tcursor-pointer tmt-6 tright-0 ttext-error">close</i>
                    </div>

                    @foreach ($formulations->formulationIngredients as $ingredient)
                        <div class="product tborder-b tflex tmx-1 trelative tpy-1" id="{{ $ingredient->ingredient_id }}">
                            <div class="tw-1/3 tw-full tflex tflex-col tmr-2">
                                <div class="tflex titems-center tpy-1">
                                    <img src="https://myfoodsafety.net/wp-content/uploads/2020/03/RAW-MATERIALS-SMALL.png" class="product_img" style="height: 50px; width: 50px;" alt="">
                                    <div class="tpx-2">
                                        <p class="product_name truncate ttext-sm ">{{ $ingredient->ingredient->name }}</p>
                                        <small>
                                            ₱
                                            <small class="product_price_per_grams">{{ $ingredient->ingredient->price_per_grams }}</small>
                                        </small>
                                    </div>
                                </div>
                            </div><!-- Product -->
                            <div class="tw-1/3 tflex tflex-col tmr-3">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Percentage</label>
                                <input type="number" value="{{ $ingredient->percentage }}" class="product_percentage browser-default form-control" style="padding: 6px;">
                            </div><!-- QTY -->
                        
                            <i class="closeItem hover:tunderline material-icons t-mr-4 tabsolute tcursor-pointer tmt-6 tright-0 ttext-error">close</i>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div><!-- Create Order -->



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
            let batch = parseFloat($("#batch").val());
            let id = $(this).attr('id');
            let name = $(this).find('.search-name').html();

            let selected_product = $('#hidden_product').clone(true, true); // clone hidden product sample model
            selected_product.removeClass('thidden'); // remove hidden class

            // Fillout all fields
            selected_product.attr('id', id);// add ID
            selected_product.find('.product_name').html(name);// add ID

            // Scroll to bottom
            height += 62;
            // $('#products_container').append(selected_product).animate({ scrollTop: height }, height);

            $("#products_container").append(selected_product).animate({ scrollTop: 99999999999 }, 1);

            getTotal();
        }) // Add product by search

        $('.product_percentage').change(function () {
            let price = $(this).parent().parent().find('.product_price').val();
            let qty = $(this).parent().parent().find('.product_percentage').val();
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
            let qty = parent.find('.product_percentage').val();
            let subtotal = parent.find('.product_subtotal');

            subtotal.val(price * qty);
        }// Change Sub Total

        function getTotal() {
            let subtotal = 0;
            let quantity = 0;

            $('.product_subtotal').each(function () {

                subtotal += parseInt($(this).val());
            });
            $('.product_percentage').each(function () {
                quantity += parseInt($(this).val());
            });

            $('#total').html(numberWithCommas(subtotal));
            $('#total_items').html(numberWithCommas(quantity - 1));
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
                let weight = $(this).find('.product_weight').val();
                let percentage = $(this).find('.product_percentage').val();
                let subtotal = $(this).find('.product_subtotal').val();

                if (i != 0) {
                    products.push({
                        ingredient_id: product_id,
                        price: price,
                        weight: weight,
                        percentage: percentage,
                        sub_total: subtotal,
                    })
                }// if product is not the sample clone push
            });

            return products;
        }// get getAllProducts


        $('#submit_btn').click(()=>{
                $('#submit_btn').attr('disabled', 'true');
                progress_loading(true);// show loader

                let ingredients = getAllProducts();
                let formulation_id = @json(request()->id);
                console.log(formulation_id);

                $.post( "/admin/lab/formulations/patch", {
                    'ingredients': ingredients,
                    'product_name': $('.product_name').val(),
                    'net_content': $('.net_content').val(),
                    'formulation_id': formulation_id,
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
                        title: 'Update Successful',
                        text: 'Update Successfuly',
                    });

                    setTimeout(() => {
                        location.reload();
                    }, 1000); // 2 seconds

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