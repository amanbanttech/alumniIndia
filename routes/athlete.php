<?php

use App\Http\Controllers\Athlete\AthleteRegisterController;
use App\Http\Controllers\Athlete\AthleteAuthController;
use App\Http\Controllers\Athlete\AthleteDashboardController;
use App\Http\Controllers\Athlete\AthleteProfileController;

use Illuminate\Support\Facades\Route;

Route::prefix('athlete')->group(function () {

    Route::middleware(['roleRedirect'])->group(function () {

        // ------------------- University Login -------------------

        Route::get('/register', [AthleteRegisterController::class, 'registerView'])
            ->name('athlete.register.view');

        Route::post('/register/store', [AthleteRegisterController::class, 'store'])
            ->name('athlete.register.store');

        Route::post('/send-register-otp', [AthleteRegisterController::class, 'sendOtp'])
            ->name('athlete.send.register.otp');

        Route::post('/verify-register-otp', [AthleteRegisterController::class, 'verifyOtp'])
            ->name('athlete.verify.register.otp');


        Route::get('/login', [AthleteAuthController::class, 'loginView'])
            ->name('athlete.login.view');

        Route::post('/login', [AthleteAuthController::class, 'login'])
            ->name('athlete.login');

        Route::post('/send-login-otp', [AthleteAuthController::class, 'sendOtp'])
            ->name('athlete.send.login.otp');

        Route::post('/verify-login-otp', [AthleteAuthController::class, 'verifyOtp'])
            ->name('athlete.verify.login.otp');



    });





    // =================== AUTH + SUPERVISOR MIDDLEWARE ===================

    Route::middleware(['is_athlete'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [AthleteDashboardController::class, 'index'])
            ->name('athlete.dashboard');

        Route::get('/logout', [AthleteAuthController::class, 'logout'])
            ->name('athlete.logout');

        Route::get('/profile', [AthleteProfileController::class, 'profile'])
            ->name('athlete.profile');


        Route::post( '/update/ajax', [AthleteProfileController::class, 'updateAjaxProfile'])->name('athlete.profile.update.ajax');

    });
});