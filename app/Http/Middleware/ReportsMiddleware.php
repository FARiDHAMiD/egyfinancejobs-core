<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ReportsMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::check() || !Auth::user()->hasRole('admin') || !in_array(Auth::id(), [1, 2])) { // allowed for user 1 and 2 only
            return redirect()->route('admin.login');
        }
        return $next($request);
    }
}
