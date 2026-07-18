@php
    // Quick admin product inventory catalog mock data layer
    $inventoryProducts = [
        [
            'id' => 1,
            'name' => 'Classic Gold Chain',
            'category' => 'Jewelry',
            'sku' => 'JW-GLD-001',
            'price' => 249.00,
            'stock' => 12,
            'status' => 'In Stock',
            'status_color' => 'bg-green-100 text-green-800',
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
            'status_color' => 'bg-amber-100 text-amber-800',
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
            'status_color' => 'bg-green-100 text-green-800',
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
            'status_color' => 'bg-red-100 text-red-800',
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
            'status_color' => 'bg-green-100 text-green-800',
            'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=150&q=80'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
<div class="space-y-6">
    
    <!-- Top Context Navigation Row -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Product Inventory</h1>
            <p class="text-sm text-gray-500 mt-1">Monitor stock status levels, modify pricing arrays, and manage product definitions.</p>
        </div>
        <div>
            <a href="{{ route('admin.products.create') }}" class="inline-flex items-center bg-amber-600 hover:bg-amber-700 text-white text-sm font-semibold py-2.5 px-5 rounded-md shadow-sm transition-colors">
                <svg class="h-4 w-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Add New Product
            </a>
        </div>
    </div>

    <!-- Quick Filtering System Controls -->
    <div class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
        <div class="w-full sm:w-72 relative">
            <input type="text" placeholder="Filter by name, SKU..." class="w-full border border-gray-300 rounded-md pl-4 pr-10 py-2 text-sm focus:outline-none focus:border-amber-500">
        </div>
        <div class="flex items-center gap-2 text-sm text-gray-500 font-medium">
            <span>Total Catalog Matrix:</span>
            <span class="text-gray-900 font-bold">{{ count($inventoryProducts) }} Items registered</span>
        </div>
    </div>

    <!-- Main Datatable Framework Grid Container -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-sm whitespace-nowrap">
                <thead class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3.5">Product</th>
                        <th class="px-6 py-3.5">SKU</th>
                        <th class="px-6 py-3.5">Category</th>
                        <th class="px-6 py-3.5">Price</th>
                        <th class="px-6 py-3.5">Stock Level</th>
                        <th class="px-6 py-3.5">Status</th>
                        <th class="px-6 py-3.5 text-right">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 text-gray-700 font-medium">
                    @foreach($inventoryProducts as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <!-- Image and Label Flex Block -->
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 bg-gray-50 border border-gray-100 rounded-lg overflow-hidden flex-shrink-0">
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}" class="w-full h-full object-cover">
                                    </div>
                                    <span class="font-bold text-gray-900 text-sm block max-w-xs truncate">{{ $item['name'] }}</span>
                                </div>
                            </td>
                            
                            <td class="px-6 py-4 font-mono text-xs text-gray-500">{{ $item['sku'] }}</td>
                            
                            <td class="px-6 py-4 text-sm text-gray-500">{{ $item['category'] }}</td>
                            
                            <td class="px-6 py-4 text-sm text-gray-900 font-bold">${{ number_format($item['price'], 2) }}</td>
                            
                            <td class="px-6 py-4 text-sm font-mono text-gray-600">{{ $item['stock'] }} units</td>
                            
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $item['status_color'] }}">
                                    {{ $item['status'] }}
                                </span>
                            </td>
                            
                            <!-- Action Direct Utility Links Trigger -->
                            <td class="px-6 py-4 text-right text-xs">
                                <div class="inline-flex items-center gap-3">
                                    <a href="#" class="text-amber-600 hover:text-amber-700 font-bold">Edit</a>
                                    <span class="text-gray-300">|</span>
                                    <button type="button" class="text-red-500 hover:text-red-600 font-bold">Delete</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <!-- Mock Pagination Tracker Footer Bar -->
        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
            <span>Showing 1 to {{ count($inventoryProducts) }} of {{ count($inventoryProducts) }} entries</span>
            <div class="inline-flex items-center gap-1">
                <button type="button" disabled class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Previous</button>
                <button type="button" disabled class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Next</button>
            </div>
        </div>
    </div>
</div>
@endsection