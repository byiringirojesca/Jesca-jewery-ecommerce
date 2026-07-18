@extends('layouts.client')

@section('content')
    <div class="max-w-md mx-auto bg-white p-8 rounded-xl shadow-sm border border-gray-100 my-8">
        <h2 class="text-2xl font-bold text-gray-900 mb-6 text-center">Create an Account</h2>

        @if ($errors->any())
            <div class="bg-red-50 text-red-600 p-3 rounded-md mb-4 text-sm">
                <ul class="list-disc pl-4">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="name" value="{{ old('name') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="{{ old('email') }}" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                <input type="password" name="password_confirmation" required
                    class="w-full border border-gray-300 rounded-md px-3 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <button type="submit"
                class="w-full bg-amber-600 text-white font-medium py-2 rounded-md hover:bg-amber-700 transition">Register</button>
        </form>
        <p class="mt-4 text-sm text-gray-600 text-center">Already have an account? <a href="{{ route('login') }}"
                class="text-amber-600 hover:underline">Login here</a></p>
    </div>
@endsection