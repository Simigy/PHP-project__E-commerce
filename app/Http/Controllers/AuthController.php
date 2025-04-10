<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Laravel\Fortify\Fortify;

class AuthController extends Controller
{
    public function redirect()
    {
        try {
            if (!Auth::check()) {
                Log::info('User not authenticated, redirecting to login');
                return redirect()->route('login');
            }

            $user = Auth::user();
            Log::info('User authenticated', ['user' => $user->toArray()]);
            
            if ($user->role === 'admin') {
                Log::info('Admin user detected, redirecting to corona dashboard');
                session()->put('user_role', 'admin');
                return redirect()->route('admin.corona');
            }
            
            Log::info('Regular user detected, redirecting to user products');
            session()->put('user_role', 'user');
            return redirect()->route('user-all-products');
            
        } catch (\Exception $e) {
            Log::error('Error in redirect method', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect()->route('login')
                ->with('error', 'An error occurred. Please try again.');
        }
    }

    public function logout(Request $request)
    {
        Log::info('User logging out', ['user' => Auth::user() ? Auth::user()->toArray() : null]);
        
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
        
        return redirect()->route('login')
            ->with('status', 'You have been logged out successfully.');
    }
}
