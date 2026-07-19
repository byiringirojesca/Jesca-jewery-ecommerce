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

    @php
        // Compute running financial calculations directly off loaded models
        $subtotal = 0;
        foreach ($cart->items as $item) {
            if ($item->product) {
                $subtotal += $item->product->price * $item->quantity;
            }
        }
    @endphp

    <div class="w-full max-w-[1700px] mx-auto bg-luxury-white pb-32 pt-6">

        <!-- Error/Success Notification Display Blocks -->
        @if(session('success'))
            <div
                class="mb-6 p-4 bg-green-50 border border-green-200 text-green-800 text-xs uppercase tracking-widest mx-4 lg:mx-0">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-6 p-4 bg-red-50 border border-red-200 text-red-800 text-xs uppercase tracking-widest mx-4 lg:mx-0">
                {{ session('error') }}
            </div>
        @endif

        <header class="border-b border-luxury-champagne pb-8 mb-16 px-4 lg:px-0">
            <span class="text-[10px] uppercase tracking-[0.5em] text-luxury-gold font-semibold block mb-3">// Selected
                Manifest</span>
            <h1 class="text-4xl lg:text-5xl font-serif font-light tracking-tight text-luxury-black">
                Your Shopping Bag <span class="italic font-normal gold-shimmer-text">({{ $cart->items->count() }})</span>
            </h1>
        </header>

        @if($cart->items->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start px-4 lg:px-0">

                <!-- Interactive Bag Listings Module -->
                <div class="lg:col-span-8 flex flex-col">
                    <div class="divide-y divide-luxury-champagne/80">
                        @foreach($cart->items as $item)
                            @php
                                $product = $item->product;
                                if (!$product)
                                    continue;

                                // Parse product images safely supporting both string JSON matrices and plain text paths
                                $rawImages = $product->images ?? $product->image ?? null;
                                $displayImage = 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=200&q=80'; // fallback

                                if (is_string($rawImages)) {
                                    $decoded = json_decode($rawImages, true);
                                    $imgSrc = is_array($decoded) ? ($decoded[0] ?? null) : $rawImages;
                                } else {
                                    $imgSrc = is_array($rawImages) ? ($rawImages[0] ?? null) : null;
                                }

                                if ($imgSrc) {
                                    $displayImage = \Illuminate\Support\Str::startsWith($imgSrc, ['http://', 'https://']) ? $imgSrc : asset('storage/' . ltrim($imgSrc, '/'));
                                }

                                $categoryName = $product->category->name ?? 'Collection';
                            @endphp

                            <div
                                class="py-8 flex flex-col md:flex-row items-start md:items-center justify-between gap-6 {{ $loop->first ? 'pt-0' : '' }} {{ $loop->last ? 'pb-0' : '' }}">

                                <!-- Left Profile Area: Media Frame and Product Details -->
                                <div class="flex items-center gap-6 md:gap-8 flex-grow">
                                    <div class="w-24 h-28 bg-luxury-champagne overflow-hidden flex-shrink-0 relative group">
                                        <div class="absolute inset-0 bg-luxury-black/5 mix-blend-multiply pointer-events-none">
                                        </div>
                                        <img src="{{ $displayImage }}" alt="{{ $product->name }}"
                                            class="w-full h-full object-cover transform scale-100 group-hover:scale-105 transition-transform duration-700">
                                    </div>
                                    <div class="flex flex-col">
                                        <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-gold font-medium mb-1">
                                            {{ $categoryName }} // Atelier Item
                                        </span>
                                        <h4 class="font-serif font-light text-luxury-black text-xl tracking-tight mb-2">
                                            {{ $product->name }}
                                        </h4>
                                        <p class="text-xs font-light text-luxury-charcoal/60 tracking-wider">
                                            Unit Matrix Price: <span
                                                class="text-luxury-black font-medium">${{ number_format($product->price, 2) }}</span>
                                        </p>
                                    </div>
                                </div>

                                <!-- Right Profile Area: Quantity Management Counter and Item Financial Valuation Subtotals -->
                                <div
                                    class="flex items-center justify-between md:justify-end w-full md:w-auto gap-12 border-t border-luxury-champagne/40 md:border-t-0 pt-4 md:pt-0">

                                    <!-- Controlled Incrementer/Decrementer Utility Components -->
                                    <div class="flex items-center border border-luxury-black/15 bg-transparent p-1">

                                        <!-- Decrement Action Interface -->
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline m-0 p-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity - 1 }}">
                                            <button type="submit" {{ $item->quantity <= 1 ? 'disabled' : '' }}
                                                class="w-8 h-8 flex items-center justify-center text-luxury-charcoal hover:text-luxury-gold text-sm font-light transition-colors duration-300 disabled:opacity-20 disabled:hover:text-luxury-charcoal cursor-pointer disabled:cursor-not-allowed">
                                                &minus;
                                            </button>
                                        </form>

                                        <span
                                            class="w-8 text-center text-xs font-mono text-luxury-black tracking-widest select-none">
                                            {{ sprintf("%02d", $item->quantity) }}
                                        </span>

                                        <!-- Increment Action Interface -->
                                        <form action="{{ route('cart.update', $item->id) }}" method="POST" class="inline m-0 p-0">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="quantity" value="{{ $item->quantity + 1 }}">
                                            <button type="submit" {{ $item->quantity >= $product->stock ? 'disabled' : '' }}
                                                class="w-8 h-8 flex items-center justify-center text-luxury-charcoal hover:text-luxury-gold text-sm font-light transition-colors duration-300 disabled:opacity-20 disabled:hover:text-luxury-charcoal cursor-pointer disabled:cursor-not-allowed">
                                                &plus;
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Accumulated Row Item Financial Calculations -->
                                    <div class="text-right flex flex-col items-end min-w-[100px]">
                                        <span class="block text-base font-serif font-medium text-luxury-black tracking-wide">
                                            ${{ number_format($product->price * $item->quantity, 2) }}
                                        </span>

                                        <!-- Absolute Removal Module Form Structure -->
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST"
                                            class="mt-2 block m-0 p-0">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-[10px] uppercase tracking-[0.2em] text-red-700/70 hover:text-red-900 bg-transparent border-0 cursor-pointer p-0 pb-0.5 relative after:absolute after:bottom-0 after:left-0 after:w-full after:h-[1px] after:bg-red-700/20 hover:after:bg-red-900 transition-colors duration-300">
                                                Remove Specimen
                                            </button>
                                        </form>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Strategic Summary Order Placement Summary Block -->
                <div class="lg:col-span-4 lg:sticky lg:top-32 w-full">
                    <div class="border border-luxury-champagne p-8 lg:p-10 bg-transparent relative">
                        <h3 class="text-xs uppercase tracking-[0.4em] text-luxury-gold font-semibold mb-8">// Allocation
                            Valuation</h3>

                        <div class="space-y-6 text-xs font-light tracking-wider text-luxury-charcoal">
                            <div class="flex justify-between pb-4 border-b border-luxury-champagne/60">
                                <span>Subtotal Items Valuation</span>
                                <span class="font-medium text-luxury-black">${{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div
                                class="flex justify-between pb-6 border-b border-luxury-champagne/60 text-[10px] uppercase tracking-widest text-luxury-charcoal/50">
                                <span>Logistics & Vault Delivery</span>
                                <span class="italic text-right text-luxury-gold/90 font-sans">Calculated at Allocation
                                    Phase</span>
                            </div>
                            <div class="pt-2 flex justify-between items-baseline text-luxury-black">
                                <span class="text-[10px] uppercase tracking-[0.3em] font-medium">Estimated Total Manifest</span>
                                <span class="text-2xl font-serif font-light text-luxury-gold tracking-tight">
                                    ${{ number_format($subtotal, 2) }}
                                </span>
                            </div>
                        </div>

                        <div class="mt-10">
                            <!-- Secure Transaction Route Pointer Endpoint -->
                            <a href="{{ route('checkout.index') }}"
                                class="w-full text-center group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-6 transition-colors duration-500 overflow-hidden block">
                                <span
                                    class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                                <span class="relative z-10">Proceed to Vault Checkout</span>
                            </a>
                        </div>
                    </div>

                    <div class="mt-6 text-center lg:text-left">
                        <a href="{{ route('products.index') }}"
                            class="inline-flex items-center text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/60 hover:text-luxury-gold transition-colors duration-300 group">
                            <svg class="w-3 h-3 mr-2 transform group-hover:-translate-x-1 transition-transform duration-300"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="square" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                            </svg>
                            Continue Curating Collection
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Completely Blank Void Bag Display State Frame -->
            <div class="w-full py-24 text-center max-w-xl mx-auto px-4">
                <div class="mb-8 opacity-25 flex justify-center">
                    <svg class="h-10 w-10 text-luxury-black stroke-[1]" fill="none" viewBox="0 0 24 24">
                        <path stroke-linecap="square" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                    </svg>
                </div>
                <h3 class="text-2xl font-serif font-light text-luxury-black tracking-tight mb-3">Your Curation Bag is Void</h3>
                <p class="text-xs font-light text-luxury-charcoal/60 leading-relaxed tracking-wider mb-10 max-w-sm mx-auto">
                    No artifacts or structural manifest pieces have been claimed for assignment yet. Discover the collections to
                    allocate selections.
                </p>
                <a href="{{ route('products.index') }}"
                    class="inline-block group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-10 transition-colors duration-500 overflow-hidden bg-transparent">
                    <span
                        class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                    <span class="relative z-10">Browse Curation Index</span>
                </a>
            </div>
        @endif
    </div>
@endsection