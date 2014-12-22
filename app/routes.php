<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as' => 'homepage', 'uses' => 'CatgoryController@index'));


Route::group(array('before' => 'guest'), function(){

    Route::group(array('before' => 'csrf'), function(){

        Route::post('/login', array('as' => 'login', 'uses' => 'UserController@postLogin'));

        Route::post('/forgot', array('as' => 'forgot', 'uses' => 'UserController@postForgot'));

        Route::post('/forgot-password', array('as' => 'forgot-password', 'uses' => 'UserController@postForgotPassword'));

        Route::post('/register', array('as' => 'register', 'uses' => 'RegisterController@postRegister'));
    });

    Route::get('/login', array('as' => 'login', 'uses' => 'UserController@getLogin'));

    Route::get('/forgot', array('as' => 'forgot', 'uses' => 'UserController@getForgot'));

    Route::get('/forgot-password/{code}', array('as' => 'forgot-password', 'uses' => 'UserController@getForgotPassword'));

    Route::get('/register', array('as' => 'register', 'uses' => 'RegisterController@getRegister'));

    });

Route::group(array('before' => 'auth'), function() {

    Route::get('/logout', array('as' => 'logout', 'uses' => 'UserController@getLogout'));
});

Route::get('/activate/{code}', array('as' => 'account-activate', 'uses' => 'RegisterController@getActivate'));

Route::post('/comments', array('as' => 'comments.store','uses' => 'CommentController@store'));

Route::delete('/comments/{id}', array('as' => 'comments.destroy','uses' => 'CommentController@destroy'));

Route::get('/catgory/{id}', array('as' => 'catgory.show', 'uses' => 'CatgoryController@show'));

Route::resource('posts', 'PostsController');

Route::post('/posts/upload', array('as' => 'upload', 'uses' => 'PostsController@upload'));
