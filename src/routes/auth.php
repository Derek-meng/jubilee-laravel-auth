<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'auth/',
    'as'         => 'auth.',
    'namespace'  => 'Jubilee\Auth\Http\Controllers',
    'middleware' => 'web'
], function () {
    Route::get('/login', 'AuthenticateController@loginView')->name('login');
    Route::post('/', 'AuthenticateController@login')->name('store');
    Route::get('/register', 'AuthenticateController@registerView')->name('register.view');
    Route::post('/register', 'AuthenticateController@register')->name('register');
    Route::get('/logout', 'AuthenticateController@logout')->name('logout')->middleware('auth');
});
