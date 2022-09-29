<div id="wishlist" class="col s12">
    <div class="ttext-2xl ttext-title tfont-medium tpb-4">Wish List</div>
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-4">
            <span class="ttext-base ttext-title tfont-medium">Wish Lis</span>
            <ul class="tflex">
                <li class="ttext-center">
                    <i class="material-icons grey-text">more_vert</i>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="tp-3 tpx-5 ttext-black-100 tfont-medium">Photo</th>
                        <th class="tp-3 tpx-5 ttext-black-100 tfont-medium">Price</th>
                    </tr>
                    @foreach ($wishlists as $wishlist)
                        {{-- {{ dd($wishlist) }} --}}
                        <tr class="tborder-0 hover:tbg-gray-100">
                            <td class="tp-3 tpx-5">
                                <a href="{{ item_show_slug($wishlist['products']['title'], $wishlist['products']['id']) }}" target="_blank" class="hover:tunderline ttext-blue-500">
                                    {{ $wishlist['products']['title'] }}
                                </a>
                            </td>
                            <td class="tp-3 tpx-5">
                                <img src="{{ $wishlist['products']['images'][0]['img'] }}" class="" style="height: 50px;width: 50px;">
                            </td>
                            <td class="tp-3 tpx-5">{{ currency() }}{{ $wishlist['products']['price'] }}</td>
                            <td class="ttext-center">
                                <ul class="tflex tjustify-center">
                                    <li>
                                        <a href="javascript:void(0)" class="delete">
                                            <i class="fas fa-trash-alt hover:ttext-red-500 tcursor-pointer tpx-1 icon_color delete_wishlist" product_id="{{ $wishlist['products']['id'] }}"></i>
                                        </a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

{{-- @section('js')
   

@endsection --}}