@php
    // Quick frontend mockup data layer for the catalog layout
    $categories = [
        ['id' => 1, 'name' => 'All Products', 'slug' => 'all'],
        ['id' => 2, 'name' => 'Necklaces & Pendants', 'slug' => 'necklaces'],
        ['id' => 3, 'name' => 'Rings & Bracelets', 'slug' => 'rings'],
        ['id' => 4, 'name' => 'Dresses & Tops', 'slug' => 'apparel']
    ];

    $products = [
        [
            'id' => 1,
            'category' => 'Jewelry',
            'name' => 'Classic Gold Chain',
            'description' => '18k solid gold minimalist chain necklace perfect for elegant layering.',
            'price' => '249.00',
            'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80'
        ],
        [
            'id' => 2,
            'category' => 'Jewelry',
            'name' => 'Diamond Stud Earrings',
            'description' => 'Stunning 0.5 carat total weight round diamond studs set in white gold.',
            'price' => '499.00',
            'image' => 'https://images.unsplash.com/photo-1635767798638-3e25273a8236?auto=format&fit=crop&w=800&q=80'
        ],
        [
            'id' => 3,
            'category' => 'Clothing',
            'name' => 'Silk Evening Dress',
            'description' => 'Flowing emerald green pure silk dress tailored for special occasions.',
            'price' => '189.00',
            'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=800&q=80'
        ],
        [
            'id' => 4,
            'category' => 'Jewelry',
            'name' => 'Minimalist Silver Ring',
            'description' => 'Sterling silver textured band ring perfect for daily contemporary wear.',
            'price' => '85.00',
            'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=800&q=80'
        ],
        [
            'id' => 5,
            'category' => 'Clothing',
            'name' => 'Premium Trench Coat',
            'description' => 'Classic water-resistant double-breasted outerwear with fine detailing.',
            'price' => '299.00',
            'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=800&q=80'
        ],
        [
            'id' => 6,
            'category' => 'Clothing',
            'name' => 'Linen Button-Up Shirt',
            'description' => 'Breathable, relaxed-fit linen blend top perfect for casual afternoons.',
            'price' => '65.00',
            'image' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=800&q=80'
        ]
    ];
@endphp

@extends('layouts.client')

@section('content')
    <style>
        .luxury-input-glow:focus {
            border-bottom-color: #D4AF37;
            box-shadow: none;
        }
    </style>

    <div class="w-full max-w-[1700px] mx-auto min-h-screen bg-luxury-white pb-32">

        <header
            class="mb-24 flex flex-col lg:flex-row lg:items-end justify-between gap-12 border-b border-luxury-champagne pb-12">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.6em] text-luxury-gold mb-3 block font-semibold">// Our
                    Shop</span>
                <h1 class="text-4xl lg:text-6xl font-serif font-light tracking-tight text-luxury-black">
                    Explore Our <br><span class="italic font-normal text-luxury-gold">Products.</span>
                </h1>
            </div>

            <div class="w-full lg:w-96 relative">
                <input type="text" placeholder="Search products..."
                    class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black placeholder-luxury-charcoal/40 focus:outline-none luxury-input-glow transition-colors duration-500">
                <span class="absolute right-0 bottom-2 text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/40">
                    Total Products // {{ count($products) }}
                </span>
            </div>
        </header>

        <nav class="mb-20 overflow-x-auto whitespace-nowrap scrollbar-none pb-4 border-b border-luxury-champagne/40">
            <ul class="flex space-x-12 lg:space-x-16 text-[10px] uppercase tracking-[0.30em] font-medium">
                @foreach($categories as $cat)
                    <li>
                        <a href="#"
                            class="relative pb-2 transition-colors duration-300 {{ $loop->first ? 'text-luxury-black after:absolute after:bottom-0 after:left-0 after:w-full after:h-[1px] after:bg-luxury-gold' : 'text-luxury-charcoal/50 hover:text-luxury-black' }}">
                            {{ $cat['name'] }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </nav>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-x-12 gap-y-24 items-start">
            @foreach($products as $index => $product)
                @php
                    /**
                     * Dynamically assign layouts based on loop iteration 
                     * to create an asymmetrical grid variation.
                     */
                    $columnClass = 'lg:col-span-4';
                    $imageRatio = 'aspect-[3/4]';
                    $offsetSpacing = '';

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
                @endphp

                <div class="{{ $columnClass }} {{ $offsetSpacing }} flex flex-col group relative">

                    <div class="w-full {{ $imageRatio }} bg-luxury-champagne overflow-hidden relative mb-6">
                        <div class="absolute inset-0 bg-luxury-black/5 mix-blend-multiply z-10 pointer-events-none"></div>

                        <a href="{{ route('products.show', $product['id']) }}" class="block w-full h-full">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                class="w-full h-full object-cover transition-all duration-[3000ms] cubic-bezier(0.16, 1, 0.3, 1) transform scale-100 group-hover:scale-103 grayscale hover:grayscale-0"
                                loading="lazy">
                        </a>

                        <div
                            class="absolute top-4 left-4 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                            <span
                                class="text-[9px] uppercase tracking-[0.2em] bg-luxury-white/90 backdrop-blur-sm text-luxury-black px-3 py-1 border border-luxury-champagne">
                                {{ $product['category'] }}
                            </span>
                        </div>
                    </div>

                    <div class="w-full flex flex-col px-1">
                        <div class="flex items-start justify-between gap-4 mb-2">
                            <h3
                                class="font-serif text-xl lg:text-2xl font-light text-luxury-black tracking-wide leading-tight group-hover:text-luxury-gold transition-colors duration-300">
                                <a href="{{ route('products.show', $product['id']) }}">
                                    {{ $product['name'] }}
                                </a>
                            </h3>
                            <span class="text-xs tracking-[0.15em] font-medium text-luxury-charcoal/90 mt-1">
                                ${{ $product['price'] }}
                            </span>
                        </div>

                        <p class="text-xs font-light text-luxury-charcoal/60 leading-relaxed max-w-sm mb-6 line-clamp-2">
                            {{ $product['description'] }}
                        </p>

                        <div class="mt-auto">
                            <a href="{{ route('products.show', $product['id']) }}"
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

    </div>
@endsection