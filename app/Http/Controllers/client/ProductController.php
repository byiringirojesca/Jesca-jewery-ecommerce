<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display the public showcase collection grid.
     */
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(12);

        // 2. Fetch the categories for the top luxury navigation filter bar
        $categories = Category::select('id', 'name', 'slug')->get();

        // 3. Pass both variables into the view pipeline
        return view('client.products.index', compact('products', 'categories'));
    }

    /**
     * Display a specific item profile resolved automatically via its slug.
     */
    public function show(Product $product)
    {
        $product->load('category');

        return view('client.products.show', compact('product'));
    }
}
