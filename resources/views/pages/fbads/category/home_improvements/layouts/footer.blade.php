
<footer>

    <script type="text/javascript" src="{{ asset('/js/plugins/confetti.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script>
        $('.lazy').Lazy();
        $('.modal').modal();
    </script>

    <script> // SLIDE SHOW
        const slides = document.querySelectorAll(".slides img");
        let slideIndex = 0;
        let intervalId = null;

        document.addEventListener("DOMContentLoaded", initializeSlider);

        function initializeSlider(){
            if(slides.length > 0){
                slides[slideIndex].classList.add("displaySlide");
                intervalId = setInterval(nextSlide, 5000);
            }
        }

        function showSlide(index){
            if(index >= slides.length){
                slideIndex = 0;
            }
            else if(index < 0){
                slideIndex = slides.length - 1;
            }

            slides.forEach(slide => {
                slide.classList.remove("displaySlide");
            });
            slides[slideIndex].classList.add("displaySlide");
        }

        function prevSlide(){
            clearInterval(intervalId);
            slideIndex--;
            showSlide(slideIndex);
        }

        function nextSlide(){
            slideIndex++;
            showSlide(slideIndex);
        }
    </script>

    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var $window = $(window),x
            $document = $(document),
            button = $('.order_now');
            
        $window.on('scroll', function () {
            let scrollH = $(window).height() + $(window).scrollTop();
            let H = ($document.height() - 550);

            if (scrollH > H) {
                
                button.stop(true).css('z-index', 0).animate({
                    opacity: 0
                }, 50);
            } else {
                button.stop(true).css('z-index', 998).animate({
                    opacity: 1
                }, 50);
            }
        });// hide show ORDER BUTTON on Scroll

      
        $("form").on("submit", function (e) {
            e.preventDefault();
            // if (!isValid()) {
            //     return;
            // }

            $('.loader').removeClass('thidden');// SHOW LOADER

            let url = $(this).attr('action');

            $.post(url, {
                full_name: $('#full_name').val(),
                phone_number: $('#phone_number').val(),
                address: $('#address').val(),
                promo: $('.promo:checked').val(),
                product_name: $('#product_name').val(),
                notif_message: $('#notif_message').val(),
            })
            .done(function( data ) {    
                console.log(data)
                // change html content of success modal
                $('#modal-order-number').html(data.order_number);

                if (data.amount == "1149") {
                    $('#product_promo_name').html(data.promo_name);
                    $('#order_success_image')
                    .attr('data-src', 'https://matildasbeauty.com/filemanager/c895afcfbcce478096d9d9d989c3d1b2.webp')
                    .attr('src', 'https://matildasbeauty.com/filemanager/c895afcfbcce478096d9d9d989c3d1b2.webp');
                }

                $('#modal-promo').html(data.promo);
                $('#modal-amount').html(data.amount);

                $('.loader').addClass('thidden');// HIDE LOADER

                $.post("/event-listener",{
                    order_success: 1,
                    website: '{{ $website }}',
                    session_id: '{{ $session_id }}',
                    name: $('#full_name').val(),
                    contact_number: $('#phone_number').val(),
                    promo_name: data.promo_name
                });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS

                $.post("/Madella-Order-Success-Email",{
                    data,
                });// Email Notif


                /// ========================================
                // SESSION ORDER CONTROL (FINAL VERSION)
                // ========================================

               
                const DOMAIN = window.location.hostname;
                const TODAY = new Date().toISOString().slice(0, 10);

                function getStorage() {
                    try {
                        return JSON.parse(localStorage.getItem('order_control') || '{}');
                    } catch (e) {
                        return {};
                    }
                }

                function saveStorage(data) {
                    localStorage.setItem('order_control', JSON.stringify(data));
                }

                function canOrder(promo) {
                    const data = getStorage();

                    if (!data[DOMAIN]) data[DOMAIN] = {};
                    if (!data[DOMAIN][TODAY]) {
                        data[DOMAIN][TODAY] = {
                            total: 0,
                            promos: {}
                        };
                    }

                    const todayData = data[DOMAIN][TODAY];

                    // 🔒 lock check
                    if (todayData.locked_until) {
                        if (new Date() < new Date(todayData.locked_until)) {
                            return false;
                        }
                    }

                    // 🔒 same promo only once
                    if ((todayData.promos[promo] || 0) >= 1) {
                        return false;
                    }

                    // 🔒 max 3 total promos
                    if (todayData.total >= 3) {
                        return false;
                    }

                    return true;
                }

                function recordOrder(promo) {
                    const data = getStorage();

                    if (!data[DOMAIN]) data[DOMAIN] = {};
                    if (!data[DOMAIN][TODAY]) {
                        data[DOMAIN][TODAY] = {
                            total: 0,
                            promos: {}
                        };
                    }

                    const todayData = data[DOMAIN][TODAY];

                    todayData.promos[promo] = (todayData.promos[promo] || 0) + 1;
                    todayData.total++;

                    // 🔒 lock after 3 orders
                    if (todayData.total >= 3) {
                        const lockDate = new Date();
                        lockDate.setDate(lockDate.getDate() + 3);

                        todayData.locked_until = lockDate.toISOString();
                    }

                    saveStorage(data);
                }


                // ========================================
                // EXECUTION
                // ========================================

                if (!canOrder(data.promo_name)) {
                    console.log("Blocked: Order limit reached");

                    // Optional UX feedback (recommended)
                    alert("Order Limit reached");

                    // STOP pixel only (do not break whole script)
                } else {
                    // record success
                    recordOrder(data.promo_name);

                    // fire FB PIXEL
                    fbq('track', 'Purchase', {
                        currency: "PHP",
                        value: data.amount
                    });
                    $('.modal').modal('open'); // open modal

                }

                // clear form (always runs)
                $('#full_name').val('');
                $('#phone_number').val('');
                $('#address').val('');


               // We can Put The session Here



                // ttq.track('PlaceAnOrder', { // TIKTOK PIXEL EVENT
                //     "contents": [
                //         {
                //             "content_id": "10225", // string. ID of the product. Example: "1077218".
                //             "content_type": "product", // string. Either product or product_group.
                //             "content_name": "gingerOil" // string. The name of the page or product. Example: "shirt".
                //         }
                //     ],
                //     "value": data.amount, // number. Value of the order or items sold. Example: 100.
                //     "currency": "PHP" // string. The 4217 currency code. Example: "USD".
                // });

            })
        })

        function isValid() {
            let full_name = $('#full_name').val();
            let phone_number = $('#phone_number').val();
            let address = $('#address').val();

            let errors = 0

            if (full_name == '') {
                errors++
            }else if (phone_number == '') {
                errors++
            }else if (phone_number.length != 11) {
                $('#phone_number_validation').removeClass('thidden');
                console.log(phone_number.length)
                console.log('error phone number');
                errors++
            }else if (address == '') {
                errors++
            }
            
            if (errors != 0) {
                $.post("/event-listener",{
                    form_validation_error: 1,
                    website: '{{ $website }}',
                    session_id: '{{ $session_id }}',
                });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS
                return false;
            }

            return true;
        }// form validation

        $('.order_now').click(function (e) {
            $('html, body').animate({
                scrollTop: $('#form').offset().top + 9999
            }, 'slow');// SCROLL BACK TO FORM AFTER Submit with error validation

            $.post("/event-listener",{
                order_form: 1, 
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ORDER FORM

            // ttq.track('AddPaymentInfo', { // TIKTOK PIXEL
            //     "contents": [
            //         {
            //             "content_id": "10225", // string. ID of the product. Example: "1077218".
            //             "content_type": "product", // string. Either product or product_group.
            //             "content_name": "gingerOil" // string. The name of the page or product. Example: "shirt".
            //         }
            //     ],
            //     "value": "0", // number. Value of the order or items sold. Example: 100.
            //     "currency": "PHP" // string. The 4217 currency code. Example: "USD".
            // });
        });

        // ONCLICKS
        $('#province').change(function () {
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
            });
        });

        $('#city').change(function () {
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
            });
        });
        
        $('#promo1').change(function () {
            $('#total').html($(this).val().split('|')[1]);
            $("#promo2").prop('checked', false);
            $("#promo3").prop('checked', false);
            $("#promo4").prop('checked', false);
        });

        $('#promo2').change(function () {
            $('#total').html($(this).val().split('|')[1]);
            $("#promo1").prop('checked', false);
            $("#promo3").prop('checked', false);
            $("#promo4").prop('checked', false);
        });

        $('#promo3').change(function () {
            $('#total').html($(this).val().split('|')[1]);
            $("#promo1").prop('checked', false);
            $("#promo2").prop('checked', false);
            $("#promo4").prop('checked', false);
        });

        // $('#promo4').change(function () {
            //     $('#total').html($(this).val().split('|')[1]);
            //     $("#promo1").prop('checked', false);
            //     $("#promo2").prop('checked', false);
            //     $("#promo3").prop('checked', false);
        // });

        $('#phone_number').keyup(function (e) { 
            // let count = $(this).val().length;

            // $('#number_counter').html(count + '/11');

            // if (count == 11) {
            //     $('#phone_number').css("border-color", "#4aa977");
            //     $('#phone_number').css("outline-color", "#4aa977");
            //     $('#number_counter').attr('class', 'tfont-medium ttext-green-600');

            //     $('#phone_number_validation').addClass('thidden');

            // }else{
            //     $('#phone_number').css("border-color", "#e53e3e");
            //     $('#phone_number').css("outline-color", "#e53e3e");

            //     $('#number_counter').attr('class', 'tfont-medium ttext-red-600 focus-visible-red');
            // }
        }); // Phone Number Validation

        // EVENT LISTENER
        $('#full_name').change(function (e) {
            $.post("/event-listener",{
                full_name: $(this).val(),
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER FULL NAME
        });
        
        $('#phone_number').change(function (e) {
            $.post("/event-listener",{
                phone_number: $(this).val(),
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('#address').change(function (e) {
            $.post("/event-listener",{
                address: $(this).val(),
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('.promo').click(function (e) {
            $.post("/event-listener",{
                promo: 1,
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('#submit_btn').click(function () {
            $.post("/event-listener",{
                submit_order: 1,
                website: '{{ $website }}',
                session_id: '{{ $session_id }}',
            });//  EVENT LISTENER Track SUBMIT ORDER
        })

        //  Track event
        $.post("/event-listener",{
            visitors: 1,
            website: '{{ $website }}',
            session_id: '{{ $session_id }}',
        });//  EVENT LISTENER Track VIEW

        // allnumeric
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
    
</footer>
</body>
</html>