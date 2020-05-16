<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckActive
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()->active)
        {
            Auth::logout();
            return abort(403, 'Your Account Has Been Disabled');
        }
        return $next($request);
    }
}
