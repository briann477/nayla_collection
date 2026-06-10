@extends('layouts.store', ['title' => 'Koleksi - N.A.Y.L.A'])

@section('content')
<section class="collection-v2-header">
  <div class="store-container">
    <div class="collection-v2-header-grid">
      <div>
        <span class="collection-v2-eyebrow">Collection</span>
        <h1>Koleksi N.A.Y.L.A</h1>
        <p>
          Pilihan busana modest wear dengan nuansa elegan, clean, dan soft
          untuk berbagai momen.
        </p>
      </div>

      <div class="collection-v2-mini">
        <strong>Soft • Elegant • Modest</strong>
        <span>Curated fashion pieces for graceful daily looks.</span>
      </div>
    </div>
  </div>
</section>

<section class="collection-v2-section">
  <div class="store-container">
    <div class="collection-v2-toolbar">
      <div class="category-filter collection-v2-filter">
        <span>Semua Kategori</span>

        @foreach ($categories as $category)
        <span>{{ $category->name }}</span>
        @endforeach
      </div>

      <p class="collection-v2-count">
        {{ $products->total() }} produk tersedia
      </p>
    </div>

    <div class="collection-v2-grid">
      @forelse ($products as $product)
      <article class="collection-v2-card">
        <a href="{{ route('product.detail', $product->slug) }}" class="collection-v2-image-wrap">
          @if ($product->image && \Illuminate\Support\Facades\Storage::disk('public')->exists($product->image))
          <img
            src="{{ asset('storage/' . $product->image) }}"
            alt="{{ $product->name }}"
            class="collection-v2-photo">
          @else
          <div class="collection-v2-placeholder">
            <span>N.A.Y.L.A</span>
          </div>
          @endif

          <div class="collection-v2-badge">
            {{ $product->stock > 0 ? 'Ready Stock' : 'Sold Out' }}
          </div>
        </a>

        <div class="collection-v2-info">
          <div class="collection-v2-meta">
            <span>{{ $product->category->name ?? 'Produk' }}</span>
            <small>Stok {{ $product->stock }}</small>
          </div>

          <h3>{{ $product->name }}</h3>

          <p>
            {{ Str::limit($product->description, 90) ?: 'Koleksi busana elegan N.A.Y.L.A.' }}
          </p>

          <div class="collection-v2-bottom">
            <strong>{{ $product->formattedPrice() }}</strong>

            <a href="{{ route('product.detail', $product->slug) }}">
              Detail
            </a>
          </div>
        </div>
      </article>
      @empty
      <div class="collection-v2-empty">
        <span>N.A.Y.L.A</span>
        <h3>Belum ada produk.</h3>
        <p>Admin belum menambahkan produk aktif ke katalog.</p>
      </div>
      @endforelse
    </div>

    <div class="store-pagination collection-v2-pagination">
      {{ $products->links() }}
    </div>
  </div>
</section>
@endsection