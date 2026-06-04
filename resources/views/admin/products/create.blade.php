<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Tambah Produk
    </h2>
  </x-slot>

  <div class="py-10">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
          @csrf

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
            <select name="category_id" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900" required>
              <option value="">Pilih Kategori</option>
              @foreach ($categories as $category)
              <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
              @endforeach
            </select>
            @error('category_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name') }}" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900" required>
            @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Harga</label>
              <input type="number" name="price" value="{{ old('price') }}" min="0" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900" required>
              @error('price')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Stok</label>
              <input type="number" name="stock" value="{{ old('stock', 0) }}" min="0" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900" required>
              @error('stock')
              <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi</label>
            <textarea name="description" rows="5" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900">{{ old('description') }}</textarea>
            @error('description')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Foto Produk</label>
            <input type="file" name="image" class="w-full rounded-lg border border-gray-300 p-3">
            <p class="text-xs text-gray-500 mt-1">Format: JPG, JPEG, PNG, WEBP. Maksimal 2MB.</p>
            @error('image')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
            @enderror
          </div>

          <label class="flex items-center gap-2">
            <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-gray-900 focus:ring-gray-900" checked>
            <span class="text-sm text-gray-700">Aktif</span>
          </label>

          <div class="flex justify-end gap-3">
            <a href="{{ route('admin.products.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
              Batal
            </a>
            <button type="submit" class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-700">
              Simpan
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
</x-app-layout>