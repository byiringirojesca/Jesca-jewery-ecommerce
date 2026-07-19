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

        .luxury-select:focus {
            border-bottom-color: #D4AF37;
        }

        .scrollbar-none::-webkit-scrollbar {
            display: none;
        }

        .scrollbar-none {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>

    @php
        // 1. Safely pull images property supporting both Eloquent object access and array accessibility structures
        $rawImages = is_array($product) ? ($product['images'] ?? null) : ($product->images ?? null);
        $parsedImages = [];

        // 2. Handle Case A: It's an Eloquent Relationship Collection instance object
        if ($rawImages instanceof \Illuminate\Support\Collection || $rawImages instanceof \Illuminate\Database\Eloquent\Collection) {
            $firstItem = $rawImages->first();
            if (is_object($firstItem)) {
                $key = isset($firstItem->url) ? 'url' : (isset($firstItem->path) ? 'path' : 'image');
                $parsedImages = $rawImages->pluck($key)->toArray();
            } else {
                $parsedImages = $rawImages->toArray();
            }
        }
        // 3. Handle Case B: It's an uncast JSON string or single path URL string from DB
        elseif (is_string($rawImages)) {
            $decoded = json_decode($rawImages, true);
            $parsedImages = is_array($decoded) ? $decoded : (empty(trim($rawImages)) ? [] : [$rawImages]);
        }
        // 4. Handle Case C: It's already successfully cast to a native PHP array
        elseif (is_array($rawImages)) {
            $parsedImages = $rawImages;
        }

        // 5. Clean array values
        $parsedImages = array_values(array_filter($parsedImages));

        // 6. Convert relative asset storage paths into valid public domain target URLs
        $mediaLedger = [];
        foreach ($parsedImages as $img) {
            if (is_string($img)) {
                if (\Illuminate\Support\Str::startsWith($img, ['http://', 'https://', 'data:'])) {
                    $mediaLedger[] = $img;
                } else {
                    $mediaLedger[] = asset('storage/' . ltrim($img, '/'));
                }
            }
        }

        // 7. Safety Validation: Apply the visual placeholder matrix if database items are empty
        if (empty($mediaLedger)) {
            $mediaLedger = ['https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80'];
        }

        // 8. Normalize safe parameters for Stock metrics and Categories to prevent object-to-string compilation failures
        $stockCount = is_array($product) ? ($product['stock'] ?? 0) : ($product->stock ?? 0);

        $categoryName = 'Collection';
        if (is_array($product) && isset($product['category'])) {
            $categoryName = is_array($product['category']) ? ($product['category']['name'] ?? 'Collection') : (is_object($product['category']) ? ($product['category']->name ?? 'Collection') : $product['category']);
        } elseif (is_object($product) && isset($product->category)) {
            $categoryName = $product->category->name ?? 'Collection';
        }
    @endphp

    <!-- Unified Interactive Product Context - Double quotes are protected inside the outer single quote framework -->
    <div x-data='{ 
                        images: @json($mediaLedger), 
                        activeImageIndex: 0,
                        quantity: 1,
                        maxStock: {{ $stockCount }}
                     }' class="w-full max-w-[1700px] mx-auto bg-luxury-white pb-32 pt-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">

            <!-- Interactive Media Showcase Column -->
            <div class="lg:col-span-7 relative w-full flex flex-col gap-6">

                <!-- Main Focus Hero Viewer Frame -->
                <div class="w-full aspect-[4/5] bg-luxury-champagne overflow-hidden relative group">
                    <div class="absolute inset-0 bg-luxury-black/5 mix-blend-multiply z-10 pointer-events-none"></div>

                    <!-- Dynamic Binding with Crossfade Style Transitions -->
                    <img :src="images[activeImageIndex]" src="{{ $mediaLedger[0] }}"
                        alt="{{ is_array($product) ? $product['name'] : $product->name }}"
                        class="w-full h-full object-cover object-center scale-100 hover:scale-103 transition-all duration-700 cubic-bezier(0.16, 1, 0.3, 1) select-none">

                    <div
                        class="absolute top-6 left-6 z-20 bg-luxury-white/80 backdrop-blur-sm px-4 py-2 border border-luxury-champagne">
                        <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-black font-medium">
                            Product Gallery // Asset 0<span x-text="activeImageIndex + 1"></span>
                        </span>
                    </div>
                </div>

                <!-- Minimalist Thumbnail Inline Carousel Slider -->
                <div class="w-full overflow-x-auto whitespace-nowrap scrollbar-none flex space-x-4 pb-2">
                    <template x-for="(image, idx) in images" :key="idx">
                        <button @click="activeImageIndex = idx" @mouseenter="activeImageIndex = idx"
                            class="w-24 aspect-[4/5] p-0 border bg-luxury-champagne overflow-hidden flex-shrink-0 cursor-pointer transition-all duration-300 focus:outline-none"
                            :class="activeImageIndex === idx ? 'border-luxury-gold ring-1 ring-luxury-gold/30' : 'border-luxury-champagne/60 opacity-60 hover:opacity-100'">
                            <img :src="image" class="w-full h-full object-cover pointer-events-none">
                        </button>
                    </template>
                </div>
            </div>

            <!-- Content Details Specification Summary Column -->
            <div class="lg:col-span-5 flex flex-col px-4 lg:px-0 lg:sticky lg:top-32">

                <div class="border-b border-luxury-champagne pb-6 mb-8">
                    <span class="text-[10px] uppercase tracking-[0.5em] text-luxury-gold font-semibold block mb-3">//
                        Product Overview</span>
                    <div class="flex items-center justify-between">
                        <span class="text-xs uppercase tracking-[0.2em] text-luxury-charcoal/60">Category:
                            {{ $categoryName }}</span>

                        <!-- Status Badge dynamically calculated via Stock count metrics -->
                        <span
                            class="text-[10px] uppercase tracking-[0.15em] font-medium px-3 py-1 border transition-colors duration-300"
                            :class="maxStock > 0 ? 'text-green-700 bg-green-50 border-green-200/50' : 'text-red-700 bg-red-50 border-red-200/50'">
                            <span
                                x-text="maxStock > 0 ? 'In Stock (' + maxStock + ' units left)' : 'Allocated / Out of Stock'"></span>
                        </span>
                    </div>
                </div>

                <h1 class="text-4xl lg:text-5xl font-serif font-light tracking-tight text-luxury-black mb-4 leading-tight">
                    {{ is_array($product) ? $product['name'] : $product->name }}<br>
                    <span class="italic font-normal gold-shimmer-text text-3xl lg:text-4xl">Pure Elegance.</span>
                </h1>

                <p class="text-2xl font-light text-luxury-black tracking-wide mb-8">
                    ${{ number_format(is_array($product) ? $product['price'] : $product->price, 2) }} <span
                        class="text-xs text-luxury-charcoal/40 uppercase tracking-[0.1em] font-sans ml-2">USD</span>
                </p>

                <div class="mb-12">
                    <h3 class="text-[10px] uppercase tracking-[0.4em] text-luxury-gold font-semibold mb-4">[ Description ]
                    </h3>
                    <p class="text-sm font-light text-luxury-charcoal/80 leading-relaxed tracking-wide mb-6">
                        {{ is_array($product) ? $product['description'] : $product->description }}
                    </p>
                </div>

                <div class="border-t border-b border-luxury-champagne py-6 mb-12">
                    <ul class="space-y-3 text-xs font-light text-luxury-charcoal/70 tracking-wider">
                        <li class="flex justify-between"><span>Composition</span> <span
                                class="text-luxury-black font-medium">{{ is_array($product) ? ($product['composition'] ?? 'N/A') : ($product->composition ?? 'N/A') }}</span>
                        </li>
                        <li class="flex justify-between"><span>Origin</span> <span
                                class="text-luxury-black font-medium">{{ is_array($product) ? ($product['origin'] ?? 'N/A') : ($product->origin ?? 'N/A') }}</span>
                        </li>
                        <li class="flex justify-between"><span>Style</span> <span
                                class="text-luxury-black font-medium">{{ is_array($product) ? ($product['style'] ?? 'N/A') : ($product->style ?? 'N/A') }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Transaction Submission Interface -->
                <form action="{{ route('cart.add') }}" method="POST" class="w-full">
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @csrf
                    <div class="flex flex-col sm:flex-row items-stretch gap-6">

                        <div class="w-full sm:w-28 relative">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/40">Quantity</label>

                            <!-- Controlled Selector State Binding -->
                            <select x-model="quantity" name="quantity"
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black focus:outline-none luxury-select transition-colors duration-500 py-2 cursor-pointer">
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                                <option value="4">04</option>
                                <option value="5">05</option>
                            </select>
                        </div>

                        <!-- FIXED: Changed type="button" to type="submit" so the form can execute -->
                        <button type="submit" :disabled="maxStock === 0"
                            class="flex-grow group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-8 transition-colors duration-500 overflow-hidden disabled:opacity-40 disabled:cursor-not-allowed">
                            <span
                                class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                            <span class="relative z-10" x-text="maxStock > 0 ? 'Add to Cart' : 'Vault Locked'"></span>
                        </button>

                    </div>
                </form>

                <div class="mt-8 text-center sm:text-left">
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center text-[10px] uppercase tracking-[0.3em] text-luxury-charcoal/60 hover:text-luxury-gold transition-colors group">
                        <svg class="w-3 h-3 mr-2 transform group-hover:-translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="square" stroke-width="1.5" d="M15 19l-7-7 7-7" />
                        </svg>
                        Back to All Products
                    </a>
                </div>

            </div>
        </div>

    </div>
@endsection