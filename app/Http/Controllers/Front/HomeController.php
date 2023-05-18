<?php

namespace App\Http\Controllers\Front;

use App\Models\Category;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $categories = Category::with(['photo'])
            ->where('category_status', '=', 1)
            ->limit(3)
            ->get();

        $products = Product::with(['photo'])
            ->where('product_status', '=', 1)
            ->limit(3)
            ->get();

        return view('front.index.index', [
            'categories' => $categories,
            'products' => $products,
        ]);
    }
}
