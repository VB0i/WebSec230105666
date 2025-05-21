<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CalculaterController;
use App\Http\Controllers\TranscriptController;
use App\Http\Controllers\UsersController;
use App\Models\User;

// Basic Views
Route::get('/', function () {
    $email = emailFromLoginCertificate();
    if($email && !auth()->user()) {
    $user = User::where('email', $email)->first();
    if($user) Auth::setUser($user);
    }
    return view('welcome');
   });

Route::get('/multable', function () {
    return view('multable');
});

Route::get('/even', function () {
    return view('even');
});

Route::get('/prime', function () {
    return view('prime');
});

Route::get('/MiniTest', function () {
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
Route::post('/products/{id}/favourite', action: [ProductController::class, 'toggleFavourite'])->name('products.favourite');

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
Route::get('/cryptography', function (Request $request) {
    $data = $request->data ?? "Welcome to Cryptography";
    $action = $request->action ?? "Encrypt";
    $result = $request->result ?? "";
    $status = "Failed";
    if ($request->action == "Encrypt") {
        $temp = openssl_encrypt($request->data, 'aes-128-ecb', 'thisisasecretkey', OPENSSL_RAW_DATA, '');
        if ($temp) {
            $status = 'Encrypted Successfully';
            $result = base64_encode($temp);
        }
    } else if ($request->action == "Decrypt") {
        $temp = base64_decode($request->data);
        $result = openssl_decrypt($temp, 'aes-128-ecb', 'thisisasecretkey', OPENSSL_RAW_DATA, '');
        if ($result)
            $status = 'Decrypted Successfully';
    } else if ($request->action == "Hash") {
        $temp = hash('sha256', $request->data);
        $result = base64_encode($temp);
        $status = 'Hashed Successfully';
    } else if ($request->action == "Sign") {
        $path = storage_path('app/private/useremail@domain.com.pfx');
        $password = '12345678';
        $certificates = [];
        $pfx = file_get_contents($path);
        openssl_pkcs12_read($pfx, $certificates, $password);
        $privateKey = $certificates['pkey'];
        $signature = '';
        if (openssl_sign($request->data, $signature, $privateKey, 'sha256')) {
            $result = base64_encode($signature);
            $status = 'Signed Successfully';
        }
    } else if ($request->action == "Verify") {
        $signature = base64_decode($request->result);
        $path = storage_path('app/public/useremail@domain.com.crt');
        $publicKey = file_get_contents($path);
        if (openssl_verify($request->data, $signature, $publicKey, 'sha256')) {
            $status = 'Verified Successfully';
        }
    } else if ($request->action == "KeySend") {
        $path = storage_path('app/public/useremail@domain.com.crt');
        $publicKey = file_get_contents($path);
        $temp = '';
        if (openssl_public_encrypt($request->data, $temp, $publicKey)) {
            $result = base64_encode($temp);
            $status = 'Key is Encrypted Successfully';
        }
    } else if ($request->action == "KeyRecive") {
        $path = storage_path('app/private/useremail@domain.com.pfx');
        $password = '12345678';
        $certificates = [];
        $pfx = file_get_contents($path);
        openssl_pkcs12_read($pfx, $certificates, $password);
        $privateKey = $certificates['pkey'];
        $encryptedKey = base64_decode($request->data);
        $result = '';
        if (openssl_private_decrypt($encryptedKey, $result, $privateKey)) {
            $status = 'Key is Decrypted Successfully';
        }
    }

    return view('cryptography', compact('data', 'result', 'action', 'status'));
})->name('cryptography');

Route::get('/webcrypto', function () {
    return view('webcrypto');
})->name('webcrypto');
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