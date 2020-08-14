<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'auth/',
    'as'        => 'auth.',
    'namespace' => 'Jubilee\Auth\Http\Controllers',
], function () {
    Route::get('/login', 'AuthenticateController@loginIndex')->name('login');
    Route::post('/', 'AuthenticateController@login')->name('store')->middleware('web');
    Route::post('/register', 'AuthenticateController@register')->name('register')->middleware('web');
    Route::get('/logout', 'AuthenticateController@logout')->name('logout')->middleware(['web', 'auth']);
});
