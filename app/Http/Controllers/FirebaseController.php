<?php

namespace App\Http\Controllers;
 
use Illuminate\Http\Request;

use Kreait\Firebase;
 
use Kreait\Firebase\Factory;
 
use Kreait\Firebase\ServiceAccount;
 
use Kreait\Firebase\Database;

use app\demo;
 
class FirebaseController extends Controller{

 
    public function index(Request $request){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceKey.json'); 
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://pwa-push-5d182.firebaseio.com/')
            ->create();
        
            $database = $firebase->getDatabase();
            
            $newPost = $database->getReference('infos');

            $newPost->Push([
                'info_title' => $request->input('messages'), 
                'info_description' => $request->input('beaconUUID')
            ]);
                
            //$newPost->getKey(); // => -KVr5eu8gcTv7_AHb-3-
            
            //$newPost->getUri(); // => https://pwa-push-5d182.firebaseio.com/infos/-KVr5eu8gcTv7_AHb-3-
            
            //$newPost->getChild('title')->set('Changed post title');
            
            //$newPost->getValue(); // Fetches the data from the realtime database
            
            //$newPost->remove();
            
            
            return redirect('demo');
    }

    public function NewOrder(Request $request){
        $serviceAccount = ServiceAccount::fromJsonFile(__DIR__.'/serviceKey.json'); 
        $firebase = (new Factory)
            ->withServiceAccount($serviceAccount)
            ->withDatabaseUri('https://pwa-push-5d182.firebaseio.com/')
            ->create();
        
            $database = $firebase->getDatabase();
            
            $newPost = $database->getReference('Orders');

            $newPost->Push([
                'Quantity' => $request->input('Quantity'), 
                'BeaconType' => $request->input('BeaconType')
            ]);
            
            
            return redirect('demo');
    }
?>