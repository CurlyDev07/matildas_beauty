<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class SocialiteCon extends Controller
{
    public function facebook_redirect(){
        return Socialite::driver('facebook')->redirect();
    }

    public function facebook_callback(){
        if (request()->error) {
            return redirect('/login');
        }

        $userSocial = Socialite::driver('facebook')->fields(['first_name', 'last_name', 'email'])->user();
        $finduser = User::where('provider_id', $userSocial->id)->first();

        if($finduser){
            Auth::login($finduser);
            return redirect('/');
        }else{
            $new_user = User::create([
                'first_name'    => $userSocial->user['first_name'],
                'last_name'    => $userSocial->user['last_name'],
                'email'      => $userSocial->email,
                'picture'  => $userSocial->avatar_original,
                'provider_name'=> 'fb',
                'provider_id'=> $userSocial->id,
            ]);
            Auth::login($new_user);
            return redirect('/');
        }
    }
}
