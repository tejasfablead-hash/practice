<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('user/save-register', [ApiController::class, 'store']);
Route::post('user/login', [ApiController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){

Route::post('user/logout', [ApiController::class, 'logout']);
Route::get('user/view-register', [ApiController::class, 'view']);
Route::post('user/update-user', [ApiController::class, 'update']);

Route::post('product/store', [ProductController::class, 'store']);
Route::post('product/update/{id}', [ProductController::class, 'update']);
Route::post('product/delete', [ProductController::class, 'delete']);
Route::post('product/view-product', [ProductController::class, 'view']);

});
