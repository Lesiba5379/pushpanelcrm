<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use \App\Beacon;
use \App\Campaign;
use Auth;
use Kreait\Firebase;
use Kreait\Firebase\Factory; 
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

/**
 * Author: Lesiba Nxumalo
 * Desc: most methods return views->with(data).
 * Commented those I feel they're special or have more value.
 */
class CustomsController extends Controller
{
     
     /**
      * @name listCampaign
      * @function
      * @return view
      */
     public function listCampaign(){
        


        /*$test = DB::table('beacons')
               ->join('campaigns', 'campaigns.id','=','beacons.campaign_id')
               ->select('campaigns.*')
               ->get(); */


        //return $test;

        $beacon = \App\Beacon::all();
        $campaign = \App\Campaign::all();

        $beacons = \App\Beacon::select('id','uuid','product','campaign_id')->get();

        $beaconModal = \App\Beacon::select('id','uuid','product')->get();



        $test = DB::table('campaigns')
               ->leftJoin('beacons','campaigns.id','=','beacons.campaign_id')
               ->select('campaigns.*','beacons.*')
               ->get();

        
        return view('campaigns',compact('campaign','beacons','beaconModal','test'))->with('beacon',$beacon);

     }
     
     public function unassignBeacon(){
         $id = $_POST['id'];


         return $id;

     }
     public function viewCampaign($img){
        return view('view-campaign', compact('img'));
     } 
     public function getProfiles(){
  
        return view('profile');

     }
     
     public function loadAdView(){
        return view('ads');
     }
     
     public function editBeaconView(){
       
        $profile = \App\Profile::select('company_name')->get();

        return view('editBeacon',compact('profile'));
     } 
     
     public function editProfile($id){
        
        $profile = \App\Profile::find($id);

        return view('editProfile')->with('profile',$profile);
     }

     public function addBeaconView(){

         //$profile = \App\Profile::select('company_name')->get();
         
         $companies = \App\User::whereRoleIs('client')->get();

         return view('beacon')->with('companies',$companies);
     }

     public function addBeacon(){

        $profile = \App\Profile::select('company_name')->get();
        $users = \App\User::all();
        $beacons = \App\Beacon::all();
        
        $companies = \App\User::whereRoleIs('administrator')->get();

        $b = DB::table('users')
                ->join('beacons','users.id','=','beacons.user_id')
                ->select('users.*','beacons.*')
                ->get();
        

        return view('addBeacon',compact('profile','users','beacons','b','companies'));
     }

     public function deleteBeacon(){
        $id = $_POST['id'];

        $beacon = \App\Beacon::find($id);
        $beacon->delete();
       
        return '1';
     }

     public function deleteProfile(){
        $id = $_POST['id'];

        $beacon = \App\Profile::find($id);
        $beacon->delete();
       
        return '1';
     }

     public function allBeacons(){
       
        $beaco = \App\Beacon::all();
        return view('demo')->with('uuid',$beaco);
       
     }

     public function getAllUsers(){
         
         $users= \App\User::all();

         return $users;
     }
    
     public function getAllProfiles(){
         $profiles = \App\Profile::all();
         
         return $profiles;
     }  


     public function blockUser(){
         $id = $_POST['id'];
            
         $profile = \App\Profile::find($id);
         
         if($profile->active == '1'){
            $profile->active = '0'; 
         }else{
            $profile->active = '1';
         }
         
         $profile->save();
     }
     
      
     //load view beacon template
     public function loadViewBeaconView($id){
         return view('viewBeacon');
     }
     
    /**
     *  @name assignBeacon
     *  @function
     *  @returns int response status indicator 
     *  assign beacon to end-user done by super-admin or normal administrator. 
     */
     public function assignBeacon(){
         
         $id = $_POST['id'];
         $b = $_POST['beacon'];
          
         
         foreach($b as $i){
            $beacon = \App\Beacon::find($i);
            $beacon->emp_id = $id;
            $beacon->save();
         }
         
         return '1';
     }
     
