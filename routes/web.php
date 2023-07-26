<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApplicantController;

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
    return view('welcome');
});

Route::get('/applicants/search', 'ApplicantController@search')->name('applicants.search');

Route::resource('applicants', ApplicantController::class);

// Route::get('/register', 'ApplicantController@showRegistrationForm')->name('register');
// Route::post('/register', 'ApplicantController@register')->name('register');

// Route::get('login', [ApplicantController::class, 'showLoginForm'])->name('login');
// Route::post('login', [ApplicantController::class, 'login'])->name('login');
// Route::get('logout', [ApplicantController::class, 'logout'])->name('logout');




