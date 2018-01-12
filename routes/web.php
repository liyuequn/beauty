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
Route::post('/auth','Auth\LoginController@auth');//自动登录
Route::get('/test','TestController@index');
Route::get('/test2','TestController@index2');
Route::get('/commentsIn','CommentController@insertComments');
Route::get('/video/{id}','VideoController@index');
Route::post('/sendMessage','MessageController@create');
Route::get('/readMessage/{id}','MessageController@read');
Route::get('/receiveMessage/{send_to_id}/sys/{sys}','MessageController@index');
Route::get('/websocket','TestController@index');

Route::get('/login','UserController@login');
Route::get('/user/center','UserController@userCenter');
Route::get('/register','UserController@register');
Route::post('/signUp','UserController@store');
Route::post('/signIn','UserController@signIn');
Route::post('/logout','UserController@logout');
Route::get('/write',function (){
    return view('article.write');
})->middleware(\App\Http\Middleware\CheckLogin::class);
Route::get('/article/edit/{id}',function (){
    return view('article.write');
});


