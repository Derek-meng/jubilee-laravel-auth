<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'    => 'auth/facebook',
    'as'        => 'auth.facebook.',
    'namespace' => 'Jubilee\Auth\Http\Controllers',
], function () {
    Route::get('/signIn', 'FacebookController@signIn')->name('signIn');
    Route::get('/feedback', 'FacebookController@feedback')->name('feedback');
});
