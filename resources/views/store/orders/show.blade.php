@extends('layouts.store', ['title' => 'Detail Pesanan - N.A.Y.L.A'])

@section('content')
<section class="orders-section">
  <div class="store-container">
    <a href="{{ route('orders.index') }}" class="back-link">← Kembali ke Pesanan Saya</a>

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

          @if ($order->payment_method !== 'cod' && $order->payment_status !== 'paid')
          <a href="{{ route('checkout.payment', $order) }}" class="btn-primary-store payment-btn">
            Lihat Pembayaran
          </a>
          @endif
        </div>

        <div class="payment-summary-box">
          <h3>Produk Dipesan</h3>

          <div class="payment-items">
            @foreach ($order->items as $item)
            <div>
              <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
              <strong>{{ $item->formattedSubtotal() }}</strong>
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
        </div>
      </div>
    </div>
  </div>
</section>
@endsection