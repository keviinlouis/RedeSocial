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
        Route::get('/posts/{start?}/{limit?}', 'PostsController@index')->name('getApiPosts');

        //CRUD
        Route::get('/post/{id}', 'PostsController@view')->name('getApiPost');
        Route::post('/posts', 'PostsController@storage')->name('createApiPost');
        Route::put('/post/{id}', 'PostsController@update')->name('updateApiPost');
        Route::delete('/posts', 'PostsController@destroy')->name('deleteApiPost');

        //Adicionais
        Route::post('/post/{id}/like', 'PostsController@like')->name('likeApiPost');
        Route::post('/post/{id}/repost', 'PostsController@repost')->name('repostApiPost'); //TODO
        Route::post('/post/{id}/comment', 'PostsController@comment')->name('commentApiPost'); //TODO

    Route::post('/suggestedUsers', 'UsersController@suggestedUsers')->name('suggestedUsers');
    Route::post('/follow', 'UsersController@follow')->name('followUser');
});
