<?php

use App\Http\Controllers\User\Auth\AuthController;
use App\Http\Controllers\User\Course\CourseController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\Lab\LabController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'index')
        ->name('user.auth.index');
    Route::get('/register', 'registerIndex')
        ->name('user.auth.register-index');
    Route::post('/login', 'login')
        ->name('user.auth.login');
    Route::post('/register', 'register')
        ->name('user.auth.register');
    Route::post('/logout', 'logout')
        ->name('user.auth.logout');
});

Route::controller(HomeController::class)->group(function() {
    Route::get('/', 'index')
        ->name('user.index')
        ->middleware('auth:user');
});

Route::controller(CourseController::class)->group(function() {
    Route::get('/accept-invite', 'acceptInvite')
        ->name('user.courses.accept-invite');
});

Route::controller(LabController::class)->group(function() {
    Route::post('/labs/{lab}/submit', 'submit')
        ->name('user.labs.submit')
        ->middleware('auth:user')
        ->withoutMiddleware(VerifyCsrfToken::class);
});
