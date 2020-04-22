<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users/get', 'Api\UsersController@index');
Route::delete('/users/{user}', 'Api\UsersController@destroy');
Route::post('/users/delWithBooks', 'Api\UsersController@destroyWithBooks');
Route::post('/users/delOnlyUser', 'Api\UsersController@destroyOnlyUser');

Route::get('/genres/get', 'Api\GenresController@index');
Route::delete('/genres/{genre}', 'Api\GenresController@destroy');
Route::post('/genres/delWithBooks', 'Api\GenresController@destroyWithBooks');
Route::post('/genres/delOnlyGenre', 'Api\GenresController@destroyOnlyGenre');

Route::get('/books/get', 'Api\BooksController@index');
Route::delete('/books/{book}', 'Api\BooksController@destroy');
