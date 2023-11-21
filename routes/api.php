<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\Sub_categoryController;

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



Route::post('register', [AuthController::class,'register']);
Route::post('login', [AuthController::class,'login']);
Route::get('user_list',[AuthController::class,'user_list']);
Route::apiResource('category', CategoryController::class);
Route::apiResource('sub_category', Sub_categoryController::class);
Route::apiResource('event', EventController::class);
Route::apiResource('product', ProductController::class);
Route::get('search/product/{string}',[ProductController::class,'search']);
Route::post('checkout',[CheckoutController::class,'checkout']);
Route::get('ordercheck/{id}/{type}',[OrderController::class,'order_check']);
Route::get('orderlist',[OrderController::class,'order_list']);