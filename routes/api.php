<?php

use App\Http\Controllers\InvoiceProductController;
use App\Http\Controllers\ProductRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('invoiceProducts')->group(function(){
    Route::get('/', [InvoiceProductController::class, 'index']);
    Route::post('/', [InvoiceProductController::class, 'store']);
    Route::get('{id}', [InvoiceProductController::class, 'show']);
    Route::put('{id}', [InvoiceProductController::class, 'update']);
    Route::delete('{id}', [InvoiceProductController::class, 'destroy']);
});

Route::prefix('productRequests')->group(function(){
    Route::get('/', [ProductRequestController::class, 'index']);
    Route::post('/', [ProductRequestController::class, 'store']);
    Route::get('{id}', [ProductRequestController::class, 'show']);
    Route::put('{id}', [ProductRequestController::class, 'update']);
    Route::delete('{id}', [ProductRequestController::class, 'destroy']);
});


