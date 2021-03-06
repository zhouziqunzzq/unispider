<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Api static routes
Route::get('api', 'IndexController@apitest');

// Img
Route::get('twimg/{imgid}', 'IndexController@img');

//Api auth required routes
Route::group(['middleware' => 'apiauth'], function () {
    Route::resource('api/tweets', 'TweetController', ['only' => [
        'index', 'show', 'update', 'store'
    ]]);
    /*Route::resource('api/jobs', 'JobController', ['only' => [
        'index', 'store'
    ]]);*/
    Route::get('api/jobs/spider/{type}', 'JobController@index');
    Route::post('api/jobs/spider/{type}', 'JobController@store');
    Route::get('api/translate/machine', 'TranslateController@getMachineTranslation');
});

// All other routes
Route::get('{param}', 'IndexController@index')->where('param', '(.*)');