<?php

Route::get('login', function() {
    return view('auth.login');
});

Route::post('login', 'AuthController@processLogin');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/', function () {
        return view('welcome');
    });

});
