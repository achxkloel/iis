<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\StudiesOverviewController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main
Route::get('/', function () {
    return view('homepage', ['courses' => (new HomepageController())->get()]);
})->middleware('auth')->name('homepage');

// Login

Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'auth')->name('login');
});

// Logout
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Study overview
Route::get('/studies-overview', function () {
    return view('studiesOverview', ['courses' => (new StudiesOverviewController())->get()]);
})->middleware('auth')->name('studies-overview');

Route::get('/studies-overview/{courseId}', function ($courseId) {
    return view('courseOverview', ['course' => (new StudiesOverviewController())->getCourse($courseId)]);
})->middleware('auth')->name('course-overview');

//student schedule
Route::get('/schedule', function(){
    return view('schedule');
})->middleware('auth')->name('schedule');


// Profile
Route::get('/profile', function () {
    return view('profile');
})->middleware('auth')->name('profile');

// Profile edit
Route::get('/profile/edit', function () {
    return view('profile');
})->middleware('auth')->name('profile-edit');

// My courses
Route::get('/my-courses', function () {
    return view('myCourses');
})->middleware('auth')->name('my-courses');

// Course edit
Route::get('/course-edit/{courseId}', function ($courseId) {
    return view('courseEdit', ['course' => (new StudiesOverviewController())->getCourse($courseId)]);
})->middleware('auth')->name('course-edit');

Route::get('/registration-management/{courseId}', function ($courseId) {
    return view('registrationManagement', ['course' => (new StudiesOverviewController())->getCourse($courseId)]);
})->middleware('auth')->name('registration-management');

// Admin
Route::prefix('admin')
    ->name('admin-')
    ->middleware('auth', 'role:admin')
    ->controller(AdminController::class)
    ->group(function () {
        Route::get('/persons', 'showPersons')->name('persons');
        Route::get('/person/create', 'showPersonForm')->name('create-person');
        Route::get('/classes', 'showClasses')->name('classes');
    });