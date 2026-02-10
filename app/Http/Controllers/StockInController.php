<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStockInRequest;
use App\Models\Product;
use App\Models\StockIn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StockInController extends Controller
{
    public function store(StoreStockInRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data) {
            $product = Product::lockforUpdate()->findOrFail($data['product_id']);

            StockIn::create([
                'product_id' => $product->id,
                'qty' => $data['qty'],
                'description' => $data['description'] ?? null,
            ]);

            $product->increment('stock', $data['qty']);
        });

        return redirect()->back()->with('success', 'Barang masuk berhasil ditambahkan.');
    }
}
