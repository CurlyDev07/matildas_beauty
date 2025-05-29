@extends('admin.fbads.layouts')


@section('page')
    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b tflex titems-center tjustify-between tpx-5 tpy-3">
            <span class="ttext-base ttext-title tfont-medium">Status Details</span>
            <ul class="tflex titems-center">
                <li class="tmr-4">
                    <a href="#modal1" class="tbg-green-200 tmr-4 tpx-3 tpy-2 trounded ttext-green-900 waves-effect waves-light  modal-trigger">
                        <i class="fas fa-plus-circle"></i>
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
        <div class="tpx-3 tpy-4 tflex tjustify-center">
            <table class="tmb-4 tbg-white ttext-md tw-full">
                <tbody>
                    <tr class="tborder-0">
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Customer</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Status</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Admin</th>

                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">image</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Category</th>
                        <th class="ttext-center tpx-5 ttext-black-100 tfont-medium">Cancellation Reason</th>
                    </tr>

                    @foreach ($status_details as $details)
                    
                        <tr class="tborder-0 hover:tbg-blue-100">
                            <td class="ttext-center tpx-5">{{ $details->full_name }} <br> {{ $details->phone_number }}</td>
                            <td class="ttext-center tpx-5"><span class="ttext-sm ttext-gray-500"><strike>{{ $details->statusDetail['previous_status'] }}</strike></span>  <br> {{ $details->statusDetail['new_status']  }}</td>
                            <td class="ttext-center tpx-5">{{ $details->statusDetail['admin_name'] }}</td>
                            <td class="ttext-center tpx-5">
                                <a href="{{ $details->statusDetail['reason']['img'] }}" target="_blank" class="tooltipped tcursur-pointer  ttext-center" data-position="top" data-tooltip="Click to View">
                                    <img src="{{ $details->statusDetail['reason']['img'] }}" alt="Reason Image" class="tmx-auto tw-20 th-20 object-contain rounded border" />
                                </a>
                            </td>
                            <td class="ttext-center tpx-5">
                                <span>{{ $details->statusDetail['reason']['category'] }}</span>
                            </td>
                            <td class="ttext-center tpx-5">
                                <span>{{ $details->statusDetail['reason']['reason'] }}</span>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>

        </div><!-- TABLE -->




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