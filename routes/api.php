<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BranchController;

Route::get('/branches', [BranchController::class, 'index']);
Route::get('/branches/{branch}', [BranchController::class, 'show']);
