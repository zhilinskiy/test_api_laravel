<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/test_api', function () {
    return view('home', [
        'users' => App\Models\Ver1\User::all(),
        'contents' => App\Models\Ver1\Content::all(),
        'urls' => App\Models\Ver1\Url::all(),
    ]);
});
