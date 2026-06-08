<x-guest-layout>
    <div class="auth-clean-heading">
        <span>Create Account</span>
        <h2>Daftar</h2>
        <p>Buat akun customer untuk mulai belanja koleksi N.A.Y.L.A.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="auth-clean-form">
        @csrf

        <div>
            <label for="name">Nama Lengkap</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                autocomplete="name"
                placeholder="Nama kamu">
            @error('name')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
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
                autocomplete="new-password"
                placeholder="Minimal 8 karakter">
            @error('password')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password_confirmation">Konfirmasi Password</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                autocomplete="new-password"
                placeholder="Ulangi password">
            @error('password_confirmation')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-clean-submit">
            Daftar
        </button>

        <p class="auth-clean-switch">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </p>

        <a href="{{ route('home') }}" class="auth-clean-back">
            Kembali ke Home
        </a>
    </form>
</x-guest-layout>