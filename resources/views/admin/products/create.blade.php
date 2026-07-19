
@extends('layouts.admin')

@section('content')
    <!-- Outer wrapper uses single quotes to prevent quote collisions with the parsed JSON array -->
    <div x-data='{ 
                    images: @json($initialImages), 
                    addImageSlot() { this.images.push("") },
                    removeImageSlot(index) { this.images.splice(index, 1) }
                 }'
        class="bg-[#FAFAFA] font-sans max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal mix-blend-normal">

        <!-- Section Header Layer -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-2xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-[#D4AF37] block mb-2">Maison Asset Registry</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Add New Product</h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Populate the catalog configuration fields below to initialize a new physical asset constraint state within the commercial database ledger.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // CREATION PORTAL v1.2
            </div>
        </div>

        <!-- Global Error Warning Pipeline -->
        @if ($errors->any())
            <div class="border-l border-red-500 bg-red-50/50 p-4 text-[11px] tracking-widest uppercase font-medium text-red-800">
                <span class="block font-semibold mb-1">Registry Entry Failure // Review Highlighted Violations Below</span>
            </div>
        @endif

        <!-- Creation Form Card Grid -->
        <div class="border border-neutral-200 bg-white p-6 md:p-10 relative overflow-hidden shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="absolute top-0 right-0 w-32 h-32 bg-neutral-50 rounded-full translate-x-16 -translate-y-16 -z-10 border border-neutral-100"></div>

            <form action="{{ route('admin.products.store') }}" method="POST" class="space-y-8">
                @csrf

                <!-- Basic Product Identification Parameters -->
                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Product Designation *
                    </label>
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="e.g., Classic Gold Chain" required
                        class="rounded-none border px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37] transition-all duration-300 w-full @error('name') border-red-400 focus:border-red-400 @else border-neutral-300 @enderror">
                    @error('name')
                        <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block mt-1">// {{ $message }}</span>
                    @enderror
                </div>

                <!-- Collection Dynamic Matrix Relationships -->
                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Boutique Category Collection *
                    </label>
                    <div class="relative">
                        <select name="category_id" required
                            class="rounded-none border bg-white px-4 py-3 text-sm text-neutral-800 focus:outline-none focus:border-[#D4AF37] transition-all duration-300 w-full appearance-none cursor-pointer @error('category_id') border-red-400 focus:border-red-400 @else border-neutral-300 @enderror">
                            <option value="" disabled {{ old('category_id') ? '' : 'selected' }} class="text-neutral-400">Select an architectural database category relation</option>
                            @foreach($categories as $category)
                                <option value="{{ $category['id'] }}" {{ old('category_id') == $category['id'] ? 'selected' : '' }} class="text-neutral-800">
                                    {{ $category['name'] }}
                                </option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-0 flex items-center pr-4 pointer-events-none text-neutral-400 text-xs">
                            &#9662;
                        </div>
                    </div>
                    @error('category_id')
                        <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block mt-1">// {{ $message }}</span>
                    @enderror
                </div>

                <!-- Commercial Quantitative Metrics -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                    <div class="space-y-2">
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                            Retail Valuation (USD) *
                        </label>
                        <div class="relative shadow-none">
                            <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                <span class="text-neutral-400 text-sm">$</span>
                            </div>
                            <input type="number" name="price" value="{{ old('price') }}" step="0.01" min="0.00" placeholder="0.00" required
                                class="rounded-none border bg-white pl-8 pr-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37] transition-all duration-300 w-full @error('price') border-red-400 focus:border-red-400 @else border-neutral-300 @enderror">
                        </div>
                        @error('price')
                            <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block mt-1">// {{ $message }}</span>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                            Available Vault Inventory *
                        </label>
                        <input type="number" name="stock" value="{{ old('stock') }}" min="0" placeholder="e.g., 50" required
                            class="rounded-none border bg-white px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37] transition-all duration-300 w-full @error('stock') border-red-400 focus:border-red-400 @else border-neutral-300 @enderror">
                        @error('stock')
                            <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block mt-1">// {{ $message }}</span>
                        @enderror
                    </div>
                </div>

                <!-- Editorial Matrix Layer -->
                <div class="space-y-2">
                    <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-500 block">
                        Editorial Description & Specifications *
                    </label>
                    <textarea name="description" rows="4"
                        placeholder="Provide an elegant description detailing fine materials, dimensions, and styling guidance specs..."
                        required
                        class="rounded-none border border-neutral-300 bg-white px-4 py-3 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37] transition-all duration-300 w-full resize-none @error('description') border-red-400 focus:border-red-400 @else border-neutral-300 @enderror">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block mt-1">// {{ $message }}</span>
                    @enderror
                </div>

                <!-- Dynamic Multi-Image Collection Pipeline Section -->
                <div class="space-y-4 pt-4 border-t border-neutral-100">
                    <div class="flex items-center justify-between">
                        <div>
                            <label class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-900 block">
                                Product Visual Media Ledger
                            </label>
                            <span class="text-[10px] text-neutral-400 block mt-0.5">Supply secure direct links to images for the consumer showcase grid.</span>
                        </div>

                        <button type="button" @click="addImageSlot()"
                            class="border border-neutral-900 text-neutral-900 bg-transparent text-[10px] font-semibold uppercase tracking-wider py-1.5 px-3 hover:bg-neutral-900 hover:text-white transition-all duration-300 cursor-pointer">
                            + Add Image Asset Slot
                        </button>
                    </div>

                    <!-- Array Index Error Alerts -->
                    @error('images')
                        <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block">// {{ $message }}</span>
                    @enderror
                    @error('images.*')
                        <span class="text-[10px] font-medium text-red-600 uppercase tracking-wider block">// One or more provided image URLs are invalid or broken.</span>
                    @enderror

                    <!-- Input List Array Management -->
                    <div class="space-y-3">
                        <template x-for="(image, index) in images" :key="index">
                            <div class="flex items-center gap-3">
                                <div class="font-mono text-[10px] text-neutral-400 w-6" x-text="'[' + (index + 1) + ']'"></div>

                                <input type="url" name="images[]" x-model="images[index]"
                                    placeholder="https://images.unsplash.com/photo-..." required
                                    class="rounded-none border border-neutral-300 bg-white px-4 py-2.5 text-xs text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-[#D4AF37] transition-all duration-300 flex-grow">

                                <button type="button" @click="removeImageSlot(index)" :disabled="images.length === 1"
                                    class="text-neutral-400 hover:text-red-700 text-sm p-2 transition-colors disabled:opacity-30 disabled:hover:text-neutral-400 cursor-pointer">
                                    &#10005;
                                </button>
                            </div>
                        </template>
                    </div>

                    <!-- Luxury Live Preview Grid Deck -->
                    <div class="pt-4">
                        <span class="text-[9px] uppercase tracking-widest font-semibold text-neutral-400 block mb-3">// Asset Rendering Verification Deck</span>
                        <div class="grid grid-cols-3 sm:grid-cols-6 gap-4">
                            <template x-for="(image, index) in images" :key="index">
                                <div x-show="image && image.trim() !== ''"
                                    class="aspect-[3/4] bg-neutral-100 border border-neutral-200 overflow-hidden relative group">
                                    <img :src="image" class="w-full h-full object-cover">
                                    <div class="absolute bottom-0 inset-x-0 bg-black/60 text-white font-mono text-[8px] py-0.5 text-center"
                                        x-text="'Asset ' + (index + 1)"></div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>

                <!-- Submit and Escape Directives -->
                <div class="pt-6 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-end gap-4">
                    <a href="{{ route('admin.products.index') }}"
                        class="w-full sm:w-auto text-center border border-neutral-300 text-neutral-700 font-medium py-3 px-6 rounded-none hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition-all duration-500 text-xs uppercase tracking-[0.2em]">
                        Cancel & Return
                    </a>
                    <button type="submit"
                        class="w-full sm:w-auto text-center bg-neutral-900 text-white font-medium py-3 px-6 rounded-none hover:bg-[#D4AF37] transition-all duration-500 text-xs uppercase tracking-[0.2em] shadow-sm">
                        Commit & Save Product Registry
                    </button>
                </div>

            </form>
        </div>

        <!-- System Pipeline Footer Line -->
        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-4">
            <div class="w-12 h-[1px] bg-gradient-to-r from-transparent via-[#D4AF37] to-transparent"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>
@endsection