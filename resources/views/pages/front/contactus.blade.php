@extends('layouts.app')

@section('content')
    <div class="tcontainer tpy-8">
        <h1 class="ttext-primary ttext-xl tfont-medium tmb-6">CONTACT US</h1>
    
        <div class="tbg-white tflex tflex-col lg:tflex-row tp-5">
            <div class="tw-5/5 lg:tw-3/5">
                <div class="tleading-loose">
                    <form action="javascript:void(0)" class="">
                        <div class="ttext-xl tmb-5" style="color:#757576">Leave a <b>Message</b></div>
                        <div class="row tpr-5">
                            <div class="col s12 m6">
                                <div class="input-field col s12">
                                    <input id="name" type="text" class="validate">
                                    <label for="name">Name</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="email" type="email" class="validate">
                                    <label for="email">Email</label>
                                </div>
                                <div class="input-field col s12">
                                    <input id="tel" type="tel" class="validate">
                                    <label for="tel">Telephone</label>
                                </div>
                            </div>
                            <div class="col s12 m6">
                                <div class="col s12">
                                    <label for="input_text">Message</label>
                                    <textarea class="browser-default focus:toutline-none focus:tshadow-inner tborder tborder-gray-300 tp-3 trounded tshadow-inner" id="message" data-length="255" style="height: 182px; border-bottom: 1px solid #e2e8f0;"></textarea>
                                </div>
                            </div>
                            <div class="col s12 ttext-right">
                                <div class="tpr-3">
                                    <button class="focus:tbg-primary tbg-primary tpx-5 tpy-1 ttext-white waves-effect waves-light">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div><!-- LEFT -->
            <div class="tw-5/5 lg:tw-2/5 lg:tborder-0 lg:tmt-0 lg:tpt-0 tborder-t tmt-3 tpt-8">
                <div class="lg:tmb-12 tmb-8 ttext-xl" style="color:#757576">Contact <b>Details</b></div>
                <div class="tflex titems-center tmb-4">
                    <div class="tbg-primary tpx-4 tpy-3 tmr-4">
                        <i class="fas fa-mobile-alt ttext-white fa-lg"></i>
                    </div>
                    <div class="tflex tflex-col ttext-gray-600">
                      <span>(02) 913 1111</span>
                      <span>(02) 913 2145</span>
                    </div>
                </div>
                <div class="tflex titems-center tmb-4">
                    <div class="tbg-primary tpx-3 tpy-3 tmr-4">
                        <i class="fas fa-phone ttext-white fa-lg"></i>
                    </div>
                    <div class="tflex tflex-col ttext-gray-600">
                      <span>0927 898 6797</span>
                      <span>0955 009 0156</span>
                    </div>
                </div>
                <div class="tflex titems-center tmb-4">
                    <div class="tbg-primary tpx-3 tpy-3 tmr-4">
                        <i class="fas fa-at ttext-white fa-lg"></i>
                    </div>
                    <div class="tflex tflex-col ttext-gray-600">
                        <span>admin@shopickers.com</span>
                        <span>shopickers@gmail.com</span>
                    </div>
                </div>
                <div class="tflex titems-center tmb-4">
                    <div class="tbg-primary tpx-3 tpy-3 tmr-4">
                        <i class="fab fa-facebook ttext-white fa-lg"></i>
                    </div>
                    <div class="tflex tflex-col">
                        <a href="https://facebook.com/shopickers/" class="hover:tunderline ttext-primary">https://facebook.com/shopickers/</a>
                        <a href="https://facebook.com/shopickers/" class="hover:tunderline ttext-primary">@shopickers</a>
                    </div>
                </div>
            </div><!-- RIGHT -->
        </div>
    </div>
@endsection

@section('js')

    <script>
        $(document).ready(function() {
            $('input#input_text, textarea#message').characterCounter();
        });
    </script>
    
@endsection