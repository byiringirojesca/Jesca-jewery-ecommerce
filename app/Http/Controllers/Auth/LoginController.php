<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    /**
     * Display the luxury client sign-in view.
     */
    public function showLoginForm()
    {
        return view('auth.login'); 
    }

    /**
     * Authenticate the incoming client identity credentials.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->status !== 'active') {
                Auth::logout();
                
                throw ValidationException::withMessages([
                    'email' => 'This profile authentication has been suspended. Please contact the atelier.',
                ]);
            }

            $request->session()->regenerate();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard'));
            }

            return redirect()->intended(route('home'))->with('success', 'Workspace authenticated successfully.');
        }

        // 6. Handle failure (Matches your view's $errors->first() element)
        throw ValidationException::withMessages([
            'email' => 'The provided credentials do not match our secure registry records.',
        ]);
    }

    /**
     * Terminate the secure client workspace session.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('info', 'Secure session terminated.');
    }
}