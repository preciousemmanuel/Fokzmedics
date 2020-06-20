<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Socialite;

use App\User;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */


    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $referal='';
    private $redirect='';
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // check if authenticated, then redirect to dashboard
protected function authenticated(Request $request, User $user) {
  if (!empty($request->redirect)) {
    return redirect($request->redirect);
  }
  return redirect($this->redirectTo);
}

    public function redirectToProvider(Request $request,$provider)
    {
     // dd($request);
      $this->referal=(isset($request->referal) && !empty($request->referal))?session(["referal"=>$request->referal]):'';
      $this->redirect=(isset($request->redirect) && !empty($request->redirect))?session(["redirect"=>$request->redirect]):'';
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
     
      if (session()->exists('referal')) {
         //dd(session("referal"));
        //new user
        $referal=session("referal");
        session()->forget(['referal']);
      }else{
        $referal=NULL;
      }
        try {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            // $user->token;
            $user=User::where('email',$socialUser->getEmail())->first();
            if ($user) {
                //there is user with this email
                auth()->login($user,true);
                if (session()->exists('redirect')) {
              
                $redirect=session("redirect");
                session()->forget(['redirect']);
                return redirect($redirect);
              
             
            }

            } else {
                //create new user
                $newUser=User::create([
                    "email"=>$socialUser->getEmail(),
                    "provider_id"=>$socialUser->getId(),
                    "fullname"=>$socialUser->getName(),
                    "image"=>$socialUser->getAvatar(),
                    "provider"=>$provider,
                    "email_verified_at"=>date("Y-m-d H:i:s"),
                    "referal"=>$referal
                ]);
              auth()->login($newUser,true);  
            }
            //new user
            
            session()->forget(['redirect']);
            return redirect($this->redirectTo);
        } catch (Exception $e) {
           return redirect('/login');
        }
        
    }
}
