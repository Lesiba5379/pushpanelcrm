<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        //preparing for client read
        

        $profiles= \App\Profile::all();

        $activeUsers = \App\User::where('status','=','')->get();
        $blockedUsers = \App\User::where('status','=','-1')->get();
        $beacons = \App\Beacon::all();
        $users = \App\User::all();
        
        $b = \App\Beacon::where('user_id',3)->get();
        
        $employees = \App\Employee::all();
        //$employees = \App\Employee::where('user_id','3')->get();
        $companies = \App\User::whereRoleIs('administrator')->get();
        
        return view('home',compact('profiles','activeUsers','blockedUsers','beacons','users','employees','companies','b'));
    }
    
}
