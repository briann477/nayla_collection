@extends('layouts.store', ['title' => 'Pesanan Berhasil - N.A.Y.L.A'])

@section('content')
<section class="checkout-success-section">
  <div class="store-container">
    <div class="success-card">
      <span class="eyebrow">Order Created</span>
      <h1>Pesanan Berhasil Dibuat</h1>
      <p>
        Kode pesanan kamu: <strong>{{ $order->order_code }}</strong>
      </p>

      <div class="success-grid">
        <div class="success-info">
          <h3>Detail Pesanan</h3>

          <div class="info-row">
            <span>Nama</span>
            <strong>{{ $order->customer_name }}</strong>
          </div>

          <div class="info-row">
            <span>No. HP</span>
            <strong>{{ $order->phone }}</strong>
          </div>

          <div class="info-row">
            <span>Alamat</span>
            <strong>{{ $order->address }}</strong>
          </div>

          <div class="info-row">
            <span>Metode Pembayaran</span>
            <strong>{{ $order->paymentMethodLabel() }}</strong>
          </div>

          <div class="info-row">
            <span>Status Pembayaran</span>
            <strong>{{ $order->paymentStatusLabel() }}</strong>
          </div>

          <div class="info-row">
            <span>Status Pesanan</span>
            <strong>{{ $order->orderStatusLabel() }}</strong>
          </div>
        </div>

        <div class="payment-instruction">
          @if ($order->payment_method === 'cod')
          <h3>Instruksi COD</h3>
          <p>
            Pesanan akan diproses oleh admin. Pembayaran dilakukan saat barang diterima.
          </p>
          <div class="payment-badge">
            Bayar di Tempat
          </div>
          @endif

          @if ($order->payment_method === 'transfer')
          <h3>Transfer Virtual Account</h3>
          <p>
            Silakan transfer ke nomor VA dummy berikut:
          </p>

          <div class="va-box">
            {{ $order->va_number }}
          </div>

          <p class="dummy-note">
            Nomor ini hanya dummy untuk demo aplikasi.
          </p>
          @endif

          @if ($order->payment_method === 'qris')
          <h3>QRIS Dummy</h3>
          <p>
            Scan QRIS dummy berikut untuk simulasi pembayaran.
          </p>

          <div class="dummy-qris">
            <span></span><span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span><span></span>
            <span></span><span></span><span></span><span></span><span></span><span></span>
          </div>

          <div class="qris-code">
            {{ $order->qris_code }}
          </div>

          <p class="dummy-note">
            QRIS ini hanya visual dummy, bukan pembayaran asli.
          </p>
          @endif
        </div>
      </div>

      <div class="order-items-box">
        <h3>Produk Dipesan</h3>

        @foreach ($order->items as $item)
        <div class="order-item-row">
          <div>
            <strong>{{ $item->product_name }}</strong>
            <span>{{ $item->quantity }} x {{ $item->formattedPrice() }}</span>
          </div>
          <strong>{{ $item->formattedSubtotal() }}</strong>
        </div>
        @endforeach

        <div class="order-total-box">
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
      </div>

      <div class="success-actions">
        <a href="{{ route('collection') }}" class="btn-secondary-store">
          Belanja Lagi
        </a>

        <a href="{{ route('home') }}" class="btn-primary-store">
          Kembali ke Home
        </a>
      </div>
    </div>
  </div>
</section>
@endsection