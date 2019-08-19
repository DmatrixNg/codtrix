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

Route::get('/tutorial', function () {
    return view('tutorial');
});
Route::prefix('admin')->group(function () {
  Route::get('/', function () {
      return view('welcome');
  });

  Route::post('/publish', 'PostController@add');
  Route::get('/tutorials', 'PostController@index');
});
