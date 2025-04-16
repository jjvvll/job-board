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

// Route::get('/', function () {
//     return view('welcome');
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

    Route::resource('employer', EmployerController::class)
        ->only(['create', 'store']);

    Route::resource('my-jobs', MyJobController::class)->middleware(\App\Http\Middleware\Employer::class);

    Route::get('/cv/{application}', [CvController::class, 'show'])
    ->middleware(\App\Http\Middleware\Employer::class)
    ->name('cv.view');
});
