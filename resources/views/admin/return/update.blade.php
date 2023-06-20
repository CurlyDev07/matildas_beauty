@extends('admin.return.layouts')

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
                <span class="tfont-medium">Wow!</span>
                Update Successful
            </div>
        </div>
    @endif


    <div class="tbg-white  trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 ttext-title">
            Suppliers
        </div>
     
        <form action="{{ route('suppliers.patch') }}" method="post" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $supplier->id }}">
            <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100 tmt-3">
                <section>
                    <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                        Basic Information
                    </div>
                    <div class="tflex tpx-5">
                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label for="name" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Name</label>
                            <input type="text" name="name" id="name" value="{{ $supplier->name }}" class="browser-default form-control" style="padding: 6px;">
                            @error('name')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Name -->
                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label for="surname" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Surname</label>
                            <input type="text" name="surname" id="surname" value="{{ $supplier->surname }}" class="browser-default form-control" style="padding: 6px;">
                            @error('surname')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Surname -->
                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label for="phone_number" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Phone number</label>
                            <input type="text" onkeyup="allnumeric(this)" name="phone_number" id="phone_number" value="{{ $supplier->phone_number }}" class="browser-default form-control" style="padding: 6px;">
                            @error('phone_number')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Phone number -->
                    </div>
                    <div class="tflex tpx-5 tmt-3">
                        <div class="tw-full tflex tflex-col tmr-3">
                            <label for="province" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Province</label>
                            <input type="text" name="province" id="province" value="{{ $supplier->province }}" class="browser-default form-control" style="padding: 6px;">
                            @error('province')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Address -->
                        <div class="tw-full tflex tflex-col tmr-3">
                            <label for="city" class="tfont-normal ttext-sm tmb-2 ttext-black-100">City</label>
                            <input type="text" name="city" id="city" value="{{ $supplier->city }}" class="browser-default form-control" style="padding: 6px;">
                            @error('city')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Address -->
                        <div class="tw-full tflex tflex-col tmr-3">
                            <label for="barangay" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Barangay</label>
                            <input type="text" name="barangay" id="barangay" value="{{ $supplier->barangay }}" class="browser-default form-control" style="padding: 6px;">
                            @error('barangay')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Address -->
                    </div>
                    <div class="tflex tpx-5 tmt-3">
                        <div class="tw-full tflex tflex-col tmr-3">
                            <label for="complete_address" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Complete Address</label>
                            <input type="text" name="complete_address" id="complete_address" value="{{ $supplier->complete_address }}" class="browser-default form-control" style="padding: 6px;">
                            @error('complete_address')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Address -->
                    </div>
                </section><!-- Basic Information -->
                
                <section>
                    <div class="text-sm tfont-medium tpx-5 tpy-4 tmt-4 ttext-title">
                        Social Media
                    </div>
    
                    <div class="tflex tpx-5 ">
                        <div class="tw-1/3 tflex tflex-col tmr-3">
                            <label for="social_media" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Social Media</label>
                            <input type="text" name="social_media" id="social_media" value="{{ $supplier->social_media }}" class="browser-default form-control" style="padding: 6px;">
                            @error('social_media')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- FB LINK -->
                        <div class="tw-2/3 tflex tflex-col tmr-3">
                            <label for="social_media_link" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Social Media Link</label>
                            <input type="text" name="social_media_link" id="social_media_link" value="{{ $supplier->social_media_link }}" class="browser-default form-control" style="padding: 6px;">
                            @error('social_media_link')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- FB LINK -->
                    </div>
                </section> <!-- Social Media -->
                
                <section>
                    <div class="text-sm tfont-medium tpx-5 tpy-4 tmt-4 ttext-title">
                        Bank Details
                    </div>

                    <div class="tflex tpx-5 ">
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="bank" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Bank</label>
                            <select name="bank" id="bank" class="browser-default form-control"  style="padding: 6px;">
                                <option value="bdo" @if ($supplier->bank == 'bdo') selected @endif >BDO</option>
                                <option value="bpi" @if ($supplier->bank == 'bpi') selected @endif >BPI</option>
                                <option value="metrobank" @if($supplier->bank == 'metrobank') selected @endif >Metrobank</option>
                                <option value="chinabank" @if($supplier->bank == 'chinabank') selected @endif>Chinabank</option>
                                <option value="union_bank" @if($supplier->bank == 'union_bank') selected @endif >Union Bank</option>
                                <option value="Gcash" @if($supplier->bank == 'Gcash') selected @endif >Gcash</option>
                            </select>
                            @error('bank')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Bank -->
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="contact_number" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number" value="{{ $supplier->contact_number }}" class="browser-default form-control" style="padding: 6px;">
                            @error('contact_number')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Contact Number -->
                    </div>

                    <div class="tflex tpx-5 tmt-5">
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="account_name" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Account Name</label>
                            <input type="text" name="account_name" id="account_name" value="{{ $supplier->account_name }}" class="browser-default form-control" style="padding: 6px;">
                            @error('account_name')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Account Name -->
                        <div class="tw-1/2 tflex tflex-col tmr-3">
                            <label for="account_number" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Account Number</label>
                            <input type="text" name="account_number" id="account_number" value="{{ $supplier->account_number }}" class="browser-default form-control" style="padding: 6px;">
                                @error('account_number')
                                <div class="ttext-red-600 tfont-bold ttext-sm">{{ $message }}</div>
                            @enderror
                        </div><!-- Account Number -->
                    </div>

                </section><!-- Bank Details -->
                

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