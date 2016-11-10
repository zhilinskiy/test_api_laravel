<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'v1'],function (){
    Route::post('get_key','Ver1\ApiController@get_key');
    Route::post('check','Ver1\ApiController@check')->middleware('check_key');
    Route::post('count','Ver1\ApiController@count')->middleware('check_key');
});
