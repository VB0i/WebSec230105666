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

// Employee Routes
Route::middleware(['auth', 'role:Employee|Admin'])->group(function () {
    // Product Management
    Route::resource('products', ProductController::class);
    
    // Customer Management
    Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::post('/customers/{user}/add-credit', [CustomerController::class, 'addCredit'])->name('customers.add-credit');
});

// ========================= Other Controllers =========================

Route::get('/calculator', [CalculaterController::class,'index']);
Route::get('/transcript', [TranscriptController::class ,'index']);

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