<?php

use App\Product\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')->group(function () {

    /***************************************POST*************************************/
    /**
     * Create product by one request
     */
    Route::post('/whole', [ProductController::class, 'createInstanceWhole']);

    /**
     * Create product by parts
     */
    Route::post('/', [ProductController::class, 'createInstancePartial']);

    /**
     * Create product
     */
    Route::post('/product', [ProductController::class, 'createProduct']);

    /**
     * Load product's image
     */
    Route::post('/product/upload', [ProductController::class, 'loadProductPics']);

    Route::post('/color', [ProductController::class, 'createColor']);

    Route::post('/size', [ProductController::class, 'createSize']);


    /*********************************GET***************************************/

    Route::get('/product', [ProductController::class, 'getProducts']);

    Route::get('/color', [ProductController::class, 'getColors']);

    Route::get('/size', [ProductController::class, 'getSizes']);

    Route::get('/', [ProductController::class, 'getInstances']);

    Route::get('/{id}', [ProductController::class, 'getInstance']);

    /***********************************UPDATE***********************************/

    Route::put('/{id}', [ProductController::class, 'updateInstance']);

    Route::put('/product/{id}', [ProductController::class, 'updateProduct']);

    /*************************************DELETE********************************/

    Route::delete('/{id}', [ProductController::class, 'deleteInstance']);

    Route::delete('/color/{id}', [ProductController::class, 'deleteColor']);

    Route::delete('/product/{id}', [ProductController::class, 'deleteProduct']);

    Route::delete('/size/{id}', [ProductController::class, 'deleteSize']);

});
