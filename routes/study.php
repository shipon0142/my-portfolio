<?php

use App\Http\Controllers\Admin\Study\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\StudyController;
use Illuminate\Support\Facades\Route;

// Auth
Route::middleware('guest')->group(function () {
    Route::get('/admin/login',  [LoginController::class, 'show'])->name('admin.login.show');
    Route::post('/admin/login', [LoginController::class, 'login'])
        ->middleware('throttle:5,1')
        ->name('admin.login');
});

Route::post('/admin/logout', [LoginController::class, 'logout'])
    ->middleware('auth')
    ->name('admin.logout');

// Admin CMS
Route::middleware(['auth', 'admin'])
    ->prefix('admin/study')
    ->name('admin.study.')
    ->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('topics', \App\Http\Controllers\Admin\Study\TopicController::class);
        Route::resource('topics.pages', \App\Http\Controllers\Admin\Study\PageController::class)
            ->scoped(['page' => 'slug']);
        Route::post('pages/{page:id}/publish',   [\App\Http\Controllers\Admin\Study\PageController::class, 'publish'])->name('pages.publish');
        Route::post('pages/{page:id}/unpublish', [\App\Http\Controllers\Admin\Study\PageController::class, 'unpublish'])->name('pages.unpublish');
        Route::post('uploads', [\App\Http\Controllers\Admin\Study\UploadController::class, 'store'])->name('uploads');
    });

// Study read routes — admin-only for now. Remove the middleware group to expose publicly later.
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/study', [StudyController::class, 'index'])->name('study.index');
    Route::get('/study/{topic:slug}', [StudyController::class, 'show'])->name('study.topic');
    Route::get('/study/{topic:slug}/{page:slug}', [StudyController::class, 'page'])
        ->scopeBindings()
        ->name('study.page');
});
