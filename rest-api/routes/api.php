<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// product
use App\Http\Controllers\ProductController;

Route::get('/products/list', [ProductController::class, 'index']);
Route::get('/products/detail/{id}', [ProductController::class, 'show']);
Route::post('/products/edit/{id}', [ProductController::class, 'edit']);
Route::delete('/products/delete/{id}', [ProductController::class, 'delete']);
Route::post('/products/add', [ProductController::class, 'store']);
Route::get('/images/{filename}', [ProductController::class, 'image']);

// users
use App\Http\Controllers\AuthController;

Route::post('/auth/regis', [AuthController::class, 'register']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/logout', [AuthController::class, 'logout']);

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
