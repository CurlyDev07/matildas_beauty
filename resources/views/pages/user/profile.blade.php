<div id="profile" class="col s12">
    <div class="ttext-2xl ttext-title tfont-medium tpb-4">User Profile</div>
    <div class="tflex">
        <div class="thidden lg:tblock tw-1/3 tbg-white tmr-16 trounded-lg tshadow-lg">
            <div class="tflex tflex-col tborder-b tp-5">
                <div class="tmt-5 tmb-4">
                    <img class="trounded-full tmx-auto" src="{{ asset('images/icons/user.png') }}" width="110px" alt="">
                </div>
                <div class="ttext-center">
                    <span class="ttext-2xl ttext-title tmx-auto tfont-semibold">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</span>
                </div>
                <div class="ttext-center">
                    <span class="tfont-semibold tmx-auto ttext-gray-600">{{ auth()->user()->created_at? auth()->user()->created_at->format('M d, Y') : '' }}</span>
                </div>
                
            </div>
            <div class="tflex tp-5">
                {{ auth()->user()->about_me }}
            </div>
        </div>
        <div class="tw-full lg:tw-3/4 tbg-white ttext-black-100 trounded-lg tshadow-lg">
            <form action="{{ route('dashboard.profile.update') }}" method="post">
                @csrf

                <div class="tborder-b text-base tfont-medium tpx-5 tpy-4 t ttext-title">
                    Account Details
                </div>
                <div class="tflex tpx-5 tpt-5">
                    <div class="tw-1/2 tflex tflex-col tmr-2">
                        <label for="first_name" class="tfont-normal ttext-base tmb-2 ttext-black-100">First Name</label>
                        <input type="text" id="first_name" class="browser-default form-control" style="padding: 6px;" name="first_name" value="{{ auth()->user()->first_name }}">
                    </div><!-- First Name -->
                    <div class="tw-1/2 tflex tflex-col tml-2">
                        <label for="last_name" class="tfont-normal ttext-base tmb-2 ttext-black-100">Last Name</label>
                        <input type="text" id="last_name" class="browser-default form-control" style="padding: 6px;" name="last_name" value="{{ auth()->user()->last_name }}">
                    </div><!-- Last Name -->
                </div>
                <div class="tflex tpx-5 tpt-5">
                    <div class="tw-1/2 tflex tflex-col tmr-2">
                        <label for="email" class="tfont-normal ttext-base tmb-2 ttext-black-100">Email</label>
                        <input type="email" id="email" class="browser-default form-control tcursor-not-allowed" style="padding: 6px;" disabled value="{{ auth()->user()->email }}">
                    </div><!-- Email -->
                    <div class="tw-1/2 tflex tflex-col tml-2">
                        <label for="phone_number" class="tfont-normal ttext-base tmb-2 ttext-black-100">Phone number</label>
                        <input type="number" 
                            id="phone_number" 
                            class="browser-default form-control" 
                            style="padding: 6px;" 
                            placeholder="09182342412"
                            name="phone_number" 
                                @if (auth()->user()->phone_number)
                                    value="{{ auth()->user()->phone_number }}"
                                @endif
                            >
                    </div><!-- phone_number -->
                </div>
                <div class="tw-full tflex tpx-5 tpt-5">
                    <div class="tw-3/5 tflex tflex-col tmr-2">
                        <label for="address" class="tfont-normal ttext-base tmb-2 ttext-black-100">Address</label>
                        <input type="text" id="address" class="browser-default form-control" style="padding: 6px;" name="address" value="{{ auth()->user()->address }}">
                    </div><!-- Address -->
                    <div class="tw-2/5 tflex tflex-col tml-2">
                        <label for="barangay" class="tfont-normal ttext-base tmb-2 ttext-black-100">Barangay / District</label>
                        <input type="text" id="barangay" class="browser-default form-control" style="padding: 6px;" name="barangay" value="{{ auth()->user()->address }}">
                    </div><!-- Barangay -->
                </div>
                <div class="tflex tpx-5 tpt-5">
                    <div class="tw-3/5 tflex tflex-col">
                        <label for="city" class="tfont-normal ttext-base tmb-2 ttext-black-100">City</label>
                        <input type="text" id="city" class="browser-default form-control" style="padding: 6px;" name="city" value="{{ auth()->user()->city }}">
                    </div><!-- City -->
                    <div class="tw-2/5 tflex tflex-col tmx-4">
                        <label for="province" class="tfont-normal ttext-base tmb-2 ttext-black-100">Province/State</label>
                        <input type="text" id="province" class="browser-default form-control" style="padding: 6px;" name="province" value="{{ auth()->user()->province }}">
                    </div><!-- Province/State -->
                    <div class="tw-1/5 tflex tflex-col">
                        <label for="zip" class="tfont-normal ttext-base tmb-2 ttext-black-100">Zip</label>
                        <input type="text" id="zip" class="browser-default form-control" style="padding: 6px;"  name="zip" value="{{ auth()->user()->zip }}">
                    </div><!-- Zip -->
                </div>
                <div class="tw-full tpx-5 tpt-5 tmb-5">
                    <div class="tw-2/2 tflex tflex-col">
                        <label for="about_me" class="tfont-normal ttext-base tmb-2 ttext-black-100">About Me</label>
                        <textarea class="browser-default form-control" id="about_me" rows="5" style="padding: 6px;"  name="about_me">{{ auth()->user()->about_me }}</textarea>
                    </div><!-- About Me -->
                </div>
                <div class="tw-full tpx-5 tpt-5 tmb-5 ttext-right">
                    <button type="submit" class="trounded tbg-primary focus:tbg-primary waves-effect tpx-5 tpt-2 tpb-3 ttext-white">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>