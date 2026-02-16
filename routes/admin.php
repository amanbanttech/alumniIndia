<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminUniversityController;




Route::prefix('admin')->group(function () {

    //for login view file

    Route::middleware(['roleRedirect'])->group(function () {
        Route::get('/login', [AdminAuthController::class, 'loginView'])->name('admin.login.view');
        Route::post('/login', [AdminAuthController::class, 'loginSubmit'])->name('admin.login.submit');

        Route::get('/forgot-password', [AdminAuthController::class, 'forgotPasswordView'])->name('admin.forgot.password.view');
        Route::post('/forgot-password', [AdminAuthController::class, 'forgotPasswordSubmit'])->name('admin.forgot.password.submit');

        Route::get('/reset-password/{token}', [AdminAuthController::class, 'resetPasswordView'])->name('admin.resetPassword.view');
        Route::post('/reset-password', [AdminAuthController::class, 'resetPasswordSubmit'])->name('admin.resetPassword.submit');
    });


    Route::middleware(['is_admin'])->group(function () {




        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('admin.dashboard');

        Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

        // PROFILE
        Route::get('/profile', [AdminProfileController::class, 'edit'])->name('admin.profile.view');
        Route::post('/profile/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');

        // PASSWORD
        Route::get('/password/edit', [AdminProfileController::class, 'editpassword'])->name('admin.password.edit');
        Route::post('/password/update', [AdminProfileController::class, 'updatepassword'])->name('admin.password.update');

        // MANAGE UNIVERSITY
        Route::get('/university-list', [AdminUniversityController::class, 'universitylist'])->name('admin.university.list');
        Route::get('/university-add', [AdminUniversityController::class, 'add'])->name('admin.university.add');
        Route::post('/university-store', [AdminUniversityController::class, 'store'])->name('admin.university.store');
        Route::post('/university/send-otp',[AdminUniversityController::class, 'sendOtp'])->name('admin.university.sendOtp');
        Route::post( '/university/verify-otp',[AdminUniversityController::class, 'verifyOtp'])->name('admin.university.verifyOtp');
        Route::get('/university-edit/{id}',[AdminUniversityController::class, 'edit'])->name('admin.university.edit');
        Route::put('/admin/university-update/{id}', [AdminUniversityController::class, 'update'])->name('admin.university.update');
        Route::get('/university-view/{id}', [AdminUniversityController::class, 'view'])->name('admin.university.view');





    });

});