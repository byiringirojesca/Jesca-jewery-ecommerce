@php
    // Quick frontend mockup data layer for testing layout scaling
    $categories = [
        ['id' => 1, 'name' => 'All Products', 'slug' => 'all'],
        ['id' => 2, 'name' => 'Necklaces & Pendants', 'slug' => 'necklaces'],
        ['id' => 3, 'name' => 'Rings & Bracelets', 'slug' => 'rings'],
        ['id' => 4, 'name' => 'Dresses & Tops', 'slug' => 'apparel']
    ];

    $products = [
        [
            'id' => 1,
            'category' => 'Jewelry',
            'name' => 'Classic Gold Chain',
            'description' => '18k solid gold minimalist chain necklace perfect for elegant layering.',
            'price' => '249.00',
            'image' => 'https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=400&q=80'
        ],
        [
            'id' => 2,
            'category' => 'Jewelry',
            'name' => 'Diamond Stud Earrings',
            'description' => 'Stunning 0.5 carat total weight round diamond studs set in white gold.',
            'price' => '499.00',
            'image' => 'https://images.unsplash.com/photo-1635767798638-3e25273a8236?auto=format&fit=crop&w=400&q=80'
        ],
        [
            'id' => 3,
            'category' => 'Clothing',
            'name' => 'Silk Evening Dress',
            'description' => 'Flowing emerald green pure silk dress tailored for special occasions.',
            'price' => '189.00',
            'image' => 'https://images.unsplash.com/photo-1595777457583-95e059d581b8?auto=format&fit=crop&w=400&q=80'
        ],
        [
            'id' => 4,
            'category' => 'Jewelry',
            'name' => 'Minimalist Silver Ring',
            'description' => 'Sterling silver textured band ring perfect for daily contemporary wear.',
            'price' => '85.00',
            'image' => 'https://images.unsplash.com/photo-1605100804763-247f67b3557e?auto=format&fit=crop&w=400&q=80'
        ],
        [
            'id' => 5,
            'category' => 'Clothing',
            'name' => 'Premium Trench Coat',
            'description' => 'Classic water-resistant double-breasted outerwear with fine detailing.',
            'price' => '299.00',
            'image' => 'https://images.unsplash.com/photo-1591047139829-d91aecb6caea?auto=format&fit=crop&w=400&q=80'
        ],
        [
            'id' => 6,
            'category' => 'Clothing',
            'name' => 'Linen Button-Up Shirt',
            'description' => 'Breathable, relaxed-fit linen blend top perfect for casual afternoons.',
            'price' => '65.00',
            'image' => 'https://images.unsplash.com/photo-1602810318383-e386cc2a3ccf?auto=format&fit=crop&w=400&q=80'
        ]
    ];
@endphp

@extends('layouts.client')

@section('content')
    <div class="flex flex-col md:flex-row gap-8">
        <!-- Sidebar Filters -->
        <aside class="w-full md:w-64 flex-shrink-0">
            <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-100 sticky top-24">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Categories</h3>
                <ul class="space-y-2 text-sm text-gray-600">
                    @foreach($categories as $cat)
                        <li>
                            <a href="#"
                                class="hover:text-amber-600 block py-1 transition-colors {{ $loop->first ? 'font-medium text-amber-600' : '' }}">
                                {{ $cat['name'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </aside>

        <!-- Product Grid Area -->
        <div class="flex-grow">
            <!-- Search and Sort Bar -->
            <div
                class="bg-white p-4 rounded-xl shadow-sm border border-gray-100 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-8">
                <input type="text" placeholder="Search products..."
                    class="border border-gray-300 rounded-md px-4 py-2 text-sm w-full sm:w-72 focus:outline-none focus:border-amber-500">
                <span class="text-sm text-gray-500">Showing all {{ count($products) }} items</span>
            </div>

            <!-- Catalog Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div
                        class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden group flex flex-col transition hover:shadow-md">
                        <!-- Product Image Container -->
                        <div class="h-64 bg-gray-100 relative overflow-hidden">
                            <img src="{{ $product['image'] }}" alt="{{ $product['name'] }}"
                                class="w-full h-full object-cover transition duration-300 group-hover:scale-105">
                        </div>

                        <!-- Content Details -->
                        <div class="p-6 flex flex-col flex-grow">
                            <span
                                class="text-xs text-amber-600 font-semibold uppercase tracking-wider">{{ $product['category'] }}</span>
                            <h4 class="text-lg font-bold text-gray-900 mt-1 mb-2">{{ $product['name'] }}</h4>
                            <p class="text-sm text-gray-500 flex-grow line-clamp-2 mb-4">{{ $product['description'] }}</p>

                            <div class="mt-auto flex items-center justify-between">
                                <span class="text-xl font-extrabold text-gray-900">${{ $product['price'] }}</span>
                                <a href="{{ route('products.show', $product['id']) }}"
                                    class="bg-gray-900 text-white text-xs font-medium py-2 px-4 rounded hover:bg-amber-600 transition-colors">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection