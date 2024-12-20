<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\CaregiverDashboardController;
use App\Http\Controllers\VolunteerDashboardController;
use App\Http\Controllers\PartnerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// General Dashboard (Fallback)
Route::get('/dashboard', function () {
    return view('welcome'); // Point to the updated view path
})->middleware(['auth', 'verified'])->name('dashboard');

//make donations
Route::get('/donor', [DonationController::class, 'index'])->name('donor.index');
    Route::get('/donor/payment/{method}', [DonationController::class, 'paymentForm'])->name('donor.payment');
    Route::post('/donor/donate', [DonationController::class, 'store'])->name('donor.store');
    Route::get('/payment/success', [DonationController::class, 'paymentSuccess'])->name('payment.success');

// Role-based Dashboards
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/caregiver/dashboard', [CaregiverDashboardController::class, 'index'])->name('caregiver.dashboard');
    Route::get('/volunteer/dashboard', [VolunteerDashboardController::class, 'index'])->name('volunteer.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/volunteer', [AdminDashboardController::class, 'fetchOrder'])->name('admin.volunteers');
    Route::get('/admin/donations', [DonationController::class, 'showDonationsForAdmin'])->name('admin.donations');
    Route::get('/partner/dashboard', [PartnerDashboardController::class, 'index'])->name('partner.dashboard');

    // CRUD operations for meals, handled within the partner dashboard
    Route::resource('partner/meals', PartnerDashboardController::class)
        ->except(['index']) // Exclude index, as it will be shown on the dashboard
        ->names([
            'create' => 'partner.meals.create',
            'store' => 'partner.meals.store',
            'show' => 'partner.meals.show',
            'edit' => 'partner.meals.edit',
            'update' => 'partner.meals.update',
            'destroy' => 'partner.meals.destroy',
        ]);
});
// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index'); // Accessible by anyone

// Group the routes requiring authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/orders/{meal}', [OrderController::class, 'placeOrder'])->name('order.place'); // Order only if logged in
});

Route::delete('/orders/{order}', [OrderController::class, 'cancelOrder'])->name('orders.cancel')->middleware('auth');




Route::middleware('auth')->prefix('volunteer')->group(function () {
    Route::get('/dashboard', [VolunteerDashboardController::class, 'index'])->name('volunteer.dashboard');
    Route::post('/orders/{orderId}/accept', [VolunteerDashboardController::class, 'acceptOrder'])->name('orders.accept');
    Route::post('/orders/{orderId}/deliver', [VolunteerDashboardController::class, 'deliverToPartner'])->name('orders.deliverToPartner');
    Route::post('/orders/{orderId}/delivered', [VolunteerDashboardController::class, 'markDelivered'])->name('orders.markDelivered');
});


Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/about', [PageController::class, 'about'])->name('about');
// Authentication Routes
require __DIR__.'/auth.php';

Route::get('/contact', [ContactController::class, 'index'])->name('contact');

Route::get('/about', [PageController::class, 'about'])->name('about');
