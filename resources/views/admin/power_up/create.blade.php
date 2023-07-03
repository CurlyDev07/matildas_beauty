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
            <span class="tfont-medium">{{ session()->get('success') }}! </span> New Power Up added
        </div>
    </div>
@endif

    <div class="tbg-white  trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 ttext-title">
            Add Power Up
        </div>
     
        <form action="{{ route('powerup.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3">
                <section>
                    <div class="text-sm tfont-medium tpx-5 tpy-4 tmt-4 ttext-title">
                        Details
                    </div>

                    <div class="tflex tpx-5 ">
                        <div class="tw-1/3 tflex tflex-col tmr-3">
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

                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Purchase Date</label>
                            <input type="text" name="purchase_date" id="purchase_date" class="purchase_date browser-default form-control" value="">
                            @error('date')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Purchase Date -->

                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label for="#" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Review Date</label>
                            <input type="text" name="review_date" id="review_date" class="review_date browser-default form-control" value="">
                            @error('date')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Purchase Date -->

                    </div>

                    <div class="tflex tpx-5 tmt-5">
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="email" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Account Name/Email</label>
                            <input type="text" name="email" id="email" value="{{ old('email') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('email')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Email -->
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="password" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Password</label>
                            <input type="text" name="password" id="password" value="{{ old('password') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('password')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- password -->

                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="phone" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Device <small>(shopee only)</small></label>
                            <input type="text" name="phone" id="phone" value="{{ old('phone') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('phone')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- phone -->
                    </div>

                    <div class="tflex tpx-5 tmt-5">
                        

                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="sf" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Shipping fee</label>
                            <input type="text" name="sf" id="sf" value="{{ old('sf') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('sf')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Shipping fee -->

                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="total" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Total</label>
                            <input type="text" name="total" id="total" value="{{ old('total') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('total')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Total -->

                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="notes" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Notes</label>
                            <input type="text" name="notes" id="notes" value="{{ old('notes') }}" class="browser-default form-control" style="padding: 6px;">
                            @error('notes')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- notes -->
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



        let purchase_date = $('.purchase_date').datepicker({
            autoClose: true
        });// initiate datepicker
        
        let review_date = $('.review_date').datepicker({
            autoClose: true
        });// initiate datepicker

        $('.purchase_date').change(function () {
            let val = $('.purchase_date').val();
            $('#purchase_date').val(val);
        })
       
        $('.review_date').change(function () {
            let val = $('.review_date').val();
            $('#review_date').val(val);
        })
    </script>
@endsection