<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TransactionController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => '/tasks', 'as' => 'tasks.'], function () {
    Route::get('/', [TaskController::class, 'list']);
    Route::get('/{id}', [TaskController::class, 'get'])
        ->where('id', '[1-9][0-9]*');
    Route::post('/', [TaskController::class, 'store']);
    Route::put('/{id}', [TaskController::class, 'update'])
        ->where('id', '[1-9][0-9]*');
    Route::delete('/{id}', [TaskController::class, 'delete'])
        ->where('id', '[1-9][0-9]*');
    Route::put('/', [TaskController::class, 'reorder']);
});

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
