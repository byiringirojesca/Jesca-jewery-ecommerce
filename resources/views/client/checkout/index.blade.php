@php
    // Quick frontend mockup data layer for order tracking and calculation review
    $cartItems = [
        [
            'name' => 'Classic Gold Chain',
            'category' => 'Jewelry',
            'quantity' => 1,
            'price' => 249.00
        ],
        [
            'name' => 'Silk Evening Dress',
            'category' => 'Clothing',
            'quantity' => 1,
            'price' => 189.00
        ]
    ];

    $subtotal = 0;
    foreach ($cartItems as $item) {
        $subtotal += $item['price'] * $item['quantity'];
    }
    $deliveryFee = 5.00; // Estimated RWF base equivalent/mock shipping fee
    $totalPrice = $subtotal + $deliveryFee;
@endphp

@extends('layouts.client')

@section('content')
    <div class="max-w-7xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-900 mb-8">Checkout Secure Processing</h1>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Left Side: Shipping and Order Information Collection Form -->
            <div class="lg:col-span-7 bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Customer & Shipping Details</h2>

                <form action="#" method="POST" class="space-y-6">
                    @csrf

                    <!-- Contact Info Section -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">First Name *</label>
                            <input type="text" name="first_name" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Last Name *</label>
                            <input type="text" name="last_name" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email Address *</label>
                            <input type="email" name="email" value="{{ Auth::user() ? Auth::user()->email : '' }}" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number *</label>
                            <input type="tel" name="phone" placeholder="e.g., 078XXXXXXX" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Destination Location Details -->
                    <hr class="border-gray-100 my-4">
                    <h3 class="text-md font-bold text-gray-900 mb-3">Delivery Destination</h3>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Street Address / Neighborhood *</label>
                        <input type="text" name="address" placeholder="House number, street info, or specific landmarks"
                            required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">City / Province *</label>
                            <input type="text" name="city" placeholder="Kigali" required
                                class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Country *</label>
                            <input type="text" name="country" value="Rwanda" readonly
                                class="w-full bg-gray-50 border border-gray-300 rounded-md px-3 py-2 text-sm text-gray-500 outline-none">
                        </div>
                    </div>

                    <!-- Complete Checkout Trigger button -->
                    <div class="pt-4">
                        <button type="button"
                            onclick="window.location.href='{{ route('checkout.confirmation', ['id' => 'TXN-' . rand(10000, 99999)]) }}'"
                            class="w-full bg-amber-600 text-white font-semibold py-3 px-6 rounded-md hover:bg-amber-700 transition duration-150 text-center block shadow-sm">
                            Confirm & Place Order ($\${{ number_format($totalPrice, 2) }}$)
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side: Order Summary Review Window Module -->
            <div class="lg:col-span-5">
                <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Order Summary Review</h2>

                    <!-- Item Stack List -->
                    <div class="divide-y divide-gray-100 max-h-64 overflow-y-auto pr-2 mb-6">
                        @foreach($cartItems as $item)
                            <div class="py-3 flex items-center justify-between gap-4">
                                <div>
                                    <h4 class="font-medium text-gray-900 text-sm">{{ $item['name'] }}</h4>
                                    <span class="text-xs text-gray-500">{{ $item['category'] }} &times;
                                        {{ $item['quantity'] }}</span>
                                </div>
                                <span
                                    class="text-sm font-semibold text-gray-900">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                            </div>
                        @endforeach
                    </div>

                    <!-- Final Calculations Grid Stack -->
                    <div class="border-t border-gray-100 pt-4 space-y-3 text-sm text-gray-600">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-medium text-gray-900">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Standard Delivery</span>
                            <span class="font-medium text-gray-900">${{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div
                            class="border-t border-gray-100 pt-3 flex justify-between text-base font-extrabold text-gray-900">
                            <span>Total Due</span>
                            <span class="text-amber-600">${{ number_format($totalPrice, 2) }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection