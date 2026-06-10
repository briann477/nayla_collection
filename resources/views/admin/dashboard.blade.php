<x-app-layout>
  <x-slot name="header">
    <div class="admin-dashboard-title admin-dashboard-title-simple">
      <span>Admin Center</span>
      <h2>Dashboard N.A.Y.L.A</h2>
      <p>Ringkasan aktivitas toko, pesanan terbaru, dan laporan penjualan.</p>
    </div>
  </x-slot>

  <div class="admin-dashboard-page admin-dashboard-page-simple">
    <div class="admin-stat-grid admin-stat-grid-five">
      <div class="admin-stat-card admin-stat-revenue">
        <span>Pendapatan</span>
        <strong>Rp {{ number_format($paidRevenue, 0, ',', '.') }}</strong>
        <p>Pembayaran sudah dikonfirmasi.</p>
      </div>

      <a href="{{ route('admin.products.index') }}" class="admin-stat-card admin-stat-link">
        <span>Produk</span>
        <strong>{{ $productCount }}</strong>
        <p>Total katalog produk.</p>
      </a>

      <a href="{{ route('admin.categories.index') }}" class="admin-stat-card admin-stat-link">
        <span>Kategori</span>
        <strong>{{ $categoryCount }}</strong>
        <p>Kategori tersedia.</p>
      </a>

      <a href="{{ route('admin.orders.index') }}" class="admin-stat-card admin-stat-link">
        <span>Pesanan</span>
        <strong>{{ $orderCount }}</strong>
        <p>Total pesanan masuk.</p>
      </a>

      <div class="admin-stat-card">
        <span>Customer</span>
        <strong>{{ $customerCount }}</strong>
        <p>Akun customer terdaftar.</p>
      </div>
    </div>

    <div class="admin-dashboard-grid clean-dashboard-grid">
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

      <div class="admin-panel-card admin-summary-card">
        <div class="admin-panel-head">
          <div>
            <span>Overview</span>
            <h3>Ringkasan</h3>
          </div>
        </div>

        <div class="admin-summary-list">
          <div>
            <span>Pesanan perlu dipantau</span>
            <strong>{{ $pendingOrderCount }}</strong>
          </div>

          <div>
            <span>Total transaksi</span>
            <strong>{{ $orderCount }}</strong>
          </div>

          <div>
            <span>Produk tersedia</span>
            <strong>{{ $productCount }}</strong>
          </div>
        </div>

        <a href="{{ route('admin.reports.index') }}" class="admin-report-button">
          Lihat Laporan Penjualan
        </a>
      </div>
    </div>
  </div>
</x-app-layout>