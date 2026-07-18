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
    </style>

    <div class="w-full max-w-[1700px] mx-auto bg-luxury-white pb-32 pt-6">

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 lg:gap-20 items-start">

            <div class="lg:col-span-7 relative w-full flex flex-col gap-8">
                <div class="w-full aspect-[4/5] bg-luxury-champagne overflow-hidden relative group">
                    <div class="absolute inset-0 bg-luxury-black/5 mix-blend-multiply z-10 pointer-events-none"></div>
                    <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=1200&q=90"
                        alt="Classic Gold Chain"
                        class="w-full h-full object-cover object-center scale-100 hover:scale-103 transition-transform duration-[4000ms] cubic-bezier(0.16, 1, 0.3, 1) select-none">

                    <div
                        class="absolute top-6 left-6 z-20 bg-luxury-white/80 backdrop-blur-sm px-4 py-2 border border-luxury-champagne">
                        <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-black font-medium">Product Gallery //
                            Image 01</span>
                    </div>
                </div>

                <div class="grid grid-cols-12 gap-6 relative z-20 lg:-mt-24">
                    <div
                        class="col-start-4 col-span-9 lg:col-start-5 lg:col-span-7 bg-luxury-white p-4 border border-luxury-champagne/60 shadow-sm">
                        <div class="w-full aspect-[16/10] bg-luxury-champagne overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=800&q=80"
                                alt="Material Close Up"
                                class="w-full h-full object-cover transform hover:scale-105 transition-transform duration-1000 grayscale hover:grayscale-0">
                        </div>
                        <span class="text-[9px] uppercase tracking-[0.2em] text-luxury-charcoal/50 mt-3 block text-right">[
                            Detail View — Fine Texture and Finish ]</span>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-5 flex flex-col px-4 lg:px-0 lg:sticky lg:top-32">

                <div class="border-b border-luxury-champagne pb-6 mb-8">
                    <span class="text-[10px] uppercase tracking-[0.5em] text-luxury-gold font-semibold block mb-3">//
                        Product Overview</span>
                    <div class="flex items-center justify-between">
                        <span class="text-xs uppercase tracking-[0.2em] text-luxury-charcoal/60">Category: Jewelry</span>
                        <span
                            class="text-[10px] uppercase tracking-[0.15em] font-medium text-green-700 bg-green-50 px-3 py-1 border border-green-200/50">
                            In Stock (12 units left)
                        </span>
                    </div>
                </div>

                <h1 class="text-4xl lg:text-5xl font-serif font-light tracking-tight text-luxury-black mb-4 leading-tight">
                    Classic Gold Chain<br>
                    <span class="italic font-normal gold-shimmer-text text-3xl lg:text-4xl">Pure Elegance.</span>
                </h1>

                <p class="text-2xl font-light text-luxury-black tracking-wide mb-8">
                    $249.00 <span
                        class="text-xs text-luxury-charcoal/40 uppercase tracking-[0.1em] font-sans ml-2">USD</span>
                </p>

                <div class="mb-12">
                    <h3 class="text-[10px] uppercase tracking-[0.4em] text-luxury-gold font-semibold mb-4">[ Description ]
                    </h3>
                    <p class="text-sm font-light text-luxury-charcoal/80 leading-relaxed tracking-wide mb-6">
                        This beautifully crafted 18k solid gold minimalist chain necklace establishes the perfect balance
                        between lightweight comfort and clean structural execution. Designed specifically to complement the
                        silhouette of the neckline, it pairs flawlessly with fluid fabrics or formal attire.
                    </p>
                </div>

                <div class="border-t border-b border-luxury-champagne py-6 mb-12">
                    <ul class="space-y-3 text-xs font-light text-luxury-charcoal/70 tracking-wider">
                        <li class="flex justify-between"><span>Composition</span> <span
                                class="text-luxury-black font-medium">18K Certified Solid Gold</span></li>
                        <li class="flex justify-between"><span>Origin</span> <span
                                class="text-luxury-black font-medium">Handcrafted in Milan</span></li>
                        <li class="flex justify-between"><span>Style</span> <span
                                class="text-luxury-black font-medium">Minimalist / Layering Piece</span></li>
                    </ul>
                </div>

                <form action="#" method="POST" class="w-full">
                    @csrf
                    <div class="flex flex-col sm:flex-row items-stretch gap-6">

                        <div class="w-full sm:w-28 relative">
                            <label
                                class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/40">Quantity</label>
                            <select
                                class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black focus:outline-none luxury-select transition-colors duration-500 py-2 cursor-pointer">
                                <option value="1">01</option>
                                <option value="2">02</option>
                                <option value="3">03</option>
                            </select>
                        </div>

                        <button type="button"
                            class="flex-grow group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-8 transition-colors duration-500 overflow-hidden">
                            <span
                                class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                            <span class="relative z-10">Add to Cart</span>
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