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

// Route::post('register', [RegisterController::class, 'register']);
// Route::post('login', [RegisterController::class, 'login']);
Route::post('register', [\App\Http\Controllers\passportAuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\passportAuthController::class, 'login']);


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware'=>['auth:api']],function(){
	Route::post('/logout', [\App\Http\Controllers\passportAuthController::class, 'logout']);
    Route::post('/save-book', [\App\Http\Controllers\BookController::class, 'store']);
	Route::post('/user-books', [\App\Http\Controllers\UserBooksController::class, 'store']);
	Route::get('/user-books', [\App\Http\Controllers\UserBooksController::class, 'userBooks']);
	Route::get('/books/{name}', [\App\Http\Controllers\BookController::class, 'index']);
});

Route::get('/author', [\App\Http\Controllers\AuthorsController::class, 'index']);

