<?php

use App\Http\Controllers\AuthMFA\LoginController;
use Illuminate\Support\Facades\Route;

Route::prefix('authentication')->name('authmfa.')->group(function () {

    Route::controller(LoginController::class)->group(function () {
        Route::get('login', 'index')->name('login');
        Route::post('login', 'authenticateCheck')->name('authenticate.check');
        Route::get('logout', 'logout')->name('logout');
    });

    Route::controller(MFAController::class)->group(function () {
        Route::get('mfa-service/register', 'registerMFA')->name('register.mfa');
        Route::get('mfa-service/verification/form', 'indexVerification')->name('verify.mfa.index');
        Route::post('mfa-service/verification', 'mfaVerification')->name('mfa.verification'); 
    });

});

Route::get('', [HomeController::class, 'index'])->name('dashboard.index');