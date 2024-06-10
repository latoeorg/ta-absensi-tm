<?php
// app/Http/Middleware/Superadmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Superadmin
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check() && Auth::user()->role === 'SUPERADMIN') {
            return $next($request);
        }

        return redirect('/home')->with('error', 'You do not have access to this page.');
    }
}
