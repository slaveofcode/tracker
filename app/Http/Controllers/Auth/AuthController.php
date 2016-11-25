<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('google')->user();

        $foundUser = null;

        /*
         * Find existing users
         */
        if (!User::where('email', '=', $user->getEmail())->exists())
        {
            $newUser                    = new User;
            $newUser->name              = $user->getName();
            $newUser->email             = $user->getEmail();
            $newUser->google_id         = $user->getId();
            $newUser->google_nickname   = $user->getNickname();
            $newUser->google_avatar     = $user->getAvatar();
            $newUser->save();

            $foundUser = $newUser;

        } else {
            
            /*
             * Get user
             */
            $foundUser = User::where('email', '=', $user->getEmail())->first();

        }

        if ($foundUser) {
            Auth::login($foundUser);
        }

        return redirect()->to('/');
    }


}