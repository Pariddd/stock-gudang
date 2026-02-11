@extends('layouts.app')

@section('content')

<div class="max-w-2xl mx-auto">
    <div class="mb-4">
        <a href="{{ route('products.index') }}"
        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-700 text-white text-sm font-medium rounded-lg hover:bg-blue-900 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 19l-7-7 7-7"/>
            </svg>
            Kembali
        </a>
    </div>
    <div class="bg-white shadow rounded-lg p-6">
        <h1 class="text-xl font-bold mb-6">Edit Produk</h1>
        <form method="POST"
              action="{{ route('products.update', $product) }}"
              enctype="multipart/form-data"
              class="space-y-5">
            @csrf
            @method('PUT')
            <div>
                <label class="block text-sm font-medium mb-1">Nama Produk</label>
                <input name="name"
                       value="{{ old('name', $product->name) }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Kategori</label>
                <select name="category_id"
                        class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $product->category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium mb-1">Satuan</label>
                <input name="satuan"
                       value="{{ old('satuan', $product->satuan) }}"
                       class="w-full border rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-600 focus:outline-none">
            </div>
            <div>
                <label class="block text-sm font-medium mb-2">Gambar Produk</label>
                <div id="drop-area"
                     class="relative border-2 border-dashed border-gray-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-600 transition">
                    <input type="file"
                           name="image"
                           id="file-input"
                           accept="image/*"
                           class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    <div id="upload-text"
                         class="{{ $product->image ? 'hidden' : '' }}">
                        <p class="text-sm text-gray-600">
                            Drag & drop gambar atau klik untuk upload
                        </p>
                    </div>
                    <div id="preview-container"
                         class="{{ $product->image ? '' : 'hidden' }}">
                        <div class="relative inline-block">
                            <img id="preview-image"
                                 src="{{ $product->image ? asset('storage/'.$product->image) : '' }}"
                                 class="mx-auto w-32 h-32 object-cover rounded-lg border">

                            <button type="button"
                                    id="remove-image"
                                    class="absolute -top-2 -right-2 bg-red-600 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-700">
                                ✕
                            </button>
                        </div>
                    </div>
                    <div id="image-error" class="hidden mt-3 items-center gap-2 p-3 bg-red-50 border border-red-200 rounded-lg">
                        <svg class="w-4 h-4 text-red-600 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm-1-11h2v5H9V7zm0 6h2v2H9v-2z"clip-rule="evenodd"/>
                        </svg>
                        <span id="image-error-text" class="text-sm text-red-700 font-medium">
                        </span>
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="px-5 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800">
                    Update
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
    const imageError = document.getElementById('image-error');
    const imageErrorText = document.getElementById('image-error-text');

    fileInput.addEventListener('change', function () {
        const file = this.files[0];
        if (!file) return;

        const maxSize = 2 * 1024 * 1024;
        const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];

        imageError.classList.add('hidden');
        imageError.classList.remove('flex');
        imageErrorText.textContent = '';

        if (!allowedTypes.includes(file.type)) {
            showImageError('Format gambar harus JPG, PNG, atau WEBP.');
            fileInput.value = '';
            return;
        }

        if (file.size > maxSize) {
            showImageError('Ukuran gambar maksimal 2MB.');
            fileInput.value = '';
            return;
        }

        const reader = new FileReader();
        reader.onload = function (e) {
            previewImage.src = e.target.result;
            previewContainer.classList.remove('hidden');
            uploadText.classList.add('hidden');
        };
        reader.readAsDataURL(file);
    });

    removeButton?.addEventListener('click', function () {
        fileInput.value = '';
        previewImage.src = '';
        previewContainer.classList.add('hidden');
        uploadText.classList.remove('hidden');

        imageError.classList.add('hidden');
        imageError.classList.remove('flex');
        imageErrorText.textContent = '';
    });

    function showImageError(message) {
        imageErrorText.textContent = message;
        imageError.classList.remove('hidden');
        imageError.classList.add('flex');
    }
</script>

@endsection
