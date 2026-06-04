@extends('layouts.store', ['title' => 'Koleksi - N.A.Y.L.A'])

@section('content')
<section class="page-header">
  <div class="store-container">
    <span>Katalog</span>
    <h1>Koleksi N.A.Y.L.A</h1>
    <p>Pilihan busana modest wear dengan nuansa elegan dan soft.</p>
  </div>
</section>

<section class="section-block">
  <div class="store-container">
    <div class="product-grid">
      <div class="product-card">
        <div class="product-image soft-cream"></div>
        <div class="product-info">
          <h3>White Dress Series</h3>
          <p>Busana putih elegan untuk acara spesial.</p>
          <strong>Rp 350.000</strong>
          <a href="#" class="product-link">Detail Produk</a>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image soft-brown"></div>
        <div class="product-info">
          <h3>Brown Modest Set</h3>
          <p>Setelan earth tone yang simple dan rapi.</p>
          <strong>Rp 275.000</strong>
          <a href="#" class="product-link">Detail Produk</a>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image soft-blue"></div>
        <div class="product-info">
          <h3>Soft Blue Dress</h3>
          <p>Dress lembut untuk tampilan anggun.</p>
          <strong>Rp 320.000</strong>
          <a href="#" class="product-link">Detail Produk</a>
        </div>
      </div>

      <div class="product-card">
        <div class="product-image soft-taupe"></div>
        <div class="product-info">
          <h3>Taupe Daily Wear</h3>
          <p>Busana harian dengan warna kalem.</p>
          <strong>Rp 240.000</strong>
          <a href="#" class="product-link">Detail Produk</a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection