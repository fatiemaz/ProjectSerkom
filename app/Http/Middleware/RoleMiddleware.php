<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, string ...$roles): Response
    {
        $user = $request->user();

        // Belum login: arahkan ke halaman login
        if (!$user) {
            return redirect()->route('login');
        }

        // Role tidak cocok: kembali ke dashboard dengan pesan
        if (!in_array($user->role, $roles, true)) {
            return redirect()
                ->route('admin.dashboard')
                ->with('error', 'Anda tidak punya akses ke halaman tersebut.');
        }

        return $next($request);
    }
}
