<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\Quiz;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function user_profile_show(){
            $data=User::where("id",Auth::id())->first();
            return view("user_profile.user_profile",["data"=>$data]);
        }
    public function image_edit_show(){
            return view("user_profile.image_edit",["user_id"=>Auth::id()]);
        }
    public function image_edit_function(Request $request){
        $request->validate([
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048' ,      
        ]);
        
        $file_extension=$request->image->getClientOriginalExtension();
        $file_name=Auth::id().".".$file_extension;
        $path=public_path("uploads");
        $request->image->move($path,$file_name);
        $check_exsistens=User::where("id",Auth::id())->first();
            if($check_exsistens){
            User::where("id",Auth::id())->update(["image"=>$file_name]);
            }
            return to_route("user_profile_show",Auth::id());
        }

        public  function phone_number_edit_show(){
        return view("user_profile.phone_number_edit",["user_id"=>Auth::id()]);
        }  
        public  function phone_number_edit_function(Request $request){
            $request->validate([
                'phone' => 'required|min:11|max:11' ,      
                ]);        
            $user = User::find(Auth::id()); 
            $user->update([
                'phone' => $request->phone,
            ]);
            return to_route("user_profile_show",Auth::id());
        }  
        public  function name_edit_show(){
        return view("user_profile.name_edit",["user_id"=>Auth::id()]);
        }  
        public  function name_edit_function(Request $request){
           
               $request->validate([
                'name' => 'required|string|max:20' ,      
                ]);
                 $user = User::find(Auth::id()); 
            $user->update([
                'name' => $request->name,
            ]);
            return to_route("user_profile_show",Auth::id());
        }  
        public  function email_edit_show(){
        return view("user_profile.email_edit",["user_id"=>Auth::id()]);
        }  
        public  function email_edit_function(Request $request){
            $request->validate([
                'email' => 'required|email|unique:users,email' ,      
                ]);
            $user = User::find(Auth::id()); 
            $user->update([
                'email' => $request->email,
            ]);
            return to_route("user_profile_show",Auth::id());
        }  
        public  function display_all_quizzes(){
            $results = DB::table('users_score')
            ->join('quizzes', 'users_score.quiz_id', '=', 'quizzes.id')  
            ->select(
                'users_score.user_id',
                'users_score.quiz_id',
                'users_score.user_score',
                'quizzes.id',
                'quizzes.title',
                'quizzes.description',
                'quizzes.created_at',
                'quizzes.time_limit'
            )
            ->where('users_score.user_id', Auth::id()) 
            ->paginate(6);  
        return view("user_profile.display_all_quizzes",["data"=>$results]);
        }  
        public function logout(Request $request)
        {

            Auth::guard('web')->logout();

            $request->session()->invalidate();
    
            $request->session()->regenerateToken();
    
            return redirect('/');
        }
        public function deleteAccount(Request $request)
        {
            $userId = Auth::id();

            if ($userId) {
                DB::table('users')->where('id', $userId)->delete();
            }

            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();

            return redirect('/')->with('message', 'Account deleted successfully.');
        }
        
}
