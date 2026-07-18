@php
    // Quick admin orders management tracking mock data layer
    $customerOrders = [
        [
            'id' => 'TXN-84721',
            'customer_name' => 'Alice Umutoni',
            'email' => 'alice@example.com',
            'items_summary' => 'Classic Gold Chain &times; 1',
            'total_amount' => 254.00, // Includes mock delivery fee
            'status' => 'Pending',
            'status_color' => 'bg-amber-100 text-amber-800',
            'date' => '18 Jul 2026'
        ],
        [
            'id' => 'TXN-19482',
            'customer_name' => 'Jean Keza',
            'email' => 'jean.k@example.com',
            'items_summary' => 'Silk Evening Dress &times; 1',
            'total_amount' => 194.00,
            'status' => 'Processing',
            'status_color' => 'bg-blue-100 text-blue-800',
            'date' => '17 Jul 2026'
        ],
        [
            'id' => 'TXN-47201',
            'customer_name' => 'Eric Mugisha',
            'email' => 'eric.m@example.com',
            'items_summary' => 'Minimalist Silver Ring &times; 2',
            'total_amount' => 175.00,
            'status' => 'Shipped',
            'status_color' => 'bg-green-100 text-green-800',
            'date' => '15 Jul 2026'
        ],
        [
            'id' => 'TXN-30291',
            'customer_name' => 'Marie Claire',
            'email' => 'marie@example.com',
            'items_summary' => 'Premium Trench Coat &times; 1',
            'total_amount' => 304.00,
            'status' => 'Cancelled',
            'status_color' => 'bg-red-100 text-red-800',
            'date' => '12 Jul 2026'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <!-- Top Context Navigation Row Header -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Customer Orders</h1>
            <p class="text-sm text-gray-500 mt-1">Track and manage customer transactions, modify shipping status codes, and
                review fulfillment metrics.</p>
        </div>

        <!-- Stats & Total Counts Summary Row Bar -->
        <div
            class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="w-full sm:w-72">
                <input type="text" placeholder="Search by Order ID, Client..."
                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div class="text-sm text-gray-500 font-medium">
                Total Registry Stack: <span class="text-gray-900 font-bold">{{ count($customerOrders) }} Orders
                    registered</span>
            </div>
        </div>

        <!-- Main Datatable Framework Grid Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Order Reference</th>
                            <th class="px-6 py-3.5">Customer Client</th>
                            <th class="px-6 py-3.5">Purchased Summary</th>
                            <th class="px-6 py-3.5">Total Revenue</th>
                            <th class="px-6 py-3.5">Placement Date</th>
                            <th class="px-6 py-3.5">Fulfillment Status</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700 font-medium">
                        @foreach($customerOrders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <!-- Order Mono Tracking Reference code -->
                                <td class="px-6 py-4 font-mono text-xs font-bold text-gray-900">
                                    {{ $order['id'] }}
                                </td>

                                <!-- Customer Profile Contact Identifiers -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900">{{ $order['customer_name'] }}</span>
                                        <span class="text-xs text-gray-400 font-normal">{{ $order['email'] }}</span>
                                    </div>
                                </td>

                                <!-- Itemization summary breakdown string link -->
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    {!! $order['items_summary'] !!}
                                </td>

                                <!-- Total invoice cost calculation matrix tracking field -->
                                <td class="px-6 py-4 text-sm text-gray-900 font-extrabold">
                                    ${{ number_format($order['total_amount'], 2) }}
                                </td>

                                <td class="px-6 py-4 text-xs text-gray-500">
                                    {{ $order['date'] }}
                                </td>

                                <!-- Status pills element color mappings mapping -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $order['status_color'] }}">
                                        {{ $order['status'] }}
                                    </span>
                                </td>

                                <!-- Action Management Controls Links Area -->
                                <td class="px-6 py-4 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#" class="text-amber-600 hover:text-amber-700 font-bold">Process Status</a>
                                        <span class="text-gray-300">|</span>
                                        <a href="#" class="text-gray-600 hover:text-gray-900 font-bold">Invoice Details</a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mock Pagination Tracker Footer Bar -->
            <div
                class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Showing 1 to {{ count($customerOrders) }} of {{ count($customerOrders) }} entries</span>
                <div class="inline-flex items-center gap-1">
                    <button type="button" disabled
                        class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Previous</button>
                    <button type="button" disabled
                        class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Next</button>
                </div>
            </div>
        </div>
    </div>
@endsection