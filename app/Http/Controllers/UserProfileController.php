<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function user_profile_show($user_id){
            $data=User::where("id",$user_id)->first();
            return view("user_profile.user_profile",["data"=>$data]);
        }
    public function image_edit_show($user_id){
            return view("user_profile.image_edit",["user_id"=>$user_id]);
        }
    public function image_edit_function(Request $request,$user_id){
        $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' ,      
        ]);
        
        $file_extension=$request->image->getClientOriginalExtension();
        $file_name=$user_id.".".$file_extension;
        $path=public_path("uploads");
        $request->image->move($path,$file_name);
        $check_exsistens=User::where("id",$user_id)->first();
            if($check_exsistens){
            User::where("id",$user_id)->update(["image"=>$file_name]);
            }
            return to_route("user_profile_show",$user_id);
        }

        public  function phone_number_edit_show($user_id){
        return view("user_profile.phone_number_edit",["user_id"=>$user_id]);
        }  
        public  function phone_number_edit_function(Request $request,$user_id){
            $request->validate([
                'phone' => 'required|min:11|max:11' ,      
                ]);        
            $user = User::find($user_id); 
            $user->update([
                'phone' => $request->phone,
            ]);
            return to_route("user_profile_show",$user_id);
        }  
        public  function name_edit_show($user_id){
        return view("user_profile.name_edit",["user_id"=>$user_id]);
        }  
        public  function name_edit_function(Request $request,$user_id){
           
               $request->validate([
                'name' => 'required|string|max:20' ,      
                ]);
                 $user = User::find($user_id); 
            $user->update([
                'name' => $request->name,
            ]);
            return to_route("user_profile_show",$user_id);
        }  
        public  function email_edit_show($user_id){
        return view("user_profile.email_edit",["user_id"=>$user_id]);
        }  
        public  function email_edit_function(Request $request,$user_id){
            $request->validate([
                'email' => 'required|email|unique:users,email' ,      
                ]);
            $user = User::find($user_id); 
            $user->update([
                'email' => $request->email,
            ]);
            return to_route("user_profile_show",$user_id);
        }  
        
}
