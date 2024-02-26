<?php

use App\Http\Controllers\V1\API\Auth\LoginRegisterController;
use App\Http\Controllers\V1\API\CategoryController;
use App\Http\Controllers\V1\API\ColorController;
use App\Http\Controllers\V1\API\ProductController;
use App\Http\Controllers\V1\API\SizeController;
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


Route::controller(LoginRegisterController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login')->name('login');
});

// authorized routes
Route::middleware("auth:sanctum")->group(function () {
    Route::post('/logout', [LoginRegisterController::class, 'logout']);

    // order routes
    Route::resource('/order', OrderController::class)->only(['index', 'show']);

    //get cart items
    Route::get('/cart', [CartController::class, 'cartItems']);

    // add product to cart
    Route::put('/cart', [CartController::class, 'addCartProduct']);

    // remove product from cart
    Route::delete('/cart', [CartController::class, 'removeCartProduct']);

    // create order
    Route::post('/cart/create-order', [CartController::class, 'changeOrderStateToPending']);
});

// public routes
Route::resource('products', ProductController::class)
    ->only(['index', 'show']);


Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('sizes', SizeController::class)->only(['index', 'show']);
Route::resource('colors', ColorController::class)->only(['index', 'show']);
