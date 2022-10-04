<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});




/**
 * User routes
 */

Route::post('register', [\App\Http\Controllers\Api\v1\ApiUserController::class, 'register']); // User registration
Route::post('login', [\App\Http\Controllers\Api\v1\ApiUserController::class, 'login']); // User login

/**
 * Order routes
 */

Route::post('orders', [\App\Http\Controllers\Api\v1\ApiOrderController::class, 'store']); // Add order
Route::get('orders', [\App\Http\Controllers\Api\v1\ApiOrderController::class, 'index']); // Get all orders
Route::get('orders/{id}', [\App\Http\Controllers\Api\v1\ApiOrderController::class, 'show']); // Get all orders

/**
 * Delivery cost calculation route
 */

Route::post('delivery-cost', [\App\Http\Controllers\Api\v1\ApiDeliveryController::class, 'calculateDeliveryCost']);
