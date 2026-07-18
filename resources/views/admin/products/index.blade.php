@php
    // Mock inventory data for products
    $inventoryProducts = [
        [
            'id' => 1,
            'name' => 'Classic Gold Chain',
            'category' => 'Jewelry',
            'sku' => 'JW-GLD-001',
            'price' => 249.00,
            'stock' => 12,
            'status' => 'In Stock',
            'status_color' => 'text-emerald-700 border-emerald-200 bg-emerald-50/30',
            'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=150&q=80'
        ],
        [
            'id' => 2,
            'name' => 'Diamond Stud Earrings',
            'category' => 'Jewelry',
            'sku' => 'JW-DIA-002',
            'price' => 499.00,
            'stock' => 4,
            'status' => 'Low Stock',
            'status_color' => 'text-amber-700 border-amber-200 bg-amber-50/30',
            'image' => 'https://images.unsplash.com/photo-1635767798638-3e25273a8236?auto=format&fit=crop&w=150&q=80'
        ],
        [
            'id' => 3,
            'name' => 'Silk Evening Dress',
            'category' => 'Clothing',
            'sku' => 'AP-SLK-003',
            'price' => 189.00,
            'stock' => 8,
            'status' => 'In Stock',
            'status_color' => 'text-emerald-700 border-emerald-200 bg-emerald-50/30',
            'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=150&q=80'
        ],
        [
            'id' => 4,
            'name' => 'Minimalist Silver Ring',
            'category' => 'Jewelry',
            'sku' => 'JW-SLV-004',
            'price' => 85.00,
            'stock' => 0,
            'status' => 'Out of Stock',
            'status_color' => 'text-red-700 border-red-200 bg-red-50/30',
            'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=150&q=80'
        ],
        [
            'id' => 5,
            'name' => 'Premium Trench Coat',
            'category' => 'Clothing',
            'sku' => 'AP-TRN-005',
            'price' => 299.00,
            'stock' => 15,
            'status' => 'In Stock',
            'status_color' => 'text-emerald-700 border-emerald-200 bg-emerald-50/30',
            'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=150&q=80'
        ]
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

        /* Premium custom scrollbar for high-end feel */
        .custom-x-scroll::-webkit-scrollbar {
            height: 3px;
        }

        .custom-x-scroll::-webkit-scrollbar-track {
            background: #F5F5F5;
        }

        .custom-x-scroll::-webkit-scrollbar-thumb {
            background: #D4AF37;
        }
    </style>

    <div class="luxury-portal space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal mix-blend-normal">

        <!-- Page Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-[#D4AF37] block mb-2">Maison
                    Executive Command</span>
                <h1 class="editorial-title text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Inventory Ledger
                </h1>
                <p class="editorial-title italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    View and manage physical collection items, control pricing valuations, and inspect real-time vault asset
                    parameters.
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
        <div
            class="border border-neutral-200 bg-white p-6 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)] flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="w-full sm:w-80 relative">
                <input type="text" placeholder="Filter Vault Assets by Name or SKU..."
                    class="w-full bg-neutral-50 text-neutral-800 placeholder-neutral-400 border border-neutral-200 rounded-none pl-4 pr-10 py-2.5 text-xs tracking-wide focus:outline-none focus:border-[#D4AF37] transition-all duration-300">
                <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none text-neutral-400">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </div>
            </div>
            <div class="flex items-center gap-2 text-xs text-neutral-400 uppercase tracking-widest font-semibold">
                <span>Total Managed Assets:</span>
                <span class="text-neutral-900 font-mono text-sm tracking-normal font-bold">//
                    {{ count($inventoryProducts) }} Items</span>
            </div>
        </div>

        <!-- Inventory Registry Table -->
        <div
            class="border border-neutral-200 bg-white shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)] overflow-hidden flex flex-col">
            <div class="overflow-x-auto custom-x-scroll">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead>
                        <tr
                            class="text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200 bg-neutral-50/50">
                            <th class="px-6 py-4 font-medium">Boutique Item</th>
                            <th class="px-6 py-4 font-medium">SKU Code</th>
                            <th class="px-6 py-4 font-medium">Classification</th>
                            <th class="px-6 py-4 font-medium text-right">Valuation Price</th>
                            <th class="px-6 py-4 font-medium text-center">Vault Stock</th>
                            <th class="px-6 py-4 font-medium">Status Allocation</th>
                            <th class="px-6 py-4 font-medium text-right">Control Commands</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-700">
                        @foreach($inventoryProducts as $index => $item)
                            <tr class="group hover:bg-neutral-50/60 transition-all duration-300">
                                <!-- Product Identity Details -->
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <div
                                            class="w-12 h-12 bg-neutral-50 border border-neutral-200 rounded-none overflow-hidden flex-shrink-0 relative">
                                            <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                        </div>
                                        <div>
                                            <span
                                                class="font-semibold text-neutral-900 text-sm block max-w-xs truncate tracking-wide">{{ $item['name'] }}</span>
                                            <span class="text-[9px] font-mono text-neutral-400 uppercase tracking-wider">Item
                                                ID: 0{{ $item['id'] }}</span>
                                        </div>
                                    </div>
                                </td>

                                <td class="px-6 py-4 font-mono text-xs text-neutral-400 tracking-tight">{{ $item['sku'] }}</td>

                                <td class="px-6 py-4 text-xs text-neutral-500 italic font-light tracking-wide">
                                    {{ $item['category'] }}</td>

                                <td class="px-6 py-4 text-sm text-neutral-900 font-semibold text-right tracking-tight">
                                    ${{ number_format($item['price'], 2) }}
                                </td>

                                <td class="px-6 py-4 text-xs font-mono text-neutral-600 text-center tracking-tighter">
                                    {{ $item['stock'] }} units
                                </td>

                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 text-[9px] uppercase tracking-wider font-semibold border {{ $item['status_color'] }}">
                                        {{ $item['status'] }}
                                    </span>
                                </td>

                                <!-- Executive Direct Controls -->
                                <td class="px-6 py-4 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#"
                                            class="text-[#D4AF37] hover:text-neutral-900 uppercase font-semibold text-[10px] tracking-widest transition-colors duration-300">Edit</a>
                                        <span class="text-neutral-200">|</span>
                                        <button type="button"
                                            class="text-red-500 hover:text-red-700 uppercase font-semibold text-[10px] tracking-widest transition-colors duration-300">Delete</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Ledger Pagination Footer -->
            <div
                class="px-6 py-4 bg-neutral-50/50 border-t border-neutral-200 flex items-center justify-between text-[11px] text-neutral-400 font-medium tracking-wide">
                <span>Presenting 1 to {{ count($inventoryProducts) }} of {{ count($inventoryProducts) }} Vault Logs</span>
                <div class="inline-flex items-center gap-1.5">
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 text-[10px] uppercase tracking-wider cursor-not-allowed font-semibold">Previous</button>
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 text-[10px] uppercase tracking-wider cursor-not-allowed font-semibold">Next</button>
                </div>
            </div>
        </div>

    </div>
@endsection