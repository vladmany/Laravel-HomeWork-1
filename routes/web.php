<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Route::get('/', 'UserController@index');
//Route::get('/users', 'UserController@showUsers');
//Route::get('/users/{id}', 'UserController@showUserInfo');
//Route::get('/about', 'UserController@about');
//Route::get('/set-users', 'UsersController@set');

Route::get('/', 'Library@index');
