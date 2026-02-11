<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

Route::resource('dashboard/products', ProductController::class);
Route::get('/products/fetch', [ProductController::class, 'fetch'])->name('products.fetch');

Route::get('dashboard/stock-in', [StockInController::class, 'index'])
    ->name('stock-in.index');

Route::post('/stock-in', [StockInController::class, 'store'])
    ->name('stock-in.store');

Route::get('dashboard/stock-out', [StockOutController::class, 'index'])
    ->name('stock-out.index');


Route::post('/stock-out', [StockOutController::class, 'store'])
    ->name('stock-out.store');
