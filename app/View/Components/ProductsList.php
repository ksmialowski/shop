<?php

namespace App\View\Components;

use App\Models\Product;
use Illuminate\View\Component;

class ProductsList extends Component
{
    public $products;

    public function __construct()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        return view('components.products-list');
    }
}
