<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class DashboardAccess
{

    public function handle($request, Closure $next)
    {
        if (Auth::check() && ($request->user()->dashboard_enable == 1)) {
            return $next($request);
        }
        //abort(404);
        return redirect('/');
    }
}
