@extends('admin.banners.layouts')


@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Banner List</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
                <li class="tmr-4 tpt-1">
                    @if (request()->sort == 'asc')
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by newest">
                            <i class="material-icons grey-text tmr-3">sort_by_alpha</i>
                        </a>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="tooltipped" data-position="top" data-tooltip="Sort by oldest">
                            <i class="material-icons grey-text">sort_by_alpha</i>
                        </a>
                    @endif
                </li><!-- SORT -->
                <li>
                    <a href="/admin/orders/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tflex-col">
           
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
    <script>
        $('#add_banner').click(function () {
            $('#banner_container').children().last().clone(true, true).appendTo($('#banner_container'));
        });
       

        $(document).on('change', '.banner_input', function(e){
            var files = e.target.files;
            let self = $(this);

            // UPLOAD IMAGE
            $.each(files, function(i, file){
                var reader = new FileReader();
                reader.readAsDataURL(file);
                reader.onload = function(e){
                    var base64Img = e.target.result;
                    if (base64MimeType(base64Img) != 'image') {
                        alert('The file must be an image');
                        return;
                    }
                    self.attr('base64Img', base64Img);
                }
            });
        });

        /*-------------------------------------------
            REMOVE
        --------------------------------------------*/
        $(document).on('click', '.remove', function () {
            if ($('.banner_input').length < 2) {
                Swal.fire(
                    'Oooops!',
                    "You can't delete this form",
                    'info'
                )
                return;
            }
            $(this).parent().parent().remove();
        });

        /*-------------------------------------------
            UPLOAD
        --------------------------------------------*/
        $('#upload_banners').click(()=>{
            let banner = [];
            $('.banner_input').each(function () {
                banner.push({
                    url: $(this).prev().val(),
                    alt: $(this).next().val(),
                    size:  $(this).next().next().val(),
                    image: $(this).attr('base64img'),
                });
            });
            $.ajax({
                type: 'POST',
                url: "/admin/banners/store",
                data: {banner},
                success: function () {
                    
                }
            });
        });

    </script>
@endsection