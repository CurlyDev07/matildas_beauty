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
          <input type="hidden" id="purchase_id" value="{{ request()->id }}">

        </div>
     
        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3" >
            <div class="tflex tpx-5 tmt-5 tpr-0">
                <div class="lg:tw-1/4 tborder-r tpr-2">

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
                                        <img src="{{ $product['primary_image'] }}" data-src="{{ $product['primary_image'] }}" class="search-img" style="height: 50px; width: 50px;" alt="">
                                        <div class="tpx-2 product-truncate" style="width: 157px;">
                                            <p class="search-title ttext-md" >{{ $product->title }}</p>
                                            <small class="search-sku">{{ $product->sku }}</small>
                                            <input type="hidden" class="search-price" value="{{ $product->selling_price }}">
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforeach
                    </ul><!-- Product Pick list -->

                </div>
                <div id="products_container" class="lg:tw-3/4 tborder-l tpl-2 toverflow-scroll toverflow-x-hidden" style="height: 450px">
                    <div class="product tborder-b tflex tmx-1 trelative thidden tpy-1" id="hidden_product">
                        <div class="tw-full tflex tflex-col tmr-2">
                            <div class="tflex titems-center tpy-1">
                                <img src="https://cf.shopee.ph/file/d8966eff56f6714d423e261828353033" class="product_img" style="height: 50px; width: 50px;" alt="">
                                <div class="tpx-2 product-truncate" >
                                    <p class="product_title ttext-sm" style="width: 157px;">Matilda's Beauty Bleaching Soap 10x Whitening SoapMatilda's Beauty Bleaching Soap 10x Whitening Soap</p>
                                    <small class="product_sku" style="width: 157px;">VS_AKL</small>
                                </div>
                            </div>
                        </div><!-- Product -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Prices</label>
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
                        {{-- <i class="fas fa-plus-circle"></i>
                        <i class="fas fa-plus-circle hover:tunderline material-icons t-mr-4 tabsolute ttop-0 tcursor-pointer tmt-6 tooltipped tright-0 ttext-green-700"></i>
                        <i class="fas fa-plus-circle hover:tunderline material-icons t-mr-4 tabsolute ttop-0 tcursor-pointer tmt-6 tooltipped tright-0 ttext-green-700"></i> --}}
                    </div><!-- Test -->
                    
                    @foreach ($purchase->purchase_product as $purchase_product)
                     {{-- {{ dd($purchase_product) }} --}}

                        <div class="product tborder-b-2 tborder-gray-500 tborder-dashed tflex titems-center tmx-1 tpt-1 tpb-3 trelative  tflex-wrap" id="{{ $purchase_product->product['id'] }}">
                            <div class="tw-full tflex tflex-col">
                                <div class="tflex titems-center tpy-1">
                                    <img src="{{ $purchase_product->product['primary_image'] }}" class="product_img" style="height: 50px; width: 50px;" alt="">
                                    <div class="tpx-2 truncate">
                                        <p class="product_title ttext-sm" >{{ $purchase_product->product['title'] }}</p>
                                        <small class="product_sku">{{ $purchase_product->product['sku'] }}</small>
                                    </div>
                                </div>
                            </div><!-- Product -->

                            <div class="tw-1/2 lg:tw-2/12 tflex tflex-col tpx-1 tmb-2 lg:tmb-0">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active tmt-1 tmr-2">Expiration: </label>
                                <input type="text" class="expiration_date browser-default form-control" value="{{ date_f($purchase_product->expiration_date ?? "Jan 01, 2020", "M d, Y") }}">
                            </div><!-- Expiration Date -->

                            <div class="tw-1/2 lg:tw-1/12 tflex tflex-col tpx-1 tmb-2 lg:tmb-0">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Price</label>
                                <input type="text" onkeyup="allnumeric(this)" value="{{ $purchase_product['price'] }}" class="product_price browser-default form-control cursor: not-allowed;" style="padding: 6px;">
                            </div><!-- Price -->

                            <div class="tw-1/2 lg:tw-1/12 tflex tflex-col tpx-1 tmb-2 lg:tmb-0">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Quantity</label>

                                @if ($purchase_product->received == 'yes')
                                    {{-- <span class="browser-default form-control cursor: not-allowed;" style="background: #f9f9f9; cursor: not-allowed;">{{ $purchase_product['qty']?? 1 }}</span> --}}

                                    <input type="number" onkeyup="allnumeric(this)" value="{{ $purchase_product['qty'] ?? 1 }}" class="product_quantity browser-default form-control tcursor-not-allowed" disabled style="padding: 6px; background-color: #ddcccc6b;">
                                @else
                                    <input type="number" onkeyup="allnumeric(this)" value="{{ $purchase_product['qty'] }}" class="product_quantity browser-default form-control" style="padding: 6px;">
                                @endif

                            </div><!-- QTY -->
                            <div class="tw-1/2 lg:tw-1/12 tflex tflex-col tpx-1 tmb-2 lg:tmb-0">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Subtotal</label>
                                <input type="text" onkeyup="allnumeric(this)" disabled="" value="{{ $purchase_product->sub_total }}" class="product_subtotal tcursor-pointer browser-default form-control" style="padding: 6px;background: #f9f9f9; cursor: not-allowed;">
                            </div><!-- Sub Total -->

                            {{-- <div class="tborder-l tmr-3"></div> --}}

                            <div class="tw-1/2 lg:tw-2/12 tflex tflex-col tpx-1 tmb-2 lg:tmb-0">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active"> Received? </label>
                                <select 
                                    @if ($purchase_product->received == 'yes' && $purchase_product['received_qty'] >= $purchase_product['qty'])
                                        {{-- If received status == 'yes' and If the purchase qty is equal to purchase qty --}}
                                        {{ 'disabled' }}
                                    @endif
                                class="product_received tcursor-pointer browser-default form-control" style="padding: 6px;">
        
                                    @foreach ($receive_status as $status)
                                        <option value="{{ $status }}" class=""
                                        @if ($purchase_product->received == $status)
                                            {{ 'selected' }}
                                        @endif
                                        >{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div><!-- Received Status -->

                            <div class="tw-1/2 lg:tw-2/12 tflex tflex-col tpx-1 tmb-2 lg:tmb-0 lg:tmr-1 ">
                                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">R_QTY</label>
                                <input 

                                @if ($purchase_product->received == 'yes' && $purchase_product['received_qty'] >= $purchase_product['qty'])
                                    {{-- If received status == 'yes' and If the purchase qty is equal to purchase qty --}}
                                    {{ 'disabled' }}
                                    style="padding: 6px; background: #f9f9f9;"
                                    class="product_received_qty tcursor-not-allowed browser-default form-control"
                                @elseif($purchase_product->received == 'no')
                                    {{ 'disabled' }}
                                    style="padding: 6px; background: #f9f9f9;"
                                    class="product_received_qty tcursor-not-allowed browser-default form-control"
                                @else
                                    style="padding: 6px; background: #ffffff;"
                                    class="product_received_qty browser-default form-control"
                                @endif


                                type="number" onkeyup="allnumeric(this)" value="{{ $purchase_product['received_qty'] }}" >
                            </div><!-- Recieved QTY -->
      
                            {{------------BUTTONS---------- --}}


                            @if ($purchase_product->received != 'yes')

                                {{-- REFLECT STOCKS BUTTON --}}
                                <button 
                                    @if ($purchase_product->received == 'incomplete')
                                        class="tmr-3 lg:tmr-1 tpx-1 tmb-2 lg:tmb-0 hover:tunderline tcursor-pointer tooltipped reflect-stocks focus:tbg-green-500 tbg-green-500 tpx-3 tpy-2 ttext-white trounded mr-1"
                                    @else
                                        class="tmr-3 lg:tmr-1 tpx-1 tmb-2 lg:tmb-0 thidden hover:tunderline tcursor-pointer tooltipped reflect-stocks focus:tbg-green-500 tbg-green-500 tpx-3 tpy-2 ttext-white trounded mr-1"
                                    @endif
                                    
                                    {{-- style="top: -28%;"  --}}
                                    {{-- data-position="right"  --}}
                                    data-tooltip="Reflect Stocks to Inventory"
                                    purchase_product_id="{{ $purchase_product->id }}"
                                    product_id="{{ $purchase_product->product['id'] }}">
                                    StockIn
                                </button>


                                {{-- REMOVE BUTTON --}}
                                <button class="tpx-1 tmb-2 lg:tmb-0 closeItem focus:tbg-red-500 tbg-red tbg-red-500 tpx-3 tpy-2 trounded ttext-white tooltipped" data-position="right" data-tooltip="Remove Product">Remove</button>
                            @endif <!-- if purchase product is added to stocks. Cannot remove it anymore --> 
                            {{------------BUTTONS---------- --}}

                         
                        </div>
                      
                    @endforeach
                </div>
            </div>
        </div>
    </div><!-- Create Order -->


    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Transaction
        </div>

        <div class="tflex tpx-5 tmt-5">
            <div class="tw-1/5 tmr-3">
                <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Date <small class="ttext-gray-600"> (Date of purchased)</small></label>
                <input type="text" class="datepicker browser-default form-control" value="{{ date_f($purchase->date, 'M d, Y') }}">
            </div><!-- Date -->
            <div class="tw-2/5 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Shipping Fee <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                <input type="text" class="shipping_fee tcursor-pointer browser-default form-control" value="{{ ($purchase->shipping_fee) }}"> 
            </div><!-- Shipping Fee -->
            
            <div class="tw-2/5 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Transaction Fee <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                <input type="text" class="transaction_fee tcursor-pointer browser-default form-control" value="{{ ($purchase->transaction_fee) }}">
            </div><!-- Transaction Fee -->
        </div>

        <div class="tflex tpx-5 tmt-5">
            <div class="tw-1/2 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Tax <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                <input type="text" class="tax tcursor-pointer browser-default form-control" value="{{ ($purchase->tax) }}">
            </div><!-- Tax -->

            <div class="tw-1/2 tmr-2">
                <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Supplier </label>
                <select class="supplier tcursor-pointer browser-default form-control" style="padding: 6px;">
                    <option value="" data-price="" selected="">Choose supplier ...</option>
                    @foreach ($suppliers as $supplier)
                        <option value="{{ $supplier['id'] }}"

                        @if ($supplier['id'] == $purchase->supplier)
                            {{ 'selected' }}
                        @endif

                        >{{ $supplier['name'] }} {{ $supplier['surname'] }}</option>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('.modal').modal();// initiate modal
        $('.datepicker').datepicker();// initiate datepicker
        $('.expiration_date').datepicker();// initiate datepicker
        getTotal(); // Display Saved 

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
            let self = $(this);
            $(this).parent().fadeOut('slow', function () {
                self.parent().remove();
            })
            getTotal();
        })// Remove item

        function getAllProducts() {
            let products = [];

            $('#products_container').children().each(function (i) {

                let product_id = $(this).attr('id');
                let price = $(this).find('.product_price').val();
                let qty = $(this).find('.product_quantity').val();
                let subtotal = $(this).find('.product_subtotal').val();
                let received = $(this).find('.product_received').val();
                let received_qty = $(this).find('.product_received_qty').val();
                let expiration_date = $(this).find('.expiration_date').val()?? 'Jan 01, 2020';

                if (i != 0) {
                    products.push({
                        product_id: product_id,
                        price: price,
                        qty: qty,
                        sub_total: subtotal,
                        received: received,
                        received_qty: received_qty,
                        expiration_date: formatDate(expiration_date),
                    })
                }// if product is not the sample clone push
            });

            return products;
        }// get getAllProducts

        function orderReceived() {
            let order_recieved = [];

            $('#products_received_container').children().each(function (i) {
            let received_product_id = $(this).find('.received_product_id').val();
            let received_product_quantity = $(this).find('.received_product_quantity').val();
            let received_status = $(this).find('.received_status').val();

                order_recieved.push({
                    received_product_id: received_product_id,
                    received_product_quantity: received_product_quantity,
                    received_status: received_status,
                })
            });

            return order_recieved;
        }

        $('#submit_btn').click(()=>{


            let stockIn = $('.reflect-stocks:not(.thidden)').length;

            if (stockIn != 0) {
                $( ".reflect-stocks:not(.thidden)" ).each(function( index ) {
                    $(this).click();
                });

                console.log(stockIn);
                return;
            }

           

       

            $('#submit_btn').attr('disabled', 'true');
            progress_loading(true);// show loader

            let products = getAllProducts();

            // console.log(products);
            // return;

            $.post( "/admin/purchase/patch", {
                'purchase_id': $('#purchase_id').val(),
                'products': products,
                'total_price': $('#total').html(),
                'total_qty': $('#total_items').html(),
                'supplier': $('.supplier').val(),
                'shipping_fee': $('.shipping_fee').val(),
                'transaction_fee': $('.transaction_fee').val(),
                'tax': $('.tax').val(),
                'order_recieved': orderReceived(),
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


        $('.product_received').change(function () {
            let received = $(this).val();

            if (received == 'yes' || received == 'incomplete') {
                let rqty = $(this).parent().next().children().last();
                rqty.removeAttr('disabled'); // remove R-QTY disabled
                rqty.removeClass('tcursor-not-allowed');// remove cursur disabled
                rqty.css("background-color", "#ffffff");// remove bg-gray 
                let reflectStock = $(this).parent().next().next().removeClass('thidden ');// Show reflect stocks button

                if (received == 'yes') {// If received == yes. RQTY = QTY
                    let purchase_qty = $(this).parent().prev().prev().children().last().val();
                    $(this).parent().next().children().last().val(purchase_qty);

                    rqty.attr('disabled', true); // remove R-QTY disabled
                    rqty.addClass('tcursor-not-allowed');// remove cursur disabled
                    rqty.css("background-color", "#f9f9f9");// remove bg-gray 

                }else{
                    $(this).parent().next().children().last().val(0);// remove RQTY QTY
                }
                
            }else{
                let rqty = $(this).parent().next().children().last();
                rqty.attr('disabled', 'true');
                rqty.addClass('tcursor-not-allowed');// remove cursur disabled
                rqty.css("background-color", "#f9f9f9");// remove bg-gray 
                let reflectStock = $(this).parent().next().next().addClass('thidden ');// Show reflect stocks button

                $(this).parent().next().children().last().val(0);// remove RQTY QTY
            }


        });

        $('.reflect-stocks').click(function(){
            let self = $(this);
            
            Swal.fire({
                title: 'Reflect to Stocks?',
                html:
                "Add this purchase quantity to current product stocks.</br>" +
                "<small class='tfont-medium ttext-error'>You won't be able to revert this!</small>",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes'
            }).then((result) => {
                if (result.isConfirmed) {
                    let purchase_product_id = self.attr('purchase_product_id');
                    let product_id = self.attr('product_id');
                    let received_qty = self.prev().children().last().val();
                    let received = self.prev().prev().children().last().val();

                    $.ajax({
                        url: '/admin/purchase/reflect-stocks',
                        type: 'POST',
                        data: {
                            purchase_product_id: purchase_product_id,
                            product_id: product_id,
                            received_qty: received_qty,
                            received: received
                        },
                        success: ()=>{

                            Swal.fire({
                                position: "middle",
                                icon: "success",
                                title: "The item has been successfully added to our inventory stocks",
                                showConfirmButton: false,
                                timer: 700
                            });

                            // Dissabled Price Because Stocks is Already added 
                            self.parent().find('.product_quantity').attr('disabled', true)
                            self.parent().find('.product_quantity').css("background-color", "#f9f9f9");
                            self.parent().find('.product_quantity').css("cursor", "not-allowed");

                            // Dissabled Price Because Stocks is Already added 
                            self.parent().find('.product_received_qty').attr('disabled', true)
                            self.parent().find('.product_received_qty').css("background-color", "#f9f9f9");
                            self.parent().find('.product_received_qty').css("cursor", "not-allowed");


                            self.next().remove();// Remove X Button
                            self.remove(); // Remove Reflect Stocks once Click
                        }
                    });// update via Ajax request
                }
            })// swal

            

        });// Reflect Stocks

    </script>


    <script> // date Converter
        function formatDate(date) {
            var d = new Date(date),
                month = '' + (d.getMonth() + 1),
                day = '' + d.getDate(),
                year = d.getFullYear();

            if (month.length < 2) 
                month = '0' + month;
            if (day.length < 2) 
                day = '0' + day;

            return [year, month, day].join('-');
        }
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