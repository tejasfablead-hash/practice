<?php

use App\Http\Controllers\ApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    
    return $request->user();
})->middleware('auth:sanctum');

Route::post('save-register', [ApiController::class, 'store']);
Route::post('match', [ApiController::class, 'login']);
Route::get('view-register', [ApiController::class, 'view']);

Route::get('edit-user/{id}', [ApiController::class, 'edit']);
Route::put('update-user', [ApiController::class, 'update']);
Route::delete('delete-user/{id}', [ApiController::class, 'delete']);

