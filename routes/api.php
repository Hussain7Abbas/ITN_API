<?php

Route::post('img/{dir}/{id}', 'API\BaseController@uploadImg');
Route::delete('img/{dir}/{id}', 'API\BaseController@deleteImg');
Route::get('img/{dir}/{id}', 'API\BaseController@getImg');


Route::group(['prefix' => 'users'], function () {
    Route::get('all/{idUs}', 'API\UsersController@getUsers');
    Route::post('search', 'API\UsersController@searchUsers');
    Route::post('', 'API\UsersController@store');
    Route::get('{idUs}', 'API\UsersController@getUser');
    Route::put('{idUs}', 'API\UsersController@update');
    Route::delete('{idUs}', 'API\UsersController@destroy');
});

Route::group(['prefix' => 'investors'], function () {
    Route::get('all/{idIn}', 'API\InvestorsController@getInvestors');
    Route::post('search', 'API\InvestorsController@searchInvestors');
    Route::post('', 'API\InvestorsController@store');
    Route::get('{idIn}', 'API\InvestorsController@getInvestor');
    // Route::put('{idIn}', 'API\InvestorsController@update');
    Route::delete('{idIn}', 'API\InvestorsController@destroy');
});

Route::group(['prefix' => 'signals'], function () {
    Route::get('all/{idSi}', 'API\SignalsController@getSignals');
    Route::post('search', 'API\SignalsController@searchSignals');
    Route::post('', 'API\SignalsController@store');
    Route::get('{idSi}', 'API\SignalsController@getUser');
    Route::put('{idSi}', 'API\SignalsController@update');
    Route::delete('{idSi}', 'API\SignalsController@destroy');
});

