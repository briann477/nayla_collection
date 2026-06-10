<x-app-layout>
  <x-slot name="header">
    <div class="admin-page-title-row category-title-compact">
      <div>
        <span class="admin-page-eyebrow">Category Management</span>
        <h2>Kelola Kategori</h2>
        <p>Atur kategori produk yang tampil pada katalog N.A.Y.L.A.</p>
      </div>

      <div class="admin-title-side">
        <a href="{{ route('admin.categories.create') }}" class="admin-primary-btn">
          Tambah Kategori
        </a>

        <div class="admin-inline-stats">
          <div>
            <span>Total</span>
            <strong>{{ $categories->count() }}</strong>
          </div>

          <div>
            <span>Aktif</span>
            <strong>{{ $categories->where('is_active', true)->count() }}</strong>
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
          <h3>Daftar Kategori</h3>
          <p>Kategori digunakan untuk mengelompokkan produk pada halaman koleksi.</p>
        </div>
      </div>

      <div class="admin-table-wrapper">
        <table class="admin-data-table">
          <thead>
            <tr>
              <th>Nama</th>
              <th>Deskripsi</th>
              <th>Status</th>
              <th class="text-right">Aksi</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($categories as $category)
            <tr>
              <td>
                <div class="admin-table-main-text">
                  <strong>{{ $category->name }}</strong>
                  <span>{{ $category->slug }}</span>
                </div>
              </td>

              <td>
                {{ $category->description ?: '-' }}
              </td>

              <td>
                @if ($category->is_active)
                <span class="admin-status active">Aktif</span>
                @else
                <span class="admin-status inactive">Nonaktif</span>
                @endif
              </td>

              <td>
                <div class="admin-action-group">
                  <a href="{{ route('admin.categories.edit', $category) }}" class="admin-action edit">
                    Edit
                  </a>

                  <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
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
              <td colspan="4">
                <div class="admin-empty-state">
                  <strong>Belum ada kategori.</strong>
                  <span>Tambahkan kategori pertama untuk mulai mengelompokkan produk.</span>
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