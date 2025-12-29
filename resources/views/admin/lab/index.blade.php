@extends('admin.lab.layouts')


@section('page')

    <style>
        <style>
            .add-chemical-btn{
        transition: transform .15s ease, box-shadow .15s ease, background-color .15s ease;
        -webkit-tap-highlight-color: transparent;
        }

        .add-chemical-btn:hover{
        transform: translateY(-2px);
        box-shadow: 0 10px 18px rgba(0,0,0,.12);
        background-color: #bbf7d0; /* close to Tailwind green-200 */
        }

        .add-chemical-btn:active{
        transform: translateY(0) scale(.96);
        box-shadow: 0 6px 12px rgba(0,0,0,.10);
        }

        .add-chemical-btn .add-chemical-flask{
        transition: transform .15s ease;
        }

        .add-chemical-btn:hover .add-chemical-flask{
        transform: rotate(-8deg) scale(1.06);
        }

        .add-chemical-btn .add-chemical-plus{
        transition: transform .15s ease;
        }

        .add-chemical-btn:hover .add-chemical-plus{
        transform: scale(1.25);
        }

        .add-chemical-btn:active .add-chemical-plus{
        transform: scale(1.1);
        }

    </style> <!-- Add Chemical icon -->

    <style>
        /* Modern modal sizing */
        #modal1.modal{
        width: min(720px, 92vw) !important;
        max-height: 86vh !important;
        }

        /* Close button */
        .modal-x-btn{
        width: 36px;
        height: 36px;
        display:flex;
        align-items:center;
        justify-content:center;
        border-radius: 10px;
        background: #f1f5f9;
        color: #334155;
        transition: transform .12s ease, background-color .12s ease;
        }
        .modal-x-btn:hover{ background:#e2e8f0; transform: translateY(-1px); }
        .modal-x-btn:active{ transform: scale(.96); }

        /* Inputs */
        .modal-input{
        width:100%;
        padding: 10px 12px !important;
        border-radius: 12px !important;
        border: 1px solid #e2e8f0 !important;
        background: #ffffff !important;
        outline: none !important;
        transition: box-shadow .12s ease, border-color .12s ease, transform .12s ease;
        }
        .modal-input:focus{
        border-color:#22c55e !important;
        box-shadow: 0 0 0 4px rgba(34,197,94,.18) !important;
        }
        .modal-input-readonly{
        background:#f8fafc !important;
        cursor:not-allowed !important;
        color:#475569 !important;
        }

        /* Buttons */
        .modal-btn{
        border: 0;
        padding: 10px 14px;
        border-radius: 12px;
        font-weight: 600;
        font-size: 14px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        transition: transform .12s ease, box-shadow .12s ease, background-color .12s ease;
        text-decoration:none;
        }
        .modal-btn:active{ transform: scale(.98); }

        .modal-btn-ghost{
        background:#f1f5f9;
        color:#0f172a;
        }
        .modal-btn-ghost:hover{ background:#e2e8f0; }

        .modal-btn-primary{
        background:#16a34a;
        color:#fff;
        box-shadow: 0 10px 18px rgba(22,163,74,.18);
        }
        .modal-btn-primary:hover{
        background:#15803d;
        box-shadow: 0 14px 24px rgba(22,163,74,.22);
        }

        /* Optional: soften Materialize overlay a bit */
        .modal-overlay{
        background: rgba(15, 23, 42, .55) !important;
        }

    </style> <!-- Modal -->



    <div class=" tpb-5 ttext-black-100">
        <div class="tbg-white tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Chemicals & Equipments</span>
            <ul class="tflex titems-center">

            <li class="tmr-4">
                <a href="#modal1"
                class="modal-trigger add-chemical-btn
                        trelative
                        tbg-green-100
                        ttext-green-800
                        tw-11 th-11
                        tflex titems-center tjustify-center
                        trounded-full
                        tshadow-sm
                        ttransition">
                    <i class="fas fa-flask ttext-2xl add-chemical-flask"></i>
                    <i class="fas fa-plus tabsolute tmr-6 ttext-xs ttop-1 tright-1 add-chemical-plus"></i>
                </a>
            </li><!-- Add Chemical -->


                <li class="tmr-4">
                    <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="tflex titems-center">
                        <input type="text" name="search" id="barcode" value="{{ request()->search ?? '' }}" class="browser-default tborder-b tborder-gray-200 tborder-l tborder-t toutline-none tpx-3 tpy-2 trounded-bl trounded-tl" placeholder="Search order number">
                        <button type="submit" class="focus:tbg-white focus:toutline-none grey-text tborder tborder-gray-200 tborder-l-0 tcursor-pointer toutline-none tpx-3 tpy-2 trounded-r-full waves-effect">
                            <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                        </button>
                    </form>
                </li><!-- SEARCH -->
                <li class="tmr-2">
                    <div class="tborder tflex titems-center tpx-2 trounded ttext-sm tw-16" >
                        <img class="tpr-1" src="{{ asset('images/icons/store.png') }}" alt="">
                        <select id="supplier" class="supplier tcursor-pointer browser-default form-control" style="border: none;padding-top: 5px;padding-bottom: 5px;">
                            <option value="#" selected>Choose ...</option>

                            {{-- @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                            @endforeach --}}
                        </select> 
                    </div>
                </li><!-- Store Filter-->
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
                    <a href="/admin/lab/">
                        <img src="{{ asset('images/icons/clear_filter.png') }}" class="tooltipped" data-position="top" data-tooltip="Remove filter">
                    </a>
                </li>
            </ul>
        </div>
        
        <div class=" tpy-4">
        <div class="chem-card">
            <div class="toverflow-x-auto">
            <table class="chem-table">
                <thead>
                <tr>
                    <th style="width:60px;">#</th>
                    <th>Name</th>
                    <th class="">Price</th>
                    <th class="">Weight</th>
                    <th class="">Price/Gram</th>
                    <th class="chem-center" style="width:110px;">Action</th>
                </tr>
                </thead>

                <tbody >
                @forelse ($ingredients as $ingredient)
                    <tr>
                        <td style="color:#64748b;">{{ $ingredient->id }}</td>
                        <td>
                            <div class="chem-name">{{ $ingredient->name }}</div>
                            <div class="chem-sub">Chemical</div>
                        </td>
                        <td class="" style="font-weight:600;">
                            {{ currency() }}{{ number_format($ingredient->price, 2) }}
                        </td>
                        <td class="">
                            {{ number_format($ingredient->weight, 2) }}
                        </td>
                        <td class="" style="font-weight:700; color:#16a34a;">
                            {{ number_format($ingredient->price_per_grams, 2) }}
                        </td>
                        <td class="chem-center">
                            <a href="/admin/lab/update/{{ $ingredient->id }}" class="chem-action" title="Update">
                            <i class="fas fa-pen"></i>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                    <td colspan="6" class="chem-empty">
                        No chemicals yet. Click the plus button to add one.
                    </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
            </div>
        </div>
        </div>






        <!-- Modal Structure -->
        <div id="modal1" class="modal modal-fixed-footer tbg-transparent tbg-white" style="border-radius:16px; overflow:hidden;">
            <div class="modal-content " style="padding:0;">

                <!-- Header -->
                <div class="tflex titems-center tjustify-between tpx-6 tpy-4 tborder-b" style="border-color:#eef2f7;">
                    <div>
                        <div class="ttext-base tfont-semibold" style="color:#0f172a;">Add Chemical</div>
                        <div class="ttext-xs" style="color:#64748b; margin-top:2px;">Enter supplier price & weight to auto-calc price per gram.</div>
                    </div>

                    <a href="#!" class="modal-close modal-x-btn" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </a>
                </div>

                <form action="{{ route('lab.create') }}" method="post" class="tpx-6 tpy-5">
                    @csrf

                    <!-- Fields -->
                    <div class="tflex tflex-wrap -tmx-2">
                        <div class="tw-full md:tw-1/2 tpx-2 tmb-4">
                            <label for="name" class="tblock ttext-xs tfont-semibold" style="color:#334155;">Chemical Name</label>
                            <input type="text" id="name" name="name" class="modal-input browser-default" placeholder="e.g., Niacinamide">
                        </div>

                        <div class="tw-1/2 md:tw-1/4 tpx-2 tmb-4">
                            <label for="price" class="tblock ttext-xs tfont-semibold" style="color:#334155;">Price</label>
                            <input type="text" id="price" name="price" class="price modal-input browser-default" placeholder="₱">
                        </div>

                        <div class="tw-1/2 md:tw-1/4 tpx-2 tmb-4">
                            <label for="weight" class="tblock ttext-xs tfont-semibold" style="color:#334155;">Weight</label>
                            <input type="text" id="weight" name="weight" class="weight modal-input browser-default" placeholder="grams">
                        </div>

                        <div class="tw-full md:tw-1/2 tpx-2 tmb-4">
                            <label for="price_per_grams" class="tblock ttext-xs tfont-semibold" style="color:#334155;">Price / Gram</label>
                            <div class="trelative">
                                <input type="text" id="price_per_grams" name="price_per_grams"
                                    class="modal-input browser-default modal-input-readonly"
                                    value="" readonly>
                                <span class="tabsolute" style="right:12px; top:50%; transform:translateY(-50%); color:#94a3b8; font-size:12px;">
                                    auto
                                </span>
                            </div>
                        </div>

                        <div class="tw-full tpx-2 tmb-2">
                            <label for="note" class="tblock ttext-xs tfont-semibold" style="color:#334155;">Note</label>
                            <textarea name="note" id="note" rows="4" class="modal-input browser-default" placeholder="Optional notes..."></textarea>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="tflex tjustify-end tgap-2 tmt-4 tpt-4 tborder-t" style="border-color:#eef2f7;">
                        <a href="#!" class="modal-close modal-btn modal-btn-ghost">Cancel</a>
                        <button type="submit" class="modal-btn modal-btn-primary">
                            <i class="fas fa-check tmr-2"></i> Save Chemical
                        </button>
                    </div>
                </form>
            </div>

            <!-- Remove boring footer (optional). If you want it kept, tell me -->
            <div class="modal-footer" style="display:none;"></div>
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
    });
</script>
@endsection