<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    
    protected $redirectTo = '/dashboard/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');    
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    public function credentials(Request $request) {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->email, 'password' => $request->password];
        } else {
            return ['userName' => $request->email, 'password' => $request->password];
        }
    }

    protected function authenticated(Request $request, $user)
    {
        // Set session variables
        Session::put('name', $user->name);
}


// public function authenticate(Request $request): RedirectResponse
//     {
//         $credentials = $request->validate([
//             'email' => ['required', 'email'],
//             'password' => ['required'],
//         ]);
 
//         if (Auth::attempt($credentials)) {
//             $request->session()->regenerate();
 
//             return redirect()->intended('dashboard');
//         }
 
//         return back()->withErrors([
//             'email' => 'The provided credentials do not match our records.',
//         ])->onlyInput('email');


//         if (Auth::attempt(['email' => $email, 'password' => $password, 'active' => 1])) {
//             // Authentication was successful...
//         }
//     }



// public function authenticate(Request $request): RedirectResponse
// {
//     $credentials = $request->validate([
//         'email' => ['required', 'email'],
//         'password' => ['required'],
//     ]);

//     // Check if the user is active
//     $user = User::where('email', $credentials['email'])->first();

//     if ($user && $user->active == 0) {
//         return back()->withErrors([
//             'email' => 'Your account is not active.',
//         ])->onlyInput('email');
//     }

//     // Attempt to authenticate the user
//     if (Auth::attempt($credentials)) {
//         $request->session()->regenerate();

//         return redirect()->intended('dashboard');
//     }

//     return back()->withErrors([
//         'email' => 'The provided credentials do not match our records.',
//     ])->onlyInput('email');
// }

        }
    
