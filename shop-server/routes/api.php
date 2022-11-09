<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\ExtraServiceController;

Route::post('register',[AuthController::class,'register']);
Route::post('/login',[AuthController::class,'login']);
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',[AuthController::class,'logout'])
;
});
Route::delete('/delete/{id}',[ProductController::class,'delete']);
Route::post('/add-product',[ProductController::class,'addProduct']);
Route::get('/products',[ProductController::class,'productList'])
;
Route::get('/product/{id}',[ProductController::class,'show'])
;
Route::get('/carts/{id}',[FlightController::class,'cartCount'])
;
Route::post('add-cart',[FlightController::class, 'create']);
Route::delete('delete/flight/{id}',[FlightController::class,'delete']);
Route::post('/add-service',[ServiceController::class,'addService']);
Route::get('/get-services',[ServiceController::class,'services']);
Route::post('/add-extra-service',[ExtraServiceController::class,'addEtraService']);
Route::get('/get-extra-service/{id}',[ExtraServiceController::class,'ExtraServices']);
Route::delete('/delete/extra-service/{id}',[ExtraServiceController::class,'delete']);
Route::post('/payments',[PaymentController::class,'paymentApi']);