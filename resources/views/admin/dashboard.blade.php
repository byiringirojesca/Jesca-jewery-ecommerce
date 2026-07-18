@php
    // Quick admin dashboard analytics mock data layer
    $stats = [
        ['label' => 'Total Revenue', 'value' => '$4,295.00', 'color' => 'text-emerald-700', 'bg' => 'bg-emerald-50/40'],
        ['label' => 'Active Orders', 'value' => '12 Pending', 'color' => 'text-amber-700', 'bg' => 'bg-amber-50/40'],
        ['label' => 'Total Products', 'value' => '84 Items', 'color' => 'text-stone-700', 'bg' => 'bg-stone-100/50'],
        ['label' => 'Registered Users', 'value' => '142 Clients', 'color' => 'text-neutral-800', 'bg' => 'bg-neutral-100/50']
    ];

    $recentOrders = [
        ['id' => 'TXN-84721', 'customer' => 'Alice Umutoni', 'items' => 'Classic Gold Chain (1)', 'total' => 249.00, 'status' => 'Pending', 'status_color' => 'text-amber-700 border-amber-200 bg-amber-50/30'],
        ['id' => 'TXN-19482', 'customer' => 'Jean Keza', 'items' => 'Silk Evening Dress (1)', 'total' => 189.00, 'status' => 'Processing', 'status_color' => 'text-blue-700 border-blue-200 bg-blue-50/30'],
        ['id' => 'TXN-47201', 'customer' => 'Eric Mugisha', 'items' => 'Minimalist Silver Ring (2)', 'total' => 170.00, 'status' => 'Shipped', 'status_color' => 'text-emerald-700 border-emerald-200 bg-emerald-50/30']
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;1,400&family=Plus+Jakarta+Sans:wght@300;400;500;600&display=swap');

        .luxury-portal {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #FAFAFA;
        }

        .editorial-title {
            font-family: 'Cormorant Garamond', serif;
        }

        .gold-accent-line {
            height: 1px;
            background: linear-gradient(90deg, transparent, #D4AF37, transparent);
        }

        .thin-border {
            border-color: rgba(212, 175, 55, 0.15);
        }

        /* Premium custom scrollbar for high-end feel */
        .custom-x-scroll::-webkit-scrollbar {
            height: 3px;
        }

        .custom-x-scroll::-webkit-scrollbar-track {
            background: #F5F5F5;
        }

        .custom-x-scroll::-webkit-scrollbar-thumb {
            background: #D4AF37;
        }
    </style>

    <div class="luxury-portal space-y-16 p-2 sm:p-6 text-neutral-800 tracking-normal mix-blend-normal">

        <div class="flex flex-col md:flex-row md:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-[#D4AF37] block mb-2">Maison
                    Executive Command</span>
                <h1 class="editorial-title text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">Dashboard
                    Overview</h1>
                <p class="editorial-title italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Real-time boutique metrics and customer transaction registries curated for the Jesca Jewery commerce
                    engine.
                </p>
            </div>
            <div class="text-left md:text-right font-mono text-xs tracking-widest text-neutral-400">
                <span
                    class="block text-[9px] uppercase font-sans font-semibold text-neutral-500 tracking-widest mb-1">System
                    Pipeline Status</span>
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-neutral-900 text-white rounded-none">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#D4AF37] animate-pulse"></span>
                    SECURE LIVE ENVIRONMENT
                </span>
            </div>
        </div>

        <div
            class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-0 divide-y sm:divide-y-0 sm:divide-x divide-neutral-200 border border-neutral-200 bg-white shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)]">
            @foreach($stats as $index => $stat)
                <div
                    class="p-8 group hover:bg-neutral-50/60 transition-all duration-500 flex flex-col justify-between relative overflow-hidden">
                    <div class="absolute top-0 left-0 w-1 h-0 bg-[#D4AF37] group-hover:h-full transition-all duration-300">
                    </div>

                    <div class="space-y-1">
                        <div class="flex items-center justify-between">
                            <span
                                class="text-[11px] font-semibold uppercase tracking-[0.2em] text-neutral-400 group-hover:text-neutral-600 transition-colors block">
                                {{ $stat['label'] }}
                            </span>
                            <span class="text-xs text-[#D4AF37]/50 font-mono">// 0{{ $index + 1 }}</span>
                        </div>
                        <span class="editorial-title text-3xl sm:text-4xl font-light text-neutral-900 tracking-wide block pt-4">
                            {{ $stat['value'] }}
                        </span>
                    </div>

                    <div class="mt-6 flex items-center justify-between pt-4 border-t border-neutral-100">
                        <span class="text-[10px] tracking-wider text-neutral-500 font-medium">System Registry Counter</span>
                        <span
                            class="inline-block px-2 py-0.5 text-[9px] font-mono tracking-tighter uppercase {{ $stat['color'] }} {{ $stat['bg'] }} border border-current/10">
                            Active Sync
                        </span>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12 items-start">

            <div class="lg:col-span-2 space-y-4">
                <div
                    class="flex flex-col sm:flex-row sm:items-baseline justify-between gap-2 pb-2 border-b border-neutral-200">
                    <div class="flex items-center gap-3">
                        <h3 class="editorial-title text-2xl font-normal text-neutral-900 tracking-wide">Recent Transactions
                        </h3>
                        <span class="text-[10px] font-mono px-2 py-0.5 bg-neutral-100 text-neutral-500">Live Registry
                            Logs</span>
                    </div>
                    <a href="{{ route('admin.orders.index') }}"
                        class="text-[11px] font-semibold uppercase tracking-[0.15em] text-[#D4AF37] hover:text-neutral-900 border-b border-transparent hover:border-neutral-900 transition-all duration-300 pb-0.5">
                        View Complete Ledger &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto custom-x-scroll">
                    <table class="w-full text-left text-sm whitespace-nowrap">
                        <thead>
                            <tr
                                class="text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
                                <th class="py-4 font-medium">Order ID</th>
                                <th class="py-4 font-medium px-4">Client Representative</th>
                                <th class="py-4 font-medium px-4">Manifest Line Items</th>
                                <th class="py-4 font-medium px-4 text-right">Net Value</th>
                                <th class="py-4 font-medium text-right pl-4">Fulfillment Allocation</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-neutral-100 text-neutral-700">
                            @foreach($recentOrders as $order)
                                <tr class="group hover:bg-neutral-50/80 transition-all duration-300">
                                    <td class="py-5 font-mono text-neutral-900 text-xs tracking-tight font-medium">
                                        {{ $order['id'] }}
                                    </td>
                                    <td class="py-5 text-sm font-medium text-neutral-800 px-4">
                                        {{ $order['customer'] }}
                                    </td>
                                    <td class="py-5 text-xs text-neutral-500 italic font-light px-4">
                                        {{ $order['items'] }}
                                    </td>
                                    <td class="py-5 text-sm text-neutral-900 font-semibold text-right px-4">
                                        ${{ number_format($order['total'], 2) }}
                                    </td>
                                    <td class="py-5 text-right pl-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $order['status_color'] }}">
                                            {{ $order['status'] }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div
                class="border border-neutral-200 bg-white p-8 space-y-8 relative overflow-hidden shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
                <div
                    class="absolute top-0 right-0 w-32 h-32 bg-neutral-50 rounded-full translate-x-16 -translate-y-16 -z-10 border border-neutral-100">
                </div>

                <div class="space-y-2">
                    <h3
                        class="editorial-title text-2xl font-normal text-neutral-900 tracking-wide pb-2 border-b border-neutral-100">
                        Management Hub
                    </h3>
                    <p class="text-xs text-neutral-500 font-light leading-relaxed pt-1">
                        Direct administrative bypass control arrays to manage physical product assets. Utilize these
                        controllers during operational verification routines to demonstrate synchronous records
                        manipulation.
                    </p>
                </div>

                <div class="space-y-3 pt-2">
                    <a href="{{ route('admin.products.create') }}"
                        class="w-full bg-neutral-900 text-white font-medium py-3 px-4 rounded-none hover:bg-[#D4AF37] transition-all duration-500 text-center block text-xs uppercase tracking-[0.2em] shadow-sm">
                        Create Catalog Entry
                    </a>

                    <a href="{{ route('admin.products.index') }}"
                        class="w-full border border-neutral-300 text-neutral-700 font-medium py-3 px-4 rounded-none hover:bg-neutral-900 hover:text-white hover:border-neutral-900 transition-all duration-500 text-center block text-xs uppercase tracking-[0.2em]">
                        Audit Asset Inventory
                    </a>
                </div>

                <div
                    class="pt-6 border-t border-neutral-100 text-center flex flex-col items-center justify-center space-y-2">
                    <div class="w-12 gold-accent-line"></div>
                    <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                        Maison Security Pipeline // SSL Verified
                    </span>
                </div>
            </div>

        </div>

    </div>
@endsection