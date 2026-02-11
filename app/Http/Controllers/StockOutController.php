<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockOutRequest;
use App\Models\Product;
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

            if ($product->stock < $data['qty']) {
                abort(400, 'Stok tidak mencukupi');
            }

            StockOut::create([
                'product_id' => $product->id,
                'qty' => $data['qty'],
                'description' => $data['description'] ?? null,
            ]);

            $product->decrement('stock', $data['qty']);
        });


        return redirect()
            ->route('dashboard.products.index')
            ->with('success', 'Barang keluar berhasil ditambahkan');
    }
}
