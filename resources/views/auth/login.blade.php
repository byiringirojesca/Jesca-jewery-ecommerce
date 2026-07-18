@extends('layouts.client')

@section('content')
    <style>
        .luxury-input:focus {
            border-bottom-color: #D4AF37;
            box-shadow: none;
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #0D0D0D 0%, #A67C1E 50%, #0D0D0D 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>

    <div class="w-full max-w-[1700px] mx-auto min-h-[75vh] bg-luxury-white flex items-center justify-center py-20">
        <div class="w-full grid grid-cols-1 lg:grid-cols-12 gap-12 items-center px-4 lg:px-0">

            <div
                class="hidden lg:flex lg:col-span-6 flex-col justify-center text-left pr-16 border-r border-luxury-champagne/60 min-h-[400px]">
                <span class="text-[10px] uppercase tracking-[0.6em] text-luxury-gold mb-6 font-semibold block">
                    Jesca Jewelry & Apparel
                </span>
                <h2 class="text-4xl xl:text-5xl font-serif font-light text-luxury-black leading-[1.15] tracking-tight mb-6">
                    A Dedicated Workspace <br>For <span class="italic font-normal gold-gradient-text">Exclusivity.</span>
                </h2>
                <p class="text-xs font-light text-luxury-charcoal/60 leading-relaxed max-w-sm tracking-wide">
                    Welcome back to your curated sanctuary. Authenticate to review your private allocations, saved
                    structural manifestations, and tailored collections.
                </p>
            </div>

            <div class="w-full lg:col-span-5 lg:col-start-8 flex flex-col justify-center">
                <header class="mb-14">
                    <span class="text-[10px] uppercase tracking-[0.4em] text-luxury-gold mb-2 block font-medium">// Identity
                        Verification</span>
                    <h1 class="text-3xl font-serif font-light tracking-tight text-luxury-black">Client Sign In</h1>
                </header>

                @if ($errors->any())
                    <div
                        class="border-l border-red-600 bg-red-50/40 p-4 mb-8 text-[10px] tracking-widest uppercase font-medium text-red-700">
                        {{ $errors->first() }}
                    </div>
                @endif

                <form action="{{ route('login') }}" method="POST" class="space-y-12">
                    @csrf

                    <div class="relative w-full">
                        <label
                            class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Email
                            Address</label>
                        <input type="email" name="email" required value="{{ old('email') }}"
                            class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs uppercase tracking-widest text-luxury-black placeholder-luxury-charcoal/30 focus:outline-none luxury-input transition-colors duration-500 pt-2">
                    </div>

                    <div class="relative w-full">
                        <label
                            class="absolute -top-5 left-0 text-[9px] uppercase tracking-[0.3em] text-luxury-charcoal/50 font-medium">Secret
                            Password</label>
                        <input type="password" name="password" required
                            class="w-full bg-transparent border-t-0 border-x-0 border-b border-luxury-black/20 pb-2 text-xs tracking-widest text-luxury-black placeholder-luxury-charcoal/30 focus:outline-none luxury-input transition-colors duration-500 pt-2">
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full group relative border border-luxury-black text-luxury-black hover:text-luxury-white font-sans text-xs uppercase tracking-[0.4em] font-semibold py-4 px-8 transition-colors duration-500 overflow-hidden bg-transparent">
                            <span
                                class="absolute inset-0 w-full h-full bg-luxury-black transform translate-y-full group-hover:translate-y-0 transition-transform duration-500 cubic-bezier(0.16, 1, 0.3, 1) -z-10"></span>
                            <span class="relative z-10">Verify & Enter</span>
                        </button>
                    </div>
                </form>

                <footer
                    class="mt-16 border-t border-luxury-champagne/40 pt-6 flex flex-col sm:flex-row sm:items-center justify-between gap-4 text-[10px] uppercase tracking-[0.25em]">
                    <span class="text-luxury-charcoal/50">New to the Atelier?</span>
                    <a href="{{ route('register') }}"
                        class="text-luxury-gold hover:text-luxury-black transition-colors font-semibold relative pb-1 after:absolute after:bottom-0 after:left-0 after:w-full after:h-[1px] after:bg-luxury-gold/30 hover:after:bg-luxury-black">
                        Register Credentials &rarr;
                    </a>
                </footer>
            </div>

        </div>
    </div>
@endsection