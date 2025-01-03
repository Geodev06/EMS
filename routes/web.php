<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\TimesheetController;
use App\Models\Timesheet;
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

Route::get('/template-1', function () {
    return view('templates.template_2');
    
});


Route::controller(GuestController::class)->group(function () {
    Route::get('/', 'login')->name('login');
   
    Route::get('/register', 'register')->name('register');

});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('auth');
    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::get('/join-events', 'joined_events')->name('joined_events')->middleware('auth');
    Route::get('/certificates-templates', 'certificates')->name('certificates')->middleware('auth');


    Route::get('/organizer', 'organizer')->name('organizer')->middleware('auth');

    Route::get('/events', 'events')->name('events')->middleware('auth');
    Route::get('/event-form/{id?}', 'event_form')->name('event.form')->middleware('auth');
    Route::get('/attendees/{id}', 'attendees')->name('attendees')->middleware('auth');
    Route::get('/event-attachtments/{id}', 'event_attachtments')->name('event_attachtments')->middleware('auth');


    Route::get('/preview-template', 'template_preview')->name('template_preview')->middleware('auth');
    Route::post('/upload-signature', 'upload_signature')->name('upload_signature')->middleware('auth');


});
Route::controller(JoinedEventsController::class)->group(function () {
    Route::post('/submit-join', 'join')->name('join')->middleware('auth');
});
Route::controller(TimesheetController::class)->group(function () {
    Route::get('/event-time-sheet/{id}', 'time_sheet')->name('time_sheet')->middleware('auth');
    Route::post('/time_in', 'time_in')->name('time_in')->middleware('auth');
});
