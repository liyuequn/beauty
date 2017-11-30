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

Route::get('/', function () {
    return view('font');
});
Route::post('/test','TestController@index');
Route::post('/test/test','TestController@test');
Route::get('/admin', function () {
    return view('welcome');
});
