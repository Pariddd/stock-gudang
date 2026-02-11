<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
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

    Route::get('stock-in', [StockInController::class, 'index'])
        ->name('stock-in.index');

    Route::post('stock-in', [StockInController::class, 'store'])
        ->name('stock-in.store');

    Route::get('stock-out', [StockOutController::class, 'index'])
        ->name('stock-out.index');

    Route::post('stock-out', [StockOutController::class, 'store'])
        ->name('stock-out.store');
});
