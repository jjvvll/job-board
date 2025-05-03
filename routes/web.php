<?php

use App\Http\Controllers\JobController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\MyJobApplicationsController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\EmployerController;
use App\Http\Controllers\JobApplicationController;
use App\Http\Controllers\MyJobController;
use Database\Factories\EmployerFactory;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\CvController;
use Illuminate\Support\Facades\Route;
use App\Events\JobStatusUpdated;
use App\Events\TestBroadcast;
// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/trigger-test-event', function () {
//     event(new TestBroadcast('Hello, this is a test message'));
//     return 'Test event triggered!';
// });

// Route::get('/test-broadcast', function () {
//        $jobApplication = MyJobApplicationsController::find(1); // Use any valid ID from your DB

//     if (!$jobApplication) {
//         return 'Job application not found.';
//     }

//     broadcast(new JobStatusUpdated($jobApplication));
//     return 'Broadcast sent!';
// });

Route::get('', fn() => to_route('jobs.index'));


Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request')->middleware(\App\Http\Middleware\IfAuth::class);
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email')->middleware(\App\Http\Middleware\IfAuth::class);

Route::get('reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset')->middleware(\App\Http\Middleware\IfAuth::class);
Route::post('reset-password', [ResetPasswordController::class, 'reset'])->name('password.update')->middleware(\App\Http\Middleware\IfAuth::class);

Route::resource('register', UserController::class)->middleware(\App\Http\Middleware\IfAuth::class);

Route::get('login', fn() => to_route('auth.create'))->name('login');
Route::resource('auth', AuthController::class)
    ->only(['create', 'store'] )->middleware(\App\Http\Middleware\IfAuth::class);

Route::get('logout', fn() => to_route('auth.destroy'))->name('logout');
Route::delete('auth', [AuthController::class, 'destroy'])
    ->name('auth.destroy');

Route::resource('jobs', JobController::class)
    ->only(['index', 'show']);

Route::middleware('auth')->group(function() {
    Route::resource('job.application', JobApplicationController::class)
        ->only(['create', 'store']);

    Route::resource('my-job-applications', MyJobApplicationsController::class)
        ->only(['index', 'destroy']);

    // Custom route for jobStatus
    Route::get('/my-job-applications/{myJobApplication}/status/{stat}', [MyJobApplicationsController::class, 'jobStatus'])
    ->name('my-job-applications.jobStatus');

    // Apply middleware only to 'create'
    Route::get('employer/create', [EmployerController::class, 'create'])
    ->middleware(\App\Http\Middleware\RedirectIfEmployer::class)
    ->name('employer.create');

    // No middleware on store
    Route::post('employer', [EmployerController::class, 'store'])
    ->name('employer.store');

    // Route::resource('employer', EmployerController::class)
    //     ->only(['create', 'store']);

    Route::resource('my-jobs', MyJobController::class)->middleware(\App\Http\Middleware\Employer::class);

    Route::get('/cv/{application}', [CvController::class, 'show'])
    ->middleware(\App\Http\Middleware\Employer::class)
    ->name('cv.view');

    Route::post('/jobs/bulk-delete', [MyJobController::class, 'bulkDelete'])->middleware(\App\Http\Middleware\Employer::class)
    ->name('jobs.bulk.delete');

});
