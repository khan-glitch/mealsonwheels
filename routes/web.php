<?php


use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\CaregiverDashboardController;
use App\Http\Controllers\VolunteerDashboardController;
use App\Http\Controllers\PartnerDashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\DeliveryQuestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuestController;



// Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// General Dashboard (Fallback for authenticated users)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Role-based Dashboards
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/member/dashboard', [MemberDashboardController::class, 'index'])->name('member.dashboard');
    Route::get('/caregiver/dashboard', [CaregiverDashboardController::class, 'index'])->name('caregiver.dashboard');
    Route::get('/volunteer/dashboard', [VolunteerDashboardController::class, 'index'])->name('volunteer.dashboard');
    Route::get('/partner/dashboard', [PartnerDashboardController::class, 'index'])->name('partner.dashboard');
    Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
});

// Profile Management Routes (Only accessible to authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Delivery Quest Routes (Actions for Volunteers)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::post('/quests/{id}/accept', [DeliveryQuestController::class, 'accept'])->name('quests.accept');
    Route::post('/quests/{id}/pickup', [DeliveryQuestController::class, 'markPickup'])->name('quests.pickup');
    Route::post('/quests/{id}/delivery', [DeliveryQuestController::class, 'markDelivery'])->name('quests.delivery');
});

// Authentication Routes (Including login, registration, etc.)
require __DIR__.'/auth.php';

// Route for the volunteer dashboard
Route::get('/volunteer/dashboard', [VolunteerDashboardController::class, 'index'])->name('volunteer.dashboard');

Route::post('/quests/{id}/delivering', [DeliveryQuestController::class, 'updateToDelivering']);

Route::post('/quests/{id}/finish', [QuestController::class, 'finish'])->name('quests.finish');

Route::post('/quests/{quest}/finish', [QuestController::class, 'finish'])->name('quests.finish');
