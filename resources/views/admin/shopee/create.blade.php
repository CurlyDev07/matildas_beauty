@extends('admin.shopee.layouts')

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
            <span class="tfont-medium">File upload is successful!</span> {{ session()->get('success') }}
        </div>
    </div>
@endif

@if(session()->has('failed'))
    <div class="tbg-red-200 tflex tmb-4 tp-4 trounded-lg ttext-red-600 txt-sm" role="alert">
        <svg class="tw-5 th-5 tinline tmr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
        </svg>
        <div>
            <span class="tfont-medium">File upload failed!</span> 
            Please contact 
            <span class="tfont-medium">Reggie Frias</span> 

        </div>
    </div>
@endif

    <div class="tbg-white tpb-5 trounded-lg tshadow-lg ttext-black-100">
        <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
            Upload Orders
        </div>
     
        <form action="{{ url('/admin/shopee/store') }}" method="post" enctype="multipart/form-data">
            @csrf

            {{-- <label for="store" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Excel File</label>
            <input type="file" name="file" id="file">
            <hr> --}}

            <div class="tflex tjustify-center tpx-5 tmt-5">
                <div class="tw-1/2 tmr-3">
                    <select name="store" id="store" class="tcursor-pointer browser-default form-control" style="padding: 6px;">
                        <option value="matilda007">Matilda's Online Store</option>
                        <option value="enlarge_oil">Enlarge Oil</option>
                        <option value="matilda_merchandise">Matilda's Merchandise</option>
                        <option value="storelle">Storelle</option>
                        <option value="yvonne_coruna67">MCY</option>
                    </select>
                </div><!-- Shop Options -->
            </div>

            <div class="tflex tjustify-center tpx-5 tmt-5">
                <div class="tw-1/2 tmr-3">
                    
                </div><!-- Shop Options -->
            </div>

            <main class="tflex titems-center tjustify-center tbg-gray-100 tfont-sans tmt-5">
                <label for="file" class="tmx-auto tcursor-pointer tflex tw-full tmax-w-lg tflex-col titems-center trounded-xl tborder-2 tborder-dashed tborder-blue-400 tbg-white tp-6 ttext-center">
                  <svg xmlns="http://www.w3.org/2000/svg" class="th-10 tw-10 ttext-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                  </svg>
              
                  <h2 class="tmt-4 ttext-xl tont-medium ttext-gray-700 ttracking-wide">Excel File</h2>
              
                  <p class="tmt-2 ttext-gray-500 ttracking-wide">Upload your file (.xlsx) only</p>
              
                  <input type="file" name="file" id="file" class="thidden" />
            </main><!-- File Upload -->

            
            @error('file')
                <div class="ttext-red-600 tfont-bold ttext-center tmt-2">
                    <div class="ttext-red-600 tfont-bold">{{ $message }}</div>
                </div>
            @enderror


            <div class="tflex tjustify-center tpx-5 tmt-5">
                <div class="tflex tjustify-end tpy-5 trounded-lg 100 tmt-5">
                    <button type="submit" class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect">Submit</button>
                </div><!-- Save -->
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