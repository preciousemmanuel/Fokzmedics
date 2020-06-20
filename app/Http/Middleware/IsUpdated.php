<?php

namespace App\Http\Middleware;

use Closure;

class IsUpdated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next,$role)
    {
        //check if user has update his profile
       if (!auth()->user()->isUpdated()) {
            session()->flash('error',"Please update your profile");
            if ($role==1) {
                return redirect()->route('patient.profile');
            }elseif ($role==2) {
               return redirect()->route('doctor.profile');
            }elseif ($role==3) {
               return redirect()->route('pharmacy.profile');
            }elseif ($role==4) {
               return redirect()->route('diagnostic.profile');
            } elseif ($role==5) {
               return redirect()->route('freelancer.profile');
            }else {
                # code...
            }
            
            
        }
        return $next($request);
        
    }
}
