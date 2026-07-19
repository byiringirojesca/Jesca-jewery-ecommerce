@extends('layouts.admin')

@section('content')
    <div x-data="{ 
        modalOpen: false, 
        activeUser: { id: '', name: '', role: '' },
        openEditModal(user) {
            this.activeUser = { ...user };
            this.modalOpen = true;
        }
    }" class="max-w-auto mx-auto space-y-12 p-2 sm:p-6 text-neutral-800 tracking-normal relative">

        <!-- Header Section -->
        <div class="flex flex-col sm:flex-row sm:items-end justify-between border-b border-neutral-200 pb-8 gap-6">
            <div class="max-w-xl">
                <span class="text-[10px] uppercase tracking-[0.3em] font-semibold text-amber-600 block mb-2">Staff & Clientele</span>
                <h1 class="font-serif text-4xl sm:text-5xl font-light tracking-wide text-neutral-900">User Management</h1>
                <p class="font-serif italic text-base text-neutral-500 mt-2 font-light leading-relaxed">
                    Review authenticated accounts, assign system access privilege levels, and manage structural permissions.
                </p>
            </div>
            <div class="text-left sm:text-right font-mono text-[10px] tracking-widest text-neutral-400 whitespace-nowrap">
                // USER REGISTRY v1.1
            </div>
        </div>

        <!-- Search & Info Bar -->
        <div class="bg-white p-4 border border-neutral-200 rounded-none flex flex-col sm:flex-row items-center justify-between gap-4 shadow-[0_4px_20px_-10px_rgba(0,0,0,0.03)]">
            <div class="w-full sm:w-72">
                <form action="{{ route('admin.users.index') }}" method="GET">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or email address..."
                        class="w-full border border-neutral-300 rounded-none bg-white px-4 py-2 text-sm text-neutral-800 placeholder-neutral-400 focus:outline-none focus:border-amber-500 transition-colors"
                        onchange="this.form.submit()">
                </form>
            </div>
            <div class="text-xs uppercase tracking-wider text-neutral-500 font-semibold">
                Total Database Records: <span class="text-neutral-900 font-bold ml-1">{{ count($systemUsers) }} Accounts</span>
            </div>
        </div>

        <!-- Main Users Datatable Grid -->
        <div class="bg-white border border-neutral-200 rounded-none overflow-hidden flex flex-col shadow-[0_4px_25px_-12px_rgba(0,0,0,0.05)]">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm whitespace-nowrap">
                    <thead class="bg-neutral-50 text-[10px] text-neutral-400 uppercase tracking-[0.2em] font-semibold border-b border-neutral-200">
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
                                    <span class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $user['role_color'] }} rounded-none">
                                        {{ $user['role'] }}
                                    </span>
                                </td>

                                <!-- Registration Date -->
                                <td class="px-6 py-5 text-xs text-neutral-500 font-mono">
                                    {{ $user['joined_date'] }}
                                </td>

                                <!-- Account Access Activity Status -->
                                <td class="px-6 py-5">
                                    <span class="inline-flex items-center px-2.5 py-0.5 text-[10px] uppercase tracking-wider font-semibold border {{ $user['status_color'] }} rounded-none">
                                        {{ $user['status'] }}
                                    </span>
                                </td>

                                <!-- Action Management Matrix Elements with SVGs -->
                                <td class="px-6 py-5 text-right text-xs uppercase tracking-wider font-medium">
                                    <div class="inline-flex items-center justify-end gap-4 w-full">
                                        
                                        <!-- Open Permissions Dialog Trigger Button -->
                                        <button type="button" 
                                            @click="openEditModal({ id: '{{ $user['id'] }}', name: '{{ addslashes($user['name']) }}', role: '{{ strtolower($user['role']) }}' })"
                                            class="text-amber-600 hover:text-amber-800 transition-colors inline-flex items-center gap-1.5 group/btn" 
                                            title="Edit Access Permissions">
                                            <svg class="w-4 h-4 transform group-hover/btn:scale-105 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 1 1-3 0m3 0a1.5 1.5 0 1 0-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 0 1-3 0m3 0a1.5 1.5 0 0 0-3 0m-9.75 0h9.75" />
                                            </svg>
                                            <span class="hidden md:inline text-[11px] tracking-wide font-semibold">Permissions</span>
                                        </button>

                                        <span class="text-neutral-200 hidden md:inline">|</span>

                                        <!-- Functional Status Action Form Block -->
                                        <form action="{{ route('admin.users.toggle-status', $user['id']) }}" method="POST" 
                                            onsubmit="return confirm('Are you sure you want to alter the security clearance status for {{ addslashes($user['name']) }}?');"
                                            class="inline-block">
                                            @csrf
                                            @method('PATCH')
                                            
                                            <button type="submit" 
                                                class="{{ $user['status'] === 'Suspended' ? 'text-emerald-600 hover:text-emerald-800' : 'text-red-600 hover:text-red-800' }} transition-colors inline-flex items-center gap-1.5 group/btn"
                                                title="{{ $user['status'] === 'Suspended' ? 'Restore Account Clearances' : 'Suspend Account' }}">
                                                @if($user['status'] === 'Suspended')
                                                    <!-- Restore Activity Icon -->
                                                    <svg class="w-4 h-4 transform group-hover/btn:scale-105 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                                    </svg>
                                                    <span class="hidden md:inline text-[11px] tracking-wide font-semibold">Activate</span>
                                                @else
                                                    <!-- Suspend Account Icon -->
                                                    <svg class="w-4 h-4 transform group-hover/btn:scale-105 transition-transform" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" d="M18.364 18.364A9 9 0 0 0 5.636 5.636m12.728 12.728A9 9 0 0 1 5.636 5.636m12.728 12.728L5.636 5.636" />
                                                    </svg>
                                                    <span class="hidden md:inline text-[11px] tracking-wide font-semibold">Suspend</span>
                                                @endif
                                            </button>
                                        </form>

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Table Footer & Pagination -->
            <div class="px-6 py-4 bg-neutral-50 border-t border-neutral-100 flex flex-col sm:flex-row items-center justify-between gap-4 text-xs text-neutral-500 font-medium">
                <span>Showing 1 to {{ count($systemUsers) }} of {{ count($systemUsers) }} accounts</span>
                <div class="inline-flex items-center gap-2">
                    <button type="button" disabled class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">Previous</button>
                    <button type="button" disabled class="px-3 py-1.5 border border-neutral-200 bg-white text-neutral-300 cursor-not-allowed text-[10px] uppercase tracking-wider font-semibold">Next</button>
                </div>
            </div>
        </div>

        <!-- MODERN BRUTALIST DIALOG PANEL MODAL -->
        <div x-show="modalOpen" 
            class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-neutral-950/40 backdrop-blur-sm"
            style="display: none;"
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0">
            
            <!-- Modal Body Area -->
            <div @click.away="modalOpen = false" 
                class="w-full max-w-md bg-white border border-neutral-200 shadow-xl p-6 sm:p-8 rounded-none flex flex-col space-y-6"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4"
                x-transition:enter-end="opacity-100 translate-y-0">
                
                <div class="flex items-start justify-between border-b border-neutral-100 pb-4">
                    <div>
                        <span class="text-[9px] uppercase tracking-widest font-bold text-amber-600 block mb-1">Access Protocol</span>
                        <h3 class="font-serif text-xl text-neutral-900 font-medium">Adjust Clearances</h3>
                    </div>
                    <button @click="modalOpen = false" class="text-neutral-400 hover:text-neutral-900 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Update Target Matrix Data Form -->
                <form :action="`/admin/users/${activeUser.id}/permissions`" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div class="space-y-1">
                        <label class="text-[10px] uppercase tracking-wider font-bold text-neutral-400 block">User Account Target</label>
                        <div class="text-sm font-semibold text-neutral-800 bg-neutral-50 px-3 py-2 border border-neutral-200 font-mono" x-text="activeUser.name"></div>
                    </div>

                    <div class="space-y-1.5">
                        <label for="role-select" class="text-[10px] uppercase tracking-wider font-bold text-neutral-400 block">Assigned Security Role</label>
                        <select id="role-select" name="role" x-model="activeUser.role" 
                            class="w-full border border-neutral-300 rounded-none bg-white px-3 py-2 text-sm text-neutral-800 focus:outline-none focus:border-amber-500 transition-colors uppercase tracking-wide text-xs font-semibold">
                            <option value="customer">Customer Access Matrix</option>
                            <option value="editor">Editor Access Matrix</option>
                            <option value="admin">Administrator Full-Clearance</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end gap-3 pt-2">
                        <button type="button" @click="modalOpen = false"
                            class="px-4 py-2 border border-neutral-200 text-neutral-500 hover:text-neutral-800 text-[11px] uppercase tracking-wider font-semibold transition-colors">
                            Cancel Changes
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-neutral-900 hover:bg-neutral-800 text-white text-[11px] uppercase tracking-wider font-semibold transition-colors shadow-sm">
                            Save Permissions
                        </button>
                    </div>
                </form>
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