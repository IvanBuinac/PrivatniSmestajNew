<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role=NULL, $permission=NULL)
    {
        if (Auth::guest()) {
            return redirect(route("login"));
        }
        if(isset($role)) {
            if (!$request->user()->hasRole($role)) {
                abort(403);
            }
        }
        if(isset($permission)) {
            if (!$request->user()->can($permission)) {
                abort(403);
            }
        }
        return $next($request);
    }
}
