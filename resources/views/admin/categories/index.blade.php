@php
    // Quick admin product categories tracking mock data layer
    $productCategories = [
        [
            'id' => 1,
            'name' => 'Fine Jewelry',
            'slug' => 'fine-jewelry',
            'description' => 'Premium handcrafted gold, silver, and gemstone jewelry collections.',
            'product_count' => 42,
            'status' => 'Active',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
        ],
        [
            'id' => 2,
            'name' => 'Luxury Watches',
            'slug' => 'luxury-watches',
            'description' => 'High-end automatic and classic timepieces from global designers.',
            'product_count' => 18,
            'status' => 'Active',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
        ],
        [
            'id' => 3,
            'name' => 'Fashion Accessories',
            'slug' => 'fashion-accessories',
            'description' => 'Elegant complimentary pieces, scarves, premium leather goods, and pins.',
            'product_count' => 29,
            'status' => 'Active',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
        ],
        [
            'id' => 4,
            'name' => 'Limited Editions',
            'slug' => 'limited-editions',
            'description' => 'Seasonal product groupings and exclusive vault drop collections.',
            'product_count' => 0,
            'status' => 'Inactive',
            'status_color' => 'bg-neutral-100 text-neutral-600 border-neutral-200'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-600 block mb-2">Boutique
                    Collections</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Product Categories
                </h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Organize your store collections, manage web links, and track inventory numbers across the catalog.
                </p>
            </div>
            <div>
                <a href="/admin/categories/create"
                    class="inline-flex items-center justify-center bg-neutral-900 hover:bg-amber-600 text-white text-xs uppercase tracking-[0.2em] font-medium py-3 px-6 rounded-none shadow-sm transition-all duration-500 whitespace-nowrap">
                    Add New Category
                </a>
            </div>
        </div>

        <!-- Search & Info Bar -->
        <div
            class="bg-white p-4 border border-neutral-200 rounded-none flex flex-col sm:flex-row items-center justify-between gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)]">
            <div class="w-full sm:w-72">
                <input type="text" placeholder="Search categories by name..."
                    class="w-full border border-neutral-300 rounded-none bg-white px-4 py-2 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-amber-500 transition-colors">
            </div>
            <div class="text-xs uppercase tracking-wider text-neutral-500 font-semibold">
                Total Categories: <span class="text-neutral-900 font-bold ml-1">{{ count($productCategories) }}</span>
            </div>
        </div>

        <!-- Main Categories Table -->
        <div
            class="bg-white border border-neutral-200 rounded-none overflow-hidden flex flex-col shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-neutral-50 text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
                        <tr>
                            <th class="px-6 py-4 font-medium">Name & Link</th>
                            <th class="px-6 py-4 font-medium">Description</th>
                            <th class="px-6 py-4 font-medium text-center">Total Products</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-700">
                        @foreach($productCategories as $category)
                            <tr class="group hover:bg-neutral-50/60 transition-all duration-300">

                                <!-- Category Name & Slug -->
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-neutral-900">{{ $category['name'] }}</span>
                                        <span class="text-xs text-neutral-400 font-mono mt-0.5">/{{ $category['slug'] }}</span>
                                    </div>
                                </td>

                                <!-- Description -->
                                <td class="px-6 py-5 max-w-xs sm:max-w-md truncate text-xs text-neutral-500 font-light italic">
                                    {{ $category['description'] }}
                                </td>

                                <!-- Product Count -->
                                <td class="px-6 py-5 text-center font-mono text-sm text-neutral-900 font-medium">
                                    {{ $category['product_count'] }}
                                </td>

                                <!-- Status Badge -->
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $category['status_color'] }}">
                                        {{ $category['status'] }}
                                    </span>
                                </td>

                                <!-- Action Buttons -->
                                <td class="px-6 py-5 text-right text-xs uppercase tracking-wider font-medium">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#" class="text-amber-600 hover:text-neutral-900 transition-colors">Edit</a>
                                        <span class="text-neutral-200">|</span>
                                        <button type="button"
                                            class="text-neutral-400 hover:text-red-600 disabled:opacity-30 disabled:hover:text-neutral-400 transition-colors"
                                            {{ $category['product_count'] > 0 ? 'disabled title="Cannot delete category with active products"' : '' }}>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer & Pagination -->
            <div
                class="px-6 py-4 bg-neutral-50 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-500 font-medium">
                <span>Showing 1 to {{ count($productCategories) }} of {{ count($productCategories) }} entries</span>
                <div class="inline-flex items-center gap-2">
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">
                        Previous
                    </button>
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Line -->
        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-4">
            <div class="w-12 h-px bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>
@endsection