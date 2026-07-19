<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{


    /**
     * Display the client's shopping cart.
     */
    public function index()
    {
        // Eager load items and their associated products to optimize database queries
        $cart = Cart::with(['items.product'])->firstOrCreate([
            'user_id' => Auth::id()
        ]);

        return view('client.cart.index', compact('cart'));
    }

    /**
     * Add a product to the cart (or increment quantity if it exists).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::findOrFail($request->product_id);

        // 1. Get or create the user's active cart
        $cart = Cart::firstOrCreate(['user_id' => Auth::id()]);

        // 2. Check if this product is already in the cart
        $existingItem = $cart->items()->where('product_id', $product->id)->first();

        $requestedQuantity = $request->input('quantity', 1);

        if ($existingItem) {
            // Check stock limits before incrementing
            $newQuantity = $existingItem->quantity + $requestedQuantity;
            if ($product->stock < $newQuantity) {
                return redirect()->back()->with('error', "Cannot add more. Only {$product->stock} units available.");
            }

            $existingItem->update(['quantity' => $newQuantity]);
        } else {
            // Check stock limits for new items
            if ($product->stock < $requestedQuantity) {
                return redirect()->back()->with('error', "Only {$product->stock} units available.");
            }

            $cart->items()->create([
                'product_id' => $product->id,
                'quantity' => $requestedQuantity,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to luxury bag successfully.');
    }

    /**
     * Update item quantity directly from the cart page view grid.
     */
    public function update(Request $request, CartItem $cartItem)
    {
        // Security check: Ensure the item belongs to the logged-in user's cart
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);

        // Validate against actual product stock availability
        if ($cartItem->product->stock < $request->quantity) {
            return redirect()->back()->with('error', "Only {$cartItem->product->stock} units are currently available.");
        }

        $cartItem->update([
            'quantity' => $request->quantity
        ]);

        return redirect()->back()->with('success', 'Cart updated successfully.');
    }

    /**
     * Remove an item completely from the cart.
     */
    public function destroy(CartItem $cartItem)
    {
        // Security check
        if ($cartItem->cart->user_id !== Auth::id()) {
            abort(403);
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Item removed from your bag.');
    }
}
