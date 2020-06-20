<?php

namespace App\Http\Middleware;

use Closure;


class isSetType
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
        //this middleware check if user has set the type ie patient,doctor etc
        if (empty(auth()->user()->type)) {
            return redirect()->route('choose_type');
        }
        return $next($request);
    }
}
