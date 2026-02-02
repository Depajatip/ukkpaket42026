<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAnggota
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
public function handle($request, Closure $next)
{
    if (!auth()->user()->anggota) {
        return redirect('/dashboard')
            ->with('error', 'Anda harus menjadi anggota untuk meminjam buku.');
    }

    return $next($request);
}
}
