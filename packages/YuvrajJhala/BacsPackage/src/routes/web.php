<?php

use Illuminate\Support\Facades\Route;
use YuvrajJhala\BacsPackage\Http\Controllers\BacsController;

Route::get('/api/v1/bacs-response', [BacsController::class, 'getBacsResponse']);
