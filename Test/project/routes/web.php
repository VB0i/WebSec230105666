<?php
// ========================== name Space ==============================
namespace App\Http\Controllers;
// ======================= Use Controller's ===========================
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalculaterController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\UsersController;

// ============================ Views ==================================
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


// ========================= Other Controllers =========================

Route::get('/calculator', [CalculaterController::class,'index']);
Route::get('/transcript', [TranscriptController::class ,'index']);

// ========================= ProductController =========================

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
Route::get('users/edit/{user?}', [UsersController::class, 'edit'])->name('users_edit');
Route::post('users/save/{user}', [UsersController::class, 'save'])->name('users_save');
Route::get('users/dashboard', [UsersController::class, 'dashboard'])->name('dashboard');
Route::get('verify', [UsersController::class, 'verify'])->name('verify');

Route::get('/auth/google', [UsersController::class, 'redirectToGoogle'])->name('login_with_google');
Route::get('/auth/google/callback', [UsersController::class, 'handleGoogleCallback']);

Route::get('forgot_password', [UsersController::class, 'showForgotPasswordForm'])->name('password.request');
Route::post('forgot_password', [UsersController::class, 'sendResetLinkEmail'])->name('password.email');



use Illuminate\Support\Facades\Mail;

Route::get('/test-email', function() {
    try {
        Mail::raw('This is a test email body', function($message) {
            $message->to('zezosuliman95@gmail.com')
                    ->subject('Test Email from Laravel');
        });
        
        return 'Email sent successfully! Check your inbox.';
    } catch (\Exception $e) {
        return 'Error: ' . $e->getMessage();
    }
});