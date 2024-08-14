@extends('admin.products.layouts')

@section('css')
    <link rel="stylesheet" href="{{ asset('input_counter/style.css') }}">

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

@section('page')


    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
            Add Product
        </div>
        <div class="tflex tpx-5 tpt-5">
            <div class="tw-full tflex tflex-col tmr-2">
                <label for="title" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Title</label>
                <input type="text" id="title" class="browser-default form-control" style="padding: 6px;">
            </div>
        </div>
    </div>

    {{-- <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
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
    </div><!-- Details -->
     --}}
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 tmb-1 ttext-title">
            Images
        </div>
        <div class="tflex tflex-wrap tpx-5">
            <input type="file" class="thidden" id="upload_file_input" accept="image/*">

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
        <div class="tflex tflex-wrap tpx-5">
            <div class="tw-1/2 lg:tw-1/4 tmb-2 lg:tmb-0 tpx-1">
                <label for="selling_price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Selling Price</label>
                <input type="number" onkeyup="allnumeric(this)" id="selling_price" class="browser-default form-control" value="0"  style="padding: 6px;">
            </div>
            <div class="tw-1/2 lg:tw-1/4 tmb-2 lg:tmb-0 tpx-1">
                <label for="campaign_price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Campaign Price</label>
                <input type="number" onkeyup="allnumeric(this)" id="campaign_price" class="browser-default form-control" value="0" style="padding: 6px;">
            </div>
            <div class="tw-1/2 lg:tw-1/4 tmb-2 lg:tmb-0 tpx-1">
                <label for="price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Cogs</label>
                <input type="number" onkeyup="allnumeric(this)" id="price" class="browser-default form-control" value="0" style="padding: 6px;">
            </div>
            <div class="tw-1/2 lg:tw-1/4 tmb-2 lg:tmb-0 tpx-1">
                <label for="compare_price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Website Price <small class="ttext-blue-500">(x2 of Cogs)</small></label>
                <input type="number" onkeyup="allnumeric(this)" value="0" id="compare_price" class="browser-default form-control" style="padding: 6px;">
            </div>
        </div>
    </div>
    
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
            Inventory
        </div>
        <div class="tflex tflex-wrap tpx-5">
            <div class="tw-1/3 lg:tw-1/5 tpx-1">
                <label for="sku" class="tfont-normal ttext-sm tmb-2 ttext-black-100">SKU</label>
                <input type="text" id="sku" class="browser-default form-control" style="padding: 6px;">
            </div>
            <div class="tw-1/3 lg:tw-1/5 tpx-1">
                <label for="qty" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Quantity</label>
                <input type="number" onkeyup="allnumeric(this)" value="0" id="qty" class="browser-default form-control" style="padding: 6px;">
            </div>
            <div class="tw-1/3 lg:tw-1/5 tpx-1 tmb-2 lg:tmb-0">
                <label for="barcode" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Barcode</label>
                <input type="text" id="barcode" class="browser-default form-control" style="padding: 6px;">
            </div>
            <div class="tw-1/2 lg:tw-1/5 tpx-1">
                <label for="threshold" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Threshold</label>
                <input type="number" onkeyup="allnumeric(this)" value="10" id="threshold" class="browser-default form-control" style="padding: 6px;">
            </div>
            <div class="tw-1/2 lg:tw-1/5 tpx-1">
                <label for="threshold" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Expiration Date</label>
                <input type="text" class="browser-default form-control" id="expiration_date" value="Jan 01, 2020">
            </div>
        </div>
    </div>


