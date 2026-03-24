<?php

use App\Http\Controllers\DestinationController;
use Illuminate\Support\Facades\Route;

// Home Page
Route::get('/', function () {
    return view('home');
})->name('home');

// Show all destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');

// Search destinations
Route::get('/destinations/search', [DestinationController::class, 'search'])->name('destinations.search');

// Show single destination (DETAIL PAGE)
Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');