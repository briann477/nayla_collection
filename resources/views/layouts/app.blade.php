<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>N.A.Y.L.A Admin</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700|playfair-display:600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="admin-body">
    <div class="admin-shell">
        @include('layouts.navigation')

        <main class="admin-main">
            @isset($header)
            <header class="admin-page-header">
                <div class="admin-container">
                    {{ $header }}
                </div>
            </header>
            @endisset

            <div class="admin-container">
                {{ $slot }}
            </div>
        </main>
    </div>
</body>

</html>