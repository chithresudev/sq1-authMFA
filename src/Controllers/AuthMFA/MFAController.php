<?php

namespace App\Http\Controllers\AuthMFA;

use Sq1\AuthMfa\MFAServices\MFAService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MFAController extends Controller
{
    use MFAService;
    
    /**
     * Display the MFA view.
     *
     * @return \Illuminate\View\View
     */
    public function verifyMFA()
    {
        return '$this->mfaRegister()';
        
    }
    
}
