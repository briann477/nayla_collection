<x-guest-layout>
    <div class="auth-heading">
        <span>Welcome Back</span>
        <h2>Login ke N.A.Y.L.A</h2>
        <p>Masuk untuk melanjutkan belanja dan melihat status pesanan kamu.</p>
    </div>

    @if (session('status'))
    <div class="auth-alert success">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                autocomplete="username"
                placeholder="contoh@email.com">
            @error('email')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                placeholder="Masukkan password">
            @error('password')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div class="auth-row">
            <label class="auth-checkbox">
                <input type="checkbox" name="remember">
                <span>Ingat saya</span>
            </label>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">Lupa password?</a>
            @endif
        </div>

        <button type="submit" class="auth-submit">
            Login
        </button>

        <p class="auth-switch">
            Belum punya akun?
            <a href="{{ route('register') }}">Daftar sekarang</a>
        </p>

        <a href="{{ route('home') }}" class="auth-back-link">
            ← Kembali ke Home
        </a>
    </form>
</x-guest-layout>