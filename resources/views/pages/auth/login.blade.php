@extends('layouts.app')

@section('content')

    <div class="tmx-0 tpx-0 md:tmx-10 md:tpx-8  tpt-5 sm:tpb-8 md:tpy-8">

        <h1 class="tfont-medium tmb-4  ttext-primary ttext-xl ttext-center sm:ttext-left">LOGIN OR CREATE AN ACCOUNT</h1>

        <div class="md:tflex-row md:tp-8 tbg-white tborder-primary tborder-t-4 tflex tflex-col sm:tmb-10 tpx-5 tpy-8">
            <div class="md:tw-1/2 torder-last md:torder-first tflex tflex-wrap tjustify-end md:tmr-5 md:tpx-8 md:tpx-4 tpx-3 tpy-2">
                <div class="">
                    <h2 class="ttext-gray-700 ttext-xl tmb-4">New Customers</h2>
        
                    <p class="ttext-sm ttext-gray-600 tleading-relaxed ttracking-wider">
                        By creating an account with our store, you will be able to move through
                        the checkout process faster, store multiple shipping addresses, view and track your
                        orders in your account and more.
                    </p>
                </div>
                <a href="{{ route('register') }}" class="focus:tbg-primary md:tmt-0 tbg-primary tmt-6 tpx-5 tpy-2 trounded tself-end ttext-white waves-effect">Create an Account</a>
            </div>
            <div class="md:tw-1/2 md:tml-5 tpy-2">
                <div class="row tmb-3">
                    <div class="col s12">
                        <h2 class="ttext-gray-700 ttext-xl tmb-4">Login</h2>
                        <p class="ttext-sm ttext-gray-600 tleading-relaxed ttracking-wider">If you have an account with us, please log in.</p>
                    </div>
                </div>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="row tmb-0">
                        <div class="input-field col s12">
                            <input id="email" type="text" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            <label for="email">Email</label>
                            @error('email')
                                <small class="ttext-error right">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="password" type="password" name="password" value="{{ old('password') }}" required>
                            <label for="password">Password</label>
                            @error('password')
                                <small class="ttext-error right">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="tflex tflex-col sm:tflex-row  tjustify-between">
                        <div class="sm:tmt-0 tflex titems-center tjustify-center tmt-8">
                            <a href="{{ route('auth.fb') }}" class="focus:tbg-gray-300 focus:tbg-white hover:tshadow-xl tbg-gray-300 tflex tpx-4 tpy-2 trounded waves-effect waves-light tmr-2">
                              <img src="https://accounts.google.com/favicon.ico" class="tmr-2" alt="google icon" width="24" height="24">
                              Google
                            </a>
                            <a href="{{ route('auth.fb') }}" class="focus:tbg-gray-300 hover:tshadow-xl focus:tbg-white t-mr-1 tbg-gray-300 tflex tml-2 tpx-4 tpy-2 trounded waves-effect waves-light">
                              <img src="https://facebookbrand.com/wp-content/uploads/2016/05/flogo_rgb_hex-brc-site-250.png" class="tmr-2" alt="google icon" width="24" height="24">
                              Facebook
                            </a>
                          </div>

                        {{-- <a href="" class="hover:tunderline ttext-primary">Forgot Your Password?</a> --}}
                        <button type="submit" class="torder-first sm:torder-last tpy-2 tw-full sm:tw-auto focus:tbg-primary hover:tshadow-xl tbg-primary tpx-10 trounded ttext-white waves-effect waves-light">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection