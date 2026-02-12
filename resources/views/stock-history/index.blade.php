@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto">
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Riwayat Stok</h1>
            <p class="text-gray-600 text-sm mt-1">Catatan semua transaksi masuk dan keluar barang</p>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-4 border-b border-gray-200 space-y-4">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div class="flex items-center gap-2">
                    <label class="text-sm text-gray-600">Show</label>
                    <select id="perPageSelect" class="px-3 py-1.5 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-700">
                        <option value="10">10</option>
                        <option value="15" selected>15</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <label class="text-sm text-gray-600">entries</label>
                </div>
                <div class="relative w-full sm:w-64">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" id="searchInput" placeholder="Search by product name..." class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-700">
                </div>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Produk</label>
                    <select id="productFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-700">
                        <option value="">Semua Produk</option>
                        @foreach($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Tipe</label>
                    <select id="typeFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-700">
                        <option value="">Semua</option>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Dari Tanggal</label>
                    <input type="date" id="startDateFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-700">
                </div>
                <div>
                    <label class="block text-xs text-gray-600 mb-1">Sampai Tanggal</label>
                    <input type="date" id="endDateFilter" class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-700">
                </div>
            </div>
            <div class="flex justify-end">
                <button id="resetFilters" class="inline-flex items-center gap-2 px-4 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    Reset Filter
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm" style="min-width: 900px;">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('product_name')" class="flex items-center gap-2 hover:text-blue-700">
                                Produk
                                <span id="sort-icon-product_name"><svg class="w-4 h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg></span>
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('type')" class="flex items-center gap-2 hover:text-blue-700">
                                Tipe
                                <span id="sort-icon-type"><svg class="w-4 h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg></span>
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('qty')" class="flex items-center gap-2 hover:text-blue-700">
                                Qty
                                <span id="sort-icon-qty"><svg class="w-4 h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg></span>
                            </button>
                        </th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">Stok Sebelum</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">Stok Sesudah</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">Keterangan</th>
                        <th class="px-6 py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('created_at')" class="flex items-center gap-2 hover:text-blue-700">
                                Tanggal
                                <span id="sort-icon-created_at"><svg class="w-4 h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg></span>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200"></tbody>
            </table>
        </div>
        <div class="p-4 border-t flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div id="paginationInfo" class="text-sm text-gray-600 text-center sm:text-left">Loading...</div>
            <div id="paginationLinks"></div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let perPage = 15;
    let search = '';
    let productId = '';
    let type = '';
    let startDate = '';
    let endDate = '';
    let sortBy = 'created_at';
    let sortDirection = 'desc';
    let searchTimeout;

    const perPageSelect = document.getElementById('perPageSelect');
    const searchInput = document.getElementById('searchInput');
    const productFilter = document.getElementById('productFilter');
    const typeFilter = document.getElementById('typeFilter');
    const startDateFilter = document.getElementById('startDateFilter');
    const endDateFilter = document.getElementById('endDateFilter');
    const resetFilters = document.getElementById('resetFilters');

    fetchHistories();

    perPageSelect.addEventListener('change', () => {
        perPage = perPageSelect.value;
        currentPage = 1;
        fetchHistories();
    });

    searchInput.addEventListener('keyup', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            search = searchInput.value;
            currentPage = 1;
            fetchHistories();
        }, 300);
    });

    productFilter.addEventListener('change', () => {
        productId = productFilter.value;
        currentPage = 1;
        fetchHistories();
    });

    typeFilter.addEventListener('change', () => {
        type = typeFilter.value;
        currentPage = 1;
        fetchHistories();
    });

    startDateFilter.addEventListener('change', () => {
        startDate = startDateFilter.value;
        if (startDate && endDate) {
            currentPage = 1;
            fetchHistories();
        }
    });

    endDateFilter.addEventListener('change', () => {
        endDate = endDateFilter.value;
        if (startDate && endDate) {
            currentPage = 1;
            fetchHistories();
        }
    });

    resetFilters.addEventListener('click', () => {
        search = '';
        productId = '';
        type = '';
        startDate = '';
        endDate = '';
        searchInput.value = '';
        productFilter.value = '';
        typeFilter.value = '';
        startDateFilter.value = '';
        endDateFilter.value = '';
        currentPage = 1;
        fetchHistories();
    });

    function fetchHistories() {
        const params = new URLSearchParams({
            page: currentPage,
            per_page: perPage,
            search: search,
            product_id: productId,
            type: type,
            start_date: startDate,
            end_date: endDate,
            sort_by: sortBy,
            sort_direction: sortDirection
        });

        fetch(`{{ route('dashboard.stock-history.fetch') }}?${params}`)
            .then(response => response.json())
            .then(data => {
                renderTable(data.data);
                renderPagination(data);
                updateSortIcons();
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('tableBody').innerHTML = '<tr><td colspan="7" class="px-6 py-12 text-center text-red-500">Terjadi kesalahan</td></tr>';
            });
    }

    function renderTable(histories) {
        const tbody = document.getElementById('tableBody');
        
        if (!histories.length) {
            tbody.innerHTML = '<tr><td colspan="7" class="px-6 py-12 text-center text-gray-500"><div class="flex flex-col items-center gap-2"><svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg><p class="font-medium">Tidak ada riwayat</p></div></td></tr>';
            return;
        }

        tbody.innerHTML = histories.map(h => {
            const date = new Date(h.created_at);
            const formattedDate = date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' }) + ' ' + date.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' });
            
            return `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4 font-medium text-gray-800">${h.product.name}</td>
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center px-2.5 py-1 text-xs font-semibold rounded-full ${
                            h.type === 'masuk' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700'
                        }">
                            ${h.type === 'masuk' ? 'Masuk' : 'Keluar'}
                        </span>
                    </td>
                    <td class="px-6 py-4 font-semibold text-gray-800">${h.qty}</td>
                    <td class="px-6 py-4 text-gray-600">${h.stock_before}</td>
                    <td class="px-6 py-4 text-gray-600">${h.stock_after}</td>
                    <td class="px-6 py-4 text-gray-600">${h.description || '-'}</td>
                    <td class="px-6 py-4 text-gray-500 text-xs">${formattedDate}</td>
                </tr>
            `;
        }).join('');
    }

    function renderPagination(data) {
        document.getElementById('paginationInfo').textContent = `Showing ${data.from || 0} to ${data.to || 0} of ${data.total} entries`;
        
        let html = '<nav class="flex items-center gap-2">';
        html += data.current_page > 1 
            ? `<button onclick="changePage(${data.current_page - 1})" class="px-3 py-1.5 text-sm text-gray-700 bg-white border rounded-lg hover:bg-gray-50">Prev</button>`
            : '<span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg">Prev</span>';
        
        let start = Math.max(1, data.current_page - 2);
        let end = Math.min(data.last_page, start + 4);
        if (end - start < 4) start = Math.max(1, end - 4);
        
        for (let i = start; i <= end; i++) {
            html += i === data.current_page
                ? `<span class="px-3 py-1.5 text-sm font-semibold text-white bg-blue-700 rounded-lg">${i}</span>`
                : `<button onclick="changePage(${i})" class="px-3 py-1.5 text-sm text-gray-700 bg-white border rounded-lg hover:bg-gray-50">${i}</button>`;
        }
        
        html += data.current_page < data.last_page
            ? `<button onclick="changePage(${data.current_page + 1})" class="px-3 py-1.5 text-sm text-gray-700 bg-white border rounded-lg hover:bg-gray-50">Next</button>`
            : '<span class="px-3 py-1.5 text-sm text-gray-400 bg-gray-100 rounded-lg">Next</span>';
        
        document.getElementById('paginationLinks').innerHTML = html + '</nav>';
    }

    window.changePage = function(page) {
        currentPage = page;
        fetchHistories();
    };

    window.toggleSort = function(column) {
        if (sortBy === column) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortBy = column;
            sortDirection = 'asc';
        }
        fetchHistories();
    };

    function updateSortIcons() {
        document.querySelectorAll('[id^="sort-icon-"]').forEach(icon => {
            icon.innerHTML = '<svg class="w-4 h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20"><path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/></svg>';
        });
        
        const activeIcon = document.getElementById(`sort-icon-${sortBy}`);
        if (activeIcon) {
            activeIcon.innerHTML = sortDirection === 'asc'
                ? '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 10l5-5 5 5H5z"/></svg>'
                : '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M15 10l-5 5-5-5h10z"/></svg>';
        }
    }
});
</script>

@endsection