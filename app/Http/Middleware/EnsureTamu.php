<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTamu
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! $request->user() || ! $request->user()->isTamu()) {
            abort(403, 'Halaman ini hanya untuk tamu terdaftar.');
        }

        return $next($request);
    }
}