<x-app-layout>
  <x-slot name="header">
    <div class="admin-page-title-row category-title-compact">
      <div>
        <span class="admin-page-eyebrow">Product Management</span>
        <h2>Kelola Produk</h2>
        <p>Atur data produk fashion yang tampil pada katalog N.A.Y.L.A.</p>
      </div>

      <div class="admin-title-side">
        <a href="{{ route('admin.products.create') }}" class="admin-primary-btn">
          Tambah Produk
        </a>

        <div class="admin-inline-stats">
          <div>
            <span>Total</span>
            <strong>{{ $products->count() }}</strong>
          </div>

          <div>
            <span>Aktif</span>
            <strong>{{ $products->where('is_active', true)->count() }}</strong>
          </div>
        </div>
      </div>
    </div>
  </x-slot>

  <div class="admin-crud-page compact-crud-page">
    @if (session('success'))
    <div class="admin-alert success">
      {{ session('success') }}
    </div>
    @endif

    <div class="admin-table-card">
      <div class="admin-table-head compact-table-head">
        <div>
          <h3>Daftar Produk</h3>
          <p>Produk yang ditampilkan pada halaman koleksi pelanggan.</p>
        </div>
      </div>

      <div class="admin-table-wrapper">
        <table class="admin-data-table admin-product-table">
          <thead>
            <tr>
              <th>Produk</th>
              <th>Kategori</th>
              <th>Harga</th>
              <th>Stok</th>
              <th>Status</th>
              <th class="text-right">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($products as $product)
            <tr>
              <td>
                <div class="admin-product-cell">
                  @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
                  <img
                    src="{{ asset('storage/' . $product->image) }}"
                    alt="{{ $product->name }}"
                    class="admin-product-thumb">
                  @else
                  <div class="admin-product-thumb-placeholder">
                    N
                  </div>
                  @endif

                  <div class="admin-table-main-text">
                    <strong>{{ $product->name }}</strong>
                  </div>
                </div>
              </td>

              <td>
                {{ $product->category->name ?? '-' }}
              </td>

              <td>
                <strong class="admin-price-text">
                  {{ $product->formattedPrice() }}
                </strong>
              </td>

              <td>
                {{ $product->stock }}
              </td>

              <td>
                @if ($product->is_active)
                <span class="admin-status active">Aktif</span>
                @else
                <span class="admin-status inactive">Nonaktif</span>
                @endif
              </td>

              <td>
                <div class="admin-action-group">
                  <a href="{{ route('admin.products.edit', $product) }}" class="admin-action edit">
                    Edit
                  </a>

                  <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                    @csrf
                    @method('DELETE')

                    <button type="submit" class="admin-action delete">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6">
                <div class="admin-empty-state">
                  <strong>Belum ada produk.</strong>
                  <span>Tambahkan produk pertama untuk mulai menampilkan katalog N.A.Y.L.A.</span>
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>
</x-app-layout>