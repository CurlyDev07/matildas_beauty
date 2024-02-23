@extends('admin.products.layouts')

@section('css')
    <style>
        .icon_color{
            color: #9e9e9e
        }
    </style>
@endsection

    
@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-4">
            <span class="ttext-base ttext-title tfont-medium">Product List ({{ count($products) }})</span>
            <ul class="tflex">
                <li class="tmx-2 ttext-green-500">
                    <a href="?with_profit=true" class="tooltipped" data-position="top" data-tooltip="Filter Products with Profit Computation">
                        <i class="fas fa-check-square ttext-xl"></i>
                    </a>
                </li>
                <li class="tmx-2 ttext-green-500">
                    <a href="?no_selling_price=true" class="tooltipped" data-position="top" data-tooltip="Filter Products with no Selling Price">
                        <i class="fab fa-product-hunt ttext-xl"></i>
                    </a>
                </li>
                <li class="tmx-2 ttext-green-800">
                    <a href="?no_cogs=true" class="tooltipped" data-position="top" data-tooltip="Filter Products with no cogs">
                        <i class="fas fa-hand-holding-usd ttext-xl"></i>
                    </a>
                </li>
                {{-- <li class="">
                    <i class="material-icons grey-text">delete</i>
                </li> --}}
                {{-- <li class="ttext-center">
                    <i class="material-icons grey-text">sort</i>
                </li> --}}
                {{-- <li class="ttext-center">
                    <i class="material-icons grey-text">more_vert</i>
                </li> --}}
                <a href="/admin/products">
                    <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                </a>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full centered">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Photo</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Name</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Sku</th>
                        {{-- <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">SRP</th> --}}

                        @if (auth()->user()->isMaster())
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Cogs</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Profit_%</th>
                        @endif

                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Qty</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Status</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm"><i class="fas fa-cog"></i></th>
                    </tr>
                    @foreach ($products as $product)
                        <tr class="tborder-0 hover:tbg-gray-100 product">
                            <td class="tp-3 tpx-1">
                                <img src="{{ ($product['primary_image']) }}" data-src="{{ ($product['primary_image']) }}" class="tmx-auto trounded" style="height: 50px;width: 50px;">
                            </td>
                            <td class="tp-3 tpx-1">
                                <a href="{{ item_show_slug($product['title'], $product['id']) }}" target="_blank" class="hover:tunderline ttext-blue-500 ttext-sm truncate "
                                style="width: 150px; overflow-wrap: anywhere; white-space: normal;">{{ $product['title'] }}</a>
                            </td>
                            <td class="tp-3 tpx-1  " style="width: 150px; overflow-wrap: anywhere; white-space: normal;">
                                <span class="truncate ttext-sm">{{ $product['sku'] }}</span>
                            </td>

                            @php
                                $selling_price = $product['price'] - $product['profit'];
                                
                            @endphp


                            @if (auth()->user()->isMaster()) <!-- TextBox FOR ADMIN AUTO UPDATE -->
                                {{-- <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    <input type="number" onkeyup="allnumeric(this)" data-id="{{ $product['id'] }}" class="browser-default ttext-center form-control selling_price" value="{{ $selling_price }}" style="padding: 6px;">
                                </td><!-- SRP --> --}}
                  
                                <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    <input type="number" onkeyup="allnumeric(this)" data-id="{{ $product['id'] }}"class="browser-default ttext-center form-control price" value="{{ $product['price'] }}" style="padding: 6px;">
                                </td>
                                <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    <input type="number" onkeyup="allnumeric(this)" data-id="{{ $product['id'] }}"class="browser-default ttext-center form-control profit" value="{{ $product['profit'] }}" style="padding: 6px;">
                                </td>
                            @else
                                <td class="tp-3 tpx-1 ttext-sm">{{ currency() }}{{ number_format($product['selling_price']) }}</td>
                                <td class="tp-3 tpx-1 ttext-sm">{{ currency() }}{{ number_format($product['price']) }}</td>
                            @endif



                            <td class="tp-3 tpx-1 ttext-sm">{{ $product['qty'] ?? 'N/A'  }}</td>
                            <td class="tp-3 tpx-1 ttext-sm">
                                @if ($product['status'] == 'active')
                                    <span class="chip green lighten-5 waves-effect waves-green status" data-status="inactive" data-id="{{ $product['id'] }}" style="cursor: pointer;">
                                        <span class="green-text" style="cursor: pointer;">{{ $product['status'] }}</span>
                                    </span>
                                @else
                                    <span class="chip red lighten-5 waves-effect waves-red status" data-status="active" data-id="{{ $product['id'] }}" style="cursor: pointer;">
                                        <span class="red-text" style="cursor: pointer;">{{ $product['status'] }}</span>
                                    </span>
                                @endif
                            </td>
                            <td class="ttext-center">
                                <ul class="tflex tjustify-center">
                                    <li>
                                        <a href="{{ route('products.update', ['id' => $product['id']]) }}" target="_blank">
                                            <i class="fas fa-edit hover:ttext-green-500 tcursor-pointer tpx-1 icon_color"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)" class="delete" data-property_id="{{ $product['id'] }}">
                                            <i class="fas fa-trash-alt hover:ttext-red-500 tcursor-pointer tpx-1 icon_color"></i>
                                        </a>
                                    </li>
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
        </div>
    </div>
@endsection


@section('js')


    <script>

        $('.profit').change(function(){
            let id = $(this).data('id')
            let profit = $(this).val();

            console.log('id: ' +id);
            console.log('profit: ' +profit);

            $.ajax({
                type: 'POST',
                url: '{{ route("products.change_profit") }}',
                data: {
                    id: id,
                    profit:profit
                },
            });
        });// Onchange Profit

        $('.price').change(function(){
            let id = $(this).data('id')
            let price = $(this).val();

            console.log('id: ' +id);
            console.log('price: ' +price);

            $.ajax({
                type: 'POST',
                url: '{{ route("products.change_price") }}',
                data: {
                    id: id,
                    price:price
                },
            });
        });// Onchange Capital





        $('.delete').click(function (e) {
            $.ajax({
                type: 'POST',
                url: '{{ route("products.delete") }}',
                data: {
                    property_ids: [$(this).data('property_id')]
                },
            });

            $(this).parent().parent().parent().parent().remove();
        });

        $('.status').click(function () {
            let status = $(this).data('status');
            let id = $(this).data('id');
            let self = $(this);

            $.ajax({
                type: 'POST',
                url: '{{ route("products.status") }}',
                data: {
                    status: status,
                    id: id,
                },
                success: function (data) {
                    // CHANGE THE UI
                    if (status == 'inactive') {
                        self.data('status', 'active');
                        self.attr('class', 'chip red lighten-5 waves-effect waves-red status');
                        self.children().html('inactive')
                        self.children().attr('class', 'red-text')
                    }else{
                        self.data('status', 'inactive');
                        self.attr('class', 'chip green lighten-5 waves-effect waves-green status');
                        self.children().html('active')
                        self.children().attr('class', 'green-text')
                    }
                }
            });
        });
    </script>
@endsection