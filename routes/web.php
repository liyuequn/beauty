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

Route::get('/backend', function () {
    return view('backend');
});
Route::get('/', 'IndexController@index');
Route::get('/p/{id}','ArticlesController@detail');
Route::post('/login','Auth\LoginController@login');
Route::get('/test','TestController@index');

