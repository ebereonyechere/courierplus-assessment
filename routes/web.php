<?php

use App\Http\Controllers\ApiTokenController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SessionController;
use App\Http\Middleware\EnsureTenantIsApproved;
use App\Http\Middleware\EnsureTenantIsNotApproved;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::controller(UserController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('register', 'create')->name('users.create');
        Route::post('register', 'store')->name('users.store');
    });

    Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::put('users/{user}/approve', 'approve')->name('users.approve');
        Route::put('users/{user}/ban', 'ban')->name('users.ban');
    });
});

Route::controller(SessionController::class)->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('login', 'create')->name('login');
        Route::post('login', 'store')->name('sessions.store');
    });
    Route::middleware('auth')->delete('login', 'destroy')->name('sessions.destroy');
});

Route::middleware(['auth', EnsureTenantIsApproved::class])->group(function () {
    Route::controller(ApiTokenController::class)->group(function () {
        Route::get('api-token', 'index')->name('api-token.index');
        Route::post('api-token', 'store')->name('api-token.store');
    });

    Route::resource('posts', PostController::class);
    Route::get('/', [PostController::class, 'index']);
});
Route::middleware(EnsureTenantIsNotApproved::class)->get('pending-approval', function () {
    return view('auth.pending');
})->name('pending');
