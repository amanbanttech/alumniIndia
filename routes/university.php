<?php

use App\Http\Controllers\University\UniversityAuthController;
use App\Http\Controllers\University\UniversityDashboardController;
use App\Http\Controllers\University\UniversityProfileController;
use App\Http\Controllers\University\SubUniversityController;
use App\Http\Controllers\University\ManageSportController;
use App\Http\Controllers\University\ManageMentorController;

use Illuminate\Support\Facades\Route;

Route::prefix('university')->group(function () {

    Route::middleware(['roleRedirect'])->group(function () {

        // ------------------- University Login -------------------

        Route::get('/login', [UniversityAuthController::class, 'loginView'])
            ->name('university.login.view');

        Route::post('/login', [UniversityAuthController::class, 'login'])
            ->name('university.login');
        Route::post('/send-login-otp', [UniversityAuthController::class, 'sendLoginOtp'])
            ->name('university.send.login.otp');

        Route::post('/verify-login-otp', [UniversityAuthController::class, 'verifyLoginOtp'])
            ->name('university.verify.login.otp');




    });

    Route::middleware(['is_university'])->group(function () {

        // Dashboard
        Route::get('/dashboard', [UniversityDashboardController::class, 'index'])
            ->name('university.dashboard');

        Route::get('/logout', [UniversityAuthController::class, 'logout'])
            ->name('university.logout');

                // PROFILE
        Route::get('/profile', [UniversityProfileController::class, 'edit'])->name('university.profile.view');
        Route::post('/profile/update/{id}', [UniversityProfileController::class, 'update'])->name('university.profile.update');

        // SUB UNIVERSITY
        Route::get('/sub-university/list', [SubUniversityController::class, 'universitylist'])->name('university.subUniversity.list');
        Route::get('/sub-university-add', [SubUniversityController::class, 'add'])->name('subUniversity.add');
        Route::post('/sub-university-store', [SubUniversityController::class, 'store'])->name('subUniversity.store');
        Route::post('/sub-university/send-otp',[SubUniversityController::class, 'sendOtp'])->name('subUniversity.sendOtp');
        Route::post( '/sub-university/verify-otp',[SubUniversityController::class, 'verifyOtp'])->name('subUniversity.verifyOtp');
        Route::get('/sub-university-edit/{id}',[SubUniversityController::class, 'edit'])->name('subUniversity.edit');
        Route::put('/sub-university-update/{id}', [SubUniversityController::class, 'update'])->name('subUniversity.update');

        // SPORT MANAGEMENT
        Route::get('/sport/list', [ManageSportController::class, 'sportlist'])->name('university.sport.list');
        Route::get('/sport/add', [ManageSportController::class, 'add'])->name('university.sport.add');
        Route::post('/sport/store', [ManageSportController::class, 'store'])->name('university.sport.store');
        Route::get('/sport/edit/{id}', [ManageSportController::class, 'edit'])->name('university.sport.edit');
        Route::put('/sport/update/{id}', [ManageSportController::class, 'update'])->name('university.sport.update');

        // MENTOR MANAGEMENT
        Route::get('/mentor/list', [ManageMentorController::class, 'mentorlist'])->name('university.mentor.list');
        Route::get('/mentor/add', [ManageMentorController::class, 'add'])->name('university.mentor.add');
        Route::post('/mentor/store', [ManageMentorController::class, 'store'])->name('university.mentor.store');
        Route::get('/mentor/edit/{id}', [ManageMentorController::class, 'edit'])->name('university.mentor.edit');
        Route::put('/mentor/update/{id}', [ManageMentorController::class, 'update'])->name('university.mentor.update');

    });

});