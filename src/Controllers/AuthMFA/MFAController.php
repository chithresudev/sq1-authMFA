<?php

namespace App\Http\Controllers\AuthMFA;

use Carbon\Carbon;
use Cache;
use Sq1\AuthMfa\MFAServices\MFAService;
use App\Http\Requests\MFAValidationSecret;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class MFAController extends Controller
{
    use MFAService;


     /**
     * Instantiate a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('authGuestMFA');
    }

    /**
     * Display the MFA view.
     *
     * @return \Illuminate\View\View
     */
    public function indexVerification() : View
    {
        return view('auth-mfa.mfa');
        
    }

    /**
     * Display the MFA view.
     *
     * @return \Illuminate\View\View
     */
    public function mfaVerification(MFAValidationSecret $request)
    {

        $user = auth()->user();
        $key = $user->id . ':' . $request->totp;

        if($user->user_status != 'completed') {
            $user->user_status = 'completed';
        }

        session()->put('user_current_status', 'verified');
        //use cache to store token to blacklist
        Cache::add($key, true, 4);
        return redirect()->intended();
  
    }


}
