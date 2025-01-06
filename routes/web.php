<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuestController;
use App\Http\Controllers\JoinedEventsController;
use App\Http\Controllers\TimesheetController;
use App\Models\Timesheet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
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

    Route::get('/get-analytics', 'get_analytics')->middleware('auth');


});

Route::controller(DashboardController::class)->group(function () {
    Route::get('/dashboard', 'dashboard')->name('dashboard')->middleware('auth');
    Route::get('/profile', 'profile')->name('profile')->middleware('auth');
    Route::get('/account-settings', 'account_settings')->name('account_settings')->middleware('auth');

    Route::get('/join-events', 'joined_events')->name('joined_events')->middleware('auth');
    Route::get('/certificates-templates', 'certificates')->name('certificates')->middleware('auth');
    Route::get('/evaluations-questions', 'evaluations')->name('evaluations')->middleware('auth');

    Route::get('/organizer', 'organizer')->name('organizer')->middleware('auth');

    Route::get('/events', 'events')->name('events')->middleware('auth');
    Route::get('/event-form/{id?}', 'event_form')->name('event.form')->middleware('auth');
    Route::get('/attendees/{id}', 'attendees')->name('attendees')->middleware('auth');
    Route::get('/event-attachtments/{id}', 'event_attachtments')->name('event_attachtments')->middleware('auth');

    Route::get('/preview-template', 'template_preview')->name('template_preview')->middleware('auth');
    Route::post('/upload-signature', 'upload_signature')->name('upload_signature')->middleware('auth');

    Route::get('/event-evaluation/{id}', 'event_evaluation')->name('event_evaluation')->middleware('auth');
    Route::post('/submit-evaluation', 'submit_evaluation')->name('submit_evaluation')->middleware('auth');

    Route::get('/certification/{id}', 'certification')->name('certification')->middleware('auth');
    
    Route::get('/render-template', 'render_template')->name('render_template')->middleware('auth');


});
Route::controller(JoinedEventsController::class)->group(function () {
    Route::post('/submit-join', 'join')->name('join')->middleware('auth');
});
Route::controller(TimesheetController::class)->group(function () {
    Route::get('/event-time-sheet/{id}', 'time_sheet')->name('time_sheet')->middleware('auth');
    Route::post('/time_in', 'time_in')->name('time_in')->middleware('auth');
});

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
        ? back()->with(['status' => __($status)])
        : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

Route::get('/reset-password/{token}', function (string $token, Request $request) {

    return view('auth.reset-password', ['token' => $token, 'email' => $request->email]);
})->middleware('guest')->name('password.reset');

Route::post('/update-reset-password', function (Request $request) {

    $request->validate(['email' => 'required|email', 'password' => 'required|min:6|confirmed']);


    $data = [
        'email' => $request->email,
        'password' => Hash::make($request->password)
    ];

    $success =  User::where('email', $request->email)->update($data);

    if ($success) {
        session()->flash('success_reset','Password has been reset successfully');
        return redirect()->route('login');
    } else {
        return back()->with(['status' => 'Something went wrong please contact administrator']);
    }

})->middleware('guest')->name('update_reset_password');
