<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Kelola Produk
      </h2>

      <a href="{{ route('admin.products.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-700">
        Tambah Produk
      </a>
    </div>
  </x-slot>

  <div class="py-10">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200">
        {{ session('success') }}
      </div>
      @endif

      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-gray-600">
            <tr>
              <th class="px-6 py-4 text-left">Produk</th>
              <th class="px-6 py-4 text-left">Kategori</th>
              <th class="px-6 py-4 text-left">Harga</th>
              <th class="px-6 py-4 text-left">Stok</th>
              <th class="px-6 py-4 text-left">Status</th>
              <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @forelse ($products as $product)
            <tr>
              <td class="px-6 py-4">
                <div class="flex items-center gap-3">
                  @if ($product->image)
                  <img src="{{ asset('storage/' . $product->image) }}" class="w-14 h-14 rounded-lg object-cover" alt="{{ $product->name }}">
                  @else
                  <div class="w-14 h-14 rounded-lg bg-gray-100"></div>
                  @endif

                  <div>
                    <p class="font-medium text-gray-800">{{ $product->name }}</p>
                    <p class="text-xs text-gray-500">{{ $product->slug }}</p>
                  </div>
                </div>
              </td>
              <td class="px-6 py-4 text-gray-600">
                {{ $product->category->name ?? '-' }}
              </td>
              <td class="px-6 py-4 text-gray-800">
                {{ $product->formattedPrice() }}
              </td>
              <td class="px-6 py-4 text-gray-600">
                {{ $product->stock }}
              </td>
              <td class="px-6 py-4">
                @if ($product->is_active)
                <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs">Aktif</span>
                @else
                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs">Nonaktif</span>
                @endif
              </td>
              <td class="px-6 py-4">
                <div class="flex justify-end gap-2">
                  <a href="{{ route('admin.products.edit', $product) }}" class="px-3 py-2 rounded-lg bg-yellow-50 text-yellow-700 hover:bg-yellow-100">
                    Edit
                  </a>

                  <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Yakin hapus produk ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-3 py-2 rounded-lg bg-red-50 text-red-700 hover:bg-red-100">
                      Hapus
                    </button>
                  </form>
                </div>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="6" class="px-6 py-10 text-center text-gray-500">
                Belum ada produk.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-6">
        {{ $products->links() }}
      </div>
    </div>
  </div>
</x-app-layout>