<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AddressController;
use App\Http\Controllers\CheckoutController;
// Home Page - SINGLE definition
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

// Cart routes
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
});
// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('dashboard');

    Route::resource('products', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('orders', App\Http\Controllers\Admin\OrderController::class)->except(['create', 'store']);
    Route::resource('users', App\Http\Controllers\Admin\UserController::class)->only(['index', 'edit', 'update']);
});
Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
});
