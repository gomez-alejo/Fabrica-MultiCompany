<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;

Route::get('/branches', [BranchController::class, 'index']);
Route::get('/branches/{branch}', [BranchController::class, 'show']);
Route::post('/branches', [BranchController::class, 'store']);
Route::put('/branches/{branch}', [BranchController::class, 'update']);
Route::delete('/branches/{branch}', [BranchController::class, 'destroy']);
