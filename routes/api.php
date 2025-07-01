<?php

use App\Http\Controllers\InvoiceProductController;
use App\Http\Controllers\ProductRequestController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('InvoicesProducts')->group(function(){
    Route::get('/', [ProductRequestController::class, 'index']);
    Route::post('/', [ProductRequestController::class, 'store']);
    Route::get('{id}', [ProductRequestController::class, 'show']);
    Route::put('{id}', [ProductRequestController::class, 'update']);
    Route::delete('{id}', [ProductRequestController::class, 'destroy']);
});

Route::prefix('ProductRequests')->group(function(){
    Route::get('/', [ProductRequestController::class, 'index']);
    Route::post('/', [ProductRequestController::class, 'store']);
    Route::get('{id}', [ProductRequestController::class, 'show']);
    Route::put('{id}', [ProductRequestController::class, 'update']);
    Route::delete('{id}', [ProductRequestController::class, 'destroy']);
});


