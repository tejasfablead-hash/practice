<?php

use App\Http\Controllers\ManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view',function(){
    return view('layout');
});



Route::get('/view',[ManageController::class,'view'])->name('view');

Route::get('/display',[ManageController::class,'display'])->name('display');

Route::get('/main',[ManageController::class,'main'])->name('form');

Route::post('/store',[ManageController::class,'store'])->name('store');

