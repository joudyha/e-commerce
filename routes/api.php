<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\homepage\CartController;
use App\Http\Controllers\homepage\CategoryController;
use App\Http\Controllers\homepage\FavoriteController;
use App\Http\Controllers\homepage\HomeController;
use App\Http\Controllers\homepage\ProductController;
use App\Http\Controllers\OrderController;
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
Route::group(['middleware'=>'api','prefix'=>'auth'],function ($router){

    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/profile',[AuthController::class,'profile']);
    Route::post('/logout',[AuthController::class,'logout']);
    Route::put('/updateProfile/{id}',[AuthController::class,'updateProfile']);

});




Route::controller(CategoryController::class)->group(function () {
    Route::get('/category/show/{id}', 'show');
    Route::post('/category/store', 'store');
    Route::get('/category/index', 'index');
    Route::get('/category/search', 'search');
    Route::put('/category/update/{id}', 'update');
    Route::delete('/category/destroy/{id}', 'destroy');

});


Route::controller(ProductController::class)->group(function () {
    Route::get('/product/show/{id}', 'show');
    Route::post('/product/store', 'store');
    Route::get('/product/index', 'index');
    Route::get('/product/search', 'search');
    Route::put('/product/update/{id}', 'update');
    Route::delete('/product/destroy/{id}', 'destroy');

});

Route::post('/product/{id}/ratings',[ ProductController::class, 'addRating']);
Route::get('/product/{id}/ratings',[ ProductController::class, 'showRatings']);
Route::delete('/ratings/{id}',[ ProductController::class, 'deleteRating']);
//favorite
Route::post('/favorite/addToFavorites',[FavoriteController::class,'addToFavorites']);
Route::get('/favorite/index',[FavoriteController::class,'index']);
Route::delete('/favorite/deleteFromFavorites',[FavoriteController::class,'deleteFromFavorites']);
Route::delete('/favorite/delete',[FavoriteController::class,'delete']);
///////cart
///
Route::post('/cart/addToCart/{product}',[CartController::class,'addToCart']);
Route::put('/cart/updateCart/{cart}',[CartController::class,'updateCart']);
Route::delete('/cart/removeCart/{cart}',[CartController::class,'removeCart']);
Route::get('/cart/showCart',[CartController::class,'showCart']);
Route::post('/cart/checkout/{cart}',[CartController::class,'checkout']);
Route::post('/cart/addOrderToCart/{user}',[CartController::class,'addOrderToCart']);
Route::post('/createCart/{user_id}',[CartController::class,'createCart']);






Route::get('/index',[HomeController::class,'index']);





