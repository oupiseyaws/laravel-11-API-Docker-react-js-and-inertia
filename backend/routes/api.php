<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('categories', CategoryController::class);
    Route::apiResource('transactions', TransactionController::class);
    Route::apiResource('users', UserController::class);
});

// login
Route::post('/auth/login', [App\Http\Controllers\Api\AuthController::class, 'login']);
Route::post('/auth/register', [App\Http\Controllers\Api\AuthController::class, 'register']);
Route::post('/auth/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);

Route::apiResource('posts', PostController::class);
