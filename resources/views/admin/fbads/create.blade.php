@extends('admin.fbads.layouts')

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">

        @if (session('success'))
            <div class="tbg-green-200 tborder tborder-green-600 tfont-medium tmb-3 tpy-2 trounded ttext-center ttext-green-900">
                Update Successful
            </div>
        @endif

        <form action="{{ route('fbads.store') }}" method="POST">
            @csrf
            <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
                <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                    Customer Info
                </div>
                <div class="tflex tflex-wrap tpx-5">
                    <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                        <label for="full_name" class="tfont-medium ttext-sm tmb-2 ttext-black-100 active">Full name</label>
                        <input type="text" id="full_name" name="full_name" class="browser-default form-control" value="" style="padding: 6px;">
                    </div>
                    <div class="tw-1/5 tmb-2 lg:tmb-0 tpx-1 tpb-3">
                        <label for="phone_number" class="tfont-medium ttext-sm tmb-2 ttext-black-100 active">Phone number</label>
                        <input type="number" id="phone_number" name="phone_number" class="browser-default form-control" value="" style="padding: 6px;">
                    </div>
                    <div class="tw-full tmb-2 lg:tmb-0 tpx-1 tpb-3">
                        <label for="address" class="tfont-medium ttext-sm tmb-2 ttext-black-100 active">Address</label>
                        <textarea name="address" id="address" cols="30" rows="3" class="browser-default form-control"  style="padding: 6px;"></textarea>
                    </div>
                </div>
            </div>
    
            <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmt-5">
                <div class="text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                    Order Details
                </div>
                <div class="tflex tflex-wrap tpx-5">
                    <div class="tw-1/5 tpx-1">
                        <label for="product" class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Product</label>
                        <input type="text" id="product" name="product" class="browser-default form-control" value="" style="padding: 6px;">
                    </div>
                    <div class="tw-1/5 tpx-1">
                        <label for="promo" class="tfont-normal ttext-sm tmb-2 ttext-black-100 active">Promo</label>
                        <input type="text" id="promo" name="promo" class="browser-default form-control" value="" style="padding: 6px;">
                    </div>
                    <div class="tw-1/5 tpx-1 tpx-1 tmb-2 lg:tmb-0">
                        <label for="total" class="tfont-normal ttext-sm tmb-2 ttext-black-100">Amount</label>
                        <input type="text" id="total" name="total" class="browser-default form-control" value="" style="padding: 6px;">
                    </div>
                </div>
            </div>
            
            <div class="tmt-10 ttext-right">
                <button class="focus:tbg-primary tbg-primary tml-auto tpy-2 trounded ttext-white tw-24 waves-effect" id="submit_btn">Update</button>
            </div>
        </form>
    </div>
@endsection
