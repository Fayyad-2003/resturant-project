<?php

use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\FrontnendController;
use App\Http\Controllers\Frontend\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontnendController::class, 'index'])->name('home');
Route::get('/product-quick-view/{id?}', [FrontnendController::class, 'productQuickView'])->name('product-quick-view');

// cart all routes
Route::controller(CartController::class)->group(function () {
    Route::post('/add-to-cart', 'addToCart')->name('add.to.cart');
    Route::get('/my/cart', 'mycart')->name('my.cart');
    Route::get('/my/cart/content', 'mycartcontent')->name('my.cart.content');
    Route::get('/mini/cart', 'minicart')->name('mini.cart.content');
    Route::get('/cart/count', 'cartcount')->name('cart.count');
    Route::post('/remove/cart/item', 'removecartitem')->name('remove.cart.item');
    Route::post('/cart/qty/increment', 'cartqtyincrement')->name('cart.qty.increment');
    Route::post('/cart/qty/decrement', 'cartqtydecrement')->name('cart.qty.decrement');
    Route::post('/cart/clear', 'cartcleard')->name('cart.clear');
});

// Coupon all routes
Route::controller(CouponController::class)->group(function () {
    Route::get('/coupon/apply', 'couponApply')->name('coupon.apply');
    Route::get('/coupon/calculation', 'couponCalculation')->name('coupon.calculation');
    Route::get('/coupon/remove', 'couponRemove')->name('coupon.remove');
});


// Checkout all routes
Route::controller(FrontnendController::class)->group(function () {
    Route::get('/checkout', 'checkout')->name('checkout')->middleware('auth');
    Route::get('/checkout/content', 'checkoutcontent')->name('checkout.content');
    Route::get('/checkout/store', 'checkoutstore')->name('checkout.store')->middleware('auth');
    Route::get('/select/district', 'selectdistrict')->name('select.district');
    Route::get('/select/state', 'selectstate')->name('select.state');
    Route::get('/get/delivery/charge', 'getdeliverycharge')->name('get.delivery.charge');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});



require __DIR__ . '/auth.php';
