@extends('admin.suppliers.layouts')


@section('page')



    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Suppliers <span class="ttext-gray-500 ttext-xl">></span> Products</span>
            <ul class="tflex titems-center">
                {{-- <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH --> --}}
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
                {{-- <li>
                    <a href="/admin/shopee/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li> --}}
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Image</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Title</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Sku</th>
                    </tr>

                    @foreach ($products as $product)
                        <tr class="tborder-0 hover:tbg-gray-100 product">
                            <td class="tp-3 tpx-1 ttext-center">
                                <img src="{{ $product->primary_image }}" data-src="{{ $product->primary_image }}" class="tmx-auto trounded ttext-center" style="height: 50px;width: 50px;">
                            </td>
                            <td class="tp-3 tpx-1 ttext-center">
                                <span class="ttext-sm truncate ttext-center">{{ $product->title }}</span>
                            </td>
                            <td class="tp-3 tpx-1 ttext-center">
                                <span class="ttext-sm truncate ttext-center">{{ $product->sku }}</span>
                            </td>
                            {{-- <td class="tp-3 tpx-1 ttext-center">
                                <a href="" target="_blank" class="hover:tunderline ttext-blue-500 ttext-sm truncate ttext-center " style="width: 150px; overflow-wrap: anywhere; white-space: normal;">{{ $product->title }}</a>
                            </td>
                            <td class="tp-3 tpx-1 ttext-center  " style="width: 150px; overflow-wrap: anywhere; white-space: normal;">
                                <a href="" target="_blank" class="hover:tunderline ttext-blue-500 ttext-sm truncate ttext-center" style="width: 150px; overflow-wrap: anywhere; white-space: normal;">{{ $product->sku }}</a>
                            </td> --}}
                        </tr>
                    @endforeach
                </tbody>
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