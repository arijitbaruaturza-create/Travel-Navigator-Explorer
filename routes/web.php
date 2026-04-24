<?php

use App\Http\Controllers\RoomController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use Illuminate\Support\Facades\Route;

// Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Destinations
Route::get('/destinations', [DestinationController::class, 'index'])->name('destinations.index');
Route::get('/destinations/search', [DestinationController::class, 'search'])->name('destinations.search');
Route::get('/destinations/{id}', [DestinationController::class, 'show'])->name('destinations.show');

// Rooms
Route::get('/rooms', [RoomController::class, 'index'])->name('rooms.index');
Route::post('/rooms', [RoomController::class, 'store']);
Route::get('/rooms/delete/{id}', [RoomController::class, 'delete']);
Route::get('/rooms/edit/{id}', [RoomController::class, 'edit']);
Route::post('/rooms/update/{id}', [RoomController::class, 'update']);
Route::get('/rooms/{id}', [RoomController::class, 'show']);

// Cost
Route::get('/cost', [RoomController::class, 'costForm']);
Route::post('/cost/calculate', [RoomController::class, 'calculateCost']);

// Blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

// Admin
Route::get('/admin/register', [AdminAuthController::class, 'showRegister']);
Route::post('/admin/register', [AdminAuthController::class, 'register']);

Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/admin/logout', [AdminAuthController::class, 'logout']);

Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/admin/room/{id}', [AdminController::class, 'show']);
Route::get('/admin/approve/{id}', [AdminController::class, 'approve']);
Route::get('/admin/reject/{id}', [AdminController::class, 'reject']);

// Customer auth
use App\Http\Controllers\Customer\AuthController;

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ✅ FIXED: ONLY ONE dashboard route
Route::get('/dashboard', function () {
    return view('customer.dashboard');
})->middleware('auth')->name('dashboard');

// Room search
Route::get('/search-rooms', [RoomController::class, 'search'])->name('rooms.search');