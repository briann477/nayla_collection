<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class CustomerOrderController extends Controller
{
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('store.orders.index', compact('orders'));
    }

    public function show(Order $order): View
    {
        if ($order->user_id !== auth()->id()) {
            abort(403);
        }

        $order->load('items.product');

        return view('store.orders.show', compact('order'));
    }
}
