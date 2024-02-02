<?php

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
Route::get('/healthcheck', function () {
    return response()->json(['status' => true], 200);
}
);


Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::resource('categories', CategoryController::class)->only(['index', 'show']);
Route::resource('sizes', SizeController::class);
Route::resource('color', ColorController::class);
