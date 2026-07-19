<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the authenticated system users.
     */
    public function index(Request $request)
    {
        // 1. Initialize query builder
        $query = User::query();

        // 2. Add real-time structural search filtration
        if ($request->has('search') && !empty($request->search)) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 3. Fetch database records cleanly
        $rawUsers = $query->latest()->get();

        // 4. Transform rows into the exact data token array structure your view expects
        $systemUsers = $rawUsers->map(function ($user) {
            // Normalize inputs in case database entries are lowercase
            $userRole = strtolower($user->role ?? 'customer');
            $userStatus = strtolower($user->status ?? 'active');

            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $userRole === 'admin' ? 'Administrator' : ucfirst($userRole),
                'role_color' => $this->getRoleStyles($userRole),
                'joined_date' => $user->created_at ? $user->created_at->format('d M Y') : 'N/A',
                'status' => ucfirst($userStatus),
                'status_color' => $this->getStatusStyles($userStatus)
            ];
        });

        return view('admin.users.index', compact('systemUsers'));
    }

    /**
     * Map security access privilege color tokens.
     */
    private function getRoleStyles(string $role): string
    {
        return match ($role) {
            'admin', 'administrator' => 'bg-purple-50 text-purple-700 border-purple-200',
            'editor', 'manager'      => 'bg-amber-50 text-amber-700 border-amber-200',
            default                  => 'bg-blue-50 text-blue-700 border-blue-200', // Customer fallback
        };
    }

    /**
     * Map account suspension and activity color tokens.
     */
    private function getStatusStyles(string $status): string
    {
        return match ($status) {
            'active'             => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'suspended', 'banned' => 'bg-red-50 text-red-700 border-red-200',
            default              => 'bg-stone-50 text-stone-700 border-stone-200',
        };
    }

    /**
     * Toggle user account activity status between active and suspended.
     */
    public function toggleStatus(User $user)
    {
        $user->status = ($user->status === 'suspended') ? 'active' : 'suspended';
        $user->save();

        return back()->with('success', "Account for {$user->name} has been updated.");
    }

    /**
     * Handle incoming payload to update role privileges from the modal.
     */
    public function updatePermissions(Request $request, User $user)
    {
        $validated = $request->validate([
            'role' => 'required|string|in:admin,customer,editor'
        ]);

        $user->role = $validated['role'];
        $user->save();

        return back()->with('success', "Permissions updated for {$user->name}.");
    }
}
