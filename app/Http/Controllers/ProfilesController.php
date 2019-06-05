<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Profile;
use Auth;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
          
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'address_1'=>'required',
            'town_city'=>'required',
            'province'=>'required',
            'postal_code'=>'required',
            'telephone'=>'required',
            'mobile'=>'required',
            'contact_person'=>'required',
            'vat'=>'required'
        ]);
        
        $id = Auth::user()->id;

        $name = $request->input('name');
        $address_1 = $request->input('address_1');
        $town_city = $request->input('town_city');
        $province = $request->input('province');
        $postal_code = $request->input('postal_code');
        $tel = $request->input('telephone');
        $mobile = $request->input('mobile');
        $contact_person = $request->input('contact_person');
        $vat = $request->input('vat');
        
        $profile = new Profile();

        $profile->company_name = $name;
        $profile->address = $address_1;
        $profile->town = $town_city;
        $profile->province = $province;
        $profile->postal_code = $postal_code;
        $profile->telephone = $tel;
        $profile->mobile = $mobile;
        $profile->contact_person = $contact_person;
        $profile->vat = $vat;
        $profile->active = '0';
        $profile->user_id = $id;
        $profile->save();


        $user = \App\User::find($id);
        $user->profile()->save($profile);

        return redirect('/profile')->with('success','Profile create.');




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
        $profile = \App\Profile::all();

        return view('editProfile',compact('profile'));
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
        $profile = \App\Profile::find($id);

        $name = $request->input('name');
        $address_1 = $request->input('address_1');
        $town_city = $request->input('town_city');
        $province = $request->input('province');
        $postal_code = $request->input('postal_code');
        $tel = $request->input('telephone');
        $mobile = $request->input('mobile');
        $contact_person = $request->input('contact_person');
        $vat = $request->input('vat');

        $profile->company_name = $name;
        $profile->address = $address_1;
        $profile->town = $town_city;
        $profile->province = $province;
        $profile->postal_code = $postal_code;
        $profile->telephone = $tel;
        $profile->mobile = $mobile;
        $profile->contact_person = $contact_person;
        $profile->vat = $vat;

        $profile->save();

        return redirect('/home')->with('success','Profile updated.');

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
