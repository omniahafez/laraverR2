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

    //login by username or email with password
    public function credentials(Request $request) {
        if (filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return ['email' => $request->email, 'password' => $request->password, 'active' => 1];
        } else {
            return ['userName' => $request->email, 'password' => $request->password, 'active' => 1];
        }
    }

    // give error message for user with active=0
    protected function sendFailedLoginResponse(Request $request)
    {
        $credentials = $this->credentials($request);

        $user = User::where('email', $credentials['email'] ?? $credentials['userName'])->first();

        if ($user && $user->active == 0) {
            return redirect()->back()
                ->withInput($request->only($this->username(), 'remember'))
                ->withErrors(['email' => 'Your account is inactive. Please contact support.']);
        }
        return redirect()->back()
        ->withInput($request->only($this->username(), 'remember'))
        ->withErrors([$this->username() => trans('auth.failed')]);
    
    
    }

    // use the name of loggin user in session
    protected function authenticated(Request $request, $user)
    {
        // Set session variables
        Session::put('name', $user->name);
    }

    // make logout from dashboard
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        
        return redirect('/login'); // Redirect to the login page or any other page
    }
}
    
