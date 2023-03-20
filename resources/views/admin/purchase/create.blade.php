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
@endsection

@section('page')



<div id="error" class="tbg-red-200 tflex tmb-4 tp-4 trounded-lg ttext-red-600 txt-sm thidden" role="alert">
    <svg class="tw-5 th-5 tinline tmr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
    </svg>
    <div>
        <span class="tfont-medium">File upload failed!</span> 
        Please contact 
        <span class="tfont-medium">Reggie Frias</span> 
    </div>
</div><!-- Error Message -->



    <div class="tw-full">
        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
            <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
                Purchase Order
            </div>
            <div class="tborder-b text-sm tflex tfont-medium tjustify-between tpb-4 tpt-2 tpt-4 tpx-5 ttext-title">
                <div class="tmt-2">
                    <div class="">Product</div>
                </div>
            </div>

            <div id="items">
                <div class="item trelative">
                    <i class="closeItem material-icons hover:tunderline tabsolute tcursor-pointer tmr-6 tmt-2 tright-0 ttext-error thidden">close</i>
                    <div class="tflex tmx-5 tpy-3">
                        <div class="tw-3/6 tw-full tflex tflex-col tmr-2">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Item </label>
                            <select class="product tcursor-pointer browser-default form-control" style="padding: 6px;">
                                <option value="" data-price="" selected="">Choose product ...</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product['id'] }}" data-price="{{ $product['price'] }}">{{ $product['title'] }}</option>
                                @endforeach
                            </select>
                        </div><!-- Product -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Price</label>
                            <input type="text" onkeyup="allnumeric(this)" value="0" class="price browser-default form-control" style="padding: 6px;">
                        </div><!-- Price -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Quantity</label>
                            <input type="number" onkeyup="allnumeric(this)" value="1" class="quantity browser-default form-control" style="padding: 6px;">
                        </div><!-- QTY -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label class="tfont-normal ttext-sm tmb-2 ttext-black-100">Subtotal</label>
                            <input type="text" disabled="" class="subtotal tcursor-pointer browser-default form-control" style="padding: 6px;background: #f9f9f9;cursor: not-allowed;">
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



            <div class="tflex tpx-5 tmt-5">
                <div class="tw-1/2 tmr-2">
                    <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Shipping Fee <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                    <input type="text" class="shipping_fee tcursor-pointer browser-default form-control">
                </div><!-- Shipping Fee -->
                
                <div class="tw-1/2 tmr-2">
                    <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Transaction Fee <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                    <input type="text" class="transaction_fee tcursor-pointer browser-default form-control">
                </div><!-- Transaction Fee -->
            </div>

            <div class="tflex tpx-5 tmt-5">
                <div class="tw-1/2 tmr-2">
                    <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Suppliers </label>
                    <select class="supplier tcursor-pointer browser-default form-control" style="padding: 6px;">
                        <option value="" data-price="" selected="">Choose supplier ...</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier['id'] }}" >{{ $supplier['name'] }} {{ $supplier['surname'] }}</option>
                        @endforeach
                    </select>
                </div><!-- suppliers -->
               
                <div class="tw-1/2 tmr-2">
                    <label class="tfont-normal ttext-sm tmb-2 ttext-black-100"> Tax <small class="ttext-gray-600">(Optional, You can add this later.)</small></label>
                    <input type="text" class="tax tcursor-pointer browser-default form-control">
                </div><!-- Tax -->
            </div>

        </div><!-- Create Order -->


        <div class="tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
        <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn">Save</button>
        </div><!-- Save -->

        <!-- Modal Structure -->
        <div id="err_msg_modal" class="modal modal-fixed-footer" tabindex="0">
            <div class="modal-content tbg-white">
                <div class="ttext-center tmb-5">
                    <a class="btn-floating pulse tbg-red-500 hover:tbg-red-500"><i class="fas fa-exclamation"></i></a>
                    <h4 class="ttext-lg">Ooops</h4>
                </div>
                <ul class="modal_err_msg">
                </ul>
            </div>
            <div class="modal-footer">
                <a href="#!" id="" class="modal-close waves-effect waves-light btn-flat ttext-white" style="background: #f65656;">Okay</a>
            </div>
        </div>
    </div>


@endsection

@section('js')
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
            
    <script>
        $(document).ready(function(){
            $(".dropdown-trigger").dropdown({
                constrainWidth: false
            });
            $('.tabs').tabs();
            $('.tooltipped').tooltip();
        });

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function item_show(item_show_link){
            window.location.href = item_show_link;
        }

        function progress_loading(visibility) {
            if (visibility) {
                return $('#progress').show();
            }
            $('#progress').hide();
        }
    </script>

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
                let qty = 0;
                let sub_total = 0;

                $('#items').children().each(function () {
                    let product_id = $(this).find('.product').val();
                    let itemprice = $(this).find('.price').val();
                    let itemqty = $(this).find('.quantity').val();
                    let itemsubtotal = $(this).find('.subtotal').val();
                    
                    if (product_id != '') {
                        products.push({
                            product_id: product_id,
                            price: itemprice,
                            qty: itemqty,
                            sub_total: itemsubtotal,
                        })

                        qty +=  parseInt(itemqty);
                        sub_total +=  parseInt(itemsubtotal);

                    }// if no product selected, Remove it from product array
                    
                });

                return {
                    products:products,
                    qty:qty,
                    sub_total:sub_total,
                }
            }// get getAllProducts

            function allProducts() {
                let quantity = 0;
                $('.quantity').each(function () {
                    quantity += parseInt($(this).val());
                });
                return quantity;
            }

            $('#submit_btn').click(()=>{

                // $('#submit_btn').attr('disabled', 'true');
                // progress_loading(true);// show loader

                let products = getAllProducts();
                console.log(products)

                $.post( "/admin/purchase/store", {
                    'products': products.products,
                    'total_price': products.sub_total,
                    'total_qty': products.qty,
                    'supplier': $('.supplier').val(),
                    'shipping_fee': $('.shipping_fee').val(),
                    'transaction_fee': $('.transaction_fee').val(),
                    'tax': $('.tax').val(),
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
                    location.href = '/admin/purchase/create';
                });
            })// Submit
        });  
            
    </script>
@endsection