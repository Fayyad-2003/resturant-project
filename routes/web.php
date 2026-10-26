<?php

use App\Http\Controllers\Frontend\BlogController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CouponController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\FrontnendController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\Frontend\ReservationController;
use App\Http\Controllers\Frontend\ReviewController;
use App\Http\Controllers\Frontend\TestimonialController;
use App\Http\Controllers\Frontend\StripePaymentController;
use App\Http\Controllers\Frontend\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontnendController::class, 'index'])->name('home');
Route::get('/product-quick-view/{id?}', [FrontnendController::class, 'productQuickView'])->name('product-quick-view');
Route::get('/product/{slug}', [FrontnendController::class, 'productDetails'])->name('product.details');
Route::get('/chefs', [FrontnendController::class, 'chefs'])->name('chefs');
Route::get('/about', [FrontnendController::class, 'about'])->name('about');
Route::get('/shop', [FrontnendController::class, 'shop'])->name('shop');

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

// Wishlist all routes
Route::controller(WishlistController::class)->group(function () {
    Route::post('/wishlist/add', 'addWishlist')->name('wishlist.add');
    Route::delete('/wishlist/remove/{id}', 'removeWishlist')->name('wishlist.remove')->middleware('auth');
});

// Blog all routes
Route::controller(BlogController::class)->group(function () {
    Route::get('/blog', 'index')->name('blog');
    Route::get('/blog/{slug}', 'details')->name('blog.details');
    Route::post('/blog/{id}/comment', 'commentStore')->name('blog.comment.store')->middleware('auth');
});

Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation.store');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/order/details/{id}', [DashboardController::class, 'orderDetails'])->name('order.details');
    Route::get('/order/track', [DashboardController::class, 'orderTrack'])->name('order.track');
    // Submit Review 
    Route::post('/review/store', [ReviewController::class, 'store'])->name('review.store');
    // Submit Restaurant Testimonial
    Route::post('/testimonial/store', [TestimonialController::class, 'store'])->name('testimonial.store');
    Route::put('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::put('/profile/password/update', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
    // Stripe Payment routes 
    Route::controller(StripePaymentController::class)->group(function () {
        Route::get('/stripe/payment', 'stripe')->name('stripe.payment');
        Route::post('/stripe/payment', 'stripePost')->name('stripe.post');
    });

});



require __DIR__ . '/auth.php';
