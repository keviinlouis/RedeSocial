<?php

use Illuminate\Support\Facades\Route;
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
Route::post('/auth/login', 'AuthController@authenticate');

Route::group(['middleware' => 'jwt.auth'], function (){
    Route::get('/posts/{start?}/{limit?}', 'PostsController@index')->name('getApiPosts');

    Route::get('/post/{id}', 'PostsController@view')->name('getApiPost');
    Route::post('/posts', 'PostsController@storage')->name('createApiPost');
    Route::put('/post/{id}', 'PostsController@update')->name('updateApiPost');
    Route::delete('/posts', 'PostsController@destroy')->name('deleteApiPost');

    Route::post('/sugestedUsers', 'UsersController@sugestedUsers')->name('sugestedUsers');
    Route::post('/follow', 'UsersController@follow')->name('followUser');
});
