<?php

namespace Sq1\AuthMfa\MFAServices;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

trait MFAService
{



     /**
     * Display the MFA view.
     *
     * @return \Illuminate\View\View
     */
    public function verifyMFA()
    {
        $auth_user = auth()->user();

        if($auth_user->activity == 'offline') {
            $auth_user->activity = 'online';
            $auth_user->last_activity_at = Carbon::now();
            $auth_user->save();

            if($auth_user->user_status != 'mfa_register') {
                return redirect()->route('authmfa.verify.mfa.index');
            } else {
                return redirect()->route('authmfa.register.mfa');
            }
        } else if(($auth_user->activity == 'online') && (Carbon::parse($auth_user->last_activity_at)->addMinutes(1) <= Carbon::now())) {
            $auth_user->last_activity_at = Carbon::now();
            $auth_user->save();
    
            if($auth_user->user_status != 'mfa_register') {
                return redirect()->route('authmfa.verify.mfa.index');
            } else {
                return redirect()->route('authmfa.register.mfa');
            }
        } else {

            $last_seen = Carbon::parse(auth()->user()->last_activity_at);
            $totalDuration = $last_seen->diffForHumans(Carbon::now());
           Auth::logout();
           return view('message', ['message' => 'Already Login ' . $totalDuration . ', .Someone using same credential. please wait and contact administrator']);

        }

    }

     /**
     * Display the MFA view.
     *
     * @return \Illuminate\View\View
     */
    public function registerMFA()
    {
        $request = app('request');
        $auth_user = auth()->user();
        
        if($auth_user->user_status == 'mfa_register') {
            $google2fa = app('pragmarx.google2fa');
            $secret_code = $google2fa->generateSecretKey();
            $auth_user->google2fa_secret =  $secret_code;
            $auth_user->save();

            $qrcode_img = $google2fa->getQRCodeInline(
                $request->getHttpHost(),
                $auth_user->email,
                $secret_code, 200
            );

            return view('auth-mfa.qr-code', ['qrcode_img' => $qrcode_img, 'secret_code' =>  $secret_code]);
        } else {
            return abort(401);
        }

    }
}




