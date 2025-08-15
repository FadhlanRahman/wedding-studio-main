<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan punya role admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            // Kalau bukan admin, kembalikan ke halaman login atau home
            return redirect('/admin')->with('error', 'Akses ditolak, hanya admin yang bisa masuk.');
        }

        return $next($request);
    }
}
