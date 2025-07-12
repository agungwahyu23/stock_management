<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MutationController;
use App\Http\Controllers\ProductLocationController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');

Route::controller(AuthController::class)->group(function() {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    
});

Route::middleware('auth:api')->group( function () {
    Route::get('/tes', [AuthController::class, 'tes']);

    Route::apiResources([
        'users' => UserController::class,
        'products' => ProductController::class,
        'locations' => LocationController::class,
        'categories' => CategoryController::class,
        'mutations' => MutationController::class,
    ]);

    Route::post('/product-location', [ProductLocationController::class, 'store']);
    Route::get('/products/{id}/mutations', [MutationController::class, 'productHistory']);
    Route::get('/users/{id}/mutations', [MutationController::class, 'userHistory']);

    Route::post('/logout', [AuthController::class, 'logout']);
});