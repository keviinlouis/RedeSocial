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

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/getPosts/{last?}/{direction?}', 'PostsController@getPosts')->name('getPosts');
Route::post('/getUsersToFollow', 'HomeController@usersToFollow')->name('getUsersToFollow');
Route::post('/sendPost', 'PostsController@create')->name('sendPosts');
Route::post('/follow', 'UsersController@follow')->name('followUser');
