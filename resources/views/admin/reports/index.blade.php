<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <div>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          Laporan Penjualan
        </h2>
        <p class="text-sm text-gray-500 mt-1">
          Rekap transaksi penjualan N.A.Y.L.A untuk laporan kepada owner.
        </p>
      </div>

      <button onclick="window.print()" class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-700 text-sm">
        Cetak Laporan
      </button>
    </div>
  </x-slot>

  <div class="py-10 bg-gray-50 min-h-screen report-page">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      <form action="{{ route('admin.reports.index') }}" method="GET" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 report-filter">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
            <input
              type="date"
              name="start_date"
              value="{{ $startDate }}"
              class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900">
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
            <input
              type="date"
              name="end_date"
              value="{{ $endDate }}"
              class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900">
          </div>

          <div class="flex gap-2 md:col-span-2">
            <button type="submit" class="px-4 py-2 rounded-lg bg-gray-900 text-white hover:bg-gray-700">
              Filter
            </button>

            <a href="{{ route('admin.reports.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
              Reset
            </a>
          </div>
        </div>
      </form>

      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-6 print-header">
        <h1 class="text-2xl font-bold text-gray-900">Laporan Penjualan N.A.Y.L.A</h1>
        <p class="text-gray-500 mt-1">
          Periode:
          @if ($startDate || $endDate)
          {{ $startDate ?? 'Awal' }} sampai {{ $endDate ?? 'Sekarang' }}
          @else
          Semua transaksi
          @endif
        </p>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-5 gap-5 mb-6">
        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Total Pendapatan</p>
          <h3 class="text-2xl font-bold text-gray-900 mt-2">
            Rp {{ number_format($totalRevenue, 0, ',', '.') }}
          </h3>
          <p class="text-xs text-gray-400 mt-2">Dihitung dari pembayaran paid.</p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Total Pesanan</p>
          <h3 class="text-3xl font-bold text-gray-900 mt-2">{{ $totalOrders }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Pesanan Selesai</p>
          <h3 class="text-3xl font-bold text-green-700 mt-2">{{ $completedOrders }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Diproses/Pending</p>
          <h3 class="text-3xl font-bold text-yellow-700 mt-2">{{ $pendingOrders }}</h3>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100">
          <p class="text-sm text-gray-500">Dibatalkan</p>
          <h3 class="text-3xl font-bold text-red-700 mt-2">{{ $cancelledOrders }}</h3>
        </div>
      </div>

      <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <table class="w-full text-sm">
          <thead class="bg-gray-50 text-gray-600">
            <tr>
              <th class="px-6 py-4 text-left">Tanggal</th>
              <th class="px-6 py-4 text-left">Kode Pesanan</th>
              <th class="px-6 py-4 text-left">Customer</th>
              <th class="px-6 py-4 text-left">Metode</th>
              <th class="px-6 py-4 text-left">Pembayaran</th>
              <th class="px-6 py-4 text-left">Status</th>
              <th class="px-6 py-4 text-right">Total</th>
            </tr>
          </thead>

          <tbody class="divide-y divide-gray-100">
            @forelse ($orders as $order)
            <tr>
              <td class="px-6 py-4 text-gray-600">
                {{ $order->created_at->format('d/m/Y') }}
              </td>

              <td class="px-6 py-4 font-medium text-gray-900">
                {{ $order->order_code }}
              </td>

              <td class="px-6 py-4 text-gray-600">
                {{ $order->customer_name }}
              </td>

              <td class="px-6 py-4 text-gray-600">
                {{ $order->paymentMethodLabel() }}
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

              <td class="px-6 py-4 text-right font-semibold text-gray-900">
                {{ $order->formattedTotal() }}
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="7" class="px-6 py-10 text-center text-gray-500">
                Belum ada data transaksi pada periode ini.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>

      <div class="mt-6 report-pagination">
        {{ $orders->links() }}
      </div>
    </div>
  </div>
</x-app-layout>