{{--     
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-5">
        <div class="text-sm tfont-medium tpx-5 tpy-4 ttext-title">Variants</div>
        <div class="text-sm tpx-5">
            <label>
                <input type="checkbox" id="has_variant"/>
                <span class="ttext-black-100" style="font-size: 14px;">This product has multiple options, like different sizes or colors</span>
            </label>
        </div>
        <div class="tborder-t tmt-5 thidden" id="variant-container">
            <div class="tpx-5">
                <div id="varian_options_container">
                    <div class="tflex tjustify-between titems-center">
                        <span class="text-sm tfont-medium tpy-4 ttext-title" style="font-size:14px;">OPTIONS</span>
                        <!-- VARIANT VALIDATION MESSAGE -->
                        <span class="ttext-sm ttext-red-500 thidden" id="variant_validation">
                            <a class="btn-floating pulse tbg-red-500 hover:tbg-red-500"><i class="fas fa-exclamation"></i></a>
                            Please enter the variant name and values. or Unchecked the variant checkbox.
                        </span>
                    </div>
                    <div class="tpb-5" data-variant_option="1">
                        <div class="tflex tjustify-between">
                            <span class="text-sm tfont-medium" style="font-size:14px;">Option 1</span>
                            <span class="hover:tunderline tcursor-pointer ttext-blue-600 " style="font-size:14px;"></span>
                        </div>
                        <div class="tflex titems-center">
                            <div class="tw-1/4 tmr-6">
                                <input type="text" value="size" class="browser-default form-control tooltipped" data-position="bottom" data-tooltip="Size, Color, Material, Style, etc." style="padding: 6px; font-size: 14px;">
                            </div>
                            <div class="tw-3/4">
                                <div class="chips chips-placeholder"></div>
                            </div>                           
                        </div>
                    </div>
                    <div class="tborder-t tpt-4 tpb-5 thidden" data-variant_option="2">
                        <div class="tflex tjustify-between">
                            <span class="text-sm tfont-medium" style="font-size:14px;">Option 2</span>
                            <span class="hover:tunderline tcursor-pointer ttext-blue-600 remove_varaint_options" style="font-size:14px;">Remove</span>
                        </div>
                        <div class="tflex titems-center">
                            <div class="tw-1/4 tmr-6">
                                <input type="text" value="color" class="browser-default form-control tooltipped" data-position="bottom" data-tooltip="Size, Color, Material, Style, etc." style="padding: 6px; font-size: 14px;">
                            </div>
                            <div class="tw-3/4">
                                <div class="chips chips-placeholder"></div>
                            </div>                           
                        </div>
                    </div>
                    <div class="tborder-t tpt-4 tpb-5 thidden" data-variant_option="3">
                        <div class="tflex tjustify-between">
                            <span class="text-sm tfont-medium" style="font-size:14px;">Option 3</span>
                            <span class="hover:tunderline tcursor-pointer ttext-blue-600 remove_varaint_options" style="font-size:14px;">Remove</span>
                        </div>
                        <div class="tflex titems-center">
                            <div class="tw-1/4 tmr-6">
                                <input type="text" value="material" class="browser-default form-control tooltipped" data-position="bottom" data-tooltip="Size, Color, Material, Style, etc." style="padding: 6px; font-size: 14px;">
                            </div>
                            <div class="tw-3/4">
                                <div class="chips chips-placeholder"></div>
                            </div>                           
                        </div>
                    </div>
                </div>
                <button id="add_varian_option" class="focus:tbg-gray-100 focus:toutline-none hover:tbg-gray-100 tbg-white tshadow-md tborder tpx-6 tpy-2 trounded ttext-black-100 ttext-sm waves-effect">
                    Add another option
                </button>
            </div>

            <div class="tborder-t tmt-5">
                <div class="text-sm tfont-medium tpx-5 tpy-4 ttext-title">Preview</div>
                <div class="tmt-3">
                    <div class="tflex tjustify-between tpx-5 tborder-b tpb-4">
                        <div class="tfont-medium ttext-black-100 ttext-sm">Variant</div>
                        <div class="tfont-medium ttext-black-100 ttext-sm">Price</div>
                        <div class="tfont-medium ttext-black-100 ttext-sm">Quantity</div>
                        <div class="tfont-medium ttext-black-100 ttext-sm">SKU</div>
                        <div class="tfont-medium ttext-black-100 ttext-sm">Barcode</div>
                        <div class="tfont-medium ttext-black-100 ttext-sm"></div>
                    </div>
                    <!-- Variants Headers -->
                    <div class="variantion_items_container">

                    </div>
                </div>
            </div>
        </div>
    </div>    <!-- Variants -->
     --}}


    <div class="tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
        <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn" onclick="submit()">Save</button>
    </div>



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
            <a href="#!" class="modal-close waves-effect waves-light btn-flat ttext-white" style="background: #f65656;">Okay</a>
        </div>
    </div>
        
    
@endsection

@section('js')
    {{-- <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/lodash@4.17.15/lodash.min.js"></script>
    <script src="{{ asset('js/helpers.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('input_counter/script.js') }}"></script>


    <script>

        $('#expiration_date').datepicker();// initiate datepicker

        // $(document).ready(function () {
        //     $('.modal').modal();

        //    let description = CKEDITOR.replace( 'description' );
        //    let short_description = CKEDITOR.replace( 'short_description' );
        // });
    </script>

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
                            <i class="fas fa-backspace fa-lg tabsolute tright-0 tcursor-pointer delete_image" style="color: tomato; padding-right: 3px; margin-top: 1px;"></i>
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
            let short_description = '--';
            let description = '--';
            let selling_price = $('#selling_price').val();
            let campaign_price = $('#campaign_price').val();
            let price = $('#price').val();
            let compare_price = $('#compare_price').val();
            
            // inventory
            let sku = $('#sku').val();
            let barcode = $('#barcode').val();
            let qty = $('#qty').val();
            let threshold = $('#threshold').val();
            let expiration_date = formatDate($('#expiration_date').val());
            
            let image = [];

            let has_variant = $('#has_variant').prop("checked");
            let variant_options = [];
            let variant_types = false;

            $.each($('.image'), function (i, el) {
                image.push({
                    'base64_image': $(this).attr('src'),
                    'primary': $(this).attr('primary')
                })
            })
            
            if (has_variant) {
                //********* VALIDATION *********
                if ($('.variant-row').length < 1) {
                    $('#variant_validation').removeClass('thidden');
                    return;
                }else{
                    $('#variant_validation').addClass('thidden');
                }
                variant_types = JSON.parse($(document).find('#variant_key_values').val());
            }

            if (variant_types) {
                $.each($('.variant-row'), function (i, el) {
                    if ($(this).attr('deleted') == 'true') {
                        return;
                    }// if variant row is deleted skip
                    variant_options.push({
                        'name': $(this).find('.name').html(),
                        'price': $(this).find('.price').val(),
                        'qty': $(this).find('.qty').val(),
                        'sku': $(this).find('.sku').val(),
                        'barcode': $(this).find('.barcode').val(),
                    });
                    console.log('pass')
                })// get each variant values
            }// if variants has a row

            $.post( "/admin/products/store", { 
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
                expiration_date:expiration_date,
                images:image,
                variant_types: variant_types,   
                variant_options: variant_options,
                has_variant: has_variant
            })
            .fail(function(response) {
                $('#submit_btn').removeAttr('disabled');
                progress_loading(false);// hide loader

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
                progress_loading(false);// hide loader
                window.location.href = '/admin/products';
            });
        }
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

@endsection