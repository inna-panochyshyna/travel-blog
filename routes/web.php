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

Auth::routes(['verify' => true]);

//View
Route::get('/', 'AppController@index');
Route::get('about', 'AppController@index');
Route::get('posts', 'AppController@index');
Route::get('posts/{any}', 'AppController@index')->where('any', '.*');
Route::get('contact', 'AppController@index');

//View for user
Route::get('/dashboard', 'HomeController@index')->name('dashboard');
Route::get('/dashboard/posts', 'HomeController@index');
Route::get('/dashboard/comments', 'HomeController@index');
Route::get('/dashboard/posts/{any}', 'HomeController@index')->where('any', '.*');
Route::get('/dashboard/comments/{any}', 'HomeController@index')->where('any', '.*');

//View for admin
Route::get('/dashboard/admin', 'HomeController@index')->name('dashboard');
Route::get('/dashboard/admin/users', 'HomeController@index');
Route::get('/dashboard/admin/categories', 'HomeController@index');
Route::get('/dashboard/admin/posts', 'HomeController@index');
Route::get('/dashboard/admin/comments', 'HomeController@index');
Route::get('/dashboard/admin/messages', 'HomeController@index');
Route::get('/dashboard/admin/users/{any}', 'HomeController@index')->where('any', '.*');
Route::get('/dashboard/admin/categories/{any}', 'HomeController@index')->where('any', '.*');
Route::get('/dashboard/admin/posts/{any}', 'HomeController@index')->where('any', '.*');
Route::get('/dashboard/admin/comments/{any}', 'HomeController@index')->where('any', '.*');
Route::get('/dashboard/admin/messages/{any}', 'HomeController@index')->where('any', '.*');

//Comments
Route::get('/api/comments/{id}', 'CommentController@show');
Route::delete('/api/comments/{id}', 'CommentController@destroy');

//Posts
Route::get('/api/posts/{id}', 'PostController@show');
Route::post('/api/posts', 'PostController@store');
Route::delete('/api/posts/{id}', 'PostController@destroy');

//Users
Route::get('/api/users/{id}', 'UserController@show');
Route::get('/api/activity', 'BlogController@index');
Route::get('/api/users/activity/{id}', 'UserController@activity');
Route::post('/api/users/role/{id}', 'UserController@setRole');
Route::delete('/api/users/{id}', 'UserController@destroy');

//Categories
Route::post('/api/categories', 'CategoryController@store');
Route::delete('/api/categories/{id}', 'CategoryController@destroy');

//Messages
Route::get('/api/messages', 'MessageController@index');
Route::get('/api/messages/{id}', 'MessageController@show');
Route::post('/api/messages/{id}', 'MessageController@answer');