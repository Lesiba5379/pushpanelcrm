<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Beacon;
use DB;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;
use Illuminate\Database\Eloquent\Model;

class ApiController extends Controller
{
    protected $model = User::class;

    //get all data on the users table.
    public function getAccounts(){
        $users = \App\User::all();
        return $users;
    }


    //get all beacons from beacon table
    public function getBeacons(){
        $beacons = \App\Beacon::select
            ('id','uuid','created_at','updated_at','emp_id')->get();
        return $beacons;
    }

    public function getProfiles(){

        $companies = \App\User::whereRoleIs('administrator')->get();

        return $companies;
    }

    public function createUser(){

        return [
            'email' => 'required|email|unique:users',
            'name'  => 'required',

        ];
    }
    
    public function createProfile(){
                
         $name = $_POST['name'];
         $email = $_POST['email'];
         $status = $_POST['status'];
         $password = 'password';


         $data = array(
            'name'=>$name,
            'email'=>$email,
            'password'=>$password,
            'status' => $status
        );


        //create user and attach role.
        $user = User::create($data);
        $user->attachRole('administrator');

    }

    public function createBeacon(){

        $uuid = $_POST['uuid'];
        $personnel = $_POST['personnel'];

    }

}
