<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\User;
use \App\Role;
use  \App\Employee;

/**
 * Author: Lesiba Nxumalo.
 * Desc: mostly interacts with the db{Push_Notty} tables.
 */
class ManageAccounts extends Controller
{

    /**
     * redirect to home page on success.
     */
    public function createCompany(Request $request){
        
        //return $request->input('name');

        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:users',           
        ]);

        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt('password');
        $status = '1';

        $data = array(
            'name'=>ucwords($name),
            'email'=>$email,
            'password'=>$password,
            'status' => $status
        );

        //create user and attach role.
        $user = User::create($data);
        $user->attachRole('client');
        
        $user->sendEmailVerificationNotification();

        return redirect('/home')->with('success','company created.');
        
    }


    public function updateCompany(Request $request){
        
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:users',           
        ]);

        $name = $request->input('name');
        $email = $request->input('email');

        return $name . ' ' . $email;



    }

   //returns a view
   public function returnCreateCompanyView(){
       return view('createCompany');
   }

    //return edit user form
    public function returnEditUserView($id){
        
        $user = \App\User::find($id);
        return view('editUser')->with('user',$user);
    }

    //return form for creating administrator.
    public function returnCreateAccountView(){
        return view('createAdmin');
    }

    /**
     * return user view
     */
    public function getAdminis(){

        $users = User::all();

        return view('/users')->with('users',$users);
    }
    
    /**
     * 
     */
    public function updateAccount(Request $request){
        
        return $request->input('id');

        //input validation
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:users',
            
        ]);

        return $user = \App\User::find($id);

        //get user inputs
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt('password');
        $userType = $request->input('superType');
        

        return redirect('/users')->with('success','company created.');

    }

    /**
     * create user, attach administrator role,
     * return success message
     */
    public function createAdministrator(Request $request){

        //input validation
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:users',
            
        ]);
       
        $name = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt('password');
        $userType = $request->input('superType');
        $status = '';

        $data = array(
            'name'=>ucwords($name), 
            'email'=>$email,
            'password'=>$password,
            'status'=> $status
        );
        
        $user = User::create($data);

        $user->sendEmailVerificationNotification();

        //default status
        $user->status = $status;

        if($userType == '0'){
            $user->attachRole('superadministrator');
        }

        if($userType == '1'){
            $user->attachRole('administrator');
        }

        if($userType == '2'){
            $user->attachRole('client');
        }
        

        return redirect('/home')->with('success','account created.');
    }
    
    /**
     * Delete company and detach role.
     * return string status message.
     */
    public function deleteCompany(){
        
        //get data from front-end
        $id = $_POST['id'];
        
        //db operations
        $user = \App\User::find($id);
        $user->delete();
        $user->detachRole($role);

        return '1';
    }
    
    /**
     * Delete user and detach role.
     * return string status message.
     */
    public function deleteUser(){
        
        //get data from front-end
        $id = $_POST['id'];
        $role = $_POST['role'];

        //db operations
        $user = \App\User::find($id);
        $user->delete();
        $user->detachRole($role);

        return '1';
    }
    
    /***
     * @return  { viewCompany blade view }
     */
    public function returnViewCompanyView($id){

        $company = \App\User::find($id);
        $emp = \App\Employee::all() ;
        $beacons = \App\Beacon::all();
        $b = \App\Beacon::where('emp_id',$id)->get();
         
        
        return view('viewCompany',compact('emp','beacons','b'))->with('company',$company);
    }

    /**
     * returns view
     */
    public function returnViewEmpView(){

       return view('viewEmp');
    }
   
    /**
     * 
     * writes employee data to the employee table.
     * 
     */
    public function addEmployee(Request $request){  
        
        
        //input validation { coming from the form }
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:employees', 
        ]);
       
        //get data from the form:
        $name = $request->input('name');
        $email = $request->input('email');
        $urlId = $request->input('urlId');

        //Employee class instatiation { object creation }
        $emp = new Employee();

    
        $emp->name = $name;
        $emp->email = $email;
        
        //foreign key association { relationship creation }
        $emp->user()->associate($urlId);

        $emp->save();

        return redirect('viewCompany/' . $urlId)->with('success','employee created. ');


    } 

}
