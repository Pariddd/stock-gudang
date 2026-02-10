<form method="POST" action="{{ route('products.store') }}">
    @csrf

    <input name="name" placeholder="Nama produk">

    <select name="category_id">
        @foreach ($categories as $category)
            <option value="{{ $category->id }}">{{ $category->name }}</option>
        @endforeach
    </select>

    <input name="satuan" placeholder="pcs / kg / box">

    <button type="submit">Simpan</button>
</form>
