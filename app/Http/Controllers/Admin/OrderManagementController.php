<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManagementController extends Controller
{
    /**
     * Display a paginated ledger of database orders.
     */
    public function index(Request $request)
    {
        $query = Order::query();

        // Real-time search filter execution
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('id', 'LIKE', "%{$search}%")
                  ->orWhere('customer_name', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        }

        // Fetch using database-driven pagination
        $customerOrders = $query->latest()->paginate(10)->withQueryString();

        return view('admin.orders.index', compact('customerOrders'));
    }

    /**
     * Commit order status mutation transitions.
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string|in:Pending,Processing,Shipped,Cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $validated['status']]);

        return back()->with('success', "Order #{$order->id} status updated to {$validated['status']}.");
    }

    /**
     * Display the specified customer order.
     */
    public function show(Order $order)
    {
        // Eager load relationships to prevent N+1 query issues in the view
        // (e.g., loading the customer profile and specific ordered items/products)
        $order->load(['user', 'items.product']); 

        return view('admin.orders.show', compact('order'));
    }
}