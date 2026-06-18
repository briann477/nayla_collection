<x-app-layout>
  <x-slot name="header">
    <div class="admin-page-title-row category-title-compact">
      <div>
        <span class="admin-page-eyebrow">Product Management</span>
        <h2>Tambah Produk</h2>
        <p>Tambahkan produk fashion baru ke katalog N.A.Y.L.A.</p>
      </div>

      <a href="{{ route('admin.products.index') }}" class="admin-primary-btn admin-secondary-dark">
        Kembali
      </a>
    </div>
  </x-slot>

  <div class="admin-crud-page compact-crud-page">
    <div class="admin-form-layout">
      <div class="admin-table-card admin-form-card">
        <div class="admin-table-head compact-table-head">
          <div>
            <h3>Data Produk</h3>
            <p>Isi informasi produk dengan lengkap agar tampil rapi pada halaman koleksi.</p>
          </div>
        </div>

        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" class="admin-form">
          @csrf

          <div class="admin-form-grid">
            <div class="admin-form-group">
              <label for="name">Nama Produk</label>
              <input
                type="text"
                id="name"
                name="name"
                value="{{ old('name') }}"
                placeholder="Contoh: Dress Elegant"
                required>
              @error('name')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>

            <div class="admin-form-group">
              <label for="category_id">Kategori</label>
              <select id="category_id" name="category_id" required>
                <option value="">Pilih kategori</option>
                @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                  {{ $category->name }}
                </option>
                @endforeach
              </select>
              @error('category_id')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>

            <div class="admin-form-group">
              <label for="price">Harga</label>
              <input
                type="number"
                id="price"
                name="price"
                value="{{ old('price') }}"
                placeholder="Contoh: 150000"
                min="0"
                required>
              @error('price')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>

            <div class="admin-form-group">
              <label for="stock">Stok</label>
              <input
                type="number"
                id="stock"
                name="stock"
                value="{{ old('stock') }}"
                placeholder="Contoh: 10"
                min="0"
                required>
              @error('stock')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>

            <div class="admin-form-group">
              <label for="is_active">Status Produk</label>
              <select id="is_active" name="is_active" required>
                <option value="1" {{ old('is_active', '1') == '1' ? 'selected' : '' }}>Aktif</option>
                <option value="0" {{ old('is_active') == '0' ? 'selected' : '' }}>Nonaktif</option>
              </select>
              @error('is_active')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>

            <div class="admin-form-group">
              <label for="image">Gambar Produk</label>
              <input
                type="file"
                id="image"
                name="image"
                accept="image/*">
              @error('image')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>

            <div class="admin-form-group full">
              <label for="description">Deskripsi Produk</label>
              <textarea
                id="description"
                name="description"
                rows="5"
                placeholder="Tulis deskripsi singkat produk...">{{ old('description') }}</textarea>
              @error('description')
              <small class="admin-form-error">{{ $message }}</small>
              @enderror
            </div>
          </div>

          <div class="admin-form-actions">
            <a href="{{ route('admin.products.index') }}" class="admin-cancel-btn">
              Batal
            </a>

            <button type="submit" class="admin-submit-btn">
              Simpan Produk
            </button>
          </div>
        </form>
      </div>

      <div class="admin-table-card admin-form-help">
        <div class="admin-table-head compact-table-head">
          <div>
            <h3>Catatan</h3>
            <p>Panduan singkat pengisian produk.</p>
          </div>
        </div>

        <div class="admin-help-list">
          <div>
            <strong>Nama produk</strong>
            <span>Gunakan nama singkat dan jelas agar mudah dibaca customer.</span>
          </div>

          <div>
            <strong>Harga</strong>
            <span>Isi angka tanpa titik atau simbol rupiah. Contoh: 150000.</span>
          </div>

          <div>
            <strong>Gambar</strong>
            <span>Gunakan foto produk yang jelas dan tidak terlalu gelap.</span>
          </div>

          <div>
            <strong>Status</strong>
            <span>Produk aktif akan tampil pada katalog customer.</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>