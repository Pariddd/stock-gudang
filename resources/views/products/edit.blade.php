<form method="POST" action="{{ route('products.update', $product) }}">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Nama Produk:</label>
        <input 
            type="text" 
            name="name" 
            id="name" 
            value="{{ old('name', $product->name) }}" 
            placeholder="Nama produk"
        >
        @error('name')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="category_id">Kategori:</label>
        <select name="category_id" id="category_id">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option 
                    value="{{ $category->id }}" 
                    {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}
                >
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('category_id')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <label for="satuan">Satuan:</label>
        <input 
            type="text" 
            name="satuan" 
            id="satuan" 
            value="{{ old('satuan', $product->satuan) }}" 
            placeholder="pcs / kg / box"
        >
        @error('satuan')
            <span>{{ $message }}</span>
        @enderror
    </div>

    <div>
        <button type="submit">Simpan</button>
        <a href="{{ route('products.index') }}">Batal</a>
    </div>
</form>