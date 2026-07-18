@php
    // Quick admin orders management tracking mock data layer
    $customerOrders = [
        [
            'id' => 'TXN-84721',
            'customer_name' => 'Alice Umutoni',
            'email' => 'alice@example.com',
            'items_summary' => 'Classic Gold Chain &times; 1',
            'total_amount' => 254.00,
            'status' => 'Pending',
            'status_color' => 'bg-amber-50 text-amber-700 border-amber-200',
            'date' => '18 Jul 2026'
        ],
        [
            'id' => 'TXN-19482',
            'customer_name' => 'Jean Keza',
            'email' => 'jean.k@example.com',
            'items_summary' => 'Silk Evening Dress &times; 1',
            'total_amount' => 194.00,
            'status' => 'Processing',
            'status_color' => 'bg-blue-50 text-blue-700 border-blue-200',
            'date' => '17 Jul 2026'
        ],
        [
            'id' => 'TXN-47201',
            'customer_name' => 'Eric Mugisha',
            'email' => 'eric.m@example.com',
            'items_summary' => 'Minimalist Silver Ring &times; 2',
            'total_amount' => 175.00,
            'status' => 'Shipped',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'date' => '15 Jul 2026'
        ],
        [
            'id' => 'TXN-30291',
            'customer_name' => 'Marie Claire',
            'email' => 'marie@example.com',
            'items_summary' => 'Premium Trench Coat &times; 1',
            'total_amount' => 304.00,
            'status' => 'Cancelled',
            'status_color' => 'bg-red-50 text-red-700 border-red-200',
            'date' => '12 Jul 2026'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-600 block mb-2">Boutique
                    Ledger</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Customer Orders</h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    View and manage customer purchases, track shipping updates, and review sales metrics.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // ORDER MANAGEMENT v1.0
            </div>
        </div>

        <!-- Search & Info Bar -->
        <div
            class="bg-white p-4 border border-neutral-200 rounded-none flex flex-col sm:flex-row items-center justify-between gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)]">
            <div class="w-full sm:w-72">
                <input type="text" placeholder="Search by Order ID or customer..."
                    class="w-full border border-neutral-300 rounded-none bg-white px-4 py-2 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-amber-500 transition-colors">
            </div>
            <div class="text-xs uppercase tracking-wider text-neutral-500 font-semibold">
                Total Orders: <span class="text-neutral-900 font-bold ml-1">{{ count($customerOrders) }}</span>
            </div>
        </div>

        <!-- Main Orders Table -->
        <div
            class="bg-white border border-neutral-200 rounded-none overflow-hidden flex flex-col shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-neutral-50 text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
                        <tr>
                            <th class="px-6 py-4 font-medium">Order ID</th>
                            <th class="px-6 py-4 font-medium">Customer</th>
                            <th class="px-6 py-4 font-medium">Items</th>
                            <th class="px-6 py-4 font-medium">Total Amount</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-700">
                        @foreach($customerOrders as $order)
                            <tr class="group hover:bg-neutral-50/60 transition-all duration-300">

                                <!-- Order ID -->
                                <td class="px-6 py-5 font-mono text-xs font-semibold text-neutral-900">
                                    {{ $order['id'] }}
                                </td>

                                <!-- Customer Info -->
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-semibold text-neutral-900">{{ $order['customer_name'] }}</span>
                                        <span class="text-xs text-neutral-400 mt-0.5">{{ $order['email'] }}</span>
                                    </div>
                                </td>

                                <!-- Purchased Items Summary -->
                                <td class="px-6 py-5 text-xs text-neutral-500 font-light italic">
                                    {!! $order['items_summary'] !!}
                                </td>

                                <!-- Total Cost -->
                                <td class="px-6 py-5 text-sm text-neutral-900 font-semibold">
                                    ${{ number_format($order['total_amount'], 2) }}
                                </td>

                                <!-- Placement Date -->
                                <td class="px-6 py-5 text-xs text-neutral-500">
                                    {{ $order['date'] }}
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $order['status_color'] }}">
                                        {{ $order['status'] }}
                                    </span>
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-6 py-5 text-right text-xs uppercase tracking-wider font-medium">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#" class="text-amber-600 hover:text-neutral-900 transition-colors">Update
                                            Status</a>
                                        <span class="text-neutral-200">|</span>
                                        <a href="#" class="text-neutral-500 hover:text-neutral-900 transition-colors">View
                                            Invoice</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer & Pagination -->
            <div
                class="px-6 py-4 bg-neutral-50 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-500 font-medium">
                <span>Showing 1 to {{ count($customerOrders) }} of {{ count($customerOrders) }} entries</span>
                <div class="inline-flex items-center gap-2">
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">
                        Previous
                    </button>
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Line -->
        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-4">
            <div class="w-12 h-px bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>
@endsection