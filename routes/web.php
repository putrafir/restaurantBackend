<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customer', [CustomerController::class, 'index'])->middleware(['auth', 'verified'])->name('customer.menu');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

Route::get('cashiers/dashboard', [HomeController::class, 'index'])->middleware(['auth', 'cashier']);


// Route::get('menu', [CustomerController::class, 'show'])->name('menu.show');

Route::post('/cart/add', [CustomerController::class, 'add'])->name('cart.add');

Route::get('/cart', [CustomerController::class, 'show'])->name('cart.show');

Route::post('/cart/checkout', [CustomerController::class, 'checkout'])->name('cart.checkout');
