<x-app-layout>
  <x-slot name="header">
    <div class="admin-page-title-row category-title-compact">
      <div>
        <span class="admin-page-eyebrow">Order Management</span>
        <h2>Kelola Pesanan</h2>
        <p>Cek pesanan masuk, metode pembayaran, dan status pemrosesan customer.</p>
      </div>

      <div class="admin-title-side">
        <a href="{{ route('admin.reports.index') }}" class="admin-primary-btn">
          Lihat Laporan
        </a>

        <div class="admin-inline-stats">
          <div>
            <span>Total</span>
            <strong>{{ $orders->total() }}</strong>
          </div>

          <div>
            <span>List</span>
            <strong>{{ $orders->count() }}</strong>
          </div>
        </div>
      </div>
    </div>
  </x-slot>

  <div class="admin-crud-page compact-crud-page">
    <div class="admin-table-card admin-order-card-shell">
      <div class="admin-table-head compact-table-head">
        <div>
          <h3>Daftar Pesanan</h3>
          <p>Pesanan terbaru customer akan tampil di sini untuk diverifikasi dan diproses admin.</p>
        </div>
      </div>

      <div class="admin-order-list-v2">
        @forelse ($orders as $order)
        <div class="admin-order-card-v2">
          <div class="admin-order-top-v2">
            <div>
              <span class="admin-order-label">Kode Pesanan</span>
              <strong>{{ $order->order_code }}</strong>
              <small>{{ $order->created_at->format('d M Y') }}</small>
            </div>

            <div class="admin-order-total-v2">
              <span class="admin-order-label">Total</span>
              <strong>{{ $order->formattedTotal() }}</strong>
            </div>
          </div>

          <div class="admin-order-mid-v2">
            <div>
              <span class="admin-order-label">Customer</span>
              <strong>{{ $order->customer_name }}</strong>
              <small>{{ $order->phone }}</small>
            </div>

            <div>
              <span class="admin-order-label">Metode</span>
              <strong>{{ $order->paymentMethodLabel() }}</strong>
            </div>
          </div>

          <div class="admin-order-bottom-v2">
            <div class="admin-order-statuses-v2">
              @if ($order->payment_status === 'paid')
              <span class="admin-status active">{{ $order->paymentStatusLabel() }}</span>
              @elseif ($order->payment_status === 'waiting_confirmation')
              <span class="admin-status warning">{{ $order->paymentStatusLabel() }}</span>
              @else
              <span class="admin-status inactive">{{ $order->paymentStatusLabel() }}</span>
              @endif

              @if ($order->order_status === 'completed')
              <span class="admin-status active">{{ $order->orderStatusLabel() }}</span>
              @elseif ($order->order_status === 'cancelled')
              <span class="admin-status inactive">{{ $order->orderStatusLabel() }}</span>
              @else
              <span class="admin-status info">{{ $order->orderStatusLabel() }}</span>
              @endif
            </div>

            <a href="{{ route('admin.orders.show', $order) }}" class="admin-detail-btn-v2">
              Detail
            </a>
          </div>
        </div>
        @empty
        <div class="admin-empty-state">
          <strong>Belum ada pesanan.</strong>
          <span>Pesanan customer akan muncul setelah checkout berhasil.</span>
        </div>
        @endforelse
      </div>
    </div>

    <div class="admin-pagination">
      {{ $orders->links() }}
    </div>
  </div>
</x-app-layout>