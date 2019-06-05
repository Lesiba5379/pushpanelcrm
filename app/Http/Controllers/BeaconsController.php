<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Beacon;

class BeaconsController extends Controller
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
       
       //I think this one is self expl.
       $this->validate($request,[
          'uuid'=>'required',
          'selectProduct'=>'required'
       ]);
       
       //get user data.
       $IBeaconUUID = $request->input('IBeaconUUID');
       $EddystoneNamespace = $request->input('EddystoneNamespace'); 
       $uuid = $request->input('uuid');
       $product = json_encode($request->input('selectProduct'));

       //foreign key for one to many relationship.
       $user_id = $request->input('assignTo')[0];
       
       $user_id;

       $beacon = new Beacon();

       $beacon->IBeaconUUID = $IBeaconUUID;
       $beacon->EddystoneNamespace = $EddystoneNamespace;
       $beacon->uuid = $uuid;
       $beacon->product = $product;
       $beacon->user_id = $user_id;
       $beacon->emp_id = null;

       //create relationship.
       $beacon->user()->associate($user_id);
       
       $beacon->save();

       return redirect('/addBeacon')->with('success','Beacon added.');
         
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $beacon = \App\Beacon::find($id);

        return view('editBeacon',compact('beacon'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $beacon = \App\Beacon::find($id);
        $profile = \App\Profile::all();

        return view('editBeacon',compact('beacon','profile'));
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
        $beacon = \App\Beacon::find($id);

        $this->validate($request,[
            'uuid'=>'required',
            'selectProduct'=>'required'
        ]);
        
        $uuid = $request->input('uuid');
        $product = json_encode($request->input('selectProduct'));
        $assign = json_encode($request->input('assignTo'));
        
        $beacon->uuid = $uuid;
        $beacon->product = $product;
        $beacon->assign = $assign;

        $beacon->save();

        return redirect('/addBeacon')->with('success','Beacon updated.');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $beacon = \App\Beacon::find($id);
        $beacon->delete();
    }
}
