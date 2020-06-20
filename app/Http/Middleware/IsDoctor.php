<?php

namespace App\Http\Middleware;

use Closure;
use App\User;

class IsDoctor
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
        if(auth()->user()->type==2){
            return $next($request);
        }
        session()->flash('error',"Invalid access");
        return redirect(route('home'));
    }
}
