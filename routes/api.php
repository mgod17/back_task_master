<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;


Route::post('/users', [UserController::class, 'createUser']);
Route::middleware('auth:sanctum')->post('/users/configure-password', [UserController::class, 'configurePassword']);

Route::post('login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:api')->post('/reset-password', [AuthController::class, 'resetPassword']);