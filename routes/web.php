<?php

use App\Http\Controllers\HomepageController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\StudiesOverviewController;
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
