@php
    // Quick template fallbacks for presentation mapping if variables are missing
    $transactionId = request()->route('id') ?? 'TXN-' . rand(10000, 99999);
    $estimatedDelivery = date('d M Y', strtotime('+3 days'));
@endphp

@extends('layouts.client')

@section('content')
    <div class="max-w-2xl mx-auto my-12 text-center">
        <!-- Success Status Icon Animation Container -->
        <div
            class="inline-flex items-center justify-center h-20 w-20 rounded-full bg-green-50 text-green-600 mb-6 shadow-sm border border-green-100">
            <svg class="h-10 w-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        </div>

        <!-- Main Message Grid Header -->
        <h1 class="text-3xl font-extrabold text-gray-900 tracking-tight mb-2">Thank You for Your Purchase!</h1>
        <p class="text-base text-gray-600 max-w-md mx-auto mb-8">Your order has been placed successfully and is currently
            being processed by our logistics fulfillment center.</p>

        <!-- Detailed Invoice Specifications Summary Card -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 text-left mb-8 divide-y divide-gray-100">
            <div class="pb-4 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500 block uppercase tracking-wider text-xs font-semibold">Order Registry
                        Reference</span>
                    <span class="font-mono font-bold text-gray-900 mt-0.5 block">{{ $transactionId }}</span>
                </div>
                <div>
                    <span class="text-gray-500 block uppercase tracking-wider text-xs font-semibold">Payment
                        Architecture</span>
                    <span class="font-medium text-gray-900 mt-0.5 block">Cash on Delivery / Mock Wallet</span>
                </div>
            </div>

            <div class="pt-4 pb-4 grid grid-cols-2 gap-4 text-sm">
                <div>
                    <span class="text-gray-500 block uppercase tracking-wider text-xs font-semibold">Target Shipping
                        Address</span>
                    <span class="text-gray-700 mt-0.5 block">Kigali, Rwanda</span>
                </div>
                <div>
                    <span class="text-gray-500 block uppercase tracking-wider text-xs font-semibold">Estimated Delivery
                        Window</span>
                    <span class="text-amber-600 font-bold mt-0.5 block">{{ $estimatedDelivery }}</span>
                </div>
            </div>

            <div class="pt-4 text-center text-xs text-gray-400">
                A copy of this digital invoice snapshot has been registered down into your system profile database schema.
            </div>
        </div>

        <!-- Quick Navigation Call to Actions -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('products.index') }}"
                class="w-full sm:w-auto bg-amber-600 text-white font-medium py-3 px-6 rounded-md hover:bg-amber-700 transition duration-150 shadow-sm text-sm">
                Continue Shopping
            </a>
            <a href="{{ route('home') }}"
                class="w-full sm:w-auto bg-gray-100 text-gray-700 font-medium py-3 px-6 rounded-md hover:bg-gray-200 transition duration-150 text-sm">
                Return to Homepage
            </a>
        </div>
    </div>
@endsection