<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::post('/users', [UserController::class, 'createUser']);
Route::middleware('auth:sanctum')->post('/users/configure-password', [UserController::class, 'configurePassword']);


