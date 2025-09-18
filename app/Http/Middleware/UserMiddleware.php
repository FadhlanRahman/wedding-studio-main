<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika belum login, arahkan ke login
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Jika login tapi bukan user, arahkan ke dashboard admin
        if (Auth::user()->role !== 'user') {
            return redirect()->route('admin.dashboard')->with('error', 'Akses ditolak, hanya user yang bisa masuk.');
        }

        return $next($request);
    }
}
