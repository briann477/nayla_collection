@extends('layouts.store', ['title' => 'Pembayaran - N.A.Y.L.A'])

@section('content')
<section class="payment-page-section">
  <div class="store-container">
    @if (session('success'))
    <div class="store-alert success">
      {{ session('success') }}
    </div>
    @endif

    @if (session('error'))
    <div class="store-alert error">
      {{ session('error') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="store-alert error">
      Bukti pembayaran wajib berupa gambar JPG, JPEG, PNG, atau WEBP maksimal 2MB.
    </div>
    @endif

    <div class="payment-page-card">
      <div class="payment-page-header">
        <span class="eyebrow">Payment</span>
        <h1>Pembayaran Pesanan</h1>
        <p>
          Kode pesanan kamu:
          <strong>{{ $order->order_code }}</strong>
        </p>
      </div>

      <div class="payment-page-grid">
        <div class="payment-main-box">
          @if ($order->payment_method === 'cod')
          <span class="payment-method-chip">COD</span>
          <h2>Bayar di Tempat</h2>
          <p>
            Pesanan kamu akan diproses oleh admin. Pembayaran dilakukan langsung kepada kurir
            saat produk diterima.
          </p>

          <div class="cod-box">
            <strong>Total yang harus dibayar</strong>
            <span>{{ $order->formattedTotal() }}</span>
          </div>
          @endif

          @if ($order->payment_method === 'transfer')
          <span class="payment-method-chip">Transfer VA</span>
          <h2>Transfer Virtual Account</h2>
          <p>
            Silakan transfer sesuai total pembayaran ke nomor virtual account dummy berikut.
            Setelah itu upload bukti pembayaran agar bisa dicek admin.
          </p>

          <div class="payment-total-display">
            <span>Total Pembayaran</span>
            <strong>{{ $order->formattedTotal() }}</strong>
          </div>

          <div class="va-display">
            <span>Nomor Virtual Account</span>
            <strong>{{ $order->va_number }}</strong>
          </div>

          <p class="dummy-note">
            Nomor VA ini hanya dummy untuk demo aplikasi, bukan pembayaran asli.
          </p>
          @endif

          @if ($order->payment_method === 'qris')
          <span class="payment-method-chip">QRIS</span>
          <h2>Scan QRIS Dummy</h2>
          <p>
            Scan QRIS dummy berikut untuk simulasi pembayaran pesanan.
            Setelah itu upload bukti pembayaran agar bisa dicek admin.
          </p>

          <div class="payment-total-display">
            <span>Total Pembayaran</span>
            <strong>{{ $order->formattedTotal() }}</strong>
          </div>

          <div class="qris-payment-box">
            <div class="dummy-qris large-qris">
              <span></span><span></span><span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span><span></span><span></span>
            </div>

            <div class="qris-code">
              {{ $order->qris_code }}
            </div>
          </div>

          <p class="dummy-note">
            QRIS ini hanya visual dummy untuk demo aplikasi, bukan QRIS asli.
          </p>
          @endif

          @if ($order->payment_method !== 'cod')
          <div class="upload-proof-box">
            <h3>Upload Bukti Pembayaran</h3>

            @if ($order->payment_proof)
            <div class="current-proof">
              <p>Bukti pembayaran sudah diupload.</p>
              <img src="{{ asset('storage/' . $order->payment_proof) }}" alt="Bukti Pembayaran">
            </div>
            @endif

            @if ($order->payment_status !== 'paid')
            <form action="{{ route('checkout.upload-proof', $order) }}" method="POST" enctype="multipart/form-data" class="proof-form">
              @csrf

              <input type="file" name="payment_proof" accept="image/*" required>

              <button type="submit" class="btn-primary-store">
                Upload Bukti
              </button>
            </form>

            <p class="dummy-note">
              Format gambar: JPG, JPEG, PNG, atau WEBP. Maksimal 2MB.
            </p>
            @else
            <div class="payment-paid-note">
              Pembayaran sudah dikonfirmasi admin.
            </div>
            @endif
          </div>
          @endif
        </div>

        <div class="payment-summary-box">
          <h3>Ringkasan Pesanan</h3>

          <div class="payment-info-row">
            <span>Nama</span>
            <strong>{{ $order->customer_name }}</strong>
          </div>

          <div class="payment-info-row">
            <span>No. HP</span>
            <strong>{{ $order->phone }}</strong>
          </div>

          <div class="payment-info-row">
            <span>Metode</span>
            <strong>{{ $order->paymentMethodLabel() }}</strong>
          </div>

          <div class="payment-info-row">
            <span>Status Pembayaran</span>
            <strong>{{ $order->paymentStatusLabel() }}</strong>
          </div>

          <div class="payment-info-row">
            <span>Status Pesanan</span>
            <strong>{{ $order->orderStatusLabel() }}</strong>
          </div>

          <div class="payment-items">
            @foreach ($order->items as $item)
            <div>
              <span>{{ $item->product_name }} x {{ $item->quantity }}</span>
              <strong>{{ $item->formattedSubtotal() }}</strong>
            </div>
            @endforeach
          </div>

          <div class="payment-total-lines">
            <div>
              <span>Subtotal</span>
              <strong>{{ $order->formattedSubtotal() }}</strong>
            </div>

            <div>
              <span>Ongkir</span>
              <strong>{{ $order->formattedShippingCost() }}</strong>
            </div>

            <div>
              <span>Total</span>
              <strong>{{ $order->formattedTotal() }}</strong>
            </div>
          </div>

          <a href="{{ route('orders.show', $order) }}" class="btn-primary-store payment-btn">
            Lihat Detail Pesanan
          </a>

          <a href="{{ route('collection') }}" class="btn-secondary-store payment-btn">
            Belanja Lagi
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection