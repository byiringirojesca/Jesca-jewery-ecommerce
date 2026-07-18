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
        'status_color' => 'bg-amber-50 text-amber-700 border-amber-200',
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
    <div class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal">

        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <div class="flex items-center gap-2 text-[10px] font-semibold uppercase tracking-[0.2em] text-neutral-400">
                    <a href="{{ route('admin.orders.index') }}" class="hover:text-amber-600 transition-colors">Orders Registry</a>
                    <span>/</span>
                    <span class="text-neutral-600">Details View</span>
                </div>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900 mt-2">Order {{ $order['id'] }}</h1>
            </div>
            
            <div class="flex items-center gap-3 w-full md:w-auto">
                <a href="{{ route('admin.orders.index') }}"
                    class="w-1/2 md:w-auto text-center border border-neutral-300 text-neutral-700 font-medium py-3 px-6 rounded-none hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition-all duration-500 text-xs uppercase tracking-[0.2em]">
                    Back to List
                </a>
                <button type="button"
                    class="w-1/2 md:w-auto text-center bg-neutral-900 text-white font-medium py-3 px-6 rounded-none hover:bg-amber-600 transition-all duration-500 text-xs uppercase tracking-[0.2em] shadow-sm">
                    Print Invoice
                </button>
            </div>
        </div>

        <!-- Main Structural Split Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-start">

            <!-- Left Side: Items & Order Action Pipeline (Spans 2 columns) -->
            <div class="lg:col-span-2 space-y-8">
                
                <!-- Table Card Container -->
                <div class="bg-white border border-neutral-200 rounded-none overflow-hidden flex flex-col shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
                    <div class="px-6 py-4 border-b border-neutral-100 bg-neutral-50/40">
                        <h2 class="text-xs uppercase tracking-[0.15em] font-semibold text-neutral-900">Purchased Items Lineup</h2>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left text-sm whitespace-nowrap">
                            <thead class="bg-neutral-50 text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
                                <tr>
                                    <th class="px-6 py-4 font-medium">Product Item</th>
                                    <th class="px-6 py-4 font-medium">Unit Price</th>
                                    <th class="px-6 py-4 font-medium">Quantity</th>
                                    <th class="px-6 py-4 font-medium text-right">Total</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100 text-neutral-700">
                                @foreach($order['items'] as $productItem)
                                    <tr class="group hover:bg-neutral-50/40 transition-colors duration-300">
                                        <td class="px-6 py-5">
                                            <div class="flex items-center gap-4">
                                                <div class="w-14 h-14 bg-neutral-50 border border-neutral-200 rounded-none overflow-hidden flex-shrink-0">
                                                    <img src="{{ $productItem['image'] }}" alt="{{ $productItem['name'] }}"
                                                        class="w-full h-full object-cover grayscale group-hover:grayscale-0 transition-all duration-500">
                                                </div>
                                                <div>
                                                    <span class="font-semibold text-neutral-900 text-sm block">{{ $productItem['name'] }}</span>
                                                    <span class="text-xs font-mono text-neutral-400 block mt-0.5 tracking-normal">{{ $productItem['sku'] }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-5 text-sm text-neutral-600">${{ number_format($productItem['price'], 2) }}</td>
                                        <td class="px-6 py-5 text-xs font-mono text-neutral-400">{{ $productItem['quantity'] }}x</td>
                                        <td class="px-6 py-5 text-sm text-neutral-900 font-semibold text-right">${{ number_format($productItem['total'], 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <!-- Financial Summary Panel -->
                    <div class="border-t border-neutral-200 p-6 bg-neutral-50/30 flex justify-end">
                        <div class="w-full sm:w-72 space-y-3.5 text-xs uppercase tracking-wider text-neutral-500 font-medium">
                            <div class="flex justify-between">
                                <span>Subtotal Amount</span>
                                <span class="text-neutral-900 font-semibold font-mono tracking-normal">${{ number_format($order['subtotal'], 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Fulfillment Shipping</span>
                                <span class="text-neutral-900 font-semibold font-mono tracking-normal">${{ number_format($order['shipping_fee'], 2) }}</span>
                            </div>
                            <div class="flex justify-between text-sm text-neutral-900 font-bold pt-4 border-t border-neutral-200/80">
                                <span class="text-xs uppercase tracking-[0.15em]">Total Gross Invoice</span>
                                <span class="text-amber-600 font-mono tracking-normal">${{ number_format($order['total_amount'], 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pipeline Status Transition Area -->
                <div class="bg-white border border-neutral-200 p-6 md:p-8 rounded-none shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
                    <h3 class="text-xs uppercase tracking-[0.15em] font-semibold text-neutral-900 mb-5">Update Order Processing State</h3>
                    
                    <form action="#" method="POST" class="flex flex-col sm:flex-row items-end gap-4">
                        @csrf
                        @method('PATCH')
                        <div class="w-full sm:flex-1">
                            <label class="block text-[10px] font-semibold text-neutral-400 uppercase tracking-[0.2em] mb-2">
                                Fulfillment Stage Allocation
                            </label>
                            <div class="relative">
                                <select name="status"
                                    class="w-full border border-neutral-300 rounded-none bg-white px-4 py-3 text-sm text-neutral-800 focus:outline-none focus:border-amber-500 font-medium appearance-none transition-colors">
                                    <option value="Pending" {{ $order['status'] == 'Pending' ? 'selected' : '' }}>Pending Verification</option>
                                    <option value="Processing" {{ $order['status'] == 'Processing' ? 'selected' : '' }}>Processing / Packaging</option>
                                    <option value="Shipped" {{ $order['status'] == 'Shipped' ? 'selected' : '' }}>Shipped / Dispatch</option>
                                    <option value="Cancelled" {{ $order['status'] == 'Cancelled' ? 'selected' : '' }}>Cancelled</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-neutral-400 border-l border-neutral-200">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"/></svg>
                                </div>
                            </div>
                        </div>
                        <button type="button"
                            class="w-full sm:w-auto bg-neutral-900 text-white font-medium py-[13px] px-6 rounded-none hover:bg-amber-600 transition-all duration-500 text-xs uppercase tracking-[0.2em] whitespace-nowrap">
                            Apply Modification
                        </button>
                    </form>
                </div>
            </div>

            <!-- Right Side: Sidebar Meta Profiles Context Columns -->
            <div class="space-y-8">
                
                <!-- Client Profile Meta Block -->
                <div class="bg-white border border-neutral-200 p-6 md:p-8 rounded-none space-y-5 shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
                    <h2 class="text-xs uppercase tracking-[0.15em] font-semibold text-neutral-900 border-b border-neutral-100 pb-4">
                        Client Profile
                    </h2>

                    <div class="space-y-1.5">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Full Legal Name</span>
                        <span class="text-sm font-semibold text-neutral-900 block font-serif tracking-wide">{{ $order['customer_name'] }}</span>
                    </div>

                    <div class="space-y-1.5 pt-1">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Email Address Channel</span>
                        <a href="mailto:{{ $order['email'] }}"
                            class="text-sm font-medium text-amber-600 hover:text-neutral-900 transition-colors block truncate tracking-tight">{{ $order['email'] }}</a>
                    </div>

                    <div class="space-y-1.5 pt-1">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Contact Phone Vector</span>
                        <span class="text-sm font-semibold text-neutral-900 block font-mono tracking-normal">{{ $order['phone'] }}</span>
                    </div>
                </div>

                <!-- Logistics Meta Target Block -->
                <div class="bg-white border border-neutral-200 p-6 md:p-8 rounded-none space-y-5 shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
                    <h2 class="text-xs uppercase tracking-[0.15em] font-semibold text-neutral-900 border-b border-neutral-100 pb-4">
                        Logistics & Fulfillment
                    </h2>

                    <div class="space-y-1.5">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Routing Destination Address</span>
                        <span class="text-sm font-medium text-neutral-700 block leading-relaxed italic font-serif">
                            {{ $order['shipping_address'] }}
                        </span>
                    </div>

                    <div class="space-y-1.5 pt-2 border-t border-neutral-50">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Clearing Gateway Method</span>
                        <span class="text-sm font-semibold text-neutral-900 block tracking-tight">{{ $order['payment_method'] }}</span>
                    </div>

                    <div class="space-y-1.5 pt-2 border-t border-neutral-50">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Workflow Datestamp</span>
                        <span class="text-sm font-medium text-neutral-500 block font-mono">{{ $order['date'] }}</span>
                    </div>

                    <div class="space-y-2 pt-2 border-t border-neutral-50">
                        <span class="text-[10px] text-neutral-400 font-semibold uppercase tracking-[0.15em] block">Current Status Flag</span>
                        <div class="pt-0.5">
                            <span class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $order['status_color'] }} rounded-none">
                                {{ $order['status'] }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Line -->
        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-6">
            <div class="w-12 h-px bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>
@endsection