<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      Kelola Pesanan
    </h2>
  </x-slot>

  <div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-gray-600">
            <tr>
              <th class="px-6 py-4 text-left">Kode</th>
              <th class="px-6 py-4 text-left">Customer</th>
              <th class="px-6 py-4 text-left">Metode</th>
              <th class="px-6 py-4 text-left">Total</th>
              <th class="px-6 py-4 text-left">Pembayaran</th>
              <th class="px-6 py-4 text-left">Pesanan</th>
              <th class="px-6 py-4 text-right">Aksi</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100">
            @forelse ($orders as $order)
            <tr>
              <td class="px-6 py-4 font-medium text-gray-900">
                {{ $order->order_code }}
              </td>
              <td class="px-6 py-4 text-gray-600">
                {{ $order->customer_name }}
              </td>
              <td class="px-6 py-4 text-gray-600">
                {{ $order->paymentMethodLabel() }}
              </td>
              <td class="px-6 py-4 font-semibold text-gray-900">
                {{ $order->formattedTotal() }}
              </td>
              <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full bg-yellow-50 text-yellow-700 text-xs">
                  {{ $order->paymentStatusLabel() }}
                </span>
              </td>
              <td class="px-6 py-4">
                <span class="px-3 py-1 rounded-full bg-blue-50 text-blue-700 text-xs">
                  {{ $order->orderStatusLabel() }}
                </span>
              </td>
              <td class="px-6 py-4 text-right">
                <a href="{{ route('admin.orders.show', $order) }}" class="px-3 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-700">
                  Detail
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                Belum ada pesanan.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-6">
        {{ $orders->links() }}
      </div>
    </div>
  </div>
</x-app-layout>