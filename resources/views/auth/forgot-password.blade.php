<x-guest-layout>
    <div class="auth-heading">
        <span>Reset Access</span>
        <h2>Lupa Password?</h2>
        <p>
            Masukkan email akun kamu. Jika tersedia, link reset password akan dikirimkan.
        </p>
    </div>

    @if (session('status'))
    <div class="auth-alert success">
        {{ session('status') }}
    </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="auth-form">
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
                placeholder="contoh@email.com">
            @error('email')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-submit">
            Kirim Link Reset
        </button>

        <p class="auth-switch">
            Ingat password?
            <a href="{{ route('login') }}">Kembali login</a>
        </p>
    </form>
</x-guest-layout>