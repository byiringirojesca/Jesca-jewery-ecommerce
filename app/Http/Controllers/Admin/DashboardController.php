<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Handle incoming request to parse administrative analytics.
     */
    public function index()
    {
        // 1. Compute dynamic data state aggregates
        $totalRevenue = Order::query()->where('status', '!=', 'cancelled')->sum('total_price');
        $activeOrdersCount = Order::whereIn('status', ['pending', 'processing'])->count();
        $totalProductsCount = Product::count();
        $totalUsersCount = User::count();

        // 2. Format data matrix to match your layout array expectations exactly
        $stats = [
            [
                'label' => 'Total Revenue',
                'value' => '$' . number_format($totalRevenue, 2),
                'color' => 'text-emerald-700',
                'bg' => 'bg-emerald-50/40'
            ],
            [
                'label' => 'Active Orders',
                'value' => $activeOrdersCount . ' Pending',
                'color' => 'text-amber-700',
                'bg' => 'bg-amber-50/40'
            ],
            [
                'label' => 'Total Products',
                'value' => $totalProductsCount . ' Items',
                'color' => 'text-stone-700',
                'bg' => 'bg-stone-100/50'
            ],
            [
                'label' => 'Registered Users',
                'value' => $totalUsersCount . ' Clients',
                'color' => 'text-neutral-800',
                'bg' => 'bg-neutral-100/50'
            ]
        ];

        // 3. Fetch the latest 5 orders with Eager Loading to avoid N+1 query traps
        $rawOrders = Order::with(['user', 'items.product'])
            ->latest()
            ->take(5)
            ->get();

        // 4. Transform raw database rows into exact layout array presentation tokens
        $recentOrders = $rawOrders->map(function ($order) {
            // Build the catalog item string summary: "Classic Gold Chain (1), Silk Evening Dress (2)"
            $itemsSummary = $order->items->map(function ($item) {
                return ($item->product->name ?? 'Unknown Item') . " ({$item->quantity})";
            })->implode(', ');

            return [
                'id' => $order->order_number,
                'customer' => $order->user->name ?? 'Guest Client',
                'items' => $itemsSummary ?: 'No line items recorded',
                'total' => $order->total_price,
                'status' => ucfirst($order->status),
                'status_color' => $this->getStatusStyles($order->status)
            ];
        });

        return view('admin.dashboard', compact('stats', 'recentOrders'));
    }

    /**
     * Map visual theme states cleanly using native PHP match expressions.
     */
    private function getStatusStyles(string $status): string
    {
        return match (strtolower($status)) {
            'pending'    => 'text-amber-700 border-amber-200 bg-amber-50/30',
            'processing' => 'text-blue-700 border-blue-200 bg-blue-50/30',
            'shipped'    => 'text-emerald-700 border-emerald-200 bg-emerald-50/30',
            'completed'  => 'text-emerald-700 border-emerald-200 bg-emerald-50/30',
            'cancelled'  => 'text-rose-700 border-rose-200 bg-rose-50/30',
            default      => 'text-stone-700 border-stone-200 bg-stone-50/30',
        };
    }
}