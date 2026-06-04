<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Dashboard Admin N.A.Y.L.A
    </h2>
  </x-slot>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Produk</p>
          <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Kategori</p>
          <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Pesanan</p>
          <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
        </div>

        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Customer</p>
          <h3 class="text-3xl font-bold text-gray-800 mt-2">0</h3>
        </div>
      </div>

      <div class="bg-white mt-6 p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800">Menu Admin</h3>
        <p class="text-gray-500 mt-1">
          Kelola data kategori, produk, pesanan, pembayaran, dan laporan penjualan.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-6">
          <a href="{{ route('admin.categories.index') }}" class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
            Kelola Kategori
          </a>
          <a href="{{ route('admin.products.index') }}" class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
            Kelola Produk
          </a>
          <a href="#" class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
            Kelola Pesanan
          </a>
          <a href="#" class="p-4 rounded-lg border border-gray-200 hover:bg-gray-50 transition">
            Laporan
          </a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>