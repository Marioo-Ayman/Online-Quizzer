<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

use function PHPUnit\Framework\returnValue;

class AdminController extends Controller
{
    function index(){
        // $role = User::select('role')->get();
        $user = User::all();

        //   if($role=== 'admin'){
            // return view('admin.dashboard.index');   // that is working

            //  $user = User::get();

            if(Auth::user()->role == "admin"){

                return view('admin.index', ['user'=>$user]);
            }
            // if(Auth::user()->role === 'user'){
            //     return view('user.userDashboard');
            // }

            return redirect()->back();
            // }else{
            //     $role = User::select('role')->get();
            //     if($role ==='user'){

            //         return view('view.dashboard');
            //     }
            // }
        }


        public function profile(){

            $id = Auth::user()->id;
            $userData =User::findOrFail($id);
            return view('admin.adminProfileView', compact('userData'));
        }


    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function contact_to_admin(){
        return view('auth.contactWithAdmin');
    }
    // function sendEmail(Request $request){
    //     $request->validate([
    //         'email'=>'required'
    //     ]);

    //     if(Auth::attempt($request->email)){
    //         return redirect('dashboard');
    //     }
    //     throw ValidationException::withMessages([
    //         'email'=>['credentials false']
    //     ]);
    // }
    // public function send_reset(Request $request)
    // {
    //     $request->validate(['email' => "required|email"]);
    //     $res = Password::sendResetLink($request->only('email'));
    //     return $res === Password::RESET_LINK_SENT ? back()->with('status' , "Password link sent") : back()->withErrors(['email' => 'not valid']);
    // }



        // function sendEmail(Request $request){

        //     Mail::to($request->email)->send(new SendEmail($request->email));
        //     return redirect(route('admin.dashboard'));
        // }
        // public function sendEmail(Request $request)
        // {
        //     // Mail::to($request->email)->queue(new SendEmail($request->email));
        //     // // return redirect(route('admin.dashboard'));
        //     // return view('auth.email_message');

        //     // Log::info("Attempting to send email to: " . $request->email);

        //     Mail::to($request->email)->queue(new SendEmail($request->email));

        //     // Log::info("Email dispatched to queue.");
        //     return view('auth.email_message');

        // }
        public function sendEmail(Request $request)
        {
            // ini_set('max_execution_time', 120);

            $request->validate([
                'email' => 'required|email',
            ]);

            // Log the email for debugging
            Log::info("Attempting to send email to: " . $request->email);

            // Mail::to($request->email)->queue(new SendEmail($request->email));
            Mail::to($request->email)->send(new SendEmail($request->email));

            Log::info("Email dispatched to queue.");

            return view('auth.email_message');
        }

        public function getAllUsers(){
            // $users = User::all();
            // $users = User::where('role', '=', 'user')->get();



            // $users = User::where('role', '=', 'user')->with('userScore')->get();
            $users = User::where('role', '=', 'user')->with('userScore.quiz')->get();
            // $numberOfUsers  = count($users);
            return view('admin.showUsers', compact('users'));
            // return view('admin.showUsers', ['users'=>$users, 'numberOfUsers'=>$numberOfUsers]);
        }
        public function search(Request $request){
            $keyword  = $request->keyword;
            $users = User::where('name', 'like', "%$keyword%")->get();
            dd($users);
            return response()->json($users);
        }


        public function getUser($id){
            $user = User::find($id);
            return view('admin.showSpecificUser', compact('user'));
        }

        public function countOfUsers(){
            //  $userCount = User::where('role', "user")->count(); // Count users
            //   return view('admin.content', compact($userCount));
            $userCount = User::where('role', 'user')->count(); // Count users
            dd($userCount);
            return view('admin.content', ['userCount' => $userCount]); // Pass to view

        }

}


