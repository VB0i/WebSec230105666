<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\UsersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::post('login', [UsersController::class, 'login']);
Route::get('users', [UsersController::class, 'users'])->middleware('auth:api');
Route::get('logout', [UsersController::class, 'logout'])->middleware('auth:api');