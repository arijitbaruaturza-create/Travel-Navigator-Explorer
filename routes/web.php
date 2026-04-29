<?php
use App\Http\Controllers\BookingController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\GuideController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\GuideAuthController;
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

// Tours & Guide routes
Route::get('/guides', [GuideController::class, 'index'])->name('guides.index');
Route::get('/guides/apply', [GuideController::class, 'create'])->name('guides.apply');
Route::post('/guides/apply', [GuideController::class, 'store'])->name('guides.store');
Route::get('/guides/{id}', [GuideController::class, 'show'])->name('guides.show');
Route::post('/guides/{id}/hire', [BookingController::class, 'store'])->name('guides.hire');
Route::get('/guides/{id}/chat', [MessageController::class, 'show'])->name('guides.chat');
Route::get('/guides/{id}/messages', [MessageController::class, 'index'])->name('guides.messages');
Route::post('/guides/{id}/messages', [MessageController::class, 'store'])->name('guides.messages.store');
Route::post('/guides/{id}/reviews', [ReviewController::class, 'store'])->name('guides.reviews.store');

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

// Admin guide approvals
Route::get('/admin/guides', [AdminController::class, 'guides']);
Route::get('/admin/guides/{id}', [AdminController::class, 'showGuide']);
Route::get('/admin/guides/{id}/approve', [AdminController::class, 'approveGuide']);
Route::get('/admin/guides/{id}/reject', [AdminController::class, 'rejectGuide']);

// Guide Auth
Route::get('/guide/login', [GuideAuthController::class, 'showLogin']);
Route::post('/guide/login', [GuideAuthController::class, 'login']);
Route::get('/guide/logout', [GuideAuthController::class, 'logout']);

// Guide Dashboard (protected)
Route::prefix('guide')->middleware('guide.auth')->group(function () {
    Route::get('/dashboard', [GuideAuthController::class, 'dashboard']);
    Route::get('/booking/{id}/confirm', [GuideAuthController::class, 'confirmBooking']);
    Route::get('/booking/{id}/cancel', [GuideAuthController::class, 'cancelBooking']);
    Route::get('/booking/{id}/complete', [GuideAuthController::class, 'completeBooking']);
    Route::get('/chat/{email}', [GuideAuthController::class, 'chatWithGuest']);
});

Route::get('/travel-budget', [RoomController::class, 'travelBudgetForm']);
Route::post('/travel-budget/calculate', [RoomController::class, 'travelBudgetCalculate']);


Route::get('/hotels', [HotelController::class, 'index'])->name('hotels.index');
Route::post('/hotels', [HotelController::class, 'store']);

Route::delete('/hotels/{id}', [HotelController::class, 'destroy']);