<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function (): void {
    Route::group(['prefix' => 'user'], function (): void {
        Route::post('register', [UserController::class, 'createUser'])->name('register');
        Route::post('login', [UserController::class, 'loginUser'])->name('login');
    });
});
