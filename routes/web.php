<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ManageController;
use App\Http\Controllers\MultipleController;
use Illuminate\Support\Facades\Route;
use Termwind\Components\Raw;

Route::get('/', function () {
    return view('login');
})->name('login');
Route::get('/register', function () {
    return view('register');
})->name('register');
Route::get('/view', function () {
    return view('layout');
});


Route::post('/save-register', [AuthController::class, 'store'])->name('RegisterPage');
Route::post('/save-login', [AuthController::class, 'login'])->name('LoginPage');
Route::post('userlogout', [AuthController::class, 'userlogout'])->name('userlogout');
Route::get('/profile', [AuthController::class, 'profile'])->name('Profile');
Route::get('/edit-profile/{id}', [AuthController::class, 'edit'])->name('EditProfile');
Route::post('/update-profile', [AuthController::class, 'updatedata'])->name('UpdateProfile');

Route::get('/getcity/{country_id}', [ManageController::class, 'filter']);
Route::get('/view', [ManageController::class, 'view'])->name('view');
Route::get('/display', [ManageController::class, 'display'])->name('display');
Route::get('/add', [ManageController::class, 'main'])->name('form');
Route::post('/store', [ManageController::class, 'store'])->name('store');
Route::get('/edit/{id}', [ManageController::class, 'edit'])->name('edit');
Route::post('/update', [ManageController::class, 'updatedata'])->name('update');
Route::get('/delete/{id}', [ManageController::class, 'delete'])->name('delete');


Route::get('/multifield', [MultipleController::class, 'multifield'])->name('multifield');
Route::post('/add-multifield', [MultipleController::class, 'store'])->name('add-multifield');

Route::get('/inputmultifield', [MultipleController::class, 'inputmultifield'])->name('inputmultifield');


