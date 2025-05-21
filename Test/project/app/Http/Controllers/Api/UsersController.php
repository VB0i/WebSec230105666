<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UsersController extends Controller {
    public function login(Request $request) {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        if (!Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return response()->json(['error' => 'Invalid login credentials.'], 401);
        }

        $user = User::where('email', $request->email)->select('id', 'name', 'email')->first();
        $token = $user->createToken('app')->accessToken;

        return response()->json([
            'token' => $token,
            'user' => $user
        ]);
    }

    public function users(Request $request) {
        $users = User::select('id', 'name', 'email')->get();
        return response()->json(['users' => $users]);
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return response()->json(['message' => 'Successfully logged out']);
    }
}

// php artisan passport:install
// php artisan passport:client --personal
