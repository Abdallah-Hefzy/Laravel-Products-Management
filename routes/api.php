<?php

use App\Http\Controllers\Apis\Auth\EmailVerificationController;
use App\Http\Controllers\Apis\Auth\LoginController;
use App\Http\Controllers\Apis\Auth\RegisterController;
use App\Http\Controllers\Apis\Products\ProductsController;
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

Route::group(['prefix' => 'users'], function () {

    Route::post('register', RegisterController::class);
    Route::post('login', [LoginController::class, 'login']);
    Route::post('send-code', [EmailVerificationController::class, 'sendCode']);
    Route::post('check-code', [EmailVerificationController::class, 'checkCode']);

    Route::group(['middleware' => 'auth:sanctum'], function () {

        Route::post('logout', [LoginController::class, 'logout']);
        Route::post('logout-all-devices', [LoginController::class, 'logoutAllDevice']);
    });
});



Route::group(['prefix' => 'dashboard', 'middleware' => ['auth:sanctum', 'verified']], function () {

    Route::get('products/create', [ProductsController::class, 'create']);
    Route::get('products/{slug}/edit', [ProductsController::class, 'edit']);
    Route::get('products/trash', [ProductsController::class, 'trash']);
    Route::put('products/{slug}/restore', [ProductsController::class, 'restore']);
    Route::delete('products/{slug}/force-delete', [ProductsController::class, 'forceDelete']);
   
    Route::apiResource('products', ProductsController::class);
});
    