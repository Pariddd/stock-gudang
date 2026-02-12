<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockOutRequest;
use App\Models\Product;
use App\Models\StockHistory;
use App\Models\StockOut;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockOutController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $stockOuts = StockOut::with('product')->latest()->get();

        return view('stock_out.index', compact('products', 'stockOuts'));
    }

    public function store(StoreStockOutRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            $before = $product->stock;
            $after  = $before - $data['qty'];

            StockOut::create([
                'product_id' => $product->id,
                'qty' => $data['qty'],
                'description' => $data['description'] ?? null,
            ]);

            $product->decrement('stock', $data['qty']);

            StockHistory::create([
                'product_id' => $product->id,
                'type' => 'keluar',
                'qty' => $data['qty'],
                'stock_before' => $before,
                'stock_after' => $after,
                'description' => $data['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('dashboard.stock-out.index')
            ->with('success', 'Barang keluar berhasil dicatat');
    }

    public function searchProducts(Request $request)
    {
        $search = $request->get('search', '');

        $products = Product::with('category')
            ->where('stock', '>', 0)
            ->when($search, function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhereHas('category', function ($q) use ($search) {
                        $q->where('name', 'like', "%{$search}%");
                    });
            })
            ->orderBy('name')
            ->limit(10)
            ->get(['id', 'name', 'stock', 'satuan', 'category_id']);

        return response()->json($products);
    }
}
