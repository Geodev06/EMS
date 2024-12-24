<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
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

Route::controller(GuestController::class)->group(function() {
    Route::get('/','login')->name('login');
    Route::get('/register','register')->name('register');
});

Route::controller(DashboardController::class)->group(function() {
    Route::get('/dashboard','dashboard')->name('dashboard');
    Route::get('/profile','profile')->name('profile');


    Route::get('/organizer','organizer')->name('organizer');

    Route::get('/events','events')->name('events');
    Route::get('/event-form/{id?}','event_form')->name('event.form');



});