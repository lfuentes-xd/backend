<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\FoodGroupController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\ShoppingController;



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

//user
Route::get('/UserIndex', [UserAuthenticationController::class, 'index']);//
Route::post('/UserLogin', [UserAuthenticationController::class, 'login']);//
Route::post('/StoreRegister', [UserAuthenticationController::class, 'store_register']);//
Route::post('/UserUpdate/{id}', [UserAuthenticationController::class, 'update']);//
Route::post('UserDestroy/{id}',[UserAuthenticationController::class, 'destroy']);//
Route::middleware('auth:api')->get('/Userauth', [UserAuthenticationController::class, 'userauth']);

//food
Route::get('/foodIndex', [FoodController::class, 'index']);//
Route::get('/food/{id}', [FoodController::class, 'show']);//

Route::post('/foodStore', [FoodController::class, 'store']);//
Route::post('/FoodUpdate/{id}', [FoodController::class, 'update']);//
Route::post('FoodDestroy/{id}',[FoodController::class, 'destroy']);//
//foodGroup
Route::get('/FoodGroupIndex', [FoodGroupController::class, 'index']);//
Route::post('/FoodGroupStore', [FoodGroupController::class, 'store']);//
Route::post('/FoodGroupUpdate/{id}', [FoodGroupController::class, 'update']);//
Route::post('/FoodGroupDestroy/{id}', [FoodGroupController::class, 'destroy']);//
//favorite
Route::get('/FavoriteIndex', [FavoriteController::class, 'index']);//
Route::post('/FavoriteStore', [FavoriteController::class, 'store']);//
Route::post('/FavoriteUpdate/{id}', [FavoriteController::class, 'update']);//
Route::post('/FavoriteDestroy/{id}', [FavoriteController::class, 'destroy']);//
//shopping
Route::get('/ShoppingIndex', [ShoppingController::class, 'index']);//
Route::post('/ShoppingStore', [ShoppingController::class, 'store']);//
Route::post('/ShoppingUpdate/{id}', [ShoppingController::class, 'update']);//
Route::post('/ShoppingDestroy/{id}', [ShoppingController::class, 'destroy']);//


