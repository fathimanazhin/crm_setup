<?php

use Illuminate\Http\Request;
use App\Http\Controllers\API\PostController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/
Route::post('/login', [AuthenticatedSessionController::class, 'login']);
// Optional: test route (keep if you want)
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protect ALL post routes with Sanctum
Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('posts', PostController::class);
});
Route::post('/login', [AuthenticatedSessionController::class, 'login']);