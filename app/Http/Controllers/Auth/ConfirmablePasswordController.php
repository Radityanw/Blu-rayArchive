<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class ConfirmablePasswordController extends Controller
{
    /**
     * Show the confirm password view.
     */
    public function show(): View
    {
        return view('auth.confirm-password');
    }

    /**
     * Confirm the user's password.
     */
    public function store(Request $request): RedirectResponse
    {
        if (! Auth::guard('web')->validate([
            'email' => $request->user()->email,
            'password' => $request->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }
    
        $request->session()->put('auth.password_confirmed_at', time());
    
        // Redirect based on user's role
        $role = $request->user()->role; // Assuming 'role' column is used to determine the role
        if ($role === 'admin') {
            return redirect()->intended(route('admindashboard', absolute: false));
        } elseif ($role === 'member') {
            return redirect()->intended(route('memberdashboard', absolute: false));
        }
    
        // Default fallback (optional, in case there's another role or an error)
        return redirect()->intended(route('defaultdashboard', absolute: false)); 
    }
}