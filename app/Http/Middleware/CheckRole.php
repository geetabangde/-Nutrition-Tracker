<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::guard('admin')->user();

        if (!$user) {
            return redirect()->route('admin.login');
        }
        
        $roles = array_map('intval', $roles);

        if (!in_array($user->role_id, $roles)) {
            Auth::guard('admin')->logout();
            return redirect()->route('admin.login')->withErrors('Unauthorized access.');
        }

        return $next($request);
    }
}
