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

// Main page (for all users)
Route::get('/', [HomepageController::class, 'getCourses'])->name('homepage');

// Only for guests
Route::middleware('guest')->controller(LoginController::class)->group(function () {
    // Login page
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'auth')->name('login');

    // Account activation page
    Route::get('/activate', 'showActivatePage')->name('activate');
    Route::post('/activate', 'activatePerson')->name('activate');
});

// Only for authorized users
Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Study overview page
    Route::get('/studies-overview', [StudiesOverviewController::class, 'get'])->name('studies-overview');
    Route::get('/studies-overview/{courseId}', [StudiesOverviewController::class, 'getCourse'])->name('course-overview');

    // Profile
    Route::get('/profile', fn() => view('profile'))->name('profile');

    //student schedule
Route::get('/schedule', function(){
    return view('schedule');
})->middleware('auth')->name('schedule');

    // Profile edit
    Route::get('/profile/edit', fn() => view('profile'))->name('profile-edit');

    // All roles except student
    Route::middleware('hasRole:teacher')->group(function () {
        // Courses
        Route::get('/my-courses', [MyCoursesController::class, 'get'])->name('my-courses');
        Route::get('/course-edit/{courseId}', [MyCoursesController::class, 'getCourse'])->name('course-edit');
        Route::post('/course-edit/{courseId}', [MyCoursesController::class, 'updateCourse'])->name('course-edit');
        Route::get('/course-create', [MyCoursesController::class, 'newCourse'])->name('course-create');
        Route::post('/course-create', [MyCoursesController::class, 'createCourse'])->name('course-create');
        Route::get('/registration-management/{courseId}', [MyCoursesController::class, 'getCourseRegistrations'])->name('registration-management');

        // Terms
        Route::get('/course-edit/{courseId}/term-edit/{termId}', [MyCoursesController::class, 'getTerm'])->name('course-edit-term');
        Route::get('/course-edit/{courseId}/term-create', [MyCoursesController::class, 'newTerm'])->name('course-new-term');
        Route::post('/course-edit/{courseId}/term-create', [MyCoursesController::class, 'createTerm'])->name('course-new-term');
        Route::get('/course-delete/{courseId}/{termId}', [MyCoursesController::class, 'deleteCourseTerm'])->name('course-delete-term');
    });

    // Admin page
    Route::prefix('admin')
        ->name('admin-')
        ->middleware('role:admin')
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
    });
});
