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
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
              // Cek apakah user sudah login dan punya role user
        if (!Auth::check() || Auth::user()->role !== 'user') {
            // Kalau bukan user, kembalikan ke halaman login atau home
            return redirect('/')->with('error', 'Akses ditolak, hanya user yang bisa masuk.');
        }

        return $next($request);
    }
}
