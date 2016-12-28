<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckRoles
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
    $roles = explode('|', $role);
    foreach($roles as $role) {
        if(Auth::check() && Auth::user()->hasRole($role)){
            return $next($request);
        }
    }
        /*flash()->error('Error 404!: Please ensure that you have sufficient access');
        return back();*/
        flash()->error('Error 404!: Insufficient Access!', 'Error 404:');
        return back();

        return $next($request);
    }
}
