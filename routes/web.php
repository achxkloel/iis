<?php

use App\Http\Controllers\TestController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
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
    return view('test', ['name' => (new TestController)->get()]);
})->middleware('auth');

// Login

Route::middleware('guest')->controller(LoginController::class)->group(function () {
    Route::get('/login', 'index')->name('login');
    Route::post('/login', 'auth')->name('login');
});

// Logout
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');