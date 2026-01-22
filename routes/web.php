<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\RoomController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/kamar/{room:slug}', [HomeController::class, 'show'])->name('rooms.show');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', function () {
        $totalRooms = \App\Models\Room::count();
        $totalCustomers = \App\Models\User::where('role', 'customer')->count();
        $availableRooms = \App\Models\Room::where('status', 'available')->count();

        // Revenue calculations
        $activeBookings = \App\Models\Booking::where('status', 'active')->count();
        $monthlyRevenue = \App\Models\Booking::where('payment_status', 'paid')
            ->whereMonth('created_at', now()->month)
            ->sum('total_price');

        // Recent activity
        $recentBookings = \App\Models\Booking::with(['user', 'room'])->latest()->take(5)->get();

        // Late Payment Notification (Pending payment > 5 days from start date)
        $overdueBookings = \App\Models\Booking::with(['user', 'room'])
            ->where('status', 'active')
            ->where('payment_status', 'pending')
            ->where('start_date', '<', now()->subDays(5))
            ->get();

        return view('admin.dashboard', compact('totalRooms', 'totalCustomers', 'availableRooms', 'activeBookings', 'monthlyRevenue', 'recentBookings', 'overdueBookings'));
    })->name('dashboard');

    Route::resource('rooms', RoomController::class);

    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class);
    Route::post('customers/{id}/toggle-status', [\App\Http\Controllers\Admin\CustomerController::class, 'toggleStatus'])->name('customers.toggle-status');

    Route::resource('landing-infos', \App\Http\Controllers\Admin\LandingInfoController::class);
});

// Customer Routes
Route::middleware(['auth', 'role:customer'])->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', function () {
        $bookings = auth()->user()->bookings()->with('room')->latest()->get();
        $activeBooking = auth()->user()->bookings()->where('status', 'active')->first();
        return view('customer.dashboard', compact('bookings', 'activeBooking'));
    })->name('dashboard');
});

// Redirect /dashboard based on role (optional, but good for UX)
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('customer.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';