<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Console - Jesca Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }
    </style>
</head>

<body class="bg-zinc-50 text-zinc-900 flex min-h-screen antialiased">

    <aside
        class="w-64 bg-zinc-950 text-zinc-400 flex-shrink-0 flex flex-col hidden md:flex border-r border-zinc-800/40">
        <div class="h-16 flex items-center px-6 border-b border-zinc-800 bg-zinc-950">
            <a href="{{ route('admin.dashboard') }}"
                class="text-sm font-bold tracking-[0.25em] text-white flex items-center gap-2">
                <svg class="w-5 h-5 text-[#a67c1e]" fill="none" stroke="currentColor" stroke-width="2"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9s2.015-9 4.5-9M3 9h18M3 15h18" />
                </svg>
                JESCA <span
                    class="text-[#a67c1e] font-medium tracking-normal font-sans ml-1 text-xs px-1.5 py-0.5 rounded border border-[#a67c1e]/30 bg-[#a67c1e]/10">ADMIN</span>
            </a>
        </div>

        <nav class="flex-grow p-4 space-y-6 overflow-y-auto">
            <div>
                <a href="{{ route('admin.dashboard') }}"
                    class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm font-medium bg-zinc-900 text-white transition-all duration-300 shadow-sm border border-zinc-800">
                    <svg class="w-4 h-4 text-[#a67c1e]" fill="none" stroke="currentColor" stroke-width="1.8"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4zM14 16a2 2 0 012-2h2a2 2 0 012 2v4a2 2 0 01-2 2h-2a2 2 0 01-2-2v-4z" />
                    </svg>
                    <span>Dashboard</span>
                </a>
            </div>

            <div>
                <div class="px-3 mb-2 text-[10px] font-semibold text-zinc-500 uppercase tracking-[0.2em]">
                    Store Catalog
                </div>
                <div class="space-y-1">
                    <a href="{{ route('admin.products.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-900 hover:text-zinc-100 transition-all duration-200">
                        <svg class="w-4 h-4 text-zinc-500 group-hover:text-zinc-300" fill="none" stroke="currentColor"
                            stroke-width="1.8" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4" />
                        </svg>
                        <span>All Products</span>
                    </a>
                    <a href="{{ route('admin.products.create') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-900 hover:text-zinc-100 transition-all duration-200">
                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                        </svg>
                        <span>Add New Product</span>
                    </a>
                    <a href="{{ route('admin.categories.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-900 hover:text-zinc-100 transition-all duration-200">
                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M7 7h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>Categories</span>
                    </a>
                </div>
            </div>

            <div>
                <div class="px-3 mb-2 text-[10px] font-semibold text-zinc-500 uppercase tracking-[0.2em]">
                    Sales & Operations
                </div>
                <div class="space-y-1">
                    <a href="{{ route('admin.orders.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-900 hover:text-zinc-100 transition-all duration-200">
                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span>Orders</span>
                    </a>
                </div>
            </div>

            <div>
                <div class="px-3 mb-2 text-[10px] font-semibold text-zinc-500 uppercase tracking-[0.2em]">
                    Settings
                </div>
                <div class="space-y-1">
                    <a href="{{ route('admin.users.index') }}"
                        class="flex items-center space-x-3 px-3 py-2 rounded-lg text-sm font-medium hover:bg-zinc-900 hover:text-zinc-100 transition-all duration-200">
                        <svg class="w-4 h-4 text-zinc-500" fill="none" stroke="currentColor" stroke-width="1.8"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        <span>Manage Users</span>
                    </a>
                </div>
            </div>
        </nav>

        <div class="p-4 border-t border-zinc-800/60 bg-zinc-950">
            <a href="{{ route('home') }}"
                class="flex items-center justify-center space-x-2 w-full bg-zinc-900 hover:bg-[#a67c1e] border border-zinc-800 hover:border-transparent text-zinc-200 hover:text-white py-2.5 px-4 rounded-lg text-xs font-medium tracking-wide transition-all duration-300">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span>View Storefront</span>
            </a>
        </div>
    </aside>

    <div class="flex-grow flex flex-col overflow-x-hidden">
        <header
            class="h-16 bg-white border-b border-zinc-200 flex items-center justify-between px-6 md:px-8 sticky top-0 z-40">
            <div class="flex items-center space-x-3">
                <h2 class="text-sm font-semibold tracking-wider text-zinc-800 uppercase">System Control Panel</h2>
            </div>

            <div class="flex items-center space-x-4">
                <div class="flex items-center space-x-2.5 pl-4 border-l border-zinc-200">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    <span class="text-xs font-medium text-zinc-500 uppercase tracking-wider">Live Environment</span>
                </div>
            </div>
        </header>

        <main class="p-6 md:p-10 max-w-[1600px] w-full mx-auto flex-grow">
            <div class="bg-white rounded-xl border border-zinc-200 shadow-sm p-6 min-h-[calc(100vh-10.5rem)]">
                @yield('content')
            </div>
        </main>
    </div>

</body>

</html>