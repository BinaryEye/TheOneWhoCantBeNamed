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

Route::get('/', function () {
    return view('welcome');
});

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController'
]);

Route::resource('users', 'UserController');

Route::resource('posts', 'PostController');
Route::get("posts/upvote/{posts}", ['as' => 'upvote', 'uses' => 'PostController@upVote']);
Route::get("posts/downvote/{posts}", ['as' => 'downvote', 'uses' => 'PostController@downVote']);