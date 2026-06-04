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
      <p>Preview produk yang nanti akan tersambung dengan database katalog.</p>
    </div>

    <div class="product-grid">
      <div class="product-card">
        <div class="product-image soft-cream"></div>
        <div class="product-info">
          <h3>White Dress Series</h3>
          <p>Busana putih elegan untuk acara spesial.</p>
          <strong>Rp 350.000</strong>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image soft-brown"></div>
        <div class="product-info">
          <h3>Brown Modest Set</h3>
          <p>Setelan kalem dengan warna earth tone.</p>
          <strong>Rp 275.000</strong>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image soft-blue"></div>
        <div class="product-info">
          <h3>Soft Blue Dress</h3>
          <p>Tampilan anggun dengan warna lembut.</p>
          <strong>Rp 320.000</strong>
        </div>
      </div>
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