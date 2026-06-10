<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $productCount = Product::count();
        $categoryCount = Category::count();
        $orderCount = Order::count();
        $customerCount = User::where('role', 'customer')->count();

        $paidRevenue = Order::where('payment_status', 'paid')
            ->where('order_status', '!=', 'cancelled')
            ->sum('total');

        $pendingOrderCount = Order::whereIn('order_status', ['pending', 'processing', 'shipped'])
            ->count();

        $latestOrders = Order::latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'productCount',
            'categoryCount',
            'orderCount',
            'customerCount',
            'paidRevenue',
            'pendingOrderCount',
            'latestOrders'
        ));
    }
}
