<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\StockHistory;
use Illuminate\Http\Request;

class StockHistoryController extends Controller
{
    public function index(Request $request)
    {
        $products = Product::orderBy('name')->get();
        return view('stock-history.index', compact('products'));
    }

    public function fetch(Request $request)
    {
        $perPage = $request->get('per_page', 15);
        $search = $request->get('search', '');
        $productId = $request->get('product_id', '');
        $type = $request->get('type', '');
        $startDate = $request->get('start_date', '');
        $endDate = $request->get('end_date', '');
        $sortBy = $request->get('sort_by', 'created_at');
        $sortDirection = $request->get('sort_direction', 'desc');

        $query = StockHistory::with('product');

        if ($search) {
            $query->whereHas('product', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($productId) {
            $query->where('product_id', $productId);
        }

        if ($type) {
            $query->where('type', $type);
        }

        if ($startDate && $endDate) {
            $query->whereBetween('created_at', [
                $startDate . ' 00:00:00',
                $endDate . ' 23:59:59'
            ]);
        }

        if ($sortBy === 'product_name') {
            $query->join('products', 'stock_histories.product_id', '=', 'products.id')
                ->select('stock_histories.*')
                ->orderBy('products.name', $sortDirection);
        } else {
            $query->orderBy($sortBy, $sortDirection);
        }

        $histories = $query->paginate($perPage);

        return response()->json([
            'data' => $histories->items(),
            'current_page' => $histories->currentPage(),
            'last_page' => $histories->lastPage(),
            'per_page' => $histories->perPage(),
            'total' => $histories->total(),
            'from' => $histories->firstItem(),
            'to' => $histories->lastItem(),
        ]);
    }
}
