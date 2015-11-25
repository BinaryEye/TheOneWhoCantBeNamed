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

Route::get("posts/vote/{posts}", ['as' => 'checkPostVotes', 'uses' => 'PostController@checkVotes']);

Route::get("comments/vote/{posts}", ['as' => 'checkCommentVotes', 'uses' => 'PostController@checkVotes']);