@extends('layouts.store', ['title' => 'Detail Pesanan - N.A.Y.L.A'])

@section('content')
<section class="orders-section customer-order-detail-page">
  <div class="store-container">
    <a href="{{ route('orders.index') }}" class="back-link">← Kembali ke Pesanan Saya</a>

    @if (session('success'))
    <div class="store-alert success">
      {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="store-alert error">
      {{ session('error') }}
    </div>
    @endif

    <div class="customer-detail-header">
      <div>
        <span class="eyebrow">Order Detail</span>
        <h1>Detail Pesanan</h1>
        <p>Kode pesanan: <strong>{{ $order->order_code }}</strong></p>
      </div>

      <div class="customer-detail-total">
        <span>Total Pembayaran</span>
        <strong>{{ $order->formattedTotal() }}</strong>
      </div>
    </div>

    <div class="customer-detail-grid">
      <div class="customer-detail-main">
        <div class="customer-detail-card">
          <div class="customer-detail-card-head">
            <h3>Produk Dipesan</h3>
            <p>Daftar produk yang kamu beli pada pesanan ini.</p>
          </div>

          <div class="customer-detail-products">
            @foreach ($order->items as $item)
            <div class="customer-detail-product-row">
              @if ($item->product && $item->product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
              <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}">
              @else
              <div class="customer-detail-product-placeholder">N</div>
              @endif

              <div class="customer-detail-product-info">
                <strong>{{ $item->product_name }}</strong>
                <span>{{ $item->quantity }} pcs × {{ $item->formattedPrice() }}</span>
              </div>

              <strong class="customer-detail-product-subtotal">
                {{ $item->formattedSubtotal() }}
              </strong>
            </div>
            @endforeach
          </div>
        </div>

        <div class="customer-detail-card">
          <div class="customer-detail-card-head">
            <h3>Informasi Pesanan</h3>
            <p>Detail pembayaran, alamat, dan status pesanan.</p>
          </div>

          <div class="customer-info-grid">
            <div>
              <span>Metode Pembayaran</span>
              <strong>{{ $order->paymentMethodLabel() }}</strong>
            </div>

            <div>
              <span>Status Pembayaran</span>
              <strong>{{ $order->paymentStatusLabel() }}</strong>
            </div>

            <div>
              <span>Status Pesanan</span>
              <strong>{{ $order->orderStatusLabel() }}</strong>
            </div>

            <div>
              <span>No. HP</span>
              <strong>{{ $order->phone }}</strong>
            </div>

            <div class="full">
              <span>Alamat Pengiriman</span>
              <strong>{{ $order->address }}</strong>
            </div>

            @if ($order->notes)
            <div class="full">
              <span>Catatan</span>
              <strong>{{ $order->notes }}</strong>
            </div>
            @endif
          </div>
        </div>

        @if ($order->payment_method !== 'cod')
        <div class="customer-detail-card">
          <div class="customer-detail-card-head">
            <h3>Bukti Pembayaran</h3>
            <p>Bukti pembayaran yang kamu unggah untuk pesanan ini.</p>
          </div>

          @if ($order->payment_proof)
          <div class="customer-proof-box">
            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran">
          </div>
          @else
          <div class="customer-proof-empty">
            <strong>Belum ada bukti pembayaran.</strong>
            <span>Silakan upload bukti pembayaran agar admin dapat melakukan verifikasi.</span>
          </div>
          @endif

          @if ($order->payment_status !== 'paid')
          <a href="{{ route('checkout.payment', $order) }}" class="btn-primary-store payment-btn">
            Upload / Lihat Pembayaran
          </a>
          @endif
        </div>
        @endif

        @if ($order->order_status === 'shipped')
        <div class="order-complete-box customer-complete-box">
          <h3>Pesanan sudah sampai?</h3>
          <p>
            Klik tombol di bawah jika produk sudah diterima dengan baik.
            Status pesanan akan berubah menjadi selesai.
          </p>

          <form action="{{ route('orders.complete', $order) }}" method="POST" onsubmit="return confirm('Tandai pesanan ini sebagai diterima?')">
            @csrf
            @method('PUT')

            <button type="submit" class="btn-primary-store">
              Pesanan Diterima
            </button>
          </form>
        </div>
        @endif

        @if ($order->order_status === 'completed')
        <div class="order-completed-note">
          Pesanan ini sudah selesai. Terima kasih sudah berbelanja di N.A.Y.L.A.
        </div>
        @endif
      </div>

      <aside class="customer-detail-summary">
        <h3>Ringkasan</h3>

        <div class="payment-total-lines">
          <div>
            <span>Subtotal</span>
            <strong>{{ $order->formattedSubtotal() }}</strong>
          </div>

          <div>
            <span>Ongkir</span>
            <strong>{{ $order->formattedShippingCost() }}</strong>
          </div>

          <div>
            <span>Total</span>
            <strong>{{ $order->formattedTotal() }}</strong>
          </div>
        </div>

        @if ($order->payment_method === 'transfer' && $order->va_number)
        <div class="customer-payment-code">
          <span>Virtual Account</span>
          <strong>{{ $order->va_number }}</strong>
        </div>
        @endif

        @if ($order->payment_method === 'qris' && $order->qris_code)
        <div class="customer-payment-code">
          <span>QRIS Dummy</span>
          <strong>{{ $order->qris_code }}</strong>
        </div>
        @endif

        <a href="{{ route('collection') }}" class="btn-secondary-store payment-btn">
          Belanja Lagi
        </a>
      </aside>
    </div>
  </div>
</section>
@endsection