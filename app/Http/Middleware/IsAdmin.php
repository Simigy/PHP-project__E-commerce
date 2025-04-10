<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Allow direct access to admin assets
        if (str_contains($request->path(), 'Admin/assets/')) {
            return $next($request);
        }

        // Enhanced verbose logging
        Log::info('Admin Middleware Check', [
            'is_authenticated' => Auth::check(),
            'user_role' => Auth::check() ? Auth::user()->role : 'Not authenticated',
            'session_role' => session()->get('user_role'),
            'path' => $request->path(),
            'fullUrl' => $request->fullUrl(),
            'method' => $request->method(),
            'ip' => $request->ip(),
            'headers' => $request->headers->all(),
            'user' => Auth::check() ? [
                'id' => Auth::user()->id,
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role
            ] : null
        ]);

        if (Auth::check() && Auth::user()->role === "admin") {
            session()->put('user_role', 'admin');
            Log::info('Admin authenticated successfully', [
                'user_id' => Auth::id(),
                'path' => $request->path()
            ]);
            return $next($request);
        }

        session()->forget('user_role');
        Log::warning('Admin access denied', [
            'authenticated' => Auth::check(),
            'path' => $request->path(),
            'user_info' => Auth::check() ? [
                'id' => Auth::id(),
                'name' => Auth::user()->name,
                'email' => Auth::user()->email,
                'role' => Auth::user()->role
            ] : 'Not authenticated'
        ]);

        return redirect()->route('login')
            ->with('error', 'You must be an administrator to access this area.');
    }
}
