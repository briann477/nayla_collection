<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $startDate = $request->start_date;
        $endDate = $request->end_date;

        $ordersQuery = Order::with(['items.product'])->latest();

        if ($startDate && $endDate) {
            $ordersQuery->whereDate('created_at', '>=', $startDate)
                ->whereDate('created_at', '<=', $endDate);
        }

        $orders = $ordersQuery->get();

        $totalOrders = $orders->count();

        $totalRevenue = $orders
            ->where('payment_status', 'paid')
            ->where('order_status', '!=', 'cancelled')
            ->sum('total');

        $completedOrders = $orders
            ->where('order_status', 'completed')
            ->count();

        $pendingOrders = $orders
            ->whereIn('order_status', ['pending', 'processing', 'shipped'])
            ->count();

        $cancelledOrders = $orders
            ->where('order_status', 'cancelled')
            ->count();

        $totalItemsSold = $orders
            ->where('payment_status', 'paid')
            ->where('order_status', '!=', 'cancelled')
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->sum('quantity');

        $topProducts = $orders
            ->where('payment_status', 'paid')
            ->where('order_status', '!=', 'cancelled')
            ->flatMap(function ($order) {
                return $order->items;
            })
            ->groupBy('product_name')
            ->map(function ($items, $productName) {
                return [
                    'name' => $productName,
                    'quantity' => $items->sum('quantity'),
                    'subtotal' => $items->sum('subtotal'),
                ];
            })
            ->sortByDesc('quantity')
            ->take(5);

        return view('admin.reports.index', compact(
            'orders',
            'startDate',
            'endDate',
            'totalOrders',
            'totalRevenue',
            'completedOrders',
            'pendingOrders',
            'cancelledOrders',
            'totalItemsSold',
            'topProducts'
        ));
    }
}