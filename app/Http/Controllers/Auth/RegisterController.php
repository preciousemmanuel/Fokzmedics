<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    
  protected function registered(Request $request, User $user) {
  if (!empty($request->redirect)) {
    return redirect($request->redirect);
  }
  return redirect($this->redirectTo);
}

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:5', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        // if ($data['refreral']) {
        //     $user=User::where('email',$data['referal'])->first();
        //     if ($user) {
        //         //there is referal
        //         $current_date=date('Y-m-d');
        //         $day_to_add=DB::table('site_config')->where('id',1)->first();
        //         $referal_end = date('Y-m-d', strtotime($current_date.' + '.$day_to_add->referal_end_date.' days'));
        //         return User::create([
        //     'fullname' => $data['name'],
        //     'email' => $data['email'],
        //     'type' => $data['type'],
        //     'referal' => $data['referal'],
        //     'referal_end' => $referal_end,   
        //     'password' => Hash::make($data['password']),
        // ]);
        //     } else {
        //         session()->flash('error',"Referal not found");
        //         return redirect()->route('register');
        //     }
            
        // }
        $referal="";
        $userReferal=User::where("email",$data['referal'])->first();
        if ($userReferal) {
            $referal=$userReferal->email;
        }
        if (!empty($data['redirect'])) {
           $emailVerify=now();
        } else {
            $emailVerify=null;
        }
        
        return User::create([
            'fullname' => $data['name'],
            'email' => $data['email'],
            'type' => $data['type'],
            'referal' => $referal,
            'approved'=>1,
            'password' => Hash::make($data['password']),
            "email_verified_at"=>$emailVerify
        ]);
    }
}
