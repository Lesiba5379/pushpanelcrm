<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;
use \App\User;

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
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated (Request $request, $user) {
        if ($user-> hasRole('superadministrator')){
            return redirect()-> route('home'); 
        
        }

        if ($user-> hasRole('administrator')){
            return redirect()-> route('home'); 
        
        }

        if ($user-> hasRole('client')){
            return redirect()-> route('campaign'); 
        
        }
    }

    //redirect users to another page after logout
    
    /*public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
    }*/

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
     protected function credentials(Request $request){
         $credentials = $request->only($this->username(), 'password');
         return array_add($credentials,'status',''); //1 means all is fine and can login.
     }

}
