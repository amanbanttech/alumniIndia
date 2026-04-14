<?php

use App\Http\Controllers\Mentor\MentorAuthController;
use App\Http\Controllers\Mentor\mentorDashboardController;
use App\Http\Controllers\Mentor\MentorAthleteController;

use Illuminate\Support\Facades\Route;

Route::prefix('mentor')->group(function () {

    Route::middleware(['roleRedirect'])->group(function () {

        Route::get('/login', [MentorAuthController::class, 'loginView'])
            ->name('mentor.login.view');

        Route::post('/login', [MentorAuthController::class, 'login'])
            ->name('mentor.login');
        Route::post('/send-login-otp', [MentorAuthController::class, 'sendLoginOtp'])
            ->name('mentor.send.login.otp');

        Route::post('/verify-login-otp', [MentorAuthController::class, 'verifyLoginOtp'])
            ->name('mentor.verify.login.otp');
    });

    Route::middleware(['is_mentor'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [mentorDashboardController::class, 'index'])
            ->name('mentor.dashboard');

        Route::get('/logout', [MentorAuthController::class, 'logout'])
            ->name('mentor.logout');

        Route::post('/video-like', [mentorDashboardController::class, 'toggleLike'])->name('mentor.video.like');
        Route::get('/mentor/search', [MentorDashboardController::class, 'search'])
            ->name('mentor.search');

            // My Athletes
        Route::get('/my-athletes', [MentorAthleteController::class, 'index'])->name('mentor.my-athletes');
        Route::get('/athlete-profile/{id}', [MentorAthleteController::class, 'athleteProfile'])->name('mentor.athlete.profile');

        // Account Deactivation
        Route::get('/deactivate-my-account', [MentorAuthController::class, 'deactivateView'])->name('mentor.deactivate.view');
        Route::post('/deactivate', [MentorAuthController::class, 'deactivate'])->name('mentor.deactivate');


    });


});