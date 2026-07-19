@extends('layouts.admin')

@section('content')
    <!-- ROOT LAYOUT LAYER WITH INTEGRATED ALPINE STATUS MATRIX -->
    <div x-data="{ 
            statusModalOpen: false, 
            activeOrder: { id: '', customer_name: '', status: '' },
            openStatusModal(order) {
                this.activeOrder = { ...order };
                this.statusModalOpen = true;
            }
        }" class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal relative">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-600 block mb-2">Boutique
                    Ledger</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Customer Orders</h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    View and manage customer purchases, track shipping updates, and review sales metrics.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // ORDER MANAGEMENT v1.2 // ELOQUENT
            </div>
        </div>

        <!-- Search & Info Bar -->
        <div
            class="bg-white p-4 border border-neutral-200 rounded-none flex flex-col sm:flex-row items-center justify-between gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)]">
            <div class="w-full sm:w-72">
                <form action="{{ route('admin.orders.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search by Order ID or customer..."
                        class="w-full border border-neutral-300 rounded-none bg-white px-4 py-2 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-amber-500 transition-colors"
                        onchange="this.form.submit()">
                </form>
            </div>
            <div class="text-xs uppercase tracking-wider text-neutral-500 font-semibold">
                Total Found Records: <span class="text-neutral-900 font-bold ml-1">{{ $customerOrders->total() }}</span>
            </div>
        </div>

        <!-- Main Orders Table -->
        <div
            class="bg-white border border-neutral-200 rounded-none overflow-hidden flex flex-col shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-neutral-50 text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
                        <tr>
                            <th class="px-6 py-4 font-medium">Order ID</th>
                            <th class="px-6 py-4 font-medium">Customer</th>
                            <th class="px-6 py-4 font-medium">Total Amount</th>
                            <th class="px-6 py-4 font-medium">Date</th>
                            <th class="px-6 py-4 font-medium">Status</th>
                            <th class="px-6 py-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-700">
                        @forelse($customerOrders as $order)
                            <tr class="group hover:bg-neutral-50/60 transition-all duration-300">

                                <!-- Order Database Primary Key ID -->
                                <td class="px-6 py-5 font-mono text-xs font-semibold text-neutral-900">
                                    #{{ $order->id }}
                                </td>

                                <!-- Customer Details -->
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-neutral-900">{{ $order->user->name }}</span>
                                        <span
                                            class="text-xs text-neutral-400 mt-0.5 font-light tracking-tight">{{ $order->user->email }}</span>
                                    </div>
                                </td>


                                <!-- Dynamic Currency Output Formatting -->
                                <td class="px-6 py-5 text-sm text-neutral-900 font-semibold">
                                    ${{ number_format($order->total_price, 2) }}
                                </td>

                                <!-- Carbon Timestamps Format Transition -->
                                <td class="px-6 py-5 text-xs text-neutral-500 font-mono">
                                    {{ $order->created_at ? $order->created_at->format('d M Y') : 'N/A' }}
                                </td>

                                <!-- Appended Accessor Status Color Badge -->
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $order->status_color }} rounded-none">
                                        {{ $order->status }}
                                    </span>
                                </td>

                                <!-- Actions Grid Layout with Core Processing Vectors -->
                                <td class="px-6 py-5 text-right text-xs uppercase tracking-wider font-medium">
                                    <div class="inline-flex items-center justify-end gap-4 w-full">

                                        <!-- Trigger to Pass Eloquent Properties to the Active Alpine Context -->
                                        <button type="button"
                                            @click="openStatusModal({ id: '{{ $order->id }}', customer_name: '{{ addslashes($order->user->name) }}', status: '{{ $order->status }}' })"
                                            class="text-amber-600 hover:text-amber-800 transition-colors inline-flex items-center gap-1.5 group/btn"
                                            title="Update Processing Status">
                                            <svg class="w-4 h-4 transform group-hover/btn:scale-105 transition-transform"
                                                fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M7.5 21 3 16.5m0 0L7.5 12M3 16.5h13.5m0-13.5L21 7.5m0 0L16.5 12M21 7.5H7.5" />
                                            </svg>
                                            <span class="hidden md:inline text-[11px] tracking-wide font-semibold">Status</span>
                                        </button>

                                        <span class="text-neutral-200 hidden md:inline">|</span>

                                        <a href="{{ route('admin.orders.show', $order->id) }}"
                                            class="text-neutral-500 hover:text-neutral-900 transition-colors inline-flex items-center gap-1.5 group/btn"
                                            title="View Order Details">
                                            <svg class="w-4 h-4 transform group-hover/btn:scale-105 transition-transform"
                                                fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                            </svg>
                                            <span
                                                class="hidden md:inline text-[11px] tracking-wide font-semibold">Details</span>
                                        </a>

                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-sm text-neutral-400 font-serif italic">
                                    No transaction logs matching the criteria were located in the system ledger.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Native Dynamic Server-Side Pagination Block Footer -->
            <div class="px-6 py-4 bg-neutral-50 border-t border-neutral-100 mechanical-pagination">
                {{ $customerOrders->links() }}
            </div>
        </div>

        <!-- MAISON SYSTEM POPUP MODAL FRAME -->
        <div x-show="statusModalOpen"
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-neutral-950/40 backdrop-blur-sm"
            style="display: none;" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">

            <div @click.away="statusModalOpen = false"
                class="w-full max-w-md bg-white border border-neutral-200 shadow-xl p-6 sm:p-8 rounded-none flex flex-col space-y-6"
                x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">

                <div class="flex items-start justify-between border-b border-neutral-100 pb-4">
                    <div>
                        <span class="text-[9px] uppercase tracking-widest font-bold text-amber-600 block mb-1">State
                            Configuration</span>
                        <h3 class="font-serif text-xl text-neutral-900 font-medium">Update Order State</h3>
                    </div>
                    <button @click="statusModalOpen = false"
                        class="text-neutral-400 hover:text-neutral-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Dynamic Form Action Path Built with Alpine Template Litterals -->
                <form :action="`/admin/orders/${activeOrder.id}/status`" method="POST" class="space-y-6">
                    @csrf
                    @method('PATCH')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase tracking-wider font-bold text-neutral-400 block">Transaction
                                Reference</label>
                            <div class="text-xs font-semibold text-neutral-800 bg-neutral-50 px-3 py-2 border border-neutral-200 font-mono"
                                x-text="'#' + activeOrder.id"></div>
                        </div>
                        <div class="space-y-1">
                            <label class="text-[10px] uppercase tracking-wider font-bold text-neutral-400 block">Customer
                                Name</label>
                            <div class="text-xs font-semibold text-neutral-800 bg-neutral-50 px-3 py-2 border border-neutral-200 truncate"
                                x-text="activeOrder.customer_name"></div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="status-select"
                            class="text-[10px] uppercase tracking-wider font-bold text-neutral-400 block">Tracking Pipeline
                            Status</label>
                        <select id="status-select" name="status" x-model="activeOrder.status"
                            class="w-full border border-neutral-300 rounded-none bg-white px-3 py-2 text-sm text-neutral-800 focus:outline-none focus:border-amber-500 transition-colors uppercase tracking-wide text-xs font-semibold">
                            <option value="Pending">Pending Validation</option>
                            <option value="Processing">In Processing Pipeline</option>
                            <option value="Shipped">Dispatched & Shipped</option>
                            <option value="Cancelled">Void / Cancelled</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="statusModalOpen = false"
                            class="px-4 py-2 border border-neutral-200 text-neutral-500 hover:text-neutral-800 text-[11px] uppercase tracking-wider font-semibold transition-colors">
                            Dismiss
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 text-white text-[11px] uppercase tracking-wider font-semibold transition-colors shadow-sm">
                            Commit Transition
                        </button>
                    </div>
                </form>
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