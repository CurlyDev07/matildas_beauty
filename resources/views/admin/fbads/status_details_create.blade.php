@extends('admin.fbads.layouts')

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">

        @if (session('success'))
            <div class="tbg-green-200 tborder tborder-green-600 tfont-medium tmb-3 tpy-2 trounded ttext-center ttext-green-900">
                Update Successful
            </div>
        @endif

        <form action="{{ route('fbads.status_details.store') }}" enctype="multipart/form-data"  method="POST">
            @csrf
            <input type="hidden" name="previous_status" value="{{ $previous_status}}">
            <input type="hidden" name="new_status" value="{{ $new_status}}">
            <input type="hidden" name="admin_name" value="{{ $admin_name}}">
            <input type="hidden" name="fbads_id" value="{{ $fbads_id}}">

            <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
                <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                    Customer Info
                </div>
                <div class="tflex tflex-wrap tpx-5">
                    <div class="tw-1/2 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                        <label for="category" class="tfont-medium ttext-sm tmb-2 ttext-black-100 active">Category</label>
                        <select id="category" name="category" class="browser-default tfont-normal ttext-sm tmb-2 tpx-2 ttext-black-100">
                            <option value="" style="color: #f43958">choose ....</option>
                            <option value="📦 Order Issues" style="color: #12b101">📦 Order Issues</option>
                            <option value="❌ High Cancellation Rate" style="color: #12b101">❌ High Cancellation Rate</option>
                            <option value="🚨 Fraud" style="color: #12b101">🚨 Fraud</option>
                            <option value="💸 Pricing & Fees" style="color: #12b101">💸 Pricing & Fees</option>
                            <option value="🕒 Timing" style="color: #12b101">🕒 Timing</option>
                            <option value="🤷 Personal Reasons" style="color: #12b101">🤷 Personal Reasons</option>
                            <option value="💳 Payment Concerns" style="color: #12b101">📦 Order Issues</option>
                            <option value="🏪 Purchase Method" style="color: #12b101">🏪 Purchase Method</option>
                            <option value="📵 Call Issues" style="color: #12b101">📵 Call Issues</option>
                            <option value="⏳ Delayed Interest" style="color: #12b101">⏳ Delayed Interest</option>
                        </select>
                    </div>
                    <div class="tw-full tmb-2 lg:tmb-0 tpx-1 tpb-3">
                        <label for="reason" class="tfont-medium ttext-sm tmb-2 ttext-black-100 active">Reason</label>
                        <textarea name="reason" id="reason" cols="30" rows="3" class="browser-default form-control"  style="padding: 6px;"></textarea>
                    </div>
                    <div class="tw-full tmb-2 lg:tmb-0 tpx-1 tpb-3">
                       
                        <div class="tflex tflex-col titems-center tjustify-center tw-full tpy-4">
                            <label for="file" class="tflex tflex-col titems-center tjustify-center tw-full th-64 tbg-gray-50 trounded-lg tborder-2 tborder-dashed tborder-gray-300 tcursor-pointer thover:bg-gray-100 ttransition-all">
                                <div class="tflex tflex-col titems-center tjustify-center tpt-5 tpb-6">
                                <svg class="tw-10 th-10 tmb-3 ttext-gray-400" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 16.5V19a2.5 2.5 0 002.5 2.5h13a2.5 2.5 0 002.5-2.5v-2.5M16.5 12.5L12 8m0 0l-4.5 4.5M12 8v9" />
                                </svg>
                                <p class="tmb-2 ttext-sm ttext-gray-500"><span class="tfont-semibold">Click to upload</span> or drag and drop</p>
                                <p class="ttext-xs ttext-gray-500">PNG, JPG up to 10MB</p>
                                </div>
                                <input id="file" name="file" type="file" accept="image/*" class="thidden" onchange="previewImage(event)" />
                            </label>

                            <div id="preview-container" class="tmt-4 thidden">
                                <p class="ttext-sm ttext-gray-600 tmb-2">Image Preview:</p>
                                <img id="image-preview" class="tmax-w-xs trounded-lg tshadow" />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
    
            <div class="tmt-10 ttext-right">
                <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn">Update</button>
            </div>
        </form>
    </div>

    @section('js')

    <script>
        function previewImage(event) {
            const fileInput = event.target;
            const file = fileInput.files[0];
            const previewContainer = document.getElementById('preview-container');
            const preview = document.getElementById('image-preview');

            if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                previewContainer.classList.remove('thidden');
            }
            reader.readAsDataURL(file);
            }
        }
    </script>
@endsection

@endsection




