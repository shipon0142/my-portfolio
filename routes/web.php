<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/contact', ContactController::class)->name('contact.send');
Route::post('/track', TrackController::class)->middleware('throttle:20,1');
