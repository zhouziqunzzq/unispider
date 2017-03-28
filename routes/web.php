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

Route::get('/', 'IndexController@index');
Route::group(['middleware' => 'apiauth'], function () {
    Route::get('/test', function () {
        return 'test';
    });
    Route::resource('api/tweets', 'TweetController', ['only' => [
        'index', 'show', 'update', 'store'
    ]]);
    Route::resource('api/jobs', 'JobController', ['only' => [
        'index', 'store'
    ]]);
    Route::get('api/translate/machine', 'TranslateController@getMachineTranslation');
});