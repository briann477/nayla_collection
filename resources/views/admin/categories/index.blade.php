<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Kelola Kategori
      </h2>

      <a href="{{ route('admin.categories.create') }}" class="px-4 py-2 bg-gray-900 text-white rounded-lg text-sm hover:bg-gray-700">
        Tambah Kategori
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

      @if (session('error'))
      <div class="mb-4 p-4 rounded-lg bg-red-50 text-red-700 border border-red-200">
        {{ session('error') }}
      </div>
      @endif

      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-gray-600">
            <tr>
              <th class="px-6 py-4 text-left">Nama</th>
              <th class="px-6 py-4 text-left">Deskripsi</th>
              <th class="px-6 py-4 text-left">Status</th>
              <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>
          <tbody class="divide-y divide-gray-100">
            @forelse ($categories as $category)
            <tr>
              <td class="px-6 py-4 font-medium text-gray-800">
                {{ $category->name }}
              </td>
              <td class="px-6 py-4 text-gray-500">
                {{ $category->description ?? '-' }}
              </td>
              <td class="px-6 py-4">
                @if ($category->is_active)
                <span class="px-3 py-1 rounded-full bg-green-50 text-green-700 text-xs">Aktif</span>
                @else
                <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-xs">Nonaktif</span>
                @endif
              </td>
              <td class="px-6 py-4">
                <div class="flex justify-end gap-2">
                  <a href="{{ route('admin.categories.edit', $category) }}" class="px-3 py-2 rounded-lg bg-yellow-50 text-yellow-700 hover:bg-yellow-100">
                    Edit
                  </a>

                  <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Yakin hapus kategori ini?')">
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
              <td colspan="4" class="px-6 py-10 text-center text-gray-500">
                Belum ada kategori.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-6">
        {{ $categories->links() }}
      </div>
    </div>
  </div>
</x-app-layout>