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
    ->namespace('AdminPanel')
    ->prefix('adminpanel')
    ->group(function () {
        Route::prefix('users')
            ->name('users.')
            ->group(function () {
                Route::resource('/', 'UserController');
            });

        Route::prefix('genres')
            ->name('genres.')
            ->group(function () {
                Route::resource('/', 'GenreController');
            });

        Route::prefix('books')
            ->name('books.')
            ->group(function () {
                Route::resource('/', 'BookController');
            });
    });

Route::name('userpanel.')
    ->namespace('UserPanel')
    ->prefix('userpanel')
    ->group(function () {
        Route::prefix('books')
            ->name('books.')
            ->group(function () {
                Route::resource('/', 'BookController');
            });
    });
