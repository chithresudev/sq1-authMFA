<?php

namespace App\Http\Controllers\AuthMFA;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /**
     * show return value
     */
    public function index(Request $request)
    {
        return view('auth-mfa.login');
    }
}