     /**
      * @name assign campaign beacon
      * @function
      * @returns int as indicator,
      * @updates the firebase Collection by Adding the Beacon UUID's
      */
      public function assignCampaignBeacon(){
         
         $id = $_POST['id'];
         $b = $_POST['beacon'];
         $set = '1';
         
         foreach($b as $i){
            
            $beacon = \App\Beacon::find($i);

            $eddystone = $beacon->EddystoneNamespace;
            $iBeacon = $beacon->IBeaconUUID;
            

            if(!empty($beacon->campaign_id)){
               $set = '0';
            }else{
               $beacon->campaign_id = $id; 
               $beacon->save();

               $campaign = \App\Campaign::find($id);

               $name = $campaign->name;

               $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceKey.json'); 
               $firebase = (new Factory)
                  ->withServiceAccount($serviceAccount)
                  ->withDatabaseUri('https://pwa-push-5d182.firebaseio.com/')
                  ->create();
            
                  $database = $firebase->getDatabase();
                  
                  $ref = $database->getReference('CampaignCollection')->getChild($name);
                     
                  $data = $ref->orderByKey()->getValue();
            
                  foreach($data as $key){
                     $item = $key['id'];
                     $item_Name = $key['Name'];
                     $item_img = $key['Poster'];
                         
                     if($item = $id){
                        $updateKey = $ref->getKey();
                        foreach($key as $i){
                           $postData = [
                              'id' => $item,
                              'Name' => $item_Name,
                              'Poster' => $item_img,
                              'iBeacon' => $iBeacon,
                              'Eddystone' =>$eddystone,
                           ];
                     
                           $updates = [$updateKey => $postData,];
                                   
                     
                           $database->getReference('CampaignCollection') // this is the root reference
                           ->update($updates);
                        } //End of foreach($key as $i)
                     } //End of if($item = $id)   
                  } //End of foreach($data as $key)
               } //End of if(!empty($beacon->campaign_id) -> Else 
            }//End of foreach($b as $i)
         return $set;
      }//End of Function
     
     /**
      * @name unassign beacon
      * @function
      * returns
      */
     /*public function unassignBeacon(){
          
         $val = $_POST['values'];
          
         $beacon = \App\Beacon::find($val[0]);
         $beacon->campaign_id = null; 
         $beacon->save();
          
     }*/
     /**
      * @name get campaigns
      * @function
      * @returns Campaigns Objects
      */
     public function getCampaigns(){
       
        $campaigns = \App\Campaign::all();

        return $campaigns;
     }

     
     public function editCampaign(Request $request, $id){

      $img = null;
      //$campID = $id;
      //return var_dump($campID);

      $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceKey.json'); 
      $firebase = (new Factory)
         ->withServiceAccount($serviceAccount)
         ->withDatabaseUri('https://pwa-push-5d182.firebaseio.com/')
         ->create();
         
      $database = $firebase->getDatabase();
               
      $ref = $database->getReference('CampaignCollection')->getValue();

      //$val = $ref->getData()->getValue();

      //Query query = dbRef.orderByChild("name");
     // return var_dump($val);
         foreach($ref as $key){
           // $item = $k1['id']; 
           // $poster = $key['Poster'];

            if($key['id'] == $id){ 
               $img = $key['Poster']; 
            }
            return view('edit-campaign')->with('img', $img);
         }
      
  }
     /**
      * @name { blockCampaign }
      * @function
      * @returns null
      */
     public function blockCampaign(){
         
        /***
         * -1 true.
         *  0 false. 
         */

         $id = $_POST['id'];
         
         $campaign = \App\Campaign::find($id);
         
         $campaign->status = '-1';

         $campaign->save();

         return '1';
     }

     /**
      * @name { setStatus }
      * @function
      * set status column in the user table { 1 active | -1 inactive }
      */
     public function setStatus(){
         
         //get id from the front-end(ajax call)
         $id = $_POST['id'];
         
         $user = \App\User::find($id);

         $user->status = '-1';
         $user->save();
         
         return '1';
     }


     /**
      * @name { getStatus}
      * @function
      * fetch user status { 1 active | -1 inactive }
      * from the database for front-end purposes.
      */
      public function getStatus(){
         
         //get id from front-end (via ajax call)
         $id = $_POST['id'];

         $user = \App\User::select('status')->where('id',$id)->get();
         return $user[0]['status'];   
      }

      /**
       * @name { unblockUser}
       * @function
       * set status column on user table to 1 - { 1 active | -1 inactive }
       */
      function unblockUser(){

         //get id from front-end (via ajax call)
         $id = $_POST['id'];

         $user = \App\User::find($id);

         $user->status = '1';
         $user->save();


         return '1';

      }

      /**
       * @name { deleteEndUser }
       * @function
       * deletes end-user from employees table.
       */
      function deleteEndUser(){
         
         //get id from front-end (via ajaxa call)
         $id = $_POST['id'];

        return $emp = \App\Employee::find($id);
         
         $emp->delete();

         return '1';

      }


      function _assignBeacon(){

         $campID = $_POST['campaign_id'];
         $beacons = $_POST['beacons'];
         
         //updating existing record.

         for($x=0;  $x < count($beacons);$x++){
            $beacon = \App\Beacon::find($beacons[$x]);
            $beacon->campaign_id = $campID;
            $beacon->save();
         }
         
         return 1;
         
      }  


      function _assignCompany(){
         
         $beacons = $_POST['beacons'];
         $company = $_POST['company'];

         for($x=0;  $x < count($beacons);$x++){
            $beacon = \App\Beacon::find($beacons[$x]);
            $beacon->user_id = $company;
            $beacon->save();
         }
         
         return 1;
      }
}
