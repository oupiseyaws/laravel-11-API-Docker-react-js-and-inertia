<?php

use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;


Route::group(['prefix' => '/projects', 'as' => 'projects.'], function () {
    Route::get('/', [ProjectController::class, 'index'])->name('index');
});

Route::group(['prefix' => '/tasks', 'as' => 'tasks.'], function () {
    Route::get('/', [TaskController::class, 'index'])->name('index');
});
