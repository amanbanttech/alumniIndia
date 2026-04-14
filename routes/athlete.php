<?php

use App\Http\Controllers\Athlete\AthleteRegisterController;
use App\Http\Controllers\Athlete\AthleteAuthController;
use App\Http\Controllers\Athlete\AthleteDashboardController;
use App\Http\Controllers\Athlete\AthleteProfileController;
use App\Http\Controllers\Athlete\UniversityPreferenceController;
use App\Http\Controllers\Athlete\AthleteManageVedioController;
use App\Http\Controllers\Athlete\AthleteMembershipController;
use App\Http\Controllers\Athlete\AthleteScholarshipController;
use App\Http\Controllers\Athlete\AthleteMentorController;
use App\Http\Controllers\Athlete\ChatController;


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
        Route::post('/video-like', [AthleteDashboardController::class, 'toggleLike'])->name('athlete.video.like');
        Route::get('/athlete/search', [AthleteDashboardController::class, 'search'])
            ->name('athlete.search');

        Route::get('/logout', [AthleteAuthController::class, 'logout'])
            ->name('athlete.logout');

        Route::get('/profile', [AthleteProfileController::class, 'profile'])
            ->name('athlete.profile');


        Route::post('/update/ajax', [AthleteProfileController::class, 'updateAjaxProfile'])->name('athlete.profile.update.ajax');

        // Set University Preference
        Route::get('/set-universities-preference', [UniversityPreferenceController::class, 'setUniversityPreference'])
            ->name('athlete.set-university-preference');
        Route::post('/set-university-preference/store', [UniversityPreferenceController::class, 'store'])
            ->name('athlete.set-university-preference.store');

        //Manage Vedioes
        Route::get('/manage-videos', [AthleteManageVedioController::class, 'manageVideo'])
            ->name('athlete.manage-videos');

        Route::get('/add-video', [AthleteManageVedioController::class, 'addVideo'])
            ->name('athlete.add-video');

        Route::post('/add-video/store', [AthleteManageVedioController::class, 'storeVideo'])
            ->name('athlete.add-video.store');

        Route::get('/edit-video/{id}', [AthleteManageVedioController::class, 'editVideo'])
            ->name('athlete.edit-video');
        Route::put('/edit-video/update/{id}', [AthleteManageVedioController::class, 'updateVideo'])
            ->name('athlete.edit-video.update');

        Route::post('/manage-videos/delete', [AthleteManageVedioController::class, 'deleteVideo'])->name('athlete.manage-videos.delete');

        // Manage Membership
        Route::get('/manage-membership', [AthleteMembershipController::class, 'manageMembership'])->name('athlete.manage-membership');

        // Current Scholarships
        Route::get('/current-scholarships', [AthleteScholarshipController::class, 'manageScholarship'])->name('athlete.current-scholarships');
        Route::get('/scholarship-details/{id}', [AthleteScholarshipController::class, 'applyScholarship'])->name('athlete.apply-scholarships');
        Route::post('/store-application', [AthleteScholarshipController::class, 'storeApplication'])->name('athlete.store-application');

        Route::get('/video-progress/{id}', [AthleteManageVedioController::class, 'videoProgress']);

        // My Mentor
        Route::get('/my-mentor', [AthleteMentorController::class, 'index'])->name('athlete.mentor');
        Route::get('/feedback-list', [AthleteMentorController::class, 'feedbackList'])->name('athlete.feedback-list');
        Route::get('/add-feedback', [AthleteMentorController::class, 'addFeedback'])->name('athlete.feedback-add');
        Route::post('/store-feedback', [AthleteMentorController::class, 'storeFeedback'])->name('athlete.feedback-store');

        Route::get('/deactivate-my-account', [AthleteAuthController::class, 'deactivateView'])->name('athlete.deactivateView');
        Route::post('/deactivate', [AthleteAuthController::class, 'deactivate'])->name('athlete.deactivate');


    });
});