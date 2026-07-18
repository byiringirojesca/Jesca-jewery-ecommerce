@php
    // Quick frontend mockup data layer for the shopping cart items layout
    $cartItems = [
        [
            'id' => 1,
            'name' => 'Classic Gold Chain',
            'category' => 'Jewelry',
            'price' => 249.00,
            'quantity' => 1,
            'stock' => 5,
            'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=200&q=80'
        ],
        [
            'id' => 3,
            'name' => 'Silk Evening Dress',
            'category' => 'Clothing',
            'price' => 189.00,
            'quantity' => 1,
            'stock' => 3,
            'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=200&q=80'
        ]
    ];

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
@endphp

@extends('layouts.client')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Shopping Cart</h1>

        @if(count($cartItems) > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left Side: Cart Items List Table Grid -->
                <div class="lg:col-span-8 space-y-4">
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="p-6 divide-y divide-gray-100">
                            @foreach($cartItems as $item)
                                <div
                                    class="py-6 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-6 {{ $loop->first ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">
                                    <!-- Product Image & Basic Context Details -->
                                    <div class="flex items-center gap-4">
                                        <div class="w-20 h-20 bg-gray-50 rounded-lg overflow-hidden flex-shrink-0">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                        <div>
                                            <span
                                                class="text-xs text-amber-600 font-semibold uppercase tracking-wider">{{ $item['category'] }}</span>
                                            <h4 class="font-bold text-gray-900 text-base mt-0.5">{{ $item['name'] }}</h4>
                                            <p class="text-sm font-semibold text-gray-500 mt-1">
                                                ${{ number_format($item['price'], 2) }}</p>
                                        </div>
                                    </div>

                                    <!-- Quantity Controls and Actions Block Row -->
                                    <div
                                        class="flex items-center justify-between sm:justify-end w-full sm:w-auto gap-8 border-t sm:border-t-0 pt-4 sm:pt-0">
                                        <div class="flex items-center border border-gray-200 rounded-md bg-gray-50">
                                            <button type="button"
                                                class="px-3 py-1 text-gray-500 hover:text-amber-600 font-bold transition-colors">&minus;</button>
                                            <span
                                                class="px-3 py-1 text-sm font-semibold text-gray-900 w-8 text-center bg-white">{{ $item['quantity'] }}</span>
                                            <button type="button"
                                                class="px-3 py-1 text-gray-500 hover:text-amber-600 font-bold transition-colors">&plus;</button>
                                        </div>

                                        <div class="text-right">
                                            <span
                                                class="block text-base font-bold text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                            <button type="button"
                                                class="text-xs text-red-500 hover:text-red-600 font-medium transition-colors mt-1">Remove</button>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Right Side: Order Summary Calculation & Processing Card -->
                <div class="lg:col-span-4">
                    <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                        <h3 class="text-xl font-bold text-gray-900 mb-6">Summary</h3>

                        <div class="space-y-4 text-sm text-gray-600">
                            <div class="flex justify-between pb-4 border-b border-gray-100">
                                <span>Subtotal Items</span>
                                <span class="font-semibold text-gray-900">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between text-gray-500 text-xs italic">
                                <span>Shipping calculated at the checkout screen profile phase.</span>
                            </div>
                            <div class="pt-2 flex justify-between text-lg font-extrabold text-gray-900">
                                <span>Estimated Total</span>
                                <span class="text-amber-600">${{ number_format($subtotal, 2) }}</span>
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('checkout.index') }}"
                                class="w-full bg-amber-600 text-white font-semibold py-3 px-6 rounded-md hover:bg-amber-700 transition duration-150 text-center block shadow-sm text-sm">
                                Proceed to Secure Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Fallback view UI window if no items are inside selection registry -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-12 text-center max-w-xl mx-auto">
                <div class="inline-flex items-center justify-center h-16 w-16 rounded-full bg-gray-50 text-gray-400 mb-4">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Your cart is currently empty</h3>
                <p class="text-sm text-gray-500 mb-6">Explore our curated collections to add items here.</p>
                <a href="{{ route('products.index') }}"
                    class="bg-gray-900 text-white font-medium py-2 px-6 rounded-md hover:bg-amber-600 transition duration-150 text-sm">
                    Shop Our Collection
                </a>
            </div>
        @endif
    </div>
@endsection