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

        $ordersQuery = Order::with('user')
            ->latest();

        if ($startDate) {
            $ordersQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $ordersQuery->whereDate('created_at', '<=', $endDate);
        }

        $orders = $ordersQuery->paginate(10)->withQueryString();

        $summaryQuery = Order::query();

        if ($startDate) {
            $summaryQuery->whereDate('created_at', '>=', $startDate);
        }

        if ($endDate) {
            $summaryQuery->whereDate('created_at', '<=', $endDate);
        }

        $totalOrders = (clone $summaryQuery)->count();

        $completedOrders = (clone $summaryQuery)
            ->where('order_status', 'completed')
            ->count();

        $pendingOrders = (clone $summaryQuery)
            ->whereIn('order_status', ['pending', 'processing', 'shipped'])
            ->count();

        $cancelledOrders = (clone $summaryQuery)
            ->where('order_status', 'cancelled')
            ->count();

        $totalRevenue = (clone $summaryQuery)
            ->where('payment_status', 'paid')
            ->where('order_status', '!=', 'cancelled')
            ->sum('total');

        return view('admin.reports.index', compact(
            'orders',
            'totalOrders',
            'completedOrders',
            'pendingOrders',
            'cancelledOrders',
            'totalRevenue',
            'startDate',
            'endDate'
        ));
    }
}
