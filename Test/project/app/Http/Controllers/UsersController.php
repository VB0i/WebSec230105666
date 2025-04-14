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
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerificationEmail;

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
        // if(!auth()->user()->hasPermissionTo('show_users')) {
        //     abort(401);
        // }
        $users = User::where('id', '!=', 1)->get();

        return view('users.dashboard', compact('users'));
        // return view('users.dashboard');
    }

    public function register(Request $request) {
        return view('users.register');
    }

    public function doRegister(Request $request) {

    	try {
    		$this->validate($request, [
	        'name' => ['required', 'string', 'min:5'],
	        'email' => ['required', 'email', 'unique:users'],
	        'password' => ['required', 'confirmed', Password::min(8)->numbers()->letters()->mixedCase()->symbols()],
	    	]);
    	}
    	catch(\Exception $e) {

    		return redirect()->back()->withInput($request->input())->withErrors('Invalid registration information.');
    	}

    	
    	$user =  new User();
	    $user->name = $request->name;
	    $user->email = $request->email;
	    $user->password = bcrypt($request->password); //Secure
	    $user->save();

        $title = "Verification Link";
        $token = Crypt::encryptString(json_encode(['id' => $user->id, 'email' => $user->email]));
        $link = route("verify", ['token' => $token]);
        Mail::to($user->email)->send(new VerificationEmail($link, $user->name));
        return redirect('/');
    }

    public function login(Request $request) {
        return view('users.login');
    }

    public function doLogin(Request $request) {
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password]))
            return redirect()->back()->withInput($request->input())->withErrors('Invalid login information.');

        $user = User::where('email', $request->email)->first();
        Auth::setUser($user);

        if(!$user->email_verified_at)
            return redirect()->back()->withInput($request->input())->withErrors('Your email is not verified.');
        return redirect('/');
        // Validate the login credentials
        // $credentials = $request->validate([
        //     'email' => ['required', 'email'],
        //     'password' => ['required'],
        // ]);
    
        // Attempt to authenticate the user
        // if (!Auth::attempt($credentials)) {
        //     return redirect()->back()
        //         ->withInput($request->only('email'))
        //         ->withErrors(['email' => 'Invalid login credentials.']);
        // }
    
        // Get the authenticated user
        // $user = Auth::user();
        
        // // Redirect based on user role
        // if ($user->Role === 'admin') {
        //     return redirect('/'); // Redirect admin to home page
        // }
        
        // Redirect regular users to the welcome page
        // return redirect()->route('welcome'); // Replace 'welcome' with the name of your welcome page route
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


    

    public function doLogout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
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
    public function handleGoogleCallback() {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::updateOrCreate([
                'google_id' => $googleUser->id,
            ], [
                'name' => $googleUser->name,
                'email' => $googleUser->email,
                'google_token' => $googleUser->token,
                'google_refresh_token' => $googleUser->refreshToken,
            ]);
            Auth::login($user);
            return redirect('/');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Google login failed.'); // Handle errors
        }
    }
}