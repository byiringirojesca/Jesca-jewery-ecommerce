@php
    // Mock categories matching standard primary key mappings for the foreign key constraint
    $categories = [
        ['id' => 2, 'name' => 'Necklaces & Pendants'],
        ['id' => 3, 'name' => 'Rings & Bracelets'],
        ['id' => 4, 'name' => 'Dresses & Tops']
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');

        .luxury-portal {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFA;
        }

        .editorial-title {
            font-family: 'Cormorant Garamond', serif;
        }

        .gold-accent-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, #D4AF37, transparent);
        }

        .luxury-input {
            border-radius: 0px !important;
            transition: all 0.3s ease;
        }

        .luxury-input:focus {
            border-color: #D4AF37 !important;
            box-shadow: none !important;
            outline: none !important;
        }
    </style>

    <div class="luxury-portal max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal mix-blend-normal">

        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-2xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-[#D4AF37] block mb-2">Maison Asset Registry</span>
                <h1 class="editorial-title text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Add New Product</h1>
                <p class="editorial-title italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Populate the catalog configuration fields below to initialize a new physical asset constraint state within the commercial database ledger.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // CREATION PORTAL v1.0
            </div>
        </div>

        <div class="border border-neutral-200 bg-white p-6 md:p-10 relative overflow-hidden shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="absolute top-0 right-0 w-32 h-32 bg-neutral-50 rounded-full translate-x-16 -translate-y-16 -z-10 border border-neutral-100"></div>

            <form action="#" method="POST" class="space-y-8">
                @csrf

                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Product Designation *
                    </label>
                    <input type="text" name="name" placeholder="e.g., Classic Gold Chain" required
                        class="luxury-input w-full border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37]">
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Boutique Category Collection *
                    </label>
                    <div class="relative">
                        <select name="category_id" required
                            class="luxury-input w-full border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-800 focus:outline-none focus:border-[#D4AF37] appearance-none cursor-pointer">
                            <option value="" disabled selected class="text-neutral-400">Select an architectural database category relation</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}" class="text-neutral-800">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-neutral-400 text-xs">
                            &#9662;
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                            Retail Valuation (USD) *
                        </label>
                        <div class="relative shadow-none">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-neutral-400 text-sm">$</span>
                            </div>
                            <input type="number" name="price" step="0.01" min="0.00" placeholder="0.00" required
                                class="luxury-input w-full border border-neutral-300 bg-white pl-8 pr-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37]">
                        </div>
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                            Available Vault Inventory *
                        </label>
                        <input type="number" name="stock" min="0" placeholder="e.g., 50" required
                            class="luxury-input w-full border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37]">
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Editorial Description & Specifications *
                    </label>
                    <textarea name="description" rows="5"
                        placeholder="Provide an elegant description detailing fine materials, dimensions, and styling guidance specs..."
                        required
                        class="luxury-input w-full border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37] resize-none"></textarea>
                </div>

                <div class="pt-6 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="w-full sm:w-auto text-center border border-neutral-300 text-neutral-700 font-medium py-3 px-6 rounded-none hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition-all duration-500 text-xs uppercase tracking-[0.2em]">
                        Cancel & Return
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto text-center bg-neutral-900 text-white font-medium py-3 px-6 rounded-none hover:bg-[#D4AF37] transition-all duration-500 text-xs uppercase tracking-[0.2em] shadow-sm">
                        Commit & Save Product Registry
                    </button>
                </div>

            </form>
        </div>

        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-4">
            <div class="w-12 gold-accent-line"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>
@endsection