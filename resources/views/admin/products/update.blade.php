@extends('admin.layouts.app')

@section('css')
    <style>
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

@section('content')
    <div class="tw-3/4 tmx-auto">
        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
            <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
                Update Product
            </div>
            <div class="tflex tpx-5 tpt-5">
                <div class="tw-full tflex tflex-col tmr-2">
                    <label for="title" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Title</label>
                    <input type="text" id="title" class="browser-default form-control" value="{{ $products['title'] }}" style="padding: 6px;">
                </div>
            </div>
        </div>

        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5 thidden">
            <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
                Details
            </div>
            <div class="tflex tpx-5 tpt-5">
                <div class="tw-full tflex tflex-col tmr-2">
                    <label for="short_description" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Short Description</label>
                    <textarea id="short_description" class="browser-default form-control" name="short_description" rows="5" style="padding: 6px;"></textarea>
                </div>
            </div>
            <div class="tflex tpx-5 tpt-5">
                <div class="tw-full tflex tflex-col tmr-2">
                    <label for="description" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Description</label>
                    <textarea id="description" class="browser-default form-control" name="description" rows="5" style="padding: 6px;"></textarea>
                </div>
            </div>
        </div><!-- DESCRIPTION -->
        
        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
            <div class="text-sm tfont-medium tpx-5 tpy-4 tmb-1 ttext-title">
                Images
            </div>
            <div class="tflex tflex-wrap tpx-5">
                <input type="file" class="thidden" id="upload_file_input" multiple>

                <div class="tw-full tpy-6 dropzone">
                    <div class="dz-message needsclick">    
                        <img src="https://cdn.shopify.com/shopifycloud/web/assets/5f3b0e3cd42c85abb313985bb5aa7c32.svg" class="tmx-auto tmb-5" style="height:75px" >
                        <button onclick="upload_file_input()" class="focus:tbg-gray-100 focus:toutline-none  hover:tbg-gray-100 tbg-white  tshadow-md tborder tpx-4 tpy-2 trounded ttext-black-100 ttext-sm waves-effect">
                            Add image
                        </button>
                        <span class="ttext-sm tblock tmt-3">Upload high quantity image for better user experience</span>
                    </div>
                </div>
                <div class="tw-full tflex tflex-wrap tjustify-start tpy-3 t-mr-1" id="image_container">
                    
                </div><!-- IMAGE CONTAINER -->
            </div>
        </div>

        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
            <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                Pricing
            </div>
            <div class="tflex tpx-5">
                <div class="tw-1/2 tflex tflex-col tmr-3">
                    <label for="selling_price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Selling Price</label>
                    <input type="number" onkeyup="allnumeric(this)" id="selling_price" class="browser-default form-control" value="{{ $products['selling_price'] }}" style="padding: 6px;">
                </div>
                <div class="tw-1/2 tflex tflex-col tmr-3">
                    <label for="campaign_price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Campaign Price</label>
                    <input type="number" onkeyup="allnumeric(this)" id="campaign_price" class="browser-default form-control" value="{{ $products['campaign_price'] }}"  style="padding: 6px;">
                </div>
                <div class="tw-1/2 tflex tflex-col tmr-3">
                    <label for="price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Cogs</label>
                    <input type="number" onkeyup="allnumeric(this)" id="price" class="browser-default form-control" value="{{ $products['price'] }}" style="padding: 6px;">
                </div>
                <div class="tw-1/2 tflex tflex-col tml-3">
                    <label for="compare_price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Website Price <small class="ttext-blue-500">(x2 of Cogs)</small></label>
                    <input type="number" onkeyup="allnumeric(this)" id="compare_price" class="browser-default form-control" value="{{ $products['compare_price'] }}" style="padding: 6px;">
                </div>
            </div>
        </div>
        
        <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
            <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                Inventory
            </div>
            <div class="tflex tpx-5">
                <div class="tw-1/2 tflex tflex-col tmr-3">
                    <label for="sku" class="tfont-normal ttext-sm tmb-2 ttext-black-100">SKU (Stock Keeping Unit)</label>
                    <input type="text" id="sku" class="browser-default form-control" value="{{ $products['sku'] }}" style="padding: 6px;">
                </div>
                <div class="tw-1/2 tflex tflex-col tml-3">
                    <label for="barcode" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Barcode (ISBN, UPC, GTIN, etc.)</label>
                    <input type="text" id="barcode" class="browser-default form-control" value="{{ $products['barcode'] }}" style="padding: 6px;">
                </div>
            </div>
            <div class="tflex tpx-5 tpt-4">
                <div class="tw-1/2 tflex tflex-col tmr-3">
                    <label for="qty" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Quantity</label>
                    <input type="number" onkeyup="allnumeric(this)" id="qty" class="browser-default form-control" value="{{ $products['qty'] }}" style="padding: 6px;">
                </div>
                <div class="tw-1/2 tflex tflex-col tml-3">
                    <label for="threshold" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Threshold</label>
                    <input type="number" onkeyup="allnumeric(this)" id="threshold" class="browser-default form-control" value="{{ $products['threshold'] ?? 10 }}" style="padding: 6px;">
                </div>
            </div>
        </div>

        <div class="tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
            <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn" onclick="submit()">Update</button>
        </div>
    </div>


    <!-- Modal ERRORS -->
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
            <a href="#!" class="modal-close waves-effect waves-light btn-flat ttext-white" style="background: #f65656;">Okay</a>
        </div>
    </div>

