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
            <span class="tfont-medium">{{ session()->get('success') }}! </span> New supplier added
        </div>
    </div>
@endif

    <div class="tbg-white  trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 ttext-title">
            Create Store
        </div>
     
        <form action="{{ route('store.patch') }}" method="post" enctype="multipart/form-data">
            @csrf

            <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3">
                <section>
                    <div class="text-sm tfont-medium tpx-5 tpy-4 tmt-4 ttext-title">
                        Details
                    </div>

                    <input type="hidden" name="id" value="{{ request()->id }}">
                    <div class="tflex tpx-5 ">
                        <div class="tw-1/4 tflex tflex-col tmr-3">
                            <label for="platform" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Platform</label>
                            <select name="platform" id="platform" class="browser-default form-control tcapitalize"  style="padding: 6px;">
                                @foreach ($platforms as $platform)
                                    <option value="{{ $platform }}">{{ $platform }}</option>
                                @endforeach
                            </select>
                            @error('bank')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Platform -->
                    </div>

                    <div class="tflex tpx-5 tmt-5">
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="store_name" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Store Name</label>
                            <input type="text" name="store_name" id="store_name" value="{{ $store->store_name }}" class="browser-default form-control" style="padding: 6px;">
                            @error('store_name')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Store Name -->
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="username" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Username</label>
                            <input type="text" name="username" id="username" value="{{ $store->username }}" class="browser-default form-control" style="padding: 6px;">
                            @error('username')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Username -->
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
         
         $('#file').change(function () {
            let file_name = $(this).val().split("\\").pop();
            
         });
            
    </script>
@endsection