<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use DB;
use Session;

class NotificationController extends Controller
{
    //


    public function index(){
       $user_device_token= DB::table('device_token')->select('device_token','user_code')->get();
       
        return view('Notification.firebase_Notification',[
            'user'=>$user_device_token,
        ]);
    }

       public function storingToken(Request $request){


         $tokens= DB::table('device_token')->select('device_token')->where('user_code',$request->user_code)->get();
         
         foreach($tokens as $value){
            
            if($request->token==$value->device_token){
                
                return "Already existed";
            }
         }
        
             $myarr =[
                 'device_token'=>$request->token,
                 'user_code'=>$request->user_code,
                 
             ] ;
            $res= DB::table('device_token')->insert($myarr);
            if($res){
                return "inserted Successfully";
            }else{
                return "failed";
            }


       }
    public function sendingNotification(Request $request){

        
      
        
        
    $response= Notification::Notify($request);
    if($response){
        return redirect('Firebase_Notification');
    }else{
        return $response;
    }
    
    }
}
