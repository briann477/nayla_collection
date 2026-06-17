<x-app-layout>
  <x-slot name="header">
    <div class="report-formal-header">
      <div>
        <span class="admin-page-eyebrow">Sales Report</span>
        <h2>Laporan Penjualan N.A.Y.L.A</h2>

        @if ($startDate && $endDate)
        <p>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} sampai {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        @else
        <p>Periode: Semua transaksi</p>
        @endif
      </div>

      <div class="report-formal-actions">
        <form action="{{ route('admin.reports.index') }}" method="GET" class="report-formal-filter">
          <input type="date" name="start_date" value="{{ $startDate }}">
          <input type="date" name="end_date" value="{{ $endDate }}">
          <button type="submit">Filter</button>
        </form>

        <button type="button" onclick="window.print()" class="report-print-btn">
          Cetak
        </button>
      </div>
    </div>
  </x-slot>

  <div class="admin-crud-page compact-crud-page report-formal-page">
    <div class="report-summary-strip">
      <div>
        <span>Total Pendapatan</span>
        <strong>Rp {{ number_format($totalRevenue, 0, ',', '.') }}</strong>
      </div>

      <div>
        <span>Total Pesanan</span>
        <strong>{{ $totalOrders }}</strong>
      </div>

      <div>
        <span>Item Terjual</span>
        <strong>{{ $totalItemsSold ?? 0 }} pcs</strong>
      </div>

      <div>
        <span>Pesanan Selesai</span>
        <strong>{{ $completedOrders }}</strong>
      </div>

      <div>
        <span>Diproses/Pending</span>
        <strong>{{ $pendingOrders }}</strong>
      </div>

      <div>
        <span>Dibatalkan</span>
        <strong>{{ $cancelledOrders }}</strong>
      </div>
    </div>

    <div class="report-formal-card">
      <div class="report-section-title">
        <h3>Rekap Produk Terjual</h3>
        <p>Ringkasan produk yang paling banyak terjual berdasarkan transaksi yang sudah dibayar.</p>
      </div>

      <div class="report-table-wrap">
        <table class="report-formal-table">
          <thead>
            <tr>
              <th style="width: 70px;">No</th>
              <th>Nama Produk</th>
              <th style="width: 160px;">Qty Terjual</th>
              <th style="width: 180px;" class="text-right">Total Penjualan</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($topProducts as $product)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>
                <strong>{{ $product['name'] }}</strong>
              </td>
              <td>{{ $product['quantity'] }} pcs</td>
              <td class="text-right">
                <strong>Rp {{ number_format($product['subtotal'], 0, ',', '.') }}</strong>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="4">
                <div class="report-empty-row">
                  Belum ada produk terjual.
                </div>
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

    <div class="report-formal-card">
      <div class="report-section-title">
        <h3>Detail Transaksi</h3>
        <p>Daftar transaksi penjualan yang tercatat pada sistem.</p>
      </div>

      <div class="report-table-wrap">
        <table class="report-formal-table">
          <thead>
            <tr>
              <th style="width: 60px;">No</th>
              <th style="width: 120px;">Tanggal</th>
              <th>Kode Pesanan</th>
              <th>Customer</th>
              <th>Produk</th>
              <th style="width: 90px;">Qty</th>
              <th style="width: 140px;">Metode</th>
              <th style="width: 150px;">Status</th>
              <th style="width: 160px;" class="text-right">Total</th>
            </tr>
          </thead>

          <tbody>
            @forelse ($orders as $order)
            <tr>
              <td>{{ $loop->iteration }}</td>

              <td>{{ $order->created_at->format('d/m/Y') }}</td>

              <td>
                <strong>{{ $order->order_code }}</strong>
              </td>

              <td>{{ $order->customer_name }}</td>

              <td>
                <div class="report-product-lines">
                  @forelse ($order->items as $item)
                  <span>{{ $item->product_name }} ({{ $item->quantity }} pcs)</span>
                  @empty
                  <span>-</span>
                  @endforelse
                </div>
              </td>

              <td>{{ $order->items->sum('quantity') }} pcs</td>

              <td>{{ $order->paymentMethodLabel() }}</td>

              <td>
                <div class="report-status-lines">
                  <span>{{ $order->paymentStatusLabel() }}</span>
                  <small>{{ $order->orderStatusLabel() }}</small>
                </div>
              </td>

              <td class="text-right">
                <strong>Rp {{ number_format($order->total, 0, ',', '.') }}</strong>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="9">
                <div class="report-empty-row">
                  Belum ada transaksi.
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