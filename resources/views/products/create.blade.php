@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('products.index') }}"
           class="inline-flex items-center gap-2 text-sm text-blue-700 hover:text-blue-900">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-xl font-bold mb-6">Tambah Produk</h1>
        <form method="POST"
              action="{{ route('products.store') }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nama Produk
                </label>
                <input name="name"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                       placeholder="Nama produk">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Kategori
                </label>
                <select name="category_id"
                        class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Satuan
                </label>
                <input name="satuan"
                       class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none"
                       placeholder="pcs / kg / box">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Gambar Produk
                </label>
                <div id="drop-area"
                     class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-600 transition">
                    <input type="file"
                           name="image"
                           id="file-input"
                           accept="image/*"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div id="upload-text">
                        <svg class="mx-auto w-10 h-10 text-gray-400 mb-2"
                             fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M7 16V4m0 0l-4 4m4-4l4 4m6 8v4m0 0l4-4m-4 4l-4-4"/>
                        </svg>
                        <p class="text-sm text-gray-600">
                            Drag & drop gambar di sini atau klik untuk upload
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            JPG, PNG, WEBP (Max 2MB)
                        </p>
                    </div>
                    <div id="preview-container" class="hidden">
                        <div class="relative inline-block">
                            <img id="preview-image"
                                class="mx-auto w-32 h-32 object-cover rounded-lg border border-gray-200">
                            <button type="button"
                                    id="remove-image"
                                    class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700">
                                ✕
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2">
                            Klik atau drag ulang untuk mengganti
                        </p>
                    </div>
                </div>
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

<script>
    const fileInput = document.getElementById('file-input');
    const previewImage = document.getElementById('preview-image');
    const previewContainer = document.getElementById('preview-container');
    const uploadText = document.getElementById('upload-text');
    const removeButton = document.getElementById('remove-image');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];

        if (file) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImage.src = e.target.result;
                previewContainer.classList.remove('hidden');
                uploadText.classList.add('hidden');
            };

            reader.readAsDataURL(file);
        }
    });

    removeButton.addEventListener('click', function () {
        fileInput.value = ''; // reset input file
        previewImage.src = '';
        previewContainer.classList.add('hidden');
        uploadText.classList.remove('hidden');
    });
</script>
@endsection
