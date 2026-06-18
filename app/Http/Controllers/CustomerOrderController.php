<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CustomerOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::with(['items.product'])
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('store.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load(['items.product']);

        return view('store.orders.show', compact('order'));
    }

    public function complete(Order $order): RedirectResponse
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        if ($order->order_status !== 'shipped') {
            return redirect()
                ->route('orders.show', $order)
                ->with('error', 'Pesanan hanya bisa diselesaikan jika statusnya sudah dikirim.');
        }

        $order->update([
            'order_status' => 'completed',
        ]);

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil ditandai sebagai diterima. Terima kasih sudah berbelanja di N.A.Y.L.A.');
    }
}
