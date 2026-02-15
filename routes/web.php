<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserOrderController;

// Home Page
Route::get('/', [ProductController::class, 'index'])->name('home');

// Auth routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Product routes
Route::get('/produs/{slug}', [ProductController::class, 'show'])->name('product.show');

// Cart routes (guest accessible)
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/{cart}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/{cart}', [CartController::class, 'remove'])->name('cart.remove');
Route::delete('/cart/clear/all', [CartController::class, 'clear'])->name('cart.clear');

// Contact routes
Route::get('/contact', [ContactController::class, 'show'])->name('contact');
Route::post('/contact', [ContactController::class, 'send'])->name('contact.send');

// Protected routes (require authentication)
Route::middleware(['auth'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Profile
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profile/password', [ProfileController::class, 'password'])->name('profile.password');

    // Addresses
    Route::resource('addresses', AddressController::class)->except(['show']);
    Route::post('/addresses/{address}/default', [AddressController::class, 'setDefault'])->name('addresses.default');

    // Checkout
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');

    // User Orders - moved inside auth group
    Route::get('/order/{order}', [UserOrderController::class, 'show'])->name('orders.show');
    Route::get('/order/{order}/invoice', [UserOrderController::class, 'invoice'])->name('orders.invoice');
});

// Admin routes (require auth + admin)
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

    // Products - full CRUD
    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);

    // Orders - except create/store (includes invoice route via resource)
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->except(['create', 'store']);

    // Users - with ALL methods including show
    Route::get('/users', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'show'])->name('users.show');
    Route::get('/users/{user}/edit', [App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
});
Route::get('/payment/checkout/{order}', [App\Http\Controllers\StripePaymentController::class, 'checkout'])->name('stripe.checkout');
Route::get('/payment/success', [App\Http\Controllers\StripePaymentController::class, 'success'])->name('stripe.success');
Route::get('/payment/cancel', [App\Http\Controllers\StripePaymentController::class, 'cancel'])->name('stripe.cancel');
