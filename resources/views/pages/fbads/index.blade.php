<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    {{-- STYLE SHEETS --}}
    <link rel="stylesheet" href="//use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="//fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/materialize.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
    <link rel="shortcut icon" href="{{ asset('images/icons/favicon.ico') }}" >


    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        /* select option {
            margin: 40px;
            background: rgba(0, 0, 0, 0.3);
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, 0.4);
        } */
    </style>

</head>
<body>
    

    <div style="scroll-behavior: smooth;max-width: 480px;" id="body" class="tmx-auto tborder tpx-3 tpy-5">
        <form action="{{ route('kasoy_oil_store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="tw-full tflex tmb-2">
                <div class="tw-1/2 tmr-1">
                    <label for="full_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Full Name</label>
                    <input required type="text" name="full_name" id="full_name" value="{{ old('full_name') }}" class="browser-default form-control" style="padding: 6px;">
                </div>
                <div class="tw-1/2 tml-1 trelative">
                    @error('phone_number')
                        <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 1%;">{{ $message }}</span>
                    @enderror
                    <label for="phone_number" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Phone Number</label>
                    <input required type="text" name="phone_number" id="phone_number" value="{{ old('phone_number') }}" class="browser-default form-control" style="padding: 6px;">
                </div>
            </div><!--Fullname & Phone Number -->
            <div class="tw-full tflex tmb-2">
                <div class="tw-auto tmr-1">
                    <label for="address" class=" ttext-sm tmb-2 ttext-black-100">
                        <span class="tfont-medium">Address</span>
                        <small class="ttext-gray-600">(Street Name/Building/House No./Subdv/Landmark)</small>
                    </label>
                    <input required type="text" name="address" id="address" value="{{ old('address') }}" class="browser-default form-control" style="padding: 6px;">
                </div>
            </div><!--Address -->
            <div class="tw-full tflex tmb-2">
                <div class="tw-1/3">
                    <label for="province" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Province</label>
                    <select required name="province" id="province" class="browser-default form-control" style="padding: 6px 0px 6px 0px; font-size: 12px; border-radius: 0px; border-right: none;">
                        <option value="">Province</option>
                        @foreach ($provinces as $province)
                            <option value="{{ $province }}">{{ $province }}</option>
                        @endforeach
                    </select>
                </div><!--province -->
                <div class="tw-1/3">
                    <label for="city" class="tfont-medium ttext-sm tmb-2 ttext-black-100">City</label>
                    <select required name="city" id="city" disabled class="browser-default form-control" style="border-left: none;padding: 6px 0px 6px 0px;font-size: 12px;border-radius: 0px;border-right: 0px;">
                        <option value="">City</option>
                    </select>
                </div><!--city -->
                <div class="tw-1/3">
                    <label for="barangay" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Barangay</label>
                    <select required name="barangay" disabled id="barangay" class="browser-default form-control" style="padding: 6px 0px 6px 0px;font-size: 12px;border-left: none;border-radius: 0px;">
                        <option value="">Barangay</option>
                    </select>
                </div><!--barangay -->
            </div><!--province/city/barangay -->

            <div class="tborder tmb-2 tp-2 trelative">
                <div class="talign-middle tflex tjustify-around tw-full">
                    <div class="tflex titems-center">
                        <label>
                            <input type="checkbox" id="promo1" name="promo" checked="" value="6pc_kasoy_oil|999">
                            <span class="ttext-gray-900" style="font-size: 13px;">
                                <span class="tfont-medium">₱999</span>
                                6pcs Kasoy Oil
                            </span>
                        </label>
                    </div><!-- PROMO 1 -->
                    <div class="tflex titems-center">
                        <label>
                            <input type="checkbox" id="promo2" name="promo" value="4pc_kasoy_oil|749">
                            <span class="ttext-gray-900" style="font-size: 13px;">
                                <span class="tfont-medium">₱749</span>
                                4pc Kasoy Oil
                            </span>
                        </label>
                    </div><!-- PROMO 2-->
                </div>
                <div class="talign-middle tflex tjustify-around tw-full">
                    <div class="tflex titems-center">
                        <label>
                            <input type="checkbox" id="promo3" name="promo" value="2pc_kasoy_oil|399">
                            <span class="ttext-gray-900" style="font-size: 13px;">
                                <span class="tfont-medium">₱399</span>
                                2pcs Kasoy Oil
                            </span>
                        </label>
                    </div><!-- PROMO 3 -->
                    <div class="tflex titems-center">
                        <label>
                            <input type="checkbox" id="promo4" name="promo" value="1pc_kasoy_oil|299">
                            <span class="ttext-gray-900" style="font-size: 13px;">
                                <span class="tfont-medium">₱299</span>
                                1pc Kasoy Oil
                            </span>
                        </label>
                    </div><!-- PROMO 4-->
                </div>
                @error('promo')
                    <span class="tabsolute tfont-bold ttext-red-600 ttext-xs" style="bottom: -29%;left: 32%;">{{ $message }}</span>
                @enderror
            </div><!-- ORDER PROMO -->

            <div class="tw-full trelative">
                <img src="{{ asset('/images/icons/loader.gif') }}" id="loader" class="thidden t-mt-2 tabsolute tmb-2" style="height: 20px; left: 46%;">
                <button class="focus:tbg-red-500 tbg-red-500 tml-auto tmt-4 tpy-2 trounded ttext-white tw-full waves-effect" id="submit_btn">Submit Order</button>
            </div>
        </form>

        <div id="modal1" class="modal">
            <div class="modal-content" style="padding-bottom: 0px;">
                <h4 class="tfont-medium ttext-3xl">Thank you</h4>
                <h5 class="tfont-medium tmb-3 tmt-4 ttext-xl">Your order was completed successfully.</h5>
            
                <p>We want to assure you that we are working diligently to process and ship your order as quickly as possible.</p><br>
                <p><span class="tfont-medium">Metro Manila:</span>  1-3 working days.</p>
                <p><span class="tfont-medium">Visayas & Mindanao:</span> 4-7 days.</p>
                <br>
                <p>
                    We truly appreciate your business and look forward to serving you again in the future.
                </p><br>
                <p class="tfont-medium">We appreciate your business!</p>

            </div>
            <div class="modal-footer">
                <a href="" class="modal-close waves-effect waves-green btn-flat">Close</a>
            </div>
        </div> <!-- Modal  -->
    </div>

    <footer>
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"  crossorigin="anonymous"></script>
        <script src="{{ asset('js/main.js') }}"  crossorigin="anonymous"></script>
        <script src="{{ asset('js/materialize.min.js') }}"  crossorigin="anonymous"></script>

        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        </script>

        <script>

            // ONCLICKS
            $('#province').change(function () {
                $('#loader').removeClass('thidden');// Show Loader

                $.post("/get-cities",{
                    province: $(this).val()
                },
                function(data, status){
                    let html = "<option value=''>Pick your city</option>"
                    $.each(JSON.parse(data), function(index, value) {
                        html += "<option value='"+value.city+"'>"+value.city+"</option>";
                    });
                    $('#city').html();
                    $('#barangay').html("<option value='Barangay'>Pick your barangay</option>");
                    $('#city').html(html);

                    $('#city').removeAttr("disabled");// Enable City
                    $('#loader').addClass('thidden');// Hide Loader
                });
            });

            $('#city').change(function () {
                $('#loader').removeClass('thidden');// Show Loader

                $.post("/get-barangay",{
                    city: $(this).val()
                },
                function(data, status){
                    let html = "<option value=''>Pick your barangay</option>"
                    $.each(JSON.parse(data), function(index, value) {
                        html += "<option value='"+value.barangay+"'>"+value.barangay+"</option>";
                    });
                    $('#barangay').html(html);

                    $('#barangay').removeAttr("disabled");// Enable City
                    $('#loader').addClass('thidden');// Hide Loader
                });
            });
            

            $('#promo1').change(function () {
                $("#promo2").prop('checked', false);
                $("#promo3").prop('checked', false);
                $("#promo4").prop('checked', false);
            });

            $('#promo2').change(function () {
                $("#promo1").prop('checked', false);
                $("#promo3").prop('checked', false);
                $("#promo4").prop('checked', false);
            });

            $('#promo3').change(function () {
                $("#promo1").prop('checked', false);
                $("#promo2").prop('checked', false);
                $("#promo4").prop('checked', false);
            });

            $('#promo4').change(function () {
                $("#promo1").prop('checked', false);
                $("#promo2").prop('checked', false);
                $("#promo3").prop('checked', false);
            });

        </script>


        @if(session()->has('success'))
            <script>
                $(document).ready(function(){
                    $('.modal').modal();
                    $('.modal').modal('open');
                });
            </script>
        @endif
    </footer>



   
</body>
</html>