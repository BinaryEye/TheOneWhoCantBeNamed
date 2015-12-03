<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/','UserController@timeline');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::resource('users', 'UserController');
Route::resource('posts', 'PostController');
Route::resource('tags','TagController');

Route::get('tags/subscribe/{tags}',['as' => 'subscribe','uses' => 'TagController@subscribe']);
Route::get('tags/unsubscribe/{tags}',['as' => 'unsubscribe','uses' => 'TagController@unsubscribe']);
Route::get("posts/upvote/{posts}", ['as' => 'upVote', 'uses' => 'PostController@upVote']);
Route::get("posts/downvote/{posts}", ['as' => 'downVote', 'uses' => 'PostController@downVote']);
Route::get('/timeline', 'UserController@timeLine');
Route::get('/{posts}/comments', 'PostController@getComments');
Route::post('/admin', 'UserController@makeAdmin');