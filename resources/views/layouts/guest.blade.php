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

<body class="auth-clean-body">
    <main class="auth-clean-page">
        <div class="auth-clean-bg bg-one"></div>
        <div class="auth-clean-bg bg-two"></div>

        <section class="auth-clean-shell">
            <a href="{{ route('home') }}" class="auth-clean-logo">
                N.A.Y.L.A
            </a>

            <p class="auth-clean-tagline">
                Elegant modest wear collection
            </p>

            <div class="auth-clean-card">
                {{ $slot }}
            </div>

            <p class="auth-clean-footer">
                Nayla Collection Depok • Soft • Elegant • Modest
            </p>
        </section>
    </main>
</body>

</html>