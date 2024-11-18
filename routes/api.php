<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\RewardController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\CustomerAuthMiddleware;
use App\Http\Middleware\IsLoginMiddleware;
use App\Http\Middleware\MerchantAuthMiddleware;
use GuzzleHttp\Promise\Is;
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

Route::prefix('v1')->group(function () {
    Route::post('/login', [UserController::class, 'login']);
    Route::post('/register',[UserController::class, 'register']);
    
    Route::prefix('products')->group(function () {
        Route::get('/',[ProductController::class, 'get'])->middleware(IsLoginMiddleware::class);
        Route::get('/{id}',[ProductController::class, 'get_by_id'])->middleware(IsLoginMiddleware::class);
        Route::post('/',[ProductController::class, 'create'])->middleware(MerchantAuthMiddleware::class);
        Route::put('/{id}',[ProductController::class, 'update'])->middleware(MerchantAuthMiddleware::class);
        Route::delete('/{id}',[ProductController::class, 'delete'])->middleware(MerchantAuthMiddleware::class);
    });

    Route::prefix('rewards')->group(function () {
        Route::get('/',[RewardController::class, 'get'])->middleware(CustomerAuthMiddleware::class);
        Route::post('/',[RewardController::class, 'redempt_reward'])->middleware(CustomerAuthMiddleware::class);
    });

    Route::prefix('transactions')->group(function () {
        Route::get('/',[TransactionController::class, 'get'])->middleware(IsLoginMiddleware::class);
        Route::post('/',[TransactionController::class, 'create'])->middleware(CustomerAuthMiddleware::class);
    });
});

// Route::middleware('auth:sanctum')->group(function () {
//     Route::get('/products');
//     Route::get('/products/{id}');
//     Route::post('/products');
//     Route::put('/products/{id}');
//     Route::delete('/products/{id}');
//     Route::post('/logout');
// });