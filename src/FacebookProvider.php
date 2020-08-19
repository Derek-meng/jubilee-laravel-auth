<?php

namespace Jubilee\Auth;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Jubilee\Auth\Http\Controllers\FacebookController;
use Jubilee\Auth\Services\FacebookCitizenService;

class FacebookProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'facebook.php');
    }

    /**
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function register()
    {
        $this->app->bind(FacebookCitizenService::class, function (Application $app) {
            return new FacebookCitizenService($app->make(\Laravel\Socialite\Two\FacebookProvider::class, [
                'clientId'     => config('facebook.client_id'),
                'clientSecret' => config('facebook.client_secret'),
                'redirectUrl'  => config('facebook.redirect_url')
            ]));
        });
        $this->app->make(FacebookController::class);
    }
}
