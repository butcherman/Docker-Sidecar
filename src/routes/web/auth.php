<?php

use App\Http\Controllers\Auth\TwoFactorController;
use App\Http\Controllers\Auth\TwoFactorSetupAuthenticatorController;
use App\Http\Controllers\Auth\TwoFactorSetupController;
use App\Http\Controllers\Auth\TwoFactorSetupEmailController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|-------------------------------------------------------------------------------
| Authentication Routes not handled by Fortify
|-------------------------------------------------------------------------------
*/

Route::middleware(['guest', 'throttle:50,120'])->group(function () {
    Route::get('/', function () {
        return Inertia::render('Home');
    })->name('home');
    Route::post('two-factor-submit', TwoFactorController::class)
        ->name('two-factor.login.email');
});

Route::middleware('auth')
    ->prefix('two-factor-authentication/setup')
    ->name('two-factor.setup.')
    ->group(function () {
        Route::get('/', TwoFactorSetupController::class)->name('index');
        Route::get('email-verification', TwoFactorSetupEmailController::class)
            ->name('email');
        Route::get('authenticator-app-verification', TwoFactorSetupAuthenticatorController::class)
            ->name('authenticator');
    });
