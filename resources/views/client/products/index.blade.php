@extends('layouts.client')

@section('content')
    <style>
        .luxury-input-glow:focus {
            border-bottom-color: #D4AF37;
            box-shadow: none;
        }

        /* Custom smooth transition overrides for image swapping */
        .fade-img {
            transition: opacity 0.4s ease-in-out, transform 3000ms cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>

    <div class="w-full max-w-[1700px] mx-auto min-h-screen bg-luxury-white pb-32">

        <header
            class="mb-24 flex flex-col lg:flex-row lg:items-end justify-between gap-12 border-b border-luxury-champagne pb-12">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.6em] text-luxury-gold mb-3 block font-semibold">// Our Shop</span>
                <h1 class="text-4xl lg:text-6xl font-serif font-light tracking-tight text-luxury-black">
                    Explore Our <br><span class="italic font-normal text-luxury-gold">Products.</span>
                </h1>
            </div>

            <div class="w-full lg:w-96 relative">
                <input type="text" placeholder="Search products..."
                    class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black placeholder-luxury-charcoal/40 focus:outline-none luxury-input-glow transition-colors duration-500">
                <span class="absolute right-0 bottom-2 text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/40">
                    Total Products // {{ method_exists($products, 'total') ? $products->total() : count($products) }}
                </span>
            </div>
        </header>

        <!-- Category Filtration Module Block -->
        <nav class="mb-20 overflow-x-auto whitespace-nowrap scrollbar-none pb-4 border-b border-luxury-champagne/40">
            <ul class="flex space-x-12 lg:space-x-16 text-[10px] uppercase tracking-[0.30em] font-medium">
                @foreach($categories as $cat)
                    <li>
                        <a href="#"
                            class="relative pb-2 transition-colors duration-300 {{ $loop->first ? 'text-luxury-black after:absolute after:bottom-0 after:left-0 after:w-full after:h-[1px] after:bg-luxury-gold' : 'text-luxury-charcoal/50 hover:text-luxury-black' }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <!-- Dynamic Architectural Asymmetric Grid Portfolio -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-x-12 gap-y-24 items-start">
            @foreach($products as $index => $product)
                @php
                    $columnClass = 'lg:col-span-4';
                    $imageRatio = 'aspect-[3/4]';
                    $offsetSpacing = '';

                    // Maintained asymmetric display matrix framework
                    if ($index % 3 == 0) {
                        $columnClass = 'lg:col-span-5';
                        $imageRatio = 'aspect-[4/5]';
                        $offsetSpacing = 'lg:mt-12';
                    } elseif ($index % 3 == 1) {
                        $columnClass = 'lg:col-span-7';
                        $imageRatio = 'aspect-[16/10]';
                        $offsetSpacing = 'lg:mt-0';
                    } else {
                        $columnClass = 'lg:col-span-4';
                        $imageRatio = 'aspect-[3/4]';
                        $offsetSpacing = 'lg:mt-24';
                    }

                    // 1. Grab the raw property values from database pipeline
                    $rawImages = $product->images;
                    $parsedImages = [];

                    // 2. Handle Case A: It's an Eloquent Relationship Collection instance object
                    if ($rawImages instanceof \Illuminate\Support\Collection || $rawImages instanceof \Illuminate\Database\Eloquent\Collection) {
                        $firstItem = $rawImages->first();
                        if (is_object($firstItem)) {
                            // Automatically search common schema column names for relational setups
                            $key = isset($firstItem->url) ? 'url' : (isset($firstItem->path) ? 'path' : 'image');
                            $parsedImages = $rawImages->pluck($key)->toArray();
                        } else {
                            $parsedImages = $rawImages->toArray();
                        }
                    }
                    // 3. Handle Case B: It's a standard uncast JSON string or single path URL string
                    elseif (is_string($rawImages)) {
                        $decoded = json_decode($rawImages, true);
                        $parsedImages = is_array($decoded) ? $decoded : (empty(trim($rawImages)) ? [] : [$rawImages]);
                    }
                    // 4. Handle Case C: It's already successfully casted to a native PHP array
                    elseif (is_array($rawImages)) {
                        $parsedImages = $rawImages;
                    }

                    // 5. Run standard array cleaning filters
                    $parsedImages = array_values(array_filter($parsedImages));

                    // 6. Automatically convert local storage relative paths into valid target domain URLs
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

                    // 7. Safety Validation: Fall back to Unsplash visual assets only if arrays are fully empty
                    if (empty($mediaLedger)) {
                        $mediaLedger = ['https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80'];
                    }
                @endphp

                <!-- Double quotes are safe inside the single quote wrapper strategy -->
                <div class="{{ $columnClass }} {{ $offsetSpacing }} flex flex-col group relative"
                    x-data='{ activeIndex: 0, images: @json($mediaLedger) }' @mouseleave="activeIndex = 0">

                    <div class="w-full {{ $imageRatio }} bg-luxury-champagne overflow-hidden relative mb-6">
                        <div class="absolute inset-0 bg-luxury-black/5 mix-blend-multiply z-10 pointer-events-none"></div>

                        <!-- Routing system automatically processes object parameters to fetch model slugs -->
                        <a href="{{ route('products.show', $product) }}" class="block w-full h-full">
                            <!-- Statically defaults to the first parsed image string ($mediaLedger[0]), bound dynamically by Alpine -->
                            <img :src="images[activeIndex]" src="{{ $mediaLedger[0] }}" alt="{{ $product->name }}"
                                class="w-full h-full object-cover fade-img transform scale-100 group-hover:scale-103 grayscale hover:grayscale-0"
                                loading="lazy">
                        </a>

                        <!-- Micro-Interaction: Segmented Luxury Pagination Bars appearing gracefully on Card Hover -->
                        <div
                            class="absolute bottom-4 left-0 right-0 z-20 flex justify-center space-x-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 px-6">
                            <template x-for="(img, idx) in images" :key="idx">
                                <span @mouseenter="activeIndex = idx" class="h-[1px] cursor-pointer transition-all duration-300"
                                    :class="activeIndex === idx ? 'w-8 bg-white' : 'w-3 bg-white/40'">
                                </span>
                            </template>
                        </div>

                        <!-- Category Metadata Overlay Tag -->
                        <div
                            class="absolute top-4 left-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <span
                                class="text-[9px] uppercase tracking-[0.2em] bg-luxury-white/90 backdrop-blur-sm text-luxury-black px-3 py-1 border border-luxury-champagne">
                                {{ $product->category->name ?? 'Collection' }}
                            </span>
                        </div>
                    </div>

                    <!-- Meta Profile Information Block Section -->
                    <div class="w-full flex flex-col px-1">
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <h3
                                class="font-serif text-xl lg:text-2xl font-light text-luxury-black tracking-wide leading-tight group-hover:text-luxury-gold transition-colors duration-300">
                                <a href="{{ route('products.show', $product) }}">
                                    {{ $product->name }}
                                </a>
                            </h3>
                            <span class="text-xs tracking-[0.15em] font-medium text-luxury-charcoal/90 mt-1">
                                ${{ number_format($product->price, 2) }}
                            </span>
                        </div>

                        <p class="text-xs font-light text-luxury-charcoal/60 leading-relaxed max-w-sm mb-6 line-clamp-2">
                            {{ $product->description }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('products.show', $product) }}"
                                class="inline-flex items-center text-[10px] uppercase tracking-[0.3em] font-semibold text-luxury-black group/link relative pb-1">
                                <span>View Details</span>
                                <span
                                    class="absolute bottom-0 left-0 w-full h-[1px] bg-luxury-black transform scale-x-100 origin-right transition-transform duration-500 group-hover/link:scale-x-0"></span>
                                <span
                                    class="absolute bottom-0 left-0 w-full h-[1px] bg-luxury-gold transform scale-x-0 origin-left transition-transform duration-500 group-hover/link:scale-x-100"></span>
                            </a>
                        </div>
                    </div>

                </div>
            @endforeach
        </div>

        <!-- Pagination Navigation Link Container Component Integration -->
        @if(method_exists($products, 'links'))
            <div class="mt-28 pt-12 border-t border-luxury-champagne/40 flex justify-center">
                {{ $products->links() }}
            </div>
        @endif

    </div>
@endsection