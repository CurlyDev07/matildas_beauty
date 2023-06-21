@extends('admin.stores.layouts')


@section('page')

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Stores</span>
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
                    <a href="/admin/shopee/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Platform</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Store</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Username</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Actions</th>
                    </tr>

                    @foreach ($stores as $store)
                        <tr>
                            <td class="ttext-sm ttext-center tpy-1">
                                @if ($store->platform == 'shopee')
                                    <img src="{{ asset('images\icons\shopee.png') }}" style="width: 35px;" alt="">
                                @endif
                                @if ($store->platform == 'lazada')
                                    <img src="{{ asset('images\icons\lazada.png') }}" style="width: 35px;" alt="">
                                @endif
                                @if ($store->platform == 'tiktok')
                                    <img src="{{ asset('images\icons\tiktok.png') }}" style="width: 35px;" alt="">
                                @endif
                                @if ($store->platform == 'fb')
                                    <img src="{{ asset('images\icons\fb.png') }}" style="width: 35px;" alt="">
                                @endif

                            </td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $store->store_name }}</td>
                            <td class="ttext-sm ttext-center tpy-1">{{ $store->username }}</td>
                            <td class="ttext-sm ttext-center tpy-1">
                                <a href="/admin/stores/update/{{ $store->id }}">
                                    <i class="fas fa-edit hover:ttext-pink-500 tcursor-pointer tpx-1 icon_color tooltipped" data-position="right" data-tooltip="Edit"></i>       
                                </a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div><!-- TABLE -->

    </div>
@endsection


@section('js')
<script>
    $(document).ready(function(){
        $('.modal').modal();
        $('.dropdown-trigger').dropdown();

        // CHANGE STATUS
        $('.change_status').click(function(){
            let id = $(this).data('id');
            let status = $(this).data('status');

            $.ajax({
                url: '/admin/orders/change-status',
                type: 'POST',
                data: {
                    id: id,
                    status: status,
                },
                success: ()=>{
                   
                }
            });
        });
    });
</script>
@endsection