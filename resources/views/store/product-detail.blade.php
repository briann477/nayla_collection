@extends('layouts.store', ['title' => $product->name . ' - N.A.Y.L.A'])

@section('content')
<section class="product-detail-section">
  <div class="store-container">
    <a href="{{ route('collection') }}" class="back-link">← Kembali ke Koleksi</a>

    <div class="detail-grid">
      <div class="detail-image-card">
        @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="detail-photo">
        @else
        <div class="detail-placeholder">
          <span>N.A.Y.L.A</span>
        </div>
        @endif
      </div>

      <div class="detail-content">
        <span class="detail-category">{{ $product->category->name ?? 'Produk' }}</span>
        <h1>{{ $product->name }}</h1>

        <div class="detail-price">
          {{ $product->formattedPrice() }}
        </div>

        <div class="detail-meta">
          <div>
            <span>Stok</span>
            <strong>{{ $product->stock > 0 ? $product->stock . ' tersedia' : 'Stok habis' }}</strong>
          </div>

          <div>
            <span>Status</span>
            <strong>{{ $product->is_active ? 'Aktif' : 'Nonaktif' }}</strong>
          </div>
        </div>

        <div class="detail-description">
          <h3>Deskripsi Produk</h3>
          <p>
            {{ $product->description ?: 'Koleksi busana elegan N.A.Y.L.A dengan karakter modest, soft, dan timeless.' }}
          </p>
        </div>

        <div class="detail-actions">
          @auth
          @if (auth()->user()->role === 'customer')
          <button class="btn-primary-store" type="button">
            Tambah ke Keranjang
          </button>
          @else
          <a href="{{ route('admin.products.edit', $product) }}" class="btn-primary-store">
            Edit Produk
          </a>
          @endif
          @else
          <a href="{{ route('login') }}" class="btn-primary-store">
            Login untuk Belanja
          </a>
          @endauth

          <a href="{{ route('collection') }}" class="btn-secondary-store">
            Lihat Produk Lain
          </a>
        </div>

        <div class="detail-note">
          Pembayaran dilakukan melalui transfer manual dan bukti pembayaran akan diverifikasi oleh admin.
        </div>
      </div>
    </div>
  </div>
</section>

@if ($relatedProducts->count() > 0)
<section class="section-block">
  <div class="store-container">
    <div class="section-heading">
      <span>Related</span>
      <h2>Produk Serupa</h2>
      <p>Koleksi lain dari kategori yang sama.</p>
    </div>

    <div class="product-grid">
      @foreach ($relatedProducts as $related)
      <div class="product-card">
        @if ($related->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($related->image))
        <img src="{{ asset('storage/' . $related->image) }}" class="product-photo" alt="{{ $related->name }}">
        @else
        <div class="product-image soft-cream product-placeholder">
          <span>N.A.Y.L.A</span>
        </div>
        @endif

        <div class="product-info">
          <small>{{ $related->category->name ?? 'Produk' }}</small>
          <h3>{{ $related->name }}</h3>
          <p>{{ Str::limit($related->description, 70) ?: 'Koleksi busana elegan N.A.Y.L.A.' }}</p>
          <strong>{{ $related->formattedPrice() }}</strong>
          <a href="{{ route('product.detail', $related->slug) }}" class="product-link">Detail Produk</a>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>
@endif
@endsection