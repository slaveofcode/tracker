<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\User;
use Socialite;

class AuthController extends Controller
{
    const REDIRECT_SESSION = 'lastUrlRedirect';
    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider(Request $request)
    {
        $session = $request->session();
        // set last url to session
        if ($session->has(self::REDIRECT_SESSION)) {
            $session->forget(self::REDIRECT_SESSION);
        }

        $session->put(self::REDIRECT_SESSION, URL::previous());

        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback(Request $request)
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

        URL::previous();

        if ($foundUser) {
            Auth::login($foundUser);
        }

        $redirectUrl = '/';
        $session = $request->session();
        if ($session->has(self::REDIRECT_SESSION)) {
            $redirectUrl = $session->get(self::REDIRECT_SESSION);
        }

        return redirect()->to($redirectUrl);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->back();
    }

}