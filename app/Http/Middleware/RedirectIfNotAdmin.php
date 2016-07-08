<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RedirectIfNotAdmin
{
    /**
     * [handle description]
     * @param  string  $request [description]
     * @param  Closure $next    [description]
     * @param  string  $guard   [description]
     * @return [type]           [description]
     */
    public function handle($request, Closure $next, $guard = 'admin')
    {
        if (!Auth::guard($guard)->check()) {
            return redirect('/admin/login');
        }

        return $next($request);
    }
}
