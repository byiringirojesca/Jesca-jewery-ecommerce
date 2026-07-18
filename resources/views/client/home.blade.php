@extends('layouts.client')

@section('content')
<!-- Hero Section -->
<div class="relative bg-gray-900 rounded-2xl overflow-hidden mb-12 shadow-lg">
    <div class="absolute inset-0 bg-cover bg-center opacity-50" style="background-image: url('https://images.unsplash.com/photo-1515562141207-7a88fb7ce338?auto=format&fit=crop&w=1200&q=80');"></div>
    <div class="relative max-w-2xl mx-auto py-24 px-4 sm:py-32 sm:px-6 lg:px-8 text-center flex flex-col items-center">
        <h1 class="text-4xl font-extrabold tracking-tight text-white sm:text-5xl lg:text-6xl">Jesca Jewelry & Apparel</h1>
        <p class="mt-6 text-xl text-gray-100 max-w-xl">Handcrafted elegant jewelry and premium curated apparel designed for everyday distinction.</p>
        <a href="{{ route('products.index') }}" class="mt-8 inline-block bg-amber-600 border border-transparent rounded-md py-3 px-8 text-base font-medium text-white hover:bg-amber-700 transition">Shop the Collection</a>
    </div>
</div>

<!-- Category Showcases -->
<div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
    <!-- Jewelry Category Box -->
    <div class="group relative h-96 rounded-xl overflow-hidden shadow-md">
        <div class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1599643478518-a784e5dc4c8f?auto=format&fit=crop&w=600&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-8">
            <h3 class="text-2xl font-bold text-white mb-2">Fine Jewelry</h3>
            <a href="{{ route('products.index', ['category' => 'jewelry']) }}" class="text-amber-400 font-medium hover:text-amber-300 transition">Browse Rings & Necklaces &rarr;</a>
        </div>
    </div>

    <!-- Clothing Category Box -->
    <div class="group relative h-96 rounded-xl overflow-hidden shadow-md">
        <div class="absolute inset-0 bg-cover bg-center transition duration-500 group-hover:scale-105" style="background-image: url('https://images.unsplash.com/photo-1483985988355-763728e1935b?auto=format&fit=crop&w=600&q=80');"></div>
        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
        <div class="absolute bottom-0 left-0 p-8">
            <h3 class="text-2xl font-bold text-white mb-2">Modern Apparel</h3>
            <a href="{{ route('products.index', ['category' => 'clothing']) }}" class="text-amber-400 font-medium hover:text-amber-300 transition">Browse Clothing &rarr;</a>
        </div>
    </div>
</div>
@endsection