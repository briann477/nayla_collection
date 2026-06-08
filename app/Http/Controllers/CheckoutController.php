<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CheckoutController extends Controller
{
    public function index(): View|RedirectResponse
    {
        $cartItems = Cart::with('product.category')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->subtotal();
        });

        $shippingCost = 15000;
        $total = $subtotal + $shippingCost;

        return view('store.checkout', compact('cartItems', 'subtotal', 'shippingCost', 'total'));
    }

    public function store(Request $request): RedirectResponse
    {
        if (auth()->user()->role !== 'customer') {
            return redirect()
                ->route('home')
                ->with('error', 'Checkout hanya untuk customer.');
        }

        $validated = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:30'],
            'address' => ['required', 'string'],
            'notes' => ['nullable', 'string'],
            'payment_method' => ['required', 'in:cod,transfer,qris'],
        ]);

        $cartItems = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Keranjang masih kosong.');
        }

        foreach ($cartItems as $item) {
            if ($item->quantity > $item->product->stock) {
                return redirect()
                    ->route('cart.index')
                    ->with('error', 'Stok produk ' . $item->product->name . ' tidak mencukupi.');
            }
        }

        $order = DB::transaction(function () use ($validated, $cartItems) {
            $subtotal = $cartItems->sum(function ($item) {
                return $item->subtotal();
            });

            $shippingCost = 15000;
            $total = $subtotal + $shippingCost;

            $paymentMethod = $validated['payment_method'];

            $paymentStatus = $paymentMethod === 'cod'
                ? 'unpaid'
                : 'waiting_confirmation';

            $orderStatus = $paymentMethod === 'cod'
                ? 'processing'
                : 'pending';

            $order = Order::create([
                'order_code' => 'NYL-' . now()->format('YmdHis') . '-' . auth()->id(),
                'user_id' => auth()->id(),
                'customer_name' => $validated['customer_name'],
                'phone' => $validated['phone'],
                'address' => $validated['address'],
                'notes' => $validated['notes'] ?? null,
                'payment_method' => $paymentMethod,
                'payment_status' => $paymentStatus,
                'order_status' => $orderStatus,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'total' => $total,
                'va_number' => $paymentMethod === 'transfer' ? $this->generateDummyVaNumber() : null,
                'qris_code' => $paymentMethod === 'qris' ? $this->generateDummyQrisCode() : null,
            ]);

            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'price' => $item->product->price,
                    'quantity' => $item->quantity,
                    'subtotal' => $item->subtotal(),
                ]);

                $item->product->decrement('stock', $item->quantity);
            }

            Cart::where('user_id', auth()->id())->delete();

            return $order;
        });

        return redirect()->route('checkout.payment', $order);
    }

    public function payment(Order $order): View
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('store.payment', compact('order'));
    }

    private function generateDummyVaNumber(): string
    {
        return '8808' . now()->format('His') . random_int(1000, 9999);
    }

    private function generateDummyQrisCode(): string
    {
        return 'QRIS-NAYLA-' . now()->format('YmdHis') . '-' . random_int(100, 999);
    }
}
