<?php

use App\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
    Route::post('/', [ProductController::class, 'create']);
    Route::get('/', [ProductController::class, 'get']);
    Route::get('/{id}', [ProductController::class, 'getById']);
    Route::delete('/{id}', [ProductController::class, 'delete']);
    Route::patch('/{id}', [ProductController::class, 'edit']);
});
