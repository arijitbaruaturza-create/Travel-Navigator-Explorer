<?php
use App\Http\Controllers\RoomController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
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

// Blog Routes
Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

// Admin Auth
Route::get('/admin/register', [AdminAuthController::class, 'showRegister']);
Route::post('/admin/register', [AdminAuthController::class, 'register']);

Route::get('/admin/login', [AdminAuthController::class, 'showLogin']);
Route::post('/admin/login', [AdminAuthController::class, 'login']);

Route::get('/admin/logout', [AdminAuthController::class, 'logout']);

// Admin Dashboard
Route::get('/admin/dashboard', [AdminController::class, 'index']);
Route::get('/admin/room/{id}', [AdminController::class, 'show']);
Route::get('/admin/approve/{id}', [AdminController::class, 'approve']);
Route::get('/admin/reject/{id}', [AdminController::class, 'reject']);

Route::get('/travel-budget', [RoomController::class, 'travelBudgetForm']);
Route::post('/travel-budget/calculate', [RoomController::class, 'travelBudgetCalculate']);


Route::get('/hotels', function () {
    return view('hotels');
})->name('hotels.index');
use App\Http\Controllers\HotelController;


Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::post('/hotels', [HotelController::class, 'store']);

Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);