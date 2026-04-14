<?php


use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return view('frontend.index');
})->name('frontend.index');



require __DIR__ . '/admin.php';
require __DIR__ . '/university.php';
require __DIR__ . '/athlete.php';
require __DIR__ . '/subUniversity.php';
require __DIR__ . '/mentor.php';
require __DIR__ . '/frontend.php';





