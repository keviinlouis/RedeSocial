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

    //Posts
        Route::get('/posts/{start?}/{limit?}', 'PostsController@index')->name('listApiPosts');

        //CRUD
        Route::get('/post/{id}', 'PostsController@show')->name('showApiPost');
        Route::post('/post', 'PostsController@storage')->name('createApiPost');
        Route::put('/post/{id}', 'PostsController@update')->name('updateApiPost');
        Route::delete('/post', 'PostsController@destroy')->name('deleteApiPost');

        //Adicionais
        Route::post('/post/{id}/like', 'PostsController@like')->name('likeApiPost');
        Route::post('/post/{id}/repost', 'PostsController@repost')->name('repostApiPost'); //TODO
        Route::post('/post/{id}/comment', 'PostsController@comment')->name('commentApiPost'); //TODO

    //Users

        //CRUD
        Route::get('/user/{id}', 'UsersController@show')->name('showApiUser');
        Route::post('/user', 'UsersController@storage')->name('createApiUser');
        Route::put('/user/{id}', 'UsersController@update')->name('updateApiUser');
        Route::delete('/user', 'UsersController@destroy')->name('deleteApiUser');

        //Adicionais
        Route::post('/user/{id}/follow', 'UsersController@follow')->name('followApiUser');
        Route::post('/users/suggested', 'UsersController@suggestedUsers')->name('suggestedApiUsers');
});
