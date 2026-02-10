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
        return redirect()
            ->route('products.index')
            ->with('success', 'Barang keluar berhasil ditambahkan');
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


        return redirect()->back()->with('success', 'Barang keluar berhasil disimpan');
    }
}
