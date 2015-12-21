<?php

Route::get('login', ['uses' => 'AuthController@loginForm', 'as' => 'login']);
Route::post('login', 'AuthController@login');
Route::get('logout', ['uses' => 'AuthController@logout', 'as' => 'logout']);

Route::group(['middleware' => 'auth'], function () {

    Route::get('/{year?}/{month?}', ['as' => 'calendar', 'uses' => 'CalendarController@calendar'])
        ->where([
            'year' => '[0-9]+',
            'month' => '[0-9]+',
        ]);

    Route::get('/speakers', ['uses' => 'SpeakerController@getList', 'as' => 'list-speakers']);
    Route::get('/speaker/new', ['uses' => 'SpeakerController@getNew', 'as' => 'new-speaker']);
    Route::post('/speaker/new', ['uses' => 'SpeakerController@postNew']);
    Route::get('/speaker/{id}', ['uses' => 'SpeakerController@getEdit', 'as' => 'edit-speaker']);
    Route::post('/speaker/{id}', ['uses' => 'SpeakerController@postEdit']);

    Route::get('/talks', ['uses' => 'TalkController@getList', 'as' => 'list-talks']);
    Route::get('/talk/new', ['uses' => 'TalkController@getNew', 'as' => 'new-talk']);
    Route::post('/talk/new', ['uses' => 'TalkController@postNew']);
    Route::get('/talk/{id}', ['uses' => 'TalkController@getEdit', 'as' => 'edit-talk']);
    Route::post('/talk/{id}', ['uses' => 'TalkController@postEdit']);

    Route::get('/users', ['uses' => 'UserController@getList', 'as' => 'list-users']);
    Route::get('/user/new', ['uses' => 'UserController@getNew', 'as' => 'new-user']);
    Route::post('/user/new', ['uses' => 'UserController@postNew']);
    Route::get('/user/{id}', ['uses' => 'UserController@getEdit', 'as' => 'edit-user']);
    Route::post('/user/{id}', ['uses' => 'UserController@postEdit']);

});
