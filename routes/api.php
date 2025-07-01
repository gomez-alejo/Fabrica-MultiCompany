<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('invoice')->group(function () {
    Route::get('/', [InvoiceController::class, 'index']);           //GET /v1/invoice?with=company,branch,person,
    Route::post('/', [InvoiceController::class, 'store']);          // POST /v1/invoice
    Route::get('/{id}', [InvoiceController::class, 'show']);     // GET /v1/invoice/{id}
    Route::put('/{id}', [InvoiceController::class, 'update']);   // PUT /v1/invoice/{id}
    Route::delete('/{id}', [InvoiceController::class, 'destroy']);  // DELETE /v1/invoice/{id}
});

