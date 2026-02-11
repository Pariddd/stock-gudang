@extends('layouts.app')

@section('content')
<div class="w-full">
    <div class="mb-4 md:mb-6">
        <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800">Daftar Barang</h1>
                <p class="text-gray-600 text-xs md:text-sm mt-1">Kelola semua produk inventory</p>
            </div>
            <a href="{{ route('dashboard.products.create') }}" 
               class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-blue-700 text-white rounded-lg hover:bg-blue-800 transition-colors duration-200 text-sm md:text-base">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                <span>Tambah Barang</span>
            </a>
        </div>
    </div>
    <div class="bg-white rounded-lg shadow-sm border border-gray-200">
        <div class="p-3 md:p-4 border-b border-gray-200">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div class="flex items-center gap-2 text-xs md:text-sm">
                    <label class="text-gray-600 whitespace-nowrap">Show</label>
                    <select id="perPageSelect" 
                            class="px-2 md:px-3 py-1.5 border border-gray-300 rounded-lg text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="25">25</option>
                    </select>
                    <label class="text-gray-600 whitespace-nowrap">entries</label>
                </div>
                <div class="relative w-full md:w-auto">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="w-4 h-4 md:w-5 md:h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                    <input type="text" 
                           id="searchInput"
                           placeholder="Search by name or category..."
                           class="w-full md:w-64 pl-9 md:pl-10 pr-4 py-1.5 md:py-2 border border-gray-300 rounded-lg text-xs md:text-sm focus:outline-none focus:ring-2 focus:ring-blue-700 focus:border-transparent">
                </div>
            </div>
        </div>
        <div class="w-full overflow-x-auto">
            <table class="min-w-[900] w-full text-xs md:text-sm">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left font-semibold text-gray-700">
                            Gambar
                        </th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('name')" class="flex items-center gap-1 md:gap-2 hover:text-blue-700 transition-colors whitespace-nowrap">
                                <span>Nama</span>
                                <span id="sort-icon-name" class="sort-icon shrink-0">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/>
                                    </svg>
                                </span>
                            </button>
                        </th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('category')" class="flex items-center gap-1 md:gap-2 hover:text-blue-700 transition-colors whitespace-nowrap">
                                <span>Kategori</span>
                                <span id="sort-icon-category" class="sort-icon shrink-0">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/>
                                    </svg>
                                </span>
                            </button>
                        </th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left font-semibold text-gray-700">
                            <button onclick="toggleSort('stock')" class="flex items-center gap-1 md:gap-2 hover:text-blue-700 transition-colors whitespace-nowrap">
                                <span>Stok</span>
                                <span id="sort-icon-stock" class="sort-icon shrink-0">
                                    <svg class="w-3 h-3 md:w-4 md:h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/>
                                    </svg>
                                </span>
                            </button>
                        </th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-left font-semibold text-gray-700 whitespace-nowrap">Satuan</th>
                        <th class="px-3 md:px-6 py-2 md:py-3 text-center font-semibold text-gray-700 whitespace-nowrap">Aksi</th>
                    </tr>
                </thead>
                <tbody id="tableBody" class="divide-y divide-gray-200 bg-white">
                </tbody>
            </table>
        </div>
        <div class="p-3 md:p-4 border-t border-gray-200">
            <div class="flex flex-col gap-3 md:flex-row md:items-center md:justify-between">
                <div id="paginationInfo" class="text-xs md:text-sm text-gray-600 text-center md:text-left">
                    Loading...
                </div>
                <div id="paginationLinks" class="flex justify-center md:justify-end">
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    let currentPage = 1;
    let perPage = 10;
    let search = '';
    let sortBy = 'created_at';
    let sortDirection = 'desc';
    let searchTimeout;

    document.addEventListener('DOMContentLoaded', function() {
        fetchProducts();

        document.getElementById('perPageSelect').addEventListener('change', function(e) {
            perPage = e.target.value;
            currentPage = 1;
            fetchProducts();
        });

        document.getElementById('searchInput').addEventListener('keyup', function(e) {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                search = e.target.value;
                currentPage = 1;
                fetchProducts();
            }, 300);
        });
    });

    function fetchProducts() {
        const params = new URLSearchParams({
            page: currentPage,
            per_page: perPage,
            search: search,
            sort_by: sortBy,
            sort_direction: sortDirection
        });

        fetch(`{{ route('dashboard.products.fetch') }}?${params}`)
            .then(response => response.json())
            .then(data => {
                renderTable(data.data);
                renderPagination(data);
                updateSortIcons();
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('tableBody').innerHTML = `
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center text-red-500">
                            <p>Terjadi kesalahan saat memuat data</p>
                        </td>
                    </tr>
                `;
            });
    }

    function renderTable(products) {
        const tbody = document.getElementById('tableBody');
        
        if (products.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="5" class="px-6 py-8 md:py-12 text-center text-gray-500">
                        <div class="flex flex-col items-center gap-2">
                            <svg class="w-10 h-10 md:w-12 md:h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                            </svg>
                            <p class="font-medium text-sm md:text-base">Tidak ada data ditemukan</p>
                            <p class="text-xs md:text-sm">Coba ubah kata kunci pencarian</p>
                        </div>
                    </td>
                </tr>
            `;
            return;
        }

        const baseUrl = window.location.origin;
        const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

        tbody.innerHTML = products.map(product => {
            const editUrl = `${baseUrl}/dashboard/products/${product.id}/edit`;
            const deleteUrl = `${baseUrl}/dashboard/products/${product.id}`;
            
            return `
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        ${
                            product.image 
                            ? `<img src="/storage/${product.image}" 
                                    class="w-22 h-22 object-cover rounded-lg border border-gray-200">`
                            : `<div class="w-22 h-22 bg-gray-100 flex items-center justify-center rounded-lg text-gray-400 text-md">
                                    No Img
                            </div>`
                        }
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 font-medium text-gray-800 whitespace-nowrap">
                        ${product.name}
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 text-gray-600 whitespace-nowrap">
                        ${product.category.name}
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <span class="inline-flex items-center px-2 md:px-2.5 py-0.5 md:py-1 text-xs font-semibold rounded-full ${
                            product.stock <= 5 ? 'bg-red-100 text-red-700' : 'bg-green-100 text-green-700'
                        }">
                            ${product.stock}
                        </span>
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 text-gray-600 whitespace-nowrap">
                        ${product.satuan}
                    </td>
                    <td class="px-3 md:px-6 py-3 md:py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center gap-1 md:gap-2">
                            <a href="${editUrl}"
                               class="inline-flex items-center gap-1 px-2 md:px-3 py-1 md:py-1.5 text-xs font-medium text-blue-700 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200">
                                <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                <span class="hidden sm:inline">Edit</span>
                            </a>
                            <form action="${deleteUrl}" method="POST" class="inline" onsubmit="return confirmDelete(event)">
                                <input type="hidden" name="_token" value="${csrfToken}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit"
                                        class="inline-flex items-center gap-1 px-2 md:px-3 py-1 md:py-1.5 text-xs font-medium text-red-700 bg-red-50 rounded-lg hover:bg-red-100 transition-colors duration-200">
                                    <svg class="w-3 h-3 md:w-4 md:h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                    <span class="hidden sm:inline">Hapus</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            `;
        }).join('');
    }

    function renderPagination(data) {
        document.getElementById('paginationInfo').textContent = 
            `Showing ${data.from || 0} to ${data.to || 0} of ${data.total} entries`;

        const paginationLinks = document.getElementById('paginationLinks');
        let html = '<nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-1 md:gap-2">';

        if (data.current_page > 1) {
            html += `<button onclick="changePage(${data.current_page - 1})" class="px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Prev</button>`;
        } else {
            html += `<span class="px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Prev</span>`;
        }

        const maxPages = window.innerWidth < 768 ? 3 : 5;
        let startPage = Math.max(1, data.current_page - Math.floor(maxPages / 2));
        let endPage = Math.min(data.last_page, startPage + maxPages - 1);

        if (endPage - startPage < maxPages - 1) {
            startPage = Math.max(1, endPage - maxPages + 1);
        }

        for (let i = startPage; i <= endPage; i++) {
            if (i === data.current_page) {
                html += `<span class="px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-sm font-semibold text-white bg-blue-700 rounded-lg">${i}</span>`;
            } else {
                html += `<button onclick="changePage(${i})" class="px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">${i}</button>`;
            }
        }
        if (data.current_page < data.last_page) {
            html += `<button onclick="changePage(${data.current_page + 1})" class="px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-sm text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50 transition-colors">Next</button>`;
        } else {
            html += `<span class="px-2 md:px-3 py-1 md:py-1.5 text-xs md:text-sm text-gray-400 bg-gray-100 rounded-lg cursor-not-allowed">Next</span>`;
        }

        html += '</nav>';
        paginationLinks.innerHTML = html;
    }

    function changePage(page) {
        currentPage = page;
        fetchProducts();
    }

    function toggleSort(column) {
        const columnMap = {
            'name': 'name',
            'category': 'category_id',
            'stock': 'stock'
        };

        const dbColumn = columnMap[column];

        if (sortBy === dbColumn) {
            sortDirection = sortDirection === 'asc' ? 'desc' : 'asc';
        } else {
            sortBy = dbColumn;
            sortDirection = 'asc';
        }
        
        fetchProducts();
    }

    function updateSortIcons() {
        document.querySelectorAll('.sort-icon').forEach(icon => {
            icon.innerHTML = `
                <svg class="w-3 h-3 md:w-4 md:h-4 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M5 8l5-5 5 5H5zM5 12l5 5 5-5H5z"/>
                </svg>
            `;
        });

        const columnMap = {
            'name': 'name',
            'category_id': 'category',
            'stock': 'stock'
        };

        const displayColumn = columnMap[sortBy];
        if (displayColumn) {
            const icon = document.getElementById(`sort-icon-${displayColumn}`);
            if (icon) {
                if (sortDirection === 'asc') {
                    icon.innerHTML = `
                        <svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M5 10l5-5 5 5H5z"/>
                        </svg>
                    `;
                } else {
                    icon.innerHTML = `
                        <svg class="w-3 h-3 md:w-4 md:h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M15 10l-5 5-5-5h10z"/>
                        </svg>
                    `;
                }
            }
        }
    }

    function confirmDelete(event) {
        return confirm('Pastikan Barang sudah Kosong sebelum di Hapus.');
    }
</script>
@endsection