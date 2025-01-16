<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\TestController;
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

//Route::middleware('setapplang')->prefix('{locale}')->group(function(){
Route::post('/login',[AuthController::class,'login']);
Route::post('/register',[AuthController::class,'register']);
Route::get('orders/pending', [OrderController::class, 'index']);
Route::post('order/shipped', [OrderController::class, 'status_update_shipped']);
Route::post('order/delivered', [OrderController::class, 'status_update_delivered']);


//});
//Route::group(['middleware' => ['auth:sanctum'/*, 'role:admin'*/]], function () {  // setapplang middleware

    Route::get('/web/stores', [StoreController::class, 'index']); // web
    Route::get('/web/products', [StoreController::class, 'index']); // web
    Route::post('/web/product', [ProductController::class, 'store']);
    Route::post('/web/store', [StoreController::class, 'store']);
//});

// authorization changes when : Admin, Driver, User token based auth using api
Route::group(['middleware' => ['auth:sanctum'/*, 'role:admin'*/]], function () {  // setapplang middleware
    Route::get('/testrole',[TestController::class, 'test']);//test role

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
    /*Route::post('/store/store', [ProductController::class, 'store']);
    Route::get('/store/show/{id}', [ProductController::class, 'show']);
    Route::put('/store/update', [ProductController::class, 'update']);
    Route::delete('/store/delete', [ProductController::class, 'destroy']);*/
    //Route::resource('stores', StoreController::class);
    Route::resource('stores', StoreController::class);
    Route::post('stores/storeproducts', [StoreController::class, 'storeProducts']);
    Route::get('stores/search/{name}', [StoreController::class, 'search']);

    // Cart:
    Route::delete('/cart', [CartController::class, 'destroy']);
    Route::post('/cart/increase', [CartController::class, 'increase']);
    Route::post('/cart/decrease', [CartController::class, 'decrease']);
    Route::resource('carts', CartController::class);

    //favorite:
    Route::get('/favorites', [FavoriteController::class, 'getProductFavorite']);
    Route::post('/favorites/store', [FavoriteController::class, 'addProductFavorite']);
    Route::delete('/favorite/delete', [FavoriteController::class, 'deleteProductFavorite']);

    // Order
    Route::post('order/create', [OrderController::class, 'create']);
    Route::get('orders', [OrderController::class, 'index1']);
    Route::post('order/delete', [OrderController::class, 'delete']);
    Route::post('order/item/increase',  [OrderController::class, 'increase']);
    Route::post('order/item/decrease',  [OrderController::class, 'decrease']);
    Route::post('order/item/delete', [OrderController::class, 'remove_product']);
    Route::post('order/details', [OrderController::class, 'details']);
});


// test
Route::post('/send-verification-code', [AuthController::class, 'sendVerificationCode']);
Route::post('/verify-code', [AuthController::class, 'verifyCode']);

// adding products to stores

Route::get('/testrole',[TestController::class, 'testrole'])->middleware('role:admin');//test role

Route::post('addToFavorite',[FavoriteController::class,'addProductFavorite']);
Route::get('getProductsFavorite',[FavoriteController::class,'getProductFavorite']);
Route::post('orderFromFavorite',[FavoriteController::class,'store']);

Route::get('sendEmail',[ProductController::class,'send']);

Route::get('testNotification',[TestController::class,'test'])->middleware('auth:sanctum');//test notification

Route::get('changeStatusOfOrder',[OrderController::class, 'update'])->middleware('role:user');
Route::get('changeStatusOfOrder',[OrderController::class, 'update'])->middleware('role:driver');
Route::get('showOrderForDriver',[OrderController::class, 'show'])->middleware('role:driver');
