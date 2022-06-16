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

// Route::get('/', function () {

//     // /resources/views/welcome.blade.php
//     return        view('welcome');
// });

Route::view('/', 'welcome');

// if the user comes to /hello with GET request method,
// handle the request by the index method
// of the App\Http\Controllers\IndexController class
// Route::get('/hello', ['App\Http\Controllers\IndexController', 'index']);

Route::redirect('/hello', '/');
Route::get('/top20movies', ['App\Http\Controllers\IndexController', 'top20movies']);
Route::get('/actors/popular/now', ['App\Http\Controllers\ActorController', 'popular']);


Route::get('/top-rated-movies', ['App\Http\Controllers\MovieController', 'topRated']);
Route::get('/top-rated-games', ['App\Http\Controllers\VideogameController', 'topRated']);
Route::get('/movies/shawshank-redemption', ['App\Http\Controllers\MovieController', 'shawshank'])->name('hi, this is my route');
Route::get('/search', ['App\Http\Controllers\MovieController', 'search'])->name('search');

Route::get('/people/detail/{person_id}', ['App\Http\Controllers\ActorController', 'detail']);
Route::get('/movies/genre/{genre_slug}', ['App\Http\Controllers\MovieController', 'moviesOfGenre']);

Route::get('/movies/detail/{movie_id}', ['App\Http\Controllers\MovieController', 'detail'])->whereNumber('movie_id')->name('movie.detail');
Route::get('/movies/create', ['App\Http\Controllers\MovieController', 'create']);
Route::get('/movies/{movieId}/edit', ['App\Http\Controllers\MovieController', 'edit'])->name('movie.edit');
Route::post('/movies', ['App\Http\Controllers\MovieController', 'store']);
Route::put('/movies/{movieId}', ['App\Http\Controllers\MovieController', 'update'])->name('movie.update');

Route::get('/movies/{sorting?}', ['App\Http\Controllers\MovieController', 'index'])->whereIn('sorting', ['rating', 'alpha']);

Route::get('/about-us', ['App\Http\Controllers\AboutusController', 'aboutUs'])->name('about-us');
