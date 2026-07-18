@php
    // Quick admin users management tracking mock data layer
    $systemUsers = [
        [
            'id' => 1,
            'name' => 'Alice Umutoni',
            'email' => 'alice@example.com',
            'role' => 'Administrator',
            'role_color' => 'bg-purple-100 text-purple-800',
            'joined_date' => '12 Jan 2026',
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800'
        ],
        [
            'id' => 2,
            'name' => 'Jean Keza',
            'email' => 'jean.k@example.com',
            'role' => 'Customer',
            'role_color' => 'bg-blue-100 text-blue-800',
            'joined_date' => '14 Mar 2026',
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800'
        ],
        [
            'id' => 3,
            'name' => 'Eric Mugisha',
            'email' => 'eric.m@example.com',
            'role' => 'Customer',
            'role_color' => 'bg-blue-100 text-blue-800',
            'joined_date' => '05 May 2026',
            'status' => 'Suspended',
            'status_color' => 'bg-red-100 text-red-800'
        ],
        [
            'id' => 4,
            'name' => 'Marie Claire',
            'email' => 'marie@example.com',
            'role' => 'Customer',
            'role_color' => 'bg-blue-100 text-blue-800',
            'joined_date' => '22 Jun 2026',
            'status' => 'Active',
            'status_color' => 'bg-green-100 text-green-800'
        ]
    ];
@endphp

@extends('layouts.admin')

@section('content')
    <div class="space-y-6">

        <!-- Top Layout Header Row -->
        <div>
            <h1 class="text-3xl font-bold text-gray-900">User Management</h1>
            <p class="text-sm text-gray-500 mt-1">Review user accounts, assign system access privileges, and monitor account
                status metrics.</p>
        </div>

        <!-- Filtering Utilities Bar Component -->
        <div
            class="bg-white p-4 rounded-xl shadow-sm border border-gray-200 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="w-full sm:w-72">
                <input type="text" placeholder="Search by name or email address..."
                    class="w-full border border-gray-300 rounded-md px-4 py-2 text-sm focus:outline-none focus:border-amber-500">
            </div>
            <div class="text-sm text-gray-500 font-medium">
                Total Database Records: <span class="text-gray-900 font-bold">{{ count($systemUsers) }} Accounts</span>
            </div>
        </div>

        <!-- Main Datatable Framework Grid Container -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead
                        class="bg-gray-50 text-xs text-gray-400 uppercase tracking-wider font-semibold border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3.5">User Details</th>
                            <th class="px-6 py-3.5">System Privilege Role</th>
                            <th class="px-6 py-3.5">Registration Date</th>
                            <th class="px-6 py-3.5">Account Status</th>
                            <th class="px-6 py-3.5 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 text-gray-700 font-medium">
                        @foreach($systemUsers as $user)
                            <tr class="hover:bg-gray-50/50 transition-colors">

                                <!-- User Profiles Context Identification Stack -->
                                <td class="px-6 py-4">
                                    <div class="flex flex-col">
                                        <span class="text-sm font-bold text-gray-900">{{ $user['name'] }}</span>
                                        <span class="text-xs text-gray-400 font-normal">{{ $user['email'] }}</span>
                                    </div>
                                </td>

                                <!-- Assigned System Role Badges -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $user['role_color'] }}">
                                        {{ $user['role'] }}
                                    </span>
                                </td>

                                <!-- Timestamp Date Mapping -->
                                <td class="px-6 py-4 text-xs text-gray-500">
                                    {{ $user['joined_date'] }}
                                </td>

                                <!-- Account Access Activity Badges -->
                                <td class="px-6 py-4">
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold {{ $user['status_color'] }}">
                                        {{ $user['status'] }}
                                    </span>
                                </td>

                                <!-- Action Management Controls Elements -->
                                <td class="px-6 py-4 text-right text-xs">
                                    <div class="inline-flex items-center gap-3">
                                        <a href="#" class="text-amber-600 hover:text-amber-700 font-bold">Edit Permissions</a>
                                        <span class="text-gray-300">|</span>
                                        <button type="button" class="text-red-500 hover:text-red-600 font-bold">Suspend
                                            Account</button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Mock Pagination Tracker Footer Bar -->
            <div
                class="px-6 py-4 bg-gray-50 border-t border-gray-100 flex items-center justify-between text-xs text-gray-500 font-medium">
                <span>Showing 1 to {{ count($systemUsers) }} of {{ count($systemUsers) }} accounts</span>
                <div class="inline-flex items-center gap-1">
                    <button type="button" disabled
                        class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Previous</button>
                    <button type="button" disabled
                        class="px-2 py-1 border border-gray-200 rounded bg-white text-gray-300 cursor-not-allowed">Next</button>
                </div>
            </div>
        </div>
    </div>
@endsection