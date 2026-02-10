<h2>Barang Masuk</h2>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form action="{{ route('stock-in.store') }}" method="POST">
    @csrf

    <label>Produk</label>
    <select name="product_id">
        @foreach ($products as $product)
            <option value="{{ $product->id }}">
                {{ $product->name }} (stok: {{ $product->stock }})
            </option>
        @endforeach
    </select>

    <label>Jumlah</label>
    <input type="number" name="qty" min="1">

    <label>Keterangan</label>
    <input type="text" name="description">

    <button type="submit">Tambah</button>
</form>
