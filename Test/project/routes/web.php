<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalculaterController; 
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\UsersController;

// Basic Views
Route::get('/', function () {
    return view('welcome'); 
});

Route::get('/multable', function () {
    return view('multable');
});

Route::get('/even', function () {
    return view('even');
});

Route::get('/prime', function() {
    return view('prime');
});

Route::get('/MiniTest', function() {
    return view('MiniTest');
});

// Calculator & Transcript Routes
Route::get('/calculator', [CalculaterController::class, 'index']);
Route::get('/transcript', [TranscriptController::class, 'index']);

// Product Routes
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'list'])->name('products_list');
    Route::get('/edit/{product?}', [ProductController::class, 'edit'])->name('products_edit');
    Route::post('/save/{product?}', [ProductController::class, 'save'])->name('products_save');
    Route::get('/delete/{product}', [ProductController::class, 'delete'])->name('products_delete');
});

// Authentication Routes
Route::get('register', [UsersController::class, 'register'])->name('register');
Route::post('register', [UsersController::class, 'doRegister'])->name('do_register');
Route::get('login', [UsersController::class, 'login'])->name('login');
Route::post('login', [UsersController::class, 'doLogin'])->name('do_login');
Route::get('logout', [UsersController::class, 'doLogout'])->name('do_logout');
Route::post('/logout', [UsersController::class, 'doLogout'])->name('do_logout');

// User Profile & Management Routes
Route::get('/welcome', [UsersController::class, 'index'])->name('welcome');
Route::get('UserProfile/{user?}', [UsersController::class, 'profile'])->name('profile');
Route::get('users/edit/{user?}', [UsersController::class, 'edit'])->name('users_edit');
Route::post('users/save/{user}', [UsersController::class, 'save'])->name('users_save');
Route::get('users/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
Route::get('verify', [UsersController::class, 'verify'])->name('verify');

// Social Authentication Routes
Route::prefix('auth')->group(function () {
    // Google
    Route::get('/google', [UsersController::class, 'redirectToGoogle'])->name('login_with_google');
    Route::get('/google/callback', [UsersController::class, 'handleGoogleCallback']);
    
    // Facebook
    Route::get('/facebook', [UsersController::class, 'redirectToFacebook'])->name('redirectToFacebook');
    Route::get('/facebook/callback', [UsersController::class, 'handelFacebookCallback'])->name('handelFacebookCallback');
});

// Password Reset Routes
Route::prefix('forgot-password')->group(function () {
    Route::get('/', [UsersController::class, 'showForgotPasswordForm'])->name('password.request');
    Route::post('/', [UsersController::class, 'sendResetLinkEmail'])->name('password.email');
    Route::get('/reset/{token}', [UsersController::class, 'showResetForm'])->name('password.reset');
    Route::post('/reset', [UsersController::class, 'reset'])->name('password.update');
});

// sql unprepared function
// Route::get('/sqli',function(Request $request){
//     $table = $request->query('table');
//     DB::unprepared("DROP TABLE $table");
//     return redirect('/');
// });

// Route::get('/collect', function(Request $request) {
//     $name = $request->query('name');
//     $credit = $request->query('credit');

//     return response('data collected', 200)
//         ->header('Access-Control-Allow-Origin', '*')
//         ->header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS')
//         ->header('Access-Control-Allow-Headers', 'Content-Type, X-Requested-With'); 
// });