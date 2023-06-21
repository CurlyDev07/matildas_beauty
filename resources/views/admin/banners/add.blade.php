@extends('admin.banners.layouts')


@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Add Banner</span>
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
            <div class="tflex tjustify-between tmb-1">
                <span class="tfont-normal ttext-sm tmb-2 ttext-black-100">Banner URL</span>
                <span class="tfont-normal ttext-sm tmb-2 ttext-black-100">Upload 915 x 344 Banner</span>
            </div>
            <div id="banner_container">
                <div class="tmb-3">
                    <div class="tflex tflex-wrap tw-full tmb-4 trelative">
                        <input type="text"  placeholder="https://example.com/products/black-tea" class="browser-default tw-1/4 tflex titems-center tleading-normal tbg-grey-lighter trounded trounded-r-none tborder tborder-r-0 tborder-grey-light tpx-3 twhitespace-no-wrap ttext-grey-dark ttext-sm">
                        <input type="file" class="banner_input browser-default tw-1/4 tborder tborder-grey-light tflex-1 tflex-auto tflex-grow tflex-shrink th-10 tleading-normal tpx-3 tpy-1 trelative tw-px">
                        <input type="text"  placeholder="Alt" class="browser-default tbg-grey-lighter tborder tborder-grey-light tborder-l-0 tflex titems-center tleading-normal tpx-3 ttext-grey-dark ttext-sm tw-1/4 twhitespace-no-wrap">
                        <select class="browser-default tbg-grey-lighter tborder tborder-grey-light tborder-l-0 tflex titems-center tleading-normal tpx-3 ttext-grey-dark ttext-sm tw-1/4 twhitespace-no-wrap">
                            <option value="915_x_344">915 x 344</option>
                            <option value="297_x_172">297 x 172</option>
                        </select>
                        <label class="remove active tcursor-pointer tunderline tml-auto" style="color: #ff6345;">remove</label>
                    </div>
                </div>
            </div>
            {{-- btns --}}
            <div class="tflex tmt-2">
                <button id="add_banner" class="focus:tbg-gray-100 focus:toutline-none hover:tbg-gray-100 tbg-white tborder tpx-6 tpy-2 trounded ttext-black-100 ttext-sm waves-effect">
                    Add Banner
                </button>
                <button id="upload_banners" class="focus:tbg-primary focus:toutline-none tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect waves-green">Save</button>
            </div>
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