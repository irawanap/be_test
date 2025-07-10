<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\LocationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLocationController;
use App\Http\Controllers\MutationController;

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

    // Location resource routes
    Route::apiResource('locations', LocationController::class);

    // Product_location routes
    Route::get('product-location', [ProductLocationController::class, 'index']);
    Route::post('product-location', [ProductLocationController::class, 'store']);
    Route::put('product-location', [ProductLocationController::class, 'update']);

    //Mutation routes
    Route::get('mutations', [MutationController::class, 'index']);
    Route::post('mutations', [MutationController::class, 'store']);


});

Route::controller(RegisterController::class)->group(function(){
    Route::post('register', 'register');
});

Route::controller(LoginController::class)->group(function(){
    Route::post('login', 'login')->name('login');
});

