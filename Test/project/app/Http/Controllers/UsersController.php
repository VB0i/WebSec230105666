<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller {
    use ValidatesRequests;

    public function register(Request $request) {
        return view('users.register');
    }

    public function doRegister(Request $request) {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);
    
        // Create new user with default role = 'user'
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'Role' => 'user', // Default role matches User model
        ]);
    
        // Log in the new user
        Auth::login($user);
    
        // Redirect to login page
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

    public function login(Request $request) {
        return view('users.login');
    }

    public function doLogin(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (!Auth::attempt($credentials)) {
            return redirect()->back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => 'Invalid login credentials.']);
        }

        $user = Auth::user();
        
        if ($user->Role === 'admin') {
            return redirect('/'); // Redirect admin to home page
        }
        
        return redirect()->route('User_Profile'); // Redirect regular users to profile
    }

    public function viewProfile() {
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        return view('users.UserProfile');
    }

    public function doLogout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
