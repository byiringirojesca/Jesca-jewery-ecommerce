@php
    // Mock instance layer representing a distinct order record loaded from database lookups
    $order = [
        'id' => 'TXN-84721',
        'customer_name' => 'Alice Umutoni',
        'email' => 'alice@example.com',
        'phone' => '+250 788 000 000',
        'shipping_address' => 'KN 7 Rd, Nyarugenge, Kigali, Rwanda',
        'payment_method' => 'Mobile Money (MoMo)',
        'status' => 'Pending',
        'status_color' => 'bg-amber-100 text-amber-800',
        'date' => '18 Jul 2026',
        'subtotal' => 249.00,
        'shipping_fee' => 5.00,
        'total_amount' => 254.00,
        'items' => [
            [
                'name' => 'Classic Gold Chain',
                'sku' => 'JW-GLD-001',
                'price' => 249.00,
                'quantity' => 1,
                'total' => 249.00,
                'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=150&q=80'
            ]
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <!-- Top Action Breadcrumb Header Row Block -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-xs text-gray-400 font-semibold uppercase tracking-wider">
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-amber-600 transition-colors">Orders
                        Registry</a>
                    <span>/</span>
                    <span class="text-gray-600">Details View</span>
                </div>
                <h1 class="text-3xl font-bold text-gray-900 mt-1">Order {{ $order['id'] }}</h1>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.orders.index') }}"
                    class="px-4 py-2 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    Back to List
                </a>
                <button type="button"
                    class="bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold py-2 px-4 rounded-md shadow-sm transition-colors">
                    Print Invoice Document
                </button>
            </div>
        </div>

        <!-- Main structural Split Panels Matrix -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            <!-- Left Side: Item Breakdown Grid Table (Spans 2 columns) -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
                        <h2 class="text-md font-bold text-gray-900">Purchased Items Lineup</h2>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead
                                class="bg-gray-50 text-xs text-gray-400 uppercase font-semibold tracking-wider border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-3">Product Item</th>
                                    <th class="px-6 py-3">Unit Price</th>
                                    <th class="px-6 py-3">Quantity</th>
                                    <th class="px-6 py-3 text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200 text-gray-700 font-medium">
                                @foreach($order['items'] as $productItem)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-4">
                                                <div
                                                    class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                                    <img src="{{ $productItem['image'] }}" alt="{{ $productItem['name'] }}"
                                                        class="w-full h-full object-cover">
                                                </div>
                                                <div>
                                                    <span
                                                        class="font-bold text-gray-900 text-sm block">{{ $productItem['name'] }}</span>
                                                    <span
                                                        class="text-xs text-gray-400 font-mono font-normal">{{ $productItem['sku'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm">${{ number_format($productItem['price'], 2) }}</td>
                                        <td class="px-6 py-4 text-sm font-mono text-gray-500">{{ $productItem['quantity'] }}x
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-900 font-bold text-right">
                                            ${{ number_format($productItem['total'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Summary pricing calculations panels layout -->
                    <div class="border-t border-gray-200 p-6 bg-gray-50/30 flex justify-end">
                        <div class="w-full sm:w-64 space-y-3 text-sm text-gray-600 font-medium">
                            <div class="flex justify-between">
                                <span>Subtotal Amount:</span>
                                <span class="text-gray-900">${{ number_format($order['subtotal'], 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Fulfillment Shipping:</span>
                                <span class="text-gray-900">${{ number_format($order['shipping_fee'], 2) }}</span>
                            </div>
                            <div
                                class="flex justify-between text-base text-gray-900 font-bold pt-3 border-t border-gray-200">
                                <span>Total Gross Invoice:</span>
                                <span class="text-amber-600">${{ number_format($order['total_amount'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Transaction Pipeline Tracking Status Module Box -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                    <h3 class="text-sm font-bold text-gray-900 mb-4">Update Order Processing State</h3>
                    <form action="#" method="POST" class="flex flex-col sm:flex-row items-end gap-4">
                        @csrf
                        @method('PATCH')
                        <div class="w-full sm:w-64">
                            <label
                                class="block text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1.5">Fulfillment
                                Stage Allocation</label>
                            <select name="status"
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500 bg-white font-medium">
                                <option value="Pending" {{ $order['status'] == 'Pending' ? 'selected' : '' }}>Pending
                                    Verification</option>
                                <option value="Processing" {{ $order['status'] == 'Processing' ? 'selected' : '' }}>Processing
                                    / Packaging</option>
                                <option value="Shipped" {{ $order['status'] == 'Shipped' ? 'selected' : '' }}>Shipped /
                                    Dispatch</option>
                                <option value="Cancelled" {{ $order['status'] == 'Cancelled' ? 'selected' : '' }}>Cancelled
                                </option>
                            </select>
                        </div>
                        <button type="button"
                            class="w-full sm:w-auto bg-gray-900 hover:bg-gray-800 text-white text-sm font-semibold py-2 px-5 rounded-md shadow-sm transition-colors whitespace-nowrap">
                            Apply State Modification
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Metadata Customer Profiles Framework Column Card -->
            <div class="space-y-6">
                <!-- Customer Context Summary Panel Details Block -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 space-y-4">
                    <h2 class="text-md font-bold text-gray-900 border-b border-gray-100 pb-3">Client Information Profile
                    </h2>

                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Full Legal
                            Name</span>
                        <span class="text-sm font-bold text-gray-900 block">{{ $order['customer_name'] }}</span>
                    </div>

                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Email Address
                            Channel</span>
                        <a href="mailto:{{ $order['email'] }}"
                            class="text-sm font-medium text-amber-600 hover:underline block truncate">{{ $order['email'] }}</a>
                    </div>

                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Contact Phone
                            Vector</span>
                        <span class="text-sm font-medium text-gray-900 block">{{ $order['phone'] }}</span>
                    </div>
                </div>

                <!-- Logistics Location Details Target Card Block Container -->
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 space-y-4">
                    <h2 class="text-md font-bold text-gray-900 border-b border-gray-100 pb-3">Fulfillment & Logistics</h2>

                    <div class="space-y-1">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Target Routing
                            Destination Address</span>
                        <span
                            class="text-sm font-medium text-gray-700 block leading-relaxed">{{ $order['shipping_address'] }}</span>
                    </div>

                    <div class="space-y-1 pt-2">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Clearing Gateway
                            Method</span>
                        <span class="text-sm font-bold text-gray-900 block">{{ $order['payment_method'] }}</span>
                    </div>

                    <div class="space-y-1 pt-2">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Internal Workflow
                            Datestamp</span>
                        <span class="text-sm font-medium text-gray-500 block">{{ $order['date'] }}</span>
                    </div>

                    <div class="space-y-1 pt-2">
                        <span class="text-xs text-gray-400 font-semibold uppercase tracking-wider block">Current Status
                            Flag</span>
                        <div class="mt-1">
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order['status_color'] }}">
                                {{ $order['status'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection