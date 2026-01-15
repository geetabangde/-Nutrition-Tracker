<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!Auth::guard('admin')->check()) {
            return redirect()->route('admin.login');
        }

        $user = Auth::guard('admin')->user();

        // roles string → int
        $allowedRoles = array_map('intval', $roles);

        if (!in_array((int) $user->role_id, $allowedRoles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }

}