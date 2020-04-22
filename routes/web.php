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
Route::get('/books/{book}', 'LibraryController@show')->name('books.show');
Route::get('/books/{book}/read', 'LibraryController@read')->name('books.read');
Route::get('/books/{book}/download', 'LibraryController@download')->name('books.download');

Route::name('adminpanel.')
    ->namespace('adminPanel')
    ->prefix('adminpanel')
    ->middleware(['auth', 'role:2'])
    ->group(function () {
        Route::namespace('Users')
            ->group(function () {
                Route::resource('users', 'UserController');
            });


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
    ->prefix('user')
    ->middleware(['auth'])
    ->group(function () {
        Route::namespace('Books')
            ->group(function () {
                Route::resource('books', 'BookController');
            });
        Route::get('/profile', 'ProfileController@index')->name('profile');
        Route::post('/profile/upload-image', 'ProfileController@avatarUpload')->name('profile.uploadAvatar');
    });

Route::get('/password/change', 'Auth\ChangePassword@index')->name('password.change');
Route::post('/password/change', 'Auth\ChangePassword@change');

