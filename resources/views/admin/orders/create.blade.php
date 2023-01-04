@extends('admin.orders.layouts')

@section('css')
    <style>
        .autocomplete-content img {
            display: none;
        }
        .modal .modal-content {
            height: 50vh;
        }
    </style>
@endsection

@section('page')



{{-- --------------------------------- --}}
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
            Create Order
        </div>
        <div class="text-sm tfont-medium tpx-5 tpt-4 tpt-2 t ttext-title">
            Product
        </div>
        <div id="items">
            <div class="item trelative">
                <i class="closeItem material-icons hover:tunderline tabsolute tcursor-pointer tmr-6 tmt-2 tright-0 ttext-error thidden">close</i>
                <div class="tborder-b tflex tmx-5 tpy-3">
                    <div class="tw-3/6 tw-full tflex tflex-col tmr-2">
                        <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Item </label>
                        <select class="product tcursor-pointer browser-default form-control" style="padding: 6px;">
                            <option value="" data-price="" selected>Choose product ...</option>
                            @foreach ($products as $product)
                            {{ ($product->selling_price) }}
                                <option value="{{ $product->id }}" data-price="{{ $product->selling_price }}">{{ $product->title }}</option>
                            @endforeach
                        </select>
                    </div><!-- Product -->
                    <div class="tw-1/6 tflex tflex-col tmr-3">
                        <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Price</label>
                        <input type="text" onkeyup="allnumeric(this)" disabled value="0" class="price browser-default form-control cursor: not-allowed;" style="padding: 6px;">
                    </div><!-- Price -->
                    <div class="tw-1/6 tflex tflex-col tmr-3">
                        <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Quantity</label>
                        <input type="number" onkeyup="allnumeric(this)" value="1" class="quantity browser-default form-control" style="padding: 6px;">
                        {{-- <select name="" class="quantity tcursor-pointer browser-default form-control" style="padding: 6px;">
                            @for ($qty = 1; $qty < 50; $qty++)
                                <option value="{{ $qty }}">{{ $qty }}</option>
                            @endfor
                        </select> --}}
                    </div><!-- QTY -->
                    <div class="tw-1/6 tflex tflex-col tmr-3">
                        <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Subtotal</label>
                        <input type="text" disabled class="subtotal tcursor-pointer browser-default form-control" style="padding: 6px;background: #f9f9f9; cursor: not-allowed;">
                    </div><!-- Sub Total -->
                </div>
            </div><!-- Items -->
        </div><!-- Items Container -->
        <div class="tflex titems-center tjustify-end tmx-5 tpr-3 tpy-3">
            <div class="tpr-5 tborder-r"><small class="ttext-gray-500"><span id="total_items">1</span> item(s)</small> TOTAL</div>
            <div class="tpx-6" style="font-size: 24px;">₱<span id="total">0</span> </div>
            
        </div><!-- TOTAL -->
        <div class="tflex tmx-5 tpy-3 tjustify-end">
            <button id="add_item" class="focus:tbg-gray-100 focus:toutline-none hover:tbg-gray-100 tbg-white tshadow-md tborder tpx-6 tpy-2 trounded ttext-black-100 ttext-sm waves-effect">
                Add product
            </button>
        </div><!-- Add Items -->
    </div><!-- Create Order -->

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Transaction
        </div>
        <div class="tflex tpx-5">
            <div class="tw-2/5 tflex tflex-col tmr-3">
                <label for="sold_from" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Sold from</label>
                <select name="" id="sold_from" class="tcursor-pointer browser-default form-control" style="padding: 6px;">
                    @foreach ($sold_from as $item)
                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
                </select>
            </div>
            <div class="tw-2/5 tflex tflex-col tmr-3">
                <label for="payment_method" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Payment method</label>
                <select name="" id="payment_method" class="tcursor-pointer browser-default form-control" style="padding: 6px;">
                    @foreach ($payment_method as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="tw-1/5 tflex tflex-col tmr-3">
                <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Date</label>
                <input type="text" class="datepicker browser-default form-control">
            </div>
        </div>
    </div><!-- Transaction -->

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Customer Information
        </div>
        <div class="tflex tpx-5">
            <div class="tw-1/3 tflex tflex-col tmr-3">
                <label for="first_name" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Name</label>
                <input type="text" id="first_name" value="Picklist" class="browser-default form-control" style="padding: 6px;">
            </div><!-- Name -->
            <div class="tw-1/3 tflex tflex-col tmr-3">
                <label for="last_name" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Surname</label>
                <input type="text" id="last_name" class="browser-default form-control" style="padding: 6px;">
            </div><!-- Surname -->
            <div class="tw-1/3 tflex tflex-col tmr-3">
                <label for="phone_number" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Phone number</label>
                <input type="text" onkeyup="allnumeric(this)" id="phone_number" class="browser-default form-control" style="padding: 6px;">
            </div><!-- Phone number -->
        </div>
        <div class="tflex tpx-5 tmt-3">
            <div class="tw-full tflex tflex-col tmr-3">
                <label for="address" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Address</label>
                <input type="text" id="address" class="browser-default form-control" style="padding: 6px;">
            </div><!-- Address -->
        </div>
        <div class="tflex tpx-5 tmt-3">
            <div class="tw-full tflex tflex-col tmr-3">
                <label for="fb_link" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Facebook_link</label>
                <input type="text" id="fb_link" class="browser-default form-control" style="padding: 6px;">
            </div><!-- FB LINK -->
        </div>

    </div><!-- Customer Information -->

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
    <script>
            
        $(document).ready(function(){
            $('.modal').modal();// initiate modal
            $('.datepicker').datepicker();// initiate datepicker


            // On Change Product
            $('.product').change(function(){
                let self = $(this).find(":selected")
                let id = self.val(); //get product id
                let price = self.data('price'); //get product id

                // update price
                $(this).parent().next().find('.price').val(price);

                changeSubtotal($(this).parent().parent());
                getTotal();
            });

            // On Change Quantity
            $('.quantity').change(function(){
                changeSubtotal($(this).parent().parent());
                getTotal();
            });

            // On Change Price
            $('.price').change(function(){
                changeSubtotal($(this).parent().parent());
                getTotal();
            });

            $('#add_item').click(function () {
                let item =  $('#items').children().last().clone(true, true);
                $('#items').append(item);

                hideRemoveFirstItem();
                getTotal();
            });

            $('.closeItem').click(function () {
                $(this).parent().remove();
                getTotal();
            });

            function hideRemoveFirstItem() {
                $('.item').each(function (index, event) {
                    if (index != 0) {
                        $(this).find('.closeItem').removeClass('thidden');
                    }
                });
            }// show remove product button

            function changeSubtotal(parent){
                let price = parent.find('.price').val();
                let quantity = parent.find('.quantity').val();
                let subtotal = parent.find('.subtotal');

                subtotal.val(price*quantity);
            }// get changeSubtotal

            function getTotal() {
                let subtotal = 0;
                let quantity = 0;

                $('.subtotal').each(function () {
                    subtotal += parseInt($(this).val());
                });
                $('.quantity').each(function () {
                    quantity += parseInt($(this).val());
                });

                $('#total').html(numberWithCommas(subtotal));
                $('#total_items').html(numberWithCommas(quantity));
            }// get getTotal

            function numberWithCommas(x) {
                return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            }// get getTotal

            function getAllProducts() {
                let products = [];

                $('#items').children().each(function () {
                    let product_id = $(this).find('.product').val();
                    let price = $(this).find('.price').val();
                    let qty = $(this).find('.quantity').val();
                    let subtotal = $(this).find('.subtotal').val();

                    products.push({
                        product_id: product_id,
                        price: price,
                        qty: qty,
                        subtotal: subtotal,
                    })
                });

                return products;
            }// get getAllProducts

            $('#submit_btn').click(()=>{
                $('#submit_btn').attr('disabled', 'true');
                progress_loading(true);// show loader

                let products = getAllProducts();

                $.post( "/admin/orders/store", {
                    'products': products,

                    'sold_from': $('#sold_from').val(),
                    'payment_method': $('#payment_method').val(),
                    'date': $('.datepicker').val(),

                    'first_name': $('#first_name').val(),
                    'last_name': $('#last_name').val(),
                    'phone_number': $('#phone_number').val(),
                    'address': $('#address').val(),
                    'fb_link': $('#fb_link').val(),
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
                
                    console.log(errDecoded);
                })
                .done(function( res ) {
                    $('#submit_btn').removeAttr('disabled');
                    progress_loading(false);// show loader

                    Swal.fire({
                        icon: 'success',
                        title: 'Awesome',
                        text: 'Added Successfuly',
                    });
                    location.href = '/admin/orders';
                });
            })// Submit
        });  

    </script>
@endsection