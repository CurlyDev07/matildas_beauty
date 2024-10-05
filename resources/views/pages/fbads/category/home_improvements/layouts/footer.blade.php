
<footer>

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

    <script> // allnumeric
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

            $('.loader').removeClass('thidden');// SHOW LOADER

            let url = $(this).attr('action');

            $.post(url, {
                full_name: $('#full_name').val(),
                phone_number: $('#phone_number').val(),
                address: $('#address').val(),
                promo: $('.promo:checked').val(),
            })
            .done(function( data ) {    
                fbq('track', 'Purchase', {currency: "PHP", value: data.amount});// send data to fb pixel

                // change html content of success modal
                $('#modal-order-number').html(data.order_number);
                $('#modal-promo').html(data.promo);
                $('#modal-amount').html(data.amount);
                $('.modal').modal('open'); // open modal

                $('.loader').addClass('thidden');// HIDE LOADER

                eventListener('order_success');// Track event

                $.post("/Madella-Order-Success-Email",{
                    data,
                });// Email Notif
            });
        })

        $('.order_now').click(function (e) {
            $('html, body').animate({
                scrollTop: $('#form').offset().top + 9999
            }, 'slow');// SCROLL BACK TO FORM AFTER Submit with error validation

            eventListener('order_form');// Track event
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


        // EVENT LISTENER
        $('#full_name').click(function (e) {
            eventListener('full_name');// Track event
        });
        
        $('#phone_number').click(function (e) {
            eventListener('phone_number');// Track event
        });

        $('#address').click(function (e) {
            eventListener('address');// Track event
        });

        $('.promo').click(function (e) {
            eventListener('promo');// Track event
        });

        $('#submit_btn').click(function () {
            eventListener('submit_order');// Track event
        })

        //  Track event
        eventListener('visitors');

        function eventListener(event){
            let data = {[event]: 1}
            $.post("/event-listener",data);
        }//  EVENT LISTENER

    </script>
    
</footer>

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