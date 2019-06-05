<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Profile;
use Illuminate\Foundation\Auth\RegistersUsers;

/***
 * Author: Lesiba Nxumalo
 * Desc: Custom user registration, role attachment
 *       and user/profile linking.
 */
class CreateProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Create a user and profile then assign role.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  

        //user reg validation
        $this->validate($request,[
            'name'=>'required|string|max:255',
            'email'=>'required|string||email|max:255|unique:users',
            
        ]);
         
        //get inputs for reg user.
        $username = $request->input('name');
        $email = $request->input('email');
        $password = bcrypt('password');
        

        $name = 'default value';
        
        //get inputs for create profile.
        $address = $request->input('address_1');
        $town = $request->input('town_city');
        $province = $request->input('province');
        $postal_code = $request->input('postal_code');
        $tel = $request->input('telephone');
        $mob = $request->input('mobile');
        $cont = $request->input('contact_person');
        $vat = $request->input('vat');
        $active = '0';
       

        $data = array(
             'name'=>$username,
             'email'=>$email,
             'password'=>$password
        );
        
        //register user and attach role and get last insert id.

        $user = User::create($data);
        $user->attachRole('client');
        $user_id = $user->id; 

        //Model Class Instatiation.

        $profile = new Profile();
        
        $profile->company_name = $name;
        $profile->address = $address;
        $profile->town = $town;
        $profile->province = $province;
        $profile->postal_code = $postal_code;
        $profile->telephone = $tel;
        $profile->mobile = $mob;
        $profile->contact_person = $cont;
        $profile->vat = $vat;
        $profile->user_id = $user_id;
        $profile->active = $active;

        $profile->save();        
        
        return redirect('/profile')->with('success','profiile created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
