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
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });
    Route::middleware('auth:api')->get('/users',function (){
        return new \App\Http\Resources\UserCollection(\App\User::all());
    });
    Route::middleware('auth:api')->post('/articles','Api\Backend\ArticlesController@store');
    Route::middleware('auth:api')->get('/articles/{id}', 'Api\Backend\ArticlesController@detailApi');
    Route::middleware('auth:api')->delete('/articles/{id}', function ($id) {
        \App\models\Article::find($id)->delete();
    });
    Route::get('/articles','Api\Backend\ArticlesController@index');
    Route::middleware('auth:api')->post('/types','Api\Backend\TypesController@store');
    Route::middleware('auth:api')->post('/image/upload','Api\FilesController@ImageUpload');
    Route::middleware('auth:api')->get('/types','Api\Backend\TypesController@index');
    Route::middleware('auth:api')->delete('/types/{id}', function ($id) {
        \App\models\Type::find($id)->delete();
    });
    Route::middleware('auth:api')->post('/labels','Api\Backend\LabelsController@store');
    Route::middleware('auth:api')->get('/labels','Api\Backend\LabelsController@index');
    Route::middleware('auth:api')->delete('/labels/{id}', function ($id) {
        \App\models\Label::find($id)->delete();
    });
    Route::post('/article/comment','\Front\CommentController@create');
    Route::get('/article/comment/{article_id}','\Front\CommentController@index');

    Route::post('/files','UploadController@store')->middleware('cores');

    Route::get('/books','Api\Backend\BookController@index');
    Route::post('/books','Api\Backend\BookController@store');
    Route::delete('/books/{id}','Api\Backend\BookController@delete');
    Route::middleware('auth:api')->post('/reprint','Api\Backend\ArticlesController@reprint');
});



