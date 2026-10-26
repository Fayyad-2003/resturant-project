<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\ProductSizeAndOptionController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\BlogPostController;
use App\Http\Controllers\Admin\ChefController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\WhyChooseUsController;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth', 'verified', 'role:admin'])->prefix('admin')->as('admin.')->group(function () {

    /* auth routes */

    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::put('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');

    // ------------   Slider Routes --------------------

    Route::resource('sliders', SliderController::class);

    // ------------   Why Choose Us Routes --------------------
    Route::put('/update-why-choose-us-titles', [WhyChooseUsController::class, 'updateSectionTitles'])->name('update-why-choose-us-titles');
    Route::resource('/why-choose-us', WhyChooseUsController::class);

    // ------------   Product Categories Routes --------------------
    Route::resource('/categories', CategoryController::class);

    // ------------   Products Routes --------------------
    Route::post('/upload-image', [ProductController::class, 'uploadEditorImage'])->name('upload-image');
    Route::resource('/products', ProductController::class);

    // ------------   Product Gallery Routes --------------------
    Route::get('/product-gallery/{productId}', [ProductGalleryController::class, 'index'])->name('product-gallery.show-index');
    Route::resource('/product-gallery', ProductGalleryController::class);

    // ------------   Product Sizes & Options Routes --------------------
    Route::get('/product-size-and-option/{productId}', [ProductSizeAndOptionController::class, 'index'])->name('product-size-and-option.index');

    Route::post('/product-size', [ProductSizeAndOptionController::class, 'storeSize'])->name('product-size.store');
    Route::delete('/product-size/{id}', [ProductSizeAndOptionController::class, 'destroySize'])->name('product-size.destroy');

    Route::post('/product-option', [ProductSizeAndOptionController::class, 'storeOption'])->name('product-option.store');
    Route::delete('/product-option/{id}', [ProductSizeAndOptionController::class, 'destroyOption'])->name('product-option.destroy');

    // ------------   Coupons Routes --------------------
    Route::resource('/coupons', CouponController::class);

    // ------------   Orders Management Routes --------------------
    Route::controller(OrderController::class)->group(function () {
        Route::get('/all-orders', 'allOrders')->name('orders.all');
        Route::get('/pending-orders', 'pendingOrders')->name('orders.pending');
        Route::get('/processing-orders', 'processingOrders')->name('orders.processing');
        Route::get('/delivered-orders', 'deliveredOrders')->name('orders.delivered');
        Route::get('/canceled-orders', 'canceledOrders')->name('orders.canceled');
        Route::get('/order/details/{id}', 'viewOrder')->name('order.details');
        Route::get('/order/approve/{id}', 'approveOrder')->name('order.approve');
        Route::get('/order/cancel/{id}', 'cancelOrder')->name('order.cancel');
    });

    // ------------   Table Reservations Management Routes --------------------
    Route::controller(ReservationController::class)->group(function () {
        Route::get('/reservations', 'index')->name('reservations.index');
        Route::post('/reservations/status/{id}', 'updateStatus')->name('reservations.update-status');
        Route::delete('/reservations/{id}', 'destroy')->name('reservations.destroy');
    });

    // ------------   Blog Categories & Posts Routes --------------------
    Route::resource('/blog-categories', BlogCategoryController::class);
    Route::resource('/blog-posts', BlogPostController::class);

    // ------------   Chefs Routes --------------------
    Route::resource('/chefs', ChefController::class);
});