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

Route::get('/', [App\Http\Controllers\BookController::class, 'index'])->name('book');
Route::get('single-book/{id}', [App\Http\Controllers\BookController::class, 'singleBook'])->name('single-book');


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/add-review', [App\Http\Controllers\HomeController::class, 'addReview'])->name('add-review');
