@extends('admin.lab.layouts')



@section('page')
    <style>
        /* ===== Inventory Card ===== */
        .inv-card{
        background:#fff;
        border:1px solid #e9eef6;
        border-radius:16px;
        box-shadow:0 10px 26px rgba(15,23,42,.06);
        overflow:hidden;
        }

        /* ===== Header / Toolbar ===== */
        .inv-header{
        padding:14px 18px;
        border-bottom:1px solid #eef2f7;
        display:flex;
        align-items:center;
        justify-content:space-between;
        gap:16px;
        }

        .inv-title{
        font-size:24px;
        font-weight:800;
        color:#0f172a;
        display:flex;
        align-items:center;
        gap:10px;
        white-space:nowrap;
        }

        .inv-meta{
        font-size:14px;
        font-weight:600;
        color:#475569;
        white-space:nowrap;
        }
        .inv-meta b{ color:#166534; }

        /* Toolbar group */
        .inv-tools{
        display:flex;
        align-items:center;
        gap:12px;
        flex-wrap:wrap;
        justify-content:flex-end;
        }

        /* ===== Buttons ===== */
        .inv-icon-btn{
        width:44px;
        height:44px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        border-radius:12px;
        border:1px solid #dbeafe;
        background:#dcfce7;
        color:#166534;
        text-decoration:none;
        transition: transform .12s ease, box-shadow .12s ease, background-color .12s ease;
        }
        .inv-icon-btn:hover{
        background:#bbf7d0;
        box-shadow:0 14px 24px rgba(22,163,74,.16);
        transform: translateY(-1px);
        }
        .inv-icon-btn:active{ transform: scale(.96); }

        /* ===== Search group ===== */
        .inv-search{
        display:flex;
        align-items:center;
        border:1px solid #e2e8f0;
        border-radius:14px;
        overflow:hidden;
        background:#fff;
        height:44px;
        }
        .inv-search input{
        border:0 !important;
        outline:none !important;
        padding:10px 14px !important;
        width:280px;
        font-size:14px;
        color:#0f172a;
        }
        .inv-search button{
        border:0;
        background:#fff;
        width:48px;
        height:44px;
        display:flex;
        align-items:center;
        justify-content:center;
        color:#64748b;
        cursor:pointer;
        transition: background-color .12s ease, transform .12s ease;
        }
        .inv-search button:hover{ background:#f1f5f9; }
        .inv-search button:active{ transform: scale(.96); }

        /* ===== Select wrapper ===== */
        .inv-select{
        display:flex;
        align-items:center;
        gap:8px;
        border:1px solid #e2e8f0;
        border-radius:14px;
        padding:0 10px;
        height:44px;
        background:#fff;
        }
        .inv-select img{ width:20px; height:20px; }
        .inv-select select{
        border:0 !important;
        outline:none !important;
        background:transparent !important;
        height:42px;
        cursor:pointer;
        font-size:13px;
        color:#334155;
        }

        /* ===== Table ===== */
        .inv-table-wrap{ padding: 8px 8px 16px; }
        .inv-table{
        width:100%;
        border-collapse:separate;
        border-spacing:0;
        font-size:14px;
        }
        .inv-table thead th{
        background:#f8fafc;
        color:#64748b;
        font-weight:800;
        padding:16px 18px;
        border-bottom:1px solid #eef2f7;
        text-align:left;
        white-space:nowrap;
        }
        .inv-table tbody td{
        padding:16px 18px;
        border-bottom:1px solid #f1f5f9;
        color:#0f172a;
        vertical-align:middle;
        }
        .inv-table tbody tr:nth-child(even){ background:#fcfdff; }
        .inv-table tbody tr{
        transition: background-color .12s ease;
        }
        .inv-table tbody tr:hover{ background:#eff6ff; }

        .inv-right{ text-align:right; }
        .inv-center{ text-align:center; }
        .inv-green{ color:#166534; font-weight:800; }
        .inv-name{ font-weight:800; color:#0f172a; }
    </style>


    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="inv-card tpb-5 ttext-black-100">
        <div class="inv-header">
            <span class="inv-title">
                <i class="fas fa-clipboard-list" style="color:#334155;"></i>
                Inventory
            </span>

            <span class="inv-meta">Total Stock Value: <b>₱{{ number_format($totalStockValue) }}</b></span>

            <div class="inv-tools">
                <!-- Search -->
                <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="inv-search">
                    <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" placeholder="Search order number">
                    <button type="submit" aria-label="Search">
                        <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                    </button>
                </form>

                <!-- Store Filter -->
                <div class="inv-select">
                    <img src="{{ asset('images/icons/store.png') }}" alt="">
                    <select id="supplier" class="supplier browser-default form-control">
                        <option value="#" selected>Choose ...</option>
                    </select>
                </div>

                <!-- Sort -->
                <div>
                    @if (request()->sort == 'asc')
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="inv-icon-btn" title="Sort by newest" style="background:#fff;border-color:#e2e8f0;color:#64748b;">
                            <i class="material-icons">sort_by_alpha</i>
                        </a>
                    @else
                        <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}" class="inv-icon-btn" title="Sort by oldest" style="background:#fff;border-color:#e2e8f0;color:#64748b;">
                            <i class="material-icons">sort_by_alpha</i>
                        </a>
                    @endif
                </div>

                <!-- Clear Filter -->
                <a href="/admin/lab/inventory" class="inv-icon-btn" title="Remove filter" style="background:#fff;border-color:#fee2e2;color:#ef4444;">
                    <img src="{{ asset('images/icons/clear_filter.png') }}" style="width:22px;height:22px;" alt="">
                </a>
            </div>
        </div>



        <div class="inv-table-wrap">
            <div class="toverflow-x-auto">
                <table class="inv-table">
                    <thead>
                        <tr>
                            <th>Chemical</th>
                            <th class="">Price</th>
                            <th class="">Weight</th>
                            <th class="">Price/Grams</th>
                            <th class="">Stock Value</th>
                        </tr>
                    </thead>

                    <tbody>
                        
                        @foreach ($inventory as $stock)
                            <tr>
                                <td class="inv-name">{{ $stock['name'] }}</td>
                                <td class="">{{ currency() }}{{ number_format($stock['price'], 2) }}</td>
                                <td class="">
                                    <input
                                        type="number"
                                        class="stock-weight-input browser-default"
                                        style="width:80px;padding:4px 6px;border:1px solid #e2e8f0;border-radius:8px;text-align:right;"
                                        data-ingredient-id="{{ $stock['ingredient_id'] }}"
                                        data-price-per-grams="{{ $stock['price_per_grams'] }}"
                                        value="{{ number_format($stock['weight'], 0, '.', '') }}"
                                        min="0"
                                        step="0.01"
                                        {{ auth()->user()->role =='master'? '': 'disabled'}}
                                    > g
                                </td>
                                <td class="">{{ currency() }}{{ number_format($stock['price_per_grams'], 2) }}</td>
                                <td class="inv-green stock-value-cell">{{ currency() }}{{ number_format($stock['total_value'], 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Modal Structure -->
        <div id="modal1" class="modal modal-fixed-footer tw-full md:tw-1/2  tbg-white">
            <div class="modal-content">

                <form action="{{ route('lab.create') }}" method="post" class="tbg-white trounded-lg ttext-black-100">
                    @csrf
                    <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                        Customer Info
                    </div>

                    <div class="tflex tflex-wrap tpx-5">
                        <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                            <label for="name" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Chemical Name</label>
                            <input type="text" id="name" name="name" class="browser-default form-control" value="" style="padding: 6px;">
                        </div>
                        <div class="tw-1/5 tpx-1">
                            <label for="price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Price</label>
                            <input type="text" id="price" name="price" class="price browser-default form-control" value="" style="padding: 6px;">
                        </div>
                        <div class="tw-1/5 tpx-1">
                            <label for="weight" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Weight</label>
                            <input type="text" id="weight" name="weight" class="weight browser-default form-control" value="" style="padding: 6px;">
                        </div>
                        <div class="tw-1/5 tpx-1 tpx-1 tmb-2 lg:tmb-0">
                            <label for="price_per_grams" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Price/Grams</label>
                            <input type="text" id="price_per_grams" name="price_per_grams" class="browser-default form-control tbg-red tcursor-not-allowed ttext" value="" style="padding: 6px;background-color: #eaeaea;/* opacity: 0.6; *//* color: red!important; */">
                        </div>
                    </div>

                    <div class="tflex tflex-wrap tpx-5">
                        <div class="tw-full tmb-2 lg:tmb-0 tpx-1 tpb-3">
                            <label for="note" class="tfont-medium ttext-sm tmb-2 ttext-black-100">Note</label>
                            <textarea name="note" id="note" cols="30" rows="3" class="browser-default form-control" style="padding: 6px;"></textarea>
                        </div>
                    </div>

                    <div class="tflex tjustify-center tmt-3">
                        <button type="submit" class="focus:tbg-primary tbg-primary tpy-2 trounded ttext-white tw-1/3 tw-24 waves-effect">Submit</button><!-- Save -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Agree</a>
            </div>
        </div>

    </div>
@endsection


@section('js')
<script>
    $(document).ready(function(){
        $('.modal').modal();
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

        // AJAX CSRF token
        $.ajaxSetup({
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
        });

        $(document).on('change', '.stock-weight-input', function () {
            const $input       = $(this);
            const ingredientId = $input.data('ingredient-id');
            const newWeight    = parseFloat($input.val()) || 0;
            const pricePerGram = parseFloat($input.data('price-per-grams')) || 0;
            const $row         = $input.closest('tr');
            const $valueCell   = $row.find('.stock-value-cell');

            $.ajax({
                url: '{{ route("lab.manual-change-stock") }}',
                type: 'POST',
                data: {
                    ingredient_id: ingredientId,
                    weight:        newWeight,
                },
                success: function (res) {
                    if (res.success) {
                        const newValue = (res.new_weight * pricePerGram).toFixed(0);
                        $valueCell.text('{{ currency() }}' + Number(newValue).toLocaleString());
                    }
                },
                error: function () {
                    alert('Failed to update stock. Please try again.');
                }
            });
        });
    });
</script>
@endsection