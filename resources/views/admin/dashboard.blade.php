<x-app-layout>
  <x-slot name="header">
    <div class="admin-dashboard-title">
      <span>Admin Center</span>
      <h2>Dashboard N.A.Y.L.A</h2>
      <p>Kelola produk, pesanan, pembayaran, dan laporan penjualan dari satu tempat.</p>
    </div>
  </x-slot>

  <div class="admin-dashboard-page">
    <div class="admin-dashboard-hero">
      <div>
        <span class="admin-hero-eyebrow">Welcome Back</span>
        <h1>Halo, {{ auth()->user()->name }}</h1>
        <p>
          Pantau aktivitas toko N.A.Y.L.A, cek pesanan terbaru, dan siapkan laporan untuk owner.
        </p>
      </div>

      <div class="admin-hero-card">
        <span>Total Pendapatan</span>
        <strong>Rp {{ number_format($paidRevenue, 0, ',', '.') }}</strong>
        <small>Dari pembayaran yang sudah dikonfirmasi.</small>
      </div>
    </div>

    <div class="admin-stat-grid">
      <div class="admin-stat-card">
        <span>Produk</span>
        <strong>{{ $productCount }}</strong>
        <p>Total katalog produk.</p>
      </div>

      <div class="admin-stat-card">
        <span>Kategori</span>
        <strong>{{ $categoryCount }}</strong>
        <p>Kategori produk aktif.</p>
      </div>

      <div class="admin-stat-card">
        <span>Pesanan</span>
        <strong>{{ $orderCount }}</strong>
        <p>Total pesanan masuk.</p>
      </div>

      <div class="admin-stat-card">
        <span>Customer</span>
        <strong>{{ $customerCount }}</strong>
        <p>Akun customer terdaftar.</p>
      </div>
    </div>

    <div class="admin-dashboard-grid">
      <div class="admin-panel-card">
        <div class="admin-panel-head">
          <div>
            <span>Quick Menu</span>
            <h3>Menu Admin</h3>
          </div>
          <p>{{ $pendingOrderCount }} pesanan masih perlu dipantau.</p>
        </div>

        <div class="admin-shortcut-grid">
          <a href="{{ route('admin.categories.index') }}" class="admin-shortcut-card">
            <span>01</span>
            <h4>Kelola Kategori</h4>
            <p>Tambah dan ubah kategori produk.</p>
          </a>

          <a href="{{ route('admin.products.index') }}" class="admin-shortcut-card">
            <span>02</span>
            <h4>Kelola Produk</h4>
            <p>Atur produk, harga, stok, dan status.</p>
          </a>

          <a href="{{ route('admin.orders.index') }}" class="admin-shortcut-card">
            <span>03</span>
            <h4>Kelola Pesanan</h4>
            <p>Cek pembayaran dan update status pesanan.</p>
          </a>

          <a href="{{ route('admin.reports.index') }}" class="admin-shortcut-card">
            <span>04</span>
            <h4>Laporan</h4>
            <p>Lihat rekap penjualan untuk owner.</p>
          </a>
        </div>
      </div>

      <div class="admin-panel-card">
        <div class="admin-panel-head">
          <div>
            <span>Latest Orders</span>
            <h3>Pesanan Terbaru</h3>
          </div>

          <a href="{{ route('admin.orders.index') }}">Lihat Semua</a>
        </div>

        <div class="admin-latest-orders">
          @forelse ($latestOrders as $order)
          <a href="{{ route('admin.orders.show', $order) }}" class="admin-latest-order">
            <div>
              <strong>{{ $order->order_code }}</strong>
              <span>{{ $order->customer_name }}</span>
            </div>

            <div>
              <strong>{{ $order->formattedTotal() }}</strong>
              <span>{{ $order->orderStatusLabel() }}</span>
            </div>
          </a>
          @empty
          <div class="admin-empty-mini">
            <strong>Belum ada pesanan.</strong>
            <span>Pesanan customer akan tampil di sini.</span>
          </div>
          @endforelse
        </div>
      </div>
    </div>
  </div>
</x-app-layout>