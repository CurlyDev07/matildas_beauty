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
            <ul class="tflex titems-center">
                <li class="tmx-2 ttext-green-500">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center tbg-red-500">
                        <a href="?no_selling_price=true" class="tooltipped" data-position="top" data-tooltip="No SRP Product">
                            <span class="tpl-1 ttext-white">
                                <i class="fas fa-bookmark"></i>
                                No Srp
                            </span>
                        </a>
                    </div>
                </li><!-- No Srp -->
                <li class="tmx-2 ttext-green-500">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center tbg-green-500">
                        <a href="?no_cogs=true" class="tooltipped" data-position="top" data-tooltip="No Capital">
                            <span class="tpl-1 ttext-white">
                                <i class="fas fa-bookmark"></i>
                                No Capital
                            </span>
                        </a>
                    </div>
                </li><!-- No Capital -->
                <li class="tmx-2 ttext-green-500">
                    <div class="tborder tflex tp-1 trounded ttext-sm titems-center tbg-red-500">
                        <a href="?out_of_stock=true" class="tooltipped" data-position="top" data-tooltip="Out of Stock">
                            <span class="tpl-1 ttext-white">
                                <i class="fas fa-bookmark"></i>
                                Out of Stock
                            </span>
                        </a>
                    </div>
                </li><!-- Out of Stock-->

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
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">SRP</th>

                        @if (auth()->user()->isMaster())
                            <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium ttext-sm">Cogs</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-orange-700 tfont-medium ttext-sm tooltipped tcursor-pointer" data-position="top" data-tooltip="(Srp - 28.82% - Cogs - 10php">Profit</th>
                            <th class="ttext-center tp-3 tpx-5 ttext-orange-700 tfont-medium ttext-sm tooltipped tcursor-pointer" data-position="top" data-tooltip="(28.82 * Srp) + 10">Charges</th>
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

                            @if (auth()->user()->isMaster()) <!-- TextBox FOR ADMIN AUTO UPDATE -->
                                @php
                                    $selling_price = $product['selling_price'] > 1? $product['selling_price'] : 1;
                                    $cogs = $product['price'] > 0? $product['price'] : 1;
                                    $packaging_cost = 10;
                                    $total_charges_percentage = 28.82;
                                    $total_charges = (($total_charges_percentage/100) * $selling_price) + $packaging_cost;
                                    $profit = $selling_price - ($total_charges + $cogs);
                                    $profit_percentage = ($profit/$selling_price) * 100;

                                @endphp

                                <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    <input type="number" onkeyup="allnumeric(this)" data-id="{{ $product['id'] }}" class="browser-default ttext-center form-control selling_price" value="{{ $product['selling_price'] }}" style="padding: 6px;">
                                </td><!-- SRP -->
                  
                                <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    <button class="browser-default ttext-center cogs tbg-green-700 ttext-white tpx-2 tpy-1 trounded tmb-1" data-id="{{ $product['id'] }}">Get_Cogs</button>
                                    <input type="number" onkeyup="allnumeric(this)" data-id="{{ $product['id'] }}"class="browser-default ttext-center form-control price" value="{{ $product['price'] }}" style="padding: 6px;">
                                </td><!-- Cogs -->
                                <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    @if ($selling_price <= 1)
                                        --
                                    @elseif($cogs <= 1)
                                        --
                                    @else 
                                        @if ($profit < 20)
                                            <div class="tflex tflex-col">
                                                <div class="ttext-red-500"><u><b>{{ number_format($profit, 2) }}</b></u></div>
                                                <div class="ttext-red-500">({{ number_format($profit_percentage, 2) }}%)</div>
                                            </div>
                                        @else
                                            <div class="tflex tflex-col">
                                                <div class="ttext-green-600"><u><b>{{ number_format($profit, 2) }}</b></u></div>
                                                <div class="ttext-green-600">({{ number_format($profit_percentage, 2) }}%)</div>
                                            </div>
                                        @endif
                                        
                                    @endif
                                </td><!-- Profit -->
                                <td class="tp-3 tpx-1 ttext-sm tw-0 ttext">
                                    @if ($selling_price <= 1)
                                        --
                                    @elseif($cogs <= 1)
                                        --
                                    @else 
                                        <div class="tflex tflex-col">
                                            <div class="">{{ number_format($total_charges, 2) }}</div>
                                        </div>
                                    @endif
                                </td><!-- Total Charges -->

                            @else
                                <td class="tp-3 tpx-1 ttext-sm">{{ currency() }}{{ number_format($product['selling_price']) }}</td>
                                {{-- <td class="tp-3 tpx-1 ttext-sm">{{ currency() }}{{ number_format($product['price']) }}</td> --}}
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
        @if (count($products) < 1)
            <tr>
                <td colspan="6" class=" ttext-center">
                    <a href="/admin/products/add" class="tfont-medium ttext-blue-500 tunderline">Upload your first product</a>
                </td>
            </tr>
        @endif

        {{ $products->onEachSide(1)->appends(request()->except('page'))->links() }}
    </div>
@endsection


@section('js')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>

        $('.cogs').click(function () {
            let id = $(this).data('id');
            let dis = $(this);

            $.ajax({
                type: 'POST',
                url: '{{ route("products.get_cogs") }}',
                data: {
                    id: id,
                },
                success: function(data) {
                    if (data == 0) {
                        Swal.fire({
                            position: "top-end",
                            icon: "warning",
                            title: "No Purchase Record",
                            showConfirmButton: false,
                            timer: 300
                        });
                    }

                    console.log(data); 
                    dis.next().val(data)
                }
            });
        })// Get Cogs From Last Purchase

        $('.profit').change(function(){
            let id = $(this).data('id')
            let profit = $(this).val();

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

        $('.selling_price').change(function(){
            let id = $(this).data('id')
            let selling_price = $(this).val();

            console.log('id: ' +id);
            console.log('selling_price: ' +selling_price);

            $.ajax({
                type: 'POST',
                url: '{{ route("products.selling_price") }}',
                data: {
                    id: id,
                    selling_price:selling_price
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