<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use App;

class TestController extends Controller
{

    //laravel trait for registering users

    use RegistersUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Create a new user instance after a valid registration.
     * 
     * @return \App\User
     */
    public function registerUser(Request $request){

        return $request;
        
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:users'
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = 'Password';
        
        $data = array(
            'name'=>$name,
            'email'=>$email,
            'password'=>bcrypt($password)
        );

        $user = User::create($data);

        $user->attachRole('client');
        
    }

    /**
     * Get the proper failed validation response for the request.
     *
     * @param  array  $errors
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function response(array $errors)
    {
        //This will always return JSON object error messages
        return new JsonResponse($errors, 422);
    }

    public function envFile(){
        
        //false
        //$env = 0;

        $app = App::environment('production');
        $env = '';

        if($app){
            $env = 'username: ' . $_ENV['MAIL_USERNAME'] . ' ' . 'password: ' . $_ENV['MAIL_PASSWORD'];
        }else{
            $env = 'empty';
        }

        //return var_dump($app);

        return view('test',compact('env'));
    }
}
