<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Dashboard Admin N.A.Y.L.A
    </h2>
  </x-slot>

  <div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Produk</p>
          <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $productCount }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Kategori</p>
          <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $categoryCount }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Pesanan</p>
          <h3 class="text-3xl font-bold text-gray-900 mt-2">0</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Customer</p>
          <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $customerCount }}</h3>
        </div>
      </div>

      <div class="bg-white mt-6 p-6 rounded-2xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-900">Menu Admin</h3>
        <p class="text-gray-500 mt-1">
          Kelola data kategori, produk, pesanan, pembayaran, dan laporan penjualan.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
          <a href="{{ route('admin.categories.index') }}" class="p-5 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
            <span class="block font-semibold text-gray-900">Kelola Kategori</span>
            <span class="block text-sm text-gray-500 mt-1">Tambah dan ubah kategori.</span>
          </a>

          <a href="{{ route('admin.products.index') }}" class="p-5 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
            <span class="block font-semibold text-gray-900">Kelola Produk</span>
            <span class="block text-sm text-gray-500 mt-1">Tambah produk dan stok.</span>
          </a>

          <a href="#" class="p-5 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
            <span class="block font-semibold text-gray-900">Kelola Pesanan</span>
            <span class="block text-sm text-gray-500 mt-1">Segera dibuat.</span>
          </a>

          <a href="#" class="p-5 rounded-xl border border-gray-200 hover:bg-gray-50 transition">
            <span class="block font-semibold text-gray-900">Laporan</span>
            <span class="block text-sm text-gray-500 mt-1">Segera dibuat.</span>
          </a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>