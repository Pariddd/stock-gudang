<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockInRequest;
use App\Models\Product;
use App\Models\StockHistory;
use App\Models\StockIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $stockIns = StockIn::with('product')->latest()->get();

        return view('stock_in.index', compact('products', 'stockIns'));
    }

    public function store(StoreStockInRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {

            $product = Product::lockForUpdate()->findOrFail($data['product_id']);

            $before = $product->stock;
            $after  = $before + $data['qty'];

            StockIn::create([
                'product_id' => $product->id,
                'qty' => $data['qty'],
                'description' => $data['description'] ?? null,
            ]);

            $product->increment('stock', $data['qty']);

            StockHistory::create([
                'product_id' => $product->id,
                'type' => 'in',
                'qty' => $data['qty'],
                'stock_before' => $before,
                'stock_after' => $after,
                'description' => $data['description'] ?? null,
            ]);
        });

        return redirect()
            ->route('dashboard.stock-in.index')
            ->with('success', 'Barang masuk berhasil ditambahkan');
    }

    public function searchProducts(Request $request)
    {
        $search = $request->get('search', '');

        $products = Product::with('category')
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
