<?php

use App\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {
    /**
     * Create product by one request
     */
    Route::post('/whole', [ProductController::class, 'createInstanceWhole']);

    /**
     * Create product by parts
     */
    Route::post('/partial', [ProductController::class, 'createInstancePartial']);

    /**
     * Create product
     */
    Route::post('/product', [ProductController::class, 'createProduct']);
    Route::post('/product/load', [ProductController::class, 'loadProductPics']);

    /**
     * Create color
     */
    Route::post('/color', [ProductController::class, 'createColor']);

    /**
     * Create size
     */
    Route::post('/color', [ProductController::class, 'createSize']);

    /**
     * get all products
     */
    Route::get('/product', [ProductController::class, 'getProducts']);

    /**
     * get all colors
     */
    Route::get('/color', [ProductController::class, 'getColors']);

    /**
     * get all sizes
     */
    Route::get('/size', [ProductController::class, 'getSizes']);



    /**
     * Get all products
     */
    Route::get('/', [ProductController::class, 'getInstances']);

    /**
     * Get product by id
     */
    Route::get('/{id}', [ProductController::class, 'getInstance']);

    /**
     * Delete product by id
     */
    Route::delete('/{id}', [ProductController::class, 'deleteInstance']);

    /**
     * ??? Incorrect
     */
    Route::put('/{id}', [ProductController::class, 'update']);
});

Route::post('/', [ProductController::class, 'test']);