<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function home(): View
    {
        $featuredProducts = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->take(3)
            ->get();

        return view('store.home', compact('featuredProducts'));
    }

    public function collection(): View
    {
        $categories = Category::where('is_active', true)
            ->orderBy('name')
            ->get();

        $products = Product::with('category')
            ->where('is_active', true)
            ->latest()
            ->paginate(8);

        return view('store.collection', compact('products', 'categories'));
    }

    public function about(): View
    {
        return view('store.about');
    }

    public function contact(): View
    {
        return view('store.contact');
    }
}
