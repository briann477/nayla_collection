<nav class="admin-navbar">
    <div class="admin-container admin-nav-inner">
        <div class="admin-nav-left">
            <a href="{{ route('admin.dashboard') }}" class="admin-brand">
                N.A.Y.L.A
                <span>Admin</span>
            </a>

            @auth
            @if (auth()->user()->role === 'admin')
            <div class="admin-menu">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    Kategori
                </a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    Produk
                </a>
                <a href="{{ route('admin.orders.index') }}" class="{{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    Pesanan
                </a>
                <a href="{{ route('admin.reports.index') }}" class="{{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    Laporan
                </a>
            </div>
            @else
            <div class="admin-menu">
                <a href="{{ route('home') }}">Home</a>
                <a href="{{ route('collection') }}">Koleksi</a>
                <a href="{{ route('cart.index') }}">Keranjang</a>
                <a href="{{ route('orders.index') }}">Pesanan Saya</a>
            </div>
            @endif
            @endauth
        </div>

        <div class="admin-nav-right">
            <a href="{{ route('home') }}" class="admin-view-store">
                Lihat Toko
            </a>

            <div class="admin-user-box">
                <div>
                    <strong>{{ Auth::user()->name }}</strong>
                    <span>{{ Auth::user()->role === 'admin' ? 'Administrator' : 'Customer' }}</span>
                </div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>