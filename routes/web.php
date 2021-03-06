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
    $name = ['Phong', 'Thanh'];
    return view('welcome', compact('name'));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Thread
Route::get('threads', 'ThreadController@index');
Route::get('threads/create', 'ThreadController@create');
Route::get('threads/{channel}', 'ThreadController@index');
Route::get('threads/{channel}/{thread}', 'ThreadController@show');
Route::delete('threads/{channel}/{thread}', 'ThreadController@destroy');
Route::post('threads', 'ThreadController@store');

Route::get('profiles/{user}', 'ProfileController@show')->name('profile');

// Reply
Route::post('threads/{channel}/{thread}/replies', 'ReplyController@store');
Route::delete('replies/{reply}', 'ReplyController@destroy');
Route::patch('replies/{reply}', 'ReplyController@update');

// Favorites
Route::post('replies/{reply}/favorites', 'FavoritesController@store');

