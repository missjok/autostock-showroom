<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StockMovementController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Export laporan (didaftar duluan supaya tidak "ketutup" oleh /products/{product})
Route::get('/products/export-pdf', [ProductController::class, 'exportPdf'])
    ->middleware(['auth', 'verified'])
    ->name('products.export-pdf');

// Khusus Admin (didaftar duluan supaya /create dan /edit tidak "ketutup" oleh /{id})
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::resource('categories', CategoryController::class)->except(['index', 'show']);
    Route::resource('suppliers', SupplierController::class)->except(['index', 'show']);
    Route::resource('products', ProductController::class)->except(['index', 'show']);
    Route::resource('stock-movements', StockMovementController::class)->only(['edit', 'update', 'destroy']);
});

// Bisa diakses Admin & Staff (lihat data + input transaksi)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::resource('categories', CategoryController::class)->only(['index', 'show']);
    Route::resource('suppliers', SupplierController::class)->only(['index', 'show']);
    Route::resource('products', ProductController::class)->only(['index', 'show']);
    Route::resource('stock-movements', StockMovementController::class)->only(['index', 'create', 'store', 'show']);
});

require __DIR__.'/auth.php';