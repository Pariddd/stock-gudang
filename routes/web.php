<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StockHistoryController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])
        ->name('index');

    Route::get('products/fetch', [ProductController::class, 'fetch'])
        ->name('products.fetch');
    Route::resource('products', ProductController::class);

    Route::resource('categories', CategoryController::class);

    Route::get('stock-in/search-products', [StockInController::class, 'searchProducts'])->name('stock-in.search-products');
    Route::resource('stock-in', StockInController::class);

    Route::get('/stock-out/search-products', [StockOutController::class, 'searchProducts'])->name('stock-out.search-products');
    Route::resource('stock-out', StockOutController::class);

    Route::get('stock-history', [StockHistoryController::class, 'index'])->name('stock-history.index');
    Route::get('stock-history/fetch', [StockHistoryController::class, 'fetch'])->name('stock-history.fetch');
});
