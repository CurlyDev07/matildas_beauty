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
            <span class="ttext-base ttext-title tfont-medium">Product List</span>
            <ul class="tflex">
                <li class="">
                    <i class="material-icons grey-text">delete</i>
                </li>
                <li class="ttext-center">
                    <i class="material-icons grey-text">sort</i>
                </li>
                <li class="ttext-center">
                    <i class="material-icons grey-text">more_vert</i>
                </li>
            </ul>
        </div>
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full centered">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">ID</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Photo</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Name</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Sku</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Selling Price</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Campaign Price</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Cogs</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Qty</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium">Status</th>
                        <th class="ttext-center tp-3 tpx-5 ttext-black-100 tfont-medium"><i class="fas fa-cog"></i></th>
                    </tr>
                    @foreach ($products as $product)
                        <tr class="tborder-0 hover:tbg-gray-100">
                            <td class="tp-3 tpx-5 ttext-black-100 tfont-medium">#{{ $product['id'] }}</td>
                            <td class="tp-3 tpx-5">
                                <img src="{{ $product['primary_image'] }}" class="tmx-auto" style="height: 50px;width: 50px;">
                            </td>
                            <td class="tp-3 tpx-5">
                                <a href="{{ item_show_slug($product['title'], $product['id']) }}" target="_blank" class="hover:tunderline ttext-blue-500">{{ $product['title'] }}</a>
                            </td>
                            <td class="tp-3 tpx-5"> {{ $product['sku'] }} </td>
                            <td class="tp-3 tpx-5">{{ currency() }}{{ number_format($product['selling_price']) }}</td>
                            <td class="tp-3 tpx-5">{{ currency() }}{{ number_format($product['campaign_price']) }}</td>
                            <td class="tp-3 tpx-5">{{ currency() }}{{ number_format($product['price']) }}</td>
                            <td class="tp-3 tpx-5">{{ $product['qty'] ?? 'N/A'  }}</td>
                            <td class="tp-3 tpx-5">
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