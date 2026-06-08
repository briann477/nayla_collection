@extends('layouts.store', ['title' => 'Checkout - N.A.Y.L.A'])

@section('content')
<section class="checkout-section">
  <div class="store-container">
    <div class="cart-header">
      <div>
        <span class="eyebrow">Checkout</span>
        <h1>Checkout Pesanan</h1>
        <p>Lengkapi data pengiriman dan pilih metode pembayaran.</p>
      </div>

      <a href="{{ route('cart.index') }}" class="btn-secondary-store">
        Kembali ke Keranjang
      </a>
    </div>

    @if ($errors->any())
    <div class="store-alert error">
      Periksa kembali data checkout kamu.
    </div>
    @endif

    <form action="{{ route('checkout.store') }}" method="POST" class="checkout-layout">
      @csrf

      <div class="checkout-form-card">
        <h3>Data Pengiriman</h3>

        <div class="form-grid">
          <div>
            <label>Nama Penerima</label>
            <input type="text" name="customer_name" value="{{ old('customer_name', auth()->user()->name) }}" required>
            @error('customer_name')
            <p class="form-error">{{ $message }}</p>
            @enderror
          </div>

          <div>
            <label>No. HP</label>
            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="08xxxxxxxxxx" required>
            @error('phone')
            <p class="form-error">{{ $message }}</p>
            @enderror
          </div>
        </div>

        <div>
          <label>Alamat Lengkap</label>
          <textarea name="address" rows="5" placeholder="Tulis alamat lengkap pengiriman" required>{{ old('address') }}</textarea>
          @error('address')
          <p class="form-error">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label>Catatan Pesanan</label>
          <textarea name="notes" rows="3" placeholder="Contoh: warna cadangan, patokan rumah, dll">{{ old('notes') }}</textarea>
          @error('notes')
          <p class="form-error">{{ $message }}</p>
          @enderror
        </div>

        <h3 class="payment-title">Metode Pembayaran</h3>

        <div class="payment-options">
          <label class="payment-option">
            <input type="radio" name="payment_method" value="cod" {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
            <div>
              <strong>COD</strong>
              <span>Bayar di tempat saat pesanan diterima.</span>
            </div>
          </label>

          <label class="payment-option">
            <input type="radio" name="payment_method" value="transfer" {{ old('payment_method') === 'transfer' ? 'checked' : '' }}>
            <div>
              <strong>Transfer VA</strong>
              <span>Nomor virtual account dummy akan muncul setelah checkout.</span>
            </div>
          </label>

          <label class="payment-option">
            <input type="radio" name="payment_method" value="qris" {{ old('payment_method') === 'qris' ? 'checked' : '' }}>
            <div>
              <strong>QRIS</strong>
              <span>QRIS dummy akan muncul setelah checkout.</span>
            </div>
          </label>
        </div>

        @error('payment_method')
        <p class="form-error">{{ $message }}</p>
        @enderror

        <div class="payment-preview">
          <div class="preview-box preview-cod">
            <h4>COD / Bayar di Tempat</h4>
            <p>Pembayaran dilakukan langsung kepada kurir saat produk diterima.</p>
          </div>

          <div class="preview-box preview-transfer">
            <h4>Transfer Virtual Account</h4>
            <p>Nomor VA dummy akan dibuat otomatis setelah pesanan berhasil.</p>
            <strong>Contoh: 8808 1234 5678 9999</strong>
          </div>

          <div class="preview-box preview-qris">
            <h4>QRIS Dummy</h4>
            <div class="dummy-qris-small">
              <span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span>
              <span></span><span></span><span></span><span></span>
            </div>
            <p>QRIS ini hanya simulasi untuk demo aplikasi.</p>
          </div>
        </div>
      </div>

      <div class="cart-summary checkout-summary">
        <h3>Ringkasan Pesanan</h3>

        <div class="checkout-items">
          @foreach ($cartItems as $item)
          <div class="checkout-item">
            <span>{{ $item->product->name }} x {{ $item->quantity }}</span>
            <strong>{{ $item->formattedSubtotal() }}</strong>
          </div>
          @endforeach
        </div>

        <div class="summary-row">
          <span>Subtotal</span>
          <strong>Rp {{ number_format($subtotal, 0, ',', '.') }}</strong>
        </div>

        <div class="summary-row">
          <span>Ongkir</span>
          <strong>Rp {{ number_format($shippingCost, 0, ',', '.') }}</strong>
        </div>

        <div class="summary-row total-row">
          <span>Total</span>
          <strong>Rp {{ number_format($total, 0, ',', '.') }}</strong>
        </div>

        <button type="submit" class="btn-primary-store summary-btn">
          Buat Pesanan
        </button>

        <p>
          Untuk transfer dan QRIS, pembayaran pada sistem ini masih berupa simulasi/dummy.
        </p>
      </div>
    </form>
  </div>
</section>
@endsection