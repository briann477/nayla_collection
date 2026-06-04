@extends('layouts.store')

@section('content')
<section class="hero-section">
  <div class="store-container hero-grid">
    <div class="hero-copy">
      <span class="eyebrow">Modest Fashion Collection</span>
      <h1>N.A.Y.L.A</h1>
      <p>
        Koleksi busana wanita elegan dengan sentuhan clean, soft, dan timeless
        untuk momen harian maupun acara spesial.
      </p>

      <div class="hero-actions">
        <a href="{{ route('collection') }}" class="btn-primary-store">Lihat Koleksi</a>
        <a href="{{ route('about') }}" class="btn-secondary-store">Tentang Brand</a>
      </div>
    </div>

    <div class="hero-card">
      <div class="hero-image-placeholder">
        <span>Elegant Wear</span>
      </div>
      <div class="floating-card">
        <strong>New Collection</strong>
        <small>Soft • Elegant • Modest</small>
      </div>
    </div>
  </div>
</section>

<section class="section-block">
  <div class="store-container">
    <div class="section-heading">
      <span>Featured</span>
      <h2>Koleksi Pilihan</h2>
      <p>Produk terbaru dari katalog N.A.Y.L.A.</p>
    </div>

    <div class="product-grid">
      @forelse ($featuredProducts as $product)
      <div class="product-card">
        @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
        <img
          src="{{ asset('storage/' . $product->image) }}"
          class="product-photo"
          alt="{{ $product->name }}">
        @else
        <div class="product-image soft-cream product-placeholder">
          <span>N.A.Y.L.A</span>
        </div>
        @endif

        <div class="product-info">
          <small>{{ $product->category->name ?? 'Produk' }}</small>
          <h3>{{ $product->name }}</h3>
          <p>{{ Str::limit($product->description, 70) ?: 'Koleksi busana elegan N.A.Y.L.A.' }}</p>
          <strong>{{ $product->formattedPrice() }}</strong>
          <a href="{{ route('product.detail', $product->slug) }}" class="product-link">Detail Produk</a>
        </div>
      </div>
      @empty
      <div class="empty-store">
        <h3>Belum ada produk.</h3>
        <p>Produk akan tampil setelah admin menambahkan katalog.</p>
      </div>
      @endforelse
    </div>
  </div>
</section>

<section class="promo-section">
  <div class="store-container promo-box">
    <div>
      <span>Simple Shopping</span>
      <h2>Belanja lebih mudah melalui website resmi N.A.Y.L.A.</h2>
    </div>
    <a href="{{ route('collection') }}" class="btn-primary-store">Mulai Belanja</a>
  </div>
</section>
@endsection