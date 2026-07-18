<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jesca Jewelry & Apparel</title>
    <!-- Tailwind CSS via CDN for rapid 12-hour development -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 font-sans flex flex-col min-h-screen">

    <!-- Responsive Navigation Header -->
    <header class="bg-white shadow-sm sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">

                <!-- Logo / Branding -->
                <div class="flex-shrink-0 flex items-center">
                    <a href="{{ route('home') }}" class="text-2xl font-bold text-gray-900 tracking-wide">
                        JESCA<span class="text-amber-600">.</span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <nav class="hidden md:flex space-x-8">
                    <a href="{{ route('home') }}"
                        class="text-gray-700 hover:text-amber-600 px-1 py-2 text-sm font-medium transition-colors">Home</a>
                    <a href="{{ route('products.index') }}"
                        class="text-gray-700 hover:text-amber-600 px-1 py-2 text-sm font-medium transition-colors">Shop
                        All</a>
                </nav>

                <!-- Action Utilities (Cart & Authentication) -->
                <div class="flex items-center space-x-6">
                    <!-- Shopping Cart Icon Indicator -->
                    <a href="{{ route('cart.index') }}"
                        class="text-gray-600 hover:text-amber-600 relative p-2 transition-colors">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
                        </svg>
                        <span
                            class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-white bg-amber-600 rounded-full transformation translate-x-1/2 -translate-y-1/2">
                            {{-- Dynamically calculated via your Cart data --}}
                            {{ session('cart') ? count(session('cart')) : 0 }}
                        </span>
                    </a>

                    @auth
                        <div class="flex items-center space-x-4">
                            <span class="text-sm font-medium text-gray-700">Hi, {{ Auth::user()->name }}</span>
                            <form action="{{ route('logout') }}" method="POST" class="inline">
                                @csrf
                                <button type="submit"
                                    class="text-sm font-medium text-red-600 hover:text-red-700">Logout</button>
                            </form>
                        </div>
                    @else
                        <a href="{{ route('login') }}"
                            class="text-sm font-medium text-gray-700 hover:text-amber-600">Login</a>
                    @endauth
                </div>
            </div>
        </div>
    </header>

    <!-- Main Dynamic Content Area -->
    <main class="flex-grow max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @yield('content')
    </main>

    <!-- Simple Professional Footer -->
    <footer class="bg-gray-900 text-gray-400 py-6 border-t border-gray-800 mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm">
            <p>&copy; {{ date('Y') }} Jesca Jewelry & Apparel. All rights reserved for Academic Presentation.</p>
        </div>
    </footer>

</body>

</html>