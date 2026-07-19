<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * 1. READ (All) - Display catalog/inventory index
     */
    public function index()
    {
        // For admin dashboard, you might want pagination
        $products = Product::with('category')->latest()->paginate(15);

        return view('admin.products.index', compact('products'));
    }

    /**
     * 2. CREATE - Store a newly initialized product asset
     */

    public function create()
    {

        $categories = Category::select('id', 'name')->get();

        $initialImages = old('images', [
            'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80'
        ]);

        return view('admin.products.create', compact('categories', 'initialImages'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:products,name',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'images'      => 'required|array|min:1',
            'images.*'    => 'required|url', // Ensures every item in the array is a valid link
        ]);

        // Generate the URL-friendly slug automatically from the name
        $validated['slug'] = Str::slug($validated['name']);

        // Because of Laravel's model casting, passing the array directly just works!
        Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Asset successfully committed to the catalog registry.');
    }

    /**
     * 3. READ (Single) - Show specific asset details
     */


    /**
     * 4. UPDATE - Modify an existing database registry constraint
     */

    public function edit(Product $product)
    {
        // Fetch categories for the selector dropdown
        $categories = Category::select('id', 'name')->get();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255|unique:products,name,' . $product->id,
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'description' => 'required|string',
            'images'      => 'required|array|min:1',
            'images.*'    => 'required|url',
        ]);

        // Regenerate the slug if they changed the product name
        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', 'Catalog asset parameters updated successfully.');
    }

    /**
     * BONUS / 5. DELETE - Evict an asset from the active system ledger
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', 'Asset successfully purged from vault records.');
    }
}
