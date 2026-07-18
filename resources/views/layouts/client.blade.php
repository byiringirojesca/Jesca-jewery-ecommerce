<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>JESCA ATELIER — Jewelry & Haute Couture</title>
    
    <!-- Premium Typography Registry -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,300&family=Satoshi:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Laravel Vite Asset Pipeline Compiler -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        /* Base system overrides maintaining structural theme compliance */
        body {
            background-color: #FAF8F5; /* luxury-white fallback */
            color: #0D0D0D;            /* luxury-black fallback */
            overflow-x: hidden;
        }
        
        /* Custom dynamic scrollbar for luxury UI */
        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #FAF8F5; }
        ::-webkit-scrollbar-thumb { background: #D4AF37; }
        
        /* Shimmer Mask effect for landing titles */
        .gold-shimmer {
            background: linear-gradient(90deg, #0d0d0d 0%, #a67c1e 50%, #0d0d0d 100%);
            background-size: 200% auto;
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: shimmer 4s linear infinite;
        }

        @keyframes shimmer {
            0% { backgroundPosition: -200% 0; }
            100% { backgroundPosition: '200% 0'; }
        }
    </style>
</head>

<body class="font-sans antialiased min-h-screen flex flex-col selection:bg-[#D4AF37] selection:text-[#0D0D0D]">

    <!-- Sticky Header Module with Alpine Scroll & Mobile State Management -->
    <header 
        x-data="{ scrolled: false, mobileMenuOpen: false }"
        @scroll.window="scrolled = window.scrollY > 30"
        :class="scrolled ? 'bg-[#FAF8F5]/95 backdrop-blur-md border-[#F3EFE9] py-4 shadow-[0_4px_30px_rgba(0,0,0,0.02)]' : 'bg-transparent border-transparent py-6'"
        class="fixed top-0 left-0 w-full z-50 border-b transition-all duration-500 group">
        
        <div class="max-w-[1800px] mx-auto px-6 lg:px-16">
            <div class="flex justify-between items-center relative h-12">

                <!-- Desktop Left Navigation Layout -->
                <nav class="hidden md:flex space-x-12 text-xs uppercase tracking-[0.3em] font-medium">
                    <a href="{{ route('home') }}" class="text-[#0D0D0D] hover:text-[#D4AF37] transition-colors relative after:absolute after:bottom-[-4px] after:left-0 after:w-full after:h-[1px] after:bg-[#D4AF37] after:transform after:scale-x-100 after:transition-transform">Collection</a>
                    <a href="{{ route('products.index') }}" class="text-[#0D0D0D]/60 hover:text-[#D4AF37] transition-colors relative after:absolute after:bottom-[-4px] after:left-0 after:w-full after:h-[1px] after:bg-[#D4AF37] after:transform after:scale-x-0 hover:after:scale-x-100 after:transition-transform">Atelier</a>
                </nav>

                <!-- Mobile Navigation Trigger Burger Menu Button -->
                <button 
                    @click="mobileMenuOpen = !mobileMenuOpen"
                    class="md:hidden flex flex-col justify-center items-start gap-1.5 w-6 h-6 text-[#0D0D0D] focus:outline-none"
                    aria-label="Toggle Navigation Menu">
                    <span :class="mobileMenuOpen ? 'transform rotate-45 translate-y-2' : ''" class="w-6 h-px bg-current transition-all duration-300"></span>
                    <span :class="mobileMenuOpen ? 'opacity-0' : ''" class="w-4 h-px bg-current transition-all duration-300"></span>
                    <span :class="mobileMenuOpen ? 'transform -rotate-45 -translate-y-1.5 w-6' : ''" class="w-5 h-px bg-current transition-all duration-300"></span>
                </button>

                <!-- Core Branding Axis Centerpoint -->
                <div class="absolute left-1/2 transform -translate-x-1/2 text-center">
                    <a href="{{ route('home') }}" class="text-2xl lg:text-3xl font-serif tracking-[0.25em] font-light text-[#0D0D0D] block">
                        JESCA
                    </a>
                    <span class="text-[9px] uppercase tracking-[0.5em] text-[#D4AF37] block mt-1">Maison De Luxe</span>
                </div>

                <!-- Right Utility Navigation Links Layout -->
                <div class="flex items-center space-x-4 sm:space-x-8 text-xs uppercase tracking-[0.2em]">
                    @auth
                        <div class="hidden lg:flex items-center space-x-4">
                            <span class="text-[#0D0D0D]/60">Mbr // {{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-red-800 hover:text-[#0D0D0D] transition-colors">Exit</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden lg:inline-block text-[#0D0D0D]/60 hover:text-[#D4AF37] transition-colors">Sign In</a>
                    @endauth

                    <!-- Interactive Bag Hook -->
                    <a href="{{ route('cart.index') }}" class="relative group/cart flex items-center p-2">
                        <span class="text-[#0D0D0D] group-hover/cart:text-[#D4AF37] transition-colors mr-2 hidden sm:inline">Bag</span>
                        <svg class="h-4 w-4 text-[#0D0D0D] group-hover/cart:text-[#D4AF37] transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="square" stroke-linejoin="miter" stroke-width="1.5" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span class="absolute top-0 right-0 flex h-4 w-4 items-center justify-center rounded-full bg-[#0D0D0D] text-[9px] font-bold text-[#FAF8F5]">
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>
                </div>

            </div>
        </div>

        <!-- Sliding Mobile Navigation Overlay Drawer Container -->
        <div 
            x-show="mobileMenuOpen"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4"
            x-transition:enter-end="opacity-100 translateY-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translateY-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="md:hidden absolute top-full left-0 w-full bg-[#FAF8F5] border-b border-[#F3EFE9] px-6 py-8 space-y-6 shadow-xl"
            style="display: none;">
            
            <div class="flex flex-col space-y-4 text-xs uppercase tracking-[0.25em] font-medium">
                <a href="{{ route('home') }}" class="text-[#0D0D0D] hover:text-[#D4AF37] py-2 border-b border-neutral-100">Collection Archive</a>
                <a href="{{ route('products.index') }}" class="text-[#0D0D0D]/70 hover:text-[#D4AF37] py-2 border-b border-neutral-100">The Atelier</a>
                @auth
                    <div class="pt-4 flex items-center justify-between text-[#0D0D0D]/60 text-[11px]">
                        <span>Session // {{ Auth::user()->name }}</span>
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-700 underline font-semibold">Sign Out</button>
                        </form>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="text-[#0D0D0D]/70 hover:text-[#D4AF37] py-2">Sign In Portal</a>
                @endauth
            </div>
        </div>
    </header>

    <!-- Main Viewport Target Container -->
    <main class="flex-grow">
        
        @hasSection('content')
            <div class="pt-32 pb-16 max-w-7xl mx-auto px-6">
                @yield('content')
            </div>
        @else
            <!-- Default Creative Editorial Showcase Hero View -->
            <section class="min-h-screen relative w-full flex items-center bg-[#F3EFE9]/40 pt-24 overflow-hidden">
                <div class="w-full max-w-[1800px] mx-auto px-6 lg:px-16 grid grid-cols-1 lg:grid-cols-12 gap-8 items-center relative z-10">
                    
                    <div class="lg:col-span-5 order-2 lg:order-1 flex flex-col justify-center transform translate-y-0 opacity-100 duration-1000 transition-all">
                        <span class="text-xs uppercase tracking-[0.5em] text-[#D4AF37] mb-6 font-medium block">Autumn / Winter Edition</span>
                        <h1 class="text-5xl lg:text-7xl xl:text-8xl font-serif font-light text-[#0D0D0D] leading-[1.05] tracking-tight mb-8">
                            Timeless <br><span class="italic gold-shimmer font-normal">Imperfection.</span>
                        </h1>
                        <p class="text-sm lg:text-base font-light text-[#1A1A1A] leading-relaxed max-w-md mb-12">
                            Sculpted architecture worn next to skin. Handcrafted fine gems paired with unstructured raw textiles for the modern academic curator.
                        </p>
                        <div>
                            <a href="{{ route('products.index') }}" class="inline-flex items-center group relative text-xs uppercase tracking-[0.3em] font-medium py-3 pr-8 text-[#0D0D0D] overflow-hidden">
                                <span class="relative z-10">Enter The Atelier</span>
                                <span class="absolute bottom-0 left-0 w-full h-[1px] bg-[#0D0D0D] transition-transform origin-right scale-x-100 group-hover:scale-x-0"></span>
                                <span class="absolute bottom-0 left-0 w-full h-[1px] bg-[#D4AF37] transition-transform origin-left scale-x-0 group-hover:scale-x-100"></span>
                                <svg class="w-4 h-4 ml-2 transform transition-transform group-hover:translate-x-2 absolute right-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="square" stroke-width="1.5" d="M9 5l7 7-7 7"/></svg>
                            </a>
                        </div>
                    </div>

                    <div class="lg:col-span-7 order-1 lg:order-2 relative w-full h-[50vh] lg:h-[80vh] bg-[#F3EFE9] overflow-hidden group border border-neutral-200/40">
                        <div class="absolute inset-0 bg-black/5 mix-blend-multiply z-10"></div>
                        <img src="https://images.unsplash.com/photo-1617038260897-41a1f14a8ca0?q=80&w=1200" 
                             alt="Luxury Craft" 
                             class="w-full h-full object-cover object-center scale-100 group-hover:scale-105 transition-transform duration-[3000ms] cubic-bezier(0.16, 1, 0.3, 1)" />
                        <div class="absolute bottom-6 left-6 z-20 text-white font-serif italic text-lg tracking-widest opacity-80">
                            Objêt d'Art n° 041
                        </div>
                    </div>
                </div>
                
                <!-- Micro Scroll Action Track Indicator -->
                <div class="absolute bottom-12 left-6 lg:left-16 hidden lg:flex items-center space-x-4">
                    <span class="text-[9px] uppercase tracking-[0.4em] text-[#0D0D0D]/40">Scroll Down</span>
                    <div class="w-[1px] h-12 bg-[#0D0D0D]/20 relative overflow-hidden">
                        <div class="absolute top-0 left-0 w-full h-1/2 bg-[#D4AF37] animate-bounce"></div>
                    </div>
                </div>
            </section>

            <!-- Curated Collection Highlights Showcase Row Block -->
            <section class="py-32 lg:py-48 w-full bg-[#FAF8F5]">
                <div class="max-w-[1800px] mx-auto px-6 lg:px-16">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end mb-24 w-full">
                        <div class="max-w-2xl">
                            <span class="text-xs uppercase tracking-[0.5em] text-[#D4AF37] mb-4 block">// 01 Curated Works</span>
                            <h2 class="text-4xl lg:text-6xl font-serif font-light tracking-tight text-[#0D0D0D]">The Signature Curation</h2>
                        </div>
                        <p class="text-xs uppercase tracking-[0.2em] text-[#1A1A1A]/60 mt-4 lg:mt-0">
                            [ Exploration of Form & Weight ]
                        </p>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 lg:gap-8 items-start">
                        
                        <!-- Product Panel A -->
                        <div class="lg:col-span-5 lg:mt-24 flex flex-col">
                            <div class="bg-[#F3EFE9] overflow-hidden relative group aspect-[3/4] mb-8 border border-neutral-100">
                                <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?q=80&w=800" alt="Fine Jewelry Collection" class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-1000" />
                                <div class="absolute inset-0 bg-[#0D0D0D]/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            <h3 class="font-serif text-2xl font-light mb-2">Maison Fine Necklaces</h3>
                            <span class="text-xs uppercase tracking-[0.2em] text-[#D4AF37] font-medium">From $2,400</span>
                        </div>

                        <div class="hidden lg:block lg:col-span-2"></div>

                        <!-- Product Panel B -->
                        <div class="lg:col-span-5 flex flex-col">
                            <div class="bg-[#F3EFE9] overflow-hidden relative group aspect-[3/4] mb-8 border border-neutral-100">
                                <img src="https://images.unsplash.com/photo-1539109136881-3be0616acf4b?q=80&w=800" alt="Haute Apparel Collection" class="w-full h-full object-cover scale-100 group-hover:scale-105 transition-transform duration-700" />
                                <div class="absolute inset-0 bg-[#0D0D0D]/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            </div>
                            <h3 class="font-serif text-2xl font-light mb-2">Unstructured Raw Silks & Outers</h3>
                            <span class="text-xs uppercase tracking-[0.2em] text-[#D4AF37] font-medium">From $1,800</span>
                        </div>

                    </div>
                </div>
            </section>

            <!-- Text Manifesto Focus Callout Segment -->
            <section class="py-24 bg-[#0D0D0D] text-[#FAF8F5] relative overflow-hidden">
                <div class="absolute inset-0 opacity-10 pointer-events-none mix-blend-overlay bg-[radial-gradient(#FAF8F5_1px,transparent_1px)] [background-size:16px_16px]"></div>
                <div class="max-w-5xl mx-auto px-6 text-center py-16">
                    <span class="text-xs uppercase tracking-[0.6em] text-[#D4AF37] mb-8 block font-light">The Philosophy</span>
                    <p class="font-serif font-light text-2xl lg:text-5xl italic leading-relaxed text-[#F3EFE9] tracking-wide">
                        "Luxury is not noticed through excess. It is felt through the profound clarity of empty space, heavy weight, and deliberate execution."
                    </p>
                    <div class="w-16 h-[1px] bg-[#D4AF37] mx-auto mt-12"></div>
                </div>
            </section>
        @endif

    </main>

    <!-- Global Corporate Presentation Footer Block -->
    <footer class="bg-[#0D0D0D] text-[#FAF8F5] pt-24 pb-12 border-t border-[#1A1A1A] mt-auto">
        <div class="max-w-[1800px] mx-auto px-6 lg:px-16">
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-12 pb-16 border-b border-[#1A1A1A]">
                
                <div class="lg:col-span-2">
                    <span class="text-xl font-serif tracking-[0.3em] block mb-4">JESCA ATELIER</span>
                    <p class="text-xs font-light text-neutral-400 max-w-sm leading-relaxed tracking-wide">
                        An academic thesis project reimagined as a premium, architectural boutique experience. Engineered cleanly for the high-end design discipline.
                    </p>
                </div>

                <div>
                    <span class="text-[10px] uppercase tracking-[0.4em] text-[#D4AF37] block mb-6">Navigation</span>
                    <ul class="space-y-3 text-xs font-light text-neutral-400 tracking-wider">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home Archive</a></li>
                        <li><a href="{{ route('products.index') }}" class="hover:text-white transition-colors">All Ready-To-Wear</a></li>
                        <li><a href="{{ route('cart.index') }}" class="hover:text-white transition-colors">Your Order Bag</a></li>
                    </ul>
                </div>

                <div>
                    <span class="text-[10px] uppercase tracking-[0.4em] text-[#D4AF37] block mb-6">Engine Specifications</span>
                    <ul class="space-y-3 text-xs font-light text-neutral-400 tracking-wider">
                        <li>Laravel 11 & Blade UI</li>
                        <li>Tailwind Engine Architecture</li>
                        <li>Docker Micro-containment</li>
                    </ul>
                </div>

                <!-- Interactive Alpine Gazette Subscription Segment Module -->
                <div x-data="{ email: '', completed: false }">
                    <span class="text-[10px] uppercase tracking-[0.4em] text-[#D4AF37] block mb-6">Mailing Gazette</span>
                    
                    <!-- Form Frame View -->
                    <template x-if="!completed">
                        <form @submit.prevent="if(email.trim() !== '') completed = true" class="relative flex items-center border-b border-neutral-700 focus-within:border-[#D4AF37] transition-colors py-1">
                            <input 
                                type="email" 
                                x-model="email"
                                placeholder="Enter Email" 
                                required
                                class="bg-transparent border-none text-xs text-[#FAF8F5] placeholder-neutral-700 focus:outline-none w-full tracking-widest" />
                            <button type="submit" class="text-[#D4AF37] text-xs uppercase tracking-widest pl-2 hover:text-white transition-colors">Join</button>
                        </form>
                    </template>

                    <!-- Success State View Panel -->
                    <template x-if="completed">
                        <div class="text-xs italic font-serif text-[#F3EFE9] tracking-wide animate-fade-in">
                            Welcome to the inner circle. Correspondence initialized.
                        </div>
                    </template>
                </div>
            </div>

            <div class="pt-8 flex flex-col sm:flex-row justify-between items-center text-[10px] uppercase tracking-[0.3em] text-neutral-500 font-light">
                <p>&copy; {{ date('Y') }} Jesca Atelier Inc. Academic Presentation Showcase.</p>
                <p class="mt-4 sm:mt-0 tracking-[0.1em]">Designed for Uncompromising Elegance</p>
            </div>
            
        </div>
    </footer>

</body>
</html>