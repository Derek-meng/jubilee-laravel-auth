<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => 'auth/facebook',
    'as'         => 'auth.facebook.',
    'namespace'  => 'Jubilee\Auth\Http\Controllers',
    'middleware' => 'web',
], function () {
    Route::get('/signIn', 'FacebookController@signIn')->name('sign_in');
    Route::get('/feedback', 'FacebookController@feedback')->name('feedback');
});
