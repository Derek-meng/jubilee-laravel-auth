<?php

namespace Jubilee\Auth\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Laravel\Socialite\Facades\Socialite;
use Laravel\Socialite\Two\FacebookProvider;

class FacebookController
{
    /**
     * @return RedirectResponse
     */
    public function signIn(): RedirectResponse
    {
        /** @var FacebookProvider $driver */
        $driver = Socialite::driver('facebook');

        return $driver->scopes(['user_friends'])
            ->redirectUrl(config('services.facebook.redirect'))
            ->redirect();
    }

    public function feedback()
    {
    }
}
