<?php



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ProductController;
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
Route::apiResource('category', CategoryController::class);
Route::apiResource('sub_category', Sub_categoryController::class);
Route::apiResource('event', EventController::class);
Route::apiResource('product', ProductController::class);