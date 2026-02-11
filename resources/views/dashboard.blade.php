@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-blue-900" >Profile Statistics</h1>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-6">
        <a href="{{ route('dashboard.products.index') }}"
           class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-300 group">
            <div class="flex items-start justify-between mb-3">
                <div class="p-3 bg-blue-50 rounded-lg group-hover:bg-blue-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">
                Total Produk
            </p>
            <p class="text-3xl font-bold text-gray-800">
                {{ $totalProducts }}
            </p>
        </a>
        <a href="{{ route('dashboard.products.index') }}"
           class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-300 group">
            <div class="flex items-start justify-between mb-3">
                <div class="p-3 bg-purple-50 rounded-lg group-hover:bg-purple-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">
                Total Stok
            </p>
            <p class="text-3xl font-bold text-gray-800">
                {{ $totalStock }}
            </p>
        </a>
        <a href="{{ route('dashboard.stock-in.index') }}"
           class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-300 group">
            <div class="flex items-start justify-between mb-3">
                <div class="p-3 bg-green-50 rounded-lg group-hover:bg-green-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12"/>
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">
                Masuk Hari Ini
            </p>
            <p class="text-3xl font-bold text-green-600">
                {{ $stockInToday }}
            </p>
        </a>
        <a href="{{ route('dashboard.stock-out.index') }}"
           class="bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-lg hover:scale-105 transition-all duration-300 group">
            <div class="flex items-start justify-between mb-3">
                <div class="p-3 bg-red-50 rounded-lg group-hover:bg-red-100 transition-colors duration-300">
                    <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 13l-5 5m0 0l-5-5m5 5V6"/>
                    </svg>
                </div>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">
                Keluar Hari Ini
            </p>
            <p class="text-3xl font-bold text-red-600">
                {{ $stockOutToday }}
            </p>
        </a>

    </div>
    <div class="mt-8 grid grid-cols-1">
        <div class="bg-white rounded-xl border border-gray-200 p-6 shadow-sm">
            <h2 class="text-lg font-bold text-gray-800 mb-4">Histori Barang Masuk/Keluar</h2>
            <div class="space-y-3">
                <p class="text-gray-500 text-sm">Belum ada aktivitas hari ini</p>
            </div>
        </div>
    </div>
</div>
@endsection