@endsection

@section('js')
    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
    <script src="{{ asset('input_counter/script.js') }}"></script>

    
    <script> // ck editor and other initiator
        $(document).ready(function () {
            $('.modal').modal();

            let description = CKEDITOR.replace( 'description' );
            CKEDITOR.instances['description'].setData(`{!! $products['description'] !!}`);

            let short_description = CKEDITOR.replace( 'short_description' );
            CKEDITOR.instances['short_description'].setData(`{!! $products['short_description'] !!}`);
        });

        
    </script>

    @foreach ($products['images'] as $img)
        @if ($img['size'] == 'small')
            @if ($img['primary'])
                <script>// RENDER IMAGE MARK-UP FOR (PRIMARY) IMAGE
                    // getBase64Image("{{ $img['img'] }}", function (base64image) {
                        $('#image_container').prepend(`
                            <div class="tw-1/5 tmb-3 tpr-1 trelative">
                                <img src="{{ asset('images/icons/medal.png') }}" class="tabsolute t-ml-1" id="main_image_badge" alt="main image">
                                <i class="delete_image fa-backspace fa-lg fas tabsolute tcursor-pointer" style="color: tomato;margin-top: 1px;right: 11px;"></i>
                                <img src="{{ $img['img'] }}" class="image tborder" primary="1" style="height:148px; width: 164px;">
                            </div>
                        `);
                    // });
                </script>
            @else
                <script>// RENDER IMAGE MARK-UP FOR (NON PRIMARY) IMAGE
                    // getBase64Image("{{ $img['img'] }}", function (base64image) {
                        $('#image_container').prepend(`
                            <div class="tw-1/5 tmb-3 tpr-1 trelative">
                                <i class="delete_image fa-backspace fa-lg fas tabsolute tcursor-pointer" style="color: tomato;margin-top: 1px;right: 11px;"></i>
                                <img src="{{ $img['img'] }}" class="image tborder" primary="0" style="height:148px; width: 164px;">
                            </div>
                        `);
                    // });
                </script>
            @endif
        @endif
       
    @endforeach

    {{-- UPLOAD IMAGES JS CONTROLS --}}
    <script>
        function upload_file_input (){
            $("#upload_file_input").trigger( "click" );
        }// trigger click to open file upload

        
        $(document).on('change', '#upload_file_input', function(e){
            var files = e.target.files;
            var file_size_err = 0;
            var image_ext_err = 0;
            
            // UPLOAD IMAGE
            $.each(files, function(i, file){
                var reader = new FileReader();
                var img_key = i+random_string_generator();
                let main_image_badge = `<img src="{{ asset('images/icons/medal.png') }}" class="tabsolute t-ml-1" id="main_image_badge" alt="main image">`;
                
                reader.readAsDataURL(file);
                reader.onload = function(e){

                    var base64Img = e.target.result;

                    if (base64MimeType(base64Img) != 'image') {
                        alert('The file must be an image');
                        return;

                    }

                    // RENDER IMAGE MARK-UP
                    let img_markup = `
                        <div class="tw-1/5 tmb-3 tpr-1 trelative">
                            <i class="delete_image fa-backspace fa-lg fas tabsolute tcursor-pointer" style="color: tomato;margin-top: 1px;right: 11px;"></i>
                            <img src="${base64Img}" class="image tborder" primary="0" style="height:148px; width: 164px;">
                        </div>
                        `;
                        
                        $('#image_container').prepend(img_markup); // PUT the image
                    }
                });
            });
            
            // SET PRIMARY IMAGE
            $(document).on('click', '.image', function (params) {
                let last_maing_img = $(document).find('#main_image_badge'); // find the last primary image
                last_maing_img.next().next().attr('primary', 0)// set the last primary image primary attr to false
                last_maing_img.remove();// remove the main image badge
                let main_image_badge = `<img src="{{ asset('images/icons/medal.png') }}" class="tabsolute t-ml-1" id="main_image_badge" alt="main image">`;// main image badge markup
                $(this).parent().prepend(main_image_badge);// prepend the image badge markup to new selected image
                $(this).attr('primary', 1); // select the primary attr to true to make this image primary
            })
            
            // DELETE IMAGE
            $(document).on('click', '.delete_image', function (params) {
                $(this).parent().remove();
            })
    </script>


    {{-- VARIANTS CONTROLS --}}
    <script>
        $(document).ready(function(){

            $('#has_variant').change(function(){
                console.log($('#has_variant').prop("checked"));
                if($(this).prop("checked") == true){
                    $('#variant-container').show();
                }
                else if($(this).prop("checked") == false){
                    $('#variant-container').hide();
                }
            });
            
            function change_the_option_squence_label() {
                $(`[data-variant_option]:not(".thidden")`).each(function(option_count) {
                    $(this).children(":first").children(":first").html('Option ' + parseInt(option_count + 1));
                })
            }//change the option label Ex: Option 3


            // ***********************************
            // ADD VARIATION OPTION
            // ***********************************
            $('#add_varian_option').click(function(){
                if ($("[data-variant_option='1']").css('display')  == 'none') {
                    $("[data-variant_option='1']").removeClass('thidden');
                    change_the_option_squence_label();
                    return;
                }

                if ($("[data-variant_option='2']").css('display')  == 'none') {
                    $("[data-variant_option='2']").removeClass('thidden');
                    change_the_option_squence_label();
                    return;
                }

                $("[data-variant_option='3']").removeClass('thidden');
                change_the_option_squence_label();
                $(this).hide();// the minimum variant option is only 3
                return;
            });


            // ***********************************
            // REMOVE VARIATION OPTION
            // ***********************************
            $('.remove_varaint_options').click(function(){
                var varian_option_count = $("[data-variant_option]:not('.thidden')").length - 1; //get the total variant option
                console.log(varian_option_count);
                if (varian_option_count == 2) {
                    $('#add_varian_option').show();
                }// limit the addition of variants by 3

                $(this).parent().parent().addClass('thidden');//remove the varaint options

                change_the_option_squence_label();
            
            }); //remove the varaint options


            // ***********************************
            // VARIATION KEY AND VALUES AND CHIPS
            // ***********************************
            var variant_object = [];
            var variant_values = new Array();
            var variant_count = 1;

            $('.chips-placeholder').chips({
                placeholder: 'Enter an options',
                secondaryPlaceholder: '+Options',
                onChipAdd: function (event, chip) {
                    var variant_name = event.parent().prev().children().val();//  get the variant_name
                    var variant_value = event[0].M_Chips.chipsData.map(obj => {return obj.tag;}); // return the chip variant_values

                    // ***********************************************
                    // **************** SHOW ERROR MESSAGE **********
                    // ***********************************************
                    if (variant_name) {
                        $('#variant_validation').addClass('thidden');
                    }else{
                        $('#variant_validation').removeClass('thidden');
                    }
                    
                    // ***********************************************
                    // Insert the key and values in variant object
                    // ***********************************************
                    variant_object[variant_name] = variant_value; 

                    constract_variant_array_of_object(variant_object);
                },
                onChipDelete: function (event, chip) {
                    var variant_name = event.parent().prev().children().val();//  get the variant_name
                    var variant_value = event[0].M_Chips.chipsData.map(obj => {return obj.tag;}); // return the chip variant_values
                    
                    // GET ALL THE INDEX OF $variant_name from $variant_values 
                    let tobe_deleted_index = new Array();
                    Object.getOwnPropertyNames(variant_values).forEach(key_num=>{
                        Object.getOwnPropertyNames(variant_values[key_num]).forEach(key_variant=> {
                            if (key_variant == variant_name) {
                                tobe_deleted_index.push(key_num);
                            }
                        })
                    });

                    // DELETE ALL data base on get indexs
                    variant_values.splice(tobe_deleted_index[0], (tobe_deleted_index.length));
                    variant_object[variant_name] = variant_value; 
                    constract_variant_array_of_object(variant_object);
                }
            }); 

            function constract_variant_array_of_object(variant_obj) {
                let variants = Object.assign({}, variant_obj);
                $.post( "/admin/products/generate_variant", { variants })
                .done(function( variant_form ) {
                    $('.variantion_items_container').html(variant_form)   
                });
            }
        })
    </script>

    {{-- FUNCTIONS --}}
    <script>
        function allnumeric(inputtxt){
            var numbers = /^[0-9]+$/;
            if(inputtxt.value.match(numbers)){
                return true;
            }else{
                inputtxt.value = '';
                return false;
            }
        }
    </script>

    {{-- SUBMIT --}}
    <script>
        function submit() {
            $('#submit_btn').attr('disabled', 'true');
            progress_loading(true);// show loader

            let title = $('#title').val();
            let short_description = CKEDITOR.instances.short_description.getData();
            let description = CKEDITOR.instances.description.getData();
            let selling_price = $('#selling_price').val();
            let campaign_price = $('#campaign_price').val();
            let price = $('#price').val();
            let compare_price = $('#compare_price').val();
            
            // inventory
            let sku = $('#sku').val();
            let barcode = $('#barcode').val();
            let qty = $('#qty').val();
            let threshold = $('#threshold').val();
            
            let image = [];
            $.each($('.image'), function (i, el) {
                image.push({
                    'base64_image': $(this).attr('src'),
                    'primary': $(this).attr('primary')
                })
            })
            

            $.post( "/admin/products/patch", { 
                id: "{{ request()->id }}",
                title:title,
                short_description:short_description,
                description:description,
                selling_price:selling_price,
                campaign_price:campaign_price,
                price:price,
                compare_price:compare_price,
                sku:sku,
                barcode:barcode,
                qty:qty,
                threshold:threshold,
                images:image,
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

                // Swal.fire({
                //     icon: 'success',
                //     title: 'Awesome',
                //     text: 'Update Successfuly',
                // });
                // window.location.href = "/admin/products";
            });
        }
    </script>   

@endsection