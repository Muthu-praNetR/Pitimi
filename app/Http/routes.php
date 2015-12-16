<?php

Route::get('login', 'AuthController@loginForm');
Route::post('login', 'AuthController@login');
Route::get('logout', 'AuthController@logout');

Route::group(['middleware' => 'auth'], function () {

    Route::get('/{year?}/{month?}', ['as' => 'calendar', 'uses' => 'CalendarController@calendar']);

});
