<x-guest-layout>
    <div class="auth-heading">
        <span>New Password</span>
        <h2>Reset Password</h2>
        <p>Buat password baru untuk akun N.A.Y.L.A kamu.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="auth-form">
        @csrf

        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div>
            <label for="email">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                required
                autofocus
                autocomplete="username">
            @error('email')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="password">Password Baru</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="new-password"
                placeholder="Password baru">
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
                placeholder="Ulangi password baru">
            @error('password_confirmation')
            <p class="auth-error">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="auth-submit">
            Simpan Password Baru
        </button>
    </form>
</x-guest-layout>