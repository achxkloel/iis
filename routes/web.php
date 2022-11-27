<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\MyCoursesController;
use App\Http\Controllers\StudiesOverviewController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\ProfileController;
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

    // Main page (for all users)
    Route::get('/regCourse/{courseID}', [HomepageController::class, 'regCourse'])->name('homepage-regcourse');

    // Logout
    Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');

    // Study overview page
    Route::get('/studies-overview', [StudiesOverviewController::class, 'getRegCourses'])->name('studies-overview');
    Route::get('/studies-overview/{courseId}', [StudiesOverviewController::class, 'getCourse'])->name('course-overview');
    Route::get('/studies-overview/reg/{courseId}/{termId}', [StudiesOverviewController::class, 'regTerm'])->name('course-overview-regterm');
    Route::get('/studies-overview/unreg/{courseId}/{termId}', [StudiesOverviewController::class, 'unregTerm'])->name('course-overview-unregterm');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile');

    // Schedule
    Route::get('/schedule', [ScheduleController::class, 'get'])->name('schedule');

    // All roles except student
    Route::middleware('hasRole:teacher')->group(function () {
        // Courses
        Route::get('/my-courses', [MyCoursesController::class, 'get'])->name('my-courses');
        Route::get('/course-edit/{courseId}', [MyCoursesController::class, 'getCourse'])->name('course-edit')->where('courseId', '[0-9]+');
        Route::post('/course-edit/{courseId}', [MyCoursesController::class, 'updateCourse'])->name('course-edit')->where('courseId', '[0-9]+');
        Route::get('/course-create', [MyCoursesController::class, 'newCourse'])->name('course-create');
        Route::post('/course-create', [MyCoursesController::class, 'createCourse'])->name('course-create');
        Route::get('/registration-management/{courseId}', [MyCoursesController::class, 'getCourseRegistrations'])->name('registration-management')->where('courseId', '[0-9]+');
        Route::get('/add-teacher/{courseId}', [MyCoursesController::class, 'addTeacher'])->name('add-teacher')->where('courseId', '[0-9]+');
        Route::get('/delete-teacher', [MyCoursesController::class, 'deleteTeacher'])->name('delete-teacher')->where('teacherCourseId', '[0-9]+');

        // Terms
        Route::get('/course-edit/{courseId}/term-edit/{termId}', [MyCoursesController::class, 'getTerm'])->name('course-edit-term')->where(['courseId' => '[0-9]+', 'termId' => '[0-9]+']);
        Route::post('/course-edit/{courseId}/term-edit/{termId}', [MyCoursesController::class, 'updateTerm'])->name('course-edit-term')->where(['courseId' => '[0-9]+', 'termId' => '[0-9]+']);
        Route::get('/course-edit/{courseId}/term-create', [MyCoursesController::class, 'newTerm'])->name('course-new-term')->where('courseId', '[0-9]+');
        Route::post('/course-edit/{courseId}/term-create', [MyCoursesController::class, 'createTerm'])->name('course-new-term')->where('courseId', '[0-9]+');
        Route::get('/course-delete', [MyCoursesController::class, 'deleteCourseTerm'])->name('course-delete-term')->where(['courseId' => '[0-9]+', 'termId' => '[0-9]+']);
    });

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
            Route::get('/person/{personId}', 'showPerson')->name('person')->where('personId', '[0-9]+');
            Route::post('/person/{personId}/update', 'updatePerson')->name('update-person')->where('personId', '[0-9]+');
            Route::post('/person/{personId}/setPassword', 'setNewPassword')->name('person-set-password')->where('personId', '[0-9]+');
            Route::get('/person/{personId}/course/{courseId}', 'showPersonCourse')->name('person-course')->where(['personId' => '[0-9]+', 'courseId' => '[0-9]+']);
            Route::get('/person/{personId}/addStudentCourse', 'addPersonStudentCourse')->name('person-add-student-course')->where('personId', '[0-9]+');
            Route::get('/person/{personId}/addTeacherCourse', 'addPersonTeacherCourse')->name('person-add-teacher-course')->where('personId', '[0-9]+');
            Route::get('/person/deleteTeacherCourse', 'deletePersonTeacherCourse')->name('person-del-teacher-course');
            Route::get('/person/deleteStudentCourse', 'deletePersonStudentCourse')->name('person-del-student-course');

            // Classes
            Route::get('/classes', 'showClasses')->name('classes');
            Route::get('/class/create', 'showClassForm')->name('create-class');
            Route::post('/class/create', 'createNewClass')->name('create-class');
            Route::delete('/class/delete', 'deleteClass')->name('delete-class');
        });
});
