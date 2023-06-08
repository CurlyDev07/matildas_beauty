
    <footer>
        <script src="{{ asset('js/jquery-3.4.1.min.js') }}"  crossorigin="anonymous"></script>
        <script src="{{ asset('js/materialize.min.js') }}"  crossorigin="anonymous"></script>
        <script src="{{ asset('js/main.js') }}"  crossorigin="anonymous"></script>
        <script src="{{ asset('js/jquery.unveil.min.js') }}"  crossorigin="anonymous"></script>


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

            $(document).ready(function() {
                $("img").unveil();
            });// lazy loading
        </script>

        @yield('js')
    </footer>
</body>
</html>