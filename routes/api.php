<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\api\PolicyController;
use App\Http\Controllers\Api\UniversityController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/university-dashboard', [UniversityController::class, 'dashboard']);

    Route::post('/university-send-otp', [UniversityController::class, 'sendOtp']);
    Route::post('/university-verify-otp', [UniversityController::class, 'verifyOtp']);

    // University Profile
    Route::get('/state-list', [UniversityController::class, 'stateList']);
    Route::get('/university-profile', [UniversityController::class, 'editProfile']);
    Route::post('/update-university-profile/{id}', [UniversityController::class, 'updateProfile']);

    //sub-university
    Route::get('/sub-universities', [UniversityController::class, 'subUniversityList']);
    Route::post('/store-sub-university', [UniversityController::class, 'storeSubUniversity']);
    Route::get('/edit-sub-university/{id}', [UniversityController::class, 'editSubUniversity']);
    Route::post('/update-sub-university/{id}', [UniversityController::class, 'updateSubUniversity']);


    // University Course
    Route::get('/course-list', [UniversityController::class, 'courseList']);
    Route::get('/edit-course', [UniversityController::class, 'editCourse']);
    Route::post('/update-course', [UniversityController::class, 'updateCourse']);

    // University Sport
    Route::get('/sport-category-list', [UniversityController::class, 'sportCategoryList']);
    Route::get('/sport-list', [UniversityController::class, 'sportList']);
    Route::post('/store-sport', [UniversityController::class, 'storeSport']);
    Route::get('/edit-sport/{id}', [UniversityController::class, 'editSport']);
    Route::post('/update-sport/{id}', [UniversityController::class, 'updateSport']);

    // University Mentor
    Route::get('/mentor-list', [UniversityController::class, 'mentorList']);
    Route::post('/store-mentor', [UniversityController::class, 'storeMentor']);
    Route::get('/edit-mentor/{id}', [UniversityController::class, 'editMentor']);
    Route::post('/update-mentor/{id}', [UniversityController::class, 'updateMentor']);


});


Route::get('/users', [LoginController::class, 'getUsers']);
Route::get('/privacy-policy', [PolicyController::class, 'show']);
Route::post('/deactivate', [LoginController::class, 'deactivateApi']);
Route::post('/send-otp', [LoginController::class, 'sendOtp']);
Route::post('/verify-otp', [LoginController::class, 'verifyOtp']);
Route::post('/login', [LoginController::class, 'login']);
