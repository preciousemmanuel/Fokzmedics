<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use Illuminate\Support\Facades\DB;
class UpdateLastActive
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
         
       DB::table('users')
            ->where('id', auth()->user()->id)
            ->update(['last_active'=>date("Y-m-d H:i:s", strtotime("+1 hours"))]);
        return $next($request);
    }
}
