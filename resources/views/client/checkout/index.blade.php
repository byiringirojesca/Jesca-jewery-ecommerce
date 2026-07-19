@extends('layouts.client')

@section('content')
    <style>
        .luxury-row-input:focus {
            border-bottom-color: #D4AF37;
            box-shadow: none;
        }
    </style>

    @php
        // Calculate financial aggregates dynamically from real database relationship data
        $subtotal = 0;
        foreach ($cart->items as $item) {
            if ($item->product) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }
        $deliveryFee = 5.00; // Flat luxury logistics fee
        $totalPrice = $subtotal + $deliveryFee;
    @endphp

    <div class="w-full max-w-[1700px] mx-auto bg-luxury-white pb-32 pt-6">

        <header class="border-b border-luxury-champagne pb-8 mb-16 px-4 lg:px-0">
            <span class="text-[10px] uppercase tracking-[0.5em] text-luxury-gold font-semibold block mb-3">//
                Checkout</span>
            <h1 class="text-4xl lg:text-5xl font-serif font-light tracking-tight text-luxury-black">
                Secure Checkout
            </h1>
        </header>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start px-4 lg:px-0">

            <!-- Left Column: Shipping & Details Input Matrix -->
            <div class="lg:col-span-7 flex flex-col">
                <header class="mb-10">
                    <h2
                        class="text-xs uppercase tracking-[0.3em] font-medium text-luxury-black border-b border-luxury-champagne/40 pb-3">
                        01 // Personal Information
                    </h2>
                </header>

                <!-- FIXED: Pointing form to secure store route -->
                <form action="{{ route('checkout.store') }}" method="POST" class="space-y-12">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-12">
                        <div class="relative w-full">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">First
                                Name *</label>
                            <input type="text" name="first_name" required autocomplete="given-name"
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black focus:outline-none luxury-row-input transition-colors duration-500 pt-2">
                        </div>
                        <div class="relative w-full">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Last
                                Name *</label>
                            <input type="text" name="last_name" required autocomplete="family-name"
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black focus:outline-none luxury-row-input transition-colors duration-500 pt-2">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-12">
                        <div class="relative w-full">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Email
                                Address *</label>
                            <input type="email" name="email" value="{{ Auth::user() ? Auth::user()->email : '' }}" required
                                autocomplete="email"
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black focus:outline-none luxury-row-input transition-colors duration-500 pt-2">
                        </div>
                        <div class="relative w-full">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Phone
                                Number *</label>
                            <input type="tel" name="phone" placeholder="e.g., 078XXXXXXX" required autocomplete="tel"
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs tracking-widest text-luxury-black placeholder-luxury-charcoal/30 focus:outline-none luxury-row-input transition-colors duration-500 pt-2">
                        </div>
                    </div>

                    <div class="pt-6">
                        <h3
                            class="text-xs uppercase tracking-[0.3em] font-medium text-luxury-black border-b border-luxury-champagne/40 pb-3">
                            02 // Shipping Address
                        </h3>
                    </div>

                    <div class="relative w-full">
                        <label
                            class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Street
                            Address *</label>
                        <input type="text" name="address" placeholder="House number, street name, apartment, or suite"
                            required
                            class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black placeholder-luxury-charcoal/30 focus:outline-none luxury-row-input transition-colors duration-500 pt-2">
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-10 gap-y-12">
                        <div class="relative w-full">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">City
                                / Province *</label>
                            <input type="text" name="city" placeholder="Kigali" required
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black placeholder-luxury-charcoal/30 focus:outline-none luxury-row-input transition-colors duration-500 pt-2">
                        </div>
                        <div class="relative w-full">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Country</label>
                            <input type="text" name="country" value="Rwanda" readonly
                                class="w-full bg-transparent border-b border-luxury-black/10 pb-2 text-xs uppercase tracking-widest text-luxury-charcoal/60 outline-none cursor-default pt-2">
                        </div>
                    </div>

                    <!-- FIXED: Swapped type="button" to a structural native submit mechanism -->
                    <div class="pt-8">
                        <button type="submit"
                            class="w-full group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-8 transition-colors duration-500 overflow-hidden bg-transparent cursor-pointer">
                            <span
                                class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                            <span class="relative z-10">Place Order // ${{ number_format($totalPrice, 2) }}</span>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Live Dynamic Database Manifest Summary -->
            <div class="lg:col-span-5 lg:sticky lg:top-32 w-full">
                <div class="border border-luxury-champagne p-8 lg:p-10 bg-transparent relative">
                    <h2 class="text-xs uppercase tracking-[0.4em] text-luxury-gold font-semibold mb-6">// Order Summary</h2>

                    <div class="divide-y divide-luxury-champagne/60 max-h-72 overflow-y-auto pr-2 mb-8 luxury-scrollbar">
                        <!-- Map real relational models from CheckoutController -->
                        @foreach($cart->items as $item)
                            @php $product = $item->product; @endphp
                            @if($product)
                                <div class="py-4 flex items-center justify-between gap-6 first:pt-0 last:pb-0">
                                    <div class="flex flex-col">
                                        <h4 class="font-serif font-light text-luxury-black text-sm tracking-wide mb-1">
                                            {{ $product->name }}
                                        </h4>
                                        <span class="text-[9px] uppercase tracking-[0.2em] text-luxury-charcoal/50">
                                            {{ $product->category->name ?? 'Collection' }}
                                            <span class="text-luxury-gold font-sans font-medium">x{{ $item->quantity }}</span>
                                        </span>
                                    </div>
                                    <span class="text-xs font-mono font-medium text-luxury-black tracking-wider">
                                        ${{ number_format($product->price * $item->quantity, 2) }}
                                    </span>
                                </div>
                            @endif
                        @endforeach
                    </div>

                    <div
                        class="border-t border-luxury-champagne pt-4 space-y-4 text-xs font-light tracking-wider text-luxury-charcoal">
                        <div class="flex justify-between">
                            <span>Subtotal</span>
                            <span class="font-medium text-luxury-black">${{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between pb-2">
                            <span>Delivery Fee</span>
                            <span class="font-medium text-luxury-black">${{ number_format($deliveryFee, 2) }}</span>
                        </div>
                        <div
                            class="border-t border-luxury-champagne pt-4 flex justify-between items-baseline text-luxury-black">
                            <span class="text-[10px] uppercase tracking-[0.3em] font-medium">Total Price</span>
                            <span class="text-2xl font-serif font-light text-luxury-gold tracking-tight">
                                ${{ number_format($totalPrice, 2) }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="mt-6 text-center">
                    <span class="text-[9px] uppercase tracking-[0.2em] text-luxury-charcoal/40 block">
                        Secured with SSL Encryption
                    </span>
                </div>
            </div>

        </div>
    </div>
@endsection