<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Str;

class CheckoutController extends Controller
{

    /**
     * Display the checkout confirmation view.
     */
    public function index()
    {
        $cart = Cart::with(['items.product'])->where('user_id', Auth::id())->first();

        // Check if cart is empty before accessing checkout matrix
        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your shopping bag is empty.');
        }

        return view('client.checkout.index', compact('cart'));
    }

    /**
     * Process the order, clear the cart, and deduct stock.
     */
    public function store(Request $request)
    {
        $cart = Cart::with(['items.product'])->where('user_id', Auth::id())->first();

        if (!$cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your shopping bag is empty.');
        }

        // We wrap this inside a transaction to protect against concurrent race conditions
        try {
            $order = DB::transaction(function () use ($cart) {
                $subtotal = 0;

                // 1. First Pass: Validate stock levels for all items before touching anything
                foreach ($cart->items as $item) {
                    if ($item->product->stock < $item->quantity) {
                        throw new \Exception("Item '{$item->product->name}' is no longer available in the requested quantity.");
                    }
                    $subtotal += $item->product->price * $item->quantity;
                }

                // 2. Generate a custom, elegant Order Number (e.g., ORD-20260719-A3F9B)
                $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));
                
                // Double check uniqueness defensively
                while (Order::query()->where('order_number', $orderNumber)->exists()) {
                    $orderNumber = 'ORD-' . date('Ymd') . '-' . strtoupper(\Illuminate\Support\Str::random(5));
                }

                // 3. Create the parent Order profile record
                $order = Order::create([
                    'order_number' => $orderNumber,
                    'user_id' => Auth::id(),
                    'total_price' => $subtotal,
                    'status' => 'pending' // Defaults to pending until processing gateway confirms
                ]);

                // 4. Migrate items to order records and decrement available factory inventory metrics
                foreach ($cart->items as $item) {
                    $order->items()->create([
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->product->price, // Captures historical price point state
                    ]);

                    // Deduct stock natively at database query optimization layer
                    $item->product->decrement('stock', $item->quantity);
                }

                // 5. Purge cart records to reset user instance context state cleanly
                $cart->items()->delete();

                return $order;
            });

            // If transaction finishes smoothly, route them onward with success tracking indicators
            return redirect()->route('checkout.success', $order->order_number)
                             ->with('success', 'Your order allocation manifest has been locked in.');

        } catch (\Exception $e) {
            return redirect()->route('cart.index')->with('error', $e->getMessage());
        }
    }

    /**
     * Display transaction completion summary.
     */
    public function success($order_number)
    {
        $order = Order::with(['items.product'])
                      ->where('order_number', $order_number)
                      ->where('user_id', Auth::id())
                      ->firstOrFail();

        return view('client.checkout.confirmation', compact('order'));
    }
}
