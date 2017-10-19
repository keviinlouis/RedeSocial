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
        Route::delete('/post/{id}', 'PostsController@destroy')->name('deleteApiPost');

        //Adicionais
        Route::post('/post/{id}/like', 'PostsController@like')->name('likeApiPost');
        Route::post('/post/{id}/repost', 'PostsController@repost')->name('repostApiPost'); //TODO
        Route::get('/post/{id}/comments', 'PostsController@comments')->name('listCommentsApiPost');


        //Comentarios
        Route::get('/comments', 'CommentsController@index')->name('listApiComments');
        Route::get('/comment/{id}', 'CommentsController@show')->name('showCommentsApiPost');
        Route::post('/post/{id}/comment', 'CommentsController@storage')->name('createCommentApiPost');
        Route::put('/comment/{comment}', 'CommentsController@update')->name('updateCommentApiPost');
        Route::delete('/comment/{comment}', 'CommentsController@destroy')->name('deleteCommentApiPost');

    //Users

        //CRUD
        Route::get('/user/{id}', 'UsersController@show')->name('showApiUser');
        Route::post('/user', 'UsersController@storage')->name('createApiUser');
        Route::put('/user/{id}', 'UsersController@update')->name('updateApiUser');
        Route::delete('/user', 'UsersController@destroy')->name('deleteApiUser');

        //Adicionais
        Route::post('/user/{id}/follow', 'UsersController@follow')->name('followApiUser');
        Route::post('/users/suggested/{limit?}', 'UsersController@suggested')->name('suggestedApiUsers');
        Route::get('/user/{id}/following', 'UsersController@following')->name('followingApiUsers');

});
