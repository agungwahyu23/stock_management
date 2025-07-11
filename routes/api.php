<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('/logout', [AuthController::class, 'logout']);
});