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

    // /resources/views/welcome.blade.php
    return        view('welcome');
});

// if the user comes to /hello with GET request method,
// handle the request by the index method
// of the App\Http\Controllers\IndexController class
Route::get('/hello', ['App\Http\Controllers\IndexController', 'index']);
Route::get('/top20movies', ['App\Http\Controllers\IndexController', 'top20movies']);
Route::get('/actors/popular/now', ['App\Http\Controllers\ActorController', 'popular']);