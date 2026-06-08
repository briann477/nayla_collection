<x-app-layout>
  <x-slot name="header">
    <div class="flex items-center justify-between">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Detail Pesanan
      </h2>

      <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 rounded-lg border border-gray-300 text-gray-700 hover:bg-gray-50">
        Kembali
      </a>
    </div>
  </x-slot>

  <div class="py-10 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
      @if (session('success'))
      <div class="mb-4 p-4 rounded-lg bg-green-50 text-green-700 border border-green-200">
        {{ session('success') }}
      </div>
      @endif

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100 p-6">
          <h3 class="text-lg font-semibold text-gray-900">Informasi Pesanan</h3>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-5">
            <div class="p-4 rounded-lg bg-gray-50">
              <p class="text-sm text-gray-500">Kode Pesanan</p>
              <p class="font-semibold text-gray-900 mt-1">{{ $order->order_code }}</p>
            </div>

            <div class="p-4 rounded-lg bg-gray-50">
              <p class="text-sm text-gray-500">Customer</p>
              <p class="font-semibold text-gray-900 mt-1">{{ $order->customer_name }}</p>
            </div>

            <div class="p-4 rounded-lg bg-gray-50">
              <p class="text-sm text-gray-500">No. HP</p>
              <p class="font-semibold text-gray-900 mt-1">{{ $order->phone }}</p>
            </div>

            <div class="p-4 rounded-lg bg-gray-50">
              <p class="text-sm text-gray-500">Metode Pembayaran</p>
              <p class="font-semibold text-gray-900 mt-1">{{ $order->paymentMethodLabel() }}</p>
            </div>

            <div class="md:col-span-2 p-4 rounded-lg bg-gray-50">
              <p class="text-sm text-gray-500">Alamat</p>
              <p class="font-semibold text-gray-900 mt-1">{{ $order->address }}</p>
            </div>

            @if ($order->notes)
            <div class="md:col-span-2 p-4 rounded-lg bg-gray-50">
              <p class="text-sm text-gray-500">Catatan</p>
              <p class="font-semibold text-gray-900 mt-1">{{ $order->notes }}</p>
            </div>
            @endif
          </div>

          @if ($order->payment_method !== 'cod')
          <h3 class="text-lg font-semibold text-gray-900 mt-8">Bukti Pembayaran</h3>

          <div class="mt-4 p-4 rounded-xl bg-gray-50 border border-gray-100">
            @if ($order->payment_proof)
            <p class="text-sm text-gray-500 mb-3">Bukti pembayaran customer:</p>
            <img
              src="{{ asset('storage/' . $order->payment_proof) }}"
              alt="Bukti Pembayaran"
              class="max-w-sm rounded-xl border border-gray-200">
            @else
            <p class="text-gray-500">Customer belum mengupload bukti pembayaran.</p>
            @endif
          </div>
          @endif

          <h3 class="text-lg font-semibold text-gray-900 mt-8">Produk Dipesan</h3>

          <div class="mt-4 border border-gray-100 rounded-xl overflow-hidden">
            <table class="w-full text-sm">
              <thead class="bg-gray-50 text-gray-600">
                <tr>
                  <th class="px-5 py-3 text-left">Produk</th>
                  <th class="px-5 py-3 text-left">Harga</th>
                  <th class="px-5 py-3 text-left">Qty</th>
                  <th class="px-5 py-3 text-right">Subtotal</th>
                </tr>
              </thead>

              <tbody class="divide-y divide-gray-100">
                @foreach ($order->items as $item)
                <tr>
                  <td class="px-5 py-4">
                    <div class="flex items-center gap-3">
                      @if ($item->product && $item->product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($item->product->image))
                      <img
                        src="{{ asset('storage/' . $item->product->image) }}"
                        alt="{{ $item->product_name }}"
                        class="w-14 h-16 rounded-lg object-cover border border-gray-100">
                      @else
                      <div class="w-14 h-16 rounded-lg bg-gray-100 flex items-center justify-center text-gray-500 text-xs">
                        No Img
                      </div>
                      @endif

                      <div>
                        <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                        <p class="text-xs text-gray-500">Produk pesanan</p>
                      </div>
                    </div>
                  </td>

                  <td class="px-5 py-4 text-gray-600">
                    {{ $item->formattedPrice() }}
                  </td>

                  <td class="px-5 py-4 text-gray-600">
                    {{ $item->quantity }}
                  </td>

                  <td class="px-5 py-4 text-right font-semibold text-gray-900">
                    {{ $item->formattedSubtotal() }}
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
          <h3 class="text-lg font-semibold text-gray-900">Update Status</h3>

          <form action="{{ route('admin.orders.update', $order) }}" method="POST" class="space-y-5 mt-5">
            @csrf
            @method('PUT')

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Status Pembayaran</label>
              <select name="payment_status" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900">
                <option value="unpaid" {{ $order->payment_status === 'unpaid' ? 'selected' : '' }}>Belum Dibayar</option>
                <option value="waiting_confirmation" {{ $order->payment_status === 'waiting_confirmation' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>Sudah Dibayar</option>
              </select>
            </div>

            <div>
              <label class="block text-sm font-medium text-gray-700 mb-2">Status Pesanan</label>
              <select name="order_status" class="w-full rounded-lg border-gray-300 focus:border-gray-900 focus:ring-gray-900">
                <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>Menunggu Diproses</option>
                <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>Diproses</option>
                <option value="shipped" {{ $order->order_status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                <option value="completed" {{ $order->order_status === 'completed' ? 'selected' : '' }}>Selesai</option>
                <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
              </select>
            </div>

            <button type="submit" class="w-full px-4 py-3 rounded-lg bg-gray-900 text-white hover:bg-gray-700">
              Simpan Status
            </button>
          </form>

          <div class="mt-6 pt-6 border-t border-gray-100">
            <div class="flex justify-between py-2 text-gray-600">
              <span>Subtotal</span>
              <strong>{{ $order->formattedSubtotal() }}</strong>
            </div>

            <div class="flex justify-between py-2 text-gray-600">
              <span>Ongkir</span>
              <strong>{{ $order->formattedShippingCost() }}</strong>
            </div>

            <div class="flex justify-between py-3 border-t border-gray-100 text-gray-900 text-lg">
              <span>Total</span>
              <strong>{{ $order->formattedTotal() }}</strong>
            </div>
          </div>

          @if ($order->payment_method === 'transfer')
          <div class="mt-5 p-4 rounded-lg bg-gray-50">
            <p class="text-sm text-gray-500">VA Dummy</p>
            <p class="font-semibold text-gray-900 mt-1">{{ $order->va_number }}</p>
          </div>
          @endif

          @if ($order->payment_method === 'qris')
          <div class="mt-5 p-4 rounded-lg bg-gray-50">
            <p class="text-sm text-gray-500">QRIS Dummy</p>
            <p class="font-semibold text-gray-900 mt-1">{{ $order->qris_code }}</p>
          </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</x-app-layout>