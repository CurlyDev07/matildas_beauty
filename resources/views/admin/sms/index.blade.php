@extends('admin.sms.layouts')

    

@section('page')


    <div class="tpb-5 trounded-lg ttext-black-100">
        <div class="tbg-white tpb-5 trounded-lg tshadow-2xl ttext-black-100 tmb-10">
            <div class="tflex tjustify-between text-sm tfont-medium tpx-5 tpy-4 t ttext-title">
                <div class="">SMS</div>
            </div>

            <div class="tflex tp-5 tjustify-between">
                <div class="tborder tp-5 trounded tshadow-2xl ttext-center">
                     <div class="tfont-medium">Phone Numbers</div>
                     <div class="tfont-medium ttext-3xl ttext-green-600">{{ number_format($all) }}</div>
                </div>
                <div class="tborder tp-5 trounded tshadow-2xl ttext-center">
                    <div class="tfont-medium">Message Templates</div>
                    <div class="tfont-medium ttext-3xl ttext-blue-600">15</div>
               </div>
               <div class="tborder tp-5 trounded tshadow-2xl ttext-center">
                    <div class="tfont-medium">CP# Last 7 Days</div>
                    <div class="tfont-medium ttext-3xl ttext-orange-600">{{ number_format($seven_days) }}</div>
                </div>
                <div class="tborder tp-5 trounded tshadow-2xl ttext-center">
                    <div class="tfont-medium">CP# Last 15 Days</div>
                    <div class="tfont-medium ttext-3xl ttext-orange-600">{{ number_format($fifteen_days) }}</div>
                </div>
                <div class="tborder tp-5 trounded tshadow-2xl ttext-center">
                    <div class="tfont-medium">CP# Last 30 Days</div>
                    <div class="tfont-medium ttext-3xl ttext-orange-600">{{ number_format($thirty_days) }}</div>
                </div>
            </div>
        </div>
    </div>

@endsection
