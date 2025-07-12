<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::controller(AuthController::class)->group(function() {
    // Route::get('/tes', 'tes');
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    
});

Route::middleware('auth:api')->group( function () {
    Route::get('/tes', [AuthController::class, 'tes']);

     Route::apiResources([
        'users' => UserController::class,
        'products' => ProductController::class,
        'locations' => LocationController::class,
        // 'mutations' => MutationController::class,
    ]);
    Route::post('/logout', [AuthController::class, 'logout']);
});