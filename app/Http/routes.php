<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/createuser/{name}/{email}/{password}', 'UserController@createUser');
    Route::get('/login/{email}/{password}', 'UserController@login');
    Route::get('/creategroup/{userid}/{groupName}', 'UserController@createGroup');
    Route::get('/listgroup/{userid}', 'UserController@listGroup');
    Route::get('/createcontact/{groupid}/{name}/{number}', 'UserController@createContact');
    Route::get('/listcontact/{groupid}', 'UserController@listContact');
});
