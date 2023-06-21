@extends('admin.inventory.layouts')


@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Inventory List</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search sku or name">
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
                    <a href="/admin/inventory">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tflex-col">
            <table class="tmb-4 tbg-white ttext-md tw-full centered">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Photo</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Sku</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Qty</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">status</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium"><i class="fas fa-cog"></i></th>
                    </tr>
                    @foreach ($products as $product)
                        <tr class="tborder-0 hover:tbg-gray-100">
                            <td class="tp-3 tpx-5">
                                <img src="{{ $product['images'][0]['img'] }}" data-src="{{ $product['images'][0]['img'] }}" class="tmx-auto" style="height: 50px;width: 50px;">
                            </td>
                            <td class="tp-3 tpx-5 ttext-sm">{{ $product['sku'] }}</td>
                            <td class="tp-3 tpx-5 ttext-sm">
                                <a href="{{ item_show_slug($product['title'], $product['id']) }}" target="_blank" class="hover:tunderline ttext-blue-500">{{ $product['title'] }}</a>
                            </td>
                            <td class="tp-3 tpx-5 ttext-sm">{{ $product['qty'] }}</td>
                            <td class="tp-3 tpx-5">
                                @if ($product['qty'] < 1)
                                    <span class="tm-0 chip red lighten-5 waves-effect waves-red status" data-status="active" data-id="{{ $product['id'] }}" style="cursor: pointer;">
                                        <span class="red-text" style="cursor: pointer;">Out of Stock</span>
                                    </span><!-- RED CHIP -->
                                @elseIf($product['qty'] <= $product['threshold'])
                                    <span class="tm-0 chip orange lighten-3 waves-effect waves-orange status" data-status="inactive" data-id="{{ $product['id'] }}" style="cursor: pointer;">
                                        <span class="" style="cursor: pointer;color: #ff6d00;">Threshold Reached</span>
                                    </span><!-- ORANGE CHIP -->
                                @else
                                    <span class="tm-0 chip green lighten-5 waves-effect waves-green status" data-status="inactive" data-id="{{ $product['id'] }}" style="cursor: pointer;">
                                        <span class="green-text" style="cursor: pointer;">Available</span>
                                    </span><!-- GREEN CHIP -->
                                @endif
                            </td>
                            <td class="ttext-center">
                                <ul class="tflex tjustify-center">
                                    <li>
                                        <a href="{{ route('products.update', ['id' => $product['id']]) }}" target="_blank">
                                            <i class="fas fa-edit hover:ttext-green-500 tcursor-pointer tpx-1 icon_color"></i>
                                        </a>
                                    </li>
                                    {{-- <li>
                                        <a href="javascript:void(0)" class="delete" data-property_id="{{ $product['id'] }}">
                                            <i class="fas fa-trash-alt hover:ttext-red-500 tcursor-pointer tpx-1 icon_color"></i>
                                        </a>
                                    </li> --}}
                                </ul>
                            </td>
                           
                        </tr>
                    @endforeach

                    @if (count($products) < 1)
                        <tr>
                            <td colspan="6" class=" ttext-center">
                                <a href="/admin/products/add" class="tfont-medium ttext-blue-500 tunderline">Upload your first product</a>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>

            {{ $products->links() }}

        </div>
    </div>
@endsection

@section('js')

@endsection