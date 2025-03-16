<?php
// ========================= name Space's =============================

namespace App\Http\Controllers;


// ========================= Use Controller's =========================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalculaterController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\UsersController;
// ====================================================================
Route::get('/', function () {
    return view('welcome');
});



Route::get('/multable', function () {
    return view('multable');
});

Route::get('/even', function () {
    return view('even');
});

Route::get('/prime', function(){
    return view('prime');
});

Route::get('/MiniTest', function(){
    return view('MiniTest');
});





// ========================= Controllers views =========================





Route::get('/calculator', [CalculaterController::class,'index']);
Route::get('/transcript', [TranscriptController::class ,'index']);



// mine
// Route::get('products', [ProductController::class, 'list'])->name('products_list');
// Route::get('products/edit/{product?}', [ProductController::class, 'edit'])->name('products_edit');
// Route::post('products/save/{product?}', [ProductController::class, 'save'])->name('products_save');
// Route::get('products/delete/{product}', [ProductController::class, 'delete'])->name('products_delete');
// sobh
Route::get('products', [ProductController::class, 'list'])->name('products_list');
Route::get('products/edit/{product?}', [ProductController::class, 'edit'])->name('products_edit');
Route::post('products/save/{product?}', [ProductController::class, 'save'])->name('products_save');
Route::get('products/delete/{product}', [ProductController::class, 'delete'])->name('products_delete');



// =========================== Users Controller =========================
Route::get('register', [UsersController::class, 'register'])->name('register');
Route::post('register', [UsersController::class, 'doRegister'])->name('do_register');
Route::get('login', [UsersController::class, 'login'])->name('login');
Route::post('login', [UsersController::class, 'doLogin'])->name('do_login');
Route::get('logout', [UsersController::class, 'doLogout'])->name('do_logout');
Route::post('/logout', [UsersController::class, 'doLogout'])->name('do_logout');

Route::get('/welcome', [UsersController::class, 'index'])->name('welcome');

Route::get('UserProfile/{user?}', [UsersController::class,'profile'])->name('profile');
// Route::get('UserProfile', [UsersController::class, 'viewProfile'])->name('profile')->middleware('auth');
// Route::get('profile/{user?}', [UsersController::class, 'profile'])->name('profile');

Route::get('users/edit/{user?}', [UsersController::class, 'edit'])->name('users_edit');