@extends('layouts.store', ['title' => 'Home - N.A.Y.L.A'])

@section('content')
<section class="home-v2-hero">
  <div class="store-container">
    <div class="home-v2-grid">
      <div class="home-v2-copy">
        <span class="home-v2-eyebrow">Modest Fashion Collection</span>

        <h1>N.A.Y.L.A</h1>

        <p class="home-v2-lead">
          Koleksi busana wanita elegan dengan sentuhan clean, soft, dan timeless
          untuk aktivitas harian maupun momen spesial.
        </p>

        <div class="home-v2-actions">
          <a href="{{ route('collection') }}" class="btn-primary-store">Lihat Koleksi</a>
          <a href="{{ route('about') }}" class="btn-secondary-store">Tentang Brand</a>
        </div>

        <div class="home-v2-points">
          <div>
            <strong>Soft</strong>
            <span>Desain feminin dan clean</span>
          </div>
          <div>
            <strong>Elegant</strong>
            <span>Look simple tapi tetap classy</span>
          </div>
          <div>
            <strong>Comfort</strong>
            <span>Nyaman untuk dipakai harian</span>
          </div>
        </div>
      </div>

      <div class="home-v2-visual">
        <div class="home-v2-visual-frame">
          <div class="home-v2-floating-card top">
            <span>New Collection</span>
            <strong>Soft • Elegant • Modest</strong>
          </div>

          <div class="home-v2-visual-main">
            <div class="home-v2-visual-main-inner">
              <span class="small-label">N.A.Y.L.A</span>
              <h3>Elegant Wear</h3>
              <p>Clean silhouette for graceful moments.</p>
            </div>
          </div>

          <div class="home-v2-floating-card bottom">
            <strong>Ready for every moment</strong>
            <span>Daily wear • special occasion • timeless style</span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="home-v2-features">
  <div class="store-container">
    <div class="home-v2-section-head center">
      <span>Why Choose Us</span>
      <h2>Simple, elegant, and made to feel effortless.</h2>
      <p>
        N.A.Y.L.A menghadirkan koleksi dengan tampilan clean dan nuansa feminin
        untuk customer yang suka look rapi tapi tetap nyaman.
      </p>
    </div>

    <div class="home-v2-feature-grid">
      <div class="home-v2-feature-card">
        <div class="home-v2-icon">01</div>
        <h3>Elegant Style</h3>
        <p>
          Potongan busana yang simpel namun tetap terlihat manis dan berkelas.
        </p>
      </div>

      <div class="home-v2-feature-card">
        <div class="home-v2-icon">02</div>
        <h3>Easy Shopping</h3>
        <p>
          Alur belanja mudah mulai dari koleksi, checkout, hingga tracking pesanan.
        </p>
      </div>

      <div class="home-v2-feature-card">
        <div class="home-v2-icon">03</div>
        <h3>Flexible Payment</h3>
        <p>
          Tersedia pembayaran COD, transfer virtual account dummy, dan QRIS dummy.
        </p>
      </div>
    </div>
  </div>
</section>

<section class="home-v2-categories">
  <div class="store-container">
    <div class="home-v2-section-head">
      <span>Explore</span>
      <h2>Koleksi Pilihan N.A.Y.L.A</h2>
      <p>
        Temukan busana dengan nuansa anggun, lembut, dan cocok untuk berbagai suasana.
      </p>
    </div>

    <div class="home-v2-category-grid">
      <a href="{{ route('collection') }}" class="home-v2-category-card">
        <span>01</span>
        <h3>Dress Collection</h3>
        <p>Busana anggun untuk daily wear dan special occasion.</p>
        <strong>Lihat Koleksi</strong>
      </a>

      <a href="{{ route('collection') }}" class="home-v2-category-card">
        <span>02</span>
        <h3>Soft Neutral Tone</h3>
        <p>Palet warna lembut dengan kesan clean dan timeless.</p>
        <strong>Lihat Koleksi</strong>
      </a>

      <a href="{{ route('collection') }}" class="home-v2-category-card">
        <span>03</span>
        <h3>Modest Elegant Look</h3>
        <p>Gaya sopan yang tetap stylish dan nyaman digunakan.</p>
        <strong>Lihat Koleksi</strong>
      </a>
    </div>
  </div>
</section>

<section class="home-v2-cta">
  <div class="store-container">
    <div class="home-v2-cta-box">
      <div>
        <span>Start Shopping</span>
        <h2>Temukan koleksi yang cocok untuk gayamu.</h2>
        <p>
          Jelajahi koleksi N.A.Y.L.A dan nikmati pengalaman belanja yang simple,
          clean, dan elegan.
        </p>
      </div>

      <div class="home-v2-cta-actions">
        <a href="{{ route('collection') }}" class="btn-primary-store">Belanja Sekarang</a>
        <a href="{{ route('contact') }}" class="btn-secondary-store">Hubungi Kami</a>
      </div>
    </div>
  </div>
</section>
@endsection