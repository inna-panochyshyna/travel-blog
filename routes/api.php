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

Route::get('cards', 'AboutCardController@index');
Route::get('carousel', 'CarouselController@index');
Route::get('posts', 'PostController@index');
Route::get('comments', 'CommentController@index');
Route::get('categories', 'CategoryController@index');
Route::get('users', 'UserController@index');
Route::get('posts/{id}', 'PostController@show');
Route::post('comments', 'CommentController@store');
Route::post('messages', 'MessageController@store');