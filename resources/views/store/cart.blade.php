@extends('layouts.store', ['title' => 'Keranjang - N.A.Y.L.A'])

@section('content')
<section class="cart-section">
  <div class="store-container">
    <div class="cart-header">
      <div>
        <span class="eyebrow">Shopping Cart</span>
        <h1>Keranjang Belanja</h1>
        <p>Periksa kembali produk pilihanmu sebelum lanjut ke checkout.</p>
      </div>

      <a href="{{ route('collection') }}" class="btn-secondary-store">
        Lanjut Belanja
      </a>
    </div>

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

    <div class="cart-layout">
      <div class="cart-list">
        @forelse ($cartItems as $item)
        <div class="cart-item">
          <div class="cart-product">
            @if ($item->product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
            <img src="{{ asset('storage/' . $item->product->image) }}" alt="{{ $item->product->name }}">
            @else
            <div class="cart-image-placeholder">N</div>
            @endif

            <div>
              <span>{{ $item->product->category->name ?? 'Produk' }}</span>
              <h3>{{ $item->product->name }}</h3>
              <p>{{ $item->product->formattedPrice() }}</p>
            </div>
          </div>

          <div class="cart-actions">
            <form action="{{ route('cart.update', $item) }}" method="POST" class="cart-qty-form">
              @csrf
              @method('PUT')

              <input
                type="number"
                name="quantity"
                min="1"
                max="{{ $item->product->stock }}"
                value="{{ $item->quantity }}">

              <button type="submit">
                Update
              </button>
            </form>

            <div class="cart-subtotal">
              {{ $item->formattedSubtotal() }}
            </div>

            <form action="{{ route('cart.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus produk dari keranjang?')">
              @csrf
              @method('DELETE')

              <button type="submit" class="cart-remove-btn">
                Hapus
              </button>
            </form>
          </div>
        </div>
        @empty
        <div class="empty-cart">
          <h3>Keranjang masih kosong.</h3>
          <p>Yuk pilih produk N.A.Y.L.A dulu sebelum checkout.</p>
          <a href="{{ route('collection') }}" class="btn-primary-store">
            Lihat Koleksi
          </a>
        </div>
        @endforelse
      </div>

      <div class="cart-summary">
        <h3>Ringkasan Belanja</h3>

        <div class="summary-row">
          <span>Total Item</span>
          <strong>{{ $cartItems->sum('quantity') }}</strong>
        </div>

        <div class="summary-row">
          <span>Total Belanja</span>
          <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
        </div>

        @if ($cartItems->count() > 0)
        <a href="{{ route('checkout.index') }}" class="btn-primary-store summary-btn">
          Lanjut Checkout
        </a>
        @else
        <a href="{{ route('collection') }}" class="btn-secondary-store summary-btn">
          Pilih Produk
        </a>
        @endif

        <p>
          Ongkir dan data pengiriman akan diisi pada tahap checkout.
        </p>
      </div>
    </div>
  </div>
</section>
@endsection