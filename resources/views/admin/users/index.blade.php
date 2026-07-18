@php
    // Quick admin users management tracking mock data layer
    $systemUsers = [
        [
            'id' => 1,
            'name' => 'Alice Umutoni',
            'email' => 'alice@example.com',
            'role' => 'Administrator',
            'role_color' => 'bg-purple-50 text-purple-700 border-purple-200',
            'joined_date' => '12 Jan 2026',
            'status' => 'Active',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
        ],
        [
            'id' => 2,
            'name' => 'Jean Keza',
            'email' => 'jean.k@example.com',
            'role' => 'Customer',
            'role_color' => 'bg-blue-50 text-blue-700 border-blue-200',
            'joined_date' => '14 Mar 2026',
            'status' => 'Active',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
        ],
        [
            'id' => 3,
            'name' => 'Eric Mugisha',
            'email' => 'eric.m@example.com',
            'role' => 'Customer',
            'role_color' => 'bg-blue-50 text-blue-700 border-blue-200',
            'joined_date' => '05 May 2026',
            'status' => 'Suspended',
            'status_color' => 'bg-red-50 text-red-700 border-red-200'
        ],
        [
            'id' => 4,
            'name' => 'Marie Claire',
            'email' => 'marie@example.com',
            'role' => 'Customer',
            'role_color' => 'bg-blue-50 text-blue-700 border-blue-200',
            'joined_date' => '22 Jun 2026',
            'status' => 'Active',
            'status_color' => 'bg-emerald-50 text-emerald-700 border-emerald-200'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-600 block mb-2">Staff &
                    Clientele</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">User Management</h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Review authenticated accounts, assign system access privilege levels, and manage structural permissions.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // USER REGISTRY v1.0
            </div>
        </div>

        <!-- Search & Info Bar -->
        <div
            class="bg-white p-4 border border-neutral-200 rounded-none flex flex-col sm:flex-row items-center justify-between gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)]">
            <div class="w-full sm:w-72">
                <input type="text" placeholder="Search by name or email address..."
                    class="w-full border border-neutral-300 rounded-none bg-white px-4 py-2 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-amber-500 transition-colors">
            </div>
            <div class="text-xs uppercase tracking-wider text-neutral-500 font-semibold">
                Total Database Records: <span class="text-neutral-900 font-bold ml-1">{{ count($systemUsers) }}
                    Accounts</span>
            </div>
        </div>

        <!-- Main Users Datatable Grid -->
        <div
            class="bg-white border border-neutral-200 rounded-none overflow-hidden flex flex-col shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-neutral-50 text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
                        <tr>
                            <th class="px-6 py-4 font-medium">User Details</th>
                            <th class="px-6 py-4 font-medium">Privilege Role</th>
                            <th class="px-6 py-4 font-medium">Registration Date</th>
                            <th class="px-6 py-4 font-medium">Account Status</th>
                            <th class="px-6 py-4 font-medium text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-neutral-100 text-neutral-700">
                        @foreach($systemUsers as $user)
                            <tr class="group hover:bg-neutral-50/60 transition-all duration-300">

                                <!-- User Information Stack -->
                                <td class="px-6 py-5">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-semibold text-neutral-900">{{ $user['name'] }}</span>
                                        <span class="text-xs text-neutral-400 mt-0.5 tracking-tight">{{ $user['email'] }}</span>
                                    </div>
                                </td>

                                <!-- Assigned System Role Badge -->
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $user['role_color'] }} rounded-none">
                                        {{ $user['role'] }}
                                    </span>
                                </td>

                                <!-- Registration Date -->
                                <td class="px-6 py-5 text-xs text-neutral-500 font-mono">
                                    {{ $user['joined_date'] }}
                                </td>

                                <!-- Account Access Activity Status -->
                                <td class="px-6 py-5">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $user['status_color'] }} rounded-none">
                                        {{ $user['status'] }}
                                    </span>
                                </td>

                                <!-- Action Management Matrix Elements -->
                                <td class="px-6 py-5 text-right text-xs uppercase tracking-wider font-medium">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#" class="text-amber-600 hover:text-neutral-900 transition-colors">Edit
                                            Permissions</a>
                                        <span class="text-neutral-200">|</span>
                                        <button type="button"
                                            class="text-red-600 hover:text-neutral-950 transition-colors font-medium">
                                            Suspend Account
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer & Pagination -->
            <div
                class="px-6 py-4 bg-neutral-50 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-500 font-medium">
                <span>Showing 1 to {{ count($systemUsers) }} of {{ count($systemUsers) }} accounts</span>
                <div class="inline-flex items-center gap-2">
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">
                        Previous
                    </button>
                    <button type="button" disabled
                        class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">
                        Next
                    </button>
                </div>
            </div>
        </div>

        <!-- Footer Line -->
        <div class="text-center flex flex-col items-center justify-center space-y-2 pt-6">
            <div class="w-12 h-px bg-gradient-to-r from-transparent via-amber-500 to-transparent"></div>
            <span class="text-[9px] font-mono text-neutral-400 tracking-[0.25em] uppercase block">
                Maison Security Pipeline // SSL Verified
            </span>
        </div>

    </div>
@endsection