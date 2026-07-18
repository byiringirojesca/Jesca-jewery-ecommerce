@extends('layouts.admin')

@section('content')
    <div class="max-w-3xl mx-auto space-y-6">

        <!-- Header Block Section -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Create Product Category</h1>
            <p class="text-sm text-gray-500 mt-1">Add a new taxonomy group to structure store products. Slugs are used for
                clean, SEO-friendly storefront routing patterns.</p>
        </div>

        <!-- Main Creation Form Framework Module Card -->
        <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-200">
            <form action="#" method="POST" class="space-y-6">
                @csrf

                <!-- 1. Category Name Field ($table->string('name')) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">Category Name *</label>
                    <input type="text" id="category_name" name="name" placeholder="e.g., Fine Jewelry" required
                        class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
                </div>

                <!-- 2. Unique Slug Parameter Field ($table->string('slug')->unique()) -->
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-1">URL Identifier Slug *</label>
                    <div class="relative rounded-md shadow-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-sm font-mono">/categories/</span>
                        </div>
                        <input type="text" id="category_slug" name="slug" placeholder="fine-jewelry" required
                            class="w-full border border-gray-300 rounded-md pl-28 pr-3 py-2 text-sm font-mono focus:outline-none focus:border-amber-500 bg-gray-50/50">
                    </div>
                    <p class="text-xs text-gray-400 mt-1.5 leading-relaxed">Must be a unique lowercase string using dashes
                        instead of whitespace keys (e.g., luxury-watches).</p>
                </div>

                <!-- Action Trigger Button Panel Segment -->
                <div class="pt-4 border-t border-gray-100 flex items-center justify-end gap-4">
                    <a href="/admin/categories"
                        class="px-5 py-2.5 border border-gray-300 rounded-md text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                        Cancel & Return
                    </a>
                    <button type="button" onclick="window.location.href='/admin/categories'"
                        class="px-5 py-2.5 bg-amber-600 text-white font-semibold rounded-md shadow-sm hover:bg-amber-700 transition-colors text-sm">
                        Commit & Save Category
                    </button>
                </div>

            </form>
        </div>
    </div>

    <!-- Automated Sluggification Handling Script UI Utility -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const nameInput = document.getElementById('category_name');
            const slugInput = document.getElementById('category_slug');

            nameInput.addEventListener('input', function () {
                let slug = this.value
                    .toLowerCase()
                    .trim()
                    .replace(/[^a-z0-9\s-]/g, '') // Strip out special punctuation characters
                    .replace(/\s+/g, '-')         // Convert whitespace blocks into clean dash markers
                    .replace(/-+/g, '-');         // Avoid repetitive double trailing hyphens

                slugInput.value = slug;
            });
        });
    </script>
@endsection