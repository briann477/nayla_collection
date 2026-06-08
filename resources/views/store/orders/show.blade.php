@extends('layouts.store', ['title' => 'Detail Pesanan - N.A.Y.L.A'])

@section('content')
<section class="orders-section">
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

    <div class="payment-page-card">
      <div class="payment-page-header">
        <span class="eyebrow">Order Detail</span>
        <h1>Detail Pesanan</h1>
        <p>Kode pesanan: <strong>{{ $order->order_code }}</strong></p>
      </div>

      <div class="payment-page-grid">
        <div class="payment-main-box">
          <h2>{{ $order->formattedTotal() }}</h2>
          <p>{{ $order->paymentMethodLabel() }}</p>

          <div class="payment-info-row">
            <span>Status Pembayaran</span>
            <strong>{{ $order->paymentStatusLabel() }}</strong>
          </div>

          <div class="payment-info-row">
            <span>Status Pesanan</span>
            <strong>{{ $order->orderStatusLabel() }}</strong>
          </div>

          <div class="payment-info-row">
            <span>Alamat</span>
            <strong>{{ $order->address }}</strong>
          </div>

          @if ($order->payment_method !== 'cod')
          <div class="payment-info-row">
            <span>Bukti Pembayaran</span>

            @if ($order->payment_proof)
            <strong>Sudah diupload</strong>
            <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran" class="order-proof-preview">
            @else
            <strong>Belum diupload</strong>
            @endif
          </div>

          @if ($order->payment_status !== 'paid')
          <a href="{{ route('checkout.payment', $order) }}" class="btn-primary-store payment-btn">
            Upload / Lihat Pembayaran
          </a>
          @endif
          @endif

          @if ($order->order_status === 'shipped')
          <div class="order-complete-box">
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

        <div class="payment-summary-box">
          <h3>Produk Dipesan</h3>

          <div class="order-product-list">
            @foreach ($order->items as $item)
            <div class="order-product-row">
              @if ($item->product && $item->product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
              <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}">
              @else
              <div class="order-product-placeholder">N</div>
              @endif

              <div class="order-product-info">
                <strong>{{ $item->product_name }}</strong>
                <span>{{ $item->quantity }} x {{ $item->formattedPrice() }}</span>
              </div>

              <strong class="order-product-subtotal">
                {{ $item->formattedSubtotal() }}
              </strong>
            </div>
            @endforeach
          </div>

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

          <a href="{{ route('collection') }}" class="btn-secondary-store payment-btn">
            Belanja Lagi
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection