<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


// =====================================
// Basic routes without controllers
Route::get('/welcome', function () {
    return view('welcome'); //welcome.blade.php
});
Route::get('/multable', function () {
    return view('multable'); //multable.blade.php
});
Route::get('/even', function () {
    return view('even'); //even.blade.php
});
Route::get('/prime', function () {
    return view('prime'); //prime.blade.php
});
Route::get('/MiniTest',function() {
    return view('MiniTest'); //mini test.blade.php
});
Route::get('/transcript', function () {
    $transcript = [
        ['course' => 'Web Security', 'grade' => 'A'],
        ['course' => 'Database Systems', 'grade' => 'B+'],
        ['course' => 'Network Security', 'grade' => 'A-'],
    ];
    return view('transcript', compact('transcript'));
});
Route::get('/products', function () {
    $products = [
        [
            'name' => 'Product 1',
            'image' => 'https://via.placeholder.com/150',
            'price' => 19.99,
            'description' => 'This is a description for Product 1.'
        ],
        [
            'name' => 'Product 2',
            'image' => 'https://via.placeholder.com/150',
            'price' => 29.99,
            'description' => 'This is a description for Product 2.'
        ],
        [
            'name' => 'Product 3',
            'image' => 'https://via.placeholder.com/150',
            'price' => 39.99,
            'description' => 'This is a description for Product 3.'
        ],
        // Add more products as needed
    ];
    return view('products', compact('products'));
});
// =====================================

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::get('/users/register', [UserController::class, 'register'])->name('users.register');
Route::post('/do-register', [UserController::class, 'register'])->name('do_register');
Route::post('/users', [UserController::class, 'store'])->name('users.store');

require __DIR__.'/auth.php';


Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');
