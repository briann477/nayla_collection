@extends('layouts.store', ['title' => 'Dashboard Customer - N.A.Y.L.A'])

@section('content')
<section class="customer-dashboard-section">
  <div class="store-container">
    <div class="dashboard-welcome">
      <div>
        <span class="eyebrow">Customer Area</span>
        <h1>Halo, {{ auth()->user()->name }}</h1>
        <p>
          Selamat datang di akun N.A.Y.L.A. Dari sini kamu bisa lanjut belanja,
          melihat keranjang, dan nanti memantau status pesanan.
        </p>
      </div>

      <a href="{{ route('collection') }}" class="btn-primary-store">
        Lihat Koleksi
      </a>
    </div>

    <div class="customer-menu-grid">
      <a href="{{ route('collection') }}" class="customer-menu-card">
        <span>01</span>
        <h3>Koleksi Produk</h3>
        <p>Lihat katalog busana N.A.Y.L.A yang tersedia.</p>
      </a>

      <a href="#" class="customer-menu-card">
        <span>02</span>
        <h3>Keranjang</h3>
        <p>Produk yang kamu pilih nanti akan muncul di sini.</p>
      </a>

      <a href="#" class="customer-menu-card">
        <span>03</span>
        <h3>Pesanan Saya</h3>
        <p>Pantau status pesanan setelah checkout.</p>
      </a>
    </div>
  </div>
</section>
@endsection