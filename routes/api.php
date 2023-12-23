<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\UserController;
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

Route::post ('/login' ,[AuthController::class , 'login']); 
//create new user 
Route::post('user/', [UserController::class, 'store']);

Route::middleware(['auth:sanctum'])->group(function () {

    Route::prefix('/user')->group(function () {
        Route::get('', [UserController::class, 'index'])->middleware('auth:sanctum');
        Route::get('/{id}', [UserController::class, 'show']);
        Route::post('/update/{id}', [UserController::class, 'update']);
        Route::delete('/{id}', [UserController::class, 'destroy']);
    });
    Route::prefix('/category')->group(function () {
        Route::get('', [CategoryController::class, 'index']);
        Route::get('/{id}', [CategoryController::class, 'show']);
        Route::post('', [CategoryController::class, 'store']);
        Route::post('/update/{id}', [CategoryController::class, 'update']);
        Route::delete('/{id}', [CategoryController::class, 'destroy']);
    });
    Route::prefix('/product')->group(function () {
        Route::get('', [ProductController::class, 'index']);
        Route::get('/{id}', [ProductController::class, 'show']);
        Route::post('', [ProductController::class, 'store']);
        Route::post('/update/{id}', [ProductController::class, 'update']);
        Route::delete('/{id}', [ProductController::class, 'destroy']);
        //filters
        Route::get('/filter-by/category/{category_id}', [ProductController::class, 'filterByCategory']);
        Route::get('/filter-by/max-price/{max_price}', [ProductController::class, 'filterByMaxPrice']);
        //filter : by [price > < range , category ] 
    });
});