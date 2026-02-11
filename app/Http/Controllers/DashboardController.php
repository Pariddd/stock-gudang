<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockIn;
use App\Models\StockOut;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');

        $stockInToday = StockIn::whereDate('created_at', today())
            ->sum('qty');
        $stockOutToday = StockOut::whereDate('created_at', today())
            ->sum('qty');

        return view('dashboard', compact('totalProducts', 'totalStock', 'stockInToday', 'stockOutToday'));
    }
}
