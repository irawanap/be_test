<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    // Get authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    // Product resource routes
    Route::apiResource('products', ProductController::class);

});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
});

Route::controller(LoginController::class)->group(function(){
    Route::post('login', 'login');
});
