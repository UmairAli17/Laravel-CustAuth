<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRolePermissions
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if(Auth::user()->hasRole($role . '-access')){
            return $next($request);
        }
        else
        {
            return response('You do not have the correct permissions to access this resource', 401);
        }

        return $next($request);
    }
}
