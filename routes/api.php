<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\UserController;
use App\Http\Controllers\Api\V1\ProductController;

Route::group(['namespace' => 'Api', 'prefix' => 'v1'], function (): void {
    Route::group(['prefix' => 'user'], function (): void {
        Route::post('register', [UserController::class, 'createUser'])->name('register');
        Route::post('login', [UserController::class, 'loginUser'])->name('login');

        Route::group(['middleware' => 'jwt.auth'], function (): void {
            Route::get('logout', [UserController::class, 'logout'])->name('logout');
        });
    });
    Route::group(['middleware' => 'jwt.auth'], function (): void {
        Route::get('products', [ProductController::class, 'index'])->name('products');
    });
});
