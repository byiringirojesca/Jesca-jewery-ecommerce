@extends('layouts.admin')

@section('content')
    <div class="font-sans bg-[#FAFAFA] space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal mix-blend-normal">

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-[#D4AF37] block mb-2">
                    Maison Executive Command
                </span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">
                    Inventory Ledger
                </h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    View and manage physical collection items, control pricing valuations, and inspect real-time vault asset parameters.
                </p>
            </div>
            <div>
                <a href="{{ route('admin.products.create') }}"
                    class="inline-flex items-center bg-neutral-900 hover:bg-[#D4AF37] text-white text-xs font-semibold py-3.5 px-6 rounded-none tracking-[0.2em] uppercase shadow-sm transition-all duration-500">
                    <svg class="h-3.5 w-3.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Create Catalog Entry
                </a>
            </div>
        </div>

        <!-- Search Controls and Counters Bar -->
        <div class="border border-neutral-200 bg-white p-6 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)] flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="w-full sm:w-80 relative">
                <input type="text" placeholder="Filter Vault Assets by Name..."
                    class="w-full bg-neutral-50 text-neutral-800 placeholder-neutral-400 border border-neutral-200 rounded-none pl-4 pr-10 py-2.5 text-xs tracking-wide focus:outline-none focus:border-[#D4AF37] transition-all duration-300">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-neutral-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs text-neutral-400 uppercase tracking-widest font-semibold">
                <span>Total Managed Assets:</span>
                <span class="text-neutral-900 font-mono text-sm tracking-normal font-bold">
                    // {{ $products->total() }} Items
                </span>
            </div>
        </div>

        <!-- Inventory Registry Table -->
        <div class="border border-neutral-200 bg-white shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col">
            <div class="overflow-x-auto scrollbar-thin scrollbar-thumb-neutral-200">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead>
                        <tr class="text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200 bg-neutral-50/50">
                            <th class="px-6 py-4 font-medium">Boutique Item</th>
                            <th class="px-6 py-4 font-medium">Classification</th>
                            <th class="px-6 py-4 font-medium text-right">Valuation Price</th>
                            <th class="px-6 py-4 font-medium text-center">Vault Stock</th>
                            <th class="px-6 py-4 font-medium">Status Allocation</th>
                            <th class="px-6 py-4 font-medium text-right">Control Commands</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-700">
                        @forelse($products as $product)
                            @php
                                // Safely resolve first media asset from array casting setups
                                $displayImage = is_array($product->images) 
                                    ? ($product->images[0] ?? 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80') 
                                    : ($product->image ?? 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=800&q=80');

                                // Dynamic stock status parameters
                                $inStock = $product->stock > 0;
                                $statusText = $inStock ? 'In Vault' : 'Depleted';
                                $statusColor = $inStock 
                                    ? 'border-neutral-900 text-neutral-900 bg-neutral-50' 
                                    : 'border-red-200 text-red-700 bg-red-50/50';
                            @endphp
                            <tr class="group hover:bg-neutral-50/60 transition-all duration-300">
                                <!-- Product Identity Details -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-neutral-50 border border-neutral-200 rounded-none overflow-hidden flex-shrink-0 relative">
                                            <img src="{{ $displayImage }}" alt="{{ $product->name }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                        </div>
                                        <div>
                                            <span class="font-semibold text-neutral-900 text-sm block max-w-xs truncate tracking-wide">
                                                {{ $product->name }}
                                            </span>
                                            <span class="text-[9px] font-mono text-neutral-400 uppercase tracking-wider">
                                                Database Ref: #{{ sprintf('%04d', $product->id) }}
                                            </span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 text-xs text-neutral-500 italic font-light tracking-wide">
                                    {{ $product->category->name ?? 'Unclassified' }}
                                </td>

                                <td class="px-6 py-4 text-sm text-neutral-900 font-semibold text-right tracking-tight">
                                    ${{ number_format($product->price, 2) }}
                                </td>

                                <td class="px-6 py-4 text-xs font-mono text-neutral-600 text-center tracking-tighter">
                                    {{ $product->stock }} units
                                </td>

                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-2.5 py-0.5 text-[9px] uppercase tracking-wider font-semibold border {{ $statusColor }}">
                                        {{ $statusText }}
                                    </span>
                                </td>

                                <!-- Executive Direct Controls -->
                                <td class="px-6 py-4 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="{{ route('admin.products.edit', $product->slug) }}"
                                            class="text-[#D4AF37] hover:text-neutral-900 uppercase font-semibold text-[10px] tracking-widest transition-colors duration-300">
                                            Edit
                                        </a>
                                        <span class="text-neutral-200">|</span>
                                        <form action="{{ route('admin.products.destroy', $product->slug) }}" method="POST" class="inline" onsubmit="return confirm('Confirm permanent catalog destruction directive?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 uppercase font-semibold text-[10px] tracking-widest transition-colors duration-300 bg-transparent p-0 border-none cursor-pointer">
                                                Delete
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-xs text-neutral-400 uppercase tracking-widest font-mono">
                                     No assets Added.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Ledger Pagination Footer -->
            <div class="px-6 py-4 bg-neutral-50/50 border-t border-neutral-200 flex flex-col sm:flex-row items-center justify-between gap-4 text-[11px] text-neutral-400 font-medium tracking-wide">
                <span>
                    Presenting {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} Vault Logs
                </span>
                
                <div class="inline-flex items-center gap-1.5">
                    @if ($products->onFirstPage())
                        <span class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 text-[10px] uppercase tracking-wider font-semibold select-none cursor-not-allowed">
                            Previous
                        </span>
                    @else
                        <a href="{{ $products->previousPageUrl() }}" 
                           class="px-3 py-1.5 border border-neutral-300 bg-white text-neutral-700 hover:bg-neutral-900 hover:text-white hover:border-neutral-900 text-[10px] uppercase tracking-wider font-semibold transition-all duration-300">
                            Previous
                        </a>
                    @endif

                    @if ($products->hasMorePages())
                        <a href="{{ $products->nextPageUrl() }}" 
                           class="px-3 py-1.5 border border-neutral-300 bg-white text-neutral-700 hover:bg-neutral-900 hover:text-white hover:border-neutral-900 text-[10px] uppercase tracking-wider font-semibold transition-all duration-300">
                            Next
                        </a>
                    @endif
                </div>
            </div>
        </div>

    </div>
@endsection