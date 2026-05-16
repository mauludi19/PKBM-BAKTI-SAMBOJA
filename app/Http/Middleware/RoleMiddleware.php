<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(
        Request $request,
        Closure $next,
        string ...$roles
    ): Response {
        // Cek apakah user sudah login
        if (!Auth::check()) {
            abort(403, 'Unauthorized');
        }

        // Ambil user yang sedang login
        $user = Auth::user();

        // Cek apakah role user termasuk role yang diizinkan
        if (!in_array($user->role, $roles)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}