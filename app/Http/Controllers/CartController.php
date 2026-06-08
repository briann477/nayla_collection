<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    public function index(): View
    {
        $cartItems = Cart::with('product.category')
            ->where('user_id', auth()->id())
            ->latest()
            ->get();

        $total = $cartItems->sum(function ($item) {
            return $item->subtotal();
        });

        return view('store.cart', compact('cartItems', 'total'));
    }

    public function store(Request $request, Product $product): RedirectResponse
    {
        if (auth()->user()->role !== 'customer') {
            return redirect()
                ->route('home')
                ->with('error', 'Hanya customer yang dapat menambahkan produk ke keranjang.');
        }

        if (! $product->is_active) {
            return redirect()
                ->back()
                ->with('error', 'Produk tidak aktif.');
        }

        if ($product->stock <= 0) {
            return redirect()
                ->back()
                ->with('error', 'Stok produk habis.');
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $product->stock],
        ]);

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', $product->id)
            ->first();

        if ($cart) {
            $newQuantity = $cart->quantity + $validated['quantity'];

            if ($newQuantity > $product->stock) {
                $newQuantity = $product->stock;
            }

            $cart->update([
                'quantity' => $newQuantity,
            ]);
        } else {
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $product->id,
                'quantity' => $validated['quantity'],
            ]);
        }

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    public function update(Request $request, Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:' . $cart->product->stock],
        ]);

        $cart->update([
            'quantity' => $validated['quantity'],
        ]);

        return redirect()
            ->route('cart.index')
            ->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    public function destroy(Cart $cart): RedirectResponse
    {
        if ($cart->user_id !== auth()->id()) {
            abort(403);
        }

        $cart->delete();

        return redirect()
            ->route('cart.index')
            ->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
