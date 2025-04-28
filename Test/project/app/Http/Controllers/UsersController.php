<?php
namespace App\Http\Controllers;
use Carbon\Carbon;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

// use App\Http\Controllers\Role;

class UsersController extends Controller {
    use ValidatesRequests;

    public function showForgotPasswordForm()
{
    return view('users.forgot_password');
}
public function sendResetLinkEmail(Request $request)
{
    $request->validate(['email' => 'required|email']);
    
    // Check if email exists first
    $user = User::where('email', $request->email)->first();
    
    if (!$user) {
        return back()->withErrors(['email' => 'If this email exists in our system, we will send a reset link.']);
    }
    
    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with('status', __($status))
        : back()->withErrors(['email' => __($status)]);
}

    public function index()
    {
        $users = User::where('id', '!=', 1)->get();

        return view('welcome', compact('users'));
        // return view('welcome');
    }

    //dashboard class
    public function dashboard()
    {
        if(!auth()->user()->hasPermissionTo('edit_products')) {
            abort(401);
        }
        $users = User::where('id', '!=', 1)->get();

        return view('users.dashboard', compact('users'));
        // return view('users.dashboard');
    }

    public function register(Request $request) {
        return view('users.register');
    }

    public function doRegister(Request $request) {
        // Validation
        $validated = $request->validate([
            'name' => 'required|string|min:5',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|string|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/'
        ]);
    
        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']), // Always hash passwords
        ]);
        
        $user->assignRole('Customer');

        // Send verification email
        try {
            $token = Crypt::encryptString(json_encode([
                'id' => $user->id,
                'email' => $user->email
            ]));
            Mail::to($user->email)->send(new VerificationEmail(
                route('verify', ['token' => $token]),
                $user->name
            ));
        } catch (\Exception $e) {
            \Log::error("Verification email failed: " . $e->getMessage());
     
        }
    
        return redirect('/')->with('success', 'Account created! Check your email to verify.');
    }

    public function login(Request $request) {
        return view('users.login');
    }


    public function profile(Request $request, User $user = null) {

        $user = $user??auth()->user();

        if ($user->id === 1 && !auth()->user()->hasRole('Admin')) {
            abort(403, 'You are not allowed to view this profile.');
        }


        if(auth()->id()!=$user->id) {
            if(!auth()->user()->hasPermissionTo('show_users')) abort(401);
        }

        $permissions = [];
        foreach($user->permissions as $permission) {
            $permissions[] = $permission;
        }
        foreach($user->roles as $role) {
            foreach($role->permissions as $permission) {
                $permissions[] = $permission;
            }
        }

        return view('users.UserProfile', compact('user', 'permissions'));
    }

    public function edit(Request $request, User $user = null) {
   
        $user = $user??auth()->user();

        if ($user->id === 1 && !auth()->user()->hasRole('Admin')) {
            abort(403, 'You are not allowed to edit this user.');
        }

        if(auth()->id()!=$user?->id) {
            if(!auth()->user()->hasPermissionTo('edit_users')) abort(401);
        }
    
        $roles = [];
        foreach(Role::all() as $role) {
            $role->taken = ($user->hasRole($role->name));
            $roles[] = $role;
        }

        $permissions = [];
        $directPermissionsIds = $user->permissions()->pluck('id')->toArray();
        foreach(Permission::all() as $permission) {
            $permission->taken = in_array($permission->id, $directPermissionsIds);
            $permissions[] = $permission;
        }      

        return view('users.edit', compact('user', 'roles', 'permissions'));
    }


    public function save(Request $request, User $user) {

        if(auth()->id()!=$user->id) {
            if(!auth()->user()->hasPermissionTo('show_users')) abort(401);
        }

        $user->name = $request->name;
        $user->save();

        if(auth()->user()->hasPermissionTo('admin_users')) {

            $user->syncRoles($request->roles);
            $user->syncPermissions($request->permissions);

            Artisan::call('cache:clear');
        }

        //$user->syncRoles([1]);
        //Artisan::call('cache:clear');

        return redirect(route('profile', ['user'=>$user->id]));
    }


    

    public function doLogin(Request $request) 
{
    $credentials = $request->only('email', 'password');
    
    if (!Auth::attempt($credentials)) {
        return redirect()->back()
            ->withInput($request->input())
            ->withErrors('Invalid login information.');
    }
    
    $user = Auth::user();
    
    // Skip email verification check for Google-authenticated users
    if (!$user->email_verified_at && empty($user->google_id)) {
        Auth::logout();
        return redirect()->back()
            ->withInput($request->input())
            ->withErrors('Your email is not verified.');
    }
    
    return redirect('/');
}


public function savePassword(Request $request, User $user) {

    if(auth()->id()==$user?->id) {
        
        $this->validate($request, [
            'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()],
        ]);

        if(!Auth::attempt(['email' => $user->email, 'password' => $request->old_password])) {
            
            Auth::logout();
            return redirect('/');
        }
    }
    else if(!auth()->user()->hasPermissionTo('edit_users')) {

        abort(401);
    }

    $user->password = bcrypt($request->password); //Secure
    $user->save();

    return redirect(route('profile', ['user'=>$user->id]));
}
    public function verify(Request $request) {
    
        $decryptedData = json_decode(Crypt::decryptString($request->token), true);
        $user = User::find($decryptedData['id']);
        if(!$user) abort(401);
        $user->email_verified_at = Carbon::now();
        $user->save();

        return view('users.verified', compact('user'));
    }
    
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->stateless()->user();
    
        $user = User::updateOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'google_id' => $googleUser->getId(),
                'avatar' => $googleUser->getAvatar(),
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
                'email_verified_at'=> now(),
            ]
        );

        if (!$user->hasRole('Customer')) {
            $user->assignRole('Customer');
        }
    
        Auth::login($user);
    
        return redirect()->intended('/');
    }

public function doLogout()
{
    Auth::logout(); 
    return redirect('/');
}

public function showResetForm(Request $request, $token = null)
{
    return view('auth.reset-password', [
        'token' => $token,
        'email' => $request->email
    ]);
}

public function reset(Request $request)
{
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|confirmed|min:8|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill([
                'password' => bcrypt($password)
            ])->save();
        }
    );

    return $status == Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', __($status))
        : back()->withErrors(['email' => [__($status)]]);
}

public function redirectToFacebook(){
    return Socialite::driver('facebook')->redirect();
}

public function handelFacebookCallback(){
    $userfacebook = socialite::driver('facebook')->stateless()->user();
    $user = User::firstOrCreate(
        ['facebook_id'=>$userfacebook->getId()],
        ['facebook_name'=>$userfacebook->getName(),
        'facebook_email'=>$userfacebook->getEmail()]       
    );

    if (!$user->hasRole('Customer')) {
        $user->assignRole('Customer');
    }

    Auth::login($user);
    return redirect()->intended('/');
}

}