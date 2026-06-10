@extends('layouts.store', ['title' => $product->name . ' - N.A.Y.L.A'])

@section('content')
<section class="detail-v2-section">
  <div class="store-container">
    <a href="{{ route('collection') }}" class="detail-v2-back">
      ← Kembali ke Koleksi
    </a>

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

    <div class="detail-v2-grid">
      <div class="detail-v2-gallery">
        <div class="detail-v2-image-card">
          @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
          <img
            src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->name }}"
            class="detail-v2-photo">
          @else
          <div class="detail-v2-placeholder">
            <span>N.A.Y.L.A</span>
          </div>
          @endif

          <div class="detail-v2-image-badge">
            {{ $product->stock > 0 ? 'Ready Stock' : 'Sold Out' }}
          </div>
        </div>
      </div>

      <div class="detail-v2-info-card">
        <span class="detail-v2-category">
          {{ $product->category->name ?? 'Produk' }}
        </span>

        <h1>{{ $product->name }}</h1>

        <div class="detail-v2-price">
          {{ $product->formattedPrice() }}
        </div>

        <div class="detail-v2-meta-grid">
          <div>
            <span>Stok</span>
            <strong>{{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Stok habis' }}</strong>
          </div>

          <div>
            <span>Status</span>
            <strong>{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</strong>
          </div>
        </div>

        <div class="detail-v2-description">
          <h3>Deskripsi Produk</h3>
          <p>
            {{ $product->description ?: 'Koleksi busana elegan N.A.Y.L.A dengan karakter modest, soft, dan timeless.' }}
          </p>
        </div>

        <div class="detail-v2-action-box">
          @auth
          @if (auth()->user()->role === 'customer')
          <form action="{{ route('cart.store', $product) }}" method="POST" class="detail-v2-cart-form">
            @csrf

            <div class="detail-v2-qty">
              <label for="quantity">Jumlah</label>
              <input
                type="number"
                id="quantity"
                name="quantity"
                value="1"
                min="1"
                max="{{ $product->stock }}"
                {{ $product->stock <= 0 ? 'disabled' : '' }}>
            </div>

            @error('quantity')
            <p class="form-error">{{ $message }}</p>
            @enderror

            <button class="btn-primary-store detail-v2-main-btn" type="submit" {{ $product->stock <= 0 ? 'disabled' : '' }}>
              Tambah ke Keranjang
            </button>
          </form>
          @else
          <a href="{{ route('admin.products.edit', $product) }}" class="btn-primary-store detail-v2-main-btn">
            Edit Produk
          </a>
          @endif
          @else
          <a href="{{ route('login') }}" class="btn-primary-store detail-v2-main-btn">
            Login untuk Belanja
          </a>
          @endauth

          <a href="{{ route('collection') }}" class="btn-secondary-store detail-v2-secondary-btn">
            Lihat Produk Lain
          </a>
        </div>

        <div class="detail-v2-note">
          <strong>Informasi Pembayaran</strong>
          <span>
            Pembayaran tersedia melalui COD, Transfer VA dummy, dan QRIS dummy.
            Untuk transfer dan QRIS, customer dapat upload bukti pembayaran setelah checkout.
          </span>
        </div>
      </div>
    </div>
  </div>
</section>

@if ($relatedProducts->count() > 0)
<section class="detail-v2-related">
  <div class="store-container">
    <div class="home-v2-section-head center">
      <span>Related</span>
      <h2>Produk Serupa</h2>
      <p>Koleksi lain dari kategori yang sama.</p>
    </div>

    <div class="collection-v2-grid">
      @foreach ($relatedProducts as $related)
      <article class="collection-v2-card">
        <a href="{{ route('product.detail', $related->slug) }}" class="collection-v2-image-wrap">
          @if ($related->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($related->image))
          <img
            src="{{ asset('storage/' . $related->image) }}"
            class="collection-v2-photo"
            alt="{{ $related->name }}">
          @else
          <div class="collection-v2-placeholder">
            <span>N.A.Y.L.A</span>
          </div>
          @endif

          <div class="collection-v2-badge">
            {{ $related->stock > 0 ? 'Ready Stock' : 'Sold Out' }}
          </div>
        </a>

        <div class="collection-v2-info">
          <div class="collection-v2-meta">
            <span>{{ $related->category->name ?? 'Produk' }}</span>
            <small>Stok {{ $related->stock }}</small>
          </div>

          <h3>{{ $related->name }}</h3>

          <p>
            {{ Str::limit($related->description, 90) ?: 'Koleksi busana elegan N.A.Y.L.A.' }}
          </p>

          <div class="collection-v2-bottom">
            <strong>{{ $related->formattedPrice() }}</strong>

            <a href="{{ route('product.detail', $related->slug) }}">
              Detail
            </a>
          </div>
        </div>
      </article>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection