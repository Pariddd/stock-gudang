@extends('layouts.app')

@section('content')

<div class="w-full max-w-3xl mx-auto px-4 lg:px-0">

    <!-- Header -->
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Barang Masuk</h1>
        <p class="text-sm text-gray-600 mt-1">
            Tambahkan stok produk yang masuk ke gudang
        </p>
    </div>
    <div class="bg-white rounded-xl shadow-sm border border-gray-200">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-700">
                Form Tambah Barang Masuk
            </h2>
        </div>
        <form action="{{ route('dashboard.stock-in.store') }}"
              method="POST"
              id="stockInForm"
              class="p-6 space-y-6">
            @csrf
            <input type="hidden" name="product_id" id="productIdInput">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Produk <span class="text-blue-700">*</span>
                </label>
                
                <div class="relative">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                        </div>
                        <input type="text"
                               id="productSearch"
                               placeholder="Ketik nama produk untuk mencari..."
                               autocomplete="off"
                               class="w-full pl-10 pr-10 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-700 focus:border-transparent transition-all">
                        <div id="searchLoading" class="absolute inset-y-0 right-0 pr-3 hidden">
                            <div class="flex items-center h-full">
                                <svg class="animate-spin h-5 w-5 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                            </div>
                        </div>
                        <button type="button"
                                id="clearSearch"
                                class="absolute inset-y-0 right-0 pr-3 hidden">
                            <div class="flex items-center h-full">
                                <svg class="w-5 h-5 text-gray-400 hover:text-gray-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </div>
                        </button>
                    </div>
                    <div id="searchResults" 
                         class="absolute z-50 w-full mt-1 bg-white border border-gray-200 rounded-lg shadow-lg max-h-64 overflow-y-auto hidden">
                    </div>
                    <div id="selectedProduct" class="hidden mt-3 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start justify-between">
                            <div class="flex-1">
                                <p class="font-medium text-gray-800" id="selectedProductName"></p>
                                <p class="text-sm text-gray-600 mt-1">
                                    Stok saat ini: <span id="selectedProductStock" class="font-semibold text-blue-700"></span>
                                    <span id="selectedProductUnit" class="text-gray-500"></span>
                                </p>
                            </div>
                            <button type="button"
                                    id="removeProduct"
                                    class="ml-3 text-red-600 hover:text-red-800">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                @error('product_id')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Jumlah <span class="text-blue-700">*</span>
                </label>

                <div class="flex items-center gap-3">
                    <button type="button"
                            id="decrementQty"
                            class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                        </svg>
                    </button>
                    <input type="number"
                           id="qtyInput"
                           name="qty"
                           min="1"
                           value="{{ old('qty', 1) }}"
                           placeholder="Masukkan jumlah"
                           class="flex-1 text-center border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-700 focus:border-transparent transition-all"
                           disabled>
                    <button type="button"
                            id="incrementQty"
                            class="w-10 h-10 flex items-center justify-center border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors disabled:opacity-50 disabled:cursor-not-allowed"
                            disabled>
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </button>
                </div>
                <p id="qtyError" class="text-red-600 text-sm mt-1 hidden"></p>
                @error('qty')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">
                    Keterangan
                </label>
                <textarea name="description"
                          rows="3"
                          placeholder="Contoh: Stok awal, Pembelian supplier, Retur dari customer, dll."
                          class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-blue-700 focus:border-transparent transition-all resize-none">{{ old('description') }}</textarea>

                @error('description')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="flex flex-col sm:flex-row gap-3 justify-end">
                <a href="{{ route('dashboard.stock-in.index') }}"
                   class="inline-flex items-center justify-center gap-2 px-5 py-2.5 border border-gray-300 text-gray-700 text-sm font-medium rounded-lg hover:bg-gray-50 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Batal
                </a>
                <button type="submit"
                        id="submitBtn"
                        disabled
                        class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-700 text-white text-sm font-medium rounded-lg hover:bg-blue-800 transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Tambah Stok
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const productSearch = document.getElementById('productSearch');
    const searchResults = document.getElementById('searchResults');
    const searchLoading = document.getElementById('searchLoading');
    const clearSearch = document.getElementById('clearSearch');
    const productIdInput = document.getElementById('productIdInput');
    const selectedProduct = document.getElementById('selectedProduct');
    const selectedProductName = document.getElementById('selectedProductName');
    const selectedProductStock = document.getElementById('selectedProductStock');
    const selectedProductUnit = document.getElementById('selectedProductUnit');
    const removeProduct = document.getElementById('removeProduct');
    const qtyInput = document.getElementById('qtyInput');
    const qtyError = document.getElementById('qtyError');
    const incrementQty = document.getElementById('incrementQty');
    const decrementQty = document.getElementById('decrementQty');
    const submitBtn = document.getElementById('submitBtn');

    let searchTimeout;
    let selectedIndex = -1;

    productSearch.addEventListener('input', function() {
        const query = this.value.trim();
        
        clearTimeout(searchTimeout);
        
        if (query.length < 2) {
            searchResults.classList.add('hidden');
            clearSearch.classList.add('hidden');
            return;
        }

        clearSearch.classList.remove('hidden');
        searchLoading.classList.remove('hidden');

        searchTimeout = setTimeout(() => {
            fetch(`{{ route('dashboard.stock-in.search-products') }}?search=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    searchLoading.classList.add('hidden');
                    renderResults(data);
                })
                .catch(error => {
                    console.error('Error:', error);
                    searchLoading.classList.add('hidden');
                    searchResults.innerHTML = '<div class="p-4 text-center text-red-600">Terjadi kesalahan</div>';
                    searchResults.classList.remove('hidden');
                });
        }, 300);
    });

    function renderResults(products) {
        selectedIndex = -1;

        if (products.length === 0) {
            searchResults.innerHTML = `
                <div class="p-4 text-center text-gray-500">
                    <svg class="w-12 h-12 mx-auto mb-2 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm">Produk tidak ditemukan</p>
                </div>
            `;
        } else {
            searchResults.innerHTML = products.map((product, index) => `
                <button type="button"
                        class="result-item w-full text-left px-4 py-3 hover:bg-gray-50 transition-colors border-b border-gray-100 last:border-b-0"
                        data-id="${product.id}"
                        data-name="${product.name}"
                        data-stock="${product.stock}"
                        data-unit="${product.satuan}"
                        data-index="${index}">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="font-medium text-gray-800">${product.name}</p>
                            <p class="text-xs text-gray-500 mt-0.5">${product.category.name}</p>
                        </div>
                        <div class="text-right ml-3">
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold ${
                                product.stock <= 5 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'
                            }">
                                ${product.stock} ${product.satuan}
                            </span>
                        </div>
                    </div>
                </button>
            `).join('');

            document.querySelectorAll('.result-item').forEach(item => {
                item.addEventListener('click', function() {
                    selectProduct(
                        this.dataset.id,
                        this.dataset.name,
                        this.dataset.stock,
                        this.dataset.unit
                    );
                });
            });
        }

        searchResults.classList.remove('hidden');
    }

    function selectProduct(id, name, stock, unit) {
        productIdInput.value = id;
        
        selectedProductName.textContent = name;
        selectedProductStock.textContent = stock;
        selectedProductUnit.textContent = unit;
        
        productSearch.value = '';
        searchResults.classList.add('hidden');
        clearSearch.classList.add('hidden');
        selectedProduct.classList.remove('hidden');
        
        qtyInput.disabled = false;
        qtyInput.value = 1;
        incrementQty.disabled = false;
        decrementQty.disabled = false;
        
        validateForm();
    }

    removeProduct.addEventListener('click', function() {
        productIdInput.value = '';
        selectedProduct.classList.add('hidden');
        productSearch.value = '';
        productSearch.focus();
        
        qtyInput.disabled = true;
        qtyInput.value = 1;
        incrementQty.disabled = true;
        decrementQty.disabled = true;
        
        validateForm();
    });

    clearSearch.addEventListener('click', function() {
        productSearch.value = '';
        searchResults.classList.add('hidden');
        this.classList.add('hidden');
        productSearch.focus();
    });

    incrementQty.addEventListener('click', function() {
        const currentQty = parseInt(qtyInput.value) || 0;
        qtyInput.value = currentQty + 1;
        validateQty();
    });

    decrementQty.addEventListener('click', function() {
        const currentQty = parseInt(qtyInput.value) || 0;
        if (currentQty > 1) {
            qtyInput.value = currentQty - 1;
            validateQty();
        }
    });

    qtyInput.addEventListener('input', validateQty);

    function validateQty() {
        const qty = parseInt(qtyInput.value);
        
        if (!qty || qty < 1) {
            qtyError.textContent = 'Jumlah minimal 1';
            qtyError.classList.remove('hidden');
            return false;
        }
        
        qtyError.classList.add('hidden');
        return true;
    }

    function validateForm() {
        const hasProduct = productIdInput.value !== '';
        const hasValidQty = validateQty();
        
        if (hasProduct && hasValidQty) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    productSearch.addEventListener('keydown', function(e) {
        const items = document.querySelectorAll('.result-item');
        
        if (items.length === 0) return;
        
        if (e.key === 'ArrowDown') {
            e.preventDefault();
            selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
            updateSelection(items);
        } else if (e.key === 'ArrowUp') {
            e.preventDefault();
            selectedIndex = Math.max(selectedIndex - 1, 0);
            updateSelection(items);
        } else if (e.key === 'Enter' && selectedIndex >= 0) {
            e.preventDefault();
            items[selectedIndex].click();
        } else if (e.key === 'Escape') {
            searchResults.classList.add('hidden');
        }
    });

    function updateSelection(items) {
        items.forEach((item, index) => {
            if (index === selectedIndex) {
                item.classList.add('bg-gray-100');
                item.scrollIntoView({ block: 'nearest' });
            } else {
                item.classList.remove('bg-gray-100');
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (!productSearch.contains(e.target) && !searchResults.contains(e.target)) {
            searchResults.classList.add('hidden');
        }
    });
});
</script>

@endsection