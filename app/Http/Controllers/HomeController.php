<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
        $this->middleware('isSetType')->only('index');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //this function will redirect login user to their respective sections
        $type=auth()->user()->type;
        if ($type==1) {
            //user is patient
            return redirect()->route('patient.index');
        } elseif ($type==2) {
            # doctor...
            return redirect()->route('doctor.index');
        }elseif ($type==3) {
            # pharmacist
            return redirect()->route('pharmacy.index');
        }elseif ($type==4) {
            # diagnostics
            return redirect()->route('diagnostic.index');
        }elseif ($type==5) {
            # freelancer...
            return redirect()->route('freelancer.index');
        }elseif ($type==6) {
            # freelancer...
            return redirect()->route('admin.index');
        } elseif ($type==7) {
            # freelancer...
            return redirect()->route('hypaac.index');
        }  
    }
    public function getUserByEmail($email){
        return User::where('email',$email)->first();
    }
    public function updateUserType(User $user){
        $this->validate(request(),[
        'type'=>'required'
      ]);

        $request=request()->all();

        $user->type=$request['type'];
        $user->save();
        $userReferal=$user->referal;
       // dd($userReferal);
        session()->flash('success',"User updated successfully");
        if (!empty($userReferal)) {
            $refree=$this->getUserByEmail($userReferal);
            if ($refree->type==2 || $refree==5) {
                # refree is a doctor or freelancer, redirect to their page
                return redirect()->route('viewPractitioner',$refree->id);
            }
        }
        
        return redirect()->route('home');
    }
    public function updatePassword(User $user){
        $this->validate(request(),[
        'password'=>'min:6|required_with:confirmPassword|same:confirmPassword',
        'confirmPassword'=>'min:6'
      ]);

        $request=request()->all();

        $user->password=Hash::make($request['password']);
        $user->save();
        session()->flash('success',"Password updated successfully");
        $role=auth()->user()->type;
         if ($role==1) {
               
                return redirect()->route('patient.index');
            }elseif ($role==2) {
               
               return redirect()->route('doctor.index');
            }elseif ($role==3) {
               
               return redirect()->route('pharmacy.index');
            }elseif ($role==4) {
                //diagnostic partner
               return redirect()->route('doctor.index');
            } elseif ($role==5) {
                
               return redirect()->route('freelancer.index');
            }else {
                # code...
            }
        //return redirect()->route('home');
    }

    public function getCity(Request $request){
        $states = DB::table('states')->select('city')->where('names', $request->state)->get();
        return response()->json($states);
    }

    
}
