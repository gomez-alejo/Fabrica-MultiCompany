<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\UserController;



Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'create'])->name('users.create');
    Route::post('/store', [UserController::class, 'store'])->name('users.store');
});