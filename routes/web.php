<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\SessionsController;
use App\Http\Middleware\EnsureTenantIsApproved;
use App\Http\Middleware\EnsureUserIsAdmin;

Route::view('/', 'welcome');
Route::view('pending-approval', 'auth.pending')->name('pending');

Route::controller(UsersController::class)->group(function () {
    Route::get('register', 'create')->name('users.create');
    Route::post('register', 'store')->name('users.store');

    Route::middleware(['auth', EnsureUserIsAdmin::class])->group(function () {
        Route::get('users', 'index')->name('users.index');
        Route::put('users/{user}/approve', 'approve')->name('users.approve');
        Route::put('users/{user}/ban', 'ban')->name('users.ban');
    });
});

Route::controller(SessionsController::class)->group(function () {
    Route::get('login', 'create')->name('login');
    Route::post('login', 'store')->name('sessions.store');
});

Route::controller(PostsController::class)->middleware(['auth', EnsureTenantIsApproved::class])->prefix('posts')->name('posts.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('/', 'store')->name('store');
    Route::get('{post}', 'show')->name('show');
    Route::get('{post}/edit', 'edit')->name('edit');
    Route::put('{post}', 'update')->name('update');
    Route::delete('{post}', 'destroy')->name('destroy');
});
