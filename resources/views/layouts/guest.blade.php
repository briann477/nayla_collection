<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N.A.Y.L.A Auth</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="auth-body">
    <main class="auth-page">
        <section class="auth-brand-panel">
            <a href="{{ route('home') }}" class="auth-brand-logo">N.A.Y.L.A</a>

            <div class="auth-brand-copy">
                <span>Modest Fashion Collection</span>
                <h1>Elegant wear for graceful moments.</h1>
                <p>
                    Masuk ke akun kamu untuk melanjutkan belanja koleksi busana
                    elegan N.A.Y.L.A.
                </p>
            </div>

            <div class="auth-mini-card">
                <strong>Soft • Elegant • Modest</strong>
                <small>Nayla Collection Depok</small>
            </div>
        </section>

        <section class="auth-form-panel">
            <div class="auth-card">
                {{ $slot }}
            </div>
        </section>
    </main>
</body>

</html>