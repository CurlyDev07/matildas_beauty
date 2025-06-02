@extends('admin.lab.layouts')


@section('page')
        <div class="tbg-white tshadow-md trounded tpx-6 tpy-4 tmb-6">
            <h2 class="ttext-xl tfont-semibold ttext-gray-800 tmb-4">Production Details</h2>

            <div class="tgrid tgrid-cols-3 tgap-x-6 tgap-y-3 ttext-sm ttext-gray-700">
                <div class="tflex tjustify-around">
                    <div class="tw-1/3">
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Product:</span> <span class="ttext-orange-700"> {{ $production->product_name }}</span></p>
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Batch #:</span><span class="ttext-orange-700"> {{ $production->batch_number }}</span> </p>
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Total Weight:</span><span class="ttext-orange-700"> {{ $production->total_weight }}g</span> </p>
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Total Cost:</span> <span class="ttext-orange-700"> ₱{{ number_format($production->total, 2) }}</span></p>
                    </div>
                    <div class="tw-1/3">
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Total Quantity:</span> <span class="ttext-orange-700"> {{ $production->total_quantity }} pcs</span></p>
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Actual Quantity:</span><span class="ttext-orange-700">  —<</span>/p>
                        <p class="ttext-lg tmb-2"><span class="tfont-semibold">Date:</span> <span class="ttext-orange-700"> {{ date_f($production->date, 'M, d, Y') }}</span></p>
                    </div>
                    <div class="tw-1/3">
                        <p class="tcol-span-3 tmt-2">
                            <span class="tfont-semibold">Comment:</span> {{ $production->comment }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <div class="tbg-white tshadow-md trounded tpx-6 tpy-4">
        <h3 class="ttext-lg tfont-semibold ttext-gray-800 tmb-4">Ingredients Used</h3>

            <div class="toverflow-x-auto">
                <table class="tmin-w-full tborder-collapse">
                    <thead>
                        <tr class="tbg-gray-100 ttext-left ttext-sm ttext-gray-700">
                        <th class="tpy-2 tpx-4">Ingredient</th>
                        <th class="tpy-2 tpx-4">Price/Gram</th>
                        <th class="tpy-2 tpx-4">% Used</th>
                        <th class="tpy-2 tpx-4">Grams</th>
                        <th class="tpy-2 tpx-4">Price</th>
                        </tr>
                    </thead>
                    <tbody class="ttext-sm ttext-gray-800">
                        @foreach ($production->ingredients as $ingredient)
                        <tr class="tborder-t">
                            <td class="tpy-2 tpx-4">{{ $ingredient->product_name }}</td>
                            <td class="tpy-2 tpx-4">₱{{ $ingredient->product_price_per_grams }}</td>
                            <td class="tpy-2 tpx-4">{{ $ingredient->product_percentage }}%</td>
                            <td class="tpy-2 tpx-4">{{ $ingredient->grams }}</td>
                            <td class="tpy-2 tpx-4">₱{{ $ingredient->price }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>




@endsection


@section('js')
<script>
    $(document).ready(function(){
        $('.dropdown-trigger').dropdown();


        function pricePerUnit() {
            let price = parseFloat($('#price').val()) || 0;
            let weight = parseFloat($('#weight').val()) || 0;
            let price_per_grams = 0;

            price_per_grams = price/weight;
            price_per_grams = price_per_grams.toFixed(2); // round to 2 decimal places

            $('#price_per_grams').val(price_per_grams);
        }
        
        $('#price').keyup(function () {
            pricePerUnit();
        })

        $('#weight').keyup(function () {
            pricePerUnit();
        })


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

        $('#supplier').change(function (e) {
        e.preventDefault();

        const parser = new URL(window.location.href);
        parser.searchParams.set("supplier", $(this).val());
        window.location = parser.href;

        return false;

    });
    });
</script>
@endsection