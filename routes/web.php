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

Route::get('/', function () {
    return view('welcome');
});


//сделать маршрут, который возвращает результат работы
//callback function;
Route::get('/test', function () {
    return 'Успех!';
});

//сделать маршрут, который возвращает представление;
Route::get('/hello', function () {
    return view('hello');
});

//сделать маршрут с получением get параметров;
Route::get('/hi', function () {
    $name = request('name');

    return 'Hello, ' . ($name ?? 'User');
});

//сделать маршрут с обязательными параметрами;
Route::get('/user/{name}', function ($name) {
    return 'Ваше имя - '.($name ?? 'Не указано');
});

//сделать маршрут с необязательными параметрами.
Route::get('/user/{name}/{age?}', function ($name, $age) {
    return 'Ваше имя - '.($name ?? 'Не указано') . (($age) ? ('<br>Ваш возраст - '.$age) : '');
});
