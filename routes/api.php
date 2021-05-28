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

Route::get('/author', [\App\Http\Controllers\AuthorsController::class, 'index']);
Route::get('/books/{name}', [\App\Http\Controllers\BookController::class, 'index']);
Route::post('/save-book', [\App\Http\Controllers\BookController::class, 'store']);
Route::post('/user-books', [\App\Http\Controllers\UserBooksController::class, 'store']);
Route::get('/user-books', [\App\Http\Controllers\UserBooksController::class, 'userBooks']);
