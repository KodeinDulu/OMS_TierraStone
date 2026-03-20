<?php

use App\Http\Controllers\CompanyProfileController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

// Halaman utama
Route::get('/', [CompanyProfileController::class, 'index'])->name('welcome');

// Form pesanan
Route::get('/order', [OrderController::class, 'create'])->name('order');

// UI halaman tracking
Route::get('/lacak', [OrderController::class, 'track'])->name('orders.track');


