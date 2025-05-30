<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\ProductdetailsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdmincheckoutController;
use App\Http\Controllers\PesananController;

/*
|----------------------------------------------------------------------
| Web Routes
|----------------------------------------------------------------------
*/


// Halaman utama (home)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Halaman shop / toko
Route::get('/shop', [ShopController::class, 'index'])->name('shop');

// Halaman detail produk
Route::get('/productdetails', [ProductdetailsController::class, 'index'])->name('productdetails.index');
Route::get('/product/{id}', [ProductdetailsController::class, 'show'])->name('productdetails.show');

//pesanan
Route::get('/pesanan', [PesananController::class, 'index'])->middleware('auth')->name('pesanan');


// Halaman keranjang (cart)
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add')->middleware('auth');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');


// Halaman checkout
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware('auth')->name('checkout');
Route::post('/checkout/submit', [CheckoutController::class, 'submit'])->name('checkout.submit');



// Routes untuk login dan register
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


// Group route yang memerlukan otentikasi
// Group route hanya untuk admin
Route::middleware(['auth', 'is_admin'])->group(function () {

    // Produk (admin only)
    Route::get('/produk', [ProductController::class, 'index'])->name('produk.index');
    Route::post('/produk', [ProductController::class, 'store'])->name('produk.store');
    Route::get('/produk/{id}/edit', [ProductController::class, 'edit'])->name('produk.edit');
    Route::put('/produk/{id}', [ProductController::class, 'update'])->name('produk.update');
    Route::delete('/produk/{id}', [ProductController::class, 'destroy'])->name('produk.destroy');

    //checkout
    Route::get('/admincheckout', [AdmincheckoutController::class, 'index'])->name('admincheckout');
    Route::put('/admincheckout/{id}/status', [AdmincheckoutController::class, 'updateStatus'])->name('admincheckout.updateStatus');
    
    // Profil
    Route::get('/profile', [ProfilController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfilController::class, 'edit'])->name('profile.edit');
    Route::put('/profile/update', [ProfilController::class, 'update'])->name('profile.update');
});


    Route::get('/profil', [HomeController::class, 'show'])->name('home.show');
    Route::get('/home/edit', [HomeController::class, 'edit'])->name('home.edit');
    Route::put('/home/update', [HomeController::class, 'update'])->name('home.update');





