@extends('admin.lab.layouts')


@section('page')


<!-- Production Details (Ultra-Compact) -->
<div class="chem-card" style="margin-bottom:12px;">

    <!-- Header -->
    <div style="
        padding:12px 14px;
        border-bottom:1px solid #eef2f7;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:10px;
    ">
        <div style="display:flex;align-items:center;gap:10px;">
            <div style="
                width:32px;height:32px;
                border-radius:10px;
                display:flex;
                align-items:center;
                justify-content:center;
                background:#f1f5f9;
                border:1px solid #e2e8f0;
                color:#334155;
            ">
                <i class="fas fa-industry"></i>
            </div>

            <div>
                <div style="font-size:15px;font-weight:900;color:#0f172a;line-height:1;">
                    {{ $production->product_name }}
                </div>
                <div style="font-size:12px;color:#64748b;">
                    Batch <strong style="color:#0f172a;">{{ $production->batch_number }}</strong>
                </div>
            </div>
        </div>

        <div style="display:flex;align-items:center;gap:14px;">
            <div style="text-align:right;">
                <div style="font-size:11px;color:#94a3b8;font-weight:700;">Date</div>
                <div style="font-size:13px;font-weight:800;">
                    {{ date_f($production->date, 'M, d, Y') }}
                </div>
            </div>

            <div style="text-align:right;">
                <div style="font-size:11px;color:#94a3b8;font-weight:700;">Total Cost</div>
                <div style="font-size:14px;font-weight:900;color:#166534;">
                    ₱{{ number_format($production->total, 2) }}
                </div>
            </div>

            <a href="/admin/lab/production"
               class="inv-icon-btn"
               style="width:36px;height:36px;background:#fff;border-color:#e2e8f0;color:#64748b;"
               title="Back">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
    </div>

    <!-- Compact Stats Row -->
    <div style="padding:10px 14px;">
        <div style="
            display:grid;
            grid-template-columns: repeat(3, 1fr);
            gap:8px;
        ">
            <div style="padding:8px 10px;border:1px solid #eef2f7;border-radius:10px;">
                <div style="font-size:11px;color:#94a3b8;font-weight:700;">Weight</div>
                <div style="font-size:14px;font-weight:900;">
                    {{ number_format($production->total_weight, 2) }}g
                </div>
            </div>

            <div style="padding:8px 10px;border:1px solid #eef2f7;border-radius:10px;">
                <div style="font-size:11px;color:#94a3b8;font-weight:700;">Quantity</div>
                <div style="font-size:14px;font-weight:900;">
                    {{ number_format($production->total_quantity, 2) }} pcs
                </div>
            </div>

            <div style="padding:8px 10px;border:1px solid #eef2f7;border-radius:10px;">
                <div style="font-size:11px;color:#94a3b8;font-weight:700;">Actual</div>
                <div style="font-size:14px;font-weight:900;">
                    {{ $production->actual_quantity ? number_format($production->actual_quantity,2).' pcs' : '—' }}
                </div>
            </div>
        </div>

        <!-- Comment (inline, small) -->
        @if(!empty($production->comment))
            <div style="
                margin-top:8px;
                padding:8px 10px;
                border:1px dashed #e5e7eb;
                border-radius:10px;
                background:#f9fafb;
                font-size:13px;
                color:#334155;
            ">
                <strong style="font-size:11px;color:#94a3b8;">Comment:</strong>
                {{ $production->comment }}
            </div>
        @endif
    </div>
</div>


<!-- Ingredients Used (Tight Table) -->
<div class="chem-card">
    <div style="padding:14px 16px; border-bottom:1px solid #eef2f7; display:flex; align-items:center; justify-content:space-between; gap:10px;">
        <div style="display:flex; align-items:center; gap:10px;">
            <div style="width:34px; height:34px; border-radius:12px; display:flex; align-items:center; justify-content:center; background:#f1f5f9; border:1px solid #e2e8f0; color:#334155;">
                <i class="fas fa-flask"></i>
            </div>
            <div>
                <div style="font-size:15px; font-weight:900; color:#0f172a; line-height:1.1;">Ingredients Used</div>
                <div style="font-size:12px; color:#94a3b8; margin-top:2px;">Materials breakdown</div>
            </div>
        </div>
    </div>

    <div class="toverflow-x-auto">
        <table class="chem-table">
            <thead>
                <tr>
                    <th>Ingredient</th>
                    <th class="">₱/Gram</th>
                    <th class="">% Used</th>
                    <th class="">Grams</th>
                    <th class="">Price</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($production->ingredients as $ingredient)
                    <tr>
                        <td>
                            <div class="chem-name">{{ $ingredient->product_name }}</div>
                            <div class="chem-sub">Material</div>
                        </td>

                        <td class=" tfont-semibold">
                            ₱{{ number_format($ingredient->product_price_per_grams, 2) }}
                        </td>

                        <td class=" tfont-semibold">
                            {{ number_format($ingredient->product_percentage, 2) }}%
                        </td>

                        <td class=" tfont-semibold">
                            {{ number_format($ingredient->grams, 2) }}
                        </td>

                        <td class=" tfont-semibold" style="color:#166534;">
                            ₱{{ number_format($ingredient->price, 2) }}
                        </td>
                    </tr>
                @endforeach

                @if(count($production->ingredients) == 0)
                    <tr>
                        <td colspan="5" class="chem-center" style="padding:28px 18px; color:#94a3b8;">
                            No ingredients recorded for this batch.
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