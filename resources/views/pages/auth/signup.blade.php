@extends('layouts.app')

@section('content')

    <div class="md:tmx-10 md:tpt-8 md:tpx-8 tmx-0 tpb-5 tpt-2 tpx-0">

        <h1 class="tfont-medium ttext-center md:ttext-left tmb-4 tmt-2 ttext-primary ttext-xl">Create a New Account</h1>

        <div class="tbg-white md:tp-8 tpx-5 tpy-8  sm:tmb-10 tborder-primary tborder-t-4">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <h2 class="ttext-gray-700 ttext-xl tmb-4 ttext-gray-500">PERSONAL INFORMATION</h2>
                <div class="row tmb-0">
                    <div class="input-field col s12 m6  ttext-right">
                        <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" style="margin: 0px;">
                        <label for="first_name">First Name</label>
                        @error('first_name')
                            <small class="ttext-error">{{ $message }}</small>
                        @enderror
                    </div><!-- First Name -->

                    <div class="input-field col s12 m6 ttext-right">
                        <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" style="margin: 0px;">
                        <label for="last_name">Last Name</label>
                        @error('last_name')
                            <small class="ttext-error">{{ $message }}</small>
                        @enderror
                    </div><!-- Last Name -->
                    
                </div>
                <div class="row tmb-0">
                    <div class="input-field col s12 m6 ttext-right">
                        <input id="email" type="text" name="email" value="{{ old('email') }}" style="margin: 0px;">
                        <label for="email">Email Address</label>
                        @error('email')
                            <small class="ttext-error">{{ $message }}</small>
                        @enderror
                    </div><!-- Email Address -->

                    <div class="input-field col s12 m6 ttext-right">
                        <input id="phone_number" type="text" name="phone_number" value="{{ old('phone_number') }}" style="margin: 0px;">
                        <label for="phone_number">Phone Number</label>
                        @error('phone_number')
                            <small class="ttext-error">{{ $message }}</small>
                        @enderror
                    </div><!-- Contact Number -->
                </div>
                <div class="row">
                    <div class="col input-field m6 s12 s6 ttext-right">
                        <input id="password" type="password" name="password" value="{{ old('password') }}" style="margin: 0px;">
                        <label for="password">Password</label>
                        @error('password')
                            <small class="ttext-error">{{ $message }}</small>
                        @enderror
                    </div><!-- Password -->

                    <div class="col input-field m6 s12 s6 ttext-right">
                        <input id="password_confirmation" type="password" name="password_confirmation" value="{{ old('password_confirmation') }}" style="margin: 0px;">
                        <label for="password_confirmation">Confirm Password</label>
                        @error('password_confirmation')
                            <small class="ttext-error">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="tflex tjustify-end titems-center tpx-2">
                    <button type="submit" class="tbg-primary focus:tbg-primary waves-effect tpx-5 tpt-2 tpb-3 ttext-white focus:toutline-none">Submit</button>
                </div>
            </form>
        </div>
    </div>
@endsection