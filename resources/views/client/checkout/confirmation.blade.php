@extends('layouts.client')

@section('content')
    <style>
        .gold-shimmer-text {
            background: linear-gradient(90deg, #0d0d0d 0%, #a67c1e 50%, #0d0d0d 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }
    </style>

    <div class="w-full max-w-[1200px] mx-auto bg-luxury-white pb-32 pt-12 text-center px-4 lg:px-0">

        <!-- Visual Affirmation Frame -->
        <div class="mb-12 flex justify-center">
            <div class="h-16 w-16 flex items-center justify-center border border-luxury-gold/40 relative">
                <span class="absolute text-[8px] font-mono tracking-widest text-luxury-gold top-0 left-1/2 -translate-x-1/2 -translate-y-1/2 bg-luxury-white px-2">SUCCESS</span>
                <svg class="h-5 w-5 text-luxury-gold stroke-[1.25]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="square" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
            </div>
        </div>

        <span class="text-[10px] uppercase tracking-[0.5em] text-luxury-gold font-semibold block mb-4">// Order Confirmed</span>
        <h1 class="text-4xl lg:text-6xl font-serif font-light tracking-tight text-luxury-black max-w-2xl mx-auto leading-tight mb-6">
            Your order is placed. <br><span class="italic font-normal gold-shimmer-text">Thank you.</span>
        </h1>

        <p class="text-xs font-light text-luxury-charcoal/70 max-w-md mx-auto leading-relaxed tracking-wider mb-24">
            We have received your order allocation manifest. Our team is now authenticating the selection sequence and preparing your items for courier assignment.
        </p>

        <!-- Dynamic Manifest Data Grid -->
        <div class="border-t border-b border-luxury-champagne py-14 text-left mb-24 max-w-3xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-16 gap-y-12">

                <!-- 01: Verified Custom Order Token -->
                <div class="flex flex-col border-b border-luxury-champagne/40 pb-4 md:border-b-0 md:pb-0">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-gold font-medium mb-2">01 // Order Number</span>
                    <span class="font-mono text-sm tracking-widest font-medium text-luxury-black uppercase">
                        {{ $order->order_number }}
                    </span>
                </div>

                <!-- 02: Total Allocation Financial Valuation -->
                <div class="flex flex-col border-b border-luxury-champagne/40 pb-4 md:border-b-0 md:pb-0">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-gold font-medium mb-2">02 // Total Valuation</span>
                    <span class="text-xs uppercase tracking-widest font-medium text-luxury-black font-mono">
                        ${{ number_format($order->total_price, 2) }}
                    </span>
                </div>

                <!-- 03: Dispatch Logistics Destination -->
                <div class="flex flex-col border-b border-luxury-champagne/40 pb-4 md:border-b-0 md:pb-0">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-gold font-medium mb-2">03 // Client Assignment</span>
                    <span class="text-xs uppercase tracking-widest font-light text-luxury-black truncate">
                        {{ $order->user->name ?? 'Authenticated Client' }}
                    </span>
                </div>

                <!-- 04: Dynamic Carbon Date Calculations -->
                <div class="flex flex-col">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-gold font-medium mb-2">04 // Expected Delivery</span>
                    <span class="font-serif text-sm tracking-wide text-luxury-gold font-medium">
                        {{ $order->created_at->addDays(3)->format('d M Y') }}
                    </span>
                </div>

            </div>

            <!-- Internal System Footnote -->
            <div class="mt-16 text-center border-t border-luxury-champagne/30 pt-8">
                <p class="text-[9px] uppercase tracking-[0.2em] text-luxury-charcoal/40 leading-relaxed max-w-md mx-auto">
                    A persistent digital footprint of receipt <span class="font-mono">{{ $order->order_number }}</span> has been logged to your secure account profile ledger.
                </p>
            </div>
        </div>

        <!-- System Navigation Redirect Options -->
        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 max-w-lg mx-auto">
            <a href="{{ route('products.index') }}"
                class="w-full text-center group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-6 transition-colors duration-500 overflow-hidden block">
                <span class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                <span class="relative z-10">Continue Curating Collection</span>
            </a>

            <a href="/"
                class="w-full text-center group border border-luxury-black/20 text-luxury-charcoal hover:border-luxury-black font-sans text-xs uppercase tracking-[0.4em] font-medium py-4 px-6 transition-colors duration-500 block">
                <span>Return to Atelier Home</span>
            </a>
        </div>

    </div>
@endsection