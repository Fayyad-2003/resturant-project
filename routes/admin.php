<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SliderController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {

    /* auth routes */

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // ------------   Slider Routes --------------------

    Route::resource('sliders', SliderController::class);
});
