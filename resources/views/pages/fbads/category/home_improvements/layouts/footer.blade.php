
<footer>
        
    <!----- Tiktok Pixel ViewContent ----->
    <script>

        ttq.track('ViewContent', {
            "contents": [
                {
                    "content_id": "1",
                    "content_type": "product", 
                    "content_name": "Matilda's Beauty MissTisa Melasma Rejuvenating Skincare Set", 
                    "content_category": "Beauty Products",
                    "brand": "MissTisa"
                }
            ]
        });

    </script>

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

    @if (request()->amount)
        <script>
            let fb_purchase_value = $('#purchase_value').val()? $('#purchase_value').val() : 0;
        </script>
    @endif

    <script>
         $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
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

        $('#promo4').change(function () {
            $('#total').html($(this).val().split('|')[1]);
            $("#promo1").prop('checked', false);
            $("#promo2").prop('checked', false);
            $("#promo3").prop('checked', false);
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
                button.stop(true).css('z-index', 999).animate({
                    opacity: 1
                }, 50);
            }
        });// hide show ORDER BUTTON on Scroll

        $('.order_now').click(function (e) {
            $('html, body').animate({
                scrollTop: $('#form').offset().top - 20 //#DIV_ID is an example. Use the id of your destination on the page
            }, 'slow');

            $.post("/event-listener",{
                order_form: 1
            });// EVENT LISTENER Track ORDER FORM

            ttq.track('AddPaymentInfo', {
                "contents": [
                    {
                        "content_id": "1", 
                        "content_type": "product",
                        "content_name": "" 
                    }
                ],
                "description": "" 
            });// Tiktok Event
        });

        $('#full_name').click(function (e) {
            $.post("/event-listener",{
                full_name: 1
            });// EVENT LISTENER Track ENTER FULL NAME
        });
        
        $('#phone_number').click(function (e) {
            $.post("/event-listener",{
                phone_number: 1
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('#address').click(function (e) {
            $.post("/event-listener",{
                address: 1
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('.promo').click(function (e) {
            $.post("/event-listener",{
                promo: 1
            });// EVENT LISTENER Track ENTER CONTACT NUMBER
        });

        $('#submit_btn').click(function () {
            $.post("/event-listener",{
                submit_order: 1
            });//  EVENT LISTENER Track SUBMIT ORDER
            
            let amount = $('#total').html();

            ttq.track('InitiateCheckout', {
                "contents": [
                    {
                        "content_id": "1",
                        "content_type": "product",
                        "content_name": "",
                        "quantity": 1,
                        "price": amount
                    }
                ],
                "value": amount,
                "currency": "PHP" 
            });//TIktok Event

        })

        $("#form").submit(function(event) {
            $('#submit_btn').addClass('thidden');
            $('#loader').removeClass('thidden');
        });

        $.post("/event-listener",{
            visitors: 1
        });//  EVENT LISTENER Track VIEW

    </script>
</footer>

@if(session()->has('success'))
<script>
    $(document).ready(function(){
        $('.modal').modal();
        $('.modal').modal('open');
    });// OPEN THANK YOU MODAL

    $.post("/event-listener",{
        order_success: 1
    });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS
</script>
@endif

@if(session()->get('errors'))
    <script>
        $('html, body').animate({
            scrollTop: $('#form').offset().top + 9999
        }, 'slow');// SCROLL BACK TO FORM AFTER Submit with error validation

        $.post("/event-listener",{
            form_validation_error: "{{ $errors->first() }}"
        });//  EVENT LISTENER Track SUBMIT ORDER SUCCESS
    </script>
@endif

</body>
</html>