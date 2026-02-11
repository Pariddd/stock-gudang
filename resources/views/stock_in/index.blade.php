@extends('layouts.app')

@section('content')

<h1 class="text-2xl font-bold mb-6">Barang Masuk</h1>

@if (session('success'))
    <div class="mb-4 p-3 rounded bg-green-100 text-green-700">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="mb-4 p-3 rounded bg-red-100 text-red-700">
        {{ $errors->first() }}
    </div>
@endif

<div class="bg-white rounded-lg shadow max-w-xl">
    <div class="p-5 border-b">
        <h2 class="text-lg font-semibold">Tambah Barang Masuk</h2>
    </div>

    <form action="{{ route('dashboard.stock-in.store') }}" method="POST" class="p-5 space-y-4">
        @csrf
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Produk
            </label>
            <select name="product_id"
                    class="w-full border-gray-300 rounded focus:ring focus:ring-slate-200">
                @foreach ($products as $product)
                    <option value="{{ $product->id }}">
                        {{ $product->name }} (stok: {{ $product->stock }})
                    </option>
                @endforeach
            </select>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Jumlah
            </label>
            <input type="number"
                   name="qty"
                   min="1"
                   class="w-full border-gray-300 rounded focus:ring focus:ring-slate-200">
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Keterangan
            </label>
            <input type="text"
                   name="description"
                   placeholder="Contoh: stok awal / pembelian"
                   class="w-full border-gray-300 rounded focus:ring focus:ring-slate-200">
        </div>
        <div class="flex justify-end">
            <button type="submit"
                    class="px-4 py-2 bg-slate-900 text-white rounded hover:bg-slate-800">
                Tambah Barang
            </button>
        </div>
    </form>
</div>

@endsection
