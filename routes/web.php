<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\HouseholdController;
use Illuminate\Support\Facades\Route;

// Public home page
Route::get('/', function () {
    return view('welcome');
});

// Dashboard (protected)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Member routes (protected)
Route::middleware('auth')->group(function () {
    Route::resource('members', MemberController::class);
    Route::resource('households', HouseholdController::class);
    
    // Household member management
    Route::post('households/{household}/members', [HouseholdController::class, 'addMember'])
        ->name('households.members.add');
    Route::delete('households/{household}/members/{member}', [HouseholdController::class, 'removeMember'])
        ->name('households.members.remove');
    Route::patch('households/{household}/members/{member}', [HouseholdController::class, 'updateMember'])
        ->name('households.members.update');
});

// Profile routes (from Breeze)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';