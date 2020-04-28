<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserType
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$type)
    {
        if (!auth()->user()->isUserType($type)) {
            session()->flash('error',"Oops! Unauthorized access!!");
            return redirect()->route('home');
        }
        return $next($request);
    }
}
