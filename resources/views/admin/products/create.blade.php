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
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Header Block Section -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Add New Product</h1>
            <p class="text-sm text-gray-500 mt-1">Populate the catalog configuration form. Fields directly correspond to the
                system database structural constraint tables.</p>
        </div>

        <!-- Main Creation Form Framework Module Card -->
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200">
            <form action="#" method="POST" class="space-y-6">
                @csrf

                <!-- 1. Product Title Label Mapping ($table->string('name')) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Product Name *</label>
                    <input type="text" name="name" placeholder="e.g., Classic Gold Chain" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                </div>

                <!-- 2. Category Dropdown Mapping ($table->foreignId('category_id')->constrained()) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Product Category Allocation *</label>
                    <select name="category_id" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500 bg-white">
                        <option value="" disabled selected>Select an architectural database category relation</option>
                        @foreach($categories as $category)
                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- 3. Numeric Configurations Block Row (Price & Stock Level) -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <!-- Unit Pricing Configuration ($table->decimal('price', 10, 2)) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Unit Selling Price ($) *</label>
                        <div class="relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 text-sm">$</span>
                            </div>
                            <input type="number" name="price" step="0.01" min="0.00" placeholder="0.00" required
                                class="w-full border border-gray-300 rounded-md pl-7 pr-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                        </div>
                    </div>

                    <!-- Stock Volume Level Input ($table->integer('stock')) -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1">Initial Stock Inventory Quantity
                            *</label>
                        <input type="number" name="stock" min="0" placeholder="e.g., 50" required
                            class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                    </div>
                </div>

                <!-- 4. Textarea Information Block Mapping ($table->text('description')) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Detailed Description Box *</label>
                    <textarea name="description" rows="5"
                        placeholder="Provide an elegant description detailing fine materials, dimensions, and styling guidance specs..."
                        required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500"></textarea>
                </div>

                <!-- Action Trigger Button Panel Segment -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="px-5 py-2.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel & Return
                    </a>
                    <button type="button" onclick="window.location.href='{{ route('admin.products.index') }}'"
                        class="px-5 py-2.5 bg-amber-600 text-white font-semibold rounded-md shadow-sm hover:bg-amber-700 transition-colors text-sm">
                        Commit & Save Product Registry
                    </button>
                </div>

            </form>
        </div>
    </div>
@endsection