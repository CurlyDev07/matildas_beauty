@extends('admin.lab.layouts')


@section('page')
    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="inv-header">
            <span class="inv-title">
                <i class="fas fa-clipboard-list" style="color:#334155;"></i>
                Formulation List
            </span>

            <div class="inv-tools">
                <!-- Add Formulation -->
                <a href="{{ route('lab.formulation.create') }}"
                class="inv-icon-btn"
                title="Add Formulation">
                    <i class="fas fa-plus"></i>
                </a>

                <!-- Search -->
                <form action="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}" class="inv-search">
                    <input type="text" name="search" value="{{ request()->search ?? '' }}" placeholder="Search product name">
                    <button type="submit">
                        <i class="fa-flip-horizontal fa-lg fa-search fas"></i>
                    </button>
                </form>

                <!-- Supplier/Filter (optional – keep if you really use it) -->
                <div class="inv-select">
                    <img src="{{ asset('images/icons/store.png') }}" alt="">
                    <select id="supplier" class="supplier browser-default form-control">
                        <option value="#" selected>Choose ...</option>
                        {{-- @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach --}}
                    </select>
                </div>

                <!-- Sort -->
                @if (request()->sort == 'asc')
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'desc']) }}"
                    class="inv-icon-btn"
                    title="Sort by newest"
                    style="background:#fff;border-color:#e2e8f0;color:#64748b;">
                        <i class="material-icons">sort_by_alpha</i>
                    </a>
                @else
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'asc']) }}"
                    class="inv-icon-btn"
                    title="Sort by oldest"
                    style="background:#fff;border-color:#e2e8f0;color:#64748b;">
                        <i class="material-icons">sort_by_alpha</i>
                    </a>
                @endif

                <!-- Clear Filter -->
                <a href="/admin/lab/formulation"
                class="inv-icon-btn"
                title="Remove filter"
                style="background:#fff;border-color:#fee2e2;color:#ef4444;">
                    <img src="{{ asset('images/icons/clear_filter.png') }}" style="width:22px;height:22px;">
                </a>
            </div>
        </div>

        <div class="tpy-4">
            <div class="chem-card">
                <div class="toverflow-x-auto">
                    <table class="chem-table">
                        <thead>
                            <tr class="tw-full tflex titems-center">
                                <th class="tw-1/3 ttext-left">Product</th>
                                <th class="tw-1/3 ttext-left">Net Content</th>
                                <th class="tw-1/3 ttext-left" style="width:140px;">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($formulations as $formulation)
                                <tr class="tw-full tflex titems-center tjustify-between">
                                    <td class="tw-1/3 ttext-left">
                                        <div class="chem-name">{{ $formulation->product_name }}</div>
                                    </td>

                                    <td class="tw-1/3 tfont-semibold">
                                        {{ $formulation->net_content }}g
                                    </td>

                                    <td class="tw-1/3 ">
                                        <a href="{{ route('lab.production.create', ['id' => $formulation->id]) }}"
                                        class="tbg-green-100 tborder tborder-green-400 tfont-medium tmr-2 tpx-5 tpy-3 trounded ttext-green-900"
                                        title="Make / Produce">
                                            <span class="fa-stack fa-md">
                                                <i class="fas fa-flask fa-stack-1x ttext-purple-600"></i>
                                                <i class="fas fa-plus fa-stack-1x ttext-purple-600" style="left: -28%;top: -5%;"></i>
                                            </span>
                                            
                                            Create Formulation
                                            
                                        </a>
                                        <a href="{{ route('lab.formulation.update', ['id' => $formulation->id]) }}"
                                            class="tbg-blue-100 tborder tborder-blue-400 tfont-medium tpx-5 tpy-3 trounded ttext-blue-800"
                                            title="Make / Produce">
                                            <i class="fas fa-pen"></i> Edit
                                        </a>
                                    </td>
                                </tr>
                            @endforeach

                            @if(count($formulations) == 0)
                                <tr>
                                    <td colspan="3" class="chem-center" style="padding:36px 18px; color:#94a3b8;">
                                        No formulations yet. Click the + button to add one.
                                    </td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
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
    });
</script>
@endsection