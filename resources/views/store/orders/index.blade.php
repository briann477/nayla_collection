@extends('layouts.store', ['title' => 'Pesanan Saya - N.A.Y.L.A'])

@section('content')
<section class="orders-section">
  <div class="store-container">
    <div class="cart-header">
      <div>
        <span class="eyebrow">My Orders</span>
        <h1>Pesanan Saya</h1>
        <p>Lihat riwayat dan status pesanan kamu di N.A.Y.L.A.</p>
      </div>

      <a href="{{ route('collection') }}" class="btn-secondary-store">
        Belanja Lagi
      </a>
    </div>

    <div class="orders-list">
      @forelse ($orders as $order)
      <div class="order-card">
        <div>
          <span class="order-code">{{ $order->order_code }}</span>
          <h3>{{ $order->formattedTotal() }}</h3>
          <p>{{ $order->paymentMethodLabel() }}</p>
        </div>

        <div class="order-status-group">
          <span class="status-pill">{{ $order->paymentStatusLabel() }}</span>
          <span class="status-pill">{{ $order->orderStatusLabel() }}</span>
        </div>

        <a href="{{ route('orders.show', $order) }}" class="btn-primary-store">
          Detail
        </a>
      </div>
      @empty
      <div class="empty-cart">
        <h3>Belum ada pesanan.</h3>
        <p>Pesanan kamu akan muncul setelah checkout berhasil.</p>
        <a href="{{ route('collection') }}" class="btn-primary-store">
          Lihat Koleksi
        </a>
      </div>
      @endforelse
    </div>

    <div class="store-pagination">
      {{ $orders->links() }}
    </div>
  </div>
</section>
@endsection