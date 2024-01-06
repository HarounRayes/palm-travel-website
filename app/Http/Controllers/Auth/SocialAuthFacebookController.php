<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialAuthFacebookController extends Controller
{
    /**
     * Create a redirect method to facebook api.
     *
     * @return void
     */
    public function redirect()
    {

        return Socialite::driver('facebook')->redirect();

    }

    public function handleProviderCallback()
    {
        try {
            //if Authentication is successfull.
            $user = Socialite::driver('facebook')->user();

            /**
             *  Below are fields that are provided by
             *  every provider.
             */
            $provider_id = $user->getId();
            $name = $user->getName();
            $email = $user->getEmail();
            $avatar = $user->getAvatar();
            //$user->getNickname(); is also available

            // return the user if exists or just create one.
            $user = Member::firstOrCreate([
                'provider_id' => $provider_id,
                'name' => $name,
                'email' => $email,
                'provider' => 'facebook'
//                'avatar' => $avatar,
            ]);

            /**
             * Authenticate the user with session.
             * First param is the Authenticatable User object
             * and the second param is boolean for remembering the
             * user.
             */
            Auth::guard('member')->login($user, true);

            //Success
            return redirect()->route('home');
        } catch (\Exception $e) {
            //Authentication failed
            return redirect()
                ->back()
                ->with('status', 'authentication failed, please try again!');
        }
    }
}
