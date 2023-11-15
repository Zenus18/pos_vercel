<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::get("/categories", [CategoryController::class, 'index']);
Route::get("/product", [ProductController::class, 'productQuery']);
Route::get("/products", [ProductController::class, 'index']);
Route::get("/product/{id}", [ProductController::class, 'productDetail']);
// Route::get("/scanProduct/{barcode}", [CartController::class, 'scanProduct']);
// Route::get("/cart", [CartController::class, 'cartDetail']);
// Route::get("/addcart/{barcode}", [CartController::class, 'scanProduct']);
// Route::get("/productByCategorized/{id}", [ProductController::class, 'productByCategorized']);
// Route::get("/searchProduct/{input}", [ProductController::class, 'productSearch']);
