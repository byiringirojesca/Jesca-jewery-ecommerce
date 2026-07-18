@extends('layouts.client')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100 my-12">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Login to Your Account</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-md mb-4 text-sm">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <button type="submit"
                class="w-full bg-amber-600 text-white font-medium py-2 rounded-md hover:bg-amber-700 transition">Sign
                In</button>
        </form>
        <p class="mt-4 text-sm text-gray-600 text-center">Don't have an account? <a href="{{ route('register') }}"
                class="text-amber-600 hover:underline">Register here</a></p>
    </div>
@endsection