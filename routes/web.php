<?php

use Illuminate\Support\Facades\Auth;
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

Auth::routes();

Route::get('/{selGenre?}', 'LibraryController@index');

Route::name('adminpanel.')
    ->namespace('adminPanel')
    ->prefix('adminpanel')
    ->middleware(['auth', 'role:2'])
    ->group(function () {
        Route::namespace('Users')
            ->group(function () {
                Route::resource('users', 'UserController');
            });

        Route::post('users/del-with-books', 'Users\UserController@destroyWithBooks')->name('users.delWithBooks');
        Route::post('users/del-only-user', 'Users\UserController@destroyOnlyUser')->name('users.delOnlyUser');

        Route::namespace('Genres')
            ->group(function () {
                Route::resource('genres', 'GenreController');
            });

        Route::namespace('Books')
            ->group(function () {
                Route::resource('books', 'BookController');
            });
    });

Route::name('userpanel.')
    ->namespace('UserPanel')
    ->group(function () {
        Route::namespace('Books')
            ->group(function () {
                Route::resource('books', 'BookController');
            });
    });

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
