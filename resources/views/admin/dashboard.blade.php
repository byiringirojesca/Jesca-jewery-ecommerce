@php
    // Quick admin dashboard analytics mock data layer
    $stats = [
        ['label' => 'Total Revenue', 'value' => '$4,295.00', 'color' => 'text-green-600', 'bg' => 'bg-green-50'],
        ['label' => 'Active Orders', 'value' => '12 Pending', 'color' => 'text-blue-600', 'bg' => 'bg-blue-50'],
        ['label' => 'Total Products', 'value' => '84 Items', 'color' => 'text-amber-600', 'bg' => 'bg-amber-50'],
        ['label' => 'Registered Users', 'value' => '142 Clients', 'color' => 'text-purple-600', 'bg' => 'bg-purple-50']
    ];

    $recentOrders = [
        ['id' => 'TXN-84721', 'customer' => 'Alice Umutoni', 'items' => 'Classic Gold Chain (1)', 'total' => 249.00, 'status' => 'Pending', 'status_color' => 'bg-amber-100 text-amber-800'],
        ['id' => 'TXN-19482', 'customer' => 'Jean Keza', 'items' => 'Silk Evening Dress (1)', 'total' => 189.00, 'status' => 'Processing', 'status_color' => 'bg-blue-100 text-blue-800'],
        ['id' => 'TXN-47201', 'customer' => 'Eric Mugisha', 'items' => 'Minimalist Silver Ring (2)', 'total' => 170.00, 'status' => 'Shipped', 'status_color' => 'bg-green-100 text-green-800']
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="space-y-8">

        <!-- Welcoming Header Segment Block -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Overview</h1>
            <p class="text-sm text-gray-500 mt-1">Real-time performance metrics and order registry updates for your
                e-commerce engine.</p>
        </div>

        <!-- Analytics Cards Grid Matrix Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($stats as $stat)
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex items-center space-x-4">
                    <div class="p-3 rounded-lg {{ $stat['bg'] }}">
                        <svg class="h-6 w-6 {{ $stat['color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                    <div>
                        <span
                            class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">{{ $stat['label'] }}</span>
                        <span class="text-2xl font-extrabold text-gray-900 mt-0.5 block">{{ $stat['value'] }}</span>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Split Registry Action View Segment Matrix -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <!-- Left 2 Columns: Recent Orders Table Component Overview -->
            <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
                <div class="px-6 py-4 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-gray-900 text-lg">Recent Customer Transactions</h3>
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-xs font-semibold text-amber-600 hover:text-amber-700 transition-colors">View All Orders
                        &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead
                            class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider font-semibold border-b border-gray-100">
                            <tr>
                                <th class="px-6 py-3">Order ID</th>
                                <th class="px-6 py-3">Customer</th>
                                <th class="px-6 py-3">Items Purchased</th>
                                <th class="px-6 py-3">Total Due</th>
                                <th class="px-6 py-3">Fulfillment Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-gray-700 font-medium">
                            @foreach($recentOrders as $order)
                                <tr class="hover:bg-gray-50/50 transition-colors">
                                    <td class="px-6 py-4 font-mono text-gray-900 text-xs">{{ $order['id'] }}</td>
                                    <td class="px-6 py-4 text-sm">{{ $order['customer'] }}</td>
                                    <td class="px-6 py-4 text-xs text-gray-500">{{ $order['items'] }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-900 font-bold">
                                        ${{ number_format($order['total'], 2) }}</td>
                                    <td class="px-6 py-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order['status_color'] }}">
                                            {{ $order['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Right 1 Column: Platform Short Actions Widget -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 flex flex-col justify-between">
                <div>
                    <h3 class="font-bold text-gray-900 text-lg border-b border-gray-100 pb-3 mb-4">Quick Management
                        Utilities</h3>
                    <p class="text-xs text-gray-500 mb-6 leading-relaxed">Direct shortcuts to critical inventory modules.
                        Use these controllers during verification scripts to demonstrate record alteration routines.</p>

                    <div class="space-y-3">
                        <a href="{{ route('admin.products.create') }}"
                            class="w-full bg-gray-900 text-white font-medium py-2.5 px-4 rounded-md hover:bg-amber-600 transition text-center block text-sm shadow-sm">
                            Add New Catalog Item
                        </a>
                        <a href="{{ route('admin.products.index') }}"
                            class="w-full border border-gray-300 text-gray-700 font-medium py-2.5 px-4 rounded-md hover:bg-gray-50 transition text-center block text-sm">
                            Manage Product Catalog Inventory
                        </a>
                    </div>
                </div>

                <div class="mt-8 border-t border-gray-100 pt-4 text-center text-xs text-gray-400 font-medium tracking-wide">
                    Secure SSL Production Pipeline Mockup
                </div>
            </div>

        </div>

    </div>
@endsection