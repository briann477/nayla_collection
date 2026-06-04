@extends('layouts.store', ['title' => 'Koleksi - N.A.Y.L.A'])

@section('content')
<section class="page-header">
  <div class="store-container">
    <span>Katalog</span>
    <h1>Koleksi N.A.Y.L.A</h1>
    <p>Pilihan busana modest wear dengan nuansa elegan dan soft.</p>
  </div>
</section>

<section class="section-block">
  <div class="store-container">
    @if ($categories->count() > 0)
    <div class="category-filter">
      <span>Semua Kategori</span>
      @foreach ($categories as $category)
      <span>{{ $category->name }}</span>
      @endforeach
    </div>
    @endif

    <div class="product-grid">
      @forelse ($products as $product)
      <div class="product-card">
        @if ($product->image)
        <img src="{{ asset('storage/' . $product->image) }}" class="product-photo" alt="{{ $product->name }}">
        @else
        <div class="product-image soft-cream"></div>
        @endif

        <div class="product-info">
          <small>{{ $product->category->name ?? 'Produk' }}</small>
          <h3>{{ $product->name }}</h3>
          <p>{{ Str::limit($product->description, 80) ?: 'Koleksi busana elegan N.A.Y.L.A.' }}</p>
          <strong>{{ $product->formattedPrice() }}</strong>
          <a href="#" class="product-link">Detail Produk</a>
        </div>
      </div>
      @empty
      <div class="empty-store">
        <h3>Belum ada produk.</h3>
        <p>Admin belum menambahkan produk aktif ke katalog.</p>
      </div>
      @endforelse
    </div>

    <div class="store-pagination">
      {{ $products->links() }}
    </div>
  </div>
</section>
@endsection