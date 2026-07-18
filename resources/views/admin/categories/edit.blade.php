@php
    // Mocking an existing category object instance loaded from the database context
    $category = [
        'id' => 1,
        'name' => 'Fine Jewelry',
        'slug' => 'fine-jewelry'
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-2xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-600 block mb-2">Boutique
                    Collections</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Edit Category</h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Update your store collection details and web links below. Changes to the link identifier will update how
                    the collection matches storefront pages.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // MUTATION PORTAL v1.0
            </div>
        </div>

        <!-- Main Form Container -->
        <div
            class="border border-neutral-200 bg-white p-6 md:p-10 relative overflow-hidden shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div
                class="absolute top-0 right-0 w-32 h-32 bg-neutral-50 rounded-full translate-x-16 -translate-y-16 -z-10 border border-neutral-100">
            </div>

            <form action="#" method="POST" class="space-y-8">
                @csrf
                @method('PUT')

                <!-- 1. Category Name Field -->
                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Category Name *
                    </label>
                    <input type="text" id="category_name" name="name" value="{{ old('name', $category['name']) }}" required
                        class="w-full border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-amber-500 rounded-none transition-colors">
                </div>

                <!-- 2. Web Link Slug Field -->
                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Web Link Identifier *
                    </label>
                    <div class="relative shadow-none">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <span class="text-neutral-400 text-xs font-mono">/categories/</span>
                        </div>
                        <input type="text" id="category_slug" name="slug" value="{{ old('slug', $category['slug']) }}"
                            required
                            class="w-full border border-neutral-300 bg-neutral-50/50 pl-28 pr-4 py-3 text-sm text-neutral-800 font-mono placeholder-neutral-400 focus:outline-none focus:border-amber-500 rounded-none transition-colors">
                    </div>
                    <p class="text-[11px] text-neutral-400 italic font-light leading-relaxed pt-1">
                        Must be unique, lowercase, and use dashes instead of spaces (e.g., luxury-watches).
                    </p>
                </div>

                <!-- Actions -->
                <div class="pt-6 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="/admin/categories"
                        class="w-full sm:w-auto text-center border border-neutral-300 text-neutral-700 font-medium py-3 px-6 rounded-none hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition-all duration-500 text-xs uppercase tracking-[0.2em]">
                        Cancel & Return
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto text-center bg-neutral-900 text-white font-medium py-3 px-6 rounded-none hover:bg-amber-600 transition-all duration-500 text-xs uppercase tracking-[0.2em] shadow-sm">
                        Save Changes
                    </button>
                </div>

            </form>
        </div>

        <!-- Footer Line -->
        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-4">
            <div class="w-12 h-px bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>

    <!-- Auto Link Generation Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('category_name');
            const slugInput = document.getElementById('category_slug');

            nameInput.addEventListener('input', function () {
                let slug = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '') // Strip punctuation
                    .replace(/\s+/g, '-')         // Convert spaces to dashes
                    .replace(/-+/g, '-');         // Avoid double dashes

                slugInput.value = slug;
            });
        });
    </script>
@endsection