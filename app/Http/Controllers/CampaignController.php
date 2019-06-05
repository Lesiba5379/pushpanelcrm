<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Campaign;
use DB;
use Auth;
use Kreait\Firebase;
use Kreait\Firebase\Factory; 
use Kreait\Firebase\ServiceAccount;
use Kreait\Firebase\Database;

/**
 * Author: Lesiba Nxumalo
 * Desc: create campaign by sending some data to mysql(campaign name) and some to firebase(img).
 */
class CampaignController extends Controller
{

    /**
     * @name { createCampaign }
     * @return integer
     * 
     * creates a campaign by sending name variable to and by calling sendImgFirebase().
     * 
     */
    public function createCampaign(){
         
        $name = $_POST['name'];
        $img = $_POST['img'];
        


      //  $this->validate($request,[
        //    'name'=>'required',
        //]);
         
         //get user data for query prep.

         //$name = $request->input('name');
         $user_id = Auth::user()->id;
         
         $c = new Campaign();
         
         //send data to mysql and firebase at simultaneously.

         $c->name = $name;
         $c->user_id = $user_id;
         $c->status = '0';
         $c->save();
          
         $id = $c->id;

         $this->sendImgToFirebase($id, $img, $name);

         return '1';
    }

    /**
     * @name sendImgToFirebase
     * @param $id campaign
     * @param $img flyer to send to firebase
     */
    public function sendImgToFirebase($id, $img, $name){
        
        //firebase configs and send to firebase
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://pwa-push-5d182.firebaseio.com/')
            ->create();
        
            $database = $firebase->getDatabase();
            
            $newPost = $database->getReference('CampaignCollection');

            $newPost->Push([
                'id' => $id,
                'Poster' => $img,
                'Name' => $name,
            ]); 

    }

    /**
     * @name deleteCampaign
     * @return integer
     */
    public function deleteCampaign(){
        
        $id = $_POST['id'];
        
        $c = \App\Campaign::find($id);
        
        $c->delete();
        
        return '1';
    }

    /**
     * @name viewCampaign
     * @return base64img
     */
    public function viewCampaign(Request $request, $id){
        
        $img = null;
        
        //firebase configs and send to firebase
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceKey.json');
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://pwa-push-5d182.firebaseio.com/')
            ->create();
        
            $database = $firebase->getDatabase();
            
            $ref = $database->getReference('CampaignCollection')->getValue();

            foreach($ref as $key){
                if($key['id'] == $id){ 
                    $img = $key['Poster']; 
                 }
               return view('view-campaign')->with('img',$img); 
             }
             
    }


    


    public function ResizeImage(){

        if(isset($_POST["image"])){
            $data = $_POST["image"];
            $image_array_1 = explode(";", $data);
            $image_array_2 = explode(",", $image_array_1[1]);
            $data = base64_decode($image_array_2[1]);
            $imageName = time() . '.png';
        
            file_put_contents($imageName, $data);
        
            echo '<img src="'.$imageName.'" class="img-thumbnail" />';
        
        }
    }
}
