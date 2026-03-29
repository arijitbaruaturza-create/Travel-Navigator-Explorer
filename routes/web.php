<?php
use App\Http\Controllers\RoomController;

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
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/delete/{id}', [RoomController::class, 'delete']);
Route::get('/rooms/edit/{id}', [RoomController::class, 'edit']);
Route::post('/rooms/update/{id}', [RoomController::class, 'update']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

Route::get('/cost', [RoomController::class, 'costForm']);
Route::post('/cost/calculate', [RoomController::class, 'calculateCost']);