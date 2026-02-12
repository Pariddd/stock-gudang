@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('dashboard.categories.index') }}"
           class="inline-flex items-center gap-2 px-4 py-2 bg-blue-700 text-white text-sm font-medium rounded-lg hover:bg-blue-900 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-xl font-bold mb-6">Tambah Kategori</h1>
        <form method="POST"
              action="{{ route('dashboard.categories.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Kategori
                </label>
                <input name="name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                       placeholder="Nama kategori">
            </div>
            <div class="flex justify-end">
                <button type="submit"
                        class="px-5 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
