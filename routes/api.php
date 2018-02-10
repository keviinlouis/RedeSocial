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
Route::group(['middleware' => ['api']], function (){
    Route::post('/auth/login', 'AuthController@login');
    Route::post('/auth/register', 'AuthController@register');
});


Route::group(['middleware' => ['jwt', 'api']], function (){
    Route::get('/auth/user', 'AuthController@view');
    Route::delete('/auth/delete', 'AuthController@destroy');

    //Posts
            Route::get('/posts/{start?}/{limit?}', 'PostsController@index')->name('listApiPosts');

        //CRUD
        Route::get('/post/{id}', 'PostsController@show')->name('showApiPost');
        Route::post('/post', 'PostsController@storage')->name('createApiPost');
        Route::put('/post/{id}', 'PostsController@update')->name('updateApiPost');
        Route::delete('/post/{id}', 'PostsController@destroy')->name('deleteApiPost');

        //Adicionais
        Route::post('/post/{id}/like', 'PostsController@like')->name('likeApiPost');
        Route::post('/post/{id}/repost', 'PostsController@repost')->name('repostApiPost');
        Route::get('/post/{id}/comments', 'PostsController@comments')->name('listCommentsApiPost');

        //Comentarios
        Route::get('/comments', 'CommentsController@index')->name('listApiComments');
        Route::get('/comment/{id}', 'CommentsController@show')->name('showCommentsApiPost');
        Route::post('/post/{id}/comment', 'CommentsController@storage')->name('createCommentApiPost');
        Route::put('/comment/{comment}', 'CommentsController@update')->name('updateCommentApiPost');
        Route::delete('/comment/{comment}', 'CommentsController@destroy')->name('deleteCommentApiPost');

    //Users
        Route::get('/users/{start?}/{limit?}', 'UsersController@index')->name('listApiUsers');

        //CRUD
        Route::get('/user/{id}', 'UsersController@show')->name('showApiUser');
        Route::post('/user', 'UsersController@storage')->name('createApiUser');
        Route::put('/user/{id}', 'UsersController@update')->name('updateApiUser');
        Route::delete('/user', 'UsersController@destroy')->name('deleteApiUser');

        //Adicionais
        Route::post('/user/{id}/follow', 'UsersController@follow')->name('followApiUser');
        Route::post('/user/suggested/{limit?}', 'UsersController@suggested')->name('suggestedApiUsers');
        Route::get('/user/messages/new', 'UsersController@newMessages')->name('showNewApiMessage');
        Route::get('/user/messages/{id}', 'UsersController@channel')->name('showNewApiMessage');

    //Messages
        Route::post('/message', 'MessagesController@storage')->name('createApiMessage');
        Route::post('/message/{id}', 'MessagesController@opened')->name('openedApiMessage');
        Route::put('/message/{id}', 'MessagesController@update')->name('updateApiMessage');
        Route::delete('/message/{id}', 'MessagesController@destroy')->name('deleteApiMessage');
        Route::get('/message/{id}', 'MessagesController@show')->name('showApiMessage');

});
