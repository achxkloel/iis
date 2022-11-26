<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MyCoursesController;
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
Route::get('/', [HomepageController::class, 'getCourses'])->middleware('auth')->name('homepage');

// Login
Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'auth')->name('login');
    Route::get('/activate', 'showActivatePage')->name('activate');
    Route::post('/activate', 'activatePerson')->name('activate');
});

// Logout
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

// Study overview
Route::get('/studies-overview', [StudiesOverviewController::class, 'get'])->middleware('auth')->name('studies-overview');

Route::get('/studies-overview/{courseId}', [StudiesOverviewController::class, 'getCourse'])->middleware('auth')->name('course-overview');

// Profile
Route::get('/profile', fn() => view('profile'))->middleware('auth')->name('profile');

// Profile edit
Route::get('/profile/edit', fn() => view('profile'))->middleware('auth')->name('profile-edit');

// My courses
Route::get('/my-courses', [MyCoursesController::class, 'get'])->middleware('auth')->name('my-courses');

// Course edit
Route::get('/course-edit/{courseId}', [MyCoursesController::class, 'getCourse'])->middleware('auth')->name('course-edit');
Route::post('/course-edit/{courseId}', [MyCoursesController::class, 'updateCourse'])->middleware('auth')->name('course-edit');
Route::get('/course-create', [MyCoursesController::class, 'newCourse'])->middleware('auth')->name('course-create');
Route::post('/course-create', [MyCoursesController::class, 'createCourse'])->middleware('auth')->name('course-create');
Route::get('/course-delete/{courseId}/{termId}', [MyCoursesController::class, 'deleteCourseTerm'])->middleware('auth')->name('course-delete-term');
Route::get('/registration-management/{courseId}', [MyCoursesController::class, 'getCourseRegistrations'])->middleware('auth')->name('registration-management');

// Admin
Route::prefix('admin')
    ->name('admin-')
    ->middleware('auth', 'role:admin')
    ->controller(AdminController::class)
    ->group(function () {
        // Users
        Route::get('/persons', 'showPersons')->name('persons');
        Route::get('/person/create', 'showPersonForm')->name('create-person');
        Route::post('/person/create', 'createNewPerson')->name('create-person');
        Route::delete('/person/delete', 'deletePerson')->name('delete-person');
        Route::post('/person/checkLogin', 'checkLogin')->name('check-login');

        // Classes
        Route::get('/classes', 'showClasses')->name('classes');
        Route::get('/class/create', 'showClassForm')->name('create-class');
        Route::post('/class/create', 'createNewClass')->name('create-class');
        Route::delete('/class/delete', 'deleteClass')->name('delete-class');
    });
