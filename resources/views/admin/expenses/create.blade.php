@extends('admin.expenses.layouts')

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
            <span class="tfont-medium">{{ session()->get('success') }}! </span> New supplier added
        </div>
    </div>
@endif

    <div class="tbg-white  trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 ttext-title">
            Expenses
        </div>
     
        <form action="{{ route('expenses.store') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3">
                <section>
                    <div class="tflex tpx-5 tmt-5">
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label for="category_id" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Category</label>
                            <select name="category_id" id="category_id" class="browser-default form-control"  style="padding: 6px;">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Category -->
                        <div class="tw-2/6 tflex tflex-col tmr-3">
                            <label for="name" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="browser-default form-control" style="padding: 6px;" required>
                            @error('name')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Name -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label for="price" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Price</label>
                            <input type="number" name="price" price="price" id="price" value="{{ old('price') }}" class="browser-default form-control" style="padding: 6px;" required>
                            @error('price')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- PRICE -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label for="quantity" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Quantity</label>
                            <input type="number" name="quantity" quantity="quantity" id="quantity" value="{{ old('quantity') }}" class="browser-default form-control" style="padding: 6px;" required>
                            @error('quantity')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- QTY -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label for="total" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Total</label>
                            <input type="number" name="total" id="total" value="{{ old('total') }}" class="browser-default form-control tcursor-not-allowed" style="padding: 6px; background-color: #e3e3e3;" required>
                            @error('total')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- COST -->
                        <div class="tw-1/6 tflex tflex-col tmr-3">
                            <label for="date" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Date</label>
                            <input type="text" name="date" class="datepicker browser-default form-control" style="padding: 6px;" required>    
                        </div><!-- DATE -->
                    </div>

                    <div class="tflex tpx-5 tmt-2 tflex tflex-row">
                        <textarea required placeholder="Notes about the transaction" name="Notes" id="Notes" cols="30" rows="3" class="browser-default form-control tmt-2" style="padding: 6px;" spellcheck="false">N/A</textarea>
                    </div>
                </section><!-- Bank Details -->

                <div class="tflex tjustify-end tpx-5">
                    <div class="tflex tjustify-end tpy-5 trounded-lg 100">
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
            $('.datepicker').datepicker({
              autoClose: true
            });// initiate datepicker
      

            
            
            $('#price').change(function () {
                let price = $(this).val();
                let quantity = $('#quantity').val();
                let total = (price*quantity);
                $('#total').val(total);
            });

            $('#quantity').change(function () {
                let price = $(this).val();
                let quantity = $('#price').val();
                let total = (price*quantity);
                $('#total').val(total);
            });


            
        function MakeDecimal(Number) {
            Number = Number + "" // Convert Number to string if not
            Number = Number.split('').reverse().join(''); //Reverse string
            var Result = "";
            for (i = 0; i <= Number.length; i += 3) {
                Result = Result + Number.substring(i, i + 3) + ".";
            }
            Result = Result.split('').reverse().join(''); //Reverse again
            if (!isFinite(Result.substring(0, 1))) Result = Result.substring(1, Result.length); // Remove first dot, if have.
            if (!isFinite(Result.substring(0, 1))) Result = Result.substring(1, Result.length); // Remove first dot, if have.
            return Result;
        }
    </script>
@endsection