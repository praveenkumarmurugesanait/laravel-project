<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BookController;

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('user', [AuthController::class, 'user'])->middleware('auth:api');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

// Protected CRUD routes
Route::group(['middleware' => ['auth:api']], function () {
    Route::apiResource('products', ProductController::class);
});

Route::apiResource('books', BookController::class);