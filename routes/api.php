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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->get('/users',function (){
    return new \App\Http\Resources\UserCollection(\App\User::all());
});
Route::middleware('auth:api')->post('/articles','ArticlesController@store');
Route::middleware('auth:api')->get('/articles/{id}', 'ArticlesController@detailApi');
Route::middleware('auth:api')->delete('/articles/{id}', function ($id) {
     \App\Article::find($id)->delete();
});
Route::middleware('auth:api')->get('/articles','ArticlesController@index');
Route::middleware('auth:api')->post('/types','TypesController@store');
Route::middleware('auth:api')->get('/types','TypesController@index');
Route::middleware('auth:api')->delete('/types/{id}', function ($id) {
    \App\Type::find($id)->delete();
});
Route::middleware('auth:api')->post('/labels','LabelsController@store');
Route::middleware('auth:api')->get('/labels','LabelsController@index');
Route::middleware('auth:api')->delete('/labels/{id}', function ($id) {
    \App\Label::find($id)->delete();
});


