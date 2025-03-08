<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\usersController;
// use Illuminate\Support\Facades\View;

Route::get('/', function () {
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

// Route::resource('users', UserController::class)->except(['show']);
//Web Authentication ==================================================

Route::get('/register', [usersController::class, 'register'])->name('register');
Route::post('/register', [usersController::class, 'doRegister'])->name('do_register');
Route::get('/login', [usersController::class, 'login'])->name('login');
Route::post('/login', [usersController::class, 'doLogin'])->name('do_login');
Route::get('/logout', [usersController::class, 'doLogout'])->name('do_logout');