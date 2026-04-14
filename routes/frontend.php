<?php



use App\Http\Controllers\Frontend\HomePageController;
use Illuminate\Support\Facades\Route;


Route::get('/about', [HomePageController::class, 'about'])
    ->name('frontend.about');

Route::get('/contact-us', [HomePageController::class, 'contactUs'])
    ->name('frontend.contactus');


Route::get('/mentorship-program', [HomePageController::class, 'mentorshipProgram'])
    ->name('frontend.mentorshipprogram');


Route::get('/donation', [HomePageController::class, 'donation'])
    ->name('frontend.donation');
Route::get('/event', [HomePageController::class, 'eventDetail'])
    ->name('frontend.event');
Route::get('/scholarship-and-events', [HomePageController::class, 'scholarshipEvent'])
    ->name('frontend.scholarshipandevents');

Route::get('/blog', [HomePageController::class, 'blog'])
    ->name('frontend.blog');

Route::get('/workshop', [HomePageController::class, 'workshop'])
    ->name('frontend.workshop');
Route::get('/past-events', [HomePageController::class, 'pastEvents'])
    ->name('frontend.pastEvents');

    Route::get('/privacy-policy', [HomePageController::class, 'privacyPolicy'])
    ->name('frontend.privacypolicy');

    Route::get('/terms-and-conditions', [HomePageController::class, 'termsAndConditions'])
    ->name('frontend.termsandconditions');

    Route::get('/university-details', [HomePageController::class, 'universityDetails'])
    ->name('university.details');

    Route::get('/upcoming-events', [HomePageController::class, 'upcomingEvents'])
    ->name('frontend.upcomingevents');

    Route::get('/find-university', [HomePageController::class, 'findUniversity'])
    ->name('frontend.finduniversity');

