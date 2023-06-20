@extends('admin.stores_metrics.layouts')

@section('css')

    <style>
        .autocomplete-content img {
            display: none;
        }
        .modal .modal-content {
            height: 50vh;
        }
        .dropzone {
            background: white;
            border-radius: 5px;
            border: 2px dashed #919eab;
            border-image: none;
        }
        .dropzone .dz-message {
            text-align: center;
            margin: 0;
        }
    </style>
@endsection

@section('page')


@if(session()->has('success'))
    <div class="tflex tbg-green-100 trounded-lg tp-4 tmb-4 txt-sm ttext-green-700" role="alert">
        <svg class="tw-5 th-5 tinline tmr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div>
            <span class="tfont-medium">{{ session()->get('success') }}! </span> New Metrics Added
        </div>
    </div>
@endif

    <div class="tbg-white  trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 ttext-title">
            Add Metrics
        </div>
     
        <form action="{{ route('store.metrics.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3">
                <section>
                    <div class="text-sm tfont-medium tpx-5 tpy-4 tmt-4 ttext-title">
                        Details
                    </div>

                    <div class="tflex tpx-5 ">
                        <div class="tw-1/4 tflex tflex-col tmr-3">
                            <label for="store_id" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Stores</label>
                            <select name="store_id" id="store_id" class="browser-default form-control"  style="padding: 6px;">
                                @foreach ($stores as $store)
                                    <option value="{{ $store->id }}">{{ $store->store_name }}</option>
                                @endforeach
                            </select>
                            @error('bank')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Store -->

                        <div class="tw-1/4 tflex tflex-col tmr-3">
                            <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Date <small class="ttext-gray-600"> (Metrics Date)</small></label>
                            <input type="text" name="date" id="date" class="datepicker browser-default form-control" value="">
                            @error('date')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Date -->


                    </div>

                    <div class="tflex tpx-5 tmt-5">
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="sales" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Sales/Revenue</label>
                            <input type="text" name="sales" id="sales" value="{{ old('sales') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('sales')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Sales/Revenue -->

                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="orders" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Orders</label>
                            <input type="text" name="orders" id="orders" value="{{ old('orders') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('orders')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Username -->
                    </div>

                    <div class="tflex tpx-5 tmt-5">
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="visitors" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Visitors</label>
                            <input type="text" name="visitors" id="visitors" value="{{ old('visitors') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('visitors')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Visitors -->

                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="conversion_rate" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Conversion Rate</label>
                            <input type="text" name="conversion_rate" id="conversion_rate" value="{{ old('conversion_rate') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('conversion_rate')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Sales/Revenue -->
                    </div>

                </section>
                

                <div class="tflex tjustify-end tpx-5 tmt-5">
                    <div class="tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
                        <button type="submit" class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect">Submit</button>
                    </div><!-- Save -->
                </div>
            </div>

        </form>

    </div><!-- Create Order -->

@endsection

@section('js')
    <script src="{{ asset('js/plugins/sweatalert.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/jszip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.8.0/xlsx.js"></script>
            
     {{-- UPLOAD IMAGES JS CONTROLS --}}
    <script>



        let datepicker = $('.datepicker').datepicker({
            autoClose: true
        });// initiate datepicker

        $('.datepicker').change(function () {
            let val = $('.datepicker').val();
            $('#date').val(val);
        })
    </script>
@endsection