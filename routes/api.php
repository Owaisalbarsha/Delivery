<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\Illuminate\Support\Facades\Response;
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
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);

// authorization changes when : Admin, Driver, User
Route::group(['middleware' => ['auth:sanctum']], function () {  // token based auth using api tokens

    Route::get('/image', [AuthController::class, 'getUserProfilePicture']); // test
    Route::get('/logout',[AuthController::class,'logout']);
    Route::get('/me', [AuthController::class, 'me']); // test
    Route::post('personal_information', [AuthController::class, 'personal_information']); // edit to put

    //Products:
    /*Route::get('/product/index', [ProductController::class, 'index']);
    Route::post('/product/store', [ProductController::class, 'store']);
    Route::get('/product/show/{id}', [ProductController::class, 'show']);
    Route::put('/product/update', [ProductController::class, 'update']);
    Route::delete('/product/delete', [ProductController::class, 'destroy']);*/
    Route::resource('products', ProductController::class);
    Route::get('products/search/{name}', [ProductController::class, 'search']);
    //Store:
    /*Route::get('/store/index', [ProductController::class, 'index']);
    Route::post('/store/store', [ProductController::class, 'store']);
    Route::get('/store/show/{id}', [ProductController::class, 'show']);
    Route::put('/store/update', [ProductController::class, 'update']);
    Route::delete('/store/delete', [ProductController::class, 'destroy']);*/
    Route::resource('stores', StoreController::class);
    Route::get('stores/storeproducts/{id}', [StoreController::class, 'storeProducts']);
    Route::get('stores/search/{name}', [StoreController::class, 'search']);

    // Cart:
    Route::resource('carts', CartController::class);
    Route::resource('orders', OrderController::class);
});

// test
Route::post('/send-verification-code', [AuthController::class, 'sendVerificationCode']);
Route::post('/verify-code', [AuthController::class, 'verifyCode']);

// adding products to stores
Route::get('/testrole',[TestController::class, 'testrole'])->middleware('role:admin');//test role
