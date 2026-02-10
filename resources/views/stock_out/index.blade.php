<h2>Barang Keluar</h2>

@if (session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

@if ($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<form action="{{ route('stock-out.store') }}" method="POST">
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

    <button type="submit">Kurangi</button>
</form>
