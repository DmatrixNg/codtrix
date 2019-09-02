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
    return view('welcome');
});
Route::get('/pay', function () {
    return view('pay');
});

Auth::routes();

Route::get('/home', 'PostController@index')->name('home');
Route::get('/upload', 'UploadfileController@index');
Route::post('/upload', 'UploadfileController@upload');
Route::get('/notification?{id}', 'UploadfileController@pay');
Route::get('/post/{postTitle}','pageController@singlePostPage');
Route::get('/post/{postTitle}','PostController@publicpost')->name('post');


Route::prefix('{username}')->group(function () {
  Route::get('/', function () {
      return view('welcome');
  });
  Route::post('/publish', 'PostController@publish');
    Route::get('/post/{postTitle}','PostController@singlePostPage')->name('post');
  Route::get('/tutorials', 'PostController@posts');
  Route::get('/activate/{id}', 'PostController@activate');
  Route::get('/deactivate/{id}', 'PostController@deactivate');
  Route::get('/users', function () {
      return view('user');
  });
});
