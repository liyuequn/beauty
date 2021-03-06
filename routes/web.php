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
Route::get('/', 'Web\Front\IndexController@index');
Route::get('/articles/{search}', 'Web\Front\IndexController@index');
Route::get('/p/{id}','Web\Front\ArticlesController@show');
Route::post('/login','Auth\LoginController@login');
Route::post('/auth','Auth\LoginController@auth');//自动登录
Route::get('/test','TestController@index');
Route::get('/test2','TestController@index2');
Route::get('/commentsIn','CommentController@insertComments');
Route::get('/login','Web\Front\UserController@login');
Route::get('/user/center','Web\Front\UserController@userCenter');
Route::get('/register','Web\Front\UserController@register');
Route::post('/signUp','Web\Front\UserController@store');
Route::post('/signIn','Web\Front\UserController@signIn');
Route::post('/logout','Web\Front\UserController@logout');
Route::get('/write',function (){
    return view('article.write');
})->middleware(\App\Http\Middleware\CheckLogin::class);
Route::get('/article/edit/{id}',function (){
    return view('article.write');
});
Route::get('/fmh',function (){
    return view('article.fmh');
});
Route::get('/res',function (){
    return view('article.result');
});
Route::post('/fmh','Web\Front\FmhController@index');
Route::post('/res','Web\Front\FmhController@res');
Route::get('/image','Web\Backend\ProxyImageController@index');
Route::get('/reprint',function (){
    return view('article.post',['url'=>'api/v1/reprint']);
});


