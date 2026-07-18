<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Console - Jesca Store</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 font-sans flex min-h-screen">

    <!-- Admin Persistent Sidebar Navigation -->
    <aside class="w-64 bg-gray-900 text-gray-300 flex-shrink-0 flex flex-col hidden md:flex">
        <div class="h-16 flex items-center px-6 border-b border-gray-800 bg-gray-950">
            <a href="{{ route('admin.dashboard') }}" class="text-xl font-bold text-white tracking-wide">
                JESCA <span class="text-amber-500">ADMIN</span>
            </a>
        </div>
        <nav class="flex-grow p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-sm font-medium bg-gray-800 text-white transition-colors">
                <span>Dashboard Overview</span>
            </a>

            <div class="pt-2 pb-1 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Catalog Core
            </div>
            <a href="{{ route('admin.products.index') }}"
                class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-sm font-medium hover:bg-gray-800 hover:text-white transition-colors">
                <span>Inventory Products</span>
            </a>
            <a href="{{ route('admin.products.create') }}"
                class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-sm font-medium hover:bg-gray-800 hover:text-white transition-colors">
                <span>Add New Product</span>
            </a>
            <a href="{{ route('admin.categories.index') }}"
                class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-sm font-medium hover:bg-gray-800 hover:text-white transition-colors">
                <span>Product Categories</span>
            </a>

            <div class="pt-2 pb-1 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Operations
            </div>
            <a href="{{ route('admin.orders.index') }}"
                class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-sm font-medium hover:bg-gray-800 hover:text-white transition-colors">
                <span>Customer Orders</span>
            </a>

            <div class="pt-2 pb-1 px-4 text-xs font-semibold text-gray-500 uppercase tracking-wider">
                Management
            </div>
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center space-x-3 px-4 py-2.5 rounded-md text-sm font-medium hover:bg-gray-800 hover:text-white transition-colors">
                <span>Manage Users</span>
            </a>
        </nav>
        <div class="p-4 border-t border-gray-800 bg-gray-950">
            <a href="{{ route('home') }}"
                class="flex items-center justify-center space-x-2 w-full bg-gray-800 hover:bg-amber-600 text-white py-2 rounded-md text-xs font-semibold transition-colors">
                <span>&larr; Return to Storefront</span>
            </a>
        </div>
    </aside>

    <!-- Main Workspace Container -->
    <div class="flex-grow flex flex-col overflow-x-hidden">
        <!-- Top App Bar Utility -->
        <header class="h-16 bg-white shadow-sm border-b border-gray-200 flex items-center justify-between px-6 md:px-8">
            <h2 class="text-md font-bold text-gray-800">Operational Control Panel</h2>
            <div class="flex items-center space-x-4">
                <span class="text-sm font-medium text-gray-600">Administrator Console</span>
            </div>
        </header>

        <!-- Dynamic Target Context Component View Block -->
        <main class="p-6 md:p-8 max-w-7xl w-full mx-auto">
            @yield('content')
        </main>
    </div>

</body>

</html>