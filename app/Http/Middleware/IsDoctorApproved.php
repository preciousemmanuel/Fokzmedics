<?php

namespace App\Http\Middleware;

use Closure;

class IsDoctorApproved
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
        if (!auth()->user()->isApproved()) {
            
         if ($role==1) {
                session()->flash('error',"You have not been approved, wait to be approved");
                return redirect()->route('patient.index');
            }elseif ($role==2) {
                session()->flash('error',"You have not been approved,please upload your licence if you haven't done so or wait to be approved");
               return redirect()->route('doctor.index');
            }elseif ($role==3) {
                session()->flash('error',"You have not been approved,please upload your licence if you haven't done so or wait to be approved");
               return redirect()->route('pharmacy.index');
            }elseif ($role==4) {
                //diagnostic partner
                 session()->flash('error',"You have not been approved,please upload your licence if you haven't done so or wait to be approved");
               return redirect()->route('diagnostic.index');
            } elseif ($role==5) {
                session()->flash('error',"You have not been approved, wait to be approved");
               return redirect()->route('freelancer.index');
            }else {
                # code...
            }
        }
        return $next($request);
        
        
    }
}
