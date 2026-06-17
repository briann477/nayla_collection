<x-app-layout>
  <x-slot name="header">
    <div class="admin-page-title-row category-title-compact">
      <div>
        <span class="admin-page-eyebrow">Order Detail</span>
        <h2>Detail Pesanan</h2>
        <p>Periksa data customer, bukti pembayaran, produk, dan status pesanan.</p>
      </div>

      <a href="{{ route('admin.orders.index') }}" class="admin-primary-btn admin-secondary-dark">
        Kembali
      </a>
    </div>
  </x-slot>

  <div class="admin-crud-page compact-crud-page">
    @if (session('success'))
    <div class="admin-alert success">
      {{ session('success') }}
    </div>
    @endif

    <div class="admin-order-detail-layout">
      <div class="admin-order-detail-left">
        <div class="admin-table-card admin-order-info-card">
          <div class="admin-table-head compact-table-head">
            <div>
              <h3>Informasi Pesanan</h3>
              <p>Kode pesanan: <strong>{{ $order->order_code }}</strong></p>
            </div>
          </div>

          <div class="admin-order-info-grid">
            <div>
              <span>Customer</span>
              <strong>{{ $order->customer_name }}</strong>
            </div>

            <div>
              <span>No. HP</span>
              <strong>{{ $order->phone }}</strong>
            </div>

            <div>
              <span>Metode Pembayaran</span>
              <strong>{{ $order->paymentMethodLabel() }}</strong>
            </div>

            <div>
              <span>Tanggal Pesanan</span>
              <strong>{{ $order->created_at->format('d M Y H:i') }}</strong>
            </div>

            <div class="wide">
              <span>Alamat</span>
              <strong>{{ $order->address }}</strong>
            </div>

            @if ($order->notes)
            <div class="wide">
              <span>Catatan</span>
              <strong>{{ $order->notes }}</strong>
            </div>
            @endif
          </div>
        </div>

        @if ($order->payment_method !== 'cod')
        <div class="admin-table-card admin-proof-card">
          <div class="admin-table-head compact-table-head">
            <div>
              <h3>Bukti Pembayaran</h3>
              <p>Bukti upload customer untuk pembayaran {{ $order->paymentMethodLabel() }}.</p>
            </div>
          </div>

          <div class="admin-proof-content">
            @if ($order->payment_proof)
            <a href="{{ asset('storage/' . $order->payment_proof) }}" target="_blank" class="admin-proof-image-wrap">
              <img
                src="{{ asset('storage/' . $order->payment_proof) }}"
                alt="Bukti Pembayaran">
            </a>

            <p>Klik gambar untuk membuka bukti pembayaran ukuran penuh.</p>
            @else
            <div class="admin-empty-state compact-empty">
              <strong>Belum ada bukti pembayaran.</strong>
              <span>Customer belum mengupload bukti pembayaran.</span>
            </div>
            @endif
          </div>
        </div>
        @endif

        <div class="admin-table-card admin-order-products-card">
          <div class="admin-table-head compact-table-head">
            <div>
              <h3>Produk Dipesan</h3>
              <p>Daftar produk yang ada pada pesanan ini.</p>
            </div>
          </div>

          <div class="admin-order-product-list">
            @foreach ($order->items as $item)
            <div class="admin-order-product-item">
              <div class="admin-order-product-main">
                @if ($item->product && $item->product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
                <img
                  src="{{ asset('storage/' . $item->product->image) }}"
                  alt="{{ $item->product_name }}">
                @else
                <div class="admin-order-product-placeholder">
                  N
                </div>
                @endif

                <div>
                  <strong>{{ $item->product_name }}</strong>
                  <span>{{ $item->quantity }} x {{ $item->formattedPrice() }}</span>
                </div>
              </div>

              <strong class="admin-order-product-subtotal">
                {{ $item->formattedSubtotal() }}
              </strong>
            </div>
            @endforeach
          </div>
        </div>
      </div>

      <div class="admin-order-detail-right">
        <div class="admin-table-card admin-status-panel">
          <div class="admin-table-head compact-table-head">
            <div>
              <h3>Update Status</h3>
              <p>Ubah status pembayaran dan pesanan.</p>
            </div>
          </div>

          <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="admin-status-form">
            @csrf
            @method('PUT')

            <div>
              <label>Status Pembayaran</label>
              <select name="payment_status">
                <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Belum Dibayar</option>
                <option value="waiting_confirmation" {{ $order->payment_status === 'waiting_confirmation' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
              </select>
            </div>

            <div>
              <label>Status Pesanan</label>
              <select name="order_status">
                <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Menunggu Diproses</option>
                <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="completed" {{ $order->order_status === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
              </select>
            </div>

            <button type="submit" class="admin-status-submit">
              Simpan Status
            </button>
          </form>

          <div class="admin-order-total-box">
            <div>
              <span>Subtotal</span>
              <strong>{{ $order->formattedSubtotal() }}</strong>
            </div>

            <div>
              <span>Ongkir</span>
              <strong>{{ $order->formattedShippingCost() }}</strong>
            </div>

            <div class="total">
              <span>Total</span>
              <strong>{{ $order->formattedTotal() }}</strong>
            </div>
          </div>

          @if ($order->payment_method === 'transfer')
          <div class="admin-payment-code-box">
            <span>VA Dummy</span>
            <strong>{{ $order->va_number }}</strong>
          </div>
          @endif

          @if ($order->payment_method === 'qris')
          <div class="admin-payment-code-box">
            <span>QRIS Dummy</span>
            <strong>{{ $order->qris_code }}</strong>
          </div>
          @endif

          <div class="admin-status-current">
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
        </div>
      </div>
    </div>
  </div>
</x-app-layout>