@extends('layouts.client')

@section('content')
    <style>
        .text-mask-reveal {
            clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #0D0D0D 0%, #A67C1E 50%, #0D0D0D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <section class="relative min-h-[85vh] w-full flex items-center bg-luxury-white overflow-hidden pb-24 pt-12">
        <div class="w-full max-w-[1700px] mx-auto grid grid-cols-1 lg:grid-cols-12 gap-12 items-center relative z-10">

            <div class="lg:col-span-5 order-2 lg:order-1 flex flex-col justify-center px-4 lg:px-0 text-mask-reveal">
                <span
                    class="text-[10px] uppercase tracking-[0.6em] text-luxury-gold mb-6 font-semibold block animate-pulse">
                    The Inaugural Vernissage
                </span>
                <h1
                    class="text-5xl sm:text-6xl xl:text-7xl font-serif font-light text-luxury-black leading-[1.05] tracking-tight mb-8">
                    Form Worn <br>
                    <span class="italic font-normal gold-gradient-text">As Emotion.</span>
                </h1>
                <p class="text-sm font-light text-luxury-charcoal/80 leading-relaxed max-w-md mb-12 tracking-wide">
                    Deliberately raw, architectural weights crafted by hand. A deep structural collision between fine rare
                    mineral geology and fluid unstructured silks.
                </p>
                <div>
                    <a href="{{ route('products.index') }}"
                        class="inline-flex items-center group relative text-xs uppercase tracking-[0.4em] font-medium py-3 pr-12 text-luxury-black transition-all duration-500">
                        <span class="relative z-10">Enter the Atelier</span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[1px] bg-luxury-black/20 origin-right transition-transform duration-500 scale-x-100 group-hover:scale-x-0"></span>
                        <span
                            class="absolute bottom-0 left-0 w-full h-[1px] bg-luxury-gold origin-left transition-transform duration-500 scale-x-0 group-hover:scale-x-100"></span>
                        <svg class="w-4 h-4 ml-2 transform transition-transform duration-500 group-hover:translate-x-3 absolute right-0 text-luxury-gold"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="square" stroke-width="1.2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>
            </div>

            <div
                class="lg:col-span-7 order-1 lg:order-2 relative w-full h-[60vh] lg:h-[75vh] bg-luxury-champagne overflow-hidden">
                <div class="absolute inset-0 bg-luxury-black/5 mix-blend-multiply z-10 pointer-events-none"></div>
                <img src="https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&w=1400&q=90"
                    alt="Jesca Fine Jewelry Masterpiece"
                    class="w-full h-full object-cover object-center scale-100 hover:scale-105 transition-transform duration-[4000ms] ease-out select-none" />

                <div
                    class="absolute bottom-8 right-8 z-20 hidden sm:block bg-luxury-white/40 backdrop-blur-md px-6 py-3 border border-luxury-white/20">
                    <span class="text-[9px] uppercase tracking-[0.3em] text-luxury-black font-light block">Collection
                        Element // No. 09</span>
                </div>
            </div>
        </div>
    </section>

    <section class="py-32 bg-luxury-champagne/30 border-t border-b border-luxury-champagne w-full">
        <div class="max-w-[1700px] mx-auto">

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-24 px-4 lg:px-0">
                <div class="max-w-xl">
                    <span class="text-[10px] uppercase tracking-[0.5em] text-luxury-gold mb-3 block font-medium">//
                        Archetypes</span>
                    <h2 class="text-4xl lg:text-5xl font-serif font-light tracking-tight text-luxury-black">Selected
                        Manifestos</h2>
                </div>
                <p class="text-[10px] uppercase tracking-[0.2em] text-luxury-charcoal/50 mt-4 lg:mt-0 tracking-[0.4em]">
                    [ Segmented Frameworks ]
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-24 items-start px-4 lg:px-0">

                <div class="lg:col-span-6 flex flex-col group">
                    <div class="w-full aspect-[4/5] bg-luxury-white overflow-hidden relative mb-8">
                        <div
                            class="absolute inset-0 bg-luxury-black/0 group-hover:bg-luxury-black/10 transition-colors duration-700 z-10 pointer-events-none">
                        </div>
                        <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=900&q=90"
                            alt="Fine Jewelry Collection"
                            class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-[2000ms] ease-in-out transform group-hover:scale-102" />
                    </div>

                    <div class="flex items-baseline justify-between border-b border-luxury-black/10 pb-4">
                        <h3 class="font-serif text-3xl font-light text-luxury-black">Fine Jewelry</h3>
                        <a href="{{ route('products.index', ['category' => 'jewelry']) }}"
                            class="text-[10px] uppercase tracking-[0.3em] text-luxury-gold hover:text-luxury-black transition-colors duration-300">
                            View Matrix &rarr;
                        </a>
                    </div>
                    <p class="text-xs font-light text-luxury-charcoal/70 mt-4 max-w-sm leading-relaxed">
                        Heavy solid structures, statement configurations, and ethically isolated crystalline cut inclusions.
                    </p>
                </div>

                <div class="lg:col-span-6 flex flex-col group lg:mt-24">
                    <div class="w-full aspect-[4/5] bg-luxury-white overflow-hidden relative mb-8">
                        <div
                            class="absolute inset-0 bg-luxury-black/0 group-hover:bg-luxury-black/10 transition-colors duration-700 z-10 pointer-events-none">
                        </div>
                        <img src="https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=900&q=90"
                            alt="Modern Apparel Collection"
                            class="w-full h-full object-cover transform scale-100 group-hover:scale-103 transition-transform duration-[2500ms] ease-out" />
                    </div>

                    <div class="flex items-baseline justify-between border-b border-luxury-black/10 pb-4">
                        <h3 class="font-serif text-3xl font-light text-luxury-black">Modern Apparel</h3>
                        <a href="{{ route('products.index', ['category' => 'clothing']) }}"
                            class="text-[10px] uppercase tracking-[0.3em] text-luxury-gold hover:text-luxury-black transition-colors duration-300">
                            View Concept &rarr;
                        </a>
                    </div>
                    <p class="text-xs font-light text-luxury-charcoal/70 mt-4 max-w-sm leading-relaxed">
                        Flowing architectural protective layers crafted out of high-density custom spun raw textiles.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <section class="py-40 bg-luxury-black text-luxury-white relative overflow-hidden w-full">


        <div class="max-w-4xl mx-auto text-center px-4 relative z-10">
            <span class="text-[9px] uppercase tracking-[0.7em] text-luxury-gold mb-8 block font-semibold">The
                Philosophy</span>
            <blockquote
                class="font-serif font-light text-2xl sm:text-4xl lg:text-5xl italic leading-snug text-luxury-champagne tracking-wide">
                "True status does not scream inside crowded galleries. It thrives inside the quiet weight of pure design
                choice."
            </blockquote>
            <div class="w-12 h-[1px] bg-luxury-gold/40 mx-auto mt-12"></div>
        </div>
    </section>
@endsection