<?php

use App\Http\Controllers\ManageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/view',function(){
    return view('layout');
});

Route::get('/getcity/{country_id}',[ManageController::class,'filter']);


Route::get('/view',[ManageController::class,'view'])->name('view');

Route::get('/display',[ManageController::class,'display'])->name('display');

Route::get('/add',[ManageController::class,'main'])->name('form');

Route::post('/store',[ManageController::class,'store'])->name('store');

Route::get('/edit/{id}',[ManageController::class,'edit'])->name('edit');

Route::post('/update',[ManageController::class,'updatedata'])->name('update');
Route::get('/delete/{id}',[ManageController::class,'delete'])->name('delete');