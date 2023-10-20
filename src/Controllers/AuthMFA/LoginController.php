<?php

namespace App\Http\Controllers\AuthMFA;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Sq1\AuthMfa\MFAServices\MFAService;

class LoginController extends Controller
{

    use MFAService;

    /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

     /**
     * show return value
     */
    public function index(Request $request)
    {
   
        return view('auth-mfa.login');
    }

    /**
     * Handle an authentication attempt.
     */
    public function authenticate(Request $request)
    {

       
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
 
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return $this->verifyMFA();
        }
 
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

     /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $user = auth()->user();
        $user->activity = 'offline';
        $user->save();

        session()->flush();
        Auth::logout();
        return redirect()->intended();
    }




}
