<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Dashboard Customer
    </h2>
  </x-slot>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100">
        <h3 class="text-lg font-semibold text-gray-800">Selamat datang di N.A.Y.L.A</h3>
        <p class="text-gray-500 mt-1">
          Dari halaman ini kamu bisa melihat riwayat pesanan dan melanjutkan belanja.
        </p>

        <div class="mt-6">
          <a href="{{ route('collection') }}" class="inline-flex px-5 py-3 bg-gray-900 text-white rounded-lg hover:bg-gray-700 transition">
            Lihat Koleksi
          </a>
        </div>
      </div>
    </div>
  </div>
</x-app-layout>