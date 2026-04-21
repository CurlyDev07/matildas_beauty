
<footer>

    <script type="text/javascript" src="{{ asset('/js/plugins/confetti.js') }}"></script>
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.lazy/1.7.9/jquery.lazy.min.js"></script>
    <script>
        $('.lazy').Lazy();
        $('.modal').modal();
    </script>

    <style>
        /* Validation Popup */
        .validation-popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.6);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            padding: 16px;
            animation: validationFadeIn 0.2s ease;
        }
        .validation-popup-overlay.show {
            display: flex;
        }
        .validation-popup-card {
            width: 100%;
            max-width: 360px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.2);
            padding: 28px 24px 20px;
            text-align: center;
            animation: validationSlideUp 0.25s ease;
        }
        .validation-popup-icon {
            width: 56px;
            height: 56px;
            background: #fee2e2;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 14px;
            font-size: 26px;
        }
        .validation-popup-title {
            margin: 0 0 8px;
            color: #991b1b;
            font-size: 18px;
            font-weight: 700;
        }
        .validation-popup-text {
            margin: 0 0 20px;
            color: #475569;
            font-size: 14px;
            line-height: 1.5;
        }
        .validation-popup-btn {
            display: inline-block;
            background: #e91e63;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 28px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }
        @keyframes validationFadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        @keyframes validationSlideUp {
            from { transform: translateY(30px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }
    </style>

    <!-- Validation Popup -->
    <div id="validation-popup-overlay" class="validation-popup-overlay">
        <div class="validation-popup-card">
            <div class="validation-popup-icon">⚠️</div>
            <h3 class="validation-popup-title">Invalid Mobile Number</h3>
            <p class="validation-popup-text" id="validation-popup-message">Please enter a valid Philippine mobile number.</p>
            <button class="validation-popup-btn" onclick="closeValidationPopup()">Try Again</button>
        </div>
    </div>

    <style>
        .blocked-popup-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, 0.7);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 99999;
            padding: 16px;
        }

        .blocked-popup-card {
            width: 100%;
            max-width: 420px;
            background: #ffffff;
            border-radius: 14px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
            padding: 24px 20px 20px;
            text-align: center;
        }

        .blocked-popup-title {
            margin: 0 0 8px;
            color: #991b1b;
            font-size: 22px;
            font-weight: 700;
        }

        .blocked-popup-text {
            margin: 0 0 16px;
            color: #334155;
            font-size: 14px;
            line-height: 1.5;
        }

        .blocked-popup-btn {
            display: inline-block;
            background: #1877f2;
            color: #fff !important;
            text-decoration: none;
            border-radius: 10px;
            padding: 10px 14px;
            font-size: 14px;
            font-weight: 700;
        }
    </style>

    <script>
        let fpPromise = null;
        let fingerprintjs_visitor_id = null;
        let fingerprintVisitorIdPromise = null;
        let isFingerprintBlocked = false;

        function showBlockedPopup() {
            let overlay = document.getElementById('blocked-popup-overlay');

            if (!overlay) {
                overlay = document.createElement('div');
                overlay.id = 'blocked-popup-overlay';
                overlay.className = 'blocked-popup-overlay';
                overlay.innerHTML = `
                    <div class="blocked-popup-card">
                        <h3 class="blocked-popup-title">Unusual Activity Detected</h3>
                        <p class="blocked-popup-text">
                            We detected an unsual activity.
                            If you still want to order, click the button below.
                        </p>
                        <a class="blocked-popup-btn" href="https://m.me/262215796983675" target="_blank" rel="noopener noreferrer">
                            Order in Messenger
                        </a>
                    </div>
                `;
                document.body.appendChild(overlay);
            }

            overlay.style.display = 'flex';
        }

        function loadFingerprintJS() {
            if (!fpPromise) {
                fpPromise = import('https://openfpcdn.io/fingerprintjs/v5')
                    .then(function (FingerprintJS) {
                        return FingerprintJS.load();
                    });
            }
            return fpPromise;
        }

        async function getFingerprintVisitorId() {
            try {
                const fp = await loadFingerprintJS();
                const result = await fp.get();

                return result.visitorId || null;
            } catch (e) {
                console.error('FingerprintJS error:', e);
                return null;
            }
        }

        function initFingerprintVisitorId() {
            if (!fingerprintVisitorIdPromise) {
                fingerprintVisitorIdPromise = getFingerprintVisitorId()
                    .then(function (id) {
                        fingerprintjs_visitor_id = id;
                        return id;
                    })
                    .catch(function () {
                        return null;
                    });
            }

            return fingerprintVisitorIdPromise;
        }



        function checkFingerprintBlockStatus(id) { // Check if user has been blocked based on fingerprint visitor ID
            return fetch('/order-signal/check-block-user', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    fingerprintjs_visitor_id: id
                })
            })
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                return !!(data && data.blocked);
            })
            .catch(function () {
                return false;
            });
        }

        function registerBlockedAttempt(id) { // Increment blocked attempt count and update last_attempt_at
            if (!id) {
                return Promise.resolve({
                    status: true,
                    blocked: false,
                    attempt_count: 0
                });
            }

            return fetch('/order-signal/attempt-count', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                body: JSON.stringify({
                    fingerprintjs_visitor_id: id
                })
            })
            .then(function (response) {
                return response.json();
            })
            .catch(function () {
                return {
                    status: false,
                    blocked: true
                };
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            initFingerprintVisitorId().then(function (id) {
                console.log('Fingerprint Visitor ID:', id);
                return checkFingerprintBlockStatus(id);
            }).then(function (blocked) {
                isFingerprintBlocked = blocked;
                window.isFingerprintBlocked = blocked;
                console.log('Fingerprint Blocked:', blocked);

                if (blocked) {
                    showBlockedPopup();
                    registerBlockedAttempt(fingerprintjs_visitor_id).then(function (result) {
                        console.log('Blocked Attempt Count:', result.attempt_count || 0);
                        console.log('Last Attempt At:', result.last_attempt_at || null);
                    });
                }
            });

            // Dupplicate Order Handler
            // ============== ORDER SIGNAL COLLECTOR (CLEAN) ================
            function AntiSpamDataCollect(custom = {}) {

                // helpers
                function getParam(name) {
                    try {
                        const urlParams = new URLSearchParams(window.location.search);
                        return urlParams.get(name) || null;
                    } catch (e) {
                        return null;
                    }
                }

                function getDeviceType() {
                    const ua = navigator.userAgent.toLowerCase();
                    if (/mobile/.test(ua)) return 'mobile';
                    if (/tablet/.test(ua)) return 'tablet';
                    return 'desktop';
                }

                function getSessionId() {
                    try {
                        let sessionId = localStorage.getItem('session_id');

                        if (!sessionId) {
                            sessionId = 'sess_' + Math.random().toString(36).substring(2) + Date.now();
                            localStorage.setItem('session_id', sessionId);
                        }

                        return sessionId;
                    } catch (e) {
                        return null;
                    }
                }

                function getFingerprint() {
                    try {
                        return [
                            navigator.userAgent,
                            screen.width,
                            screen.height,
                            navigator.language,
                            new Date().getTimezoneOffset()
                        ].join('|');
                    } catch (e) {
                        return null;
                    }
                }

                // base payload
                const payload = {
                    website: window.location.hostname || null,
                    local_session_id: getSessionId(),
                    fingerprintjs_visitor_id: fingerprintjs_visitor_id,
                    full_name: $('#full_name').val() || null,
                    phone_number: $('#phone_number').val() || null,

                    // normalize promo
                    promo: custom.promo || custom.promo_name || null,

                    fbclid: getParam('fbclid'),
                    utm_campaign: getParam('utm_campaign'),
                    utm_content: getParam('utm_content'),
                    utm_medium: getParam('utm_medium'),

                    fingerprint: getFingerprint(),
                    device_type: getDeviceType(),
                    user_agent: navigator.userAgent || null,

                    timestamp: Date.now()
                };

                // merge any extra custom fields
                const finalPayload = { ...payload, ...custom };

                // debug output
                console.log("AntiSpamDataCollect:", finalPayload);

                return finalPayload;
            }

            // =================== VALIDATE + RECORD ORDER (ONE FUNCTION) =====================
            function validateAndRecordOrder(promo) {
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

                // ======================
                // RECORD ORDER
                // ======================
                todayData.promos[promo] = (todayData.promos[promo] || 0) + 1;
                todayData.total++;

                // 🔒 lock after 3 orders
                if (todayData.total >= 3) {
                    const lockDate = new Date();
                    lockDate.setDate(lockDate.getDate() + 3);
                    todayData.locked_until = lockDate.toISOString();
                }

                saveStorage(data);

                return true;
            }
    

            // SUBMIT FORM ORDER
            $("form").on("submit", function (e) {
                e.preventDefault();
                if (!isValid()) {
                    return;
                }

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
                .done(async function( data ) {

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

                    
                    const resolvedFingerprintId = fingerprintjs_visitor_id || await initFingerprintVisitorId();

                    const payload = AntiSpamDataCollect({
                        fb_ads_id: data.order_id, // pass order ID for better tracking
                        website: '{{ $website }}',
                        session_id: '{{ $session_id }}',
                        fingerprintjs_visitor_id: resolvedFingerprintId,
                        full_name: $('#full_name').val(),
                        phone_number: $('#phone_number').val(),
                        promo: data.promo_name
                    }); // Collect AntiOrderSpam Data

                    console.log("Final Payload to send:", payload);
                    
                    fetch('/order-signal', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        body: JSON.stringify(payload)
                    }).catch(() => {});



                    const isValid = validateAndRecordOrder(data.promo_name);

                    if (!isValid) {
                        console.log("Blocked: Order limit reached");

                        alert("Order limit reached. Our team will contact you shortly.");
                        // ❌ DO NOT fire pixel
                    } else {
                        // fire FB PIXEL
                        fbq('track', 'Purchase', {
                            currency: "PHP",
                            value: data.amount
                        });
                        $('.modal').modal('open'); // open modal;
                    }

                    // clear form (always runs)
                    $('#full_name').val('');
                    $('#phone_number').val('');
                    $('#address').val('');
                    location.reload();
                    console.log("Form cleared and page reloaded");
                })
            })


        });
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

        function isValidPHNumber(number) {
            let cleaned = String(number).replace(/[\s\-\(\)]/g, '');
            // +6309XXXXXXXXX → +639XXXXXXXXX
            if (cleaned.startsWith('+6309')) cleaned = '+63' + cleaned.slice(4);
            // +639XXXXXXXXX → 09XXXXXXXXX
            if (cleaned.startsWith('+63')) cleaned = '0' + cleaned.slice(3);
            return /^09\d{9}$/.test(cleaned);
        }

        function showValidationPopup(message) {
            document.getElementById('validation-popup-message').textContent = message;
            document.getElementById('validation-popup-overlay').classList.add('show');
        }

        function closeValidationPopup() {
            document.getElementById('validation-popup-overlay').classList.remove('show');
        }

        function isValid() {
            let full_name = $('#full_name').val().trim();
            let phone_number = $('#phone_number').val().trim();
            let address = $('#address').val().trim();

            if (full_name == '') {
                showValidationPopup('Please enter your full name.');
                $.post("/event-listener", { form_validation_error: 1, website: '{{ $website }}', session_id: '{{ $session_id }}' });
                return false;
            }

            if (phone_number == '') {
                showValidationPopup('Please enter your mobile number.');
                $.post("/event-listener", { form_validation_error: 1, website: '{{ $website }}', session_id: '{{ $session_id }}' });
                return false;
            }

            if (!isValidPHNumber(phone_number)) {
                showValidationPopup('Please enter a valid Philippine mobile number.\n\nAccepted formats:\n09XX-XXX-XXXX\n+639XX-XXX-XXXX');
                $('#phone_number_validation').removeClass('thidden');
                $.post("/event-listener", { form_validation_error: 1, website: '{{ $website }}', session_id: '{{ $session_id }}' });
                return false;
            }

            if (address == '') {
                showValidationPopup('Please enter your complete address.');
                $.post("/event-listener", { form_validation_error: 1, website: '{{ $website }}', session_id: '{{ $session_id }}' });
                return false;
            }

            $('#phone_number_validation').addClass('thidden');
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
