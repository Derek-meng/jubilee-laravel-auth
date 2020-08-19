<?php

namespace Jubilee\Auth;

use Illuminate\Support\ServiceProvider;
use Jubilee\Auth\Http\Controllers\AuthenticateController;

class AuthProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__ . DIRECTORY_SEPARATOR . 'routes' . DIRECTORY_SEPARATOR . 'auth.php');
        $this->loadViewsFrom(
            __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR,
            'auth'
        );
        $this->loadMigrationsFrom(__DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations');
        $this->publishes(
            [
                __DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'migrations'                   =>
                    base_path('database' . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR),
                __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR =>
                    base_path('resources' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'auth'),
                __DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'factories'                    =>
                    base_path('database' . DIRECTORY_SEPARATOR . 'factories' . DIRECTORY_SEPARATOR),
                __DIR__ . DIRECTORY_SEPARATOR . 'database' . DIRECTORY_SEPARATOR . 'seeds'                        =>
                    base_path('database' . DIRECTORY_SEPARATOR . 'seeds' . DIRECTORY_SEPARATOR),
                __DIR__ . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR                                    =>
                    base_path('config' . DIRECTORY_SEPARATOR),
            ]
        );
    }

    public function register()
    {
        $this->app->make(AuthenticateController::class);
    }
}
