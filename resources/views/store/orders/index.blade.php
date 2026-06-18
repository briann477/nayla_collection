@extends('layouts.store', ['title' => 'Pesanan Saya - N.A.Y.L.A'])

@section('content')
<section class="orders-section customer-orders-page">
  <div class="store-container">
    <div class="cart-header customer-orders-header">
      <div>
        <span class="eyebrow">My Orders</span>
        <h1>Pesanan Saya</h1>
        <p>Lihat riwayat produk, pembayaran, dan status pesanan kamu di N.A.Y.L.A.</p>
      </div>

      <a href="{{ route('collection') }}" class="btn-secondary-store">
        Belanja Lagi
      </a>
    </div>

    <div class="customer-orders-list">
      @forelse ($orders as $order)
      <article class="customer-order-card">
        <div class="customer-order-main">
          <div class="customer-order-code">
            <span>Kode Pesanan</span>
            <strong>{{ $order->order_code }}</strong>
            <small>{{ $order->created_at->format('d M Y') }} • {{ $order->paymentMethodLabel() }}</small>
          </div>

          <div class="customer-order-products">
            @foreach ($order->items->take(2) as $item)
            <div class="customer-order-product">
              @if ($item->product && $item->product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
              <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product_name }}">
              @else
              <div class="customer-order-product-placeholder">N</div>
              @endif

              <div>
                <strong>{{ $item->product_name }}</strong>
                <span>{{ $item->quantity }} pcs • {{ $item->formattedSubtotal() }}</span>
              </div>
            </div>
            @endforeach

            @if ($order->items->count() > 2)
            <div class="customer-order-more">
              +{{ $order->items->count() - 2 }} produk lainnya
            </div>
            @endif
          </div>
        </div>

        <div class="customer-order-side">
          <div class="customer-order-total">
            <span>Total</span>
            <strong>{{ $order->formattedTotal() }}</strong>
          </div>

          <div class="customer-order-status">
            <span class="status-pill">{{ $order->paymentStatusLabel() }}</span>
            <span class="status-pill">{{ $order->orderStatusLabel() }}</span>
          </div>

          <a href="{{ route('orders.show', $order) }}" class="btn-primary-store customer-order-detail-btn">
            Detail
          </a>
        </div>
      </article>
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