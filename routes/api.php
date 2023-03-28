<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'auth:sanctum'], function() {
    Route::get('/tasks', App\Http\Controllers\Task\IndexController::class);
    Route::post('/tasks', App\Http\Controllers\Task\StoreController::class);
    Route::delete('/tasks/{task}', App\Http\Controllers\Task\DestroyController::class);
    Route::patch('/tasks/{task}', App\Http\Controllers\Task\UpdateController::class);
    Route::post('/tasks/{task}/done', App\Http\Controllers\Task\MarkDoneController::class);
});
