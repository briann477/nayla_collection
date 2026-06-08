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

        return view('admin.dashboard', compact(
            'productCount',
            'categoryCount',
            'orderCount',
            'customerCount'
        ));
    }
}
