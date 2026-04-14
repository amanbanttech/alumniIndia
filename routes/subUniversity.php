<?php

use App\Http\Controllers\SubUniversity\SubUniversityAuthController;


use Illuminate\Support\Facades\Route;

Route::prefix('subUniversity')->group(function () {

        Route::get('/login', [SubUniversityAuthController::class, 'loginView'])
            ->name('subUniversity.login.view');


});