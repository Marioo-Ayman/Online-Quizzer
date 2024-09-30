<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index(){
        $is_admin = User::select('is_admin')->get();
        $user = User::all();

        //   if($is_admin=== 'admin'){
            // return view('admin.dashboard.index');   // that is working

             $user = User::get();
             return view('admin.index', ['user'=>$user]);

            // }else{
            //     $is_admin = User::select('is_admin')->get();
            //     if($is_admin ==='user'){

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


    
}


