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
            'status_color' => 'bg-green-100 text-green-800'
        ],
        [
            'id' => 2,
            'name' => 'Luxury Watches',
            'slug' => 'luxury-watches',
            'description' => 'High-end automatic and classic timepieces from global designers.',
            'product_count' => 18,
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800'
        ],
        [
            'id' => 3,
            'name' => 'Fashion Accessories',
            'slug' => 'fashion-accessories',
            'description' => 'Elegant complimentary pieces, scarves, premium leather goods, and pins.',
            'product_count' => 29,
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800'
        ],
        [
            'id' => 4,
            'name' => 'Limited Editions',
            'slug' => 'limited-editions',
            'description' => 'Seasonal product groupings and exclusive vault drop collections.',
            'product_count' => 0,
            'status' => 'Inactive',
            'status_color' => 'bg-gray-100 text-gray-800'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <!-- Top Layout Header Row -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">Product Categories</h1>
                <p class="text-sm text-gray-500 mt-1">Organize your store inventory taxonomy, modify descriptive slugs, and
                    view counts.</p>
            </div>
            <div>
                <a href="/admin/categories/create"
                    class="inline-flex items-center justify-center bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold py-2.5 px-4 rounded-md shadow-sm transition-colors whitespace-nowrap">
                    Add New Category
                </a>
            </div>
        </div>

        <!-- Filtering Utilities Bar Component -->
        <div
            class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="w-full sm:w-72">
                <input type="text" placeholder="Search categories by name..."
                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div class="text-sm text-gray-500 font-medium">
                Total Structural Groups: <span class="text-gray-900 font-bold">{{ count($productCategories) }}
                    Categories</span>
            </div>
        </div>

        <!-- Main Datatable Framework Grid Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">Category Title & Slug</th>
                            <th class="px-6 py-3.5">Brief Description</th>
                            <th class="px-6 py-3.5 text-center">Linked Products</th>
                            <th class="px-6 py-3.5">Status Flag</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700 font-medium">
                        @foreach($productCategories as $category)
                            <tr class="hover:bg-gray-50/50 transition-colors">

                                <!-- Category Name & Slug Parameters -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900">{{ $category['name'] }}</span>
                                        <span
                                            class="text-xs text-gray-400 font-mono font-normal">/{{ $category['slug'] }}</span>
                                    </div>
                                </td>

                                <!-- Description Summary Column (With soft truncation fallback style) -->
                                <td class="px-6 py-4 max-w-xs sm:max-w-md truncate text-sm text-gray-500 font-normal">
                                    {{ $category['description'] }}
                                </td>

                                <!-- Linked Inventory Product Quantities Count -->
                                <td class="px-6 py-4 text-center font-mono text-sm text-gray-900">
                                    {{ $category['product_count'] }}
                                </td>

                                <!-- Status Badges Assignment -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $category['status_color'] }}">
                                        {{ $category['status'] }}
                                    </span>
                                </td>

                                <!-- Action Management Controls Elements -->
                                <td class="px-6 py-4 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#" class="text-amber-600 hover:text-amber-700 font-bold">Edit Details</a>
                                        <span class="text-gray-300">|</span>
                                        <button type="button" class="text-red-500 hover:text-red-600 font-bold" {{ $category['product_count'] > 0 ? 'disabled title=Cannot delete category with active products' : '' }}>
                                            Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mock Pagination Tracker Footer Bar -->
            <div
                class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Showing 1 to {{ count($productCategories) }} of {{ count($productCategories) }} entries</span>
                <div class="inline-flex items-center gap-1">
                    <button type="button" disabled
                        class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Previous</button>
                    <button type="button" disabled
                        class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Next</button>
                </div>
            </div>
        </div>
    </div>
@endsection