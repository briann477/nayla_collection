<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>{{ $title ?? 'N.A.Y.L.A' }}</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="nayla-body">
  <nav class="store-navbar">
    <div class="store-container nav-inner">
      <a href="{{ route('home') }}" class="brand-logo">N.A.Y.L.A</a>

      <button class="nav-toggle" id="navToggle" type="button" aria-label="Toggle navigation">
        <span></span>
        <span></span>
        <span></span>
      </button>

      <div class="nav-menu" id="navMenu">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('collection') }}" class="{{ request()->routeIs('collection') ? 'active' : '' }}">Koleksi</a>
        <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Tentang</a>
        <a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Kontak</a>

        @auth
        <a href="{{ route('dashboard') }}" class="nav-pill">Dashboard</a>
        @else
        <a href="{{ route('login') }}" class="nav-pill">Login</a>
        @endauth
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>

  <footer class="store-footer">
    <div class="store-container footer-grid">
      <div>
        <h3>N.A.Y.L.A</h3>
        <p>Elegant modest wear collection for graceful daily and special moments.</p>
      </div>

      <div>
        <h4>Menu</h4>
        <a href="{{ route('home') }}">Home</a>
        <a href="{{ route('collection') }}">Koleksi</a>
        <a href="{{ route('about') }}">Tentang</a>
        <a href="{{ route('contact') }}">Kontak</a>
      </div>

      <div>
        <h4>Kontak</h4>
        <p>Depok, Indonesia</p>
        <p>@new_naylacollection</p>
      </div>
    </div>

    <div class="footer-bottom">
      © {{ date('Y') }} N.A.Y.L.A / Nayla Collection. All rights reserved.
    </div>
  </footer>

  <script>
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');

    if (navToggle && navMenu) {
      navToggle.addEventListener('click', function() {
        navMenu.classList.toggle('show');
      });
    }
  </script>
</body>

</html>