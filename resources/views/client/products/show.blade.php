@extends('layouts.client')

@section('content')
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-12">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- Main Image Gallery Display -->
            <div class="bg-gray-50 rounded-xl overflow-hidden h-[450px]">
                <img src="https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=600&q=80"
                    alt="Product Name" class="w-full h-full object-cover">
            </div>

            <!-- Product Details Columns -->
            <div class="flex flex-col justify-between">
                <div>
                    <span class="text-sm text-amber-600 font-semibold uppercase tracking-wider">Jewelry</span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-2 mb-4">Classic Gold Chain</h1>
                    <p class="text-2xl font-extrabold text-gray-900 mb-6">$249.00</p>

                    <hr class="border-gray-200 mb-6">

                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-2">Description</h3>
                    <p class="text-gray-600 leading-relaxed mb-6">This beautifully crafted 18k solid gold minimalist chain
                        necklace is the perfect balance of elegance and modern simplicity. It matches flawlessly with any
                        casual look or evening ensemble.</p>

                    <!-- Stock Badge Indicator -->
                    <div
                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        In Stock (12 units available)
                    </div>
                </div>

                <!-- Add to Cart Trigger Block -->
                <form action="#" method="POST" class="mt-8">
                    @csrf
                    <div class="flex gap-4">
                        <div class="w-24">
                            <select
                                class="w-full border border-gray-300 rounded-md py-3 px-3 text-sm focus:outline-none focus:border-amber-500">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                            </select>
                        </div>
                        <button type="button"
                            class="flex-grow bg-amber-600 text-white font-medium py-3 px-6 rounded-md hover:bg-amber-700 transition">Add
                            to Shopping Cart</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection